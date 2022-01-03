<?php

namespace App\Controller;

use App\Entity\State;
use App\Form\StateType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/state")
 */
class StateController extends AbstractController
{
    /**
     * @Route("/", name="state_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {
        $states = $entityManager
            ->getRepository(State::class)
            ->findAll();

        return $this->render('state/index.html.twig', [
            'states' => $states,
        ]);
    }

    /**
     * @Route("/new", name="state_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $state = new State();
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($state);
            $entityManager->flush();
            return $this->redirectToRoute('state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('state/new.html.twig', [
            'state' => $state,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="state_show", methods={"GET"})
     */
    public function show(State $state): Response
    {
        return $this->render('state/show.html.twig', [
            'state' => $state,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="state_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, State $state, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(StateType::class, $state);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('state_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('state/edit.html.twig', [
            'state' => $state,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="state_delete", methods={"POST"})
     */
    public function delete(Request $request, State $state, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$state->getId(), $request->request->get('_token'))) {
            $entityManager->remove($state);
            $entityManager->flush();
        }

        return $this->redirectToRoute('state_index', [], Response::HTTP_SEE_OTHER);
    }
}
