<?php

namespace App\Controllers\Web;
use App\Controllers\DashboardController;

use App\Models\TransactionCategory;
use App\Models\Income;
use App\Models\Expense;
use CodeIgniter\I18n\Time;

class TransactionCategoryController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$TransactionCategory = new TransactionCategory();
		$categories = $TransactionCategory->paginate(10, 'category');

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'categories' => $categories,
			'pager' => $TransactionCategory->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('category'), 10),
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
			->render('Setting/TransactionCategory/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];

		return $view->setData($data)
			->render('Setting/TransactionCategory/new');
	}

	public function create()
	{	
		$request = service('request');
		$session = session();

		$TransactionCategory = new TransactionCategory();
		
		$is_income = 0;

		if ($request->getPost('is_income') === "on") {
			$is_income = 1;
		}
		$data = [
			'name' => $request->getPost('name'),
			'is_income' => $is_income
		];
		if($TransactionCategory->insert($data) == false){
			$session->setFlashdata('errors', $TransactionCategory->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(current_url(true)->setSegment(5, ''));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();
		
		$TransactionCategory = new TransactionCategory();

		$category = $TransactionCategory
			->find(current_url(true)->getSegment(6));

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'category' => $category,
			'rendering_time' => $rendering_time,
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'update')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];
		return $view->setData($data)
			->render('Setting/TransactionCategory/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();
		$TransactionCategory = new TransactionCategory();
		
		$is_income = 0;
		if($request->getPost('is_income') === "on") {
			$is_income = 1;
		}
		$data = [
			'name' => $request->getPost('name'),
			'is_income' => $is_income
		];
		if($TransactionCategory->update(
			current_url(true)->getSegment(6), $data) == false) {
			$session->setFlashdata('errors', $TransactionCategory->errors());
			return redirect()->back()->withInput();
		}
		$session->setFlashdata('success_messages','SUCCESS');
		return redirect()->to(
			current_url(true)
			->setSegment(5,'')
			->setSegment(5,''));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');

		$TransactionCategory = new TransactionCategory();
		$Income = new Income();
		$Expense = new Expense();

		if ($request->isAJAX()) {
			$flag = true;
			if($request->getPost('permanent') == 'true') {
				$flag = true;
			}
			$incomes = $Income
				->where('category',$request->getPost('id'))
				->findAll();
			foreach($incomes as $income) {
				$Income->delete($income->id, $flag);
			}
			$expenses = $Expense
				->where('category',$request->getPost('id'))
				->findAll();
			foreach($expenses as $expense) {
				$Expense->delete($expense->id, $flag);
			}
			if ($TransactionCategory->delete($request->getPost('id'), $flag)) {
				return $response
					->setStatusCode(200)
					->setJSON(['status' => 'DATA BTS BERHASIL DIHAPUS']);
			}
			return $response
				->setStatusCode(500)
				->setJSON(['status' => 'DATA BTS GAGAL DIHAPUS']);
		}
		return $response->setStatusCode(403);
	}
}
