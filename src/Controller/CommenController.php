<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommenController extends AbstractController
{
    #[Route('/commen', name: 'app_commen')]
    public function index(): Response
    {
        return $this->render('commen/index.html.twig', [
            'controller_name' => 'CommenController',
        ]);
    }
}
