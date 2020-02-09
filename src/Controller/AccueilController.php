<?php

namespace App\Controller;

use App\Repository\PortableRepository;
use App\Controller\Portable2Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Portable;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index()
    {   
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }

}
