<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\User;
use ApiBundle\Form\UserType;
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
