<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    // Nama tabel di database Anda (Pastikan benar!)
    protected $table      = 'review'; 
    
    // Primary key di tabel review
    protected $primaryKey = 'id';

    // SATPAM: Daftar kolom yang diizinkan untuk diisi data
    protected $allowedFields = [
        'destination_review_id', 
        'user_id', 
        'rating', 
        'comment'
    ];

    // Aktifkan ini jika tabel Anda punya kolom created_at dan updated_at
    protected $useTimestamps = true; 
}