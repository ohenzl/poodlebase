<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\scripts\SQLHandle;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\scripts\API\v1\Process;


class APIv1 extends AbstractController
{

    private $conn;

    public function __construct()
    {
        $this->conn = SQLHandle::databaseConnect();
    }


    //get all dogs from database
    public function getAllDogs(Request $request)
    {

        $request = Request::createFromGlobals();
        $page = $request->query->get('page');
        $limit = $request->query->get('limit');
        $all_info = $request->query;

        $sql = new Process($this->conn);
        $in = $sql->createInputs($all_info);
        $output = $sql->getAll($page, $limit, $in);

        return new JsonResponse(
            $output,
            200
        );
    }

    //get one dog
    public function getDog($id)
    {
        $sql = new Process($this->conn);
        $output = $sql->getOne($id);

        return new JsonResponse(
            $output,
            200
        );
    }

    public function editDogFull($id)
    {
        $request = Request::createFromGlobals();
        $sql = new Process($this->conn);
        $output = $sql->editDogFull($id);

        return new JsonResponse(
            $output,
            200
        );
    }

    public function editDogPart($id)
    {
        $sql = new Process($this->conn);
        $output = $sql->editDogPart($id);

        return new JsonResponse(
            $output,
            200
        );
    }


}
?>
