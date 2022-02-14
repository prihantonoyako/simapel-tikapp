<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GroupMenu extends Seeder
{
    public function run()
    {
		$groupMenu = $this->db->table('group_menu');
        
        $data = [
            'name'  =>  'BTS',
            'icon'  =>  'mdi-action-settings-input-antenna',
            'url'   =>  'bts',
            'ordinal'   =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $groupMenu->insert($data);

        $data = [
            'name'  =>  'Customer',
            'icon'  =>  'mdi-social-people',
            'url'   =>  'customer',
            'ordinal'   =>  '2',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $groupMenu->insert($data);

        $data = [
            'name'  =>  'Report',
            'icon'  =>  'mdi-action-group-work',
            'url'   =>  'report',
            'ordinal'   =>  '3',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $groupMenu->insert($data);

        $data = [
            'name'  =>  'Setting',
            'icon'  =>  'mdi-action-settings',
            'url'   =>  'setting',
            'ordinal'   =>  '4',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $groupMenu->insert($data);

        $data = [
            'name'  =>  'Location',
            'icon'  =>  'mdi-maps-map',
            'url'   =>  'location',
            'ordinal'   =>  '5',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $groupMenu->insert($data);
		
		$data = [
			'name'	=>	'Item',
			'icon'	=>	'mdi-action-shopping-basket',
			'url'	=>	'item',
			'ordinal'	=>	'6',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$groupMenu->insert($data);
		
		$data = [
			'name'	=>	'Administrative-Division',
			'icon'	=>	'mdi-social-domain',
			'url'	=>	'administrative-division',
			'ordinal'	=>	'7',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$groupMenu->insert($data);
    }
}
