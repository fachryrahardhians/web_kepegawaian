<?php

namespace App\Models\auth;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'nama',
        'nip',
        'no_wa',
        'email',
        'account_id',
        'id',
    ];

    protected $createField = 'created_at';

    public function getWithJabatan($nip)
    {
        return $this->select('pegawai.*, jabatan.level, jabatan.nama_jabatan')
            ->join('jabatan', 'jabatan.id = pegawai.jabatan_id')
            ->join('jabatan jabatan_rangkap', 'jabatan.id = pegawai.jabatan_rangkap_id')
            ->where('pegawai.nip', $nip)
        ;
    }
}
