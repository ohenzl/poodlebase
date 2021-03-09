<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\scripts\SQLHandle;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\scripts\API\Process;


class API extends AbstractController
{


    public function databaseAPI(Request $request)
    {

        $request = Request::createFromGlobals()->query;
        $conn = SQLHandle::databaseConnect();
        $sql = new Process($conn, $request);
        $output = $sql->build();

        return new JsonResponse(
            $output,
            200
        );

    }


}
?>
