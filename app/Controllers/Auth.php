<?php

namespace App\Controllers;

use App\Models\MarketingModel;
use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends BaseController
{

    protected $marketingModel;
    protected $userModel;
    public function __construct()
    {
        $this->marketingModel = new MarketingModel();
        $this->userModel = new UserModel();
    }

    public function login()
    {
        return view("auth/login");
    }

    public function register()
    {

        $data['marketings'] = $this->marketingModel->findAll();

        return view("auth/register", $data);
    }

    public function doLogin()
    {
        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $session = session();

            // Validate login credentials (Add your own logic here)
            $marketing = $this->marketingModel->where('email', $username)->first();

            if ($marketing && $marketing['marketing_id'] != null) {
                $user = $this->userModel->where('marketing_id', $marketing['marketing_id'])->first();
            } else {
                $user = $this->userModel->where('username', $username)->first();
            }

            if ($user && password_verify($password, $user['password'])) {
                // Login successful, create a session

                $userData = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    // Add more user data as needed
                ];
                $session->set($userData);

                // Redirect to the dashboard or any other page after login
                return redirect()->to('/dashboard'); // Change '/barang' to your desired redirect path
            } else {
                // Login failed, show an error message
                $response['message'] = 'Periksa username/password.';
                $response['success'] = false;
                $session->setFlashdata('login_error', $response['message']);
            }
        }

        // Load the login view
        return view('auth/login', $response); // Change 'auth/login' to your actual view path
    }

    public function doRegister()
    {
        $userModel = new UserModel();
        $rules = [
            'marketing_id' => 'required|min_length[1]|max_length[10]',
            'username' => 'required|min_length[5]|max_length[200]',
            'password' => 'required|min_length[6]|max_length[200]',
            'confPassword' => 'matches[password]'
        ];

        if ($this->validate($rules)) {
            $data = [
                'marketing_id' => $this->request->getPost('marketing_id'),
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
            $userModel->save($data);
            return redirect()->to('/login');
        } else {
            $data['validation'] = $this->validator;

            echo $data['validation']->listErrors();
            return view('/register', $data);
        }
    }

    public function logout()
    {
        // Destroy the session to log the user out
        $session = session();
        $session->destroy();

        // Redirect to the login page after logout
        return redirect()->to('/login'); // Change '/login' to your login page path
    }
}
