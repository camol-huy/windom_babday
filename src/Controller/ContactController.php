<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Reservation;
//use chillerlan\QRCode\QRCode;
//use chillerlan\QRCode\QROptions;
use Doctrine\ORM\EntityManagerInterface;
//use Endroid\QrCode\Builder\Builder;
//use Endroid\QrCode\Builder\BuilderRegistryInterface;
//use Endroid\QrCodeBundle\Response\QrCodeResponse;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ContactController extends AbstractController
{
    //------------------------------------------------------
    // CODE SOURCE
    //------------------------------------------------------

//    /** @var BuilderRegistryInterface */
//    private $builderRegistry;
//
//    public function __construct(BuilderRegistryInterface $builderRegistry)
//    {
//        $this->builderRegistry = $builderRegistry;
//    }
//
//    public function __invoke(string $builder, string $data): Response
//    {
//        $builder = $this->builderRegistry->getBuilder($builder);
//
//        if (!$builder instanceof Builder) {
//            throw new \Exception('This controller only handles Builder instances');
//        }
//
//        return new QrCodeResponse($builder->data($data)->build());
//    }

    /**
     * @Route("/contact", name="contact")
     * @param MailerInterface $mailerInterface
     * @return Response
     */
    public function contact(MailerInterface $mailerInterface, Request $request): Response
    {
        $contact = new Contact();

        /*
         * function de validité des données.
         */
        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }

        $contact->setEmail(valid_donnees($_POST['eMail']));
        $contact->setMessage(valid_donnees($_POST['question']));
        $contact->setFirstname(valid_donnees($_POST['firstname']));
        $contact->setLastname(valid_donnees($_POST['lastname']));
        $email = (new Email())
            ->from($contact->getEmail())
            ->to('info@babday.be')
            ->subject('question sur le BAB Day 2022')
            ->html($contact->getMessage()."<br> ".$contact->getFirstname()." ".strtoupper($contact->getLastname()));
        $mailerInterface->send($email);

        $referer_url = $request->headers->get("referer");
        $response = new RedirectResponse($referer_url);
        return $response;

    }

    /**
     * @Route("/mailQR/{id}", name="mailQR")
     * @param MailerInterface $mailerInterface
     * @return Response
     */
//    public function mailQR(EntityManagerInterface $manager, Reservation $resa, MailerInterface $mailerInterface, Request $request): Response
//    {
//
//        $url = 'https://127.0.0.1:8000/admin/resa/'.$resa->getId();
//        $options = new QROptions(
//            [
//                'eccLevel' => QRCode::ECC_L,
//                'outputType' => QRCode::OUTPUT_MARKUP_SVG,
//                'version' => 5,
//            ]
//        );
//
//        $qrcode = (new QRCode($options))->render($url);
//
//        $email = (new TemplatedEmail())
//            ->from('info@babday.be')
//            ->to($resa->getEmail())
//            ->bcc('olivier.camus@mil.be')
//            ->subject('Your Access at BABDAY')
//            ->attachFromPath('pdf/'.$resa->getId().'.pdf')
//            ->htmlTemplate('qr/index.html.twig')
//            ->context(['resa' => $resa, 'qrcode' => $qrcode]);
//
//
//        $mailerInterface->send($email);
//        $resa->setUpdatedAt(new \DateTime('1981-02-08 10:30:00'));
//
//        $manager->flush();
//
//        $referer_url = $request->headers->get("referer");
//        $response = new RedirectResponse($referer_url);
//        return $response;
//    }
}
