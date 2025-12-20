<?php

namespace App\Controllers;

use App\Models\UserModel; // Make sure this line exists

class Member extends BaseController
{
    public function dashboard()
    {
        $userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $userModel->find($userId);

        // Count total Admins
        $totalAdmins = $userModel->where('role', 'admin')->countAllResults();

        //Count total Members
        $totalMembers = $userModel->where('role', 'member')->countAllResults();

        $data = [
            'title' => 'Member Dashboard',
            'user' => $user, //full user record
            'totalAdmins' => $totalAdmins,
            'totalMembers' => $totalMembers
            //'user' => session()->get('role') // optional, for display  
        ];

        return view('member/dashboard', $data);
    }
}