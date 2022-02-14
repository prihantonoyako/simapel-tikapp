<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\ProblemReportHistory;
use App\Models\ProblemReport;
use App\Models\ProblemUserDispatched;
use App\Models\Log;
use App\Models\User;
use App\Models\Bill;

class ProblemHistoryController extends DashboardController
{

	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$ProblemReportHistory = new ProblemReportHistory();
		$ProblemReport = new ProblemReport();
		$User = new User();

		$problems = $ProblemReport->paginate(10, 'problem_report');
		foreach($problems as $problem) {
			$history = $ProblemReportHistory->where('problem_report', $problem->id)->where('active', 1)->first();
			$problem->pic = $User->find($history->user);
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');
		
		$data = [
			'problems' => $problems,
			'pager' => $ProblemReport->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_problem_report'),
				10
			),
			'rendering_time'=> $rendering_time,
			'newRecord' => base_url(current_url(true)->setSegment(5, 'new')->getPath()),
			'editRecord' => base_url(current_url(true)->setSegment(5, 'edit')->getPath()),
			'showRecord' => base_url(current_url(true)->setSegment(5, 'show')->getPath()),
			'recycleRecord' => base_url(current_url(true)->setSegment(5, 'recycle')->getPath()),
			'deleteRecord' => base_url(current_url(true)->setSegment(5, 'delete')->getPath())
		];

		return $view->setData($data)->render('Report/problem-report-history/index');
	}

	public function show()
	{
		$view = \Config\Services::renderer();

		$Log = new Log();
		$ProblemReport = new ProblemReport();
		$ProblemReportHistory = new ProblemReportHistory();

		$problem_report = $ProblemReport->find(current_url(true)->getSegment(6));
		$problem_report_histories = $ProblemReportHistory->where('problem_report', $problem_report->id)->findAll();

		foreach($problem_report_histories as $history) {
			$history->title = $Log->find($history->log)->title;
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'url_log' => base_url(current_url(true)->setSegment(5,'detail-log')->setSegment(6,'')->getPath()),
			'histories' => $problem_report_histories,
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(current_url(true)->setSegment(5, 'follow-up')->setSegment(6, $problem_report->id)->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5, '')->setSegment(5,'')->getPath())
		];

		return $view->setData($data)->render('Report/problem-report-history/show');
	}

	public function new()
	{
		$view = \Config\Services::renderer();

		$ProblemUserDispatched = new ProblemUserDispatched();
		$User = new User();

		$users_dispatched_id = array();
		$users_dispatched = $ProblemUserDispatched->findAll();

		foreach($users_dispatched as $user_dispatched) {
			array_push($users_dispatched_id,$user_dispatched->id);
		}
		if(empty($users_dispatched_id)) {
			$users_available = $User->findAll();
		} else {
			$users_available = $User->whereNotIn('id',$users_dispatched_id)->findAll();
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'users_available' => $users_available,
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

		return $view->setData($data)->render('Report/problem-report-history/new');
	}

	public function create()
	{
		$request = service('request');
		$session = session();
		
		$Log = new Log();
		$ProblemReport = new ProblemReport();
		$ProblemReportHistory = new ProblemReportHistory();
		$ProblemUserDispatched = new ProblemUserDispatched();

		$data = [
			'title' => $request->getPost('title'),
			'description' => $request->getPost('description'),
		];

		$log = $Log->insert($data, true);

		if($log == false) {
			$session->setFlashdata('errors',$Log->errors());
			return redirect()->back()->withInput();
		}

		$data = [
			'ticket' => $log.date('Y-m-d_His'),
			'status' => 1
		];
		
		$problem = $ProblemReport->insert($data, true);

		if($problem == false) {
			$Log->delete($log, true);
			$session->setFlashdata('errors',$ProblemReport->errors());
			return redirect()->back()->withInput();
		}
		
		$data = [
			'problem_report' => $problem,
			'user' => $request->getPost('user'),
			'log' => $log,
			'active' => 1
		];
		
		$problem_report_history = $ProblemReportHistory->insert($data, true);
		if($problem_report_history == false) {
			$ProblemReport->delete($problem, true);
			$Log->delete($log, true);
			$session->setFlashdata('errors', $ProblemReportHistory->errors());
			return redirect()->back()->withInput();
		}

		$data = [
			'user' => $request->getPost('user')
		];

		if($ProblemUserDispatched->insert($data) == false) {
			$ProblemReportHistory->delete($problem_report_history, true);
			$ProblemReport->delete($problem, true);
			$Log->delete($log, true);
			$session->setFlashdata('errors', $ProblemUserDispatched->errors());
			return redirect()->back()->withInput();
		}
		
		return redirect()->to(current_url(true)->setSegment(5,''));
	}

	public function edit()
	{
		$view = \Config\Services::renderer();
		
		$Bill = new Bill();
		
		$bill = $Bill->find(current_url(true)->getSegment(6));
		$data = [
			'bill'=>$bill,
			'url_action'=>base_url(current_url(true)->setSegment(5,'update')->getPath()),
			'url_back'=>base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath())
		];
		
		return $view->setData($data)->render('Customers/Bill/edit');
	}

	public function update()
	{
		$request = service('request');
		$session = session();

		$Bill = new Bill();
		$active = 0;
		if($request->getPost('active')){
			$active = 1;
		}
		$data = [
			'active' => $active
		];
		if($Bill->update(current_url(true)->getSegment(6), $data) == false){
			$session->setFlashdata('errors', $Bill->errors());
			return redirect()->back()->withInput();
		}
		return redirect()->to(base_url(current_url(true)->setSegment(5,'')->setSegment(5,'')));
	}

	public function follow_up()
	{
		$view = \Config\Services::renderer();

		$User = new User();
		$ProblemReport = new ProblemReport();
		$ProblemReportHistory = new ProblemReportHistory();

		$problem = $ProblemReport->find(current_url(true)->getSegment(6));

		$history = $ProblemReportHistory->where('problem_report', $problem->id)->where('active', 1)->first();

		$users = $User->findAll();
		$current_pic = $User->find($history->user);

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'problem' => $problem,
			'users_available' => $users,
			'current_pic' => $current_pic,
			'rendering_time' => $rendering_time,
			'url_action' => base_url(current_url(true)->setSegment(5, 'create-follow-up')->getPath()),
			'url_back' => base_url(current_url(true)->setSegment(5, 'show')->getPath())
		];

		return $view->setData($data)->render('Report/problem-report-history/follow_up');
	}

	public function create_follow_up()
	{
		$request = service('request');
		$session = session();

		$Log = new Log();
		$ProblemReport = new ProblemReport();
		$ProblemReportHistory = new ProblemReportHistory();
		$ProblemUserDispatched = new ProblemUserDispatched();

		$problem = $ProblemReport->find($request->getPost('problem_report'));
		$old_history = $ProblemReportHistory->where('problem_report', $request->getPost('problem_report'))->where('active', 1)->first();

		$data = [
			'title' => $request->getPost('title'),
			'description' => $request->getPost('description')
		];

		$log = $Log->insert($data, true);

		if($log == false) {
			$session->setFlashdata('errors', $Log->errors());
			return redirect()->back()->withInput();
		}

		$data = [
			'problem_report' => $request->getPost('problem_report'),
			'log' => $log,
			'user' => $request->getPost('user'),
			'active' => 1
		];

		$problem_history = $ProblemReportHistory->insert($data, true);
		
		if($problem_history == false) {
			$Log->delete($log, true);
			$session->setFlashdata('errors', $ProblemReportHistory->errors());
			return redirect()->back()->withInput();
		}
		if($old_history->user != $request->getPost('user')) {
			$data = [
				'user' => $request->getPost('user')
			];
			$user_dispatched = $ProblemUserDispatched->insert($data);
			if($user_dispatched == false) {
				$session->setFlashdata('errors', $ProblemUserDispatched->errors());
				return redirect()->back()->withInput();
			}
			$ProblemUserDispatched->delete($old_history->user, true);
		}

		$data = [
			'active' => 0
		];
		$ProblemReportHistory->update($old_history->id, $data);

		return redirect()->to(current_url(true)->setSegment(5, 'show')->setSegment(6, $problem->id));
	}

	public function detail_log()
	{
		$view = \Config\Services::renderer();

		$Log = new Log();
		$ProblemReportHistory = new ProblemReportHistory();

		$log = $Log->find(current_url(true)->getSegment(6));
		$history = $ProblemReportHistory->where('log', $log->id)->first();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'log' => $log,
			'url_back' => base_url(current_url(true)->setSegment(5, 'show')->setSegment(6, $history->problem_report)->getPath()),
			'url_edit' => base_url(current_url(true)->setSegment(5, 'edit-log')->setSegment(6, $log->id)->getPath()),
			'rendering_time' => $rendering_time
		];

		return $view->setData($data)->render('Report/problem-report-history/detail_log');
	}

	public function edit_log()
	{
		$view = \Config\Services::renderer();

		$Log = new Log();
		$ProblemReportHistory = new ProblemReportHistory();

		$log = $Log->find(current_url(true)->getSegment(6));
		$history = $ProblemReportHistory->where('log', $log->id)->first();

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'log' => $log,
			'history' => $history,
			'rendering_time' => $rendering_time,
			'url_back' => base_url(current_url(true)->setSegment(5, 'detail-log')->setSegment(6, $log->id)->getPath()),
			'url_action' => base_url(current_url(true)->setSegment(5, 'update-log')->getPath())
		];

		return $view->setData($data)->render('Report/problem-report-history/edit_log');
	}

	public function update_log()
	{
		$request = service('request');
		$session = session();
		$view = \Config\Services::renderer();

		$Log = new Log();
		$ProblemReportHistory = new ProblemReportHistory();

		$active = 0;
		$activeChange = 0;
		$report_history = $ProblemReportHistory->where('log', current_url(true)->getSegment(6))->first(); 
		$old_history_active = $report_history->active;

		if($request->getPost('active') === "on") {
			$active = 1;
		}

		$record_history_active = $ProblemReportHistory->where('log', current_url(true)->getSegment(6))->where('active', 1)->findAll();
		if(count($record_history_active) > 1) {
			$data = [
				'active' => $active
			];

			$history = $ProblemReportHistory->update($report_history->id, $data);

			if($history == false){
				$session->setFlashdata('errors', $ProblemReportHistory->errors());
				return redirect()->back()->withInput();
			}
			$activeChange = 1;
		}
		
		$data = [
			'title' => $request->getPost('title'),
			'description' => $request->getPost('description')
		];

		$log = $Log->update(current_url(true)->getSegment(6), $data);

		if($log == false) {
			if($activeChange == 1) {
				if(intval($old_history_active) == 1) {
					$active = 0;
				} else {
					$active = 1;
				}
				$data = [
					'active' => $active
				];
	
				$ProblemReportHistory->update($history, $data);
			}
			$session->setFlashdata('errors', $Log->errors());
			return redirect()->back()->withInput();
		}

		return redirect()->to(current_url(true)->setSegment(5, 'detail-log'));
	}
}
