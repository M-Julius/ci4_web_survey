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
        // Check if the form is submitted
        if ($this->request->getMethod() === 'post') {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Validate login credentials (Add your own logic here)
            $userModel = new UserModel();
            $user = $userModel->where('username', $username)->first();

            if ($user && password_verify($password, $user['password'])) {
                // Login successful, create a session
                $session = session();
                $userData = [
                    'user_id' => $user['user_id'],
                    'username' => $user['username'],
                    // Add more user data as needed
                ];
                $session->set($userData);

                // Redirect to the dashboard or any other page after login
                return redirect()->to('/barang'); // Change '/barang' to your desired redirect path
            } else {
                // Login failed, show an error message
                $data['error'] = 'Invalid username or password';
            }
        }

        // Load the login view
        return view('auth/login', $data); // Change 'auth/login' to your actual view path
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
