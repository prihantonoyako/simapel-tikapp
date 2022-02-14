<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProblemUserDispatched extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'    => [
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'auto_increment'	=>	true
			],
			'user'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'null'	=>	false
			],
			'created_at'	=>	[
				'type'	=>	'TIMESTAMP',
				'null'	=>	false
			],
			'updated_at'	=>	[
				'type'	=>	'TIMESTAMP',
				'null'	=>	false
			],
			'deleted_at'	=>	[
				'type'	=>	'TIMESTAMP',
				'null'	=>	true
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('user','users','id','RESTRICT','RESTRICT');
		$this->forge->createTable('problem_user_dispatched');
	}

	public function down()
	{
		$this->forge->dropTable('problem_user_dispatched');
	}
}
