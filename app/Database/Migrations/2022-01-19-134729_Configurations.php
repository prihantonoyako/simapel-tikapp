<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Configurations extends Migration
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
            'key'   =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
                'null'  =>  false
            ],
            'value' =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
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
        $this->forge->createTable('configurations');
    }

    public function down()
    {
        $this->forge->dropTable('configurations');
    }
}
