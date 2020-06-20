<?php

namespace App\DataFixtures;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\StaticContent;
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
		$user = new User;
		$now  = new \Datetime;

        $user->setUsername('admin')
             ->setPassword($this->encoder->encodePassword($user, 'aa'))
        	 ->setemail('aa@aa.fr')
             ->setIsActif(true)
             ->setRoles(['ROLE_USER']);

        $manager->persist($user);

		$contentOne   = new StaticContent;
		$contentTwo   = new StaticContent;
		$contentThree = new StaticContent;

        $contentOne->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setContent("Auto-entrepreneur du bâtiment situé à Trith Saint Léger (59), je vous propose mes services pour vos travaux.");
        $manager->persist($contentOne);

        $contentTwo->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setContent("En me confiant vos travaux vous bénéficiez d'une TVA non applicable.	");
        $manager->persist($contentTwo);

        $contentThree->setCreatedAt($now)
        ->setCreatedBy('admin')
        ->setUpdatedAt($now)
        ->setUpdatedBy('admin')
        ->setContent("Terrassement - Maçonnerie - Couverture - Carrelage - Tout à l'égout - Menuiserie - Peinture - Plâtrerie	");
        $manager->persist($contentThree);

        $manager->flush();
    }
}
