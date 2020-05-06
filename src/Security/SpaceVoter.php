<?php
namespace App\Security;

use App\Entity\Space;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class SpaceVoter extends Voter
{
    const VIEW = 'view';
    const EDIT = 'edit';

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

        
        /** @var Space $space */
        $space = $subject;

        switch ($attribute) {
            case self::VIEW:
                return $this->canView($space, $user);
            case self::EDIT:
                return $this->canEdit($space, $user);
        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canView(Space $space, User $user)
    {
        
        if ($this->canEdit($space, $user)) {
            return true;
        }

       
        return $space->getIdMember()->contains($user);
        
    }

     private function canEdit(Space $space, User $user)
    {
        
        return $user === $space->getIdOwner();
    }
}
