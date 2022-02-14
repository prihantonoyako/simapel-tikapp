<?php

namespace App\Controllers\App;

use App\Controllers\BaseController;
use App\Models\User;

class RegisterController extends BaseController
{
	public function index()
	{
		return redirect()->back();
	}

	public function new()
	{
		$data = [
			'url_action'=>base_url($this->uri->setSegment(4,'create')->getPath())
		];
		return $this->view->setData($data)->render('App\register');
	}

	public function create()
	{
		$User = new User;
		$data = [
			'username'=>$this->request->getPost('username'),
			'password'=>$this->request->getPost('password'),
			'email'=>$this->request->getPost('email'),
			'active'=>'1'
		];
		if($User->insert($data)==false){
			$this->session->setFlashdata('errors',$User->errors());
			return redirect()->back()->withInput();
		}
	}
}
