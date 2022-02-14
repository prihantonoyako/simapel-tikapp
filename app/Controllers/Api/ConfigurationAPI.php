<?php

namespace App\Controllers\Api;

use App\Controllers\ApiBaseController;
use App\Models\Vendor;
use CodeIgniter\API\ResponseTrait;

class ConfigurationAPI extends ApiBaseController
{
    use ResponseTrait;
	
	public function get_mode_configuration() {
		$request = service('request');

		$Vendor = new Vendor;
		$data = [];

		$flagDataFound = false;
		$wirelessModes = fopen(base_url('configurations/wireless-modes.csv'),'r');
		$vendor = strtolower($Vendor->find($request->getGet('vendor'))->name);
		
		while(($row = fgetcsv($wirelessModes)) !== false) {
			if($row[0] == $vendor) {
				$flagDataFound = true;
			}
			if($flagDataFound) {
				break;
			}
		}
		if($flagDataFound == false) {
			$vendor = "general";
		}

		fclose($wirelessModes);
		$wirelessModes = fopen(base_url('configurations/wireless-modes.csv'),'r');

		$flagDataFound = false;
		while (($row = fgetcsv($wirelessModes)) !== false) {
			if($row[0] == $vendor) {
				$modes = array_splice($row,1);
				$data = $modes;
				$flagDataFound = true;
			}
			if($flagDataFound) {
				break;
			}
		}

		fclose($wirelessModes);
		
		return $this->setResponseFormat('json')->respond($data);
	}

	public function get_all_band_configuration()
	{
		$data = [];
		
		$wirelessBand = fopen(base_url('configurations/wireless-band.csv'),'r');
		
		while(($row = fgetcsv($wirelessBand))!== false){
			foreach($row as $item){
				array_push($data,$item);
			}
		}
		fclose($wirelessBand);
		
		return $this->setResponseFormat('json')->respond($data);
	}
	
	public function get_all_wireless_protocol_configuration()
	{
		$wirelessProtocol = fopen(base_url('configurations/wireless-protocol.csv'),'r');
		
		while(($row = fgetcsv($wirelessProtocol)) !== false) {
			$data= $row;
		}
		fclose($wirelessProtocol);
		
		return $this->setResponseFormat('json')->respond($data);
	}
	
	public function get_wireless_channel_width_configuration()
	{
		$wirelessChannelWidth = fopen(base_url('configurations/wireless-channel-width.csv'),'r');
		$separator = strpos($this->request->getGet('band'),'-');
		$band = substr($this->request->getGet('band'),0,$separator);
		$flagDataFound = false;
		
		while(($row = fgetcsv($wirelessChannelWidth)) !== false) {
			if($band == $row[0]) {
				$bands = array_splice($row,1);
				$data = $bands;
			}
			if($flagDataFound){
				break;
			}
		}
		return $this->setResponseFormat('json')->respond($data);
	}
	
	public function get_frequency_configuration()
	{
		// 2ghz-b/g/n 20/40mhz-Ce
		$trueBand = $this->find_true_modulation($this->request->getGet('band'));
		$trueChannelWidth = $this->find_true_channel_width($this->request->getGet('channel_width'));
		if(count($trueChannelWidth)>1){
			$trueFrequency = $this->get_true_frequency_configuration(
				$trueBand['band'],
				$trueChannelWidth['channel_width'],
				$trueChannelWidth['control_channel']['bondingSize'],
				$trueChannelWidth['control_channel']['primary']
			);
		} else {
			$trueFrequency = $this->find_standard_channel($trueBand['band'],$trueChannelWidth['channel_width']);
		}
		return $this->setResponseFormat('json')->respond($trueFrequency);
	}

	function find_standard_channel($band,$channel_width){
		$data = [];
		if(strcmp($band,'2ghz')==0){
			$lowestCenterFrequency = 2412;
			$highestCenterFrequency = 2472;
			for($i = $lowestCenterFrequency; $i < $highestCenterFrequency; $i+=5)
			{
				if($i < $highestCenterFrequency){
				array_push($data,$i);
				}
			}
		} elseif(strcmp($band,'5ghz')==0) {
			$lowestCenterFrequency = 5160;
			$highestCenterFrequency = 5865;
			for($i = $lowestCenterFrequency; $i < $highestCenterFrequency; $i+=10)
			{
				if($i < $highestCenterFrequency){
				array_push($data,$i);
				}
			}
		}
		return $data;
	}
	
	function get_true_frequency_configuration($band,$channel_width,$bondingSize,$primaryChannel)
	{
		$data = [];

		// 2402 2422
		$lowestCenterFrequency = 2412;
		$lowestRealFrequency = 2402;
		$highestCenterFrequency = 2472;
		$standardChannel = 20;
		
		$realFrequency = $lowestRealFrequency;
		if($primaryChannel == 0){
			for($i=$lowestCenterFrequency;$i<$highestCenterFrequency;$i+=5){
				if($i+30 <= $highestCenterFrequency) {
					array_push($data,$i);
				}
			}
		} else {
			for($i=0; $i < $primaryChannel;$i++)
			{
				$realFrequency += $standardChannel;
			}
			for($i=$primaryChannel;$i<$bondingSize;$i++){
				$realFrequency += $standardChannel;
			}
		
			$realCenterFrequency = $realFrequency-10;

			for($i=$realCenterFrequency; $i < $highestCenterFrequency; $i+=5){
				if($i+10 <= $highestCenterFrequency){
					array_push($data,$i);
				}
			}
		}

		return $data;
	}
	
	public function find_true_modulation($band)
	{
		// 2ghz-b/g/n
		$data = [];
		$temp = explode('-',$band,2);
		$data['band'] = $temp[0];
		
		if(is_null(strpos($temp[1],'only'))) {
			$supportedModulation = explode('/',$temp[1]);
			$data['standard'] = $supportedModulation[count($supportedModulation)-1];
		} else {
			$data['standard'] = substr($temp[1],4);
		}
		/*
			[band] => 2ghz
			[standard] => n
		*/
		return $data;
	}
	
	public function find_true_channel_width($channel_width)
	{
		$data =[];
		$temp = explode ('-', $channel_width, 2);

		if (count($temp) === 1) {
			$data['channel_width'] = substr($temp[0], 0, strpos ($temp[0], 'm'));
		} else {
			$supportedWidth = explode('/',$temp[0]);
			$lastElement = count($supportedWidth)-1;
			$data['channel_width'] = substr($supportedWidth[$lastElement],0,strpos($supportedWidth[$lastElement],'m'));
			$channelBonding = strlen($temp[1]);
			$primaryChannel = strpos($temp[1],'C');
			$data['control_channel'] = array(
				'bondingSize'=>$channelBonding,
				'primary'=>$primaryChannel
			);
		}
		return $data;
	}
}