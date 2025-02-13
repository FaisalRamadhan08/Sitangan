<?php

namespace App\Controllers;

use App\Models\M_gis;
use App\Models\M_gis1;
use Config\Services;

class Master_titik_pantau extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->GisModel = new M_gis($request);
        $this->Gis1Model = new M_gis1($request);
    }

    public function index(): string
    {
        $data = [
            'maps' => $this->GisModel->findAll(),
            'maps' => $this->Gis1Model->findAll()
        ];
        return view('data/v_titik_pantau' , $data);
    }
}
