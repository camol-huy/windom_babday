<?php

namespace App\Controller;

use App\Entity\Activite;
use App\Form\ActivityType;
use App\Repository\ActiviteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


class ActiviteController extends AbstractController
{

    //------------------------------------------------------
    // CREATE
    //------------------------------------------------------

    /**
     * @Route("/admin/newActivity", name="newActivity")
     * @IsGranted("ROLE_ADMIN")
     * @param Activite $activity
     * @param EntityManagerInterface $manager
     * @return Response
     */

    public function newActivity(Request $request, ManagerRegistry $doctrine)
    {
        $manager = $doctrine->getManager('REST');
        $activity = new Activite();
        $form = $this->createForm(ActivityType::class, $activity);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if(empty($activity->getFr())) $activity->setFr(0);
            $manager->persist($activity);
            $manager->flush();
            $this->addFlash(
                'success',
                'L\'activité a été correctement ajouté'
            );
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/newActivite.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //------------------------------------------------------
    // READ
    //------------------------------------------------------

    /**
     * @Route("/activites", name="activites")
     */
    public function activites(ActiviteRepository  $activiteRepository): Response
    {
        $activites = $activiteRepository->findBy(['fr'=>1]);
        return $this->render('activite/activites.html.twig',['activites' => $activites]);
    }

    /**
     * @Route("/activiteiten", name="activiteiten")
     */
    public function activities(ActiviteRepository $activiteRepository): Response
    {
        $activiteiten = $activiteRepository->findBy(['fr'=> 0]);
        return $this->render('activite/activiteiten.html.twig',['activiteiten' => $activiteiten]);
    }

    //------------------------------------------------------
    // UPDATE
    //------------------------------------------------------

    /**
     * @Route("/updateActivity/{id}", name="updateActivity")
     * @IsGranted("ROLE_ADMIN")
     * @param Activite $activite
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function updateActivity(Activite $activite,Request $request, EntityManagerInterface $manager)
    {
        $activiteU = $activite;
        $form = $this->createForm(ActivityType::class, $activiteU);
        $form->handleRequest($request); // pour récupere les données du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/updateActivite.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/allActivitiesUpdate/", name="allActivitiesUpdate")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function allFaqUpdate(ActiviteRepository $activiteRepository)
    {
        $activities = $activiteRepository->findAll();
        return $this->render('admin/listActivity.html.twig', ['activities' => $activities]);
    }

    //------------------------------------------------------
    // DELETE
    //------------------------------------------------------

    /**
     * @Route("/deleteactivity/{id}", name="deleteActivity")
     * @IsGranted("ROLE_ADMIN")
     * @param Activite $activite
     * @param EntityManagerInterface $manager
     * @return Response
     */

    public function delactivite(Activite $activite, EntityManagerInterface $manager) :Response
    {
        $manager->remove($activite);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }

}
