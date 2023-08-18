<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ReservationController extends AbstractController
{

    //------------------------------------------------------
    // CREATE
    //------------------------------------------------------


    /**
     * @Route("/reservation_fr", name="reservation_fr")
     */
    public function index(): Response
    {
        return $this->render('reservation/reservation_fr.html.twig');
    }

    /**
     * @Route("/reservation_nl", name="reservation_nl")
     */
    /*public function resa_nl(): Response
    {
        return $this->render('reservation/reservation_nl.html.twig');
    }
*/
    /**
     * @Route("/AirC2Event", name="reservation_crc")
     */
    public function resa_crc(): Response
    {
//        return $this->render('reservation/reservation_crc.html.twig');
        return $this->render('starter/maintenance.html.twig');
    }

    /**
     * @Route("/newReservation", name="newReservation")
     * @IsGranted("ROLE_ADMIN")
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(EntityManagerInterface $manager): Response
    {
        $nbResa = $_POST['nombre'];

        /*
         * function de validité des données.
         */
        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }

        for($i = 1; $i < $nbResa+1 ; $i++ )
        {
            $resa = new Reservation();

            $resa->setFirstname(valid_donnees($_POST["firstname".$i]));
            $resa->setName(valid_donnees($_POST["lastname".$i]));
            $resa->setEmail(valid_donnees($_POST["eMail"]));
            $resa->setPayer(0);
            $manager->persist($resa);
            $manager->flush();
        }

        $this->addFlash(
            'success',
            'registration ok'
        );
        return $this->redirectToRoute('starter');
    }

    //------------------------------------------------------
    // READ
    //------------------------------------------------------

    /**
     * @Route("/admin/resas", name="allResa")
     */
    public function allResa(ReservationRepository $reservationRepository): Response
    {

        $resa = $reservationRepository->lectureAJMConnard();

        $count = 8;
        return $this->render('admin/listResa.html.twig', ['resas' => $resa, 'nb' => $count]);
    }

    /**
     * @Route("/visit/resas2", name="allResa2")
     */
    public function allResa2(ReservationRepository $reservationRepository): Response
    {

        $resa = $reservationRepository->findAll();

        $count = 8;
        return $this->render('admin/listResa2.html.twig', ['resas' => $resa, 'nb' => $count]);
    }

    /**
     * @Route("/visit/resa/{id}", name="resa")
     * @IsGranted("ROLE_VISIT")
     */
    public function readOne(Reservation $resa, $id, ReservationRepository $resaRepository): Response
    {
        return $this->render('admin/resaOne.html.twig', ['resa' => $resa]);
    }

    /**
     * @Route("/admin/resaQR/{id}", name="resaQR")
     * @IsGranted("ROLE_ADMIN")
     */
    public function resaQR(Reservation $resa): Response
    {
        return $this->render('admin/resaOne.html.twig', ['resa' => $resa]);
    }

    //------------------------------------------------------
    // UPDATE
    //------------------------------------------------------

    /**
     * @Route("/updateResa/{id}", name="updateResa")
     * @IsGranted("ROLE_ADMIN")
     * @param Reservation $resa
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function updateResa(Reservation $resa,Request $request, EntityManagerInterface $manager)
    {
        $resaU = $resa;
        $form = $this->createForm(ReservationType::class, $resaU);
        $form->handleRequest($request); // pour récupere les données du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/updateFaq.html.twig', ['form' => $form->createView()]);
    }


    /**
     * @Route("/admin/payer/{id}", name="payer")
     * @IsGranted("ROLE_ADMIN")
     */
    public function payer(Reservation $resa, Request $request, EntityManagerInterface $manager): Response
    {

        $resa->setPayer(1);

        $manager->flush();
        return $this->redirectToRoute('allResa');
    }

    /**
     * @Route("/admin/scan/{id}", name="scan")
     * @IsGranted("ROLE_VISIT")
     */
    public function scan(Reservation $resa, Request $request, EntityManagerInterface $manager): Response
    {

        $resa->setImageName(1);

        $manager->flush();
        return $this->redirectToRoute('allResa2');
    }

    //------------------------------------------------------
    // DELETE
    //------------------------------------------------------

    /**
     * @Route("/admin/deleteresa/{id}", name="deleteresa")
     * @IsGranted("ROLE_ADMIN")
     * @param Reservation $resa
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delResa(Reservation $resa, EntityManagerInterface $manager) :Response
    {
        $manager->remove($resa);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }
}
