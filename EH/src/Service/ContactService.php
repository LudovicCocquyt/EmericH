<?php

namespace App\Service;

class ContactService
{
public function contactForm($request, $mailer)
    {

        $name    = $request->request->get('name');
        $email   = $request->request->get('email');
        $subject = $request->request->get('subject');
        $content = $request->request->get('message');

        $message = (new \Swift_Message($subject))
                ->setFrom('cocquyt.ludovic@gmail.com')
                ->setTo('cocquyt.ludovic@gmail.com')
                ->setReplyTo($email)
                ->setBody("Message de $name, 
                            email:   $email
                            Titre:   $subject
                            Message: $content");

        $mailer->send($message);

        return true;
    }
}