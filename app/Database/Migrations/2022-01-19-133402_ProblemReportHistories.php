<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProblemReportHistories extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'    =>  [
				'type'  =>  'INT',
				'unsigned'  =>  true,
				'constraint'    =>  10,
				'auto_increment'    =>  true
			],
			'problem_report'    =>  [
				'type'  =>  'INT',
				'unsigned'  =>  true,
				'constraint'    =>  10,
				'null'  =>  false
			],
			'user'  =>  [
				'type'  =>  'INT',
				'unsigned'	=>	true,
				'constraint'	=>	10,
				'null'	=>	false
			],
			'log'	=>	[
				'type'	=>	'INT',
				'unsigned'	=>	true,
				'constraint'	=>	10,
				'null'	=>	false
			],
			'active'	=>	[
				'type'	=>	'TINYINT',
				'unsigned'	=>	true,
				'constraint'	=>	1,
				'default'	=>	'0'
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
		$this->forge->addForeignKey('problem_report','problem_reports','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('user','users','id','RESTRICT','RESTRICT');
		$this->forge->addForeignKey('log','logs','id','RESTRICT','RESTRICT');
		$this->forge->createTable('problem_report_histories');
	}

	public function down()
	{
		$this->forge->dropTable('problem_report_histories');
	}
}
