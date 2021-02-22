<?php

namespace App\Controllers;


use App\Models\mahasiswaModel;
use App\Models\rolesModel;
use App\Models\levelModel;

class Mahasiswa extends BaseController
{
    public function __construct()
    {

        $this->mahasiswaModel = new mahasiswaModel();
        $this->rolesModel = new rolesModel();
        $this->levelModel = new levelModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Mahasiswa',
                'mahasiswa' => $this->mahasiswaModel->getmahasiswa(),
                'roles' => $this->rolesModel->getroles(),
                'level' => $this->levelModel->getlevel(),
            ];
        return view('mahasiswa/index', $data);
    }
    public function tambah()
    {
        $data =
            [
                'title' => 'Tambah Mahasiswa',
                'roles' => $this->rolesModel->findAll(),
            ];
        return view('mahasiswa/tambah', $data);
    }
    public function save()
    {
        $options = [
            'cost' => 10,
        ];
        $password = $this->request->getVar('password_hash');
        $pass_hash = password_hash(base64_encode(
            hash('sha384', $password, true)
        ), PASSWORD_DEFAULT, $options);
        $this->mahasiswaModel->save([
            'nim' => $this->request->getVar('nim'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'prodi' => $this->request->getVar('prodi'),
            'no_telp' => $this->request->getVar('no_telp'),
            'alamat' => $this->request->getVar('alamat'),
            'email' => $this->request->getVar('email'),
            'level' => $this->request->getVar('group_id'),
            'username' => $this->request->getVar('username'),
            'active' => 1,
            'password_hash' => $pass_hash,

        ]);
        // set role
        $conn = \Config\Database::connect();

        $kode = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
        $set = $kode->getResultArray();
        foreach ($set as $s) {
            $user_id = $s['id'];
        }
        //save
        $this->levelModel->save([
            'group_id' => $this->request->getVar('group_id'),
            'user_id' => $user_id,
        ]);
        session()->setFlashdata('pesan', 'Data mahasiswa berhasil ditambahkan.');
        return redirect()->to('/mahasiswa');
    }
    public function edit($id)
    {
        // set role
        $conn = \Config\Database::connect();

        $lev = $conn->query("SELECT * FROM auth_groups_users ORDER BY user_id DESC LIMIT 1");

        $data =
            [
                'title' => 'Edit mahasiswa',
                'mahasiswa' => $this->mahasiswaModel->getmahasiswa($id),
                'roles' => $this->rolesModel->findAll(),
            ];
        return view('mahasiswa/edit', $data);
    }
    public function update()
    {
        $id = $this->request->getVar('id');
        $oldlevel = $this->request->getVar('oldlevel');
        $oldpass = $this->request->getVar('oldpass');
        $level = $this->request->getVar('group_id');
        $pass = $this->request->getVar('password_hash');

        if ($oldlevel == $level) {
            if ($pass == null) {
                $mahasiswa = [
                    'nim' => $this->request->getVar('nim'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'prodi' => $this->request->getVar('prodi'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
                    'level' => $this->request->getVar('group_id'),
                    'username' => $this->request->getVar('username'),

                ];
            } elseif ($pass != null) {
                $options = [
                    'cost' => 10,
                ];
                $password = $this->request->getVar('password_hash');
                $pass_hash = password_hash(base64_encode(
                    hash('sha384', $password, true)
                ), PASSWORD_DEFAULT, $options);
                $mahasiswa = [
                    'nim' => $this->request->getVar('nim'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'prodi' => $this->request->getVar('prodi'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
                    'level' => $this->request->getVar('group_id'),
                    'username' => $this->request->getVar('username'),
                    'password_hash' => $pass_hash,
                ];
            }

            $this->mahasiswaModel->update($id, $mahasiswa);
        } else {

            // hapus
            $this->mahasiswaModel->delete($id);

            if ($pass == null) {
                $this->mahasiswaModel->save([
                    'nim' => $this->request->getVar('nim'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'prodi' => $this->request->getVar('prodi'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
                    'level' => $this->request->getVar('group_id'),
                    'username' => $this->request->getVar('username'),
                    'active' => 1,


                ]);
            } elseif ($pass != null) {
                $options = [
                    'cost' => 10,
                ];
                $password = $this->request->getVar('password_hash');
                $pass_hash = password_hash(base64_encode(
                    hash('sha384', $password, true)
                ), PASSWORD_DEFAULT, $options);
                $this->mahasiswaModel->save([
                    'nim' => $this->request->getVar('nim'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'prodi' => $this->request->getVar('prodi'),
                    'alamat' => $this->request->getVar('alamat'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
                    'level' => $this->request->getVar('group_id'),
                    'username' => $this->request->getVar('username'),
                    'active' => 1,
                    'password_hash' => $pass_hash,

                ]);
            }

            // set role
            $conn = \Config\Database::connect();

            $kode = $conn->query("SELECT * FROM users ORDER BY id DESC LIMIT 1");
            $set = $kode->getResultArray();
            foreach ($set as $s) {
                $user_id = $s['id'];
            }
            //save
            $this->levelModel->save([
                'group_id' => $this->request->getVar('group_id'),
                'user_id' => $user_id,
            ]);
        }
        session()->setFlashdata('pesan', 'Data mahasiswa berhasil diupdate.');
        return redirect()->to('/mahasiswa');
    }
    public function delete($id)
    {
        $this->mahasiswaModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/mahasiswa');
    }


    //--------------------------------------------------------------------

}
