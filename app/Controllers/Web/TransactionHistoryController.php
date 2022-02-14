<?php

namespace App\Controllers\Web;
use App\Controllers\DashboardController;
use App\Models\TransactionCategory;
use App\Models\TransactionHistory;
use \DateTime;

class TransactionHistoryController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$TransactionHistory = new TransactionHistory();
		$TransactionCategory = new TransactionCategory();

		$transactions = $TransactionHistory->paginate(10,'transaction_history');

		foreach($transactions as $transaction) {
			$category = $TransactionCategory->find($transaction->category);
			$transaction->category = $category;
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'transactions' => $transactions,
			'pager' => $TransactionHistory->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_transaction_history'), 10),
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
			->render('Report/transaction-histories/index');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$TransactionCategory = new TransactionCategory();

		$categories = $TransactionCategory->where('is_income', 0)->findAll();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'categories' => $categories,
			'rendering_time' => $rendering_time,
			'ajax_transaction_categories' => base_url('api/get/transaction-categories'),
			'url_action' => base_url(
				current_url(true)->setSegment(5, 'create')->getPath()),
			'url_back' => base_url(
				current_url(true)
				->setSegment(5, '')
				->setSegment(5, '')
				->getPath())
		];

		return $view->setData($data)
			->render('Report/transaction-histories/new');
	}

	public function create()
	{	
		$request = service('request');
		$session = session();
		
		$TransactionHistory = new TransactionHistory();
		
		$currentHour = date('H');
		$currentMinute = date('i');
		$dateUnproc = DateTime::createFromFormat('d F, Y',$request->getPost('date'));
		if($dateUnproc === false) {
			$session->setFlashdata('conflict', 'Date and Time malfunction');
			return redirect()->back()->withInput();
		}
		$dateUnproc->setTime(intval($currentHour),intval($currentMinute));
		$data = [
			'title' => $request->getPost('title'),
			'date' => $dateUnproc->format('Y-m-d H:i:s'),
			'category' => $request->getPost('category'),
			'ammount' => $request->getPost('ammount'),
			'description' => $request->getPost('description'),
		];
		if($TransactionHistory->insert($data) == false){
			$session->setFlashdata('errors', $TransactionHistory->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(current_url(true)->setSegment(5, ''));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();
		
		$TransactionCategory = new TransactionCategory();
		$TransactionHistory = new TransactionHistory();

		$transaction_history = $TransactionHistory
			->find(current_url(true)->getSegment(6));
		$transaction_history->is_income = $TransactionCategory->find($transaction_history->category)->is_income;
		$unprocDate = DateTime::createFromFormat('Y-m-d H:i:s',$transaction_history->date);
		$transaction_history->date = $unprocDate->format('d F, Y');
		if($transaction_history->is_income == 1) {
			$categories = $TransactionCategory->where('is_income', 1)->findAll();
		} else {
			$categories = $TransactionCategory->where('is_income', 0)->findAll();
		}
		
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'transaction_history' => $transaction_history,
			'categories' => $categories,
			'ajax_transaction_categories' => base_url('api/get/transaction-categories'),
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
			->render('Report/transaction-histories/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$TransactionHistory = new TransactionHistory();
		
		$currentHour = date('H');
		$currentMinute = date('i');
		$dateUnproc = DateTime::createFromFormat('d F, Y',$request->getPost('date'));
		if($dateUnproc === false) {
			$session->setFlashdata('conflict', 'Date and Time malfunction');
			return redirect()->back()->withInput();
		}
		$dateUnproc->setTime(intval($currentHour),intval($currentMinute));
		$data = [
			'title' => $request->getPost('title'),
			'date' => $dateUnproc->format('Y-m-d H:i:s'),
			'category' => $request->getPost('category'),
			'ammount' => $request->getPost('ammount'),
			'description' => $request->getPost('description'),
		];
		if($TransactionHistory->update(current_url(true)->getSegment(6), $data) == false){
			$session->setFlashdata('errors', $TransactionHistory->errors());
			return redirect()->back()->withInput();
		}
		$session->setFlashdata('success_messages', 'SUCCESS');
		return redirect()->to(
			current_url(true)
			->setSegment(5, '')
			->setSegment(5, ''));
	}

	public function delete()
	{
		$request = service('request');
		$response = service('response');
		
		$TransactionHistory = new TransactionHistory();

		if ($request->isAJAX()) {
			$flag = false;
			if($request->getPost('permanent') == "true"){
				$flag=true;
			}
			if ($TransactionHistory
				->delete($request->getPost('id'),$flag)
			) {
				return $response->setStatusCode(200)->setJSON(
					[
						'message' => lang('DataManipulation.delete.success')
					]
				);
			}
			return $response->setStatusCode(500)->setJSON(
				[
					'message' => lang('DataManipulation.delete.failed')
				]
			);
		}
		return $response->setStatusCode(403);
	}
}
