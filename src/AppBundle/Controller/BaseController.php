<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function createApiResponse($data = array(), $format = 'json')
    {
        $serializer = $this->get('jms_serializer');
        return $serializer->serialize($data, $format);

    }
}
