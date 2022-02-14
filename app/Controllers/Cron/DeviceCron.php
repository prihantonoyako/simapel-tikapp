<?php

namespace App\Controllers\Cron;
use App\Controllers\OriginBaseController;
use App\Models\Device;

class DeviceCron extends OriginBaseController {

	public function connectivity_test()
	{
		$Device = new Device();
		
		$running = array();
		$stopped = array();
		
		$allDevice = $Device->findAll();

		foreach($allDevice as $device)
		{
			if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
				exec("ping -n 3 " . $device->ip_address, $output, $status);
				//0 : success
				//1 : no response
				//2 : other errors
				if($status===(int) 0){
					array_push($running,$device->id);
				} else {
					array_push($stopped,$device->id);
				}
			} else {
				exec(
					"ping -c 2 " . $device->ip_address,
					$output,
					$status
				);
				if($status===(int) 0){
					array_push($running,$device->id);
				} else {
					array_push($stopped,$device->id);
				}
			}
		}
		$flagRunning = [
			'active'=>(int) 1
		];
		$flagStopped = [
			'active'=>(int) 0
		];
		foreach($running as $device){
			$Device->update($device,$flagRunning);
		}
		foreach($stopped as $device){
			$Device->update($device,$flagStopped);
		}
	}
}