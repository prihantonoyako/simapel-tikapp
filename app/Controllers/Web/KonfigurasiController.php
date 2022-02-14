<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\GroupMenuModel;
use App\Models\MenuModel;
use App\Models\KonfigurasiModel;

class KonfigurasiController extends DashboardController
{
	public function index()
	{
		$konfigurasiModel = new KonfigurasiModel;
		return $this->view
			->setVar('url', $this->request->uri)
			->setVar('konfigurasiDB', $konfigurasiModel->findAll())
			->render('Setting/Menu/index');
	}

	public function new()
	{
		return $this->view
			->setVar('url_action', $this->uri->setSegment(4,'create')->getPath())
			->render('Setting/Menu/new');
	}

	public function create()
	{
		$menuModel = new MenuModel;
		if ($menuModel
			->where('url_menu', $this->request->getPost('url_menu'))
			->where('id_group', $this->request->getPost('group_menu'))
			->first()
		) {
			return redirect()->back()->withInput()
				->with('conflict', true)->with('detail', 'URL sudah ada');
		}
		if ($menuModel
			->where('nomor_urut', $this->request->getPost('nomor_urut'))
			->where('id_group', $this->request->getPost('group_menu'))
			->first()
		) {
			return redirect()->back()->withInput()
				->with('conflict', true)
				->with('detail', 'Nomor Urut Invalid');
		}

		$data = [
			'id_group' => $this->request->getPost('group_menu'),
			'nama_menu' => $this->request->getPost('nama_menu'),
			'url_menu' => $this->request->getPost('url_menu'),
			'nomor_urut' => $this->request->getPost('nomor_urut'),
			'icon' => $this->request->getPost('icon')
		];
		if ($menuModel->insert($data) == false) {
			return redirect()->back()->withInput()
				->with('errors', $menuModel->errors());
		}
		$url = $this->uri->setSegment(4, '')->getPath();
		return redirect()->to(base_url($url));
	}

	public function edit()
	{
		$menuModel = new MenuModel;
		$groupMenuModel = new GroupMenuModel;
		$id = $this->uri->getSegment(5);
		$menuDB = $menuModel->find($id);
		$groupMenuDB = $groupMenuModel->findAll();
		$url = $this->uri->setSegment(4, 'update');
		$urutan = $menuModel->builder()
			->where('id_group', $menuDB->id_group)
			->select('nomor_urut')->get()->getResult();
		return $this->view
			->setVar('menuDB', $menuDB)
			->setVar('groupMenuDB', $groupMenuDB)
			->setVar('invalidUrutan', $urutan)
			->setVar('url_action', $url)
			->render('Setting/Menu/edit');
	}

	public function update()
	{
		$menuModel = new MenuModel;
		$id_menu = $this->uri->getSegment(5);
		$menu = $menuModel->find($id_menu);

		if ($menu->id_group != $this->request->getPost('id_group')) {
			if($menuModel
				->where('id_group',$this->request->getPost('id_group'))
				->where('url_menu',$this->request->getPost('url_menu'))
				->first())
				{
					return redirect()->back()
					->with('conflict',true)
					->with('detail','URL INVALID');
				}
			if ($menuModel
				->where('id_group', $this->request->getPost('id_group'))
				->where('nomor_urut', $this->request->getPost('nomor_urut'))
				->first()
			) {
				return redirect()->back()
					->with('conflict', true)
					->with('detail', 'Nomor Urut Invalid');
			}
		} else {
			if ($menuModel
				->where('id_group', $menu->id_group)
				->where('url_menu !=', $menu->url_menu)
				->where('url_menu', $this->request->getPost('url_menu'))
				->first()
			) {
				return redirect()->back()
					->with('conflict', true)
					->with('detail', 'URL sudah ada');
			}
			if ($menuModel
				->where('id_group', $menu->id_group)
				->where('nomor_urut !=', $menu->nomor_urut)
				->where('nomor_urut', $this->request->getPost('nomor_urut'))
				->first()
			) {
				return redirect()->back()
					->with('conflict', true)
					->with('detail', 'Nomor Urut Invalid');
			}
		}

		$data = [
			'id_group' => $this->request->getPost('id_group'),
			'nama_menu' => $this->request->getPost('nama_menu'),
			'url_menu' => $this->request->getPost('url_menu'),
			'nomor_urut' => $this->request->getPost('nomor_urut'),
			'icon' => $this->request->getPost('icon')
		];
		if ($menuModel->update($id_menu, $data) == false) {
			return redirect()->back()->withInput()
				->with('errors', $menuModel->errors());
		}
		$url_success = $this->uri->setSegment(4, '')->setSegment(4, '')->getPath();
		return redirect()->to($url_success);
	}

	public function delete()
	{
		if ($this->request->isAJAX()) {
			$menu = new MenuModel;
			if ($menu->delete($this->request->getPost('id_menu'))) {
				return $this->response->setStatusCode(200)->setJSON(['status' => 'DATA MENU BERHASIL DIHAPUS']);
			}
			return $this->response->setStatusCode(500)->setJSON(['status' => 'DATA MENU GAGAL DIHAPUS']);
		}
		return $this->response->setStatusCode(403);
	}
}
