<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StaticContentRepository;

class HomeController extends AbstractController
{
    /**
     * [home description]
     * @param  StaticContentRepository $staticContentRepository [description]
     * @return [Objects]
     * 
     * @Route("/", name="index_page")
     */
    public function home(StaticContentRepository $staticContentRepository)
    {

    	return $this->render('homePage.html.twig',[
        		'StaticContents' => $staticContentRepository->findAll(),
    	]);
	}
}