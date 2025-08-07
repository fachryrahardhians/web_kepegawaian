<?php

namespace App\Models;

use CodeIgniter\Model;

class PegawaiModel extends Model
{
    protected $table = 'pegawai';
    // protected $useTimestamps = true;

    protected $allowedFields = [
        'id',
        'nama',
        'nip',
        'golongan',
        'no_wa',
        'email',
        'account_id',
        'jabatan_id',
        'bidang_id',
        'gender',
        'tim_id',
        'ppk_id',
        'jabatan_rangkap_id',
        'bidang_rangkap_id',
        'tim_rangkap_id',
        'ppk_rangkap_id',
        'created_at',
    ];

    public function getWithBidang()
    {
        return $this->select('pegawai.*, bidang.nama_bidang,jabatan.nama_jabatan,user.status')
            ->join('bidang', 'bidang.id = pegawai.bidang_id', 'left')
            ->join('jabatan', 'jabatan.id = pegawai.jabatan_id', 'left')
            ->join('user', 'user.id = pegawai.id', 'left')
            ->findAll();
    }

    public function getWithJabatan($nip)
    {
        return $this->select('
            pegawai.*,
            j1.level AS level_jabatan_utama,
            j1.nama_jabatan AS nama_jabatan_utama,
            j2.level AS level_jabatan_rangkap,
            j2.nama_jabatan AS nama_jabatan_rangkap
        ')
            ->join('jabatan j1', 'j1.id = pegawai.jabatan_id', 'left')
            ->join('jabatan j2', 'j2.id = pegawai.jabatan_rangkap_id', 'left')
            ->where('pegawai.nip', $nip)
            ->first()
        ;
    }

    public function getDetail($id)
    {
        return $this->select('
            pegawai.*,
            j1.level AS level_jabatan_utama,
            j1.nama_jabatan AS nama_jabatan_utama,
            j2.level AS level_jabatan_rangkap,
            j2.nama_jabatan AS nama_jabatan_rangkap,
            b1.nama_bidang as nama_bidang_utama,
            b2.nama_bidang as nama_bidang_rangkap,
            t1.nama_tim as nama_tim_utama,        
            t2.nama_tim as nama_tim_rangkap,
            ppk1.nama_ppk as nama_ppk_utama,
            ppk2.nama_ppk as nama_ppk_rangkap,
        ')
            ->join('jabatan j1', 'j1.id = pegawai.jabatan_id', 'left')
            ->join('jabatan j2', 'j2.id = pegawai.jabatan_rangkap_id', 'left')
            ->join('bidang b1', 'b1.id = pegawai.bidang_id', 'left')
            ->join('bidang b2', 'b2.id = pegawai.bidang_rangkap_id', 'left')
            ->join('tim t1', 't1.id = pegawai.tim_id', 'left')
            ->join('tim t2', 't2.id = pegawai.tim_rangkap_id', 'left')
            ->join('ppk ppk1', 'ppk1.id = pegawai.ppk_id', 'left')
            ->join('ppk ppk2', 'ppk2.id = pegawai.ppk_rangkap_id', 'left')
            ->where('pegawai.id', $id)
            ->first()
        ;
    }
}
