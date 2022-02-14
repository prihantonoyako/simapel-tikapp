<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\City;
use App\Models\District;
use App\Models\Location;
use App\Models\Province;
use App\Models\Subdistrict;

class ProvinceController extends DashboardController
{
    public function index()
    {
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province();
		
		$provinces = $Province->paginate(10,'province');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
			'provinces' => $provinces,
			'pager' => $Province->pager,
			'rendering_time' => $rendering_time,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_province'),10),
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
		
		return $view
			->setData($data)
			->render('Administrative-Division/Province/index');
    }
	
	public function new()
	{
		$view = \Config\Services::renderer();

		timer('app benchmark');

		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'create')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->getPath())
		];
		return $view
			->setData($data)
			->render('Administrative-Division/Province/new');
	}
	
	public function create()
	{
		$request = service('request');
		$session = session();

		$Province = new Province();
		
		$data = [
			'name'=>$request->getPost('name')
		];
		if($Province->insert($data) == false) {
			$session->setFlashdata('errors',$Province->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(current_url(true)->setSegment(5,''));
	}
	
	public function edit()
	{
		$view = \Config\Services::renderer();

		$Province = new Province();

		timer('app benchmark');

		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'province' => $Province->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(
				current_url(true)
					->setSegment(5,'')
					->setSegment(5,'')
					->getPath())
		];
		return $view->setData($data)
			->render('Administrative-Division/Province/edit');
	}
	
	public function update()
	{
		$request = service('request');
		$session = session();

		$Province = new Province();

		$data = [
			'name'=>$request->getPost('name')
		];

		if($Province->update(current_url(true)->getSegment(6),$data) == false) {
			$session->setFlashdata('errors',$Province->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()
			->to(current_url(true)->setSegment(5,'')->setSegment(5,''));
	}

	public function recycle()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Province = new Province;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'recycleRecord' => $Province
				->onlyDeleted()
				->paginate(10,'province'),
			'pager' => $Province->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_province'),10),
			'rendering_time' => $rendering_time,
			'listRecord' => base_url(
				current_url(true)->setSegment(5, '')->getPath()),
			'restoreRecord' => base_url(
				current_url(true)->setSegment(5, 'restore')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()),
			'purgeRecycle' => base_url(
				current_url(true)->setSegment(5, 'purge')->getPath())
		];		
		return $view->setdata($data)->render('Administrative-Division/Province/recycle');
	}
	
	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();
		$Location = new Location();

		if($request->isAJAX()){
			$flag = false;
			if($request->getPost('permanent')=='true') {
				$flag = true;				
				foreach ($City->where('province', (int) $request->getPost('id'))->findAll() as $itemCity) {
					foreach ($District->where('city', $itemCity->id)->findAll() as $itemDistrict) {
						foreach($Subdistrict->where('district',$itemDistrict->id)->findAll() as $itemSubdistrict) {
							foreach($Location->where('subdistrict',$itemSubdistrict->id)->findAll() as $itemLocation) {
								$Location->delete($itemLocation->id,$flag);
							}
							$Subdistrict->delete($itemSubdistrict->id,$flag);
						}
						$District->delete($itemDistrict->id, $flag);
					}
					$City->delete($itemCity->id,$flag);
				}
			}
			if($Province->delete((int) $request->getPost('id'),$flag)) {
				return $response->setStatusCode(200)->setJSON(['message'=>lang('DataManipulation.delete.success')]);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}
	
	public function restore()
	{
		$request = service('request');
		$response = service('response');
		
		$Province = new Province();
		if($request->isAJAX()){
			$restore = ['deleted_at'=>null];
			$json = file_get_contents('php://input');
			$data = json_decode($json);
			if($Province->update((int) $data->id,$restore)){
				return $response->setStatusCode(200)->setJSON(['message'=>lang('DataManipulation.restore.success')]);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}

	public function purge()
	{
		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();
		$Location = new Location();
		if(!$Province->onlyDeleted()->findAll()) {
			return redirect()->back();
		}
		foreach($Province->onlyDeleted()->findAll() as $province){
			foreach ($City->where('province', (int) $province->id)->findAll() as $itemCity) {
				foreach ($District->where('city', $itemCity->id)->findAll() as $itemDistrict) {
					foreach($Subdistrict->where('district',$itemDistrict->id)->findAll() as $itemSubdistrict) {
						foreach($Location->where('subdistrict',$itemSubdistrict->id)->findAll() as $itemLocation) {
							$Location->delete($itemLocation->id,true);
						}
						$Subdistrict->delete($itemSubdistrict->id,true);
					}
					$District->delete($itemDistrict->id,true);
				}
				$City->delete($itemCity->id,true);
			}
			$Province->delete($province->id,true);
		}
		return redirect()->back();
	}
}
