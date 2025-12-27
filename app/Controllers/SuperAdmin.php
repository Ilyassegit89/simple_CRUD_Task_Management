<?php

namespace App\Controllers;

use App\Models\UserModel; 
use App\Models\TaskModel;

class SuperAdmin extends BaseController
{
    protected $userModel;
    protected $taskModel;
    

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

        $totalTasks = $this->taskModel
        ->where('created_by_role', 'superadmin')
        ->countAllResults();
        
        $data = [
            'title' => 'SuperAdmin Dashboard',
            'user' => $user, //full user record
            'totalAdmins' => $totalAdmins,
            'totalMembers' =>  $totalMember,
            'totalTasks' => $totalTasks  
        ];

        return view('superadmin/dashboard', $data);
    }
    public function manage_admins(){

        // Get logged-in user ID from session
        $userId = session()->get('user_id');

        // Fetch user data from DB
        $user = $this->userModel->find($userId);


        // Fetch all admins, but ONLY selected fields
        $admins = $this->userModel
        ->select('id, name, email, is_approved, created_at, updated_at' )
        ->where('role', 'admin')
        ->findAll();

        // Count members created by THIS admin
        foreach ($admins as &$admin) {
            $admin['total_members'] = $this->userModel
                ->where('role', 'member')
                ->where('created_by', $admin['id'])
                ->countAllResults();
        }

    
        // Count total admins
        $totalAdmins = count($admins);


        $data = [
            'title' => 'Superadmin Dashboard',
            'user' => $user, //full user record
            'totalAdmins' => $totalAdmins,
            'admins' => $admins,
       
            //'user' => session()->get('role') // optional, for display  
        ];

        return view('superadmin/manageadmins', $data);
   }
   public function manage_members(){

    // Get logged-in user ID from session
        $userId = session()->get('user_id');

    // Fetch user data from DB
        $user = $this->userModel->find($userId);
    
        $members = $this->userModel
        ->select('id, name, email, created_by, is_approved, created_at, updated_at')
        ->where('role', 'member')
        ->findAll();

         $admins = $this->userModel
        ->select('id, name, email, is_approved, created_at, updated_at' )
        ->where('role', 'admin')
        ->findAll();

    $data = [
            'title' => 'Manage Members',
            'members' => $members,
            'admins' => $admins
            ];
    
    return view('superadmin/managemembers', $data);
   }

   public function approve($id)
    {

        // Check if user is superadmin
        if (session()->get('role') !== 'superadmin') {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Unauthorized access'
            ]);
            
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Administrator not found',
                'id' => $id
            ]);
        }

        // Update approval status
        $updated = $this->userModel->update($id, ['is_approved' => 1]);

         if ($updated) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Admin approved successfully'
            ]);
        } else {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Failed to approve admin'
            ]);
        }
    }

    public function delete($id)
    {
        // Check if user is superadmin
        if (session()->get('role') !== 'superadmin') {
            return redirect()->to('/')->with('error', 'Unauthorized access');
        }

        $user = $this->userModel->find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Admin not found');
        }

        // Prevent deleting superadmin
        if ($user['role'] === 'superadmin') {
            return redirect()->back()->with('error', 'Cannot delete superadmin');
        }

        $this->userModel->delete($id);

        return redirect()->back()->with('success', 'Admin deleted successfully');
    }

    public function edit($id)
    {
        // Your edit logic here
        return redirect()->back()->with('info', 'Edit functionality to be implemented');
    }

   public function updateMemberAdmin()
    {
        // Check if superadmin is logged in
        if (!session()->get('isLoggedIn') || session()->get('role') !== 'superadmin') {
            return redirect()->to('/login')->with('error', 'Unauthorized access');
        }

        // Validate the request
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'member_id' => 'required|numeric',
            'admin_id'  => 'permit_empty|numeric'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Invalid input data');
        }

        $memberId = $this->request->getPost('member_id');
        $adminId = $this->request->getPost('admin_id');

        // Check if member exists and is actually a member
        $member = $this->userModel->find($memberId);
        
        if (!$member || $member['role'] !== 'member') {
            return redirect()->back()
                ->with('error', 'Member not found');
        }

        // If admin_id is provided, verify the admin exists
        if (!empty($adminId)) {
            $admin = $this->userModel->find($adminId);
            
            if (!$admin || $admin['role'] !== 'admin') {
                return redirect()->back()
                    ->with('error', 'Admin not found');
            }
        }

        // Use set() method to handle null values properly
        $this->userModel->builder()->where('id', $memberId)
            ->set('created_by', !empty($adminId) ? $adminId : null)
            ->update();

        $updated = $this->userModel->db->affectedRows() >= 0;

        if ($updated) {
            return redirect()->to('superadmin/manage_members')
                ->with('success', 'Member assignment updated successfully');
        } else {
            return redirect()->back()
                ->with('error', 'Failed to update member assignment');
        }
        
    }


    public function assign_tasks(){

        // Fetch all admins
        $admins = $this->userModel
        ->select('id, name, email, is_approved, created_at, updated_at' )
        ->where('role', 'admin')
        ->findAll();


         // Fetch tasks assigned to admins
        $tasks = $this->taskModel
        ->select('tasks.*, users.name as admin_name')
        ->join('users', 'users.id = tasks.assigned_admin_id', 'left')
        ->where('tasks.created_by_role', 'superadmin')
        ->findAll();

        

        $data = [
            'title' => 'Assign Tasks',
            'admins' => $admins,
            'tasks' => $tasks
       
        ];
        
    
    return view('superadmin/assignTasks', $data);
    }


    public function assignTaskToAdmin(){
        
    $taskModel = new \App\Models\TaskModel();

    $title       = $this->request->getPost('title');
    $description = $this->request->getPost('description');
    $adminId     = $this->request->getPost('admin_id');

    // Basic validation
    if (!$title || !$adminId) {
        return redirect()->back()->with('error', 'Title and Admin are required');
    }

    // Save task
    $taskModel->insert([
        'title'             => $title,
        'description'       => $description,
        'created_by_role'   => 'superadmin',
        'created_by_id'     => session()->get('user_id'),
        'assigned_admin_id' => $adminId,
        'status'            => 'pending'
    ]);

    return redirect()->back()->with('success', 'Task assigned to admin successfully');
}



}
