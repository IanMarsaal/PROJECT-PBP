<?php

namespace App\Models;

use CodeIgniter\Model;

class ReviewModel extends Model
{
    protected $table            = 'review';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['destination_review_id', 'user_id', 'rating', 'comment', 'created_at'];
    protected $useTimestamps    = false;
  
 
}
