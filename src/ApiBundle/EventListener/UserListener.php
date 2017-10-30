<?php

namespace ApiBundle\EventListener;

use ApiBundle\Entity\User;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserListener
{
    /**
     * @var $passwordEncoder UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * UserListener constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * On pre persist entity invoice
     *
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var $entity User */
        $entity = $args->getEntity();

        $this->setEncodedPassword($entity);
    }

    /**
     * On pre update entity user
     *
     * @param PreUpdateEventArgs $args
     */
    public function preUpdate(PreUpdateEventArgs $args)
    {
        /** @var $entity User */
        $entity = $args->getEntity();

        $this->setEncodedPassword($entity);
    }

    /**
     * Generate encoded password on persist and update
     *
     * @param $invoice User
     */
    private function setEncodedPassword($user)
    {
        if (!$user instanceof User) {
            return;
        }

        // le mot de passe en claire est encodé avant la sauvegarde
        $encoded = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encoded);
    }
}
