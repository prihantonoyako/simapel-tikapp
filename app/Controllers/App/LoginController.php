<?php

namespace App\Controllers\App;

use App\Controllers\BaseController;
use App\Models\User;
use App\Models\Role;
use App\Models\UserRole;
use Config\Services;
use CodeIgniter\Cookie\Cookie;
use CodeIgniter\Cookie\CookieStore;
use DateTime;

class LoginController extends BaseController
{
	public function index()
	{
		$Role = new Role;
		$User = new User;

		if ($this->session->has('is_login')) {
			if ($this->session->has('id_role')) {
				$role = $Role->find($this->session->get('id_role'));
				return redirect()->to($this->uri->setSegment(2,'dashboard')->setSegment(3,$role->url));
			}
			return $this->view->render('login');
		} else {
			if(isset($_COOKIE['username'])){
				$user = $User
					->where('username',$_COOKIE['username'])
					->orWhere('email',$_COOKIE['username'])
					->first();
				if(is_null($user->avatar)){
					$avatar = 'images/avatar-default.png';
				} else{
					$avatar = "uploads/".$user->avatar;
				}
				$data = [
					'username'	=>	$user->username,
					'avatar'	=>	base_url($avatar)
				];
				return $this->view->setData($data)->render('user-lock');
			}
		}
		return $this->view->render('login');
	}

	public function login()
	{
		$User = new User;
		$UserRole = new UserRole;
		$Role = new Role;

		$data = [
			'username'	=> $this->request->getPost('username'),
			'password'	=> $this->request->getPost('password')
		];

		$this->validation->setRuleGroup('login');
		$validated = $this->validation->run($data);
		$errors = $this->validation->getErrors();
		if (!$validated) {
			$this->session->setFlashdata('errors', $errors);
			return redirect()->back();
		}

		$user = $User
			->where('username',$this->request->getPost('username'))
			->orWhere('email',$this->request->getPost('username'))
			->where('active','1')
			->first();
		if (!$user) {
			return redirect()->back();
		}
		if (!password_verify(
			$this->request->getPost('password'),
			$user->password
		)) {
			return redirect()->back();
		}

		if($this->request->getPost('remember-me')=="on"){
			$this->set_cookie_simapel('username',$this->request->getPost('username'),time()+60*60*24*5);
		}

		$firstRole = $UserRole->where('user', $user->id)->first();

		$role = $Role->find($firstRole->role);
		$loggedIn = [
			'id_user' => $user->id,
			'id_role'	=>	$firstRole->id,
			'is_login'	=>	1,
		];
		$this->session->set($loggedIn);
		return redirect()->to(
			$this->uri->setSegment(2,'dashboard')->setSegment(3,$role->url)
		);
	}
	
	public function lock(){
		$this->session->destroy();
		return redirect()->to(base_url());
	}

	public function logout()
	{
		helper('cookie');
		$this->session->destroy();
		$this->set_cookie_simapel('username','',time()+60*60*(-1));
		return redirect()->to(base_url());
	}

	private function set_cookie_simapel($key,$value,$expire){
		$cookie = new Cookie(
			$key,
			$value,
			[
				'expires'	=>	$expire,
				'prefix'	=>	'',
				'path'	=>	'/',
				'domain'	=>	'',
				'secure'	=>	false,
				'httponly'	=>	true,
				'raw'	=>	false,
				'samesite'	=>	Cookie::SAMESITE_LAX
			]
		);
		$storeCookie = new CookieStore([$cookie]);
		$storeCookie->dispatch();
	}

	public function forgot_password()
	{
		dd();
	}
}
