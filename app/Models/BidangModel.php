<?php

namespace App\Models;

use CodeIgniter\Model;


class BidangModel extends Model
{
    protected $table = 'bidang';

    protected $allowedFields = [
        'id',
        'nama_bidang'
    ];
}
