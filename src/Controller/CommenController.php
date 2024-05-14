<?php

namespace App\Controller;

use App\Services\CommenServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    #[Route("/post/bill", name: "bills", methods: "POST")]
    public function Bills(Request $request, CommenServices $CommenServices)
    {
        $Users = $CommenServices->_Bills($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
   
}
