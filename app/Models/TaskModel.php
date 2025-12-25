<?php

namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'title',
        'description',
        'parent_task_id',
        'created_by_role',
        'created_by_id',
        'assigned_admin_id',
        'assigned_member_id',
        'status'
    ];

    protected $returnType = 'array';
}
