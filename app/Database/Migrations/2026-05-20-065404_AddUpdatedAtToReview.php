<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

// PENTING: Nama class ini (AddUpdatedAtToReview) HARUS SAMA dengan nama file setelah angka tanggal!
class AddUpdatedAtToReview extends Migration
{
    public function up()
    {
        // Menambahkan kolom updated_at ke tabel review
        $fields = [
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ];
        
        $this->forge->addColumn('review', $fields);
    }

    public function down()
    {
        $this->forge->dropColumn('review', 'updated_at');
    }
}