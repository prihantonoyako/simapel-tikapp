<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GroupMenu extends Migration
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
			'name'       => [
				'type'       => 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'url'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
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
		$this->forge->createTable('group_menu');
	}

	public function down()
	{
		$this->forge->dropTable('group_menu');
	}
}