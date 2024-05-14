<?php

namespace App\Services;

use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\QuantityType;
use App\Entity\Refcompany;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class CustomerServices
{
    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // post
    public function _customer($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Customer::class, 'json');



        $cus = new Customer;
        $cus->setCustomerName($data->getCustomerName());
        $cus->setPhoneNo($data->getPhoneNo());

        $this->EM->persist($cus);
        $this->EM->flush();
        return $cus;
    }
    // getsingle
    public function _getSinglecustomer($id)
    {
        $admrepo = $this->EM->getRepository(Customer::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return "invalide Admin Id";
        }
        return $admid;
    }
    //getall
    public function _customergetall()
    {
        $admrepo = $this->EM->getRepository(Customer::class);
        $admall = $admrepo->findAll();
        return $admall;
    }
    // delete
    public function _deletecustomer($id)
    {
        $admrepo = $this->EM->getRepository(Customer::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return 'invalide admin id';
        }
        $this->EM->remove($admid);
        $this->EM->flush();
        return "delete sucessfully";
    }
    // update
    public function _updatecustomer($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Customer::class, 'json');

        $cusrepo = $this->EM->getRepository(Customer::class);
        $upcus = $cusrepo->findOneBy(['id' => $id]);
        if ($upcus == null) {
            return 'invalide customer id';
        }

        $cusname = $data->getCustomerName('customerName');
        if ($cusname) {
            $upcus->setCustomerName($cusname);
        }
        $cuspho = $data->getPhoneNo('PhoneNo');
        if ($cuspho) {
            $upcus->setPhoneNo($cuspho);
        }
        $this->EM->persist($upcus);
        $this->EM->flush();
        return ['delete sucessfully', $upcus];
    }
}
