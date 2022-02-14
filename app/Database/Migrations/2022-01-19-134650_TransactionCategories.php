<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TransactionCategories extends Migration
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
            'name'  =>  [
                'type'  =>  'VARCHAR',
                'constraint'    =>  255,
                'null'  =>  false
            ],
            'is_income' =>  [
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
        $this->forge->createTable('transaction_categories');
    }

    public function down()
    {
        $this->forge->dropTable('transaction_categories');
    }
}
