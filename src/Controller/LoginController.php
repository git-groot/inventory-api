<?php

namespace App\Controller;

use App\Services\LoginServices;
use App\Services\VendorsServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
    

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function index(): Response
    {
        return $this->render('login/index.html.twig', [
            'controller_name' => 'LoginController',
        ]);
    }   
    // register
    #[Route("/api/register", name: "users", methods: "POST")]
    public function users(Request $request, LoginServices $loginService)
    {
        $Users = $loginService->_users($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // Login
    #[Route("/api/login", name: "usersLogin3", methods: "POST")]
    public function login(Request $request, LoginServices $loginService)
    {
        $Users = $loginService->_login($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "Password"]);
    }
    // post vendors
    #[Route("/post/vendors", name: "vendors", methods: "POST")]
    public function vendors(Request $request, LoginServices $loginService)
    {
        $Users = $loginService->_vendors($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle
    #[Route('/vendor/getsingle/{id}', name: 'getSinglevendor', methods: 'GET')]
    public function getSinglevendor($id, LoginServices $LoginService)
    {
        $result = $LoginService->_getSinglevendor($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getAll
    #[Route('/vendor/getall', name: 'getAllvendor', methods: 'GET')]
    public function getAllvendor(LoginServices $loginService)
    {
        $result = $loginService->_getAllvendor();
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // delete
    #[Route('/vendor/delete/{id}', name: 'delete', methods: 'PUT')]
    public function deletevendor($id, LoginServices $LoginService)
    {
        $result = $LoginService->_deletevendor($id);
        if ($result == "invalid vendor id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // update
    #[Route('/vendor/update/{id}', name: 'vendorupdate', methods: 'POST')]
    public function vendorUpdate($id, Request $request, LoginServices $loginService)
    {
        $result = $loginService->_vendorUpdate($id, $request);   
            if ($result[0] == "error"){
                return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result[1], ['timezone']);
            }
        return new ApiResponse($result[1], 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
}
