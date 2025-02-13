<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_gis extends Model
{
    protected $table      = 'gis';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimeStamps = true;
    protected $returnType = 'array';
    protected $column_order = ['nama_sungai', 'titik_pantau', 'debit', 'nilai_ph', 'do', 'bod', 'cod', 'tss', 'no3_n', 't_phosphat', 'fecal_coli', 'status_mutu_air', 'nilai_pij', 'gambar', 'video', 'latitude', 'longitude', 'created_at', 'updated_at'];
    protected $column_search = ['nama_sungai', 'titik_pantau', 'debit', 'nilai_ph', 'do', 'bod', 'cod', 'tss', 'no3_n', 't_phosphat', 'fecal_coli', 'status_mutu_air', 'nilai_pij', 'gambar', 'video', 'latitude', 'longitude', 'created_at', 'updated_at'];
    protected $allowedFields = ['nama_sungai', 'titik_pantau', 'debit', 'nilai_ph', 'do', 'bod', 'cod', 'tss', 'no3_n', 't_phosphat', 'fecal_coli', 'status_mutu_air', 'nilai_pij', 'gambar', 'video', 'latitude', 'longitude', 'created_at', 'updated_at'];
    protected $order = ['id' => 'DESC'];
    protected $request;
    protected $db;
    protected $dt;

    // ========================= START: KONTRUKTOR  =======================================================
    public function __construct(RequestInterface $request)
    {
        parent::__construct();
        $this->db = db_connect();
        $this->request = $request;
        $this->dt = $this->db->table($this->table);
    }
    // ========================= END: KONTRUKTOR  ==========================================================

    // ========================= START: QUERY DATATABLE  ===================================================
    private function getDatatablesQuery()
    {
        $i = 0;
        // Jika terdapat sebuah request pencarian
        foreach ($this->column_search as $item) {
            if ($this->request->getPost('search')['value']) {
                if ($i === 0) {
                    $this->dt->groupStart();
                    $this->dt->like($item, $this->request->getPost('search')['value']);
                } else {
                    $this->dt->orLike($item, $this->request->getPost('search')['value']);
                }
                // Jika query sudah mencari ke semua kolom
                if (count($this->column_search) - 1 == $i) {
                    $this->dt->groupEnd();
                }
            }
            $i++;
        }

        // Jika terdapat sebuah request pengurutan
        if ($this->request->getPost('order')) {
            $this->dt->orderBy($this->column_order[$this->request->getPost('order')['0']['column']], $this->request->getPost('order')['0']['dir']);
        } elseif (isset($this->order)) {
            $order = $this->order;
            $this->dt->orderBy(key($order), $order[key($order)]);
        }
    }

    public function getDatatables()
    {
        $this->getDatatablesQuery();
        if ($this->request->getPost('length') != -1) {
            $this->dt->limit($this->request->getPost('length'), $this->request->getPost('start'));
        }
        $query = $this->dt->get();
        return $query->getResult();
    }

    public function countFiltered()
    {
        // Jumlah data yang ditemukan ketika ada filter
        $this->getDatatablesQuery();
        return $this->dt->countAllResults();
    }

    public function countAll()
    {
        // Menghitung semua data yang ada
        $tbl_storage = $this->db->table($this->table);
        return $tbl_storage->countAllResults();
    }
    // ========================= END: QUERY DATATABLE  =====================================================

    // ========================= START: QUERY INDEX KUALITAS AIR ===========================================
    public function getMemenuhiBakuMutu()
    {
        return $this->select('SUM(IF(status_mutu_air = "Memenuhi Baku Mutu", 1, 0)) / COUNT(*) * 100 AS hasil')
            ->get()
            ->getRowArray()['hasil'];
    }

    public function getTercemarRingan()
    {
        return $this->select('SUM(IF(status_mutu_air = "Tercemar Ringan", 1, 0)) / COUNT(*) * 100 AS hasil')
            ->get()
            ->getRowArray()['hasil'];
    }

    public function getTercemarSedang()
    {
        return $this->select('SUM(IF(status_mutu_air = "Tercemar Sedang", 1, 0)) / COUNT(*) * 100 AS hasil')
            ->get()
            ->getRowArray()['hasil'];
    }

    public function getTercemarBerat()
    {
        return $this->select('SUM(IF(status_mutu_air = "Tercemar Berat", 1, 0)) / COUNT(*) * 100 AS hasil')
            ->get()
            ->getRowArray()['hasil'];
    }

    public function getDataByYear()
    {
        return $this->select('YEAR(created_at) AS tahun, 
                         SUM(IF(status_mutu_air = "Memenuhi Baku Mutu", 1, 0)) / COUNT(*) * 100 AS memenuhi_baku_mutu,
                         SUM(IF(status_mutu_air = "Tercemar Ringan", 1, 0)) / COUNT(*) * 100 AS tercemar_ringan,
                         SUM(IF(status_mutu_air = "Tercemar Sedang", 1, 0)) / COUNT(*) * 100 AS tercemar_sedang,
                         SUM(IF(status_mutu_air = "Tercemar Berat", 1, 0)) / COUNT(*) * 100 AS tercemar_berat')
            ->orderBy('tahun', 'DESC')
            ->groupBy('tahun');
    }
    // ========================= END: QUARY INDEX KUALITAS AIR =============================================

    // ========================= START: GET STATUS MUTU AIR BY FILTER ======================================
    public function getStatusMutuAirByFilter() {
        return $this->select('nama_sungai')
            ->whereNotIn('nama_sungai', [""])
            ->distinct()
            ->get()
            ->getResult();
    }
    // ========================= END: GET STATUS MUTU AIR BY FILTER ======================================

    public function cekNilaiPijStatusMutuAirByFilter($titik_pantau, $filter)
    {
        return $this->select('nilai_pij')
            ->where('titik_pantau', $titik_pantau)
            ->where('SUBSTR(created_at,1,7)', $filter)
            ->get()
            ->getResult();
    }
    // ========================= END: GET STATUS MUTU AIR BY FILTER ======================================
   
    // ========================= END: GET INDEX KUALITAS AIR BY FILTER ======================================
    public function  getIndexKualitasAirByFilter($filter)
    {
        list($startDate, $endDate) = explode(' - ', $filter);
        $startDate = date('Y', strtotime($startDate));
        $endDate = date('Y', strtotime($endDate));
        $endDate = date('Y', strtotime($endDate . ' +1 day'));
        return $this->select('YEAR(created_at) AS tahun, created_at,
                         SUM(IF(status_mutu_air = "Memenuhi Baku Mutu", 1, 0)) / COUNT(*) * 100 AS memenuhi_baku_mutu,
                         SUM(IF(status_mutu_air = "Tercemar Ringan", 1, 0)) / COUNT(*) * 100 AS tercemar_ringan,
                         SUM(IF(status_mutu_air = "Tercemar Sedang", 1, 0)) / COUNT(*) * 100 AS tercemar_sedang,
                         SUM(IF(status_mutu_air = "Tercemar Berat", 1, 0)) / COUNT(*) * 100 AS tercemar_berat')
        ->where("YEAR(created_at) >= '$startDate' AND YEAR(created_at) <= '$endDate'")
        ->groupBy('tahun')
        ->get()
        ->getResult();
    }
    // ========================= END: GET INDEX KUALITAS AIR BY FILTER ======================================
}
