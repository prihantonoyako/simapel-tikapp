<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\Device;
use App\Models\Location;

class BaseTransceiverStation extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'base_transceiver_stations';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name',
        'root',
        'mode',
        'band',
        'channel_width',
        'frequency',
        'radio_name',
        'ssid',
        'wireless_protocol',
        'device',
        'active',
        'deleted_at'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|max_length[255]',
        'mode'  =>  'required|max_length[40]',
        'band'  =>  'required|max_length[15]',
        'channel_width' =>  'required|max_length[15]'
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function get_search_data($Paginator, $request)
    {
        return $this->builder()
            ->select(
            'base_transceiver_stations.id,
            base_transceiver_stations.name,
            radio_name,
            locations.name as location,
            ip_address,
            base_transceiver_stations.active')
            ->where('base_transceiver_stations.deleted_at', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_base_transceiver_station')))
            ->like('base_transceiver_stations.name','%'.$request->getGet('q').'%')
            ->join('devices', 'base_transceiver_stations.device = devices.id')
            ->join('locations', 'devices.location = locations.id')
            ->get()->getResult();
			
    }

    public function get_index_data($Paginator, $request)
    {
        return $this->builder()
            ->select(
            'base_transceiver_stations.id,
            base_transceiver_stations.name,
            radio_name,
            locations.name as location,
            ip_address,
			devices.active'
            )
            ->where('base_transceiver_stations.deleted_at', null)
            ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_base_transceiver_station')))
			->join('devices', 'base_transceiver_stations.device = devices.id')
            ->join('locations', 'devices.location = locations.id')
            ->get()->getResult();
    }

    public function get_search_recycle_data($Paginator, $request)
    {
		return $this->builder()
		->select(
		'base_transceiver_stations.id,
		base_transceiver_stations.name,
		radio_name,
		locations.name as location,
		ip_address,
		base_transceiver_stations.active'
		)
		->where('base_transceiver_stations.deleted_at !=', null)
		->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_base_transceiver_station')))
		->like('base_transceiver_stations.name','%'.$request->getGet('q').'%')
		->join('devices', 'base_transceiver_stations.device = devices.id')
		->join('locations', 'devices.location = locations.id')
		->get()->getResult();
    }

    public function get_recycle_data($Paginator, $request)
    {
		return $this->builder()
		->select(
			'base_transceiver_stations.id,
		base_transceiver_stations.name,
		radio_name,
		locations.name as location,
		ip_address,
		base_transceiver_stations.active'
		)
		->where('base_transceiver_stations.deleted_at !=', null)
		->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_base_transceiver_station')))
		->join('devices', 'base_transceiver_stations.device = devices.id')
		->join('locations', 'devices.location = locations.id')
		->get()->getResult();
    }

    public function get_all_bts_by_location_id($location,$band){
        return $this->builder()
            ->select('base_transceiver_stations.id,
            base_transceiver_stations.name,
            base_transceiver_stations.band,
            base_transceiver_stations.channel_width,
            base_transceiver_stations.frequency')
            ->where('base_transceiver_stations.deleted_at',null)
            ->where('devices.location',$location)
            ->where('devices.active',1)
			->where('base_transceiver_stations.active',1)
            ->like('base_transceiver_stations.band',$band,'after')
            ->join('devices','base_transceiver_stations.device = devices.id')
            ->get()->getResult();
    }
	
	public function id_nearest_bts_by_city($city) {
		return $this->builder()
			->select('base_transceiver_stations.id')
			->join('devices','base_transceiver_stations.device=devices.id','inner')
			->join('locations','devices.location = locations.id','inner')
			->join('subdistricts','locations.subdistrict=subdistricts.id','inner')
			->join('districts','subdistricts.district=districts.id','inner')
			->join('cities','districts.city=cities.id','inner')
			->where('base_transceiver_stations.deleted_at',null)
			->where('base_transceiver_stations.active',1)
			->get()->getResult();
	}
	
	public function get_all_independent_bts_for_monitor()
	{
		return $this->builder()
			->select(
				'base_transceiver_stations.id,
				base_transceiver_stations.name,
				locations.latitude,
				locations.longitude'
			)
			->join('devices','base_transceiver_stations.device=devices.id','inner')
			->join('locations','devices.location=locations.id','inner')
			->where('base_transceiver_stations.deleted_at',null)
			->where('base_transceiver_stations.root',null)
			->where('devices.active','1')
			->get()->getResult();
	}
	
	public function get_all_dependent_bts_for_monitor()
	{
		return $this->builder()
			->select(
				'base_transceiver_stations.id,
				base_transceiver_stations.name,
				base_transceiver_stations.root,
				devices.active,
				locations.latitude,
				locations.longitude'
			)
			->join('devices','base_transceiver_stations.device=devices.id','inner')
			->join('locations','devices.location=locations.id','inner')
			->where('base_transceiver_stations.deleted_at',null)
			->where('base_transceiver_stations.root !=',null)
			->where('devices.active','1')
			->get()->getResult();
	}
	
	public function get_single_bts_by_id($id)
	{
		$Device = new Device;
		$Location = new Location;
		
		$bts = $this->find($id);
		$device = $Device->find($bts->device);
		$location = $Location->find($device->location);
		
		$data = [
			"latitude"=>$location->latitude,
			"longitude"=>$location->longitude,
			'active'=>$device->active
		];
		return $data;
	}
}
