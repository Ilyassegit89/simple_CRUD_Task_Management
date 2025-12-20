<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');

$routes->get('signup', 'Auth::signup');
$routes->post('signup', 'Auth::signupPost');

$routes->group('superadmin', ['filter' => 'role:superadmin'], function($routes){
    $routes->get('dashboard', 'SuperAdmin::dashboard');
    $routes->get('manage_admins', 'SuperAdmin::manage_admins');
    $routes->get('manage_members', 'SuperAdmin::manage_members');
    $routes->post('approve/(:num)', 'Superadmin::approve/$1');
    $routes->post('delete/(:num)', 'Superadmin::delete/$1');
    $routes->get('edit/(:num)', 'Superadmin::edit/$1');

    // POST route for updating member admin assignment
    $routes->post('update-member-admin', 'Superadmin::updateMemberAdmin');
});

//$routes->post('superadmin/update-member-admin', 'SuperAdmin::updateMemberAdmin');




$routes->group('admin', ['filter' => 'role:admin'], function($routes){
    $routes->get('pending', 'Admin::pending'); // No filter here!
    $routes->get('dashboard', 'Admin::dashboard', ['filter' => 'auth']);
    $routes->get('members', 'Admin::members', ['filter' => 'auth']);

});


$routes->group('member', ['filter' => 'role:member'], function($routes){
    $routes->get('dashboard', 'Member::dashboard');
    $routes->get('tasks', 'Member::tasks');
});

$routes->get('logout', 'Auth::logout');

