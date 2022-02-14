<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
			'group'	=>	[
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => true,
				'null'	=>	false
			],
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'url'	=>	[
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'icon' => [
				'type' => 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false,
			],
			'ordinal' => [
				'type' => 'TINYINT',
				'constraint'	=> 3,
				'unsigned'	=> true,
				'null'	=> false
			],
            'active'	=>	[
				'type'	=>	'TINYINT',
                'unsigned'  =>  true,
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
		$this->forge->addForeignKey('group','group_menu','id','RESTRICT','RESTRICT');
		$this->forge->createTable('menu');
	}

	public function down()
	{
		$this->forge->dropTable('menu');
	}
}