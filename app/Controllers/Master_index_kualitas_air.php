<?php

namespace App\Controllers;

use \Hermawan\DataTables\DataTable;
use App\Models\M_gis;
use Config\Services;


class Master_index_kualitas_air extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->GisModel = new M_gis($request);
    }

    public function index(): string
    {
        $request = Services::request();
        $indexKualitasAir = new M_gis($request);
        $memenuhi_baku_mutu = $indexKualitasAir->getMemenuhiBakuMutu();
        $tercemar_ringan = $indexKualitasAir->getTercemarRingan();
        $tercemar_sedang = $indexKualitasAir->getTercemarSedang();
        $tercemar_berat = $indexKualitasAir->getTercemarBerat();

        $data = [
            'tercemar_ringan' => sprintf("%.2f%%", $tercemar_ringan),
            'tercemar_sedang' => sprintf("%.2f%%", $tercemar_sedang),
            'tercemar_berat' => sprintf("%.2f%%", $tercemar_berat),
            'memenuhi_baku_mutu' => sprintf("%.2f%%", $memenuhi_baku_mutu),
        ];
        return view('data/v_index_kualitas_air', $data);
    }

    public function ajax_list()
    {
        $request = Services::request();
        $indexKualitasAir = new M_gis($request);
        $Total_Index_Kualitas_Air = $indexKualitasAir->getDataByYear();
        return DataTable::of($Total_Index_Kualitas_Air)
            ->setSearchableColumns(['created_at'])
            ->addNumbering('nomor')
            ->toJson(true);
    }
}