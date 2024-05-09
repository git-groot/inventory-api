<?php

namespace App\Controller;

use App\Utils\ApiResponse;
use App\Services\InventoryServices;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InventoryController extends AbstractController
{
    #[Route('/inventory', name: 'app_inventory')]
    public function index(): Response
    {
        return $this->render('inventory/index.html.twig', [
            'controller_name' => 'InventoryController',
        ]);
    }
     // post

     #[Route("/Inventorys", name: "Inventorys", methods: 'POST')]
     public function Inventory(Request $request, InventoryServices $InventoryServices)
     {
         $Users = $InventoryServices->_Inventory($request);
         return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
     }
     // getsingle
     #[Route('/Inventory/getsingle/{id}', name: 'getSingleInventory', methods: 'GET')]
     public function getSingleInventory($id, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_getSingleInventory($id);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
     // getAll
     #[Route("/getall/Inventory", name: "getallInventory", methods: "GET")]
     public function Inventorygetall(InventoryServices $InventoryServices)
     {
         $Users = $InventoryServices->_Inventorygetall();
         return new ApiResponse($Users, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "_initializer", "cloner", "isInitialized_", "password"]);
     }
     // delete
     #[Route('/Inventory/delete/{id}', name: 'deleteInventory', methods: 'GET')]
     public function deleteInventory($id, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_deleteInventory($id);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
     //update
     #[Route('/Inventory/update/{id}', name: 'updateInventory', methods: 'POST')]
     public function updateInventory($id, Request $request, InventoryServices $InventoryServices)
     {
         $result = $InventoryServices->_updateInventory($id, $request);
         if ($result == "invalid id") {
             return new ApiResponse([], 400, ["Content-Type" => "application/json"], 'json', $result, ['timezone']);
         }
         return new ApiResponse($result, 200, ["Content-Type" => "application/json"], 'json', "Success", ['timezone', "__initializer__", "__cloner__", "__isInitialized__"]);
     }
}
