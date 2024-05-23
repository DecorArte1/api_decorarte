<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientModel;

class Client extends BaseController
{
    use ResponseTrait;

    public function index()
    {
     $client = new ClientModel;
     return $this->respond(['Client' => $client->findAll()],200);
    }
}
