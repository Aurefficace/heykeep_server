<?php
namespace App\Security;

use App\Entity\Space;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class SpaceVoter extends HeykeepVoter
{
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])) {
            return false;
        }


        if (!$subject instanceof space) {
            return false;
        }

        return true;
    }

    /**
     * @param $space Space
     * @param $user User
     * @return bool
     */
    protected function canView($space, User $user)
    {
        if ($this->canEdit($space, $user)) {
            return true;
        }

        return $space->getIdMember()->contains($user);
    }

    /**
     * @param $space Space
     * @param $user User
     * @return bool
     */
    protected function canEdit($space, User $user)
    {
        return $user === $space->getIdOwner();
    }

    /**
     * @param $space Space
     * @param $user User
     * @return bool
     */
    protected function canDelete($space, User $user)
    {
        return $user === $space->getIdOwner();   
    }
}
