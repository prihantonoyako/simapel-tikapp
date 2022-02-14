<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;

class SubDistrictController extends DashboardController
{	
    public function index()
    {
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();

		$provinces = array();
		// {province id => province name}
		$cities = array();
		// {city id => {name => city name,province => province id}}
		$districts = array();
		// {district id => {name => district name,city => city id}}
		$subdistricts = $Subdistrict->paginate(10,'subdistrict');

		foreach($subdistricts as $subdistrict) {
			if(array_key_exists($subdistrict->district,$districts)) {
				$district = $districts[$subdistrict->district];
				$subdistrict->district = $district['name'];
				$city = $cities[$district['city']];
				$subdistrict->city = $city['name'];
				$subdistrict->province = $provinces[$city['province']];
			} else {
				$district = $District->find($subdistrict->district);
				$districts[$district->id] = [
					'name' => $district->name,
					'city' => $district->city
				];
				$subdistrict->district = $district->name;
				if(array_key_exists($district->city,$cities)) {
					$city = $cities[$district->city];
					$subdistrict->city = $city['name'];
					if(array_key_exists($city['province'],$provinces)) {
						$subdistrict->province = $provinces[$city['province']];
					} else {
						$province = $Province->find($city['province']);
						$provinces[$city['province']] = $province->name;
					}
				} else {
					$city = $City->find($district->city);
					$cities[$city->id] = [
						'name' => $city->name,
						'province' => $city->province
					];
					$subdistrict->city = $city->name;
					if(array_key_exists($city->province,$provinces)) {
						$subdistrict->province = $provinces[$city->province];
					} else {
						$province = $Province->find($city->province);
						$provinces[$city->province] = $province->name;
						$subdistrict->province = $province->name;
					}
				}
			}
		}

		// dd($subdistricts);
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
			'subdistricts' => $subdistricts,
			'pager' => $Subdistrict->pager,
			'recordNumber'=>pagination_record_number(
				$request->getGet('page_subdistrict'), 10),
			'rendering_time' => $rendering_time,
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
		
		return $view->setData($data)
			->render('Administrative-Division/Sub-District/index');
    }
	
	public function new()
	{
		$view = \Config\Services::renderer();
		$Province = new Province;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		
		$data = [
			'provinces' => $Province->findAll(),
			'ajax_city' => base_url(
				'api/get/administrative-division/cities-by-province-id'),
			'ajax_district' => base_url(
				'api/get/administrative-division/districts-by-city-id'),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/Sub-District/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Subdistrict = new Subdistrict;
		
		$data = [
			'name' => $request->getPost('name'),
			'district' => $request->getPost('district')
		];
		
		if($Subdistrict->insert($data) == false) {
			$session->setFlashdata('errors', $Subdistrict->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()->to(current_url(true)->setSegment(5,''));
	}
	
	public function edit()
	{
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();

		$subdistrict = $Subdistrict->find(current_url(true)->getSegment(6));
		$district = $District->find($subdistrict->district);
		$city = $City->find($district->city);
		$province = $Province->find($city->province);
		$subdistrict->district = $district->id;
		$subdistrict->city = $city->id;
		$subdistrict->province = $province->id;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		
		$data = [
			'subdistrict' => $subdistrict,
			'provinces' => $Province->findAll(),
			'cities' => $City
				->where('province',$subdistrict->province)->findAll(),
			'districts' => $District
				->where('city',$subdistrict->city)->findAll(),
			'rendering_time' => $rendering_time,
			'ajax_city' => base_url(
				'api/get/administrative-division/cities-by-province-id'),
			'ajax_district' => base_url(
				'api/get/administrative-division/districts-by-city-id'),
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back' => base_url(
				current_url(true)
					->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)
			->render('Administrative-Division/Sub-District/edit');
	}
	
	public function update()
	{
		$request = service('request');
		$session = session();

		$Subdistrict = new Subdistrict;
		
		$data = [
			'name'=>$request->getPost('name'),
			'district'=>$request->getPost('district')
		];

		$newSubdistrict = $Subdistrict
			->update(current_url(true)->getSegment(6),$data);

		if($newSubdistrict == false) {
			$session->setFlashdata('errors',$Subdistrict->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()
			->to(current_url(true)->setSegment(5,'')->setSegment(5,''));
	}
	
	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Subdistrict = new Subdistrict;
		
		if($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent') == 'true') {
				$flag = true;
			}
			if($Subdistrict->delete($request->getPost('subdistrict'), $flag)) {
				return $response->setStatusCode(200)
					->setJSON(['message'=>'SUBDISTRICT DATA IS DELETED']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
	
	// public function restore()
	// {
	//	$request = service('request');
	//	$response = service('response');
	// 	$Subdistrict = new Subdistrict;
		
	// 	if($request->isAJAX()) {
	// 		$data = ['deleted_at'=>null];
	// 		if($Subdistrict->update($request->getPost('subdistrictRestore'),$data) {
	// 			return $response->setStatusCode(200)->setJSON(['message'=>'SUBDISTRICT DATA IS RESTORED']);
	// 		}
	// 		return $response->setStatusCode(500);
	// 	}
	// 	return $response->setStatusCode(403);
	// }
}
