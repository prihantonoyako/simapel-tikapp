<?php

namespace App\Models;

use CodeIgniter\Model;

class Access extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'accesses';
    protected $primaryKey           = 'id';
    protected $useAutoIncrement     = true;
    protected $insertID             = 0;
    protected $returnType           = 'object';
    protected $useSoftDeletes       = true;
    protected $protectFields        = true;
    protected $allowedFields        = ['role','menu'];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'role'  =>  'required|integer|numeric',
        'menu'  =>  'required|integer|numeric'
    ];
    protected $validationMessages   = [
        'role'  =>  [
            'required'  =>  'Kolom role harus diisi.',
            'integer'   =>  'Nilai role harus bilangan bulat',
            'numeric'   =>  'Kolom role hanya menggunakan karakter angka'
        ],
        'menu'  =>  [
            'required'  =>  'Kolom menu harus diisi.',
            'integer'   =>  'Nilai menu harus bilangan bulat',
            'numeric'   =>  'Kolom menu hanya menggunakan karakter angka'
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
