<?php

namespace App\Models;

use CodeIgniter\Model;

class LogKerjaModel extends Model
{
    protected $table = 'log_harian';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'tanggal',
        'start',
        'end',
        'uraian',
        'output',
        'lokasi',
        'id_renakersan',
        'id_pegawai',
        'created_at',
    ];

    protected $createField = 'created_at';

    // public function getLogByJabatan($user)
    // {
    //     $builder = $this->db->table('log_harian');
    //     $builder->select('log_harian.*, pegawai.nama as nama_pegawai, jabatan.level as level_jabatan');
    //     $builder->join('pegawai', 'pegawai.id = log_harian.id_pegawai');
    //     $builder->join('jabatan', 'jabatan.id = pegawai.jabatan_id');

    //     // Ambil level dari jabatan utama dan rangkap user
    //     $levelUtama  = $user['level'];
    //     $levelRangkap = $user['level_rangkap'] ?? null;

    //     // Mulai bangun query berdasarkan level
    //     if ($levelUtama == 1 || $levelRangkap == 1) {
    //         // Pimpinan -> akses semua
    //         return $builder->get()->getResult();
    //     }

    //     $builder->groupStart(); // untuk gabungan kondisi utama dan rangkap

    //     // ===================== UTAMA ===================== //
    //     if ($levelUtama == 2) {
    //         // Kepala bidang: akses pegawai di bidang yang sama, level 3-5
    //         $builder->groupStart()
    //             ->where('pegawai.bidang_id', $user['bidang_id'])
    //             ->whereIn('jabatan.level', [3, 4, 5])
    //             ->groupEnd();
    //     }

    //     if ($levelUtama == 3) {
    //         // Ketua tim: akses pegawai di tim yang sama, level 4-5
    //         $builder->groupStart()
    //             ->where('pegawai.tim_id', $user['tim_id'])
    //             ->whereIn('jabatan.level', [4, 5])
    //             ->groupEnd();
    //     }

    //     if ($levelUtama == 4) {
    //         // PPK: akses pegawai di ppk yang sama, level 5
    //         $builder->groupStart()
    //             ->where('pegawai.ppk_id', $user['ppk_id'])
    //             ->whereIn('jabatan.level', [5])
    //             ->groupEnd();
    //     }

    //     // ===================== RANGKAP ===================== //
    //     if ($levelRangkap == 2) {
    //         $builder->orGroupStart()
    //             ->where('pegawai.bidang_rangkap_id', $user['bidang_rangkap_id'])
    //             ->whereIn('jabatan.level', [3, 4, 5])
    //             ->groupEnd();
    //     }

    //     if ($levelRangkap == 3) {
    //         $builder->orGroupStart()
    //             ->where('pegawai.tim_rangkap_id', $user['tim_rangkap_id'])
    //             ->whereIn('jabatan.level', [4, 5])
    //             ->groupEnd();
    //     }

    //     if ($levelRangkap == 4) {
    //         $builder->orGroupStart()
    //             ->where('pegawai.ppk_rangkap_id', $user['ppk_rangkap_id'])
    //             ->whereIn('jabatan.level', [5])
    //             ->groupEnd();
    //     }

    //     $builder->groupEnd(); // akhir group utama + rangkap

    //     $builder->groupBy('log_harian.id');

    //     return $builder->get()->getResult();
    // }

    public function getByAccess2($user)
    {
        // init builder 
        $builder = $this->db->table('log_harian');

        // main query
        $builder->select('
            log_harian.*,
            pegawai.nama
        ');

        $builder->join('pegawai', 'pegawai.id = log_harian.id_pegawai');
        $builder->join('jabatan jabatan', 'pegawai.jabatan_id = jabatan.id', 'left');
        $builder->join('jabatan jabatan2', 'pegawai.jabatan_rangkap_id = jabatan2.id', 'left');


        // jika level 1 atau kabalai
        if ($user['level_jabatan_utama'] == 1 || $user['level_jabatan_rangkap'] == 1) {
            return $builder->get()->getResult();
        }

        // jika jabatan utama / rangkap level 2 atau kabag,kabid
        if ($user['level_jabatan_utama'] == 2 || $user['level_jabatan_rangkap'] == 2) {
            $builder->groupStart()
                ->where('pegawai.bidang_id', $user['bidang_id'])
                ->orWhere('pegawai.bidang_rangkap_id', $user['bidang_id'])
                ->orWhere('pegawai.bidang_id', $user['bidang_rangkap_id'])
                ->orWhere('pegawai.bidang_rangkap_id', $user['bidang_rangkap_id'])
                ->groupEnd()
            ;

            $builder->groupStart()
                ->whereIn('jabatan.level', [3, 4, 5])
                ->orWhereIn('jabatan2.level', [3, 4, 5])
                ->groupEnd();
        }

        //jika jabatan utama  / rangkap level 3 atau katim/kasatker
        if ($user['level_jabatan_utama'] == 3 || $user['level_jabatan_rangkap'] == 3) {
            $builder->groupStart()
                ->where('pegawai.tim_id', $user['tim_id'])
                ->orWhere('pegawai.tim_rangkap_id', $user['tim_id'])
                ->orWhere('pegawai.tim_id', $user['tim_rangkap_id'])
                ->orWhere('pegawai.tim_rangkap_id', $user['tim_rangkap_id'])
                ->groupEnd()
            ;
            $builder->groupStart()
                ->whereIn('jabatan.level', [4, 5])
                ->orWhereIn('jabatan2.level', [4, 5])
                ->groupEnd();
        }

        // jika jabatan utama / rangkap level 4 atau ppk
        if ($user['level_jabatan_utama'] == 4 || $user['level_jabatan_rangkap'] == 4) {
            $builder->groupStart()
                ->where('pegawai.ppk_id', $user['ppk_id'])
                ->orWhere('pegawai.ppk_rangkap_id', $user['ppk_id'])
                ->orWhere('pegawai.ppk_id', $user['ppk_rangkap_id'])
                ->orWhere('pegawai.ppk_rangkap_id', $user['ppk_rangkap_id'])
                ->groupEnd()
            ;

            $builder->groupStart()
                ->where('jabatan.level', 5)
                ->orWhere('jabatan2.level', 5)
                ->groupEnd();
        }

        if ($user['level_jabatan_utama'] == 5 || $user['level_jabatan_rangkap'] == 5) {
            $builder->groupStart()
                ->where('pegawai.nip', $user['nip'])
                ->groupEnd();
        }



        $result =  $builder->get()->getResult();
        echo ('QUERIES');
        echo ($this->db->getLastQuery());

        return $result;
    }

    public function getByAccess($user)
    {
        // init builder 
        $builder = $this->db->table('log_harian');

        // main query
        $builder->select('
            log_harian.*,
            pegawai.nama
        ');

        $builder->join('pegawai', 'pegawai.id = log_harian.id_pegawai');
        $builder->join('jabatan jabatan', 'pegawai.jabatan_id = jabatan.id', 'left');
        $builder->join('jabatan jabatan2', 'pegawai.jabatan_rangkap_id = jabatan2.id', 'left');

        $highest = min([(int) $user['level_jabatan_utama'], (int) $user['level_jabatan_rangkap']]);



        // jika level 1 atau kabalai
        if ($highest == 1) {
            return $builder->get()->getResult();
        }

        // jika jabatan utama / rangkap level 2 atau kabag,kabid
        if ($highest == 2) {
            $builder->groupStart()
                ->where('pegawai.bidang_id', $user['bidang_id'])
                ->orWhere('pegawai.bidang_rangkap_id', $user['bidang_id'])
                ->orWhere('pegawai.bidang_id', $user['bidang_rangkap_id'])
                ->orWhere('pegawai.bidang_rangkap_id', $user['bidang_rangkap_id'])
                ->groupEnd()
            ;

            $builder->groupStart()
                ->whereIn('jabatan.level', [3, 4, 5])
                ->orWhereIn('jabatan2.level', [3, 4, 5])
                ->groupEnd();
        }

        //jika jabatan utama  / rangkap level 3 atau katim/kasatker
        if ($highest == 3) {
            $builder->groupStart()
                ->where('pegawai.tim_id', $user['tim_id'])
                ->orWhere('pegawai.tim_rangkap_id', $user['tim_id'])
                ->orWhere('pegawai.tim_id', $user['tim_rangkap_id'])
                ->orWhere('pegawai.tim_rangkap_id', $user['tim_rangkap_id'])
                ->groupEnd()
            ;
            $builder->groupStart()
                ->whereIn('jabatan.level', [4, 5])
                ->orWhereIn('jabatan2.level', [4, 5])
                ->groupEnd();
        }

        // jika jabatan utama / rangkap level 4 atau ppk
        if ($highest == 4) {
            $builder->groupStart()
                ->where('pegawai.ppk_id', $user['ppk_id'])
                ->orWhere('pegawai.ppk_rangkap_id', $user['ppk_id'])
                ->orWhere('pegawai.ppk_id', $user['ppk_rangkap_id'])
                ->orWhere('pegawai.ppk_rangkap_id', $user['ppk_rangkap_id'])
                ->groupEnd()
            ;

            $builder->groupStart()
                ->where('jabatan.level', 5)
                ->orWhere('jabatan2.level', 5)
                ->groupEnd();
        }

        if ($highest == 5) {
            $builder->groupStart()
                ->where('pegawai.nip', $user['nip'])
                ->groupEnd();
        }



        $result =  $builder->get()->getResult();
        // echo ('QUERIES');
        // echo ($this->db->getLastQuery());

        return $result;
    }
}
