<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'email', 'password', 'phone_number', 'role', 'api_token'];
    protected $useTimestamps    = true; // Otomatis mengisi created_at & updated_at
}
