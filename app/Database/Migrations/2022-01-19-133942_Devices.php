<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Devices extends Migration
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
			'ip_address'       => [
				'type'       => 'VARCHAR',
				'constraint' => 15,
				'null'	=>	false
			],
			'password'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'null'	=>	false
			],
			'active'	=>	[
				'type'       => 'TINYINT',
				'unsigned'	=>	true,
				'constraint' => 1,
				'default'	=>	'0'
			],
			'item' => [
				'type' => 'INT',
				'constraint' =>	10,
				'unsigned'	=>	true,
				'null'	=>	false,
			],
			'location' => [
				'type' => 'INT',
				'constraint' =>	10,
				'unsigned'	=>	true,
				'null'	=>	false,
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
		$this->forge->addForeignKey('item','items','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('location','locations','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('password','passwords','id','RESTRICT','RESTRICT');
		$this->forge->createTable('devices');
    }

    public function down()
    {
        $this->forge->dropTable('devices');
    }
}
