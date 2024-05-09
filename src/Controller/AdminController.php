<?php

namespace App\Controller;

use App\Services\AdminServices;
// use App\Services\AdminServices;
use App\Utils\ApiResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    // post
    #[Route("/post/admin", name: "saveadmin", methods: "POST")]
    public function admin(Request $request, AdminServices $adminServices)
    {
        $Users = $adminServices->_admin($request);
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // getsingle
    #[Route('/admin/getsingle/{id}', name: 'getSingleAdmin', methods: 'GET')]
    public function getSingleadmin($id, AdminServices $AdminServices)
    {
        $result = $AdminServices->_getSingleadmin($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    // getAll
    #[Route("/getall/admin", name: "getalladmin", methods: "GET")]
    public function admingetall( AdminServices $adminServices)
    {
        $Users = $adminServices->_admingetall();
        return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
    }
    // delete
    #[Route('/admin/delete/{id}', name: 'getSingleAdmin', methods: 'GET')]
    public function deleteadmin($id, AdminServices $AdminServices)
    {
        $result = $AdminServices->_deleteadmin($id);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
    //update
    #[Route('/admin/update/{id}', name: 'updateadmin', methods: 'POST')]
    public function updateadmin($id,Request $request, AdminServices $AdminServices)
    {
        $result = $AdminServices->_updateadmin($id,$request);
        if ($result == "invalid id"){
            return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
        }
        return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
    }
}
