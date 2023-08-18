<?php

namespace App\Controller;

use App\Entity\Programme;
use App\Form\ProgrammeType;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProgrammeController extends AbstractController
{
    //------------------------------------------------------
    // CREATE
    //------------------------------------------------------

    /**
     * @Route("/admin/newProgram", name="newProgram")
     * @IsGranted("ROLE_ADMIN")
     * @param Programme $program
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newProgram(Request $request, EntityManagerInterface $manager)
    {
        $program = new Programme();
        $form = $this->createForm(ProgrammeType::class, $program);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if(empty($program->getAir())) $program->setAir(0);
            $manager->persist($program);
            $manager->flush();
            $this->addFlash(
                'success',
                'le Programme a été correctement ajouté'
            );
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/newProgram.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //------------------------------------------------------
    // READ
    //------------------------------------------------------

    /**
     * @Route("/program_fr", name="program_fr")
     */
    public function program_fr(ProgrammeRepository $programmeRepository): Response
    {
        $programsFr = $programmeRepository->findBy(['fr'=>1]);
        return $this->render('faq/faq_fr.html.twig', ['program_fr' => $programsFr]);
    }

    /**
     * @Route("/program_nl", name="program_nl")
     */
    public function faq_nl(ProgrammeRepository $programmeRepository): Response
    {
        $programsNl = $programmeRepository->findBy(['fr'=>0]);
        return $this->render('faq/faq_nl.html.twig', ['program_nl' => $programsNl]);
    }

    //------------------------------------------------------
    // UPDATE
    //------------------------------------------------------

    /**
     * @Route("/updateProgram/{id}", name="updateProgram")
     * @IsGranted("ROLE_ADMIN")
     * @param Programme $program
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function updateProgram(Programme $program, Request $request, EntityManagerInterface $manager)
    {
        $programU = $program;
        $form = $this->createForm(ProgrammeType::class, $programU);
        $form->handleRequest($request); // pour récupere les données du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/updateProgram.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/allProgrammUpdate/", name="allProgramUpdate")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function allProgramUpdate(ProgrammeRepository $programmeRepository)
    {
        $programs = $programmeRepository->findAll();
        return $this->render('admin/listProgram.html.twig', ['programs' => $programs]);
    }

    //------------------------------------------------------
    // DELETE
    //------------------------------------------------------

    /**
     * @Route("/deleteProgram/{id}", name="deleteProgram")
     * @IsGranted("ROLE_ADMIN")
     * @param Programme $program
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delProgramme(Programme $program, EntityManagerInterface $manager) :Response
    {
        $manager->remove($program);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }

}
