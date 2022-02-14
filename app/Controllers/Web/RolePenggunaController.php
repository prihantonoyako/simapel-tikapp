<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use App\Libraries\Paginator;

class RolePenggunaController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$User = new User;
		$Role = new Role;
		$UserRole = new UserRole;

		$Paginator = new Paginator(10,base_url($this->uri->getPath()),'user_role');
		$Paginator->set_record_count($User->builder()->countAll());
		$Paginator->set_page_number($this->request->getGet('page_user_role'));
		$usersRoles = array();
		$userRoleRecord = $User->builder()
			->where('users.deleted_at',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($this->request->getGet('page_user_role')))
			->get()->getResult();
		foreach($userRoleRecord as $user) {
			 $temp = $UserRole->where('user',$user->id)->findAll();
			 $roles= array();
			 foreach($temp as $item){
				array_push($roles,$Role->find($item->role)->name);
			 }
			 $usersRoles[$user->id] = $roles;
		}
		$data = [
			'userRecord'=>$userRoleRecord,
			'userRoleRecord'=>$usersRoles,
			'Paginator'=>$Paginator,
			'recordIndex' => $Paginator->get_first_index(),
			'newRecord' => base_url(
				current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(
				current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(
				current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath())
		];
		return $view->setData($data)->render('Setting/RolePengguna/index');
	}
	
	
	public function edit()
	{
		$User = new User;
		$Role = new Role;
		$UserRole = new UserRole;
		$userRoles = array();
		$impossibleRoles = array();
		$possibleRoles = null;
		foreach($UserRole->where('user',$this->uri->getSegment(6))->findAll() as $roles){
			array_push($userRoles,$Role->find($roles->role));
			array_push($impossibleRoles,$roles->role);
		}
		if(!empty($impossibleRoles)){
			$possibleRoles = $Role->builder()->whereNotIn('id',$impossibleRoles)->get()->getResult();
		}else {
			$possibleRoles = $Role->findAll();
		}

		$data = [
			'user'=>$User->find($this->uri->getSegment(6)),
			'possibleRoles'=>$possibleRoles,
			'userRoles'=>$userRoles,
			'url_action'=>base_url($this->uri->setSegment(5,'')->setSegment(5,'create')->getPath()),
			'url_back'=>base_url($this->uri->setSegment(5,'')->getPath())
		];
		return $this->view->setData($data)->render('Setting/RolePengguna/edit');
	}

	public function create() {
		$UserRole = new UserRole;
		if($UserRole
			->where('role',$this->request->getPost('role'))
			->where('user',$this->request->getPost('user'))
			->first()){
			$this->session->setFlashdata('conflict',"User roles exists!");
			return redirect()->back()->withInput();
		}
		$data = [
			'user' => $this->request->getPost('user'),
			'role' => $this->request->getPost('role')
		];
		if ($UserRole->insert($data) == false) {
			$this->session->setFlashdata('errors',$UserRole->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(
			$this->uri
				->setSegment(5, 'edit')
				->setSegment(6,$this->request->getPost('user'))
				->getPath()
		));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');
		
		$UserRole = new UserRole;
		
		$userRole = $UserRole
			->where('user', current_url(true)->getSegment(6))
			->where('role', $request->getPost('roleDelete'))
			->first();
		if ($request->isAJAX()) {
			if($UserRole->delete($userRole->id,true)) {
				return $response->setStatusCode(200)
					->setJSON(['status'=>'DATA ROLE PENGGUNA BERHASIL DIHAPUS']);
			}
			return $response->setStatusCode(500)
				->setJSON(['status'=>'DATA ROLE PENGGUNA GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}
}
