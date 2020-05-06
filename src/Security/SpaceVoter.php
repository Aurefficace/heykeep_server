<?php
namespace App\Security;

use App\Entity\Space;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SpaceVoter extends HeykeepVoter
{
    protected function canView(Space $space, User $user)
    {
        if ($this->canEdit($space, $user)) {
            return true;
        }

        return $space->getIdMember()->contains($user);
    }

    protected function canEdit(Space $space, User $user)
    {
        return $user === $space->getIdOwner();
    }

    protected function canDelete(Space $space, User $user)
    {
        return $user === $space->getIdOwner();   
    }
}
