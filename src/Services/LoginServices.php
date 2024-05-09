<?php

namespace App\Services;

use App\Entity\Refcompany;
use App\Entity\Vendors;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use Doctrine\ORM\EntityManager;
use Exception;
use LDAP\Result;
use PhpParser\Builder\Class_;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\VarDumper\Cloner\Data;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bundle\SecurityBundle\SecurityBundle;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class LoginServices
{

    private $EM;
    public  function __construct(EntityManagerInterface $EM)
    {
        $this->EM = $EM;
    }
    // register
    public function _users($request)
    {
        $compna = $request->get('CompanyName');

        $filee = $request->file->getLogo('Logo');
        $filname = $filee->getClientOriginalName();
        $directory = "Logo/" . $compna ;
        $filepath=$directory. "/". $filname;

        $filee->move($directory,$filname);

        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Refcompany::class, 'json');

        // $file = $filee->move("Logo/" . $compna . "/" . $filname);

        $reg = new Refcompany;
        $reg->setCompanyName($compna);
        $reg->setLogo($filepath);
        $reg->setEmail($data->getEmail());
        $encript = $this->encryptPassword($data->getPassword());
        $reg->setPassword($encript);
        $reg->setPhoneNo($data->getPhoneNo());
        $reg->setAddress($data->getAddress());
        $reg->setState($data->getState());
        $reg->setDistrict($data->getDistrict());
        $reg->setPinCode($data->getPinCode());

        $this->EM->persist($reg);
        $this->EM->flush();

        return $reg;
    }
    // Login
    private $encryptionKey = 'YourEncryptionKey';
    public function _login($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Refcompany::class, 'json');

        $repo = $this->EM->getRepository(Refcompany::class);
        $user = $repo->findOneBy(['Email' => $data->getEmail()]);
        $passwordUser = $user->getPassword();
        $pass = $data->getPassword();
        $decryptedPassword = $this->decryptPassword($passwordUser);
        if ($decryptedPassword == $pass) {
            return $user;
        } else {
            return "error";
        }
    }

    private function encryptPassword($password)
    {
        // Encrypt the password using AES encryption
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encryptedPassword = openssl_encrypt($password, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
        return base64_encode($encryptedPassword . '::' . $iv);
    }

    private function decryptPassword($encryptedPassword)
    {
        // Decrypt the password using AES decryption
        list($encryptedPassword, $iv) = explode('::', base64_decode($encryptedPassword), 2);
        $decryptedPassword = openssl_decrypt($encryptedPassword, 'aes-256-cbc', $this->encryptionKey, 0, $iv);
        return $decryptedPassword;
    }

    // post
    public function _vendors($request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $content = $request->getContent();
        $data = $serializer->deserialize($content, Vendors::class, 'json');
        $comrepo = $this->EM->getRepository(Refcompany::class);
        $companyId = $comrepo->findOneBy(['id' => $data->getCompanyId()]);
        if ($companyId == null) {
            return 'invalide company Id';
        }
        $ven = new Vendors;
        $ven->setName($data->getName());
        $ven->setEmail($data->getEmail());
        $ven->setPhoneNo($data->getPhoneNo());
        $ven->setAddress($data->getAddress());
        $ven->setState($data->getState());
        $ven->setDistrict($data->getDistrict());
        $ven->setPinCode($data->getPinCode());
        $ven->setGSTnumber($data->getGSTnumber());
        $ven->setCompany($companyId);

        $this->EM->persist($ven);
        $this->EM->flush();

        return $ven;
    }
    // getsingle
    public function _getSinglevendor($id)
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $venId = $venrepo->findOneBy(['id' => $id]);
        if ($venId == null) {
            return 'invalide vendors Id';
        }
        return $venId;
    }
    // getAll
    public function _getAllvendor()
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $venall = $venrepo->findAll();
        return $venall;
    }
    // delete
    public function _deletevendor($id)
    {
        $venrepo = $this->EM->getRepository(Vendors::class);
        $del = $venrepo->findOneBy(['id' => $id]);
        if ($del == null) {
            return 'invalid Vendor id';
        }
        $this->EM->remove($del);
        $this->EM->flush();
        return 'Delete sucessfully';
    }
    // update
    public function _vendorUpdate($id, $request)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        $data = $serializer->deserialize($content, Vendors::class, 'json');

        $venrepo = $this->EM->getRepository(Vendors::class);
        $updobj = $venrepo->findOneBy(['id' => $id]);
        if ($updobj == null) {
            return 'Invalide Vendors Id';
        }
        // $objrepo = $this->EM->getRepository(Refcompany::class);
        // $comprev = $objrepo->findOneBy(['id' => $data->getCompanyId()]);
        // if ($comprev == null) {
        //     return ["error", "invalid company id"];
        // }
        $quarep = $this->EM->getRepository(Refcompany::class);
        $quaid = $quarep->findOneBy(['id' => $data->getCompanyId()]);
        if ($quaid == null) {
            return 'invalide quantity id';
        }
        $updobj->setCompany($quaid);

        $vendorname = $data->getName('Name');
        if ($vendorname) {
            $updobj->setName($vendorname);
        }
        $vendoremail = $data->getEmail('Email');
        if ($vendoremail) {
            $updobj->setEmail($vendoremail);
        }
        $vendorphone = $data->getPhoneNo('PhoneNo');
        if ($vendorphone) {
            $updobj->setPhoneNo($vendorphone);
        }
        $vendoradd = $data->getAddress('Address');
        if ($vendoradd) {
            $updobj->setAddress($vendoradd);
        }
        $vendorstate = $data->getState('State');
        if ($vendorstate) {
            $updobj->setState($vendorstate);
        }
        $vendordis = $data->getDistrict('District');
        if ($vendordis) {
            $updobj->setDistrict($vendordis);
        }
        $vendorpin = $data->getPinCode('PinCode');
        if ($vendorpin) {
            $updobj->setPinCode($vendorpin);
        }
        $vendorgst = $data->getGSTnumber('GSTnumber');
        if ($vendorgst) {
            $updobj->setGSTnumber($vendorgst);
        }
        $this->EM->persist($updobj);
        $this->EM->flush();
        return ["okk", $updobj];
    }
}
