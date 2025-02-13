// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_status_mutu_air').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_status_mutu_air/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List ==================================

// ================= START:CRUD ======================================
$(document).ready(function () {
    $(document).on('click', '.tampil_update_btn', function () {
        var statusMutuId = $(this).data('id');
        updateStatusMutuAir(statusMutuId);
    });

    $(document).on('click', '.deleted_status_mutu_btn', function () {
        var statusMutuId = $(this).data('id');
        deletedStatusMutuAir(statusMutuId);
    });

    function updateStatusMutuAir(statusMutuId) {
        $.ajax({
            url: base_url + '/Master_status_mutu_air/show_updated_status_mutu_air',
            type: 'GET',
            data: {
                id_status_mutu_air: statusMutuId
            },
            dataType: 'json',
            success: function (response) {
                var statusMutuData = response.row;
                $('#id_update_status_mutu_air').val(statusMutuData.id);
                $('select[name="nama_sungai"] option[value="' + statusMutuData.nama_sungai + '"]').prop('selected', true);
                $('select[name="titik_pantau"] option[value="' + statusMutuData.titik_pantau + '"]').prop('selected', true);
                $('#debit').val(statusMutuData.debit);
                $('#nilai_ph').val(statusMutuData.nilai_ph);
                $('#do').val(statusMutuData.do);
                $('#bod').val(statusMutuData.bod);
                $('#cod').val(statusMutuData.cod);
                $('#tss').val(statusMutuData.tss);
                $('#no3_n').val(statusMutuData.no3_n);
                $('#t_phosphat').val(statusMutuData.t_phosphat);
                $('#fecal_coli').val(statusMutuData.fecal_coli);
                $('#status_mutu_air').val(statusMutuData.status_mutu_air);
                $('#nilai_pij').val(statusMutuData.nilai_pij);
                $('#latitude').val(statusMutuData.latitude);
                $('#longitude').val(statusMutuData.longitude);
                var imagePath = base_url + '/assets/images/gis/' + statusMutuData.gambar;
                var videoPath = base_url + '/assets/video/gis/' + statusMutuData.video;
                if (statusMutuData.gambar === "") {
                    var defaultImages = base_url + '/assets/images/default/default.jpg'
                    $('#images').attr('src', defaultImages);
                } else {
                    $('#images').attr('src', imagePath);
                }

                if (statusMutuData.video === "") {
                    var defaultVideo = base_url + '/assets/video/default/default.mp4'
                    $('#videoPlayer').attr('src', defaultVideo);
                } else {
                    $('#videoPlayer').attr('src', videoPath);
                }
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function deletedStatusMutuAir(statusMutuId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, keep it'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: base_url + '/Master_status_mutu_air/deleted_status_mutu_air',
                    type: 'GET',
                    data: {
                        id_status_mutu_air: statusMutuId
                    },
                    dataType: 'json',
                    success: function (response) {
                        if (response.success) {
                            table.ajax.reload(null, false);
                            Swal.fire({
                                title: 'Success!',
                                text: 'Deleted data successfully!',
                                icon: 'success',
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Deleted data failed!',
                                icon: 'error',
                            });
                            table.ajax.reload(null, false);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            }
        })
    }
});
// =============== END:CRUD ==========================================

// =============== START: OTHER =======================================
function closeModal() {
    location.reload();
}
// =============== END: OTHER =========================================

// =============== START: PERHITUNGAN STATUS MURU AIR  ================
function hitungStatusMutuAir() {
    var batasTSS = 50,
        batasDO = 4,
        batasBOD = 3,
        batasCOD = 25,
        batasFosfat = 0.2,
        batasFecal = 1000,
        batasColiform = 10;

    var nilaiPH = $("#nilai_ph_add").val(),
        nilaiDO = $("#do_add").val(),
        nilaiBOD = $("#bod_add").val(),
        nilaiCOD = $("#cod_add").val(),
        nilaiTSS = $("#tss_add").val(),
        nilaiColiform = $("#no3_n_add").val(),
        nilaiFosfat = $("#t_phosphat_add").val(),
        nilaiFecal = $("#fecal_coli_add").val();
    nama_sungai = $("#nama_sungai_add").val();
    titik_pantau = $("#titik_pantau_add").val();

    var mergeNamaSungaiAndTitikPantau = (nama_sungai + titik_pantau);

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
        nilaiPIJ = Math.sqrt((nilaiRata2 + nilaiMax2) / 2);

    var statusMutuAir;
    if (nilaiPIJ <= 1) {
        statusMutuAir = "Memenuhi Baku Mutu";
    } else if (nilaiPIJ <= 5) {
        statusMutuAir = "Tercemar Ringan";
    } else if (nilaiPIJ <= 10) {
        statusMutuAir = "Tercemar Sedang";
    } else if (nilaiPIJ > 10) {
        statusMutuAir = "Tercemar Berat";
    }

    switch (mergeNamaSungaiAndTitikPantau) {
        case "cisangkanhulu":
            latitude = -6.871514232272994;
            longitude = 107.538182987135;
            break;
        case "cisangkantengah":
            latitude = -6.8922302930255634;
            longitude = 107.5265651049577;
            break;
        case "cisangkanhilir":
            latitude = -6.918512247368159;
            longitude = 107.53326709451693;
            break;

        case "cibaligohulu":
            latitude = -6.893707270014225;
            longitude = 107.55879626836588;
            break;
        case "cibaligotengah":
            latitude = -6.9088573962973925;
            longitude = 107.55158621118683;
            break;
        case "cibaligohilir":
            latitude = -6.924049642147064;
            longitude = 107.54838358331773;
            break;

        case "cibeureumhulu":
            latitude = -6.909487927894575;
            longitude = 107.5694019071383;
            break;
        case "cibeureumtengah":
            latitude = -6.920990783647108;
            longitude = 107.56471802193377;
            break;
        case "cibeureumhilir":
            latitude = -6.934384859229158;
            longitude = 107.56160542413389;
            break;

        case "cibabathulu":
            latitude = -6.898155218873863;
            longitude = 107.56130218505861;
            break;
        case "cibabattengah":
            latitude = -6.9127598804098715;
            longitude = 107.556105763942;
            break;
        case "cibabathilir":
            latitude = -6.9266313367697885;
            longitude = 107.55003204034199;
            break;

        case "cimahihulu":
            latitude = -6.857440429862051;
            longitude = 107.563101237589;
            break;
        case "cimahitengah":
            latitude = -6.886890406752077;
            longitude = 107.54032504976779;
            break;
        case "cimahihilir":
            latitude = -6.919167390622956;
            longitude = 107.5396920502396;
            break;
    }

    $("#latitude_add").val(latitude);
    $("#longitude_add").val(longitude);
    $("#status_mutu_air_add").val(statusMutuAir);
    $("#nilai_pij_add").val(nilaiPIJ);
}

function hitungStatusMutuAirUpdate() {
    var batasTSS = 50,
        batasDO = 4,
        batasBOD = 3,
        batasCOD = 25,
        batasFosfat = 0.2,
        batasFecal = 1000,
        batasColiform = 10;

    var nilaiPH = $("#nilai_ph").val(),
        nilaiDO = $("#do").val(),
        nilaiBOD = $("#bod").val(),
        nilaiCOD = $("#cod").val(),
        nilaiTSS = $("#tss").val(),
        nilaiColiform = $("#no3_n").val(),
        nilaiFosfat = $("#t_phosphat").val(),
        nilaiFecal = $("#fecal_coli").val();

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
        nilaiPIJ = Math.sqrt((nilaiRata2 + nilaiMax2) / 2);

    var statusMutuAir;
    if (nilaiPIJ <= 1) {
        statusMutuAir = "Memenuhi Baku Mutu";
    } else if (nilaiPIJ <= 5) {
        statusMutuAir = "Tercemar Ringan";
    } else if (nilaiPIJ <= 10) {
        statusMutuAir = "Tercemar Sedang";
    } else if (nilaiPIJ > 10) {
        statusMutuAir = "Tercemar Berat";
    }

    $("#status_mutu_air").val(statusMutuAir);
    $("#nilai_pij").val(nilaiPIJ);
}

$(document).ready(function () {
    var debitInput = $('#debit_add').eq(0);
    var nilaiPhInput = $('#nilai_ph_add').eq(0);
    var doInput = $('#do_add').eq(0);
    var bodInput = $('#bod_add').eq(0);
    var codInput = $('#cod_add').eq(0);
    var tssInput = $('#tss_add').eq(0);
    var no3nInput = $('#no3_n_add').eq(0);
    var tPhosphatInput = $('#t_phosphat_add').eq(0);
    var fecalColiInput = $('#fecal_coli_add').eq(0);
    var hitungButton = $('#hitung-button');
    [debitInput, nilaiPhInput, doInput, bodInput, codInput, tssInput, no3nInput, tPhosphatInput, fecalColiInput].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [debitInput, nilaiPhInput, doInput, bodInput, codInput, tssInput, no3nInput, tPhosphatInput, fecalColiInput].some(function (input) {
                return input.val().trim() === '';
            });
            hitungButton.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN STATUS MURU AIR  ==================

// ============== STAR: DETAIL PARAMETER ==============================
$(document).on('click', '.tampil_detail_btn', function () {
    var parameterId = $(this).data('id');
    detailParameter(parameterId);
});

function detailParameter(parameterId) {
    $.ajax({
        url: base_url + '/Master_status_mutu_air/detail_parameter_titik_pantau',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#debit_detail').text(parameterData.debit);
            $('#nilai_ph_detail').text(parameterData.nilai_ph);
            $('#do_detail').text(parameterData.do);
            $('#bod_detail').text(parameterData.bod);
            $('#cod_detail').text(parameterData.cod);
            $('#tss_detail').text(parameterData.tss);
            $('#no3_n_detail').text(parameterData.no3_n);
            $('#t_phosphat_detail').text(parameterData.t_phosphat);
            $('#fecal_coli_detail').text(parameterData.fecal_coli);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
// ============== END: DETAIL PARAMETER ===============================