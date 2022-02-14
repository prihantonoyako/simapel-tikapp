<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InternetSubscriptions extends Migration
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
            'customer'  =>  [
                'type'  =>  'INT',
                'unsigned'  =>  true,
                'constraint'    =>  10,
                'null'  =>  false
            ],
            'internet_plan' =>  [
                'type'  =>  'INT',
                'unsigned'  =>  true,
                'constraint'    =>  10,
                'null'  =>  false
            ],
            'cpe'   =>  [
                'type'  =>  'INT',
                'unsigned'  =>  true,
                'constraint'    =>  10,
                'null'  =>  false
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
         $this->forge->addForeignKey('customer','customers','id','RESTRICT','RESTRICT');
         $this->forge->addForeignKey('internet_plan','internet_plans','id','RESTRICT','RESTRICT');
         $this->forge->addForeignKey('cpe','base_transceiver_stations','id','RESTRICT','RESTRICT');
         $this->forge->createTable('internet_subscriptions');
    }

    public function down()
    {
        $this->forge->dropTable('internet_subscriptions');
    }
}
