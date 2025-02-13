// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_beban_pemcemaran_eksisting_bod').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_beban_pencemaran_eksisting_bod/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List ==================================

// ============== STAR: DETAIL PARAMETER ==============================
$(document).on('click', '.tampil_detail_btn', function () {
    var parameterId = $(this).data('id');
    detailParameter(parameterId);
});

function detailParameter(parameterId) {
    $.ajax({
        url: base_url + '/Master_beban_pencemaran_eksisting_bod/detail_parameter_eksisting_bod',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#konsentrasi_baku_mutu_maksimum_detail').text(parameterData.konsentrasi_baku_mutu_maksimum);
            $('#debit_air_sungai_maksimum_detail').text(parameterData.debit_air_sungai_maksimum);
            $('#faktor_k_maksimum_detail').text(parameterData.faktor_k_maksimum);
            $('#bpm_detail').text(parameterData.bpm);
            $('#konsentrasi_aktual_detail').text(parameterData.konsentrasi_aktual);
            $('#debit_air_sungai_aktual_detail').text(parameterData.debit_air_sungai_aktual);
            $('#faktor_k_aktual_detail').text(parameterData.faktor_k_aktual);
            $('#bpa_detail').text(parameterData.bpa);
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
// ============== END: DETAIL PARAMETER ===============================

// ================= START:CRUD ======================================
$(document).ready(function () {
    $(document).on('click', '.tampil_update_btn', function () {
        var id = $(this).data('id');
        update(id);
    });

    $(document).on('click', '.deleted_btn', function () {
        var id = $(this).data('id');
        deleted(id);
    });

    function update(id) {
        $.ajax({
            url: base_url + '/Master_beban_pencemaran_eksisting_bod/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_eksisting_bod').val(data.id);
                $('select[name="nama_sungai"] option[value="' + data.nama_sungai + '"]').prop('selected', true);
                $('select[name="titik_pantau"] option[value="' + data.titik_pantau + '"]').prop('selected', true);
                $('#konsentrasi_baku_mutu_maksimum_update').val(data.konsentrasi_baku_mutu_maksimum);
                $('#debit_air_sungai_maksimum_update').val(data.debit_air_sungai_maksimum);
                $('#faktor_k_maksimum_update').val(data.faktor_k_maksimum);
                $('#bpm_update').val(data.bpm);
                $('#konsentrasi_aktual_update').val(data.konsentrasi_aktual);
                $('#debit_air_sungai_aktual_update').val(data.debit_air_sungai_aktual);
                $('#faktor_k_aktual_update').val(data.faktor_k_aktual);
                $('#bpa_update').val(data.bpa);
                $('#dtbp_update').val(data.dtbp);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function deleted(id) {
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
                    url: base_url + '/Master_beban_pencemaran_eksisting_bod/deleted',
                    type: 'GET',
                    data: {
                        id: id
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

// =============== START: PERHITUNGAN BEBAN PENCEMARAN EKSISTING BOD ADD  ================
function hitungNilaiBPM() {
    var konsentrasi_baku_mutu_maksimum_add = $("#konsentrasi_baku_mutu_maksimum_add").val();
    var debit_air_sungai_maksimum_add = $("#debit_air_sungai_maksimum_add").val();
    var faktor_k_maksimum_add = $("#faktor_k_maksimum_add").val();

    var nilaiBpmAdd = konsentrasi_baku_mutu_maksimum_add * debit_air_sungai_maksimum_add * faktor_k_maksimum_add;

    $("#bpm_add").val(nilaiBpmAdd);
}

function hitungNilaiBPA() {
    var konsentrasi_aktual_add = $("#konsentrasi_aktual_add").val();
    var debit_air_sungai_aktual_add = $("#debit_air_sungai_aktual_add").val();
    var faktor_k_aktual_add = $("#faktor_k_aktual_add").val();

    var nilaiBpaAdd = konsentrasi_aktual_add * debit_air_sungai_aktual_add * faktor_k_aktual_add;

    var hitungDtbpButton = $("#hitung-dtbp-button");
    hitungDtbpButton.prop('disabled', false);

    $("#bpa_add").val(nilaiBpaAdd);
}

function hitungNilaiDTBP() {
    var bpm_add = $("#bpm_add").val();
    var bpa_add = $("#bpa_add").val();

    var nilaiDtbp = bpm_add - bpa_add;

    $("#dtbp_add").val(nilaiDtbp);
}

$(document).ready(function () {
    var konsentrasi_baku_mutu_maksimum_add = $("#konsentrasi_baku_mutu_maksimum_add").eq(0);
    var debit_air_sungai_maksimum_add = $("#debit_air_sungai_maksimum_add").eq(0);
    var faktor_k_maksimum_add = $("#faktor_k_maksimum_add").eq(0);
    var hitungBpmButton = $('#hitung-bpm-button');
    [konsentrasi_baku_mutu_maksimum_add, debit_air_sungai_maksimum_add, faktor_k_maksimum_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [konsentrasi_baku_mutu_maksimum_add, debit_air_sungai_maksimum_add, faktor_k_maksimum_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungBpmButton.prop('disabled', anyEmpty);
        });
    });

    var konsentrasi_aktual_add = $("#konsentrasi_aktual_add").eq(0);
    var debit_air_sungai_aktual_add = $("#debit_air_sungai_aktual_add").eq(0);
    var faktor_k_aktual_add = $("#faktor_k_aktual_add").eq(0);
    var hitungBpaButton = $('#hitung-bpa-button');
    [konsentrasi_aktual_add, debit_air_sungai_aktual_add, faktor_k_aktual_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [konsentrasi_aktual_add, debit_air_sungai_aktual_add, faktor_k_aktual_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungBpaButton.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN BEBAN PENCEMARAN EKSISTING BOD ADD  ==================

// =============== START: PERHITUNGAN BEBAN PENCEMARAN EKSISTING BOD UPDATE  ================
function hitungNilaiBPMUpdate() {
    var konsentrasi_baku_mutu_maksimum_update = $("#konsentrasi_baku_mutu_maksimum_update").val();
    var debit_air_sungai_maksimum_update = $("#debit_air_sungai_maksimum_update").val();
    var faktor_k_maksimum_update = $("#faktor_k_maksimum_update").val();

    var nilaiBpmuUpdate = konsentrasi_baku_mutu_maksimum_update * debit_air_sungai_maksimum_update * faktor_k_maksimum_update;

    $("#bpm_update").val(nilaiBpmuUpdate);
}

function hitungNilaiBPAUpdate() {
    var konsentrasi_aktual_update = $("#konsentrasi_aktual_update").val();
    var debit_air_sungai_aktual_update = $("#debit_air_sungai_aktual_update").val();
    var faktor_k_aktual_update = $("#faktor_k_aktual_update").val();

    var nilaiBpaUpdate = konsentrasi_aktual_update * debit_air_sungai_aktual_update * faktor_k_aktual_update;

    var hitungDtbpButtonUpdate = $("#hitung-dtbp-button-update");
    hitungDtbpButtonUpdate.prop('disabled', false);

    $("#bpa_update").val(nilaiBpaUpdate);
}

function hitungNilaiDTBPUpdate() {
    var bpm_update = $("#bpm_update").val();
    var bpa_update = $("#bpa_update").val();

    var nilaiDtbpUpdate = bpm_update - bpa_update;

    $("#dtbp_update").val(nilaiDtbpUpdate);
}

$(document).ready(function () {
    var konsentrasi_baku_mutu_maksimum_update = $("#konsentrasi_baku_mutu_maksimum_update").eq(0);
    var debit_air_sungai_maksimum_update = $("#debit_air_sungai_maksimum_update").eq(0);
    var faktor_k_maksimum_update = $("#faktor_k_maksimum_update").eq(0);
    var hitungBpmButtonUpdate = $('#hitung-bpm-button-update');
    [konsentrasi_baku_mutu_maksimum_update, debit_air_sungai_maksimum_update, faktor_k_maksimum_update].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [konsentrasi_baku_mutu_maksimum_update, debit_air_sungai_maksimum_update, faktor_k_maksimum_update].some(function (input) {
                return input.val().trim() === '';
            });
            hitungBpmButtonUpdate.prop('disabled', anyEmpty);
        });
    });

    var konsentrasi_aktual_update = $("#konsentrasi_aktual_update").eq(0);
    var debit_air_sungai_aktual_update = $("#debit_air_sungai_aktual_update").eq(0);
    var faktor_k_aktual_update = $("#faktor_k_aktual_update").eq(0);
    var hitungBpaButtonUpdate = $('#hitung-bpa-button-update');
    [konsentrasi_aktual_update, debit_air_sungai_aktual_update, faktor_k_aktual_update].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [konsentrasi_aktual_update, debit_air_sungai_aktual_update, faktor_k_aktual_update].some(function (input) {
                return input.val().trim() === '';
            });
            hitungBpaButtonUpdate.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN BEBAN PENCEMARAN EKSISTING BOD UPDATE  ==================

// =============== START: CLEAR FORM ==================
function addBod() {
    $("#konsentrasi_baku_mutu_maksimum_add").val('');
    $("#debit_air_sungai_maksimum_add").val('');
    $("#konsentrasi_aktual_add").val('');
    $("#debit_air_sungai_aktual_add").val('');
    $("#bpa_add").val('');
    $("#bpm_add").val('');
    $("#dtbp_add").val('');
    $("#hitung-bpm-button").prop('disabled', true);
    $("#hitung-bpa-button").prop('disabled', true);
    $("#hitung-dtbp-button").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================