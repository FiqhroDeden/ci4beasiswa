<?php

namespace App\Controllers;

use App\Models\beasiswaModel;

class Beasiswa extends BaseController
{
    public function __construct()
    {
        $this->beasiswaModel = new beasiswaModel();
    }

    public function index()
    {
        $data =
            [
                'title' => 'Kelola Beasiswa',
                'beasiswa' => $this->beasiswaModel->getbeasiswa()

            ];

        return view('beasiswa/index', $data);
    }

    public function tambah()
    {
        $data =
            [
                'title' => 'Tambah Beasiswa'
            ];
        return view('beasiswa/tambah', $data);
    }

    public function save()
    {
        $gambar = $this->request->getFile('gambar');
        if ($gambar->getError() == 4) {
            $namagambar = 'gambar.jpg';
        } else {
            $namagambar = $gambar->getRandomName();
            $gambar->move('file/beasiswa', $namagambar);
        }

        $this->beasiswaModel->save([
            'nama_beasiswa' => $this->request->getVar('nama_beasiswa'),
            'kuota'         => $this->request->getVar('kuota'),
            'deskripsi'     => $this->request->getVar('deskripsi'),
            'gambar'        => $namagambar,
            'dibuka'        => $this->request->getVar('dibuka'),
            'ditutup'       => $this->request->getVar('ditutup'),
            'status'        => $this->request->getVar('status'),
            'status_publish' => $this->request->getVar('status_publish')
        ]);
        session()->setFlashdata('pesan', 'Data Beasiswa Berhasil ditambahkan');
        return redirect()->to('/beasiswa');
    }
    public function delete($id)
    {
        $this->beasiswaModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus.');
        return redirect()->to('/beasiswa');
    }
}
