<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\InternetSubscription;
use App\Models\Customer;
use App\Models\Province;
use App\Models\Password;
use App\Libraries\Paginator;
use App\Models\BaseTransceiverStation;
use App\Models\Configuration;
use App\Models\Vendor;
use App\Models\Location;
use App\Models\Device;
use App\Models\InternetPlan;

class InternetSubscriptionController extends DashboardController
{
    public function index()
    {
		$request = service('request');

		$InternetSubscription = new InternetSubscription();
		$Paginator = new Paginator(10, base_url(current_url(true)->getPath()), 'internet_subscription');

		if($request->getGet('q')) {
			$recordData = $InternetSubscription->get_search_data($Paginator,$request);
			$Paginator->set_record_count($InternetSubscription->builder()->like('name',$request->getGet('q'),'both')->countAllResults());
			$Paginator->set_query_string('q',$request->getGet('q'));
			$Paginator->set_page_number($request->getGet('page_internet_subscription'));
		} else {
			$Paginator->set_record_count($InternetSubscription->builder()->countAll());
			$recordData = $InternetSubscription->get_index_data($Paginator,$request);
			$Paginator->set_page_number($request->getGet('page_internet_subscription'));
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'recordData' => $recordData,
			'Paginator' => $Paginator,
			'recordIndex' => $Paginator->get_first_index(),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath())
		];
        return $this->view->setData($data)->render('Customers/InternetSubscription/index');
    }

	public function create()
	{
		$request = service('request');
		$session = session();

		$BaseTransceiverStation = new BaseTransceiverStation();
		$InternetSubscription = new InternetSubscription();
		$Customer = new Customer();
		$Device = new Device();
		$Location = new Location();

		$running = 0;
		$active = 0;
		$locationID = null;
		$customer = $Customer->find($request->getPost('customerID'));

		if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
			exec("ping -n 3 " . $request->getPost('ip_address'), $output, $status);
			if($status == 0) {
				$running = 1;
			}
		} else {
			exec(
				"ping -c 2 " . $request->getPost('ip_address'),
				$output,
				$status
			);
			if($status == 0) {
				$running = 1;
			}
		}

		$data = [
			'ip_address' => $request->getPost('ip_address'),
			'password' => $request->getPost('password'),
			'item' => $request->getPost('item'),
			'active' => $running,
		];

		if($request->getPost('is_addr_eq_bill_addr') === "on") {
			$locationID = $customer->address;
			$data['location'] = $customer->address;
		} else {
			$dataLocation = [
				'subdistrict' => $request->getPost('subdistrict'),
				'hamlet' => $request->getPost('hamlet'),
				'neighborhood' => $request->getPost('neighborhood'),
				'street' => $request->getPost('street'),
				'latitude' => $request->getPost('latitude'),
				'longitude' => $request->getPost('longitude'),
				'name' => $request->getPost('location_name'),
				'location_type' => 0
			];
			// dd($dataLocation);
			$locationID = $Location->insert($dataLocation,true);
			$data['location'] = $locationID;
		}

		$deviceID = $Device->insert($data,true);

		if($deviceID == false) {
			$session->setFlashdata('errors', $Device->errors());
			return redirect()->back()->withInput();
		}

		if($request->getPost('active') === "on") {
			$active = 1;
		}

		$btsName = $customer->id . " " . $customer->first_name . " " . $locationID;
		$rootBts = $BaseTransceiverStation->find($request->getPost('root'));
		$data = [
			'name' => $btsName,
			'root' => $request->getPost('root'),
			'mode' => $request->getPost('mode'),
			'band' => $rootBts->band,
			'channel_width' => $rootBts->channel_width,
			'frequency' => $rootBts->frequency,
			'radio_name' => $request->getPost('radio_name'),
			'ssid' => $rootBts->ssid,
			'wireless_protocol' => $rootBts->wireless_protocol,
			'device' => $deviceID,
			'active' => $active
		];

		$btsID = $BaseTransceiverStation->insert($data,true);

		if($btsID == false) {
			$session
				->setFlashdata('errors', $BaseTransceiverStation->errors());
			return redirect()->back()->withInput();
		}
		$data = [
			'customer' => $customer->id,
			'internet_plan' => $request->getPost('internet_plan'),
			'cpe' => $btsID,
			'active' => $active
		];

		if($InternetSubscription->insert($data) == false) {
			$session->setFlashdata('errors', $InternetSubscription->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(
			current_url(true)
			->setSegment(3,'customer')
			->setSegment(4,'customers')
			->setSegment(5,'subscription')
			->setSegment(6,$customer->id)
		);
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$InternetSubscription = new InternetSubscription();
		$BaseTransceiverStation = new BaseTransceiverStation();
		$InternetPlan = new InternetPlan();
		$Device = new Device();
		$Location = new Location();

		$subscription = $InternetSubscription
			->find(current_url(true)->getSegment(6));
		$plan = $InternetPlan->find($subscription->internet_plan);
		$bts = $BaseTransceiverStation->find($subscription->cpe);
		$device = $Device->find($bts->device);
		$location = $Location->find($device->location);

		$rootsBts = $BaseTransceiverStation->where('root',null)->findAll();
		$internet_plans = $InternetPlan->findAll();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'internet_plan' => $plan,
			'internet_plans' => $internet_plans,
			'bts' => $bts,
			'device' => $device,
			'rootsBts' => $rootsBts,
			'location' => $location,
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5,'update')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(4,'customers')
				->setSegment(5,'subscription')
				->setSegment(6,$subscription->customer)
				->getPath())
		];

		return $view->setData($data)->render('Customers/InternetSubscription/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$Device = new Device();
		$InternetSubscription = new InternetSubscription();
		$BaseTransceiverStation = new BaseTransceiverStation();

		$internet_subscription = $InternetSubscription->find(current_url(true)->getSegment(6));
		
		$data = [
			'internet_plan' => $request->getPost('internet_plan'),
		];

		if($InternetSubscription->update(current_url(true)->getSegment(6),$data) == false) {
			$session->setFlashdata('errors',$InternetSubscription->errors());
			return redirect()->back()->withInput();
		}

		$bts = $BaseTransceiverStation->find($internet_subscription->cpe);

		$data = [
			'root' => $request->getPost('root_bts')
		];

		if($BaseTransceiverStation->update($bts->id,$data) == false) {
			$session->setFlashdata('errors', $BaseTransceiverStation->errors());
			return redirect()->back()->withInput();
		}

		$data = [
			'ip_address' => $request->getPost('ip_address')
		];

		if($Device->update($bts->device,$data) == false) {
			$session->setFlashdata('errors',$Device->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(
			current_url(true)
			->setSegment(4, 'customers')
			->setSegment(5, 'subscription')
			->setSegment(6, $internet_subscription->customer)
		);
	}

	public function subscribe()
	{
		$view = \Config\Services::renderer();

		$Vendor = new Vendor();
		$Customer = new Customer();
		$Province = new Province();
		$Password = new Password();
		$InternetPlan = new InternetPlan();
		$Configuration = new Configuration();
		$BaseTransceiverStation = new BaseTransceiverStation();

		$mikrotik_id = $Configuration->where('key', 'MIKROTIK_VENDOR_ID')->first();
		$customer = $Customer->find(current_url(true)->getSegment(6));
		$provinces = $Province->findAll();
		$passwords = $Password->findAll();
		$vendors = $Vendor->findAll();
		$internet_plans = $InternetPlan->findAll();

		$roots = $BaseTransceiverStation->where('root', null)->findAll();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'customer' => $customer,
			'provinces' => $provinces,
			'passwords' => $passwords,
			'vendors' => $vendors,
			'internet_plans' => $internet_plans,
			'vendor_mikrotik_id' => $mikrotik_id->value,
			'baseTransceiverStations' => $roots,
			'ajax_city' => base_url(
				'api/get/administrative-division/cities-by-province-id'),
			'ajax_district' => base_url(
				'api/get/administrative-division/districts-by-city-id'),
            'ajax_subdistrict' => base_url(
				'api/get/administrative-division/subdistricts-by-district-id'),
			'ajax_get_origin_data' => base_url(
				'api/get/mikrotik/get-origin-data'
			),
			'ajax_nearest_BTS' => base_url(
				'api/get/nearest-base-transceiver-stations-by-city-id'
			),
			'ajax_item' => base_url('api/get/item/by-vendor-and-type-id'),
			'ajax_wireless_mode' => base_url(
				'api/get/mode-configuration-by-vendor'
			),
			'ajax_wireless_band' => base_url('api/get/all-band-configuration'),
			'ajax_wireless_channel' => base_url(
				'api/get/wireless-channel-width-configuration'
			),
			'ajax_wireless_frequency' => base_url(
				'api/get/wireless-frequency-configuration'
			),
			'ajax_wireless_protocol' => base_url(
				'api/get/all-wireless-protocol'
			),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->setSegment(6,'')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(3, 'customer')
				->setSegment(4, 'customers')
				->setSegment(5, 'subscription')
				->getPath())
		];

		return $view->setData($data)->render('Customers/InternetSubscription/subscribe');
	}
}
