<?php

namespace App\Controller;

use App\Entity\Copiesmovies;
use App\Form\CopiesmoviesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/copies/movies")
 */
class CopiesMoviesController extends AbstractController
{
    /**
     * @Route("/", name="copies_movies_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $copiesmovies = $entityManager
            ->getRepository(Copiesmovies::class)
            ->findAll();

            $resultCountCopies = $entityManager
            ->getRepository(Copiesmovies::class)
            ->findByIdMovie(1);

            return $this->render('copies_movies/index.html.twig', [
            'copiesmovies' => $copiesmovies,
            'resultCountCopies' => $resultCountCopies,
        ]);
    }

    
    public function moreCopies($entityManager): Response
    {

        $rentals = $entityManager
            ->getRepository(Copiesmovies::class)
            ->getPrueba();//idState=2 -> unrented  /  idState=1 -> rented
        return $rentals;
    }


    /**
     * @Route("/new", name="copies_movies_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $copiesmovie = new Copiesmovies();
        $form = $this->createForm(CopiesmoviesType::class, $copiesmovie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($copiesmovie);
            $entityManager->flush();

            return $this->redirectToRoute('copies_movies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('copies_movies/new.html.twig', [
            'copiesmovie' => $copiesmovie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="copies_movies_show", methods={"GET"})
     */
    public function show(Copiesmovies $copiesmovie): Response
    {
        return $this->render('copies_movies/show.html.twig', [
            'copiesmovie' => $copiesmovie,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="copies_movies_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Copiesmovies $copiesmovie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CopiesmoviesType::class, $copiesmovie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('copies_movies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('copies_movies/edit.html.twig', [
            'copiesmovie' => $copiesmovie,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="copies_movies_delete", methods={"POST"})
     */
    public function delete(Request $request, Copiesmovies $copiesmovie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$copiesmovie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($copiesmovie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('copies_movies_index', [], Response::HTTP_SEE_OTHER);
    }
}
