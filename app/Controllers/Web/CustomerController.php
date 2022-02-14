<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Bill;
use App\Models\Customer;
use App\Models\InternetSubscription;
use App\Models\InternetPlan;
use App\Models\Province;
use App\Models\Location;

class CustomerController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$view = \Config\Services::renderer();
		$request = service('request');

		$Customer = new Customer;

		$customers = $Customer->paginate(10,'customer');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

        $data = [
			'customers' => $customers,
			'pager' => $Customer->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_customer'),10),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(
				current_url(true)->setSegment(5, 'show')->getPath()),
			'subscriptionRecord' => base_url(
				current_url(true)->setSegment(5, 'subscription')->getPath()),
			'recycleRecord' => base_url(
				current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath())
		];

		return $view->setData($data)->render('Customers/customer/index');
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
            'ajax_subdistrict' => base_url(
				'api/get/administrative-division/subdistricts-by-district-id'),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];

		return $view->setData($data)->render('Customers/customer/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Customer = new Customer();
		$Location = new Location();
		$active = 0;

		if($request->getPost('active') === 'on') {
			$active = 1;
		}

		$data = [
			'subdistrict' => $request->getPost('subdistrict'),
			'name' => $request->getPost('location_name'),
			'street' => $request->getPost('street'),
			'neighborhood' => $request->getPost('neighborhood'),
			'hamlet' => $request->getPost('hamlet'),
			'latitude' => $request->getPost('latitude'),
			'longitude' => $request->getPost('longitude'),
			'location_type' => 0
		];

		$locationID = $Location->insert($data,true);
		if($locationID == false) {
			$session->setFlashdata('errors',$Location->errors());
			return redirect()->back()->withInput();
		}

		$data = [
			'first_name' => $request->getPost('first_name'),
			'last_name' => $request->getPost('last_name'),
			'email' => $request->getPost('email'),
			'address' => $locationID,
			'active' => $active
		];

		if ($Customer->insert($data) == false) {
			$session->setFlashdata('errors',$Customer->errors());
			return redirect()->back()->withInput();
		}

		$session->setFlashdata(
			'success_messages','BERHASIL MENAMBAHKAN DATA PELANGGAN');
		return redirect()->to(current_url(true)->setSegment(5,''));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Customer = new Customer();
		$Location = new Location();
		$Bill = new Bill();

		$customer = $Customer->find(current_url(true)->getSegment(6));
		$address = $Location->find($customer->address);

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'customer' => $customer,
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5,'')
				->setSegment(5,'')
				->getPath())
		];
		
		return $view->setData($data)->render('Customers/customer/edit');
	}

	public function show()
	{
		$view = \Config\Services::renderer();

		$Customer = new Customer();

		$customer = $Customer->find(current_url(true)->getSegment(6));

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'customer' => $customer,
			'rendering_time' => $rendering_time,
			'url_edit' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];

		return $view->setData($data)->render('Customers/customer/show');
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Customer = new Customer;
		$InternetSubscription = new InternetSubscription();
		$Bill = new Bill();
		$Location = new Location();

		if ($request->isAJAX()) {
			$customer = $Customer->find($request->getPost('id'));
			$id_pelanggan = $request->getPost('id');
			$flag = true;
			if($request->getPost('permanent') === "true") {
				$flag=true;
			}
			// $internetSubscription = $InternetSubscription->where('customer',$customer->id)->where('active','1')->first();
			// $bill = $Bill->where('internet_subscription',$internetSubscription->id)->where('active','1')->first();
			
			// if($bill){
			// 	return $this->response->setStatusCode(403)->setJSON(['messages'=>'TERDAPAT TAGIHAN AKTIF']);
			// }else{
			// 	$allSubscription = $InternetSubscription->where('customer',$customer->id)->findAll();
			// 	foreach($allSubscription as $subscription){
			// 		foreach($Bill->where('internet_subscription',$subscription->id)->findAll() as $bill){
			// 			$Bill->delete($bill->id,$flag);
			// 		}
			// 		// $Bill->where('internet_subscription',$subscription->id)->delete();
			// 	}
			// 	// $InternetSubscription->delete($subscription->id);
			// }
			foreach($InternetSubscription->where('customer',$customer->id)->findAll() as $subscription){
				$billAktif = $Bill->where('internet_subscription',$subscription->id)->where('active','1')->first();
				if($billAktif){
					return $response->setStatusCode(500)->setJSON(['message'=>'TERDAPAT TAGIHAN AKTIF']);
				}
			}
			$allSubscription = $InternetSubscription->where('customer',$customer->id)->findAll();
				foreach($allSubscription as $subscription){
					foreach($Bill->where('internet_subscription',$subscription->id)->findAll() as $bill) {
						$Bill->delete($bill->id,$flag);
					}
					$InternetSubscription->delete($subscription->id,$flag);
					// $Location->delete()
				}
				// $InternetSubscription->delete($subscription->id);
			if(!$Location->delete($customer->address,$flag)) {
				return $response->setStatusCode(500)
					->setJSON(['message'=>'TERDAPAT KESALAHAN PADA SISTEM']);
			}
			if ($Customer->delete($id_pelanggan,$flag)) {
				return $response->setStatusCode(200)
					->setJSON([
						'message' => 'DATA PELANGGAN BERHASIL DIHAPUS']
					);
			}
			return $response->setStatusCode(500)
				->setJSON(['message' => 'DATA PELANGGAN TIDAK DITEMUKAN']);
		}
		return $response->setStatusCode(403);
	}

	public function recycle()
	{
		$view = \Config\Services::renderer();

		$Customer = new Customer();

		$trash = $Customer->onlyDeleted()->paginate(10, 'customer');
		$data = [
			'trash' => $trash,
			'pager' => $Customer->pager,
			'listRecord' => base_url(
				current_url(true)->setSegment(5, '')->getPath()),
			'restoreRecord' => base_url(
				current_url(true)->setSegment(5, 'restore')->getPath()),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()),
			'purgeRecycle' => base_url(
				current_url(true)->setSegment(5, 'purge')->getPath())
		];
		return $view->setData($data)
			->render('Customers/customer/recycle');
	}

	public function list_subscription()
	{
		$view = \Config\Services::renderer();

		$Customer = new Customer();
		$InternetSubscription = new InternetSubscription();
		$InternetPlan = new InternetPlan();

		$i_plans = array();
		$customer = $Customer->find(current_url(true)->getSegment(6));
		$subscriptions = $InternetSubscription
			->where('customer',$customer->id)
			->findAll();
		foreach($subscriptions as $subscription) {
			if(array_key_exists($subscription->internet_plan,$i_plans)) {
				$subscription->internet_plan = $i_plans[
					$subscription->internet_plan
				];
			} else {
				$i_plan = $InternetPlan->find($subscription->internet_plan);
				$i_plans[$subscription->internet_plan] = $i_plan;
				$subscription->internet_plan = $i_plan;
			}
			
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'subscriptions' => $subscriptions,
			'rendering_time' => $rendering_time,
			'listCustomer' => base_url(
				current_url(true)
				->setSegment(5,'')
				->setSegment(5,'')
				->getPath()),
			'addSubscription' => base_url(
				current_url(true)
				->setSegment(4,'internet-subscription')
				->setSegment(5,'subscribe')
				->getPath()),
			'url_edit' => base_url(
				current_url(true)
				->setSegment(4,'internet-subscription')
				->setSegment(5,'edit')
				->setSegment(6,'')
				->getPath()
			)
		];

		return $view->setData($data)
			->render('Customers/customer/subscription');
	}
}
