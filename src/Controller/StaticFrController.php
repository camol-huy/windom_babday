<?php

namespace App\Controller;

use App\Repository\FaqRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Mime\FileinfoMimeTypeGuesser;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class StaticFrController extends AbstractController
{
    /**
     * @Route("/accueil", name="accueil")
     */
    public function index(): Response
    {
        return $this->render('staticFr/accueil.html.twig');
    }

    /**
     * @Route("/modalites", name="modalites")
     */
    public function modalites(): Response
    {
        return $this->render('staticFr/modalites.html.twig');
    }

    /**
     * @Route("/sponsors", name="sponsors")
     */
    public function sponsors(): Response
    {
        return $this->render('staticFr/sponsors.html.twig');
    }

    /**
     * @Route("/tickets", name="tickets")
     */
    public function tickets(): Response
    {
        return $this->render('staticFr/tickets.html.twig');
    }

    /**
     * @Route("/programme", name="programme")
     */
    public function programme(): Response
    {
        return $this->render('staticFr/programme.html.twig');
    }

    /**
     * @Route("/devenirSponsor", name="devenirSponsor")
     */
    public function devenirSponsot(): Response
    {
        return $this->render('staticFr/devenirSponsor.html.twig');
    }

    /**
     * @Route("/programmePDF", name="programmePDF")
     */
    public function programmePDF(): Response
    {
        return $this->render('staticFR/programmePDF.html.twig');
    }

}
