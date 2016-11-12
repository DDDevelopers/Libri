<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class BaseController extends Controller
{
    public function createApiResponse($data, $format = 'json')
    {
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($data, $format);
        return new JsonResponse($data);
    }
}
