<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StaticNlController extends AbstractController
{
    /**
     * @Route("/ontvangst", name="ontvangst")
     */
    public function index(): Response
    {
        return $this->render('staticNl/ontvangst.html.twig');
    }

    /**
     * @Route("/modaliteiten", name="modaliteiten")
     */
    public function modalites(): Response
    {
        return $this->render('staticNl/modaliteiten.html.twig');
    }

    /**
     * @Route("/sponsor", name="sponsor")
     */
    public function sponsors(): Response
    {
        return $this->render('staticNl/sponsor.html.twig');
    }

    /**
     * @Route("/kaartjes", name="kaartjes")
     */
    public function tickets(): Response
    {
        return $this->render('staticNl/kaartjes.html.twig');
    }

    /**
     * @Route("/programma", name="programma")
     */
    public function programme(): Response
    {
        return $this->render('staticNl/programma.html.twig');
    }

    /**
     * @Route("/becomingSponsor", name="becomingSponsor")
     */
    public function becomingSponsor(): Response
    {
        return $this->render('staticNl/becomingSponsor.html.twig');
    }
}
