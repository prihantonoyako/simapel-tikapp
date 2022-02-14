<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\BaseTransceiverStation;
use App\Models\Vendor;
use App\Models\Item;
use App\Models\Device;
use App\Models\InternetSubscription;

class ItemController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Item = new Item();
		$Vendor = new Vendor();

		$vendors = array();
		$items = $Item->paginate(10, 'item');

		foreach ($items as $item) {
			$item->is_bts = intval($item->is_bts);
			if (array_key_exists($item->vendor, $vendors)) {
				$item->vendor = $vendors[$item->vendor];
			} else {
				$vendor = $Vendor->find($item->vendor);
				$vendors[$vendor->id] = $vendor->name;
				$item->vendor = $vendor->name;
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'items' => $items,
			'pager' => $Item->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_item'),
				10
			),
			'rendering_time' => $rendering_time,
			'flagDelete' => "false",
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

		return $view->setData($data)->render('Item/Stock/index');
	}

	public function new()
	{
		$Vendor = new Vendor();
		$view = \Config\Services::renderer();

		$url_action = current_url(true)->setSegment(5, 'create');
		$url_back = current_url(true)->setSegment(5, '');

		timer('app benchmark');

		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'vendor' => $Vendor->findAll(),
			'rendering_time' => $rendering_time,
			'url_action' => $url_action,
			'url_back' => $url_back
		];

		return $view->setData($data)->render('Item/Stock/new');
	}

	public function create()
	{
		$session = session();
		$request = service('request');

		$Item = new Item();

		$is_bts = 0;

		if ($Item
			->where('name', $request->getPost('name'))
			->where('vendor', $request->getPost('vendor'))
			->first()
		) {
			$session->setFlashdata('conflict', 'NAME EXISTS!');
			return redirect()->back()->withInput();
		}
		if ($request->getPost('is_bts') === "on") {
			$is_bts = 1;
		}
		$data = [
			'name' => $request->getPost('name'),
			'quantity' => intval($request->getPost('quantity')),
			'is_bts' => $is_bts,
			'vendor' => intval($request->getPost('vendor'))
		];
		if ($Item->insert($data) == false) {
			$session->setFlashdata('errors', $Item->errors());
			return redirect()->back()->withInput();
		}
		$session->setFlashdata('success_messages', 'SUCCESS');
		return redirect()->to(current_url(true)->setSegment(5, ''));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$Item = new Item();
		$Vendor = new Vendor();

		timer('app benchmark');

		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'vendor' => $Vendor->findAll(),
			'itemRecord' => $Item->find($this->uri->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_action' => base_url($this->uri->setSegment(5, 'update')->getPath()),
			'url_back' => base_url($this->uri->setSegment(5, '')->setSegment(5, '')->getPath())
		];

		return $view->setData($data)->render('Item/Stock/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$Item = new Item();

		$is_bts = 0;

		if ($request->getPost('is_bts') === "on") {
			$is_bts = 1;
		}

		$data = [
			'name' => $request->getPost('name'),
			'quantity' => $request->getPost('quantity'),
			'is_bts' => $is_bts,
			'vendor' => $request->getPost('vendor')
		];
		if ($Item->update($this->uri->getSegment(6), $data) == false) {
			$session->setFlashdata('errors', $Item->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(
			current_url(true)->setSegment(5, '')->setSegment(5, '')
		);
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$Item = new Item();
		$Device = new Device();
		$BaseTransceiverStation = new BaseTransceiverStation();
		$InternetSubscription = new InternetSubscription();

		if ($request->isAJAX()) {
			$flag = false;

			if ($request->getPost('permanent') == 'true') {
				$flag = true;
			}

			$devices = $Device
				->where('item', $request->getPost('item'))
				->where('deleted_at', null)
				->findAll();

			if (!empty($devices)) {
				return $response
					->setStatusCode(500)
					->setJSON(['message' => 'Terdapat Perangkat Aktif']);
			} else {
				$devices = $Device
					->where('item', $request->getPost('item'))
					->where('deleted_at !=', null)
					->findAll();
				foreach ($devices as $device) {
					$bts = $BaseTransceiverStation
						->where('device', $device->id)
						->where('deleted_at', null)
						->first();
					if (!empty($bts)) {
						return $response
							->setStatusCode(500)
							->setJSON(['message' => 'Terdapat BTS Aktif']);
					} else {
						$bts = $BaseTransceiverStation
							->where('device', $device->id)
							->where('deleted_at !=', null)
							->first();
						$subscription = $InternetSubscription
							->where('deleted_at', null)
							->where('cpe', $bts->id)
							->first();
						if (!empty($subscription)) {
							return $response
								->setStatusCode(500)
								->setJSON(['message' => 'Terdapat Langganan Aktif']);
						} else {
							$subscription = $InternetSubscription
								->where('deleted_at !=', null)
								->where('cpe', $bts->id)
								->first();
							$InternetSubscription->delete($subscription->id, $flag);
						}
						$BaseTransceiverStation->delete($bts->id, $flag);
					}
					$Device->delete($device->id, $flag);
				}
			}

			if ($Item->delete($request->getPost('item'), $flag)) {
				return $response
					->setStatusCode(200)
					->setJSON(['message' => 'Item berhasil dihapus']);
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

		$Item = new Item();
		$Vendor = new Vendor();

		$vendors = array();
		$items = $Item->onlyDeleted()->paginate(10, 'item');

		foreach ($items as $item) {
			$item->is_bts = intval($item->is_bts);
			if (array_key_exists($item->vendor, $vendors)) {
				$item->vendor = $vendors[$item->vendor];
			} else {
				$vendor = $Vendor->find($item->vendor);
				$vendors[$vendor->id] = $vendor->name;
				$item->vendor = $vendor->name;
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'items' => $items,
			'pager' => $Item->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_item'),
				10
			),
			'rendering_time' => $rendering_time,
			'flagDelete' => "true",
			'listRecord' => base_url(
				current_url(true)->setSegment(5, '/')->getPath()
			),
			'purgeRecord' => base_url(
				current_url(true)->setSegment(5, 'purge')->getPath()
			),
			'restoreRecord' => base_url(
				current_url(true)->setSegment(5, 'restore')->getPath()
			),
			'deleteRecord' => base_url(
				current_url(true)->setSegment(5, 'delete')->getPath()
			)
		];

		return $view->setData($data)->render('Item/Stock/index');
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$Item = new Item();

		if ($request->isAJAX()) {
			$data = ['deleted_at' => null];
			if ($Item->update($request->getPost('id'), $data)) {
				return $response->setStatusCode(200)->setJSON(['message' => 'ITEM IS RESTORED']);
			}
			return $response->setStatusCode(500);
		}
		
		return $response->setStatusCode(403);
	}
}