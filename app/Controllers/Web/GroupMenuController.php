<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\GroupMenu;
use App\Models\Menu;
use App\Models\Access;

class GroupMenuController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$GroupMenu = new GroupMenu();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'allGroupMenu' => $GroupMenu->orderBy('ordinal')->paginate(10, 'group'),
			'pager' => $GroupMenu->pager,
			'recordNumber' => pagination_record_number($request->getGet('page_group'), 10),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath())
		];
		return $view->setData($data)->render('Setting/GroupMenu/index');
	}

	public function show()
	{
		$view = \Config\Services::renderer();
		$GroupMenu = new GroupMenu();

		$data = [
			'groupMenu' => $GroupMenu->find(current_url(true)->getSegment(6)),
			'url_edit' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()
			)
		];
		return $view->setData($data)->render('Setting/GroupMenu/show');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$GroupMenu = new GroupMenu();
		
		$data = [
			'url_action' => base_url(current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5, '')->getPath()),
			'allGroupMenu' => $GroupMenu->findAll(),
		];

		return $view->setData($data)->render('Setting/GroupMenu/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();

		$GroupMenu = new GroupMenu();

		$url_proc_slug = str_replace(' ', '-', $request->getPost('url'));
		if ($GroupMenu->where('url', $request->getPost('url'))->first) {
			$session->setFlashdata('conflict', "URL exists!");
			return redirect()->back()->withInput();
		}
		if ($GroupMenu
			->where('ordinal', $request->getPost('ordinal'))
			->first()
		) {
			$session->setFlashdata('conflict', "Menu order exists!");
			return redirect()->back()->withInput();
		}

		$data = [
			'name' => $request->getPost('name'),
			'url' => $url_proc_slug,
			'icon' => $request->getPost('icon'),
			'ordinal' => $request->getPost('ordinal')
		];
		if ($GroupMenu->insert($data) == false) {
			$session->setFlashdata('errors', $GroupMenu->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5, '')->getPath()));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();

		$GroupMenu = new GroupMenu();
		
		$data = [
			'groupMenu' => $GroupMenu->find(current_url(true)->getSegment(6)),
			'allGroupMenu' => $GroupMenu->findAll(),
			'url_action' => base_url(current_url(true)->setSegment(5, 'update')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()
			)
		];

		return $view->setData($data)->render('Setting/GroupMenu/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$GroupMenu = new GroupMenu();

		$url_proc_slug = str_replace(' ', '-', $request->getPost('url'));
		if (
			$GroupMenu->where('id !=', current_url(true)->getSegment(6))
			->where('url', $url_proc_slug)
			->first()
		) {
			$session->setFlashdata('conflict', 'URL exists!');
			return redirect()->back();
		}
		if (
			$GroupMenu->where('id !=', current_url(true)->getSegment(6))
			->where('ordinal', $request->getPost('ordinal'))
			->first()
		) {
			$session->setFlashdata('conflict', 'Group menu order exists!');
			return redirect()->back();
		}

		$data = [
			'name' => $request->getPost('name'),
			'url' => $url_proc_slug,
			'icon' => $request->getPost('icon'),
			'ordinal' => $request->getPost('ordinal')
		];
		if ($GroupMenu->update(current_url(true)->getSegment(6), $data) == false) {
			$session->setFlashdata('errors', $GroupMenu->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5, '')->setSegment(5, '')->getPath()));
	}

	public function recycle()
	{
		$view = \Config\Services::renderer();

		$GroupMenu = new GroupMenu();
		
		$data = [
			'recycleRecord' => $GroupMenu->orderBy('ordinal')->onlyDeleted()->paginate(10, 'group'),
			'pager' => $GroupMenu->pager,
			'listRecord' => base_url(current_url(true)->setSegment(5, '')->getPath()),
			'restoreRecord' => base_url(current_url(true)->setSegment(5, 'restore')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath()),
			'purgeRecycle' => base_url(current_url(true)->setSegment(5, 'purge')->getPath())
		];

		return $view->setData($data)->render('Setting/GroupMenu/recycle');
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$GroupMenu = new GroupMenu();
		$Menu = new Menu();
		$Access = new Access();

		if ($request->isAJAX()) {
			$flag = false;
			if ($request->getPost('permanent') == "true") {
				$flag = true;
				foreach ($Menu->where('group', $request->getPost('id'))->findAll() as $item) {
					foreach ($Access->where('menu', $item->id)->findAll() as $itemAccess) {
						$Access->delete($itemAccess->id, $flag);
					}
					if($Menu->delete($item->id,$flag)==false) {
						return $response->setStatusCode(500)->setJSON(['message'=>lang('DataManipulation.delete.failed')]);
					}
				}
			}
			if ($GroupMenu->delete($request->getPost('id'), $flag)) {
				return $response->setStatusCode(200)->setJSON(['message' => lang('DataManipulation.delete.success')]);
			}
			return $response->setStatusCode(500)->setJSON(['message' => lang('DataManipulation.delete.failed')]);
		}
		return $response->setStatusCode(403)->setJSON(['message' => 'FORBIDDEN ACCESS']);
	}

	public function restore()
	{
		$request = service('request');
		$response = service('response');

		$GroupMenu = new GroupMenu();

		if ($request->isAJAX()) {
			$restore = ['deleted_at' => null];
			if ($GroupMenu->update($request->getPost('id'), $restore)) {
				return $response->setStatusCode(200)->setJSON(['message' => lang('DataManipulation.restore.success')]);
			}
			return $response->setStatusCode(500)->setJSON(['message' => lang('DataManipulation.restore.failed')]);
		}
		return $response->setStatusCode(403)->setJSON(['message' => 'FORBIDDEN ACCESS']);
	}

	public function purge()
	{
		$GroupMenu = new GroupMenu();
		$Menu = new Menu();
		$Access = new Access();
		
		if (!$GroupMenu->onlyDeleted()->findAll()) {
			return redirect()->back();
		}
		foreach ($GroupMenu->onlyDeleted()->findAll() as $itemGroup) {
			foreach ($Menu->where('group', $itemGroup->id)->findAll() as $item) {
				foreach ($Access->where('menu', $item->id)->findAll() as $itemAccess) {
					$Access->delete($itemAccess->id, true);
				}
				$Menu->delete($item->id,true);
			}
			$GroupMenu->delete($itemGroup->id,true);
		}
		return redirect()->back();
	}
}
