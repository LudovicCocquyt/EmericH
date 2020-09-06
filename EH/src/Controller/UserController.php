<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Form\StaticContent;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin/user")
; */
class UserController extends AbstractController
{
    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, UserPasswordEncoderInterface $encoder, EntityManagerInterface $entityManager): Response
    {
        $passwordUserConnected = $this->get('security.token_storage')->getToken()->getUser();
        
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if ($request->getMethod() == 'POST') {
            // $passwordUserConnected === $request->request->get('user')['password']
            // 
            if ($passwordUserConnected->getPassword() === 
                                        $request->request->get('user')['password']) {

                if ($request->request->get('newPassword') == $request->request->get('confirmePassword')) {
                    $user->setPassword($encoder->encodePassword($user, $request->request->get('user')['newPassword']));
                    $entityManager->persist($user);
                    $entityManager->flush();

                    $this->addFlash('success', "Modification réussi");
                    return $this->redirectToRoute("user_edit", [
                            'id' => $user->getId(),
                    ]);
                } else {
                    $this->addFlash('danger', "Erreur de confirmation");
                    return $this->redirectToRoute("user_edit", [
                            'id' => $user->getId(),
                    ]);
                }
            } else {
                $this->addFlash('danger', "Erreur ancien mot de passe");
                return $this->redirectToRoute("user_edit", [
                        'id' => $user->getId(),
                ]);
            }
        }
        return $this->render('/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}

    // public function edit(Request $request, User $user): Response
    // {
    //     //$this->denyAccessUnlessGranted('UserConnected', $UserController);
        
    //     $form = $this->createForm(UserType::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {

    //         $this->getDoctrine()->getManager()->flush();

    //         return $this->redirectToRoute('static_content_index');
    //     }

    //     return $this->render('user/edit.html.twig', [
    //         'user' => $user,
    //         'form' => $form->createView(),
    //     ]);
    // }