<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\StaticContentRepository;
use App\Repository\RealisationsRepository;
use App\Service\ContactService;


class HomeController extends AbstractController
{
    /**
     * [home description]
     * @param  StaticContentRepository $staticContentRepository [description]
     * @return [Objects]
     * 
     * @Route("/", name="index_page")
     */
    public function home(StaticContentRepository $staticContents, RealisationsRepository $realisations, Request $request, ContactService $service,  \Swift_Mailer $mailer)
    {
        // forumulaire de contact
        if ($request->getMethod() == 'POST') {

            $completedForm = true;
            foreach ($request->request as $value) {
                empty($value) ? $completedForm = false : '';
                dump($value);
                dump($completedForm);
            }

            if ($completedForm === false) {
                $this->addFlash('notBlank', "Votre message n'a pas pu être envoyé, veuillez remplir tous les champs.");
            }

            if ($completedForm === true && $service->contactForm($request, $mailer)) {
                
                $this->addFlash('success', "Votre message a bien été envoyé.");
            }else{
                $this->addFlash('error', "Votre message n'a pas pu être envoyé, veuillez réessayer plus tard.");
            }
        }

    	return $this->render('homePage.html.twig',[
                'StaticContents' => $staticContents->findAll(),
                'interieurs'     => $realisations->findby(['section' => 'Intérieur']),
                'terrassements'  => $realisations->findby(['section' => 'Terrassement']),
                'sols'           => $realisations->findby(['section' => 'Sol']),
                'maconneries'    => $realisations->findby(['section' => 'Maçonnerie']),
                'clotures'       => $realisations->findby(['section' => 'Cloture']),
                'divers'         => $realisations->findby(['section' => 'Divers'])
    	]);
	}
}
