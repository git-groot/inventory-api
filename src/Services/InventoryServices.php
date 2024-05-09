<?php

namespace App\Services;

use App\Entity\Customer;
use App\Entity\Inventory;
use App\Entity\Product;
use App\Entity\QuantityType;
use App\Entity\Refcompany;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class InventoryServices
{
    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // post
    public function _Inventory($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Inventory::class, 'json');

        $quarep = $this->EM->getRepository(QuantityType::class);
        $quaid = $quarep->findOneBy(['id' => $data->getQuantitysId()]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        $qurep = $this->EM->getRepository(Refcompany::class);
        $comid = $qurep->findOneBy(['id' => $data->getCompanyId()]);
        if ($comid == null) {
            return 'invalide quantity id';
        }
        $qrep = $this->EM->getRepository(Product::class);
        $proid = $qrep->findOneBy(['id' => $data->getProductId()]);
        if ($proid == null) {
            return 'invalide quantity id';
        }

        $inv = new Inventory;
        $inv->setQuantity($data->getQuantity());
        $inv->setBuyingPrice($data->getBuyingPrice());
        $inv->setSelinPrice($data->getSelinPrice());
        $inv->setQuantitys($quaid);
        $inv->setCompany($comid);
        $inv->setProduct($proid);

        $this->EM->persist($inv);
        $this->EM->flush();
        return $inv;
    }
    // getsingle
    public function _getSingleInventory($id)
    {
        $admrepo = $this->EM->getRepository(Inventory::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return "invalide Admin Id";
        }
        return $admid;
    }
    // getAll
    public function _Inventorygetall()
    {
        $admrepo = $this->EM->getRepository(Inventory::class);
        $admall = $admrepo->findAll();
        return $admall;
    }
    // deleete
    public function _deleteInventory($id)
    {
        $admrepo = $this->EM->getRepository(Inventory::class);
        $admid = $admrepo->findOneBy(['id' => $id]);
        if ($admid == null) {
            return 'invalide inventory id';
        }
        $this->EM->remove($admid);
        $this->EM->flush();
        return "delete sucessfully";
    }
    // update
    public function _updateInventory($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Inventory::class, 'json');

        $quarepi = $this->EM->getRepository(Inventory::class);
        $upin = $quarepi->findOneBy(['id' => $id]);
        if ($upin == null) {
            return 'invalide inventory id';
        }

        $quarep = $this->EM->getRepository(QuantityType::class);
        $quaid = $quarep->findOneBy(['id' => $data->getQuantitysId()]);
        // if ($quaid == null) {
        //     return 'invalide quantityType id';
        // }
        $upin->setQuantitys($quaid);

        $qurep = $this->EM->getRepository(Refcompany::class);
        $quid = $qurep->findOneBy(['id' => $data->getCompanyId()]);
        // if ($quid == null) {
        //     return 'invalide company id';
        // }
        $upin->setCompany($quid);

        $qrep = $this->EM->getRepository(Product::class);
        $qid = $qrep->findOneBy(['id' => $data->getProductId()]);
        // if ($qid == null) {
        //     return 'invalide product id';
        // }
        $upin->setProduct($qid);

        $quantire = $data->getQuantity('Quantity');
        if ($quantire) {
            $upin->setQuantity($quantire);
        }
        $buy = $data->getBuyingPrice('BuyingPrice');
        if ($buy) {
            $upin->setBuyingPrice($buy);
        }
        $sel = $data->getSelinPrice('SelinPrice');
        if ($sel) {
            $upin->setSelinPrice($sel);
        }
        $this->EM->persist($upin);
        $this->EM->flush();
        return ['update sucessfully', $upin];
    }
}
