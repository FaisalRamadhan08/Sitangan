// =============== START: PERHITUNGAN STATUS MURU AIR USER  ================
function hitungStatusMutuAirUser() {
    var batasTSS = 50,
        batasDO = 4,
        batasBOD = 3,
        batasCOD = 25,
        batasFosfat = 0.2,
        batasFecal = 1000,
        batasColiform = 10;

    var nilaiPH = $("#nilai_ph_sma_user").val(),
        nilaiDO = $("#do_sma_user").val(),
        nilaiBOD = $("#bod_sma_user").val(),
        nilaiCOD = $("#cod_sma_user").val(),
        nilaiTSS = $("#tss_sma_user").val(),
        nilaiColiform = $("#no3_n_sma_user").val(),
        nilaiFosfat = $("#t_phosphat_sma_user").val(),
        nilaiFecal = $("#fecal_coli_sma_user").val();

    var nilaiPHAdjusted = nilaiPH < 7.5 ? (nilaiPH - 7.5) / (6 - 7.5) : (nilaiPH - 7.5) / (9 - 7.5);

    var nilaiTSSNormalized = nilaiTSS / batasTSS,
        nilaiDONormalized = ((7 - nilaiDO) / (7 - batasDO)) / batasDO,
        nilaiBODNormalized = nilaiBOD / batasBOD,
        nilaiCODNormalized = nilaiCOD / batasCOD,
        nilaiFosfatNormalized = nilaiFosfat / batasFosfat,
        nilaiFecalNormalized = nilaiFecal / batasFecal,
        nilaiColiformNormalized = nilaiColiform / batasColiform;

    var nlaiTSS = nilaiTSSNormalized > 1 ? 1 + 5 * Math.log10(nilaiTSS / batasTSS) : nilaiTSSNormalized,
        nlaiDO = nilaiDONormalized > 1 ? 1 + 5 * Math.log10(((7 - nilaiDO) / (7 - batasDO)) / batasDO) : nilaiDONormalized,
        nlaiBOD = nilaiBODNormalized > 1 ? 1 + 5 * Math.log10(nilaiBOD / batasBOD) : nilaiBODNormalized,
        nlaiCOD = nilaiCODNormalized > 1 ? 1 + 5 * Math.log10(nilaiCOD / batasCOD) : nilaiCODNormalized,
        nlaiFosfat = nilaiFosfatNormalized > 1 ? 1 + 5 * Math.log10(nilaiFosfat / batasFosfat) : nilaiFosfatNormalized,
        nlaiFecal = nilaiFecalNormalized > 1 ? 1 + 5 * Math.log10(nilaiFecal / batasFecal) : nilaiFecalNormalized,
        nlaiColiform = nilaiColiformNormalized > 1 ? 1 + 5 * Math.log10(nilaiColiform / batasColiform) : nilaiColiformNormalized,
        nlaiPHAdjusted = nilaiPHAdjusted > 1 ? 1 + 5 * Math.log10(nilaiPHAdjusted) : nilaiPHAdjusted;

    var nlTSS = nlaiTSS,
        nlDO = nlaiDO,
        nlBOD = nlaiBOD,
        nlCOD = nlaiCOD,
        nlFosfat = nlaiFosfat,
        nlFecal = nlaiFecal,
        nlColiform = nlaiColiform,
        nlPHAdjusted = nlaiPHAdjusted;

    var nilaiRata = (nlTSS + nlDO + nlBOD + nlCOD + nlFosfat + nlFecal + nlColiform + nlPHAdjusted) / 8,
        nilaiMax = Math.max(nlTSS, nlDO, nlBOD, nlCOD, nlFosfat, nlFecal, nlColiform, nlPHAdjusted),
        nilaiRata2 = Math.pow(nilaiRata, 2),
        nilaiMax2 = Math.pow(nilaiMax, 2),
        nilaiPIJUser = Math.sqrt((nilaiRata2 + nilaiMax2) / 2);

    var statusMutuAirUser
    if (nilaiPIJUser <= 1) {
        statusMutuAirUser = "Memenuhi Baku Mutu";
    } else if (nilaiPIJUser <= 5) {
        statusMutuAirUser = "Tercemar Ringan";
    } else if (nilaiPIJUser <= 10) {
        statusMutuAirUser = "Tercemar Sedang";
    } else if (nilaiPIJUser > 10) {
        statusMutuAirUser = "Tercemar Berat";
    }

    $("#status_mutu_air_sma_user").val(statusMutuAirUser);
    $("#nilai_pij_sma_user").val(nilaiPIJUser);
}

// ================ START: PERHITUNGAN EKSISTING BOD USER  ==================
function hitungNilaiBPMUser() {
    var konsentrasi_baku_mutu_maksimum_eksisting_user = $("#konsentrasi_baku_mutu_maksimum_eksisting_user").val();
    var debit_air_sungai_maksimum_eksisting_user = $("#debit_air_sungai_maksimum_eksisting_user").val();
    var faktor_k_maksimum_eksisting_user = $("#faktor_k_maksimum_eksisting_user").val();

    var nilaiBpmUser = konsentrasi_baku_mutu_maksimum_eksisting_user * debit_air_sungai_maksimum_eksisting_user * faktor_k_maksimum_eksisting_user;

    $("#bpm_eksisting_user").val(nilaiBpmUser);
}

function hitungNilaiBPAUser() {
    var konsentrasi_aktual_eksisting_user = $("#konsentrasi_aktual_eksisting_user").val();
    var debit_air_sungai_aktual_eksisting_user = $("#debit_air_sungai_aktual_eksisting_user").val();
    var faktor_k_aktual_eksisting_user = $("#faktor_k_aktual_eksisting_user").val();

    var nilaiBpaUser = konsentrasi_aktual_eksisting_user * debit_air_sungai_aktual_eksisting_user * faktor_k_aktual_eksisting_user;

    var hitungDtbpButton = $("#hitung-dtbp-button");
    hitungDtbpButton.prop('disabled', false);

    $("#bpa_eksisting_user").val(nilaiBpaUser);
}

function hitungNilaiDTBPUser() {
    var bpm_eksisting_user = $("#bpm_eksisting_user").val();
    var bpa_eksisting_user = $("#bpa_eksisting_user").val();

    var nilaiDtbpUser = bpm_eksisting_user - bpa_eksisting_user;

    $("#dtbp_eksisting_user").val(nilaiDtbpUser);
}

// ================ START: PERHITUNGAN POTENSIAL DOMESTIK USER  ===============
function hitungNilaiPBPDomestikUser() {
    var jumlah_penduduk_domestik_user = $("#jumlah_penduduk_domestik_user").val();
    var faktor_emisi_domestik_user = $("#faktor_emisi_domestik_user").val();
    var rasio_ekivalen_kota_domestik_user = $("#rasio_ekivalen_kota_domestik_user").val();
    var koefisien_transfer_beban_domestik_user = $("#koefisien_transfer_beban_domestik_user").val();
    var faktor_konversi_domestik_user = $("#faktor_konversi_domestik_user").val();
    var nilai_alpha_domestik_user = $("#nilai_alpha_domestik_user").val();

    var nilaiPBPDomestikUser = (jumlah_penduduk_domestik_user * faktor_emisi_domestik_user * rasio_ekivalen_kota_domestik_user * koefisien_transfer_beban_domestik_user * nilai_alpha_domestik_user) / faktor_konversi_domestik_user;

    $("#pbp_domestik_domestik_user").val(nilaiPBPDomestikUser);
}
// ================ START: PERHITUNGAN POTENSIAL PERTANIAN USER  ===============
$(document).ready(function () {
    $("#jenis_pertanian_pertanian_user, #nama_parameter_pertanian_user").change(function () {
        var jenisPertanianPertanianUser = $("#jenis_pertanian_pertanian_user").val();
        var namaParameterPertanianUser = $("#nama_parameter_pertanian_user").val();

        if (jenisPertanianPertanianUser === "sawah") {
            var jenis_pertanian_pertanian_user = 0.1;
        } else if (jenisPertanianPertanianUser === "palawija") {
            var jenis_pertanian_pertanian_user = 0.01;
        } else if (jenisPertanianPertanianUser === "perkebunan lain") {
            var jenis_pertanian_pertanian_user = 0.01;
        }

        var parameter_pertanian_user;
        if (jenisPertanianPertanianUser === "sawah" && namaParameterPertanianUser === "tss") {
            parameter_pertanian_user = 0.4;
        } else if (jenisPertanianPertanianUser === "sawah" && namaParameterPertanianUser === "bod") {
            parameter_pertanian_user = 225;
        } else if (jenisPertanianPertanianUser === "sawah" && namaParameterPertanianUser === "cod") {
            parameter_pertanian_user = 337.5;
        } else if (jenisPertanianPertanianUser === "sawah" && namaParameterPertanianUser === "total-n") {
            parameter_pertanian_user = 20;
        } else if (jenisPertanianPertanianUser === "sawah" && namaParameterPertanianUser === "total-p") {
            parameter_pertanian_user = 10;
        } else if (jenisPertanianPertanianUser === "palawija" && namaParameterPertanianUser === "tss") {
            parameter_pertanian_user = 2.2;
        } else if (jenisPertanianPertanianUser === "palawija" && namaParameterPertanianUser === "bod") {
            parameter_pertanian_user = 125;
        } else if (jenisPertanianPertanianUser === "palawija" && namaParameterPertanianUser === "cod") {
            parameter_pertanian_user = 187.5;
        } else if (jenisPertanianPertanianUser === "palawija" && namaParameterPertanianUser === "total-n") {
            parameter_pertanian_user = 10;
        } else if (jenisPertanianPertanianUser === "palawija" && namaParameterPertanianUser === "total-p") {
            parameter_pertanian_user = 5;
        } else if (jenisPertanianPertanianUser === "perkebunan lain" && namaParameterPertanianUser === "tss") {
            parameter_pertanian_user = 0.6;
        } else if (jenisPertanianPertanianUser === "perkebunan lain" && namaParameterPertanianUser === "bod") {
            parameter_pertanian_user = 32.5;
        } else if (jenisPertanianPertanianUser === "perkebunan lain" && namaParameterPertanianUser === "cod") {
            parameter_pertanian_user = 48.75;
        } else if (jenisPertanianPertanianUser === "perkebunan lain" && namaParameterPertanianUser === "total-n") {
            parameter_pertanian_user = 3;
        } else if (jenisPertanianPertanianUser === "perkebunan lain" && namaParameterPertanianUser === "total-p") {
            parameter_pertanian_user = 1.5;
        }

        $("#faktor_pengali_pertanian_user").val(jenis_pertanian_pertanian_user);
        $("#faktor_emisi_pertanian_user").val(parameter_pertanian_user);
    });
});

function hitungNilaiPBPPertanianUser() {
    var faktor_emisi_pertanian_user = $("#faktor_emisi_pertanian_user").val();
    var luas_lahan_pertanian_user = $("#luas_lahan_pertanian_user").val();
    var faktor_pengali_pertanian_user = $("#faktor_pengali_pertanian_user").val();
    var lama_musim_tanam_pertanian_user = $("#lama_musim_tanam_pertanian_user").val();

    var nilaiPBPPertanianUser = (faktor_emisi_pertanian_user * luas_lahan_pertanian_user * faktor_pengali_pertanian_user) / lama_musim_tanam_pertanian_user;
    $("#pbp_pertanian_pertanian_user").val(nilaiPBPPertanianUser);
}
// ================ START: PERHITUNGAN POTENSIAL PETERNAKAN USER  ===============
$(document).ready(function () {
    $("#jenis_ternak_peternakan_user, #nama_parameter_peternakan_user").change(function () {
        var jenisTernakpeternakan_user = $("#jenis_ternak_peternakan_user").val();
        var namaParameterpeternakan_user = $("#nama_parameter_peternakan_user").val();

        var parameter_peternakan_user;
        if (jenisTernakpeternakan_user === "sapi" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 292;
        } else if (jenisTernakpeternakan_user === "sapi" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 717;
        } else if (jenisTernakpeternakan_user === "sapi" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 0.933;
        } else if (jenisTernakpeternakan_user === "sapi" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.153;
        } else if (jenisTernakpeternakan_user === "domba" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 55.7;
        } else if (jenisTernakpeternakan_user === "domba" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 136;
        } else if (jenisTernakpeternakan_user === "domba" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 0.278;
        } else if (jenisTernakpeternakan_user === "domba" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.063;
        } else if (jenisTernakpeternakan_user === "ayam" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 2.36;
        } else if (jenisTernakpeternakan_user === "ayam" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 5.59;
        } else if (jenisTernakpeternakan_user === "ayam" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 0.002;
        } else if (jenisTernakpeternakan_user === "ayam" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.003;
        } else if (jenisTernakpeternakan_user === "itik" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 0.88;
        } else if (jenisTernakpeternakan_user === "itik" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 2.22;
        } else if (jenisTernakpeternakan_user === "itik" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 0.001;
        } else if (jenisTernakpeternakan_user === "itik" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.005;
        } else if (jenisTernakpeternakan_user === "kerbau" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 207;
        } else if (jenisTernakpeternakan_user === "kerbau" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 530;
        } else if (jenisTernakpeternakan_user === "kerbau" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 2.6;
        } else if (jenisTernakpeternakan_user === "kerbau" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.39;
        } else if (jenisTernakpeternakan_user === "kuda" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 226;
        } else if (jenisTernakpeternakan_user === "kuda" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 558;
        } else if (jenisTernakpeternakan_user === "kuda" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 38.083;
        } else if (jenisTernakpeternakan_user === "kuda" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.306;
        } else if (jenisTernakpeternakan_user === "kambing" && namaParameterpeternakan_user === "bod") {
            parameter_peternakan_user = 34.1;
        } else if (jenisTernakpeternakan_user === "kambing" && namaParameterpeternakan_user === "cod") {
            parameter_peternakan_user = 92.9;
        } else if (jenisTernakpeternakan_user === "kambing" && namaParameterpeternakan_user === "total-n") {
            parameter_peternakan_user = 1.624;
        } else if (jenisTernakpeternakan_user === "kambing" && namaParameterpeternakan_user === "total-p") {
            parameter_peternakan_user = 0.115;
        }

        $("#faktor_emisi_peternakan_user").val(parameter_peternakan_user);
    });
});

function hitungNilaiPBPPeternakanUser() {
    var persentase_limbah_peternakan_user = $("#persentase_limbah_peternakan_user").val();
    var faktor_pengali_peternakan_user = $("#faktor_pengali_peternakan_user").val();
    var jumlah_ternak_peternakan_user = $("#jumlah_ternak_peternakan_user").val();
    var faktor_emisi_peternakan_user = $("#faktor_emisi_peternakan_user").val();

    var nilaiPBPPeternakanUser = (faktor_emisi_peternakan_user * jumlah_ternak_peternakan_user * persentase_limbah_peternakan_user) / faktor_pengali_peternakan_user;
    $("#pbp_peternakan_peternakan_user").val(nilaiPBPPeternakanUser);
}

// ================ START: PERHITUNGAN POTENSIAL INDUSTRI 1 USER  =================
function hitungNilaiPBPindustri1User() {
    var param_1_formula_1_industri_1 = $("#param_1_formula_1_industri_1").val();
    var param_2_formula_1_industri_1 = $("#param_2_formula_1_industri_1").val();
    var param_3_formula_1_industri_1 = $("#param_3_formula_1_industri_1").val();
    var param_4_formula_1_industri_1 = $("#param_4_formula_1_industri_1").val();
    var param_5_formula_1_industri_1 = $("#param_5_formula_1_industri_1").val();

    var nilaiPBPindustri_1 = param_1_formula_1_industri_1 * param_2_formula_1_industri_1 * param_3_formula_1_industri_1 * param_4_formula_1_industri_1 * param_5_formula_1_industri_1;
    $("#pbp_industri_formula_1_industri_1").val(nilaiPBPindustri_1);
}

// ================ START: PERHITUNGAN POTENSIAL INDUSTRI 2 USER  =================
function hitungNilaiPBPindustri2User() {
    var param_1_formula_2_industri_2 = $("#param_1_formula_2_industri_2").val();
    var param_2_formula_2_industri_2 = $("#param_2_formula_2_industri_2").val();
    var param_3_formula_2_industri_2 = $("#param_3_formula_2_industri_2").val();
    var param_4_formula_2_industri_2 = $("#param_4_formula_2_industri_2").val();

    var nilaiPBPindustri_2 = (param_1_formula_2_industri_2 * param_2_formula_2_industri_2 * param_3_formula_2_industri_2) / param_4_formula_2_industri_2;
    $("#pbp_industri_formula_2_industri_2").val(nilaiPBPindustri_2);
}

// ================ START: PERHITUNGAN POTENSIAL INDUSTRI 3 USER  =================
function hitungNilaiPBPindustri3User() {
    var param_1_formula_3_industri_3 = $("#param_1_formula_3_industri_3").val();
    var param_2_formula_3_industri_3 = $("#param_2_formula_3_industri_3").val();
    var param_3_formula_3_industri_3 = $("#param_3_formula_3_industri_3").val();

    var nilaiPBPindustri_3 = (param_1_formula_3_industri_3 * param_2_formula_3_industri_3) / param_3_formula_3_industri_3;
    $("#pbp_industri_formula_3_industri_3").val(nilaiPBPindustri_3);
}