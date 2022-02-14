<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
			'username'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'password' => [
				'type' => 'CHAR',
				'constraint' => 60,
				'null'	=>	false,
			],
			'email' => [
				'type' => 'VARCHAR',
				'constraint'	=>	255,
				'null'	=> false
			],
			'avatar'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	true
			],
			'active' => [
				'type'	=> 'TINYINT',
				'unsigned'	=>	true,
				'constraint'	=>	1,
				'default'	=>	'0'
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
		$this->forge->createTable('users');
	}

	public function down()
	{
		$this->forge->dropTable('users');
	}
}