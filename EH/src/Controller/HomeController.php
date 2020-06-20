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

    // /*
    //  * @Route("/administration", name="adm_page")
    //  */
    // public function homeAdm(UserRepository $userRepository, TeamRepository $teamRepository, LineUpRepository $lineUpRepository)
    // {
    //     if ($_POST) {
    //         $teamInfo = $teamRepository->findBy(['name'=> $_POST['infoTeam']])[0];
    //         $userInfo = $teamInfo->getUser()->toArray();
    //         return $this->render('admin/homeAdmin.html.twig', [
    //                     // 'session' => $session,
    //                     'lineUps' => $lineUpRepository->findAll(),
    //                     'teams'   => $teamRepository->findAll(),
    //                     'users'   => $userRepository->findAll(),
    //                     'teamInfo'=> $teamInfo,
    //                     'userInfos' => $userInfo
    //         ]);
    //     }
    //     return $this->render('admin/homeAdmin.html.twig', [
    //                     // 'session' => $session,
    //                     'lineUps' => $lineUpRepository->findAll(),
    //                     'teams'   => $teamRepository->findAll(),
    //                     'users'   => $userRepository->findAll()
    //     ]);
    // }
}