<?php

namespace App\Services;

use App\Entity\Users;
use App\Utils\ApiResponse;
use App\Controller\AdminController;
use App\Entity\Refcompany;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Builder\Use_;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class AdminServices
{

    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // post
    public function _admin($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Users::class, 'json');
        $comrep = $this->EM->getRepository(Refcompany::class);
        $comid = $comrep->findOneBy(['id' => $data->getCompanyId()]);
        if ($comid == null) {
            return "invalide Company Id";
        }

        $adm = new Users;
        $adm->setName($data->getName());
        $adm->setEmail($data->getEmail());
        $adm->setPhoneNo($data->getPhoneNo());
        $adm->setCompany($comid);
        $this->EM->persist($adm);
        $this->EM->flush();
        return $adm;
    }
    // getsingle
    public function _getSingleadmin($id)
    {
        $admrepo = $this->EM->getRepository(Users::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return "invalide Admin Id";
        }
        return $admid;
    }
    // getAll
    public function _admingetall()
    {
        $admrepo = $this->EM->getRepository(Users::class);
        $admall = $admrepo->findAll();
        return $admall;
    }
    // delete
    public function _deleteadmin($id)
    {
        $admrepo = $this->EM->getRepository(Users::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return 'invalide admin id';
        }
        $this->EM->remove($admid);
        $this->EM->flush();
        return "delete sucessfully";
    }
    // update
    public function _updateadmin($id, $request)
    {

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Users::class, 'json');

        $admrepo = $this->EM->getRepository(Users::class);
        $updadm = $admrepo->findOneBy(['id' => $id]);
        if ($updadm == null) {
            return 'inalide admin id';
        }
        $quarep=$this->EM->getRepository(Refcompany::class);
        $quaid=$quarep->findOneBy(['id'=>$data->getCompanyId()]);
        if($quaid==null){
            return 'invalide quantity id';
        }
            $updadm->setCompany($quaid);
        
        $admname = $data->getName('Name');
        if ($admname) {
            $updadm->setName($admname);
        }
        $admemail = $data->getEmail('Email');
        if ($admemail) {
            $updadm->setEmail($admemail);
        }
        $admphone = $data->getPhoneNo('phoneNo');
        if ($admphone) {
            $updadm->setPhoneNo($admphone);
        }
        $this->EM->persist($updadm);
        $this->EM->flush();
        return ['okk', $updadm];
    }
}
