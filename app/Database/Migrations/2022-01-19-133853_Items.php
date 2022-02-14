<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Items extends Migration
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
			'quantity'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'null'	=>	false,
				'default'	=>	0
			],
			'used'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'null'	=>	false,
				'default'	=>	0
			],
			'is_bts' => [
				'type' => 'TINYINT',
				'constraint' =>	1,
				'unsigned'	=>	true,
				'default'	=>	'0',
			],
			'vendor'	=>	[
				'type'       => 'INT',
				'constraint' => 10,
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
		$this->forge->addForeignKey('vendor','vendors','id','RESTRICT','RESTRICT');
		$this->forge->createTable('items');
	}

	public function down()
	{
		$this->forge->dropTable('items');
	}
}
