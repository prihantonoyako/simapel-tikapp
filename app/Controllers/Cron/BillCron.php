<?php

namespace App\Controllers\Cron;
use App\Controllers\OriginBaseController;
use App\Models\Bill;
use App\Models\InternetSubscription;

class BillCron extends OriginBaseController {

	public function create_bill()
	{
		$InternetSubscription = new InternetSubscription();
		$Bill = new Bill();

		$currentDate = \DateTime::createFromFormat('Y-m-d H:i:s',date('Y-m-d H:i:s'));
		$paidTime = $currentDate->add(new \DateInterval('P10D'));

		$subscriptions = $InternetSubscription->where('active',1)->findAll();

		foreach($subscriptions as $subscription) {
			if(!$Bill->where('internet_subscription',$subscription->id)->where('month',$currentDate->format('m'))->first()) {
				$data = [
					'month'=>$currentDate->format('m'),
					'year'=>$currentDate->format('Y'),
					'active'=>1,
					'internet_subscription'=>$subscription->id,
					'paid_time'=>$paidTime->format('Y-m-d H:i:s'),
				];
				$Bill->insert($data);
			}
		}
	}
}