<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Vendor;

class VendorController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');

		$request = service('request');
		$view = \Config\Services::renderer();

		$Vendor = new Vendor;

		$vendors = $Vendor->paginate(10, 'vendor');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'vendors' => $vendors,
			'pager' => $Vendor->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_vendor'),
				10
			),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5, 'new')->getPath()
			),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()
			),
			'showRecord' => base_url(
				current_url(true)->setSegment(5, 'show')->getPath()
			),
			'recycleRecord' => base_url(
				current_url(true)->setSegment(5, 'recycle')->getPath()
			),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()
			)
		];

		return $view->setData($data)->render('Item/Vendor/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()
			),
			'url_back' => base_url(
				current_url(true)->setSegment(5, '')->getPath()
			)
		];

		return $view->setData($data)->render('Item/Vendor/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Vendor = new Vendor;
		if ($Vendor->where('name', $request->getPost('name'))->first()) {
			$session->setFlashdata('conflict', 'Name exists!');
			return redirect()->back()->withInput();
		}
		$data = [
			'name' => $request->getPost('name')
		];
		if ($Vendor->insert($data) == false) {
			$session->setFlashdata('errors', $Vendor->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(
			current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
		);
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Vendor = new Vendor;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'vendor' => $Vendor->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'update')->getPath()
			),
			'url_back' => base_url(
				current_url(true)
					->setSegment(5, '')
					->setSegment(5, '')
					->getPath()
			)
		];
		return $view->setData($data)->render('Item/Vendor/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$Vendor = new Vendor;
		if ($Vendor
			->where('id !=', current_url(true)->getSegment(6))
			->where('name', $request->getPost('name'))
			->first()
		) {
			$session->setFlashdata('conflict', 'Name exists!');
			return redirect()->back()->withInput();
		}
		$data = [
			'name' => $request->getPost('name')
		];
		if ($Vendor->update(
			current_url(true)->getSegment(6),
			$data
		) == false) {
			$session->setFlashdata('errors', $Vendor->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(
			current_url(true)->setSegment(5, '')->setSegment(5, '')
		);
	}

	// public function recycle()
	// {
	// 	helper('pagination_record_number');

	// 	$request = service('request');

	// 	$Vendor = new Vendor;

	// 	if ($request->getGet('q')) {
	// 		$vendors = $Vendor->onlyDeleted()->like('name', '%' . $request->getGet('q') . '%')->paginate(10, 'vendor');
	// 	} else {
	// 		$vendors = $Vendor->onlyDeleted()->paginate(10, 'vendor');
	// 	}
	// 	$data = [
	// 		'recycleRecord' => $vendors,
	// 		'pager' => $Vendor->pager,
	// 		'recordNumber' => pagination_record_number($request->getGet('page_province'), 10),
	// 		'listRecord' => base_url(current_url(true)->setSegment(5, '')->getPath()),
	// 		'restoreRecord' => base_url(current_url(true)->setSegment(5, 'restore')->getPath()),
	// 		'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath()),
	// 		'purgeRecycle' => base_url(current_url(true)->setSegment(5, 'purge')->getPath())
	// 	];
	// 	return $view->setData($data)->render($this->rootViewPath . 'recycle');
	// }

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Vendor = new Vendor;

		if ($request->isAJAX()) {
			$flag = false;
			if ($request->getPost('permanent') == "true") {
				$flag = true;
			}
			if ($Vendor->delete($request->getPost('id'), $flag)) {
				return $response->setStatusCode(200)->setJSON([
					'message' => 'VENDOR RECORD IS DELETED'
				]);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$Vendor = new Vendor;

		if ($request->isAJAX()) {
			$data = ['deleted_at' => null];
			if ($Vendor->update($request->getPost('vendorRestore'), $data)) {
				return $response->setStatusCode(200)->setJSON([
					'message' => 'VENDOR RECORD IS RESTORED'
				]);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
}
