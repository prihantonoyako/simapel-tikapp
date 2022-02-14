<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InternetPlans extends Migration
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
			'dedicated'	=>	[
				'type'	=>	'TINYINT',
                'unsigned'  =>  true,
				'constraint'	=>	1,
				'default'	=>	'0'
			],
			'download'       => [
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'	=>	true,
				'null'	=>	false
			],
			'download_unit' => [ 
				'type' => 'CHAR',
				'constraint' => 1,
				'null' => true
			],
			'upload'       => [
				'type'       => 'INT',
				'constraint' => 10,
				'unsigned'	=>	true,
				'null'	=>	false
			],
			'upload_unit' => [ 
				'type' => 'CHAR',
				'constraint' => 1,
				'null' => true
			],
			'price'       => [
				'type'       => 'DECIMAL',
				'constraint' => '21,2',
				'null'	=>	false
			],
			'created_at' => [
                'type'	=> 'DATETIME',
				'null'	=>	false

            ],
            'updated_at' => [
                'type'	=> 'DATETIME',
				'null'	=>	false
			],
			'deleted_at'	=>	[
				'type'	=>	'DATETIME',
				'null'	=>	true
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->createTable('internet_plans');
    }

    public function down()
    {
        $this->forge->dropTable('internet_plans');
    }
}
