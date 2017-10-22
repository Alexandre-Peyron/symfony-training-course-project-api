<?php

namespace ApiBundle\Controller;

use ApiBundle\Entity\Invoice;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;


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
     * Convert Entity to Json
     *
     * @param $object
     * @param int $status
     * @param array $headers
     *
     * @return JsonResponse
     */
    private function createJsonResponse($object, $status = 200, $headers = array() )
    {
        $serializer = $this->container->get('jms_serializer');

        $jsonObject = $serializer->serialize($object, 'json');

        return new JsonResponse($jsonObject, $status, $headers, true);
    }
}
