<?php
nameSpace App\Security;

use App\Entity\Discussion;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DiscussionVoter extends HeykeepVoter
{
    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::DELETE])) {
            return false;
        }


        if (!$subject instanceof Discussion) {
            return false;
        }

        return true;
    }
    protected function canView( $discussion, User $user)
    {
        if ($this->canEdit($discussion, $user)) {
            return true;
        }

        return $discussion->getIdUser()->contains($user);
    }

    protected function canEdit($discussion, User $user)
    {
        return $discussion->getIdUser()->contains($user);
    }

    protected function canDelete($discussion, User $user)
    {
        return $discussion->getIdUser()->contains($user);
    }

}
