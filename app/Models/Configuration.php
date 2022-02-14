<?php

namespace App\Models;

use CodeIgniter\Model;

class Configuration extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'configurations';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['name','value'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'name'  =>  'required|alpha_dash|max_length[255]',
        'value' =>  'required|alpha_dash|max_length[255]'
    ];
    protected $validationMessages   = [
        'name'  =>  [
            'required'  =>  'Kolom name harus diisi',
            'alpha_dash'    =>  'Kolom name hanya menggunakan karakter alfabet, angka, garis bawah atau tanda pisah',
            'max_length'    =>  'Maksimal panjang karakter kolom name hanya 255 karakter'
        ],
        'value' =>  [
            'required'  =>  'Kolom value harus diisi',
            'alpha_dash'    =>  'Kolom name hanya menggunakan karakter alfabet, angka, garis bawah atau tanda pisah',
            'max_length'    =>  'Maksimal panjang karakter kolom value hanya 255 karakter'
        ]
    ];
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
}
