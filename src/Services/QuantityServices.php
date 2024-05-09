<?php

namespace App\Services;

use App\Entity\Product;
use App\Entity\QuantityType;
use App\Entity\Refcompany;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;



class QuantityServices
{

    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // post
    public function _quantiy($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, QuantityType::class, 'json');

        $comprep = $this->EM->getRepository(Refcompany::class);
        $compId = $comprep->findOneBy(['id' => $data->getCompanyId()]);
        if ($compId == null) {
            return 'invalide company id';
        }

        $prorep = $this->EM->getRepository(Product::class);
        $proid = $prorep->findOneBy(['id' => $data->getProductId()]);
        if ($proid == null) {
            return 'invalide product id';
        }

        $qua = new QuantityType;
        $qua->setQuantityName($data->getQuantityName());
        $qua->setMeserment($data->getMeserment());
        $qua->setUnits($data->getUnits());
        $qua->setPrice($data->getPrice());
        $qua->setStatus($data->getStatus());
        $qua->setCompany($compId);
        $qua->setProduct($proid);

        $this->EM->persist($qua);
        $this->EM->flush();
        return $qua;
    }
    // getsingle
    public function _singlequantity($id)
    {
        $quarep = $this->EM->getRepository(QuantityType::class);
        $quaid = $quarep->findOneBy(['id' => $id]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        return $quaid;
    }
    // getAll
    public function _quantiygetall()
    {
        $quarep = $this->EM->getRepository(QuantityType::class);
        $quaall = $quarep->findAll();
        return $quaall;
    }
    // delete
    public function _deletequantity($id)
    {
        $quarep = $this->EM->getRepository(QuantityType::class);
        $quaid = $quarep->findOneBy(['id' => $id]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        $this->EM->remove($quaid);
        $this->EM->flush();
        return 'delete sucessfully';
    }
    // update
    public function _updatequantity($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, QuantityType::class, 'json');

        $quarep = $this->EM->getRepository(QuantityType::class);
        $updqua = $quarep->findOneBy(['id' => $id]);
        if ($updqua == null) {
            return 'invalide quantity id';
        }
        $quarep = $this->EM->getRepository(Refcompany::class);
        $quaid = $quarep->findOneBy(['id' => $data->getCompanyId()]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        $updqua->setCompany($quaid);
        $quarep = $this->EM->getRepository(Product::class);
        $quaid = $quarep->findOneBy(['id' => $data->getProductId()]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        $updqua->setProduct($quaid);

        $quaname = $data->getQuantityName('quantityName');
        if ($quaname) {
            $updqua->setQuantityName($quaname);
        }
        $mesar = $data->getMeserment('meserment');
        if ($mesar) {
            $updqua->setMeserment($mesar);
        }
        $unit = $data->getUnits('units');
        if ($unit) {
            $updqua->setUnits($unit);
        }
        $price = $data->getPrice('price');
        if ($price) {
            $updqua->setPrice($price);
        }
        $stat = $data->getStatus('status');
        if ($stat) {
            $updqua->setStatus($stat);
        }
        $this->EM->persist($updqua);
        $this->EM->flush();
        return ['edit sucessfully', $updqua];
    }
}
