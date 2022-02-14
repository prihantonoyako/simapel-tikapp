<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\User;

class PenggunaController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$User = new User();
		
		$data = [
			'userRecord' => $User->paginate(10,'user'),
			'pager' => $User->pager,
			'recordNumber' => pagination_record_number($request->getGet('page_user'),10),
			'newRecord' => base_url(current_url(true)->setSegment(5,'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5,'edit')->getPath()),
			'showRecord' => base_url(current_url(true)->setSegment(5,'show')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5,'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5,'delete')->getPath())
		];
		return $view->setData($data)->render('Setting/Pengguna/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$data = [
			'url_action' => base_url(current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)->render('Setting/Pengguna/new');
	}
	
	public function show()
	{
		$view = \Config\Services::renderer();

		$User = new User();

		$avatarRecord = base_url('uploads/avatar-admin.png');
		$userRecord = $User->find(current_url(true)->getSegment(6));
		if(!is_null($userRecord->avatar)){
			$avatarRecord = base_url('uploads/'.$userRecord->avatar);
		}
		$data = [
			'userRecord'=>$User->find(current_url(true)->getSegment(6)),
			'url_edit'=>base_url(current_url(true)->setSegment(5,'edit')->getPath()),
			'url_back'=>base_url(
				current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath()
				),
			'avatarRecord'=>$avatarRecord
		];
		return $view->setData($data)->render('Setting/Pengguna/show');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$User = new User();

		$avatarPath = null;
		$active = '0';
		if ($User
			->where('username', $request->getPost('username'))
			->orWhere('email', $request->getPost('email'))
			->first()
		) {
			$session->setFlashdata('conflict',"User exists!");
			return redirect()->back()->withInput();
		}
		if(strcmp($request->getPost('active'),'on')==0){
			$active = '1';
		}
		if(!is_null($request->getFile('avatar'))){
			$avatar = $request->getFile('avatar');
			$ext = $avatar->guessExtension();
			$avatarPath = $avatar->store(
				'Avatar/', 
				$request->getPost('username').$request->getPost('email').'.'.$ext
			);
		}
		$data = [
			'username' => $request->getPost('username'),
			'password' => password_hash(
				$request->getPost('password'),
				PASSWORD_BCRYPT,
				["cost" => 8]
			),
			'email' => $request->getPost('email'),
			'avatar'=>$avatarPath,
			'active'=>$active
		];
		if ($User->insert($data) == false) {
			$session->setFlashdata('errors',$User->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5, '')->getPath()));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$User = new User();
		
		$data = [
			'userRecord'=>$User->find(current_url(true)->getSegment(6)),
			'url_action'=>base_url(current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath())
		];

		return $view->setData($data)->render('Setting/Pengguna/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$User = new User();

		$data = [
			'username' => $request->getPost('username'),
			'password' => password_hash(
				$request->getPost('password'),
				PASSWORD_BCRYPT,
				["cost" => 8]
			),
			'email' => $request->getPost('email')
		];

		if ($User->update(current_url(true)->getSegment(6), $data) == false) {
			$session->setFlashdata('errors',$User->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath()));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$User = new User();
		
		if ($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent')=="true"){
				$flag=true;
			}
			if ($User->delete($request->getPost('user_id'),$flag)) {
				return $response->setStatusCode(200)->setJSON(['status' => 'DATA PENGGUNA BERHASIL DIHAPUS']);
			}
			return $response->setStatusCode(500)->setJSON(['status' => 'DATA PENGGUNA GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}
	
	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$User = new User();
		
		if($request->isAJAX()){
			$data = ['deleted_at'=>null];
			if($User->update($request->getPost('userRestore'),$data)){
				return $response->setStatusCode(200)->setJSON(['message'=>'RESTORE SUCCESS']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
}
