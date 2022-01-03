<?php

namespace App\Controller;

use App\Entity\Movies;
use App\Form\MoviesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movies")
 */
class MoviesController extends AbstractController
{
    /**
     * @Route("/", name="movies_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $movies = $entityManager
            ->getRepository(Movies::class)
            ->findAll();   
               
        return $this->render('movies/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    /**
     * @Route("/new", name="movies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $movie = new Movies();
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($movie);
            $entityManager->flush();
            return $this->redirectToRoute('movies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movies/new.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="movies_show", methods={"GET"})
     */
    public function show(Movies $movie): Response
    {
        return $this->render('movies/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="movies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Movies $movie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MoviesType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('movies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movies/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="movies_delete", methods={"POST"})
     */
    public function delete(Request $request, Movies $movie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($movie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('movies_index', [], Response::HTTP_SEE_OTHER);
    }
}

