<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QcmController extends AbstractController
{
    /**
     * @Route("/", name="qcm")
     */
    public function index(): Response
    {
        return $this->render('qcm/index.html.twig', [
            'controller_name' => 'Qcm App',
        ]);
    }
}
