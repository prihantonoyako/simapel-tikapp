<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\GroupMenu;
use App\Models\Menu;
use App\Models\Access;
use App\Libraries\Paginator;

class MenuController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');

		$Menu = new Menu();
		$GroupMenu = new GroupMenu();

		$groupMenus = array();
		
		$menus = $Menu->paginate(10,'menu');

		foreach($menus as $menu) {
			if(array_key_exists($menu->group,$groupMenus)) {
				$menu->group_menu_name = $groupMenus[$menu->group]['name'];
			} else {
				$groupMenu = $GroupMenu->find($menu->group);
				$groupMenus[$groupMenu->id] = array(
					'name' => $groupMenu->name
				);
				$menu->group_menu_name = $groupMenu->name;
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'menus' => $menus,
			'pager' => $Menu->pager,
			'recordNumber' => pagination_record_number(
				$this->request->getGet('page_menu'),10),
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

		return $this->view->setData($data)->render('Setting/Menu/index');
	}

	public function show()
	{
		$Menu = new Menu;
		$GroupMenu = new GroupMenu;
		$menuRecord = $Menu->find($this->uri->getSegment(6));
		$data = [
			'menuRecord' => $menuRecord,
			'groupMenuRecord' => $GroupMenu->find($menuRecord->group),
			'url_edit' => base_url(
				current_url(true)->setSegment(5, 'edit')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];
		return $this->view->setData($data)->render('Setting/Menu/show');
	}

	public function new()
	{
		$GroupMenu = new GroupMenu;

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'groupMenu' => $GroupMenu->findAll(),
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(
				current_url(true)->setSegment(5, '')->getPath())
		];
		return $this->view->setData($data)->render('Setting/Menu/new');
	}

	public function create()
	{
		$Menu = new Menu;
		$active = '0';
		$url_proc_slug = str_replace(' ', '-', $this->request->getPost('url'));
		if (strcmp($this->request->getPost('active'), 'on') == 0) {
			$active = '1';
		}
		if ($Menu
			->where('url', $url_proc_slug)
			->where('group', $this->request->getPost('group'))
			->first()
		) {
			$this->session->setFlashdata('conflict', "URL exists!");
			return redirect()->back()->withInput();
		}
		if ($Menu
			->where('ordinal', $this->request->getPost('ordinal'))
			->where('group', $this->request->getPost('group'))
			->first()
		) {
			$this->session->setFlashdata('conflict', "Order number exists!");
			return redirect()->back()->withInput();
		}
		$data = [
			'group' => $this->request->getPost('group'),
			'name' => $this->request->getPost('name'),
			'url' => $url_proc_slug,
			'ordinal' => $this->request->getPost('ordinal'),
			'icon' => $this->request->getPost('icon'),
			'active' => $active
		];
		if ($Menu->insert($data) == false) {
			$this->session->setFlashdata('errors', $Menu->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url($this->uri->setSegment(5, '')->getPath()));
	}

	public function edit()
	{
		$Menu = new Menu;
		$GroupMenu = new GroupMenu;

		$menu = $Menu->find($this->uri->getSegment(6));

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'menuRecord' => $menu,
			'groupMenu' => $GroupMenu->findAll(),
			'allMenu' => $Menu->where('group',$menu->group)->findAll(),
			'rendering_time' => $rendering_time,
			'url_action' => base_url($this->uri->setSegment(5, 'update')->getPath()),
			'url_back' => base_url($this->uri->setSegment(5, '')->setSegment(5, '')->getPath())
		];
		return $this->view->setData($data)->render('Setting/Menu/edit');
	}

	public function update()
	{
		$Menu = new Menu;
		$menu = $Menu->find($this->uri->getSegment(6));
		$active = '0';
		$url_proc_slug = str_replace(' ', '-', $this->request->getPost('url'));
		if ($menu->group != $this->request->getPost('group')) {
			if ($Menu
				->where('group', $this->request->getPost('group'))
				->where('url', $url_proc_slug)
				->first()
			) {
				$this->session->setFlashdata('conflict', 'URL exists!');
				return redirect()->back();
			}
			if ($Menu
				->where('group', $this->request->getPost('group'))
				->where('ordinal', $this->request->getPost('ordinal'))
				->first()
			) {
				$this->session->setFlashdata('conflict', 'Order number exists!');
				return redirect()->back();
			}
		} else {
			if ($Menu
				->where('group', $menu->group)
				->where('url !=', $menu->url)
				->where('url', $url_proc_slug)
				->first()
			) {
				$this->session->setFlashdata('conflict', 'URL exists!');
				return redirect()->back();
			}
			if ($Menu
				->where('group', $menu->group)
				->where('ordinal !=', $menu->ordinal)
				->where('ordinal', $this->request->getPost('ordinal'))
				->first()
			) {
				$this->session->setFlashdata('conflict', 'Order number exists!');
				return redirect()->back();
			}
		}

		if (strcmp($this->request->getPost('active'), 'on') == 0) {
			$active = '1';
		}

		$data = [
			'group' => $this->request->getPost('group'),
			'name' => $this->request->getPost('name'),
			'url' => $url_proc_slug,
			'ordinal' => $this->request->getPost('ordinal'),
			'icon' => $this->request->getPost('icon'),
			'active' => $active
		];
		if ($Menu->update($this->uri->getSegment(6), $data) == false) {
			$this->session->setFlashdata('errors', $Menu->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url($this->uri->setSegment(5, '')->setSegment(5, '')->getPath()));
	}

	public function recycle()
	{
		helper('pagination_record_number');
		$Menu = new Menu;
		$Paginator = new Paginator(10, base_url($this->uri->getPath()), 'menu');
		$Paginator->set_record_count($Menu->builder()->countAll());
		$Paginator->set_page_number($this->request->getGet('page_menu'));
		$allMenu = $Menu->builder()
			->select('menu.active, menu.deleted_at, menu.ordinal as menu_ordinal,menu.id as menu_id,menu.name as menu_name,menu.url as menu_url,menu.icon as menu_icon,group_menu.name as group_menu_name')
			->where('menu.deleted_at !=', null)
			->limit($Paginator->get_limit(), $Paginator->get_offset_record($this->request->getGet('page_menu')))
			->join('group_menu', 'group_menu.id = menu.group')
			->get()->getResult();
		$data = [
			'menuRecord' => $allMenu,
			'Paginator' => $Paginator,
			'recordIndex' => $Paginator->get_first_index(),
			'listRecord' => base_url($this->uri->setSegment(5, '')->getPath()),
			'deleteRecord' => base_url($this->uri->setSegment(5, 'delete')->getPath()),
			'purgeRecycle' => base_url($this->uri->setSegment(5, 'purge')->getPath())
		];
		return $this->view->setData($data)->render($this->rooViewPath.'recycle');
	}

	public function delete()
	{
		$Menu = new Menu;
		$Access = new Access;
		if ($this->request->isAJAX()) {
			$flag = false;
			$json = file_get_contents('php://input');
			$data = json_decode($json);
			if ($data->permanent == "true") {
				$flag = true;
				foreach ($Access->where('menu',(int) $data->id)->findAll() as $itemAccess) {
					$Access->delete($itemAccess->id, $flag);
				}
			}
			if ($Menu->delete($data->id, $flag)) {
				return $this->response->setStatusCode(200)->setJSON(['message' => 'DATA MENU BERHASIL DIHAPUS']);
			}
			return $this->response->setStatusCode(500)->setJSON(['message' => 'DATA MENU GAGAL DIHAPUS']);			
		}
		return $this->response->setStatusCode(403);
	}

	public function restore()
	{
		$Menu = new Menu;
		if ($this->request->isAJAX()) {
			$data = ['deleted_at' => null];
			$json = file_get_contents('php://input');
			$data = json_decode($json);
			if ($Menu->update((int) $data->id, $data)) {
				return $this->response->setStatusCode(200)->setJSON(['message' => lang('DataManipulation.restore.success')]);
			}
			return $this->response->setStatusCode(500);
		}
		return $this->response->setStatusCode(403);
	}

	public function purge()
	{
		$Menu = new Menu;
		$Access = new Access;
		if (!$Menu->onlyDeleted()->findAll()) {
			return redirect()->back();
		}
		foreach ($Menu->onlyDeleted()->findAll() as $item) {
			foreach ($Access->where('menu', $item->id)->findAll() as $itemAccess) {
				$Access->delete($itemAccess->id, true);
			}
			$Menu->delete($item->id,true);
		}
		return redirect()->back();
	}
}
