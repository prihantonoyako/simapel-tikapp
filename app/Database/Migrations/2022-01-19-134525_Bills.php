<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bills extends Migration
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
            'internet_subscription' =>  [
                'type'  =>  'INT',
                'unsigned'  =>  true,
                'constraint'    =>  10,
                'null'  =>  false
            ],
            'month' =>  [
                'type'  =>  'TINYINT',
                'unsigned'  =>  true,
                'constraint'    =>  2,
                'null'  =>  false
            ],
            'year'  =>  [
                'type'  =>  'YEAR',
                'constraint'    =>  4,
                'null'  =>  false
            ],
            'paid_time' =>  [
                'type'  =>  'TIMESTAMP',
                'null'  =>  true
            ],
            'active'    =>  [
                'type'  =>  'TINYINT',
                'unsigned'  =>  true,
                'constraint'    =>  1,
                'default'   =>  '0'
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
        $this->forge->addForeignKey('internet_subscription','internet_subscriptions','id','RESTRICT','RESTRICT');
        $this->forge->createTable('bills');
    }

    public function down()
    {
        $this->forge->dropTable('bills');
    }
}
