<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Accesses extends Migration
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
			'role'	=>	[
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => true,
				'null'	=>	false
			],
			'menu'	=>	[
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => true,
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
		$this->forge->addForeignKey('role','roles','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('menu','menu','id','RESTRICT','RESTRICT');
		$this->forge->createTable('accesses');
	}

	public function down()
	{
		$this->forge->dropTable('accesses');
	}
}