<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        return view('auth/login');
    }
    public function signup()
{
    return view('auth/signup');
}

public function signupPost()
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'name'  => 'required|min_length[3]',
        'email' => 'required|valid_email|is_unique[users.email]',
        'role'  => 'required|in_list[member,admin]',
        'password' => 'required|min_length[6]',

    ]);

    if (!$validation->withRequest($this->request)->run()) {
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    $userModel = new \App\Models\UserModel();

    $userModel->save([
        'name' => $this->request->getPost('name'),
        'email' => $this->request->getPost('email'),
        'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        'role'     => $this->request->getPost('role'),
    ]);

    return redirect()->to('login')->with('success', 'Signup successful! Please login.');
}

    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function loginPost()
    {
        $userModel = new UserModel();

        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            
            return redirect()->back()->with('error', 'Email not found');
        }

        if (!password_verify($password, $user['password'])) {
            

            return redirect()->back()->with('error', 'Wrong password');
        }

        // Store user data in session
        session()->set([
            'user_id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role'],
            'is_approved' => $user['is_approved'] ?? 0, // Add this
            'isLoggedIn' => true
        ]);

        // Check if admin needs approval
        if ($user['role'] === 'admin' && (!isset($user['is_approved']) || $user['is_approved'] == 0)) {
            return redirect()->to('/admin/pending');
        }

        // Redirect based on role
        if ($user['role'] === 'superadmin') {
           return redirect()->to(base_url('superadmin/dashboard'));
        } elseif ($user['role'] === 'admin') {
            return redirect()->to(base_url('admin/dashboard'));
        } 
        else {
            return redirect()->to(base_url('member/dashboard'));
        }
    }

}
