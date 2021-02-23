<?php

namespace App\Models;

use CodeIgniter\Model;

class beasiswaModel extends Model
{
    protected $table = 'beasiswa';
    protected $useTimestamps = true;
    protected $allowedFields = ['nama_beasiswa', 'kuota', 'dibuka', 'ditutup', 'status', 'deskripsi', 'gambar', 'status_publish'];

    public function getbeasiswa($id = false)
    {

        if ($id == false) {

            return $this->findAll();
        }


        return $this->where(['id' => $id])->first();
    }
}
