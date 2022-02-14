<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Province;
use App\Models\City;
use App\Models\District;
use App\Models\Subdistrict;
use App\Models\Location;
use App\Models\BaseTransceiverStation;
use App\Models\Password;
use App\Models\Vendor;
use App\Models\Device;
use App\Models\Configuration;
use App\Models\Customer;
use App\Models\InternetSubscription;
use PEAR2\Net\RouterOS;
use App\Models\Item;

class BTSController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$BaseTransceiverStation = new BaseTransceiverStation();
		$Device = new Device();
		$Location = new Location();
		$InternetSubscription = new InternetSubscription();

		$locations = array();
		$customerBts = array();
		$subscriptions = $InternetSubscription->findAll();
		foreach($subscriptions as $subscription) {
			array_push($customerBts,$subscription->cpe);
		}
		if(empty($subscriptions)) {
			$baseTransceiverStations = $BaseTransceiverStation->paginate(10,'bts');
		} else {
		$baseTransceiverStations = $BaseTransceiverStation
			->whereNotIn('id',$customerBts)
			->paginate(10, 'bts');
		}
		foreach ($baseTransceiverStations as $bts) {
			$device = $Device->find($bts->device);
			$bts->ip_address = $device->ip_address;
			if (
				(intval($device->active) === 1) && (intval($bts->active) === 1)
			) {
				$bts->active = 1;
			} else {
				$bts->active = 0;
			}
			if (array_key_exists($device->location, $locations)) {
				$bts->location = $locations[$device->location];
			} else {
				$location = $Location->find($device->location);
				$locations[$device->location] = $location->name;
				$bts->location = $location->name;
			}
			$location = $Location->find($device->location);
			$bts->location = $location->name;
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'baseTransceiverStations' => $baseTransceiverStations,
			'pager' => $BaseTransceiverStation->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_location'),
				10
			),
			'synchronizeBts' => base_url('cron/synchronize-bts'),
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
		return $view->setData($data)->render('BTS/Devices/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$Province = new Province();
		$Vendor = new Vendor();
		$Password = new Password();
		$BaseTransceiverStation = new BaseTransceiverStation();
		$Configuration = new Configuration();

		$mikrotik_id = $Configuration->where('key', 'MIKROTIK_VENDOR_ID')->first();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'baseTransceiverStations' => $BaseTransceiverStation->findAll(),
			'provinces' => $Province->findAll(),
			'vendors' => $Vendor->findAll(),
			'vendor_mikrotik_id' => $mikrotik_id->value,
			'passwords' => $Password->findAll(),
			'ajax_get_origin_data' => base_url(
				'api/get/mikrotik/get-origin-data'
			),
			'ajax_city' => base_url(
				'api/get/administrative-division/cities-by-province-id'
			),
			'ajax_district' => base_url(
				'api/get/administrative-division/districts-by-city-id'
			),
			'ajax_subdistrict' => base_url(
				'api/get/administrative-division/subdistricts-by-district-id'
			),
			'ajax_location' => base_url(
				'api/get/locations-by-subdistrict-id-type'
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
				current_url(true)->setSegment(5, 'create')->getPath()
			),
			'url_back' => base_url(
				current_url(true)
					->setSegment(5, '')
					->setSegment(5, '')
					->getPath()
			)
		];
		return $view->setData($data)->render('BTS/Devices/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$Device = new Device();
		$BaseTransceiverStation = new BaseTransceiverStation();
		$Password = new Password();
		$Configuration = new Configuration();
		$Item = new Item();

		$active = 0;
		$root = null;
		$frequency = null;
		$insertedBTS = null;
		$insertedDevice = null;

		$password = $Password->find($request->getPost('password'));
		$mikrotik_id = $Configuration
			->where('key', 'MIKROTIK_VENDOR_ID')
			->first();

		if (
			$Device
			->where('ip_address', $request->getPost('ip_address'))
			->where('active', 1)->first()
		) {
			$session->setFlashdata('conflict', 'IP Conflict');
			return redirect()->back()->withInput();
		}

		if ($request->getPost('active')) {
			$active = 1;
		}

		if (
			intval($mikrotik_id->value) ===
			intval($request->getPost('vendor'))
		) {
			try {
				$client = new RouterOS\Client(
					$request->getPost('ip_address'),
					$password->username,
					$password->password
				);
			} catch (\Exception $e) {
				$session
					->setFlashdata('conflict', 'Device not responded properly');
				return redirect()->back();
			}
		}

		$data = [
			'ip_address' => $request->getPost('ip_address'),
			'password' => $request->getPost('password'),
			'active' => $active,
			'item' => $request->getPost('item'),
			'location' => $request->getPost('location')
		];

		$insertedDevice = $Device->insert($data);

		if ($insertedDevice == false) {
			$session->setFlashdata('errors', $Device->errors());
			return redirect()->back()->withInput();
		}

		if (!empty($request->getPost('root'))) {
			$root = $request->getPost('root');
			$frequency = $BaseTransceiverStation->find($root)->frequency;
		} else {
			$frequency = $request->getPost('frequency');
		}

		$data = [
			'device' => $insertedDevice,
			'name' => $request->getPost('name'),
			'root' => $root,
			'mode' => $request->getPost('mode'),
			'band' => $request->getPost('band'),
			'frequency' => $frequency,
			'channel_width' => $request->getPost('channel_width'),
			'radio_name' => $request->getPost('radio_name'),
			'ssid' => $request->getPost('ssid'),
			'wireless_protocol' => $request
				->getPost('wireless_protocol'),
			'active' => $active
		];

		$insertedBTS = $BaseTransceiverStation->insert($data);

		if ($insertedBTS == false) {
			$Device->delete($insertedDevice, true);
			$session->setFlashdata(
				'errors',
				$BaseTransceiverStation->errors()
			);
			return redirect()->back()->withInput();
		}

		$item = $Item->find($request->getPost('item'));

		$used = intval($item->used);

		$data = [
			'used' => $used++
		];

		if ($Item->update($request->getPost('item'), $data) == false) {
			$BaseTransceiverStation->delete($insertedBTS, true);
			$Device->delete($insertedDevice, true);
			$session->setFlashdata('errors', $Item->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(current_url(true)->setSegment(5, ''));
	}

	public function show()
	{
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Province = new Province();
		$City = new City();
		$District = new District();
		$Subdistrict = new Subdistrict();
		$Location = new Location();
		$BaseTransceiverStation = new BaseTransceiverStation();
		$Vendor = new Vendor();
		$Device = new Device();
		$Item = new Item();
		$Password = new Password();

		$bts = $BaseTransceiverStation->find(current_url(true)->getSegment(6));
		$device = $Device->find($bts->device);
		$location = $Location->find($device->location);
		$bts->ip_address = $device->ip_address;
		$bts->password = $device->password;
		$bts->location = $location->id;
		$item = $Item->find($device->item);
		$bts->item = $item->id;
		$bts->vendor = $item->vendor;

		$vendors = $Vendor->findAll();
		$passwords = $Password->findAll();
		$provinces = $Province->findAll();
		$cities = $City->findAll();
		$districts = $District->findAll();
		$subdistricts = $Subdistrict->findAll();
		$items = $Item->where('vendor', $bts->vendor)->findAll();

		$baseTransceiverStations = $BaseTransceiverStation
			->where('id !=', $bts->id)
			->findAll();

		$locations = $Location
			->where('subdistrict', $location->subdistrict)
			->where('location_type', 1)
			->findAll();

		$band = array();

		$wirelessBand = fopen(
			base_url('configurations/wireless-band.csv'),
			'r'
		);

		while (($row = fgetcsv($wirelessBand)) !== false) {
			foreach ($row as $item) {
				array_push($band, $item);
			}
		}
		fclose($wirelessBand);

		$wirelessProtocol = fopen(
			base_url('configurations/wireless-protocol.csv'),
			'r'
		);

		while (($row = fgetcsv($wirelessProtocol)) !== false) {
			$protocol = $row;
		}
		fclose($wirelessProtocol);

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		// dd($bts);
		$data = [
			'bts' => $bts,
			'device' => $device,
			'band' => $band,
			'protocol' => $protocol,
			'vendors' => $vendors,
			'items' => $items,
			'baseTransceiverStations' => $baseTransceiverStations,
			'passwords' => $passwords,
			'provinces' => $provinces,
			'cities' => $cities,
			'districts' => $districts,
			'subdistricts' => $subdistricts,
			'locations' => $locations,
			'ajax_wireless_channel' => base_url(
				'api/get/wireless-channel-width-configuration'
			),
			'ajax_wireless_frequency' => base_url(
				'api/get/wireless-frequency-configuration'
			),
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

		return $view->setData($data)->render('BTS/Devices/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$BaseTransceiverStation = new BaseTransceiverStation();
		$Device = new Device();
		$Password = new Password();

		$bts = $BaseTransceiverStation->find(current_url(true)->getSegment(6));
		$device = $Device->find($bts->device);
		$password = $Password->find($device->password);
		$active = 0;

		if ($request->getPost('active') === 'on') {
			$active = 1;
		}

		$data = [
			'name' => $request->getPost('name'),
			'frequency' => $request->getPost('frequency'),
			'channel_width' => $request->getPost('channel_width'),
			'band' => $request->getPost('band'),
			'active' => $active
		];
		
		if (!empty($request->getPost('root'))) {
			$util = new RouterOS\Util(
				$client = new RouterOS\Client(
					$device->ip_address,
					$password->username,
					$password->password
				)
			);
			$util->setMenu('/interface wireless');
			if ($data['band'] != $bts->band) {
				$util->exec(
					'set band=' . $data['band'] . ' [ find disabled=no ] '
				);
			}
			if ($data['channel_width'] != $bts->channel_width) {
				$util->exec(
					'set channel-width=' . $data['channel_width'] . ' [ find disabled=no ] '
				);
			}
			if ($data['frequency'] != $bts->frequency) {
				$util->exec(
					'set frequency=' . $data['frequency'] . ' [ find disabled=no ] '
				);
			}
		}
		if ($BaseTransceiverStation->update(current_url(true)->getSegment(6), $data) == false
		) {
			$session->setFlashdata('errors', $BaseTransceiverStation->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(current_url(true)->setSegment(5, 'edit'));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$BaseTransceiverStation = new BaseTransceiverStation;

		if ($request->isAJAX()) {
			$flag = false;
			if ($request->getPost('permanent') == 'true') {
				$flag = true;
			}
			if ($BaseTransceiverStation->delete($request->getPost('id'), $flag)) {
				return $response->setStatusCode(200)->setJSON(['status' => 'DATA BTS BERHASIL DIHAPUS']);
			}
			return $response->setStatusCode(500)->setJSON(['status' => 'DATA BTS GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}

	public function purge()
	{
		$BaseTransceiverStation = new BaseTransceiverStation();

		$items = $BaseTransceiverStation->purgeDeleted();

		return redirect()->back();
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$BaseTransceiverStation = new BaseTransceiverStation();

		if ($request->isAJAX()) {
			$data = ['deleted_at' => null];
			if ($BaseTransceiverStation->update($request->getPost('btsRestore'), $data)) {
				return $response->setStatusCode(200)->setJSON(['message' => 'DATA IS RESTORED']);
			}
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}

	public function recycle()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$BaseTransceiverStation = new BaseTransceiverStation();
		$Device = new Device();
		$Location = new Location();

		$locations = array();
		$baseTransceiverStations = $BaseTransceiverStation->onlyDeleted()->paginate(10, 'bts');

		foreach ($baseTransceiverStations as $bts) {
			$device = $Device->find($bts->device);
			$bts->ip_address = $device->ip_address;
			if (
				(intval($device->active) === 1) && (intval($bts->active) === 1)
			) {
				$bts->active = 1;
			} else {
				$bts->active = 0;
			}
			if (array_key_exists($device->location, $locations)) {
				$bts->location = $locations[$device->location];
			} else {
				$location = $Location->find($device->location);
				$locations[$device->location] = $location->name;
				$bts->location = $location->name;
			}
			$location = $Location->find($device->location);
			$bts->location = $location->name;
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'recycleRecord' => $baseTransceiverStations,
			'pager' => $BaseTransceiverStation->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_location'),
				10
			),
			'listRecord' => base_url(
				current_url(true)->setSegment(5, '')->getPath()
			),
			'restoreRecord' => base_url(
				current_url(true)->setSegment(5, 'restore')->getPath()
			),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()
			),
			'purgeRecycle' => base_url(
				current_url(true)->setSegment(5, 'purge')->getPath()
			)
		];

		return $view->setData($data)->render('BTS/Devices/recycle');
	}

	public function monitoring_link()
	{
		$view = \Config\Services::renderer();

		$BaseTransceiverStation = new BaseTransceiverStation();
		$InternetSubscription = new InternetSubscription();
		$Customer = new Customer();
		$Device = new Device();
		$Location = new Location();

		$allIndependentBts = $BaseTransceiverStation->get_all_independent_bts_for_monitor();
		$customersBtsId = array();
		$customersBts = array();
		$customers = $Customer->findAll();

		foreach($customers as $customer) {
			$inet_subscriptions = $InternetSubscription->where('customer', $customer->id)->findAll();
			foreach($inet_subscriptions as $inet_subscription) {
				$running = 0;
				$bts = $BaseTransceiverStation->find($inet_subscription->cpe);
				$rootBts = $BaseTransceiverStation->find($bts->root);
				$device = $Device->find($bts->device);
				$deviceRoot = $Device->find($rootBts->device);
				$locationBts = $Location->find($device->location);
				$locationRoot = $Location->find($deviceRoot->location);
				$btsData = array(
					'latitude' => $locationBts->latitude,
					'longitude' => $locationBts->longitude,
					'name' => $locationBts->name
				);
				$rootBtsData = array(
					'latitude' => $locationRoot->latitude,
					'longitude' => $locationRoot->longitude
				);
				$tempData = array(
					'bts' => $btsData,
					'root_bts' => $rootBtsData
				);
				if(intval($device->active) === 1 && intval($deviceRoot->active) === 1) {
					$running = 1;
				}
				$tempCustomersBts = array(
					'customer' => $btsData,
					'bts' => $rootBtsData,
					'running' => $running
				);
				array_push($customersBts,$tempCustomersBts);
				array_push($customersBtsId,$bts->id);
			}
		}
		if(empty($customersBtsId)) {
			$dependentsBts = $BaseTransceiverStation->where('active',1)->where('root !=',null)->findAll();
		} else {
			$dependentsBts = $BaseTransceiverStation->where('active',1)->where('root !=',null)->whereNotIn('id',$customersBtsId)->findAll();
		}

		foreach($dependentsBts as $dependentBts) {
			$device = $Device->find($dependentBts->device);
			$location = $Location->find($device->location);
			$dependentBts->latitude = $location->latitude;
			$dependentBts->longitude = $location->longitude;
			$dependentBts->active = $device->active;
		}

		$linkStatus = array();
		$pathTemp = array();

		foreach ($dependentsBts as $bts) {
			$status = '0';
			$temp = array('latitude' => $bts->latitude, 'longitude' => $bts->longitude);
			$otherBts = $BaseTransceiverStation->get_single_bts_by_id($bts->root);
			$tempBts2 = [
				'latitude' => $otherBts['latitude'],
				'longitude' => $otherBts['longitude']
			];

			if ($otherBts['active'] == '1' && $bts->active == '1') {
				$status = '1';
			}

			$pathTemp = [
				'bts1' => $temp,
				'bts2' => $tempBts2,
				'running' => $status
			];

			array_push($linkStatus, $pathTemp);
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'allIndependentBts' => json_encode($allIndependentBts),
			'allDependentBts' => json_encode($dependentsBts),
			'linkStatus' => json_encode($linkStatus),
			'customerLink' => json_encode($customersBts),
			'rendering_time' => $rendering_time
		];

		return $view->setData($data)->render('BTS/Monitor/index.php');
	}
}
