<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

/* class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        //$role = session()->get('role');

        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Unauthorized');
        }

        //check if Admin is approved (only for admin role, not superadmin)
        $role = session()->get('role');
        $isApproved = session()->get('is_approved');

        if($role === 'admin' && $isApproved == 0){
            // Admin is not approved - redirect to pending page
            $currentPath = $request->getUri()->getPath();

            // Allow access only to pending and logout routes
            if (!in_array($currentPath, ['admin/pending', 'logout'])) {
                return redirect()->to('/admin/pending');
            }
        }
        return null; 
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Nothing
    }
} */

    class RoleFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if (!session()->get('isLoggedIn')) {
            return redirect()->to('/login')->with('error', 'Please login first');
        }
        // Get fresh user data from database
        $userModel = new \App\Models\UserModel();
        $userId = session()->get('user_id');
        $user = $userModel->find($userId);

        // Update session with fresh data
        if ($user) {
            session()->set([
                'is_approved' => $user['is_approved'] ?? 0,
                'role' => $user['role']
            ]);
        }

        // Get current URI
        $uri = $request->getUri();
        $currentPath = $uri->getPath();
        
        // Remove base path if present
        $currentPath = str_replace('/simple-crud-codeigniter4/index.php', '', $currentPath);
        $currentPath = str_replace('/simple-crud-codeigniter4', '', $currentPath);
        $currentPath = trim($currentPath, '/');

        // Check if admin is approved (only for admin role, not superadmin)
        $role = session()->get('role');
        $isApproved = session()->get('is_approved');
        
        // Allow pending page and logout without redirect
        if ($currentPath === 'admin/pending' || $currentPath === 'logout') {
            return null;
        }
        
        // If admin is not approved, redirect to pending
        if ($role === 'admin' && $isApproved == 0) {
            return redirect()->to(base_url('admin/pending'));
        }

        return null;
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}
