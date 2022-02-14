<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserRoles extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'	=> [
				'type'	=> 'INT',
				'constraint'	=> 10,
				'unsigned'	=>	true,
				'auto_increment'	=>	true,
			],
			'user'	=> [
				'type'	=> 'INT',
				'constraint'	=> 10,
				'unsigned'	=> true,
				'null'	=>	false
			],
			'role' => [
				'type'	=> 'INT',
				'constraint'	=> 10,
				'unsigned'	=> true,
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
		$this->forge->addForeignKey('user','users','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('role','roles','id','RESTRICT','RESTRICT');
		$this->forge->createTable('user_roles');
	}

	public function down()
	{
		$this->forge->dropTable('user_roles');
	}
}