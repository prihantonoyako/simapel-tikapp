<?php

// This namespace is for application dashboard based on role.
namespace App\Controllers\Web;

use App\Controllers\BaseController;
use App\Models\Access;
use App\Models\GroupMenu;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Notification;

class DashboardController extends BaseController
{
	public function index()
	{
		timer('app benchmark');
		$User = new User;
		$Role = new Role;
		$Access = new Access;
		$UserRole = new UserRole;
		$GroupMenu = new GroupMenu;
		$Notification = new Notification;
		$avatar = null;

		$user = $User->find($this->session->get('id_user'));
		$role = $Role->where('url', $this->uri->getSegment(3))->first();
		$this->session->set('id_role', $role->id);
		
		if(is_null($user->avatar)){
			$avatar = "images/avatar-default.png";
		} else {
			$avatar = "uploads".$user->avatar;
		}
		$avatar = base_url($avatar);
		$userRole = $UserRole->where('user', $user->id)
			->builder()
			->join('roles', 'user_roles.role = roles.id')
			->get()->getResult();
		//get akses to menu from db
		$access = $Access
			->select(
				'accesses.menu as id_menu,
				menu.group as id_group,
				menu.url as url_menu,
				menu.icon as icon_menu,
				menu.name as name_menu'
			)
			->where('role', $role->id)
			->builder()
			->join('menu', 'accesses.menu = menu.id')
			->where('active',(int) 1)
			->orderBy('ordinal')
			->get()->getResult();

		if ($access) {
			//get group have child menu
			$groupMenuId = array();
			foreach ($access as $item) {
				$temp = $item->id_group;
				if (!in_array($temp, $groupMenuId)) {
					array_push($groupMenuId, $temp);
				}
			}
			$groupMenu = $GroupMenu->builder()
				->havingIn('id', $groupMenuId)
				->orderBy('ordinal')
				->get()->getResult();
		} else {
			$groupMenu = array();
		}

		timer('app benchmark');

		$rendering_time = timer()->getElapsedTime('app benchmark');
		 
		$data = [
			'avatar'	=>	$avatar,
			'rendering_time'	=>	$rendering_time,
			'active_role'	=>	$role,
			'role'	=>	$userRole,
			'menu'	=>	$access,
			'group_menu'	=>	$groupMenu,
			'username'	=>	$user->username,
			'title'	=>	'Dashboard ' . ucfirst(strtolower($role->name)),
			'notifications'	=>	$Notification
				->where('user',null)
				->where('active',(int)1)
				->orWhere('user',$user->id)
				->findAll()
		];
		return $this->view
			->setData($data)
			->render('Dashboard' ."/". $role->url);
	}
}
