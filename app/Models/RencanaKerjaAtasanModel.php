<?php 

namespace App\Models;

use CodeIgniter\Model;

class RencanaKerjaAtasanModel extends Model {
    protected $table = 'renakersan';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'rencana_kerja','id_pegawai',
    ];

    protected $createField = 'created_at';
}


?>