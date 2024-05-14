<?php

namespace App\Services;

use App\Entity\Product;
use App\Entity\QuantityType;
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
        $proname = $request->get('name');
        $prodes = $request->get('description');
        $prostat = $request->get('status');
        $prohsc = $request->get('hsfcCode');
        $proqua = $request->get('Quantity');
        $promes = $request->get('Mesarment');
        $prounit = $request->get('Units');
        $proprice = $request->get('buyingPrice');
        $progst = $request->get('gst');
        $procgst = $request->get('cgst');
        $prosgst = $request->get('sgst');

        $Comrep = $this->EM->getRepository(Refcompany::class);
        $company = $request->get('companyId');
        $compid = $Comrep->findOneBy(['id' => $company]);
        if ($compid == null) {
            return "invalide company id";
        }
        $pro = new Product;
        $pro->setName($proname);
        $pro->setDescription($prodes);
        $pro->setStatus($prostat);
        $pro->setHsfcCode($prohsc);
        $pro->setCompany($compid);
        $pro->setQuantity($proqua);
        $pro->setMesarment($promes);
        $pro->setUnits($prounit);
        $pro->setBuyingPrice($proprice);
        $pro->setGst($progst);
        $pro->setCgst($procgst);
        $pro->setSgst($prosgst);
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
        dd($data);
        $prorepo = $this->EM->getRepository(Product::class);
        $uppro = $prorepo->findOneBy(['id' => $id]);
        if ($uppro == null) {
            return 'invalide product id';
        }
        $companurepo = $this->EM->getRepository(Refcompany::class);
        $company = $data->getCompanyId();


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
        $porhscode = $data->getHsfcCode('hsfcCode');
        if ($porhscode) {
            $uppro->setHsfcCode($porhscode);
        }
        $proquantity = $data->getQuantity('Quantity');
        if ($proquantity == null) {
            $uppro->setQuantity($proquantity);
        }
        dd($porhscode);
        $promesarment = $data->getMesarment('Mesarment');
        if ($promesarment == null) {
            $uppro->setMesarment($promesarment);
        }
        $prounits = $data->getUnits('Units');
        if ($prounits == null) {
            $uppro->setUnits($prounits);
        }
        $probuyprice = $data->getBuyingPrice('buyingPrice');
        if ($probuyprice == null) {
            $uppro->setBuyingPrice($probuyprice);
        }
        $progst = $data->getGst('gst');
        if ($progst == null) {
            $uppro->setGst($progst);
        }
        $procgst = $data->getCgst('cgst');
        if ($procgst == null) {
            $uppro->setCgst($procgst);
        }
        $prosgst = $data->getSgst('sgst');
        if ($prosgst == null) {
            $uppro->setSgst($prosgst);
        }

        $companyid = $companurepo->findOneBy(['id' => $company]);
        if ($companyid == null) {
            return 'invalide company id';
        }
        $uppro->setCompany($companyid);


        $this->EM->persist($uppro);
        $this->EM->flush();
        return ['okk', $uppro];
    }
}
