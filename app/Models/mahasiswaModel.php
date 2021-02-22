<?php

namespace App\Models;

use CodeIgniter\Model;

class mahasiswaModel extends Model
{
    protected $table = 'users';
    protected $useTimestamps = true;
    protected $allowedFields = ['email', 'username', 'nama_lengkap', 'nim', 'prodi', 'alamat',  'no_telp', 'level', 'password_hash', 'active'];

    public function getmahasiswa($id = false)
    {

        if ($id == false) {
            $query =  $this->select('users.id as id, nim, nama_lengkap, no_telp, prodi, alamat, email, name')

                ->join('auth_groups_users', 'auth_groups_users.user_id = users.id')
                ->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id')
                ->Where('name', 'mahasiswa')
                ->get();

            return $query->getResultArray();
        }


        return $this->where(['id' => $id])->first();
    }
}
