<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
Use App\Models\Access;
use App\Models\Menu;
use App\Models\Role;
use App\Models\GroupMenu;

class AksesController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$view = \Config\Services::renderer();
		$request = service('request');

		$Role = new Role();
		$Access = new Access();
		$Menu = new Menu();
		$GroupMenu = new GroupMenu();

		/* groupMenu[group_menu_ID] = [
			'name' => group_menu_name
		]
		*/
		$groupMenus = array();

		/* menu[menuID] = [
			'name' => menu's name,
			'group_menu' => group_menu_ID
		]
		*/
		$menus = array();

		// roles->access = [ group_menu1.menu1,group_menu2.menu2]
		$roles = $Role->paginate(10,'role');

		foreach($roles as $role) {
			$accessRole = array();
			$accesses = $Access->where('role', $role->id)->findAll();
			foreach($accesses as $access) {
				if(array_key_exists($access->menu,$menus)) {
					$menu = $menus[$access->menu];
					$accessName = $groupMenus[$menu['group_menu']] . 
						"." . $menu['name'];
					array_push($accessRole,$accessName);
				} else {
					$menu = $Menu->find($access->menu);
					$menus[$menu->id] = array(
						'name' => $menu->name,
						'group_menu' => $menu->group
					);
					if(array_key_exists($menu->group,$groupMenus)) {
						$groupMenu = $groupMenus[$menu->group];
						$accessName = $groupMenu['name'] . "." . $menu->name;
						array_push($accessRole,$accessName);
					} else {
						$groupMenu = $GroupMenu->find($menu->group);
						$groupMenus[$groupMenu->id] = array(
							'name' => $groupMenu->name
						);
						$accessName = $groupMenu->name . "." . $menu->name;
						array_push($accessRole,$accessName);
					}
				}
			}
			$role->access = $accessRole;
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rolesRecord' => $roles,
			'pager' => $Role->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_role'), 10),
			'rendering_time' => $rendering_time,
			'editRecord' => base_url(
				current_url(true)->setSegment(5,'edit')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5,'delete')->getPath())
		];

		return $view->setData($data)->render('Setting/Akses/index');
	}
	
	
	public function edit()
	{
		$view = \Config\Services::renderer();

		$GroupMenu = new GroupMenu();
		$Menu = new Menu();
		$Role = new Role();
		$Access = new Access();
		
		$accesses = array();
		$impossibleAccesses = array();
		$possibleAccesses = null;
		$accessRole = $Access
			->where('role', current_url(true)->getSegment(6))->findAll();
		foreach($accessRole as $access){
			array_push($accesses,$Menu->find($access->menu));
			array_push($impossibleAccesses,$access->menu);
		}
		if(!empty($impossibleAccesses)) {
			$possibleAccesses = $Menu
				->whereNotIn('id',$impossibleAccesses)
				->findAll();
		} else {
			$possibleAccesses = $Menu->findAll();
		}

		foreach($possibleAccesses as $possibleAccess) {
			$groupMenu = $GroupMenu->find($possibleAccess->group);
			$possibleAccess->group = $groupMenu->name;
		}
		foreach($accesses as $access) {
			$groupMenu = $GroupMenu->find($access->group);
			$access->group = $groupMenu->name;
		}
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		
		$data = [
			'roleRecord' => $Role->find(current_url(true)->getSegment(6)),
			'possibleAccesses' => $possibleAccesses,
			'accesses' => $accesses,
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)
				->setSegment(5,'')
				->setSegment(5,'create')
				->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		return $view->setData($data)->render('Setting/Akses/edit');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Access = new Access;
		
		if($Access
			->where('role',$request->getPost('role'))
			->where('menu',$request->getPost('menu'))
			->first()) {
			$session->setFlashdata('conflict',"Access exists!");
			return redirect()->back()->withInput();
		}
		
		$data = [
			'role' => $request->getPost('role'),
			'menu' => $request->getPost('menu')
		];

		if ($Access->insert($data) == false) {
			$session->setFlashdata('errors',$Access->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(
			current_url(true)
			->setSegment(5,'edit')
			->setSegment(6,$request->getPost('role')));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Access = new Access;
		$access = $Access
			->where('role', current_url(true)->getSegment(6))
			->where('menu', $request->getPost('accessDelete'))
			->first();
		if ($request->isAJAX()) {
			if($Access->delete($access->id,true)){
				return $response->setStatusCode(200)->setJSON(['status'=>'DATA AKSES BERHASIL DIHAPUS']);
			}
			return $response->setStatusCode(500)->setJSON(['status'=>'DATA AKSES GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}
}
