<?php

namespace App\Controllers;

class Dashboard extends BaseController
{

    public function index()
    {
        if (in_groups('admin')) {
            $data =
                [
                    'title' => 'Dashboard Admin'
                ];
            return view('dashboard/admin', $data);
        }
        if (in_groups('operator')) {
            $data =
                [
                    'title' => 'Dashboard Operator'
                ];
            return view('dashboard/sekertaris', $data);
        }
        if (in_groups('mahasiswa')) {
            $data =
                [
                    'title' => 'Dashboard Mahasiswa'
                ];
            return view('dashboard/kepala', $data);
        }
    }




    //--------------------------------------------------------------------

}
