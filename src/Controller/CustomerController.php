<?php

namespace App\Controller;

use App\Utils\ApiResponse;
use App\Services\CustomerServices;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class CustomerController extends AbstractController
{
    #[Route('/customer', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'controller_name' => 'CustomerController',
        ]);
    }
    // post

    #[Route("/customers", name: "customers", methods: 'POST')]
    public function customer(Request $request, CustomerServices $CustomerServices)
    {
        $Users = $CustomerServices->_customer($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle
    #[Route('/customer/getsingle/{id}', name: 'getSinglecustomer', methods: 'GET')]
    public function getSinglecustomer($id, CustomerServices $CustomerServices)
    {
        $result = $CustomerServices->_getSinglecustomer($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getAll
    #[Route("/getall/customer", name: "getallcustomer", methods: "GET")]
    public function customergetall(CustomerServices $CustomerServices)
    {
        $Users = $CustomerServices->_customergetall();
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // delete
    #[Route('/customer/delete/{id}', name: 'deletecustomer', methods: 'GET')]
    public function deletecustomer($id, CustomerServices $CustomerServices)
    {
        $result = $CustomerServices->_deletecustomer($id);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    //update
    #[Route('/customer/update/{id}', name: 'updatecustomer', methods: 'POST')]
    public function updatecustomer($id, Request $request, CustomerServices $CustomerServices)
    {
        $result = $CustomerServices->_updatecustomer($id, $request);
        if ($result == "invalid id") {
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
}
