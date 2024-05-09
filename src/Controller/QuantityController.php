<?php

namespace App\Controller;

use App\Services\QuantityServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class QuantityController extends AbstractController
{
    #[Route('/quantity', name: 'app_quantity')]
    public function index(): Response
    {
        return $this->render('quantity/index.html.twig', [
            'controller_name' => 'QuantityController',
        ]);
    }
    // post
    #[Route("/post/Quantity", name: "Quantity", methods: "POST")]
    public function quantiy(Request $request, QuantityServices $QuantityServices)
    {
        $Users = $QuantityServices->_quantiy($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    
   
    // getAll
    #[Route("/all/Quantity", name: "Quantityall", methods: "GET")]
    public function quantiygetall(Request $request, QuantityServices $QuantityServices)
    {
        $Users = $QuantityServices->_quantiygetall($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    } 
    // getsingle
    #[Route('/quantity/getsingle/{id}', name: 'getSinglequantity', methods: 'GET')]
    public function singlequantity($id, QuantityServices $QuantityServices)
    {
        $result = $QuantityServices->_singlequantity($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // Delete
    #[Route('/quantity/Delete/{id}', name: 'Delete', methods: 'GET')]
    public function deletequantity($id, QuantityServices $QuantityServices)
    {
        $result = $QuantityServices->_deletequantity($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // update
    #[Route('/quantity/update/{id}', name: 'quantityupdate', methods: 'GET')]
    public function updatequantity($id,Request $request, QuantityServices $QuantityServices)
    {
        $result = $QuantityServices->_updatequantity($id,$request);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
}
