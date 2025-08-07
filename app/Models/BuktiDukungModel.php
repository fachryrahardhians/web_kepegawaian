<?php

namespace App\Models;

use CodeIgniter\Model;

class BuktiDukungModel extends Model
{
    protected $table = 'bukti_dukung';

    protected $allowedFields = [
        'id',
        'reference_id',
        'file_path',
        'deskripsi',
        'directory',
        'filename',
    ];
}
