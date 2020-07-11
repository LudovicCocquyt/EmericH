<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Realisations;
use App\Entity\StaticContent;
use App\Entity\Images;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        //fixture User Admin
		$user = new User;
		$now  = new \Datetime;

        $user->setUsername('admin')
             ->setPassword($this->encoder->encodePassword($user, 'aa'))
        	 ->setemail('aa@aa.fr')
             ->setIsActif(true)
             ->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);


        //fixture content static
        $contentOne   = new StaticContent;
        $contentTwo   = new StaticContent;
        $contentThree = new StaticContent;
        $contentFour  = new StaticContent;
        $contentFive  = new StaticContent;
        $contentSix   = new StaticContent;
        $contentSeven = new StaticContent;

        $contentOne->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Présentation 1')
        ->setContent("Auto-entrepreneur du bâtiment situé à Trith Saint Léger (59), je vous propose mes services pour vos travaux.");
        $manager->persist($contentOne);

        $contentTwo->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('TVA')
        ->setContent("En me confiant vos travaux vous bénéficiez d'une TVA non applicable.	");
        $manager->persist($contentTwo);

        $contentThree->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Présentation 2')
        ->setContent("Terrassement - Maçonnerie - Couverture - Carrelage - Tout à l'égout - Menuiserie - Peinture - Plâtrerie	");
        $manager->persist($contentThree);

        $contentFour->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Adresse')
        ->setContent("23 rue Gustave Delory 59125 Trith Saint Leger");
        $manager->persist($contentFour);

        $contentFive->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Téléphone')
        ->setContent("06 50 42 27 37");
        $manager->persist($contentFive);

        $contentSix->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Email')
        ->setContent("cousinHub@gmail.com");
        $manager->persist($contentSix);

        $contentSeven->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setTitle('Lien iframe de google')
        ->setContent('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2546.6910821867273!2d3.5016645157272066!3d50.33501437945947!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c2ed00ef2c147d%3A0x3efbec32d3410730!2s23%20Rue%20Gustave%20Delory%2C%2059125%20Trith-Saint-L%C3%A9ger!5e0!3m2!1sfr!2sfr!4v1592496177330!5m2!1sfr!2sfr');
        $manager->persist($contentSeven);

        //fixture realisation
        //One
        $realisationOne = new Realisations;
        $realisationOne->setTitle('Chantier')
                       ->setDescription('Après rénovations')
                       ->setSection('Intérieur');
        $manager->persist($realisationOne);

        $imageOne = new Images;
        $imageOne->setRealisations($realisationOne)
                 ->setName('apresrenov3.jpg');
        $manager->persist($imageOne);

        //Two
        $realisationTwo = new Realisations;
        $realisationTwo->setTitle('Chantier')
                       ->setDescription('Après rénovations')
                       ->setSection('Intérieur');
        $manager->persist($realisationTwo);

        $imageTwo = new Images;
        $imageTwo->setRealisations($realisationTwo)
                 ->setName('apresrenov2.jpg');
        $manager->persist($imageTwo);

        //Three
        $realisationThree = new Realisations;
        $realisationThree->setTitle('Chantier')
                         ->setDescription('Début de chantier')
                         ->setSection('Intérieur');
        $manager->persist($realisationThree);

        $imageThree = new Images;
        $imageThree->setRealisations($realisationThree)
                   ->setName('debutchantier3.jpg');
        $manager->persist($imageThree);

        //Four
        $realisationFour = new Realisations;
        $realisationFour->setTitle('Chantier')
                        ->setDescription('Début de chantier')
                        ->setSection('Intérieur');
        $manager->persist($realisationFour);

        $imageFour = new Images;
        $imageFour->setRealisations($realisationFour)
                  ->setName('debutchantier2.jpg');
        $manager->persist($imageFour);

        //Five
        $realisationFive = new Realisations;
        $realisationFive->setTitle('Chantier')
                        ->setDescription('Cuisine après rénovations')
                        ->setSection('Intérieur');
        $manager->persist($realisationFive);

        $imageFive = new Images;
        $imageFive->setRealisations($realisationFive)
                  ->setName('cuisineapresrenov.jpg');
        $manager->persist($imageFive);

        //Six
        $realisationSix = new Realisations;
        $realisationSix->setTitle('Chantier')
                       ->setDescription('Cuisine avant rénovations')
                       ->setSection('Intérieur');
        $manager->persist($realisationSix);

        $imageSix = new Images;
        $imageSix->setRealisations($realisationSix)
                 ->setName('cuisineavantrenov.jpg');
        $manager->persist($imageSix);

        //Seven
        $realisationSeven = new Realisations;
        $realisationSeven->setTitle('Chantier')
                         ->setDescription('Après rénovation complète')
                         ->setSection('Intérieur');
        $manager->persist($realisationSeven);

        $imageSeven = new Images;
        $imageSeven->setRealisations($realisationSeven)
                   ->setName('apresrenov.jpg');
        $manager->persist($imageSeven);

        //Eight
        $realisationEight = new Realisations;
        $realisationEight->setTitle('Chantier')
                         ->setDescription('Début de chantier')
                         ->setSection('Intérieur');
        $manager->persist($realisationEight);

        $imageEight = new Images;
        $imageEight->setRealisations($realisationEight)
                   ->setName('debutchantier.jpg');
        $manager->persist($imageEight);

        //Nine
        $realisationNine = new Realisations;
        $realisationNine->setTitle('Chantier')
                        ->setDescription('Début de chantier mur de soutenement')
                        ->setSection('Maçonnerie');
        $manager->persist($realisationNine);

        $imageNine = new Images;
        $imageNine->setRealisations($realisationNine)
                  ->setName('debutchantier2.jpg');
        $manager->persist($imageNine);



        $manager->flush();
    }
}
