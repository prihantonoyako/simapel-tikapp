<?php

namespace App\Controllers\Cron;
use App\Controllers\OriginBaseController;
use App\Models\BaseTransceiverStation;
use App\Models\Device;
use App\Models\Password;
use App\Models\Configuration;
use App\Models\Item;
use App\Models\InternetSubscription;
use PEAR2\Net\RouterOS;

class BTSCron extends OriginBaseController
{
	public function synchronize_bts()
	{
		$Item = new Item();
		$Device = new Device();
		$Password = new Password();
		$InternetSubscription = new InternetSubscription();
		$Configuration = new Configuration();
		$BaseTransceiverStation = new BaseTransceiverStation();
		
		$dbData = array();
		$dbPasswordID = array();
		$dbPassword = array();
		$customer_cpe = array();
		$vendorMikrotikID = $Configuration->where('key','MIKROTIK_VENDOR_ID')->first()->value;
		$internet_subscriptions = $InternetSubscription->findAll();
		foreach($internet_subscriptions as $internet_subscription) {
			array_push($customer_cpe,$internet_subscription->cpe);
		}
		$oddOccurence = array();
		
		$allBts = $BaseTransceiverStation->where('active',1)->whereNotIn('id',$customer_cpe)->findAll();

		foreach($allBts as $bts) {
			$tempData = array();
			$tempData['device'] = $Device->find($bts->device);
			$item = $Item->find($tempData['device']->item);
			if(!($item->vendor == $vendorMikrotikID)){
				continue;
			}
			$tempData['bts'] = $bts;
			// in_array(mixed $needle, array $haystack, bool $strict = false): bool
			if(!in_array($tempData['device']->password,$dbPasswordID)) {
				array_push($dbPasswordID,$tempData['device']->password);
			}
			array_push($dbData,$tempData);
		}
		
		foreach($Password->whereIn('id',$dbPasswordID)->findAll() as $password) {
			$dbPassword[$password->id] = $password;
		}

		foreach($dbData as $bts) {
			$data = array();
			$password = $bts['device']->password;
			try {
				$client = new RouterOS\Client($bts['device']->ip_address, $dbPassword[$password]->username, $dbPassword[$password]->password);
			} catch (\Exception $e) {
                exit(1);
            }
            $request = new RouterOS\Request('/interface/wireless/print');
            $query = RouterOS\Query::where('disabled', 'no');
            $request->setQuery($query);
            $responses = $client->sendSync($request);
            foreach ($responses as $response) {
                if ($response->getType() === RouterOS\Response::TYPE_DATA) {
                    $data = [
                        'mode' => $response->getProperty('mode'),
                        'band' => $response->getProperty('band'),
                        'frequency' => $response->getProperty('frequency'),
                        'channel_width' => $response->getProperty('channel-width'),
                        'radio_name' => $response->getProperty('radio-name'),
                        'wireless_protocol' => $response->getProperty('wireless-protocol'),
                        'ssid' => $response->getProperty('ssid'),
						'device'=> $bts['bts']->device,
						'name'=>'CRON '.$bts['bts']->name,
						'root'=>$bts['bts']->root,
						'active'=>(int) 1
                    ];
                }
            }
			$btsProperty = $bts['bts'];
			$mode = $this->check_integrity($btsProperty->mode,$data['mode']);
			$band = $this->check_integrity($btsProperty->band,$data['band']);
			if(is_null($btsProperty->root)){
				$frequency = $this->check_integrity($btsProperty->frequency,$data['frequency']);
			} else {
				$frequency = true;
			}
			$channel_width = $this->check_integrity($btsProperty->channel_width,$data['channel_width']);
			$radio_name = $this->check_integrity($btsProperty->radio_name,$data['radio_name']);
			$wireless_protocol = $this->check_integrity($btsProperty->wireless_protocol,$data['wireless_protocol']);
			$ssid = $this->check_integrity($btsProperty->ssid,$data['ssid']);
			$integrityCheck = $mode && $band && $frequency && $channel_width && $radio_name && $wireless_protocol && $ssid;
			if(!$integrityCheck){
				if($BaseTransceiverStation->insert($data)==false){
					exit(1);
				} else {
					array_push($oddOccurence,$btsProperty->id);
				}
			}
		}
		$request = \Config\Services::request();
		if(empty($oddOccurence)){
			if($request->isCLI()) {
				exit(0);
			} else {
				return redirect()->back();
			}
		} else {
			$data= [
				'active'=>(int) 0
			];
			if($BaseTransceiverStation->update($oddOccurence, $data)==false){
				exit(1);
			}
			// $dependentBTS = $BaseTransceiverStation->where('root !=',null)->findAll();
			// foreach($dependentBTS as $bts) {
			// 	$newRoot = $BaseTransceiverStation->where('ip_address',$bts->ip_address)->where('active',1)->first();
			// 	$data = [
			// 		'root'=>$newRoot
			// 	];
			// 	$BaseTransceiverStation->update($bts->id,$data);
			// }
		}
		if($request->isCLI()) {
			exit(0);
		} else {
			return redirect()->back();
		}
	}
	
	protected function check_integrity($first,$second)
	{
		if($first == $second) {
			return true;
		} else {
			return false;
		}
	}
}