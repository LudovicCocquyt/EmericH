<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class RealisationVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        return in_array($attribute, ['UserConnected'])
            && $subject instanceof \App\Entity\Realisations;
    }

    protected function voteOnAttribute($attribute, $realisation, TokenInterface $token)
    {

        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        switch ($attribute) {
            case 'UserConnected':
                if ($token->getUser()) {
                 
                    return true;
                }

                break;
        }

        return false;
    }
}
