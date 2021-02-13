<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\scripts\SQLHandle;
use Symfony\Component\HttpFoundation\JsonResponse;


class API extends AbstractController {


  public function databaseAPI(Request $request) {

    $request = Request::createFromGlobals();
    $rq = $request->query->all();

    $db = new SQLHandle;
    $conn = $db->databaseConnect();

    return new JsonResponse(
            $rq,
        200);

  }


}
 ?>
