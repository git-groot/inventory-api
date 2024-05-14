<?php

namespace App\Services;

use App\Entity\Customer;
use App\Entity\BillDetails;
use App\Entity\Bills;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommenServices
{
    private $EM;
    public function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }

    public function _Bills($request)
    {
        $encoders = [new JsonEncode()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Bills::class, 'json');

        

    }
}
