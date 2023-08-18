<?php

namespace App\Controller;

use App\Entity\REST\CRC;
use App\Repository\CRCRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CRCController extends AbstractController
{
    /**
     * @Route("/crc", name="CRC")
     */
    public function index(): Response
    {
        return $this->render('crc/index.html.twig', [
            'controller_name' => 'CRCController',
        ]);
    }

    /**
     * @Route("/crc/resaCRC", name="resaCRC")
     */
    public function allResa(CRCRepository $CRCRepository): Response
    {

        $resa = $CRCRepository->findAll();

        $em = $this->getDoctrine()->getManager();

        // 3. Query how many rows are there in the Articles table

        $totalCRC = $CRCRepository->createQueryBuilder('a')
            // Filter by some parameter if you want
            // ->where('a.published = 1')
            ->select('count(a.id)')
            ->getQuery()
            ->getSingleScalarResult();


        return $this->render('admin/resaCRC.html.twig', ['resas' => $resa, 'nb' => $totalCRC]);
    }


    /**
     * @Route("newCRC", name="newCRC")
     * @param EntityManagerInterface $manager
     */
    public function createCRC(EntityManagerInterface $manager)
    {
//        $nbResa = $_POST['nombre'];

        /*
         * function de validité des données.
         */
        function valid_donnees($donnees){
            $donnees = trim($donnees);
            $donnees = stripslashes($donnees);
            $donnees = htmlspecialchars($donnees);
            return $donnees;
        }

        $resa = new CRC();

        $resa->setName(valid_donnees($_POST["name"]));
        $resa->setMail(valid_donnees($_POST["firstname"]));
        $resa->setBbq(valid_donnees($_POST["bbq"]));
        $resa->setActivity(valid_donnees($_POST["activity"]));
        $resa->setCoffee("unused");
        $resa->setCar("unused");
        $resa->setVisite("unused");
        $resa->setRrn("unused");

        $manager->persist($resa);
        $manager->flush();

//        for($i = 1; $i < $nbResa+1 ; $i++ )
//        {
//            $resa = new CRC();
//
//            $resa->setName(valid_donnees($_POST["Name".$i]));
//            $resa->setMail(valid_donnees($_POST["eMail"]));
//            $resa->setRrn(valid_donnees($_POST["rrn".$i]));
//            $resa->setCar(valid_donnees($_POST["nimma"]));
//            $resa->setBbq(valid_donnees($_POST["bbq".$i]));
//            if(isset($_POST["tarte".$i]))
//            {
//                $resa->setCoffee("true");
//            }
//            else
//            {
//                $resa->setCoffee("false");
//            }
//            if (isset($_POST["activite".$i]))
//            {
//                $resa->setActivity("true");
//            }
//            else
//            {
//                $resa->setActivity("false");
//            }
//            if (isset($_POST["visite".$i]))
//            {
//                $resa->setVisite("true");
//            }
//            else
//            {
//                $resa->setVisite("false");
//            }
//            $manager->persist($resa);
//            $manager->flush();
//        }

        $this->addFlash(
            'success',
            'registration ok'
        );
        return $this->render('crc/index.html.twig');
    }
}
