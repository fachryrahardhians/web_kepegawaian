<?php

namespace App\Models;

use CodeIgniter\Model;

class TimModel  extends Model
{
    protected $table = 'tim';

    protected $allowedFields = [
        'id',
        'nama_tim',
        'bidang_id',
    ];

    public function getJoinBidang()
    {
        return $this->select('tim.*,bidang.nama_bidang')
            ->join('bidang', 'bidang.id = tim.bidang_id', 'left')
            ->findAll();
    }
}
