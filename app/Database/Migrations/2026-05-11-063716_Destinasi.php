<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Destinasi extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'            => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'kategori_id'   => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'admin_id'      => ['type' => 'BIGINT', 'unsigned' => true, 'null' => true],
            'name'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'description'   => ['type' => 'TEXT'],
            'address'       => ['type' => 'TEXT'],
            'latitude'      => ['type' => 'DECIMAL', 'constraint' => '10,8', 'null' => true],
            'longitude'     => ['type' => 'DECIMAL', 'constraint' => '11,8', 'null' => true],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
         
        ]);
        $this->forge->addKey('id', true);
        
        // Relasi ke tabel categories dan users
        $this->forge->addForeignKey('kategori_id', 'kategori', 'id', 'CASCADE', 'SET NULL');
        $this->forge->addForeignKey('admin_id', 'users', 'id', 'CASCADE', 'SET NULL');
        
        $this->forge->createTable('destinasi');
    }

    public function down()
    {
        $this->forge->dropTable('destinasi');
    }
}
