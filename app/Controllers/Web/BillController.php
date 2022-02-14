<?php

namespace App\Controllers\Web;

use App\Controllers\DashboardController;
use App\Models\Bill;
use App\Models\Customer;
use TCPDF;
use App\Libraries\Invoice;
use App\Models\InternetPlan;
use App\Models\InternetSubscription;

class BillController extends DashboardController
{
	public function index()
	{
		helper('pagination_record_number');
		$request = service('request');
		$view = \Config\Services::renderer();

		$Customer = new Customer();
		$InternetSubscription = new InternetSubscription();
		$InternetPlan = new InternetPlan();
		$Bill = new Bill();

		$customers = $Customer->where('active',1)->paginate(10,'customer');
		foreach($customers as $customer) {
			$customer->active_bill = 0;
			$subscriptions = $InternetSubscription
				->where('customer', $customer->id)
				->where('active', 1)->findAll();
			foreach($subscriptions as $subscription) {
				$plan = $InternetPlan->find($subscription->internet_plan);
				$bills = $Bill
					->where('internet_subscription', $subscription->id)
					->findAll();
				if(empty($bills)) {
					
				}
				foreach($bills as $bill) {
					if(intval($bill->active) == 1) {
						$customer->active_bill = 1;
					}
				}
			}
		}

		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'customers' => $customers,
			'pager' => $Customer->pager,
			'recordNumber' => pagination_record_number(
				$request->getGet('page_customer'),
				10
			),
			'printInvoice' => base_url(
				current_url(true)->setSegment(5, 'print-invoice')->getPath()
			),
			'rendering_time' => $rendering_time,
			'newRecord' => base_url(
				current_url(true)->setSegment(5, 'new')->getPath()
			),
			'editRecord' => base_url(
				current_url(true)->setSegment(5, 'detail-bill')->getPath()
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

		return $view->setData($data)->render('Customers/Bill/index');
	}

	public function edit()
	{
		$view = \Config\Services::renderer();
		
		$Bill = new Bill();

		$bill = $Bill->find(current_url(true)->getSegment(6));
		
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'bill'=>$bill,
			'rendering_time' => $rendering_time,
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

	public function detail_bill() {
		$view = \Config\Services::renderer();
		
		$Bill = new Bill();
		$Customer = new Customer();
		$InternetPlan = new InternetPlan();
		$InternetSubscription = new InternetSubscription();

		$customer = $Customer->find(current_url(true)->getSegment(6));
		$subscriptions = $InternetSubscription
			->where('customer', $customer->id)
			->where('active',1)
			->findAll();
		$active_bills = array();
		foreach($subscriptions as $subscription) {
			$bills = $Bill
				->where('internet_subscription', $subscription->id)
				->where('active', 1)
				->findAll();
			foreach($bills as $bill) {
				$plan = $InternetPlan->find($subscription->internet_plan);
				$bill->plan = $plan->name;
				array_push($active_bills,$bill);
			}
		}
		
		timer('app benchmark');
		$rendering_time = timer()->getElapsedTime('app benchmark');

		$data = [
			'bills' => $active_bills,
			'rendering_time' => $rendering_time,
			'editRecord' => base_url(
				current_url(true)->setSegment(5,'edit')->setSegment(6,'')->getPath()
			),
			'deleteRecord' => base_url(),
			'url_back' => base_url(
				current_url(true)->setSegment(5,'')->setSegment(5,'')->getPath()
			)
		];
		
		return $view->setData($data)->render('Customers/Bill/customer');
	}

	public function print_invoice()
	{
		$response = service('response');
		
		$Bill = new Bill();
		$InternetSubscription = new InternetSubscription();
		$InternetPlan = new InternetPlan();
		$Customer = new Customer();

		$customer = $Customer->find(current_url(true)->getSegment(6));
		$subscriptions = $InternetSubscription->where('customer', $customer->id)->findAll();

		$PDF = new Invoice(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		
		$PDF->SetCreator('SIMAPEL-TIKAPP');
		$PDF->SetAuthor($this->company_information['COMPANY_NAME']);
		$PDF->SetTitle('Invoice Pelanggan');
		$PDF->SetSubject('Customer');
		$PDF->SetKeywords('invoice,bill,internet');

		
		// set header and footer fonts
		// $PDF->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		// $PDF->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

		// set default monospaced font
		$PDF->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$PDF->setMargins(40,30,30);
		$PDF->SetHeaderMargin(10);
		$PDF->SetFooterMargin(10);

		// set auto page breaks
		$PDF->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		// $PDF->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$PDF->setFontSubsetting(true);

		// Set font
		// dejavusans is a UTF-8 Unicode font, if you only need to
		// print standard ASCII chars, you can use core fonts like
		// helvetica or times to reduce file size.
		$PDF->SetFont('dejavusans', '', 14, '', true);

		// Add a page
		// This method has several options, check the source code documentation for more information.
		$PDF->AddPage();


		$pageMargins = $PDF->getMargins();
		// dd($pageMargins);
		$PDF->setXY(40,$pageMargins['top']+20);

		// Set some content to print
		$html = <<<EOD
		<table cellpadding="6">
			<tr>
				<td>CUSTOMER ID</td>
				<td>: $customer->id</td>
			</tr>
			<tr>
				<td>Name</td>
				<td>: $customer->first_name $customer->last_name</td>
			</tr>
			<tr>
				<td>Email</td>
				<td>: $customer->email</td>
			</tr>
		</table>
		<br>
		<br>
		<table border="1" cellpadding="6">
			<tr>
				<td width="10%">No</td>
				<td width="50%">Subscription/Location</td>
				<td>Price</td>
			</tr>
		EOD;

		$i = 1;
		$totalPrice = 0;
		foreach($subscriptions as $subscription) {
			$bills = $Bill->where('internet_subscription', $subscription->id)->where('active', 1)->findAll();
			$plan = $InternetPlan->find($subscription->internet_plan);
			foreach($bills as $bill) {
				$plan_price = number_format($plan->price);
				$html .= <<<EOD
					<tr>
						<td width="10%">$i</td>
						<td width="50%">$plan->name</td>
						<td>Rp. $plan_price</td>
					</tr>
				EOD;
				$i++;
				$totalPrice += (double) $plan->price;
			}
			
		}
		$totalPrice = number_format($totalPrice);
		$html .= <<<EOD
			<tr>
				<td colspan="2">TOTAL</td>
				<td>Rp. $totalPrice</td>
			</tr>
		</table>
		EOD;
		// Print text using writeHTMLCell()
		$PDF->writeHTML($html, true, false, false, false, '');

		// ---------------------------------------------------------
		$response->setContentType('application/pdf');
		// Close and output PDF document
		// This method has several options, check the source code documentation for more information.
		$PDF->Output('invoice.pdf', 'I');
	}
}
