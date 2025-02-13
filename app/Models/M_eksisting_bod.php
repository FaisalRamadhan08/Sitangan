<?php

namespace App\Models;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\Model;

class M_eksisting_bod extends Model
{
    protected $table      = 'bod_eksisting';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimeStamps = true;
    protected $returnType = 'array';
    protected $column_order = ['nama_sungai', 'titik_pantau', 'konsentrasi_baku_mutu_maksimum', 'debit_air_sungai_maksimum', 'faktor_k_maksimum', 'bpm', 'konsentrasi_aktual', 'debit_air_sungai_aktual', 'faktor_k_aktual', 'bpa', 'dtbp', 'created_at', 'updated_at'];
    protected $column_search = ['nama_sungai', 'titik_pantau', 'konsentrasi_baku_mutu_maksimum', 'debit_air_sungai_maksimum', 'faktor_k_maksimum', 'bpm', 'konsentrasi_aktual', 'debit_air_sungai_aktual', 'faktor_k_aktual', 'bpa', 'dtbp', 'created_at', 'updated_at'];
    protected $allowedFields = ['nama_sungai', 'titik_pantau', 'konsentrasi_baku_mutu_maksimum', 'debit_air_sungai_maksimum', 'faktor_k_maksimum', 'bpm', 'konsentrasi_aktual', 'debit_air_sungai_aktual', 'faktor_k_aktual', 'bpa', 'dtbp', 'created_at', 'updated_at'];
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

    // ========================= START: GET EKSISTING BOD BY FILTER ========================================
    public function getEksistingBodByFilter()
    {
        return $this->select('nama_sungai')
            ->whereNotIn('nama_sungai', [""])
            ->distinct()
            ->get()
            ->getResult();
    }

    public function cekNilaiDtbpEksistingBodByFilter($titik_pantau, $filter)
    {
        return $this->select('dtbp')
            ->where('titik_pantau', $titik_pantau)
            ->where('SUBSTR(created_at,1,7)', $filter)
            ->get()
            ->getResult();
    }
    // ========================= END: GET EKSISTING BOD BY FILTER ======================================== 
}
