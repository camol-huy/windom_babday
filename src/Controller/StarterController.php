<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StarterController extends AbstractController
{
    /**
     * @Route("/", name="starter")
     */
    public function index(): Response
    {
        return $this->render('starter/index.html.twig');
    }

    /**
     * @Route("/", name="starter")
     */
//    public function index(): Response
//    {
//        return $this->render('starter/maintenance.html.twig');
//    }
}
