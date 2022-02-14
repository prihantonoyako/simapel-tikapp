<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Locations extends Migration
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
            'street'    =>  [
                'type'  =>  'TINYTEXT',
                'null'  =>  true
            ],
            'neighborhood'   =>  [
                'type'  =>  'TINYINT',
                'unsigned'  =>  true,
                'constraint'    =>  3,
                'null'  =>  true
            ],
            'hamlet'    =>  [
                'type'  =>  'TINYINT',
                'unsigned'  =>  true,
                'constraint'    =>  3,
                'null'  =>  true
            ],
            'subdistrict'  =>  [
                'type'  =>  'INT',
                'constraint'    =>  10,
                'unsigned'  =>  true,
                'null'  =>  false
            ],
            'latitude'  =>  [
                'type'  =>  'FLOAT',
                'constraint'    =>  '20,16',
                'null'  =>  false
            ],
            'longitude' =>  [
                'type'  =>  'FLOAT',
                'constraint'    =>  '20,16',
                'null'  =>  false
            ],
            'location_type'  =>  [
                'type'  =>  'TINYINT',
                'constraint'    =>  1,
                'unsigned'  =>  true,
                'default'  =>  '0'
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
        $this->forge->addForeignKey('subdistrict','subdistricts','id','RESTRICT','RESTRICT');
        $this->forge->createTable('locations');
    }

    public function down()
    {
        $this->forge->dropTable('locations');
    }
}
