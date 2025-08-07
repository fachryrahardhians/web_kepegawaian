<?php 

namespace App\Models\auth;

use CodeIgniter\Model;

class AccountModel extends Model {
    protected $table = 'user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'username','password','id'
    ];

    protected $createField = 'created_at';
}


?>