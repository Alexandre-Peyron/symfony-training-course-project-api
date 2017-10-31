<?php

namespace ApiBundle\Security;

use ApiBundle\Entity\User;
use ApiBundle\Entity\UserAuthToken;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\Exception\TokenNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class ApiUserProvider implements UserProviderInterface
{
    /**
     * @var $em EntityManager
     */
    protected $em;

    /**
     * ApiUserProvider constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $authTokenHeader
     *
     * @return UserAuthToken
     */
    public function getAuthToken($authTokenHeader)
    {
        $token = $this->em->getRepository('ApiBundle:UserAuthToken')->findOneByValue($authTokenHeader);

        if ($token) {
            return $token;
        }

        throw new TokenNotFoundException(
            sprintf('Token "%s" does not exist.', $authTokenHeader)
        );
    }

    /**
     * @param string $username
     *
     * @return User
     */
    public function loadUserByUsername($username)
    {
        /** @var User $user */
        $user = $this->em->getRepository('ApiBundle:User')->findOneByUsername($username);

        if ($user) {
            return $user;
        }

        throw new UsernameNotFoundException(
            sprintf('Username "%s" does not exist.', $username)
        );
    }

    /**
     * @param UserInterface $user
     *
     * @return User
     */
    public function refreshUser(UserInterface $user)
    {
//        if (!$user instanceof User) {
//            throw new UnsupportedUserException(
//                sprintf('Instances of "%s" are not supported.', get_class($user))
//            );
//        }
//
//        return $this->loadUserByUsername($user->getUsername());

        throw new UnsupportedUserException();
    }

    /**
     * @param string $class
     *
     * @return bool
     */
    public function supportsClass($class)
    {
        return User::class === $class;
    }
}