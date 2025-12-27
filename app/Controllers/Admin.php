<?php

namespace App\Controllers;

use App\Models\UserModel; // Make sure this line exists
use App\Models\TaskModel;


class Admin extends BaseController
{

    protected $taskModel;
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->taskModel = new TaskModel();
    }

    
    public function dashboard()
    {

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $this->userModel->find($userId);

        // Count total admins
        $totalAdmins = $this->userModel->where('role', 'admin')->countAllResults();

        // Count total Members
        $totalMember = $this->userModel->where('role', 'member')->countAllResults();

        $totalmembers = $this->userModel
        ->select('id, name, email, is_approved, created_at, updated_at')
        ->where('role', 'member')
        ->where('created_by', $userId)  // ← Filter by current admin
        ->countAllResults();

        // Fetch ONLY tasks assigned to this admin
        $totaltasks = $this->taskModel
            ->select('tasks.*, users.name as admin_name')
            ->join('users', 'users.id = tasks.assigned_admin_id', 'left')
            ->where('tasks.created_by_role', 'superadmin')
            ->where('tasks.assigned_admin_id', $userId)
            ->countAllResults();

        $data = [
            'title' => 'Admin Dashboard',
            'user' => $user, //full user record
            'totalAdmins' => $totalAdmins,
            'totalMembers' => $totalMember,
            'totalMembersperAdmin' => $totalmembers,
            'totaltasks' => $totaltasks
        ];

        return view('admin/dashboard', $data);
    }
    public function pending()
    {
        $this->userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $this->userModel->find($userId);

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

        $this->userModel = new UserModel();

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $this->userModel->find($userId);

        // Fetch all members, but ONLY selected fields
        $members = $this->userModel
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

    public function tasks(){

    // Get logged-in admin ID from session
    $userId = session()->get('user_id');

    // Fetch ONLY tasks assigned to this admin
    $tasks = $this->taskModel
        ->select('tasks.*, users.name as admin_name')
        ->join('users', 'users.id = tasks.assigned_admin_id', 'left')
        ->where('tasks.created_by_role', 'superadmin')
        ->where('tasks.assigned_admin_id', $userId)
        ->findAll();

    

    return view('admin/tasks', [
        'tasks' => $tasks,
        
    ]);

    }
   
}


