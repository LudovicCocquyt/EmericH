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
        $realisation = new Realisations;

        $realisation->setTitle('Ma réalisation')
                    ->setDescription('La description de ma réalisation')
                    ->setSection('Sol');
        $manager->persist($realisation);

        $image = new Images;
        $image->setRealisations($realisation)
              ->setName('not_delete.png');
        $manager->persist($image);

        $manager->flush();
    }
}
