<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Icons extends Migration
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
            'name'   =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  100,
                'null'  =>  false
            ],
            'created_at'    =>  [
                'type'  =>  'TIMESTAMP',
                'null'  =>  false
            ],
            'updated_at'    =>  [
                'type'  =>  'TIMESTAMP',
                'null'  =>  false
            ],
            'deleted_at'    =>  [
                'type'  =>  'TIMESTAMP',
                'null'  =>  true
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('icons');
    }

    public function down()
    {
        $this->forge->dropTable('icons');
    }
}
