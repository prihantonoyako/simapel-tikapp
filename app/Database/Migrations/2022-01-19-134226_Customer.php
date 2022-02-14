<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'	=> [
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=> true,
				'auto_increment' => true,
			],
			'first_name'	=>	[
				'type'	=> 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'last_name'	=> [
				'type'	=> 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'email'	=> [
				'type'	=> 'VARCHAR',
				'constraint' => 255,
				'null'	=>	false
			],
			'address' => [
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => true,
				'null' => true
			],
			'active'	=> [
				'type'	=> 'TINYINT',
				'unsigned'	=>	true,
				'constraint' => 1,
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
			'deleted_at'	=>	[
				'type'	=>	'TIMESTAMP',
				'null'	=>	true
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('address','locations','id','RESTRICT','RESTRICT');
		$this->forge->createTable('customers');
    }

    public function down()
    {
        $this->forge->dropTable('customers');
    }
}
