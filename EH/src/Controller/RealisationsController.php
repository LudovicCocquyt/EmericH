<?php

namespace App\Controller;

use App\Entity\Images;
use App\Entity\Realisations;
use App\Form\RealisationsType;
use App\Repository\RealisationsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/realisations")
 */
class RealisationsController extends AbstractController
{
    /**
     * @Route("/", name="realisations_index", methods={"GET"})
     */
    public function index(RealisationsRepository $realisationsRepository): Response
    {
        $this->denyAccessUnlessGranted('UserConnected', $realisationsRepository->findAll()[0]);

        return $this->render('realisations/index.html.twig', [
            'realisations' => $realisationsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="realisations_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {

        $realisation = new Realisations();

        $this->denyAccessUnlessGranted('UserConnected', $realisation);

        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images transmises
            $images = $form->get('images')->getData();
            
            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Images();
                $img->setName($fichier);
                $realisation->addImage($img);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($realisation);
            $entityManager->flush();

            return $this->redirectToRoute('realisations_index');
        }

        return $this->render('realisations/new.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="realisations_show", methods={"GET"})
     */
    public function show(Realisations $realisation): Response
    {
        $this->denyAccessUnlessGranted('UserConnected', $realisation);


        return $this->render('realisations/show.html.twig', [
            'realisation' => $realisation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="realisations_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Realisations $realisation): Response
    {
        $this->denyAccessUnlessGranted('UserConnected', $realisation);

        $form = $this->createForm(RealisationsType::class, $realisation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // On récupère les images transmises
            $images = $form->get('images')->getData();
            
            // On boucle sur les images
            foreach($images as $image){
                // On génère un nouveau nom de fichier
                $fichier = md5(uniqid()).'.'.$image->guessExtension();
                
                // On copie le fichier dans le dossier uploads
                $image->move(
                    $this->getParameter('images_directory'),
                    $fichier
                );
                
                // On crée l'image dans la base de données
                $img = new Images();
                $img->setName($fichier);
                $realisation->addImage($img);
            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('realisations_index');
        }

        return $this->render('realisations/edit.html.twig', [
            'realisation' => $realisation,
            'form' => $form->createView(),
        ]);
    }

    // /**
    //  * @Route("/{id}", name="realisations_delete", methods={"DELETE"})
    //  */
    // public function delete(Request $request, Realisations $realisation): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$realisation->getId(), $request->request->get('_token'))) {
    //         $entityManager = $this->getDoctrine()->getManager();
    //         $entityManager->remove($realisation);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('realisations_index');
    // }

    /**
     * @Route("/supprime/image/{id}", name="realisations_delete_image", methods={"DELETE"})
     */
    public function deleteImage(Images $image, Request $request, Realisations $realisation){

        $this->denyAccessUnlessGranted('UserConnected', $realisation);

        $data = json_decode($request->getContent(), true);

        // On vérifie si le token est valide
        //if($this->isCsrfTokenValid('delete'.$image->getId(), $data['_token'])){
            // On récupère le nom de l'image
            $nom = $image->getName();
            // On supprime le fichier
            unlink($this->getParameter('images_directory').'/'.$nom);

            // On supprime l'entrée de la base
            $em = $this->getDoctrine()->getManager();
            $em->remove($image);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->remove($realisation);

            $em->flush();
            // On répond en json
            return $this->redirectToRoute('realisations_index');
    }

}
