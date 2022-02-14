<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Menu extends Seeder
{
    public function run()
    {
        $GroupMenu = $this->db->table('group_menu');
        $Menu = $this->db->table('menu');
        
        $data = [
            'name'  =>  'Device',
            'icon'  =>  'mdi-hardware-memory',
            'url'   =>  'device',
            'group' =>  $GroupMenu->select('id')->where('url', 'bts')->get()->getRow()->id,
            'ordinal'   =>  '1',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Location',
            'group' =>  $GroupMenu->select('id')->where('url','bts')->get()->getRow()->id,
            'icon'  =>  'mdi-maps-pin-drop',
            'url'   =>  'location',
            'ordinal'   =>  '2',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Monitor Link',
            'group' =>  $GroupMenu->select('id')->where('url','bts')->get()->getRow()->id,
            'icon'  =>  'mdi-action-track-changes',
            'url'   =>  'monitor-link',
            'ordinal'   =>  '4',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Customers',
            'group' =>  $GroupMenu->select('id')->where('url','customer')->get()->getRow()->id,
            'icon'  =>  'mdi-social-people',
            'url'   =>  'customers',
            'ordinal'   =>  '1',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Location',
            'group' =>  $GroupMenu->select('id')->where('url','customer')->get()->getRow()->id,
            'icon'  =>  'mdi-maps-pin-drop',
            'url'   =>  'location',
            'ordinal'   =>  '2',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Billing',
            'group' =>  $GroupMenu->select('id')->where('url','customer')->get()->getRow()->id,
            'icon'  =>  'mdi-action-receipt',
            'url'   =>  'billing',
            'ordinal'   =>  '3',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Subscription',
            'group' =>  $GroupMenu->select('id')->where('url','customer')->get()->getRow()->id,
            'icon'  =>  'mdi-action-shop',
            'url'   =>  'internet-subscription',
            'ordinal'   =>  '3',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Problems',
            'group' =>  $GroupMenu->select('id')->where('url','report')->get()->getRow()->id,
            'icon'  =>  'mdi-action-group-work',
            'url'   =>  'problems',
            'ordinal'   =>  '1',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Transaction Histories',
            'group' =>  $GroupMenu->select('id')->where('url','report')->get()->getRow()->id,
            'icon'  =>  'mdi-action-receipt',
            'url'   =>  'transaction-histories',
            'ordinal'   =>  '2',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Group Menu',
            'icon'  =>  'mdi-navigation-menu',
            'url'   =>  'group-menu',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '1',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Menu',
            'icon'  =>  'mdi-navigation-menu',
            'url'   =>  'menu',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '2',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Role',
            'icon'  =>  'mdi-action-assignment-ind',
            'url'   =>  'role',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '3',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'User Role',
            'icon'  =>  'mdi-action-verified-user',
            'url'   =>  'user-role',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '4',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Access',
            'icon'  =>  'mdi-action-lock-open',
            'url'   =>  'access',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '5',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'User',
            'icon'  =>  'mdi-action-perm-identity',
            'url'   =>  'user',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '6',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Master Password',
            'icon'  =>  'mdi-action-lock',
            'url'   =>  'password',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '7',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Transaction Categories',
            'group' =>  $GroupMenu->select('id')->where('url','setting')->get()->getRow()->id,
            'icon'  =>  'mdi-action-receipt',
            'url'   =>  'transaction-categories',
            'ordinal'   =>  '8',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data = [
            'name'  =>  'Internet Plans',
            'icon'  =>  'mdi-action-shop',
            'url'   =>  'internet-plans',
            'group' =>  $GroupMenu->select('id')->where('url', 'setting')->get()->getRow()->id,
            'ordinal'   =>  '9',
            'active'    =>  '1',
            'created_at'    =>  date('Y-m-d H:i:s'),
            'updated_at'    =>  date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

		$data = [
			'name'	=>	'Vendor',
			'icon' =>	'mdi-action-store',
			'url'	=>	'vendor',
			'group'	=>	$GroupMenu->select('id')->where('url','item')->get()->getRow()->id,
			'ordinal'	=>	'1',
			'active'	=>	'1',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$Menu->insert($data);

		$data = [
			'name'	=>	'Stock',
			'icon'	=>	'mdi-hardware-phonelink',
			'url'	=>	'stock',
			'group'	=>	$GroupMenu->select('id')->where('url','item')->get()->getRow()->id,
			'ordinal'	=>	'2',
			'active'	=>	'1',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$Menu->insert($data);

		$data=[
			'name'	=>	'Province',
			'icon'	=>	'mdi-social-domain',
			'url'	=>	'province',
			'group'	=>	$GroupMenu->select('id')->where('url','administrative-division')->get()->getRow()->id,
			'ordinal'	=>	'1',
			'active'	=>	'1',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$Menu->insert($data);

		$data=[
			'name'	=>	'City',
			'icon'	=>	'mdi-social-domain',
			'url'	=>	'city',
			'group'	=>	$GroupMenu->select('id')->where('url','administrative-division')->get()->getRow()->id,
			'ordinal'	=>	'2',
			'active'	=>	'1',
			'created_at'	=>	date('Y-m-d H:i:s'),
			'updated_at'	=>	date('Y-m-d H:i:s')
		];
		$Menu->insert($data);

        $data=[
            'name'=>'District',
            'icon'=>'mdi-social-domain',
            'url'=>'district',
            'group'=>$GroupMenu->select('id')->where('url','administrative-division')->get()->getRow()->id,
            'ordinal'=>'3',
            'active'=>'1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);

        $data=[
            'name'=>'Sub District',
            'icon'=>'mdi-social-domain',
            'url'=>'sub-district',
            'group'=>$GroupMenu->select('id')->where('url','administrative-division')->get()->getRow()->id,
            'ordinal'=>'4',
            'active'=>'1',
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s')
        ];
        $Menu->insert($data);
    }
}
