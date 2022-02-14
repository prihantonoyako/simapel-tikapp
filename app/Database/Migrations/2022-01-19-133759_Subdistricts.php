<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Subdistricts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'    =>  [
                'type'  =>  'INT',
                'constraint'    =>  10,
                'unsigned'  =>  true,
                'auto_increment'    =>  true
            ],
            'name'  =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
                'null'  =>  false
            ],
            'district'  =>  [
                'type'  =>  'INT',
                'constraint'    =>  10,
                'unsigned'  =>  true,
                'null'  =>  false
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
        $this->forge->addForeignKey('district','districts','id','RESTRICT','RESTRICT');
        $this->forge->createTable('subdistricts');
    }

    public function down()
    {
        $this->forge->dropTable('subdistricts');
    }
}
