<?php

namespace App\Controller;

use App\Entity\StaticContent;
use App\Form\StaticContentType;
use App\Repository\StaticContentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/static/content")$staticContentRepository->findAll()
; */
class StaticContentController extends AbstractController
{
    /**
     * @Route("/", name="static_content_index", methods={"GET"})
     */
    public function index(StaticContentRepository $staticContentRepository): Response
    {
        $this->denyAccessUnlessGranted('UserConnected', $staticContentRepository->findAll()[0]);

        return $this->render('static_content/index.html.twig', [
            'static_contents' => $staticContentRepository->findAll(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="static_content_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, StaticContent $staticContent): Response
    {
        $this->denyAccessUnlessGranted('UserConnected', $staticContent);
        
        $form = $this->createForm(StaticContentType::class, $staticContent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $staticContent->setTitle(ucfirst(strtolower($staticContent->getTitle())));


            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('static_content_index');
        }

        return $this->render('static_content/edit.html.twig', [
            'static_content' => $staticContent,
            'form'           => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/new", name="static_content_new", methods={"GET","POST"})
    //  */
    // public function new(Request $request): Response
    // {
    //     $staticContent = new StaticContent();
    //     $form = $this->createForm(StaticContentType::class, $staticContent);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $staticContent->setCreatedAt(new \DateTime('now'));
    //         $staticContent->setCreatedBy('Admin');
    //         $staticContent->setUpdatedAt(new \DateTime('now'));
    //         $staticContent->setUpdatedBy('Admin');
    //         $staticContent->setTitle(ucfirst(strtolower($staticContent->getTitle())));

    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->persist($staticContent);
    //         $entityManager->flush();

    //         return $this->redirectToRoute('static_content_index');
    //     }

    //     return $this->render('static_content/new.html.twig', [
    //         'static_content' => $staticContent,
    //         'form' => $form->createView(),
    //     ]);
    // }

    /**
     * @Route("/{id}", name="static_content_show", methods={"GET"})
     */
    // public function show(StaticContent $staticContent): Response
    // {
    //     return $this->render('static_content/show.html.twig', [
    //         'static_content' => $staticContent,
    //     ]);
    // }

    // /**
    //  * @Route("/{id}", name="static_content_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, StaticContent $staticContent): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$staticContent->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($staticContent);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('static_content_index');
    // }
}
