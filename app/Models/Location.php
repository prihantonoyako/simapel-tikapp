<?php

namespace App\Models;

use CodeIgniter\Model;

class Location extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'locations';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = [
        'name',
        'street',
        'neighborhood',
        'hamlet',
        'subdistrict',
        'latitude',
        'longitude',
        'location_type'
    ];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|alpha_numeric_space|max_length[255]',
        'street'    =>  'alpha_numeric_punct|max_length[255]',
        'neighborhood'  =>  'integer',
        'hamlet'    =>  'integer',
        'subdistrict'   =>  'required|integer',
        'latitude'  =>  'required|decimal',
        'longitude' =>  'required|decimal',
        'location_type'  =>  'required|integer'
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

    public function get_search_district($Paginator,$request,int $locationType)
    {
        return $this->builder()
        ->select('locations.id,
            locations.name,
            subdistricts.name as subdistrict,
            districts.name as district,
            cities.name as city,
            provinces.name as province')
        ->where('locations.deleted_at',null)
        ->where('locations.type',$locationType)
        ->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_location')))
        ->like('locations.name','%'.$request->getGet('q').'%')
        ->join('subdistricts', 'locations.subdistrict = subdistricts.id')
        ->join('districts', 'subdistricts.district = districts.id')
        ->join('cities', 'districts.city = cities.id')
        ->join('provinces', 'cities.province = provinces.id')
        ->get()->getResult();
    }

    public function get_index_district($Paginator,$request,int $locationType)
    {
        return $this->builder()
        ->select('locations.id,
            locations.name,
            subdistricts.name as subdistrict,
            districts.name as district,
            cities.name as city,
            provinces.name as province')
        ->where('locations.type',$locationType)
        ->where('locations.deleted_at',null)
		->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_location')))
        ->join('subdistricts', 'locations.subdistrict = subdistricts.id')
        ->join('districts', 'subdistricts.district = districts.id')
        ->join('cities', 'districts.city = cities.id')
        ->join('provinces', 'cities.province = provinces.id')
        ->get()->getResult();
    }

    public function get_search_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province'
            )
			->where('districts.deleted_at !=',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->like('district.name','%'.$request->getGet('q').'%')
			->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }

    public function get_recycle_city($Paginator,$request)
    {
        return $this->builder()
			->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province')
			->where('districts.deleted_at !=',null)
			->limit($Paginator->get_limit(),$Paginator->get_offset_record($request->getGet('page_district')))
            ->join('cities','districts.city = cities.id','inner')
			->join('provinces','cities.province = provinces.id','inner')
			->get()->getResult();
    }
}
