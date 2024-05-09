<?php

namespace App\Services;

use App\Entity\Product;
use App\Entity\Refcompany;
use App\Utils\ApiResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


class ProductServices
{

    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // post
    public function _product($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Product::class, 'json');

        $comprep = $this->EM->getRepository(Refcompany::class);
        $compId = $comprep->findOneBy(['id' => $data->getCompanyId()]);
        if ($compId == null) {
            return 'invalide company id';
        }
        $pro = new Product;
        $pro->setCompany($compId);
        $pro->setName($data->getName());
        $pro->setDescription($data->getDescription());
        $pro->setStatus($data->getStatus());
        $pro->setHsfcCode($data->getHsfcCode());

        $this->EM->persist($pro);
        $this->EM->flush();
        return $pro;
    }
    // getsingle
    public function _singleproduct($id)
    {
        $prorep = $this->EM->getRepository(Product::class);
        $proid = $prorep->findOneBy(['id' => $id]);
        if ($proid == null) {
            return 'invalide product id';
        }
        return $proid;
    }
    // getall
    public function _getAllproduct()
    {
        $prorepo = $this->EM->getRepository(Product::class);
        $proall = $prorepo->findAll();
        if ($proall == null) {
            return 'invalide product';
        }
        return $proall;
    }
    // delete
    public function _deleteproduct($id)
    {
        $prorepo = $this->EM->getRepository(Product::class);
        $proid = $prorepo->findOneBy(['id' => $id]);
        if ($proid == null) {
            return 'invalide product id';
        }
        $this->EM->remove($proid);
        $this->EM->flush();
        return 'delete sucessfully';
    }
    // update
    public function _updateproduct($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Product::class, 'json');

        $prorepo = $this->EM->getRepository(Product::class);
        $uppro = $prorepo->findOneBy(['id' => $id]);
        if ($uppro == null) {
            return 'invalide product id';
        }
       
        $quarep=$this->EM->getRepository(Refcompany::class);
        $quaid=$quarep->findOneBy(['id'=>$data->getCompanyId()]);
        if($quaid==null){
            return 'invalide quantity id';
        }
            $uppro->setCompany($quaid);
        
        $proname = $data->getName('name');
        if ($proname) {
            $uppro->setName($proname);
        }
        $prodes = $data->getDescription('description');
        if ($prodes) {
            $uppro->setDescription($prodes);
        }
        $prosts = $data->getStatus('status');
        if ($prosts) {
            $uppro->setStatus($prosts);
        }
        $porhsc = $data->getHsfcCode('hsfcCode');
        if ($porhsc) {
            $uppro->setHsfcCode($porhsc);
        }
        $this->EM->persist($uppro);
        $this->EM->flush();
        return ['okk', $uppro];
    }
}
