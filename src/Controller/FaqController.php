<?php

namespace App\Controller;

use App\Entity\Faq;
use App\Form\FaqType;
use App\Repository\FaqRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class FaqController extends AbstractController
{

    //------------------------------------------------------
    // CREATE
    //------------------------------------------------------

    /**
     * @Route("/admin/newFAQ", name="newFAQ")
     * @IsGranted("ROLE_ADMIN")
     * @param Faq $faq
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newFaq(Request $request, EntityManagerInterface $manager)
    {
        $faq = new Faq();
        $form = $this->createForm(FaqType::class, $faq);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if(empty($faq->getFr())) $faq->setFr(0);
            $manager->persist($faq);
            $manager->flush();
            $this->addFlash(
                'success',
                'La FAQ a été correctement ajouté'
            );
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/newFaq.html.twig', [
            'form' => $form->createView()
        ]);
    }

    //------------------------------------------------------
    // READ
    //------------------------------------------------------

    /**
     * @Route("/faq_fr", name="faq_fr")
     */
    public function faq_fr(FaqRepository $faqRepository): Response
    {
        $faqsFr = $faqRepository->findBy(['fr'=>1]);
        return $this->render('faq/faq_fr.html.twig', ['faq_fr' => $faqsFr]);
    }

    /**
     * @Route("/faq_nl", name="faq_nl")
     */
    public function faq_nl(FaqRepository $faqRepository): Response
    {
        $faqsNl = $faqRepository->findBy(['fr'=>0]);
        return $this->render('faq/faq_nl.html.twig', ['faq_nl' => $faqsNl]);
    }

    //------------------------------------------------------
    // UPDATE
    //------------------------------------------------------

    /**
     * @Route("/updateFaq/{id}", name="updateFaq")
     * @IsGranted("ROLE_ADMIN")
     * @param Faq $faq
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function updateFaq(Faq $faq,Request $request, EntityManagerInterface $manager)
    {
        $faqU = $faq;
        $form = $this->createForm(FaqType::class, $faqU);
        $form->handleRequest($request); // pour récupere les données du formulaire
        if($form->isSubmitted() && $form->isValid())
        {
            $manager->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/updateFaq.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/admin/allFaqUpdate/", name="allFaqUpdate")
     * @IsGranted("ROLE_ADMIN")
     * @return Response
     */
    public function allFaqUpdate(FaqRepository $faqRepository)
    {
        $faqs = $faqRepository->findAll();
        return $this->render('admin/listFaq.html.twig', ['faqs' => $faqs]);
    }

    //------------------------------------------------------
    // DELETE
    //------------------------------------------------------

    /**
     * @Route("/deletefaq/{id}", name="deleteFaq")
     * @IsGranted("ROLE_ADMIN")
     * @param Faq $faq
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function delFaq(Faq $faq, EntityManagerInterface $manager) :Response
    {
        $manager->remove($faq);
        $manager->flush();
        return $this->redirectToRoute('admin');
    }

}
