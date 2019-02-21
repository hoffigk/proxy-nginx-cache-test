<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController
{
    /**
     * @Route("/{slug}", name="app.index", requirements={"slug": ".*"}, methods={"GET"})
     * @Cache(expires="+20 seconds", public=true)
     *
     * @param Request $request
     * @return Response
     */
    public function __invoke(Request $request)
    {
        return Response::create($request->getPathInfo() . ' time(' . time() . ')');
    }
}