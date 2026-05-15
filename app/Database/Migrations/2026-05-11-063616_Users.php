<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'           => ['type' => 'BIGINT', 'unsigned' => true, 'auto_increment' => true],
            'username'     => ['type' => 'VARCHAR', 'constraint' => 50, 'unique' => true],
            'email'        => ['type' => 'VARCHAR', 'constraint' => 100, 'unique' => true],
            'password'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'phone_number' => ['type' => 'VARCHAR', 'constraint' => 20],
            'role'         => ['type' => 'ENUM', 'constraint' => ['admin', 'pengunjung'], 'default' => 'pengunjung'],
            'api_token'    => ['type' => 'VARCHAR', 'constraint' => 255],
            'created_at'   => ['type' => 'DATETIME', 'null' => true],
            'updated_at'   => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
