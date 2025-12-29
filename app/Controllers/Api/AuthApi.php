<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthApi extends BaseController
{
    public function login()
    {
        $session = Session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (!$username || !$password) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => false,
                    'message' => 'Username dan Password tidak boleh kosong'
                ]);
        }

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if (!$user) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Username / password salah'
                ]);
        }

        if (!password_verify($password, $user['password'])) {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'status' => false,
                    'message' => 'Password Salah'
                ]);
        }

        $token = generate_jwt([
            'user_id' => $user['id'],
            'username'   => $user['username']
        ]);


        $session->set([
            'logged_in'    => true,
        ]);
        return $this->response->setJSON([
            'status' => true,
            'message' => 'Login Berhasil',
            'token' => $token,
        ]);
    }
}
