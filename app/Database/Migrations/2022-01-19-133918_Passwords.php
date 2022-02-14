<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Passwords extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'	=> [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'	=> [
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'username'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'password'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'created_at' => [
				'type'	=> 'TIMESTAMP',
				'null'	=>	false
			],
			'updated_at' => [
				'type'	=> 'TIMESTAMP',
				'null'	=>	false
			],
			'deleted_at' => [
				'type' => 'TIMESTAMP',
				'null'	=>	true
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('passwords');
    }

    public function down()
    {
        $this->forge->dropTable('passwords');
    }
}
