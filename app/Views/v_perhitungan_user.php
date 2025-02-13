<div class="modal fade" id="ModalStatusMutuAir" tabindex="-1" role="dialog" aria-labelledby="ModalStatusMutuAirLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Status Mutu Air</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Nama Sungai:</label>
                    <select class="form-select">
                        <option value="cisangkan">Cisangkan</option>
                        <option value="cibaligo">Cibaligo</option>
                        <option value="cibeureum">Cibeureum</option>
                        <option value="cibabat">Cibabat</option>
                        <option value="cimahi">Cimahi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="hulu">Hulu</option>
                        <option value="tengah">Tengah</option>
                        <option value="hilir">Hilir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Debit:</label>
                    <input id="debit_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai Ph:</label>
                    <input id="nilai_ph_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">DO(m3/s):</label>
                    <input id="do_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">BOD(m3/s):</label>
                    <input id="bod_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">COD(m3/s):</label>
                    <input id="cod_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">TSS(mg/L):</label>
                    <input id="tss_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">NO3-N(m3/s):</label>
                    <input id="no3_n_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">T-Phosphat(m3/s):</label>
                    <input id="t_phosphat_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Fecal Coli(MPN/100 mL):</label>
                    <input id="fecal_coli_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungStatusMutuAirUser()">
                        Hitung status mutu air
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai Pij:</label>
                    <input id="nilai_pij_sma_user" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Status Mutu Air:</label>
                    <input id="status_mutu_air_sma_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalStatusMutuUdara" tabindex="-1" role="dialog" aria-labelledby="ModalStatusMutuUdaraLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Status Mutu Udara</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Nama Lokasi:</label>
                    <select class="form-select">
                        <option value="ptlogambima">PT. Logam Bima</option>
                        <option value="kel.cigugurtgh">Kelurahan Cigugur Tengah</option>
                        <option value="ptjenshiang">PT. Jenshiang Nusantara</option>
                        <option value="pilarmas">Perumahan Pilar Mas</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="utara">Cimahi Utara</option>
                        <option value="tengah">Cimahi Tengah</option>
                        <option value="selatan">Cimahi Selatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">SO2:</label>
                    <input id="so2_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">CO:</label>
                    <input id="co_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">NO2:</label>
                    <input id="no2_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">O3:</label>
                    <input id="o3_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">HC:</label>
                    <input id="hc_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">PM10:</label>
                    <input id="pm10_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">PM2,5:</label>
                    <input id="pm25_sma_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungStatusMutuUdaraUser()">
                        Hitung Status Mutu Udara
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai ISPU:</label>
                    <input id="nilai_ispu_sma_user" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Status Mutu Udara:</label>
                    <input id="status_mutu_udara_sma_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- EKSISTING BOD -->
<div class="modal fade" id="ModalEksistingBOD" tabindex="-1" role="dialog" aria-labelledby="ModalEksistingBODLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Beban Pencemaran Eksisting BOD</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Nama Sungai:</label>
                    <select class="form-select">
                        <option value="cisangkan">Cisangkan</option>
                        <option value="cibaligo">Cibaligo</option>
                        <option value="cibeureum">Cibeureum</option>
                        <option value="cibabat">Cibabat</option>
                        <option value="cimahi">Cimahi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="hulu">Hulu</option>
                        <option value="tengah">Tengah</option>
                        <option value="hilir">Hilir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Konsentrasi Baku Mutu Maksimum (mg/l):</label>
                    <input id="konsentrasi_baku_mutu_maksimum_eksisting_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Debit Air Sungai Maksimum (m³/detik):</label>
                    <input id="debit_air_sungai_maksimum_eksisting_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Faktor-K Maksimum:</label>
                    <input id="faktor_k_maksimum_eksisting_user" type="text" class="form-control" value="86.4" readonly>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPMUser()">
                        Hitung Beban Pencemaran Maksimum
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai BPM (kg/hari):</label>
                    <input id="bpm_eksisting_user" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Konsentrasi Aktual (mg/l):</label>
                    <input id="konsentrasi_aktual_eksisting_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Debit Air Sungai Aktual (m³/detik):</label>
                    <input id="debit_air_sungai_aktual_eksisting_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Faktor-K Aktual:</label>
                    <input id="faktor_k_aktual_eksisting_user" type="text" class="form-control" value="86.4" readonly>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiBPAUser()">
                        Hitung Beban Pencemaran Aktual
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai BPA (kg/hari):</label>
                    <input id="bpa_eksisting_user" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiDTBPUser()">
                        Hitung Daya Tampung Beban Pencemaran
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai DTBP (kg/hari):</label>
                    <input id="dtbp_eksisting_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- POTENSIAL DOMESTIK -->
<div class="modal fade" id="ModalDomestik" tabindex="-1" role="dialog" aria-labelledby="ModalDomestikLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Domestik</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Das:</label>
                    <select class="form-select">
                        <option value="cisangkan">Cisangkan</option>
                        <option value="cibaligo">Cibaligo</option>
                        <option value="cibeureum">Cibeureum</option>
                        <option value="cibabat">Cibabat</option>
                        <option value="cimahi">Cimahi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="hulu">Hulu</option>
                        <option value="tengah">Tengah</option>
                        <option value="hilir">Hilir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Jumlah Penduduk:</label>
                    <input id="jumlah_penduduk_domestik_user" type="number" min="0" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Faktor Emisi:</label>
                    <select id="faktor_emisi_domestik_user" class="form-select form-control">
                        <option selected="" disabled="" value="">-- Pilih Jenis Faktor Emisi--</option>
                        <option value="38">TSS</option>
                        <option value="40">BOD</option>
                        <option value="55">COD</option>
                        <option value="1.95">Total-N</option>
                        <option value="0.21">Total-P</option>
                    </select>
                </div>
                <div class=" mb-3">
                    <label class="col-form-label">Rasio Ekivalen Kota:</label>
                    <select id="rasio_ekivalen_kota_domestik_user" class="form-select form-control">
                        <option selected="" disabled="" value="">-- Pilih Jenis Rasio Ekivalen --</option>
                        <option value="1">Kota</option>
                        <option value="0.8125">Pinggiran Kota</option>
                        <option value="0.6250">Pedalaman</option>
                    </select>
                </div>

                <div class=" mb-3">
                    <label class="col-form-label">Rasio Ekivalen Kota:</label>
                    <select id="koefisien_transfer_beban_domestik_user" class="form-select form-control">
                        <option selected="" disabled="" value="">-- Pilih Jarak Terhadap Sungai --</option>
                        <option value="1">0-100</option>
                        <option value="0.85">100-500</option>
                        <option value="0.3">>500</option>
                    </select>
                </div>
                <div class=" mb-3">
                    <label class="col-form-label">Faktor Konversi:</label>
                    <input id="faktor_konversi_domestik_user" type="text" class="form-control" value="1000" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai Alpha:</label>
                    <input id="nilai_alpha_domestik_user" type="text" class="form-control" required>
                </div>
                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPDomestikUser()">
                        Hitung Potensial Domestik
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai PBP Domestik:</label>
                    <input id="pbp_domestik_domestik_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- POTENSIAL PERTANIAN -->
<div class="modal fade" id="ModalPertanian" tabindex="-1" role="dialog" aria-labelledby="ModalPertanianLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Pertanian</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Das:</label>
                    <select class="form-select">
                        <option value="cisangkan">Cisangkan</option>
                        <option value="cibaligo">Cibaligo</option>
                        <option value="cibeureum">Cibeureum</option>
                        <option value="cibabat">Cibabat</option>
                        <option value="cimahi">Cimahi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="hulu">Hulu</option>
                        <option value="tengah">Tengah</option>
                        <option value="hilir">Hilir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Jenis Pertanian:</label>
                    <select id="jenis_pertanian_pertanian_user" class="form-select">
                        <option selected="" disabled="" value="">-- Pilih Jenis Pertanian --</option>
                        <option value="sawah">Sawah</option>
                        <option value="palawija">Palawija</option>
                        <option value="perkebunan lain">Perkebunan Lain</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nama Parameter:</label>
                    <select id="nama_parameter_pertanian_user" class="form-select">
                        <option selected="" disabled="" value="">-- Pilih Jenis Parameter --</option>
                        <option value="tss">TSS</option>
                        <option value="bod">BOD</option>
                        <option value="cod">COD</option>
                        <option value="total-n">Total-N</option>
                        <option value="total-p">Total-P</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Faktor Emisi (kg/ha/musim tanam):</label>
                    <input id="faktor_emisi_pertanian_user" type="text" class="form-control" readonly>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Luas Lahan:</label>
                    <input id="luas_lahan_pertanian_user" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Faktor Pengali:</label>
                    <input id="faktor_pengali_pertanian_user" type="text" class="form-control" readonly>
                </div>

                <div class=" mb-3">
                    <label class="col-form-label">Lama Musim Tanam(hari):</label>
                    <input id="lama_musim_tanam_pertanian_user" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPPertanianUser()">
                        Hitung Potensial Pertanian
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai PBP Pertanian:</label>
                    <input id="pbp_pertanian_pertanian_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- POTEMSIAL PETERNAKAN -->
<div class="modal fade" id="ModalPeternakan" tabindex="-1" role="dialog" aria-labelledby="ModalPeternakanLabel" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Peternakan</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Das:</label>
                    <select class="form-select">
                        <option value="cisangkan">Cisangkan</option>
                        <option value="cibaligo">Cibaligo</option>
                        <option value="cibeureum">Cibeureum</option>
                        <option value="cibabat">Cibabat</option>
                        <option value="cimahi">Cimahi</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Titik Pantau:</label>
                    <select class="form-select">
                        <option value="hulu">Hulu</option>
                        <option value="tengah">Tengah</option>
                        <option value="hilir">Hilir</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Jumlah Peternakan:</label>
                    <input id="jumlah_ternak_peternakan_user" type="number" min="0" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Jenis Ternak:</label>
                    <select id="jenis_ternak_peternakan_user" class="form-select">
                        <option selected="" disabled="" value="">-- Pilih Jenis Perternakan --</option>
                        <option value="sapi">Sapi</option>
                        <option value="domba">Domba</option>
                        <option value="ayam">Ayam</option>
                        <option value="itik">Itik</option>
                        <option value="kerbau">Kerbau</option>
                        <option value="kuda">Kuda</option>
                        <option value="kambing">Kambing</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nama Parameter:</label>
                    <select id="nama_parameter_peternakan_user" class="form-select">
                        <option selected="" disabled="" value="">-- Pilih Jenis Parameter --</option>
                        <option value="bod">BOD</option>
                        <option value="cod">COD</option>
                        <option value="total-n">Total-N</option>
                        <option value="total-p">Total-P</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Faktor Emisi:</label>
                    <input id="faktor_emisi_peternakan_user" type="text" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Persentase Limbah:</label>
                    <input id="persentase_limbah_peternakan_user" type="text" class="form-control" value="0.2" readonly>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Faktor Pengali:</label>
                    <input id="faktor_pengali_peternakan_user" type="text" class="form-control" value="1000" readonly>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPPeternakanUser()">
                        Hitung Potensial Peternakan
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nilai PBP Peternakan:</label>
                    <input id="pbp_peternakan_peternakan_user" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<!-- POTENSIAL INDUSTRI 1 -->
<div class="modal fade" id="Modalindustri_1" tabindex="-1" role="dialog" aria-labelledby="Modalindustri_1Label" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Industri Tier 1</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Kecamatan:</label>
                    <select class="form-select">
                        <option value="cimahi utara">Cimahi Utara</option>
                        <option value="cimahi tengah">Cimahi Tengah</option>
                        <option value="cimahi selatan">Cimahi Selatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nama Perusahaan:</label>
                    <input id="nama_perusahaan_industri_1" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Konversi Satuan β:</label>
                    <input id="param_1_formula_1_industri_1" type="text" class="form-control" value="0.0864" readonly>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Koefisien Tranfer Beban Jarak γ (0.3 - 1):</label>
                    <input id="param_2_formula_1_industri_1" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Koefisien Transfer beban Rasio Debit δ (0.3 - 1):</label>
                    <input id="param_3_formula_1_industri_1" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Debit Q(I/s):</label>
                    <input id="param_4_formula_1_industri_1" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Emisi Zat Pencemar(mg/l):</label>
                    <input id="param_5_formula_1_industri_1" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri1User()">
                        Hitung Potensial Perindustrian Tier 1
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                    <input id="pbp_industri_formula_1_industri_1" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modalindustri_2" tabindex="-1" role="dialog" aria-labelledby="Modalindustri_2Label" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Industri Tier 2</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Kecamatan:</label>
                    <select class="form-select">
                        <option value="cimahi utara">Cimahi Utara</option>
                        <option value="cimahi tengah">Cimahi Tengah</option>
                        <option value="cimahi selatan">Cimahi Selatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nama Perusahaan:</label>
                    <input id="nama_perusahaan_industri_2" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Konsentrasi Limbah Industri (mg/l):</label>
                    <input id="param_1_formula_2_industri_2" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Laju Alir Buangan Air Limbah (l/jam):</label>
                    <input id="param_2_formula_2_industri_2" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Jumlah Jam Operasi Per-tahun (jam/tahun):</label>
                    <input id="param_3_formula_2_industri_2" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Faktor konversi (mg/kg):</label>
                    <input id="param_4_formula_2_industri_2" type="text" class="form-control" value="100000" readonly>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri2User()">
                        Hitung Potensial Perindustrian Tier 2
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                    <input id="pbp_industri_formula_2_industri_2" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Modalindustri_3" tabindex="-1" role="dialog" aria-labelledby="Modalindustri_3Label" data-bs-backdrop="static" aria-hidden="true" data-bs-keyboard="false">
    <div class="modal-dialog modal-700" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perhitungan Potensial Industri Tier 3</h5>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body max-height-550">
                <div class="mb-3">
                    <label class="col-form-label">Kecamatan:</label>
                    <select class="form-select">
                        <option value="cimahi utara">Cimahi Utara</option>
                        <option value="cimahi tengah">Cimahi Tengah</option>
                        <option value="cimahi selatan">Cimahi Selatan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">Nama Perusahaan:</label>
                    <input id="nama_perusahaan_industri_3" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Jumlah Karyawan (orang):</label>
                    <input id="param_1_formula_3_industri_3" type="text" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="col-form-label">Faktor Emisi BOD (gr/hari/karyawan):</label>
                    <select id="param_2_formula_3_industri_3" class="form-select">
                        <option selected="" disabled="" value="">-- Pilih Jenis Sektor Industri --</option>
                        <option value="79.1">Pewarnaan/Pencelupan</option>
                        <option value="37.9">Pangan</option>
                        <option value="10.3">Logam</option>
                        <option value="17.9">Kertas</option>
                        <option value="47.1">Serat Poliester</option>
                        <option value="219.2">Tekstil</option>
                        <option value="96.4">Laundry</option>
                        <option value="4.7">Mesin</option>
                        <option value="57.3">Barang Plastik</option>
                        <option value="13.5">Suku Cadang Mobil/Motor</option>
                        <option value="2">Keramik dan Ubin</option>
                        <option value="144.4">Penyamakan Kulit</option>
                        <option value="50.4">Sabun dan Detergen</option>
                        <option value="1898.2">Kimia</option>
                        <option value="0.2">Barang Logam</option>
                        <option value="0.6">Percetakan</option>
                        <option value="0.3">Kaca</option>
                        <option value="123">Rumah Sakit</option>
                        <option value="55">Hotel</option>
                        <option value="17">Restoran</option>
                    </select>
                </div>


                <div class="mb-3">
                    <label class="col-form-label">Faktor Konversi (1000):</label>
                    <input id="param_3_formula_3_industri_3" type="text" class="form-control" value="1000" readonly>
                </div>

                <div class="mb-3">
                    <button type="button" class="btn btn-primary btn-air-primary w-100" onclick="hitungNilaiPBPindustri3User()">
                        Hitung Potensial Perindustrian Tier 3
                    </button>
                </div>
                <div class="mb-3">
                    <label class="col-form-label">PBP Perindustrian (Kg/hari):</label>
                    <input id="pbp_industri_formula_3_industri_3" type="text" class="form-control" readonly>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Kembali</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/perhitungan_user.js'); ?>"></script>