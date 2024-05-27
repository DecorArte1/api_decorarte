<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\HTTP\ResponseInterface;

class Users extends BaseController
{
    public function create()
    {
        $userModel = new UserModel();

        $data = [

            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),


        ];

        if ($userModel->insert($data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'Usuario Creado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al crear usuario',
                "response" => ResponseInterface::HTTP_CONFLICT,
            ];
        }

        return $this->response->setJSON($dataResult);
    }

    public function index()
    {
        $userModel = new UserModel();
        $user = $userModel->findAll();

        $dataResult = [
            "data" => $user,
            "message" => 'Lista de usuarios',
            "response" => ResponseInterface::HTTP_OK,
        ];

        return $this->response->setJSON($dataResult);
    }



    public function show($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);

        if ($user) {
            $dataResult = [
                "data" => $user,
                "message" => 'Usuario Encontrado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Usuario no encontrado',
                "response" => ResponseInterface::HTTP_NOT_FOUND,
            ];
        }

        return $this->response->setJSON($dataResult);
    }
    public function update($id)
{
    $userModel = new UserModel();
    $user = $userModel->find($id);

    if ($user) {
        $data = [
            'email' => $this->request->getVar('email') ?? $user['email'],
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $user['password'],
        ];

        if ($userModel->update($id, $data)) {
            $dataResult = [
                "data" => $data,
                "message" => 'Usuario actualizado',
                "response" => ResponseInterface::HTTP_OK,
            ];
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Error al actualizar usuario',
                "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
            ];
        }
    } else {
        $dataResult = [
            "data" => '',
            "message" => 'Usuario no encontrado',
            "response" => ResponseInterface::HTTP_NOT_FOUND,
        ];
    }

    return $this->response->setJSON($dataResult);
}



    public function delete($id)
    {
        $userModel = new UserModel();
        $user = $userModel->find($id);
    
        if ($user) {
            if ($userModel->delete($id)) {
                $dataResult = [
                    "data" => $user,
                    "message" => 'Usuario eliminado',
                    "response" => ResponseInterface::HTTP_OK,
                ];
            } else {
                $dataResult = [
                    "data" => '',
                    "message" => 'Error al eliminar usuario',
                    "response" => ResponseInterface::HTTP_INTERNAL_SERVER_ERROR,
                ];
            }
        } else {
            $dataResult = [
                "data" => '',
                "message" => 'Usuario no encontrado',
                "response" => ResponseInterface::HTTP_NOT_FOUND,
            ];
        }
    
        return $this->response->setJSON($dataResult);
    }
    

}