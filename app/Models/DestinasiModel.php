<?php

namespace App\Models;

use CodeIgniter\Model;

class DestinasiModel extends Model
{
    protected $table            = 'destinasi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['kategori_id', 'admin_id', 'name', 'description', 'address', 'latitude', 'longitude'];
    protected $useTimestamps    = true;
}
