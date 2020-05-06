<?php
namespace App\Security;

use App\Entity\Space;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class HeykeepVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';
    const DELETE =  'delete';

    protected function supports($attribute, $subject)
    {
        
        if (!in_array($attribute, [self::VIEW, self::EDIT])) {
            return false;
        }

        
        if (!$subject instanceof space) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
           
            return false;
        }

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($subject, $user);
            case self::EDIT:
                return $this->canEdit($subject, $user);
           case self::DELETE:
                return $this->canDelete($subject, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }
}
