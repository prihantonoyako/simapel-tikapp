<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Password;

class PasswordController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Password = new Password;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'passwords' => $Password->paginate(10,'password'),
			'pager' => $Password->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_password'),10),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5,'new')->getPath()),
			'editRecord' => base_url(
				current_url(true)->setSegment(5,'edit')->getPath()),
			'showRecord'=>base_url(
				current_url(true)->setSegment(5,'show')->getPath()),
			'recycleRecord'=>base_url(
				current_url(true)->setSegment(5,'recycle')->getPath()),
			'deleteRecord'=>base_url(
				current_url(true)->setSegment(5,'delete')->getPath())
		];

		return $view->setData($data)->render('Setting/Password/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5,'')->getPath())
		];

		return $view->setData($data)->render('Setting/Password/new');
	}

	public function show()
	{
		$view = \Config\Services::renderer();
		$Password = new Password();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'password' => $Password->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_edit' => base_url(
				current_url(true)->setSegment(5,'edit')->getPath()),
			'url_back' => base_url(
				current_url(true)
					->setSegment(5,'')
					->setSegment(5,'')
					->getPath())
		];
		return $view->setData($data)->render('Setting/Password/show');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Password = new Password();

		$data = [
			'name' => $request->getPost('name'),
			'username' => $request->getPost('username'),
			'password' => $request->getPost('password')
		];

		if ($Password->insert($data) == false) {
			$session->setFlashdata('errors',$Password->errors());
			return redirect()->back()->withInput();
		}
		return redirect()
			->to(base_url(current_url(true)->setSegment(5, '')->getPath()), 200, 'GET');
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Password = new Password();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'password' => $Password->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(
				current_url(true)
					->setSegment(5,'')
					->setSegment(5,'')
					->getPath())
		];

		return $view->setData($data)->render('Setting/Password/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$Password = new Password();

		$data = [
			'name' => $request->getPost('name'),
			'username' => $request->getPost('username'),
			'password' => $request->getPost('password')
		];
		if (
			$Password->update(current_url(true)->getSegment(6), $data)
			== false
		) {
			$session->setFlashdata('errors',$Password->errors());
			return redirect()->back()->withInput();
		}
		return redirect()
			->to(base_url(current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Password = new Password();

		if ($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent')=="true"){
				$flag=true;
			}
			if ($Password
				->delete($request->getPost('password'),$flag)
			) {
				return $response->setStatusCode(200)->setJSON(
					[
						'message' => lang('DataManipulation.delete.success')
					]
				);
			}
			return $response->setStatusCode(500)->setJSON(
				[
					'message' => lang('DataManipulation.delete.failed')
				]
			);
		}
		return $response->setStatusCode(403);
	}
}