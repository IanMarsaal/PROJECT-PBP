<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Destinasi_image extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'             => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'destination_id' => ['type' => 'BIGINT', 'unsigned' => true],
            'image_path'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'is_primary'     => ['type' => 'BOOLEAN', 'default' => false],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('destination_id', 'destinasi', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('destinasi_image');
    }

    public function down()
    {
        $this->forge->dropTable('destinasi_image');
    }
}
