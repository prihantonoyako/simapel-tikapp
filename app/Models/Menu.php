<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\GroupMenu;

class Menu extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'menu';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['group', 'name', 'url', 'icon', 'ordinal', 'active', 'deleted_at'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'group' =>  'required|integer',
        'name'  =>  'required|alpha_space|max_length[255]',
        'url'   =>  'required|alpha_dash|max_length[255]',
        'icon'  =>  'required|alpha_numeric_punct|max_length[255]',
        'ordinal'   =>  'required|integer'
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
            ->select('menu.active,
                menu.deleted_at,
                menu.ordinal as menu_ordinal,
                menu.id as menu_id,
                menu.name as menu_name,
                menu.url as menu_url,
                menu.icon as menu_icon,
                group_menu.name as group_menu_name')
            ->where('menu.deleted_at', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_menu')))
            ->like('menu.name',$request->getGet('q'),'both')
            ->join('group_menu', 'group_menu.id = menu.group')
            ->get()->getResult();
    }

    public function get_index_data($Paginator, $request)
    {
        return $this->builder()
            ->select('menu.active,
                menu.deleted_at,
                menu.ordinal as menu_ordinal,
                menu.id as menu_id,
                menu.name as menu_name,
                menu.url as menu_url,
                menu.icon as menu_icon,
                group_menu.name as group_menu_name')
            ->where('menu.deleted_at', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_menu')))
            ->join('group_menu', 'group_menu.id = menu.group')
            ->get()->getResult();
    }

    public function get_search_recycle_data($Paginator, $request)
    {
        return $this->builder()
            ->select(
                'districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province'
            )
            ->where('districts.deleted_at !=', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_district')))
            ->like('district.name', '%' . $request->getGet('q') . '%')
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }

    public function get_recycle_data($Paginator, $request)
    {
        return $this->builder()
            ->select('districts.id,
				districts.name,
				cities.name as city,
				provinces.name as province')
            ->where('districts.deleted_at !=', null)
            ->limit($Paginator->get_limit(), $Paginator->get_offset_record($request->getGet('page_district')))
            ->join('cities', 'districts.city = cities.id', 'inner')
            ->join('provinces', 'cities.province = provinces.id', 'inner')
            ->get()->getResult();
    }
}
