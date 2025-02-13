<?php

namespace App\Controllers;

use App\Models\M_eksisting_bod;
use App\Models\M_gis;
use App\Models\M_gis1;
use Config\Services;

class Home extends BaseController
{

    protected $db;
    public function __construct()
    {
        helper(['url', 'form']);
        date_default_timezone_set('Asia/Jakarta');
        $request = Services::request();
        $this->GisModel = new M_gis($request);
        $this->Gis1Model = new M_gis1($request);
        $this->EksistingBodModel = new M_eksisting_bod($request);
    }

    public function index(): string
    {
        return view('data/v_dashboard');
    }

    // status mutu air
    public function chart_status_mutu_air()
    {
        $filter = $this->request->getPost('filter');
        $category = $this->GisModel->getStatusMutuAirByFilter();
        $resultCategory = [];
        if ($category != null) {
            foreach ($category as $key => $value) {
                $resultCategory[] = [
                    "label" => $value->nama_sungai,
                ];
            }
        }
        $seriesName = ["hulu", "tengah", "hilir"];
        foreach ($seriesName as $key => $value) {
            $resultDataSet[] = [
                "seriesname" => $value,
                "data" => $this->checkNilaistatusmutuair($value, $filter),
            ];
        }
        $respon = [
            'category' => $resultCategory,
            "dataset" => $resultDataSet,
            "filter" => $filter,
        ];
        echo json_encode($respon);
    }

    public function chart_status_mutu_udara()
    {
        $filter = $this->request->getPost('filter');
        $category = $this->Gis1Model->getStatusMutuUdaraByFilter();
        $resultCategory = [];
        if ($category != null) {
            foreach ($category as $key => $value) {
                $resultCategory[] = [
                    "label" => $value->nama_lokasi,
                ];
            }
        }
        $seriesName = ["utara", "tengah", "selatan"];
        foreach ($seriesName as $key => $value) {
            $resultDataSet[] = [
                "seriesname" => $value,
                "data" => $this->checkNilaistatusmutuudara($value, $filter),
            ];
        }
        $respon = [
            'category' => $resultCategory,
            "dataset" => $resultDataSet,
            "filter" => $filter,
        ];
        echo json_encode($respon);
    }

    public function checkNilaistatusmutuair($titik_pantau, $filter)
    {
        $timestamp = strtotime($filter);
        $newFormatFilter = date('Y-m', $timestamp);
        $nilai_pij = $this->GisModel->cekNilaiPijStatusMutuAirByFilter($titik_pantau,$newFormatFilter);
        $result = [];
        if ($nilai_pij != null) {
            foreach ($nilai_pij as $key => $value) {
                $result[] = [
                    "value" => $value->nilai_pij,
                ];
            }
        }
        return $result;
    }

    public function checkNilaistatusmutuudara($titik_pantau, $filter)
    {
        $timestamp = strtotime($filter);
        $newFormatFilter = date('Y-m', $timestamp);
        $nilai_ispu = $this->Gis1Model->cekNilaiIspuStatusMutuUdaraByFilter($titik_pantau,$newFormatFilter);
        $result = [];
        if ($nilai_ispu != null) {
            foreach ($nilai_ispu as $key => $value) {
                $result[] = [
                    "value" => $value->nilai_ispu,
                ];
            }
        }
        return $result;
    }

    // index kualitas air
    public function chart_index_kualitas_air()
    {
        $filter = $this->request->getPost('filter');
        $ika = $this->GisModel->getIndexKualitasAirByFilter($filter);
        $resultDataSet = [];
        foreach ($ika as $key => $value) {
            $totalIka = (($value->memenuhi_baku_mutu * 70 / 100) + ($value->tercemar_ringan * 50 / 100) + ($value->tercemar_sedang * 30 / 100) + ($value->tercemar_berat * 10 / 100));
            $resultDataSet[] = [
                "label" => $value->tahun,
                "value" => $totalIka,
            ];
        }
        $respon = [
            "data" => $resultDataSet,
            "filter" => $filter,
        ];
        echo json_encode($respon);
    }

    public function chart_index_kualitas_udara()
    {
        $filter = $this->request->getPost('filter');
        $iku = $this->Gis1Model->getIndexKualitasUdaraByFilter($filter);
        $resultDataSet = [];
        foreach ($iku as $key => $value) {
            $totalIku = (($value->baik * 90 / 100) + ($value->sedang * 70 / 100) + ($value->tidak_sehat * 50 / 100) + ($value->sangat_tidak_sehat * 30 / 100) + ($value->berbahaya * 10 / 100));
            $resultDataSet[] = [
                "label" => $value->tahun,
                "value" => $totalIku,
            ];
        }
        $respon = [
            "data" => $resultDataSet,
            "filter" => $filter,
        ];
        echo json_encode($respon);
    }

    // beban pencemaran eksisting 
    public function chart_beban_pencemaran_eksisting()
    {
        $filter = $this->request->getPost('filter');
        $category =  $this->EksistingBodModel->getEksistingBodByFilter();
        $resultCategory = [];
        if ($category != null) {
            foreach ($category as $key => $value) {
                $resultCategory[] = [
                    "label" => $value->nama_sungai,
                ];
            }
        }
        $seriesName = ["hulu", "tengah", "hilir"];
        foreach ($seriesName as $key => $value) {
            $resultDataSet[] = [
                "seriesname" => $value,
                "data" => $this->checkNilaiBebanPencemaranEksisting($value, $filter),
            ];
        }
        $respon = [
            'category' => $resultCategory,
            "dataset" => $resultDataSet,
            "filter" => $filter,
        ];
        echo json_encode($respon);
    }

    public function checkNilaiBebanPencemaranEksisting($titik_pantau, $filter)
    {
        $timestamp = strtotime($filter);
        $newFormatFilter = date('Y-m', $timestamp);
        $nilai_dtbp = $this->EksistingBodModel->cekNilaiDtbpEksistingBodByFilter($titik_pantau, $newFormatFilter);
        $result = [];
        if ($nilai_dtbp != null) {
            foreach ($nilai_dtbp as $key => $value) {
                $result[] = [
                    "value" => $value->dtbp,
                ];
            }
        }
        return $result;
    }
}
