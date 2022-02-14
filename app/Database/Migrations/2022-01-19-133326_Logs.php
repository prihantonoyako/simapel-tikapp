<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Logs extends Migration
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
            'title' =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
                'null'  =>  false
            ],
            'description'   =>  [
                'type'  =>  'TEXT',
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
        $this->forge->createTable('logs');
    }

    public function down()
    {
        $this->forge->dropTable('logs');
    }
}
