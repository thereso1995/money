<?php

namespace App\DataFixtures;

use App\Entity\Profil;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder=$encoder;
    }
    public function load(ObjectManager $manager)
    {
        
        $actif='Actif';
        $profilSup=new Profil();
        $profilSup->setLibelle('SuperAdmin');
        $manager->persist($profilSup);
        
        $profilCaiss=new Profil();
        $profilCaiss->setLibelle('Caissier');
        $manager->persist($profilCaiss);
        
        $profilAdP=new Profil();
        $profilAdP->setLibelle('AdminPrincipal');
        $manager->persist($profilAdP);
        
        $profilAdm=new Profil();
        $profilAdm->setLibelle('Admin');
        $manager->persist($profilAdm);
        
        $profilUtil=new Profil();
        $profilUtil->setLibelle('utilisateur');
        $manager->persist($profilUtil);
        
        $SupUser=new User();
        $motDePass=$this->encoder->encodePassword($SupUser, 'pass');
        $SupUser->setUsername('therese')
             ->setRoles(['ROLE_SuperAdmin'])
             ->setPassword($motDePass)
             ->setNom('Therese')
             ->setEmail('thesou@gmail.com')
             ->setTelephone('77 464 95 76')
             ->setNci(strval(rand(150000000,979999999)))
             ->setStatut($actif);
        $manager->persist($SupUser);
        $manager->flush();
    }
}
