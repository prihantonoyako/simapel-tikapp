<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Role;

class RoleController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();
		
		$Role = new Role();

		$data = [
			'roleRecord' => $Role->paginate(10,'role'),
			'pager' => $Role->pager,
			'recordNumber' => pagination_record_number($request->getGet('page_role'),10),
			'newRecord' => base_url(current_url(true)->setSegment(5,'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5,'edit')->getPath()),
			'showRecord' => base_url(current_url(true)->setSegment(5,'show')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5,'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5,'delete')->getPath())		
		];
		return $view->setData($data)->render('Setting/Role/index');
	}
	
	public function show()
	{
		$view = \Config\Services::renderer();

		$Role = new Role();
		
		$data = [
			'roleRecord'=>$Role->find(current_url(true)->getSegment(6)),
			'url_edit'=>base_url(current_url(true)->setSegment(5,'edit')->getPath()),
			'url_back'=>base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath()),
		];
		
		return $view->setData($data)->render('Setting/Role/show');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$data = [
			'url_action' => base_url(current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5,'')->getPath())
		];
		return $view->setData($data)->render('Setting/Role/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Role = new Role();
		$active = '0';
		if(strcmp($request->getPost('active'),'on')==0){
			$active = '1';
		}
		if($Role
			->where('url',$request->getPost('url'))
			->first()) {
			$session->setFlashdata('conflict', "Role exists!");
			return redirect()->back()->withInput();
		}
		$data = [
			'name' => $request->getPost('name'),
			'url' => $request->getPost('url'),
			'active'=>$active
		];
		if ($Role->insert($data) == false) {
			$session->setFlashdata('errors', $Role->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5,'')->getPath()));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Role = new Role();

		$data = [
			'roleRecord'=>$Role->find(current_url(true)->getSegment(6)),
			'url_action'=>base_url(current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		return $view->setData($data)->render('Setting/Role/edit');
	}
	
	public function update()
	{
		$request = service('request');
		$response = service('response');

		$Role = new Role();

		$active='0';
		if(strcmp($request->getPost('active'),'on')==0){
			$active='1';
		}
		$data = [
			'name' => $request->getPost('name'),
			'url' => $request->getPost('url'),
			'active'=>$active
		];
		if($Role->update(current_url(true)->getSegment(6),$data) == false){
			return redirect()->back()->withInput()
				->with('errors', $Role->errors());
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath()));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Role = new Role();
		
		if ($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent')=="true"){
				$flag=true;
			}
			if($Role->delete($request->getPost('role'),$flag)){
				return $response->setStatusCode(200)->setJSON(['status'=>'DATA ROLE BERHASIL DIHAPUS']);
			}
			return $response->setStatusCode(500)->setJSON(['status'=>'DATA ROLE GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$Role = new Role();

		if($request->isAJAX()){
			$data = ['deleted_at'=>null];
			if($Role->update($request->getPost('roleRestore'),$data)){
				return $response->setStatusCode(200)->setJSON(['message'=>'RESTORE SUCCESS']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
}
