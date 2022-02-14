<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BaseTransceiverStations extends Migration
{
    public function up()
    {
        $this->forge->addField([
			'id'	=> [
				'type'           => 'INT',
				'constraint'     => 10,
				'unsigned'       => true,
				'auto_increment' => true,
			],
			'name'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'root'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	10,
				'unsigned'	=>	true,
				'null'	=>	true,
			],
			'mode'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	40,
				'null'	=>	false
			],
			'band'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	15,
				'null'	=>	false
			],
			'channel_width'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	15,
				'null'	=>	false
			],
			'frequency'	=>	[
				'type'	=>	'INT',
				'constraint'	=>	4,
				'unsigned'	=>	true,
				'null'	=>	false
			],
			'radio_name'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'ssid'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	255,
				'null'	=>	false
			],
			'wireless_protocol'	=>	[
				'type'	=>	'VARCHAR',
				'constraint'	=>	20
			],
			'device' => [
				'type' => 'INT',
				'constraint' =>	10,
				'unsigned'	=>	true,
				'null'	=>	false,
				'default'	=>	0
			],
			'active'	=>	[
				'type'	=>	'TINYINT',
				'constraint'	=>	1,
				'unsigned'	=>	true,
				'default'	=>	'0'
			],
			'created_at' => [
                'type'	=> 'TIMESTAMP',
				'null'	=>	false
            ],
            'updated_at' => [
                'type'	=> 'TIMESTAMP',
				'null'	=>	false
			],
			'deleted_at' => [
				'type' => 'TIMESTAMP',
				'null'	=>	true
			]
		]);
		$this->forge->addPrimaryKey('id');
		$this->forge->addForeignKey('device','devices','id','RESTRICT','RESTRICT');
		$this->forge->createTable('base_transceiver_stations');
    }

    public function down()
    {
        $this->forge->dropTable('base_transceiver_stations');
    }
}
