<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StaticContentRepository;
use App\Repository\RealisationsRepository;


class HomeController extends AbstractController
{
    /**
     * [home description]
     * @param  StaticContentRepository $staticContentRepository [description]
     * @return [Objects]
     * 
     * @Route("/", name="index_page")
     */
    public function home(StaticContentRepository $staticContents, RealisationsRepository $realisations)
    {
        //dd($realisations->findby(['section' => 'Intérieur'])
        //[0]->getImages()->toArray()[0]->getname());

    	return $this->render('homePage.html.twig',[
                'StaticContents' => $staticContents->findAll(),
                'interieurs'     => $realisations->findby(['section' => 'Intérieur']),
                'terrassements'  => $realisations->findby(['section' => 'Terrassement']),
                'sols'           => $realisations->findby(['section' => 'Sol']),
                'maconneries'    => $realisations->findby(['section' => 'Maçonnerie']),
                'divers'         => $realisations->findby(['section' => 'Divers'])
    	]);
	}
}