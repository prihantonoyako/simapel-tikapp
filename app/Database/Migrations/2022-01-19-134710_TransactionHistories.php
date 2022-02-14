<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionHistories extends Migration
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
            'category'  =>  [
                'type'  =>  'INT',
                'unsigned'  =>  true,
                'constraint'    =>  10,
                'null'  =>  false
            ],
            'title'  =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
                'null'  =>  false
            ],
            'ammount'   =>  [
                'type'  =>  'DECIMAL',
                'constraint'    =>  '21,2',
                'null'  =>  false
            ],
            'description'   =>  [
                'type'  =>  'TEXT',
                'null'  =>  true
            ],
            'date'  =>  [
                'type'  =>  'DATETIME',
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
        $this->forge->addForeignKey('category','transaction_categories','id','RESTRICT','RESTRICT');
        $this->forge->createTable('transaction_histories');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_histories');
    }
}
