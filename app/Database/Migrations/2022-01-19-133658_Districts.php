<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Districts extends Migration
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
            'city'  =>  [
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
        $this->forge->addForeignKey('city','cities','id','RESTRICT','RESTRICT');
        $this->forge->createTable('districts');
    }

    public function down()
    {
        $this->forge->dropTable('districts');
    }
}
