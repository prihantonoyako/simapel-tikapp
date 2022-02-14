<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\InternetPlan;
use App\Models\InternetSubscription;

class InternetPlanController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$InternetPlan = new InternetPlan();

		$internetPlans = $InternetPlan->paginate(10, 'plan');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'internetPlans' => $internetPlans,
			'pager' => $InternetPlan->pager,
			'recordNumber' => pagination_record_number($request->getGet('page_plan'), 10),
			'rendering_time' => $rendering_time,
			'flagDelete' => "false",
			'newRecord' => base_url(current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath())
		];

		return $view->setData($data)->render('Configuration/Internet-Plan/index');
	}

	public function show()
	{
		$view = \Config\Services::renderer();

		$InternetPlan = new InternetPlan();

		$data = [
			'internetPlan' => $InternetPlan->find(current_url(true)->getSegment(6)),
			'url_edit' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()
			)
		];
		return $view->setData($data)->render('Configuration/Internet-Plan/show');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'url_action' => base_url(current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5, '')->getPath())
		];
		return $view->setData($data)->render('Configuration/Internet-Plan/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$InternetPlan = new InternetPlan();
		$dedicatedFlag = 0;

		if ($request->getPost('dedicated') === "on") {
			$dedicatedFlag = 1;
		}

		$data = [
			'name' => $request->getPost('name'),
			'dedicated' => $dedicatedFlag,
			'download' => $request->getPost('download'),
			'upload' => $request->getPost('upload'),
			'download_unit' => $request->getPost('download_unit'),
			'upload_unit' => $request->getPost('upload_unit'),
			'price' => $request->getPost('price')
		];

		if ($InternetPlan->insert($data) == false) {
			$session->setFlashdata('errors', $InternetPlan->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(base_url(current_url(true)->setSegment(5, '')->getPath()));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$InternetPlan = new InternetPlan();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'internetPlan' => $InternetPlan->find(current_url(true)->getSegment(6)),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(current_url(true)->setSegment(5, 'update')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath())
		];

		return $view->setData($data)->render('Configuration/Internet-Plan/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$InternetPlan = new InternetPlan();
		$dedicatedFlag = 0;

		if ($request->getPost('dedicated') === "on") {
			$dedicatedFlag = 1;
		}

		$data = [
			'name' => $request->getPost('name'),
			'dedicated' => $dedicatedFlag,
			'download' => $request->getPost('download'),
			'upload' => $request->getPost('upload'),
			'download_unit' => $request->getPost('download_unit'),
			'upload_unit' => $request->getPOst('upload_unit'),
			'price' => $request->getPost('price')
		];

		if ($InternetPlan->update(current_url(true)->getSegment(6), $data) == false) {
			$session->setFlashdata('errors', $InternetPlan->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(base_url(current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()));
	}

	public function recycle()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$InternetPlan = new InternetPlan();

		$internetPlans = $InternetPlan->onlyDeleted()->paginate(10, 'plan');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'internetPlans' => $internetPlans,
			'pager' => $InternetPlan->pager,
			'recordNumber' => pagination_record_number($request->getGet('page_plan'), 10),
			'rendering_time' => $rendering_time,
			'flagDelete' => "true",
			'listRecord' => base_url(current_url(true)->setSegment(5, '/')->getPath()),
			'purgeRecord' => base_url(current_url(true)->setSegment(5, 'purge')->getPath()),
			'restoreRecord' =>base_url(current_url(true)->setSegment(5, 'restore')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath())
		];

		return $view->setData($data)->render('Configuration/Internet-Plan/index');
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');
		$InternetPlan = new InternetPlan();
		$InternetSubscription = new InternetSubscription();
		if ($request->isAJAX()) {
			$flag = false;
			if ($request->getPost('permanent') == "true") {
				$flag = true;
			}
			$internet_subscriptions = $InternetSubscription
				->where('internet_plan', $request->getPost('id'))
				->where('active', 1)
				->findAll();
			if (empty($internet_subscriptions)) {
				$subscriptions = $InternetSubscription
					->where('internet_plan', $request->getPost('id'))
					->findAll();
				foreach ($subscriptions as $subscription) {
					$InternetSubscription->delete($subscription->id, $flag);
				}
				$InternetPlan->delete($request->getPost('id'), $flag);
				return $response->setStatusCode(200)->setJSON(['message' => 'Data paket langganan berhasil dihapus']);
			} else {
				return $response->setStatusCode(500)->setJSON(['message' => 'Terdapat Langganan Paket Aktif']);
			}
		}
		return $response->setStatusCode(403);
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$InternetPlan = new InternetPlan();
		$InternetSubscription = new InternetSubscription();

		if ($request->isAJAX()) {
			$data = ['deleted_at' => null];

			$subscriptions = $InternetSubscription
				->where('internet_plan', $request->getPost('id'))
				->onlyDeleted()
				->findAll();

			if(!empty($subscriptions)) {
				foreach($subscriptions as $subscription) {
					$InternetSubscription->update($subscription->id, $data);
				}
			}

			if ($InternetPlan->onlyDeleted()->update($request->getPost('id'), $data)) {
				return $response->setStatusCode(200)->setJSON(['message' => lang('DataManipulation.restore.success')]);
			}
			
			return $response->setStatusCode(500);
		}
		return $response->setStatusCode(403);
	}

	public function purge()
	{
		$InternetPlan = new InternetPlan();
		$InternetSubscription = new InternetSubscription();
		
		$subscriptions = $InternetSubscription->onlyDeleted()->findAll();
		$plans = $InternetPlan->onlyDeleted()->findAll();
		
		if(empty($plans) && empty($subscriptions)) {
			return redirect()->back();
		} elseif(empty($plans)) {
			return redirect()->back();
		} elseif(!empty($subscriptions)) {
			foreach($subscriptions as $subscription) {
				$InternetSubscription->delete($subscription->id,true);
			}
		}
		foreach($plans as $plan) {
			$InternetPlan->delete($plan->id, true);
		}
		return redirect()->back();
	}
}
