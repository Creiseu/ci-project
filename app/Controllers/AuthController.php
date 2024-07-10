<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\User;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function index()
    {
        //
    }

    public function login()
    {
        $session = session();
        $userModel = new User();
    
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        if (!is_string($username) || empty($username) || !is_string($password) || empty($password)) {
            $session->setFlashdata('error', 'Username atau password tidak valid');
            return redirect()->to(base_url('login'));
        }

        $user = $userModel->where('username', $username)->first();
    
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $session->set([
                    'user_id' => $user['id'],
                    'username' => $user['username'],
                    'role' => $user['role'],
                    'isLoggedIn' => true,
                ]);
    
                if ($user['role'] == 'admin') {
                    return redirect()->to('/admin');
                } elseif ($user['role'] == 'customer') {
                    return redirect()->to('/customer');
                } else {
                    $session->setFlashdata('error', 'Role tidak valid');
                    return redirect()->to('/login');
                }
            } else {
                $session->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('error', 'Username atau password tidak valid');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        return view('register');
    }
    public function storeRegister()
    {
        $validation = \Config\Services::validation();

        // Define validation rules
        $validation->setRules([
            'username' => 'required|min_length[3]|max_length[20]',
            'password' => 'required|min_length[4]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // Get data from form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Check if the password is a valid string
        if (!is_string($password) || empty($password)) {
            return redirect()->back()->withInput()->with('errors', ['password' => 'Password is invalid']);
        }

        $userModel = new User();

        $data = [
            'username'      => $username,
            'password'  => password_hash($password, PASSWORD_DEFAULT),
            'role'      => 'customer',
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s'),
        ];

        // Insert user into the database
        $userModel->insert($data);

        // Redirect to a success page or login page
        return redirect()->to('/login');
    }

    public function logout()
    {
        $session = session();

        // Hapus semua data sesi
        $session->destroy();

        // Redirect ke halaman login atau halaman lain yang sesuai
        return redirect()->to(base_url('login'));
    }
}
