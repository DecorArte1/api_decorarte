<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\DesignersModel;

class Designers extends BaseController
{
    use ResponseTrait;

    public function indexx()
    {
     $designers = new DesignersModel;
     return $this->respond(['Designers' => $designers->findAll()],200);
    }
}
