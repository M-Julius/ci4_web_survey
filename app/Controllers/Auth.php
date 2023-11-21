<?php

namespace App\Controllers;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{
    public function login()
    {
        return view("auth/login");
    }

    public function doLogin()
    {
        // Validate user input (you may use CodeIgniter's validation library)
        
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Fetch user by username
        $user = $userModel->where('username', $username)->first();

        if ($user && password_verify($password, $user['password'])) {
            // Successful login, redirect to dashboard or another page
            return redirect()->to('/dashboard');
        } else {
            // Failed login, redirect back to the login page with an error message
            return redirect()->to('/login')->with('error', 'Invalid login credentials');
        }
    }

    public function doRegister()
    {
        $model = new UserModel();
        $data = [
            'username' => "alfy",
            'password' => password_hash("password", PASSWORD_DEFAULT),
            "marketing_id" => 1,
        ];

        $model->insert($data);
    }
}
