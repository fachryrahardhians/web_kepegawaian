<?php

namespace App\Models;

use CodeIgniter\Model;

class PpkModel  extends Model
{
    protected $table = 'ppk';

    protected $allowedFields = [
        'id',
        'nama_ppk',
        'bidang_id',
        'satker_id'
    ];

    public function getJoinBidangTim()
    {
        return $this->select('ppk.*,bidang.nama_bidang,tim.nama_tim')
            ->join('bidang', 'bidang.id = ppk.bidang_id', 'left')
            ->join('tim', 'tim.id = ppk.satker_id', 'left')
            ->findAll();
    }
}
