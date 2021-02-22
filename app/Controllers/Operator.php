<?php

namespace App\Controllers;


use App\Models\operatorModel;
use App\Models\rolesModel;
use App\Models\levelModel;

class Operator extends BaseController
{
    public function __construct()
    {

        $this->operatorModel = new operatorModel();
        $this->rolesModel = new rolesModel();
        $this->levelModel = new levelModel();
    }
    public function index()
    {
        $data =
            [
                'title' => 'Operator',
                'pegawai' => $this->operatorModel->getOperator(),
                'roles' => $this->rolesModel->getroles(),
                'level' => $this->levelModel->getlevel(),
            ];
        return view('operator/index', $data);
    }
    public function tambah()
    {
        $data =
            [
                'title' => 'Tambah Operator',
                'roles' => $this->rolesModel->findAll(),
            ];
        return view('operator/tambah', $data);
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
        $this->operatorModel->save([
            'nip' => $this->request->getVar('nip'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'jabatan' => $this->request->getVar('jabatan'),
            'golongan' => $this->request->getVar('golongan'),
            'no_telp' => $this->request->getVar('no_telp'),
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
        session()->setFlashdata('pesan', 'Data Operator berhasil ditambahkan.');
        return redirect()->to('/operator');
    }
    public function edit($id)
    {
        // set role
        $conn = \Config\Database::connect();

        $lev = $conn->query("SELECT * FROM auth_groups_users ORDER BY user_id DESC LIMIT 1");

        $data =
            [
                'title' => 'Edit Operator',
                'pegawai' => $this->operatorModel->getOperator($id),
                'roles' => $this->rolesModel->findAll(),
            ];
        return view('operator/edit', $data);
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
                $operator = [
                    'nip' => $this->request->getVar('nip'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
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
                $operator = [
                    'nip' => $this->request->getVar('nip'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'email' => $this->request->getVar('email'),
                    'level' => $this->request->getVar('group_id'),
                    'username' => $this->request->getVar('username'),
                    'password_hash' => $pass_hash,
                ];
            }

            $this->operatorModel->update($id, $operator);
        } else {

            // hapus
            $this->operatorModel->delete($id);

            if ($pass == null) {
                $this->operatorModel->save([
                    'nip' => $this->request->getVar('nip'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
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
                $this->operatorModel->save([
                    'nip' => $this->request->getVar('nip'),
                    'nama_lengkap' => $this->request->getVar('nama_lengkap'),
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
        session()->setFlashdata('pesan', 'Data Operator berhasil diupdate.');
        return redirect()->to('/operator');
    }
    public function delete($id)
    {
        $this->operatorModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/operator');
    }


    //--------------------------------------------------------------------

}
