<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Service\EntityService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManager;
use App\Entity\User;
use Symfony\Component\Serializer\Serializer;

class UserController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/user", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/listUser", name="listUser")
     */
    public function list(EntityService $entityService): Response
    {       
        $entityManager = $this->getDoctrine()->getManager();

        $lists = $entityManager
        ->getRepository(User::class)
        ->findAll();   
  
        return $this->render('user/list.html.twig', [
            'lists'=>$lists
        ]);
    }
    
}
