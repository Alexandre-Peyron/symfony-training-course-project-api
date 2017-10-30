<?php

namespace ApiBundle\Controller;

use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;


/**
 * Class ApiBaseController
 * @package ApiBundle\Controller
 */
class ApiBaseController extends Controller
{
    /**
     * Convert Entity to Json
     *
     * @param $object
     * @param int $status
     * @param array $groups
     * @param array $headers
     *
     * @return JsonResponse
     */
    protected function createJsonResponse($object, $status = 200, $groups = [], $headers = [])
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
