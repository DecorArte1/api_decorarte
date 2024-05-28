<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ClientModel;
use CodeIgniter\HTTP\ResponseInterface;

class Clients extends BaseController
{
    public function create()
    {
        $clientModel = new ClientModel();

        $data = [
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        ];

        if ($clientModel->insert($data)) {
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
        $clientModel = new ClientModel();
        $client = $clientModel->findAll();

        $dataResult = [
            "data" => $client,
            "message" => 'Lista de usuarios',
            "response" => ResponseInterface::HTTP_OK,
        ];

        return $this->response->setJSON($dataResult);
    }

    public function show($id)
    {
        $clientModel = new ClientModel();
        $client = $clientModel->find($id);

        if ($client) {
            $dataResult = [
                "data" => $client,
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
        $clientModel = new ClientModel();
        $client = $clientModel->find($id);

        if ($client) {
            $data = [
                'email' => $this->request->getVar('email') ?? $client['email'],
                'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $client['password'],
            ];

            if ($clientModel->update($id, $data)) {
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
        $clientModel = new ClientModel();
        $client = $clientModel->find($id);

        if ($client) {
            if ($clientModel->delete($id)) {
                $dataResult = [
                    "data" => $client,
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
