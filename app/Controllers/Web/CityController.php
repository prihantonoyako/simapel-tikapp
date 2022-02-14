<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Libraries\Paginator;
use App\Models\Province;
use App\Models\City;

class CityController extends DashboardController
{
    public function index()
    {
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();

		$provinces = array();
		$cities = $City->paginate(10,'city');
		
		foreach($cities as $city) {
			if(array_key_exists($city->province,$provinces)) {
				$city->province = $provinces[$city->province];
			} else {
				$province = $Province->find($city->province);
				$provinces[$province->id] = $province->name;
				$city->province = $province->name;
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
			'cities'=>$cities,
			'pager' => $City->pager,
			'recordNumber'=>pagination_record_number(
				$request->getGet('page_city'), 10),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5,'new')->getPath()),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(
				current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(
				current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/City/index');
    }
	
	public function new()
	{
		$view = \Config\Services::renderer();

		$Province = new Province();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'provinces' => $Province->findAll(),
			'rendering_time' => $rendering_time,
			'url_province' => base_url(
				'api/get/administrative-division/provinces-by-name'
			),
			'url_action' => base_url(
				current_url(true)->setSegment(5,'create')->getPath()
			),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->getPath()
			)
		];
		
		return $view->setData($data)
			->render('Administrative-Division/City/new');
	}
	
	public function create()
	{
		$request = service('request');
		$session = session();

		$City = new City();

		$data = [
			'name' => $request->getPost('name'),
			'province' => $request->getPost('province')
		];

		if($City->insert($data)==false) {
			$session->setFlashdata('errors',$City->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()->to(current_url(true)->setSegment(5,''));
	}
	
	public function edit()
	{
		$view = \Config\Services::renderer();

		$Province = new Province;
		$City  = new City;
		
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'city' => $City->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'province' => $Province->findAll(),
			'url_action'=>base_url(
				  current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(
				current_url(true)
					->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/City/edit');
	}
	
	public function update()
	{
		$request = service('request');
		$session = session();

		$City = new City;
		
		$data = [
			'name'=>$request->getPost('name'),
			'province'=>$request->getPost('province')
		];
		
		if($City->update(current_url(true)->getSegment(6),$data) == false) {
			$session->setFlashdata('errors',$City->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()->to(
			current_url(true)->setSegment(5,'')->setSegment(5,''));
	}

	public function recycle()
	{		
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();

		$provinces = array();
		$cities = $City->onlyDeleted()->paginate(10,'city');
		
		foreach($cities as $city) {
			if(array_key_exists($city->province,$provinces)) {
				$city->province = $provinces[$city->province];
			} else {
				$province = $Province->find($city->province);
				$provinces[$province->id] = $province->name;
				$city->province = $province->name;
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
			'recycleRecord' => $cities,
			'pager' => $City->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_city'), 10
			),
			'rendering_time' => $rendering_time,
			'listRecord' => base_url(
				current_url(true)->setSegment(5,'')->getPath()
			),
			'restoreRecord' => base_url(
				current_url(true)->setSegment(5,'restore')->getPath()
			),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()
			),
			'purgeRecycle' => base_url(
				current_url(true)->setSegment(5,'purge')->getPath()
			)
		];
		
		return $view->setData($data)->render('Administrative-Division/City/recycle');
	}
	
	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$City = new City();
		if($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent')=='true') {
				$flag = true;
			}
			if($City->delete($request->getPost('id'),$flag)) {
				return $response->setStatusCode(200)->setJSON(['message'=>'CITY DATA IS DELETED']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
	
	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$City = new City();
		
		if($request->isAJAX()) {
			$data = ['deleted_at'=>null];
			if($City->update($request->getPost('cityRestore'),$data)) {
				return $response->setStatusCode(200)->setJSON(['message'=>'CITY DATA IS RESTORED']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
}
