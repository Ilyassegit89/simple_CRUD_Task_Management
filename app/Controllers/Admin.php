<?php

namespace App\Controllers;

use App\Models\UserModel; // Make sure this line exists

class Admin extends BaseController
{
    public function dashboard()
    {
        $userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $userModel->find($userId);

        // Count total admins
        $totalAdmins = $userModel->where('role', 'admin')->countAllResults();

        // Count total Members
        $totalMember = $userModel->where('role', 'member')->countAllResults();

        // Fetch all members, but ONLY selected fields
        $members = $userModel
        ->select('id, name, email, is_approved, created_at, updated_at')
        ->where('role', 'member')
        ->where('created_by', $userId)  // ← Filter by current admin
        ->findAll();

        $totalmembers = $userModel
        ->select('id, name, email, is_approved, created_at, updated_at')
        ->where('role', 'member')
        ->where('created_by', $userId)  // ← Filter by current admin
        ->countAllResults();


        $data = [
            'title' => 'Admin Dashboard',
            'user' => $user, //full user record
            'totalAdmins' => $totalAdmins,
            'totalMembers' => $totalMember,
            'totalMembersperAdmin' => $totalmembers
            //'user' => session()->get('role') // optional, for display  
        ];

        return view('admin/dashboard', $data);
    }
    public function pending()
    {
        $userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $userModel->find($userId);

        // Update session with fresh approval status
        if ($user && $user['is_approved'] == 1) {
            session()->set('is_approved', 1);
            
            // Redirect to dashboard if now approved
            return redirect()->to(base_url('admin/dashboard'));
        }

        $data = [
            'title' => 'Admin Dashboard',
            'user' => $user, //full user record
            'warning' => 'Your account is pending approval. Please wait for the Super Admin to approve your access.', // Direct message
            //'user' => session()->get('role') // optional, for display  
        ];

        return view('admin/pending', $data);
    }
    public function members(){

        $userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $userModel->find($userId);

        // Fetch all members, but ONLY selected fields
        $members = $userModel
        ->select('id, name, email, is_approved, created_at, updated_at')
        ->where('role', 'member')
        ->where('created_by', $userId)  // ← Filter by current admin
        ->findAll();

        


        
        
        $data = [
            'title' => 'members',
            'user' => $user, //full user record
            'members' => $members,
            //'user' => session()->get('role') // optional, for display  
        ];

        return view('admin/members', $data);


    }
   
}

//user session
/* $userId = session()->get('user_id');

// Make sure it's an integer
$userId = (int) $userId;

$userModel = new UserModel();
$user = $userModel->find($userId);

dd($user); // debug: should show the full user array
 */
