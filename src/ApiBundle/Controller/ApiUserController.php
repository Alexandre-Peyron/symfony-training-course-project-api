<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use ApiBundle\Entity\UserAuthToken;
use ApiBundle\Form\UserType;
use ApiBundle\Form\LoginType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiUserController
 * @package ApiBundle\Controller
 *
 * @Route("/api/v1")
 */
class ApiUserController extends ApiBaseController
{
    /**
     * @route("/login")
     * @method("POST")
     */
    public function loginAction(Request $request)
    {
        $loginUser = new User();
        $form = $this->createForm(LoginType::class, $loginUser);

        $form->submit($request->request->all());

        if (!$form->isValid()) {
            return $this->createJsonResponse($form->getErrors());
        }

        $em = $this->getDoctrine()->getManager();

        $user = $em->getRepository('ApiBundle:User')->findOneByUsername($loginUser->getUsername());

        if (!$user) { // L'utilisateur n'existe pas
            return $this->createJsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        $encoder = $this->get('security.password_encoder');
        $isPasswordValid = $encoder->isPasswordValid($user, $loginUser->getPLainPassword());

        if (!$isPasswordValid) { // Le mot de passe n'est pas correct
            return $this->createJsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        $authToken = new UserAuthToken();
        $authToken->setValue(base64_encode(random_bytes(50)));
        $authToken->setCreatedAt(new \DateTime('now'));
        $authToken->setUser($user);

        $em->persist($authToken);
        $em->flush();

        return $this->createJsonResponse($authToken, Response::HTTP_CREATED, ['auth-token']);
    }


    /**
     * @Route("/register")
     * @Method("POST")
     */
    public function postUserAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->createJsonResponse($user, Response::HTTP_CREATED, ['user']);
        } else {
            return $this->createJsonResponse($form->getErrors());
        }
    }
}
