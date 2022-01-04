<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Entity\State;
use App\Repository\RentalRepository;
use App\Form\RentalType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Service\EntityService;
use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @Route("/rental")
 */
class RentalController extends AbstractController
{

     /**
     * @var Security
     */
    private $security;

    public function __construct(Security $security)
    {
       $this->security = $security;
    }

    /**
     * @Route("/listRental", name="listRental")
     */
    public function list(EntityManagerInterface $entityManager): Response
    {
        //$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'User tried to access a page without having ROLE_ADMIN');
        // ROLE_SUPER_ADMIN
        /*if (!$this->security->isGranted('ROLE_USER')) {
            die("IS ADMIN");
        }*/     

        $rentals = $entityManager
        ->getRepository(Rental::class)
        ->findAll();//idState=2 -> unrental  /  idState=1 -> rental

        return $this->render('rental/index.html.twig', [
            'rentals'=>$rentals
        ]);     

    }
   
    /**
     * @Route("/", name="rental_index", methods={"GET"})
     */
    public function index(EntityManagerInterface $entityManager): Response
    {

        $userId = $this->security->getUser()->getId();;

        $rentals = $entityManager
            ->getRepository(Rental::class)
            ->findBy(['idUser' => $userId, 'idState'=> 1]);//idState=2 -> unrental  /  idState=1 -> rental

        return $this->render('rental/index.html.twig', [
            'rentals' => $rentals,
        ]);
    }

    /**
     * @Route("/rental", name="rental", methods={"GET"})
     */
    public function rental()
    {

        $userId = $this->security->getUser()->getId();

        $entityManager=$this->getDoctrine()->getManager();
        $rentals = $entityManager->getRepository(Rental::class)
                            ->findAllGroupByIdCopieMovie($userId);

        $listRef=[];
        $rentalsDistinct=[];


        foreach ($rentals as $key => $value) {
            array_push($listRef,$rentals[$key]->getIdCopieMovie()->getRef());
        }
        
        $listRef =array_unique($listRef);
  
        foreach ($listRef as $key => $value) {
            $flag=0;
            foreach ($rentals as $key2 => $value2) {
                if ($rentals[$key2]->getIdCopieMovie()->getRef() == $listRef[$key]){
                    if($flag == 1){
                        unset($rentals[$key2]);                        
                    }
                    $flag=1;
                }
            }
        }
            return $this->render('rental/actionRental.html.twig', [
            'rentals' => $rentals,
        ]);
    }

    /**
     * @Route("/unrental", name="unrental", methods={"GET"})
     */
    public function unrental(EntityManagerInterface $entityManager): Response
    {

        $userId = $this->security->getUser()->getId();;

        $rentals = $entityManager
            ->getRepository(Rental::class)
            ->findBy(['idUser' => $userId, 'idState'=> 1]);//idState=2 -> unrented  /  idState=1 -> rented

        return $this->render('rental/actionUnrental.html.twig', [
            'rentals' => $rentals,
        ]);
    }

    /**
     * @Route("/new", name="rental_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rental = new Rental();
        $form = $this->createForm(RentalType::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rental);
            $entityManager->flush();

            return $this->redirectToRoute('rental_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('rental/new.html.twig', [
            'rental' => $rental,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rental_show", methods={"GET"})
     */
    public function show(Rental $rental): Response
    {
        return $this->render('rental/show.html.twig', [
            'rental' => $rental,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rental_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Rental $rental, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RentalType::class, $rental);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('rental_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->renderForm('rental/edit.html.twig', [
            'rental' => $rental,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="rental_delete", methods={"POST"})
     */
    public function delete(Request $request, Rental $rental, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rental->getId(), $request->request->get('_token'))) {
            $entityManager->remove($rental);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rental_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/{id}/return", name="return_movie", methods={"GET","POST"})
     */
    public function returnMovie($id, EntityManagerInterface $entityManager): Response 
    {  
        $status = $entityManager
        ->getRepository(State::class)
        ->find(3);

        $rental = $entityManager
        ->getRepository(Rental::class)
        ->find($id);
 
        $rental->setIdState($status);
        $rental->setReturnAt(new \DateTime("now"));

        $entityManager->persist($rental); 
        $flush = $entityManager->flush();    

        if ($flush == null) {
            $result = ['code'=>0, 'msg'=>'Return ok'];
        } else {
            $result = ['code'=>-1, 'msg'=>'Return fail'];
        }

        $response = new JsonResponse();            
        $response->setData($result);

        $userId = $this->security->getUser()->getId();;

        $rentals = $entityManager
            ->getRepository(Rental::class)
            ->findBy(['idUser' => $userId, 'idState'=> 1]);//idState=2 -> unrented  /  idState=1 -> rented

        return $this->render('rental/actionUnrental.html.twig', [
            'rentals' => $rentals,
            'return' => $result
        ]);
    }

    /**
     * @Route("/{id}/rental", name="rental_movie", methods={"GET","POST"})
     */
    public function rentalMovie($id, EntityManagerInterface $entityManager): Response 
    {  
        $statusRental = $entityManager
        ->getRepository(State::class)
        ->find(1);

        $statusFinish = $entityManager
        ->getRepository(State::class)
        ->find(3);

        $rentalOld = $entityManager
        ->getRepository(Rental::class)
        ->find($id);

        if ($rentalOld->getReturnAt()) {//cycle rent - unrent 
            $rentalOld->setIdState($statusFinish);
        }
        
        $rental = new Rental();
        $rental->setIduser($rentalOld->getIdUser());
        $rental->setIdCopieMovie($rentalOld->getIdCopieMovie());
        $rental->setIdState($statusRental);
        $rental->setRentalAt(new \DateTime("now"));

        $entityManager->persist($rental); 
        $flush = $entityManager->flush();    
        
        if ($flush == null) {
            $result = ['code'=>0, 'msg'=>'Rental ok'];
        } else {
            $result = ['code'=>-1, 'msg'=>'Rental fail'];
        }

        $response = new JsonResponse();            
        $response->setData($result);

        $rentals = $entityManager
            ->getRepository(Rental::class)
            ->findBy(['idState'=> 2]);//idState=2 -> unrented  /  idState=1 -> rented

        return $this->render('rental/actionRental.html.twig', [
            'rentals' => $rentals,
            'return'  => $result
        ]);
    }      
    
}
