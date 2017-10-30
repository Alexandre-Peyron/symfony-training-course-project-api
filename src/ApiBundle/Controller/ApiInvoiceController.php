<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Invoice;
use ApiBundle\Form\InvoiceType;
use JMS\Serializer\SerializationContext;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class ApiInvoiceController
 * @package ApiBundle\Controller
 *
 * @Route("/api/v1")
 */
class ApiInvoiceController extends Controller
{
    /**
     * @Route("/invoices")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $invoices = $em->getRepository('ApiBundle:Invoice')->findAll();

        return $this->createJsonResponse($invoices);
    }

    /**
     * @Route("/invoices/{id}")
     * @Method("GET")
     */
    public function showAction(Invoice $invoice)
    {
        return $this->createJsonResponse($invoice);
    }

    /**
     * @Route("/invoices")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $invoice = new Invoice();

        $form = $this->createForm(InvoiceType::class, $invoice);

        $form->submit($request->request->all());

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->createJsonResponse($invoice, ['invoice']);
        } else {
            return $this->createJsonResponse($form->getErrors());
        }
    }

    /**
     * @Route("/invoices/{id}")
     * @Method("PATCH")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $invoice = $em->getRepository('ApiBundle:Invoice')->find($id);

        if (!$invoice) {
            return new JsonResponse(null, Response::HTTP_NO_CONTENT);
        }

        $form = $this->createForm(InvoiceType::class, $invoice);

        // second argument determines if form data should be merged with existing entity
        // false for merge (PATCH)
        // true to get only form data (PUT)
        $form->submit($request->request->all(), false);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($invoice);
            $em->flush();

            return $this->createJsonResponse($invoice, ['invoice']);
        } else {
            return $this->createJsonResponse($form->getErrors());
        }
    }

    /**
     * @Route("/invoices/{id}")
     * @Method("DELETE")
     */
    public function removePlaceAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $invoice = $em->getRepository('ApiBundle:Invoice')->find($id);

        if ($invoice) {
            $em->remove($invoice);
            $em->flush();
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Convert Entity to Json
     *
     * @param $object
     * @param array $groups
     * @param int $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function createJsonResponse($object, $groups = [], $status = 200, $headers = [])
    {
        $serializer = $this->container->get('jms_serializer');

        $jsonObject = $serializer->serialize(
            $object,
            'json',
            (!empty($groups)) ? SerializationContext::create()->setGroups($groups) : null
        );

        return new JsonResponse($jsonObject, $status, $headers, true);
    }
}
