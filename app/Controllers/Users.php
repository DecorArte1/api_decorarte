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

    // Obtener el usuario actual
    $user = $userModel->find($id);

    // Verificar si el usuario existe
    if ($user) {
        // Obtener los datos del formulario
        $data = [
           
            'email' => $this->request->getVar('email') ?? $user['email'],
            'password' => $this->request->getVar('password') ? password_hash($this->request->getVar('password'), PASSWORD_DEFAULT) : $user['password'],
            
        ];

        // Actualizar el usuario en la base de datos
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

    // Obtener el usuario actual
    $user = $userModel->find($id);

    // Verificar si el usuario existe
    if ($user) {
        // Eliminar el usuario de la base de datos
        if ($userModel->delete($id)) {
            $dataResult = [
                "data" => $user,
                "message" => 'Usuario eliminado correctamente',
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