<?php

namespace App\Models;

use CodeIgniter\Model;

class Destinasi_ImageModel extends Model
{
    protected $table            = 'destinasi_image';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['destination_id', 'image_path', 'is_primary', 'created_at'];
    protected $useTimestamps    = false; // Karena hanya ada created_at
}
