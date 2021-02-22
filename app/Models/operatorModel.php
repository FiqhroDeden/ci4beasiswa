<?php

namespace App\Models;

use CodeIgniter\Model;

class operatorModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'username', 'nama_lengkap', 'nip',  'no_telp', 'level', 'password_hash', 'active'];

    public function getOperator($id = false)
    {

        if ($id == false) {
            $query =  $this->select('users.id as id, nip, nama_lengkap, no_telp, email, name')

                ->join('auth_groups ag', 'ag.id = users.level')
                ->get();

            return $query->getResultArray();
        }


        return $this->where(['id' => $id])->first();
    }
}
