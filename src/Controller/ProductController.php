<?php

namespace App\Controller;

use App\Services\ProductServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class ProductController extends AbstractController
{
    #[Route('/product', name: 'app_product')]
    public function index(): Response
    {
        return $this->render('product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
    // post
    #[Route("/post/product", name: "product", methods: "POST")]
    public function product(Request $request, ProductServices $adminServices)
    {
        $Users = $adminServices->_product($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle
    #[Route('/product/getsingle/{id}', name: 'getSingleproduct', methods: 'GET')]
    public function singleproduct($id, ProductServices $productServices)
    {
        $result = $productServices->_singleproduct($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getall
    #[Route('/product/getall', name: 'getAllproduct', methods: 'GET')]
    public function getAllproduct(ProductServices $productServices)
    {
        $result = $productServices->_getAllproduct();
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // delete
    #[Route('/product/delete/{id}', name: 'deleteproduct', methods: 'GET')]
    public function deleteproduct($id, ProductServices $productServices)
    {
        $result = $productServices->_deleteproduct($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // update
    #[Route('/product/update/{id}', name: 'updateproduct', methods: 'POST')]
    public function updateproduct($id,Request $request, ProductServices $productServices)
    {
        $result = $productServices->_updateproduct($id,$request);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
}

