// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_potensial_domestik').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_potensial_domestik/ajax_list',
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
        url: base_url + '/Master_potensial_domestik/detail_parameter',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#jumlah_penduduk_detail').text(parameterData.jumlah_penduduk);
            $('#faktor_emisi_detail').text(parameterData.faktor_emisi);
            $('#rasio_ekivalen_kota_detail').text(parameterData.rasio_ekivalen_kota);
            $('#koefisien_transfer_beban_detail').text(parameterData.koefisien_transfer_beban);
            $('#faktor_konversi_detail').text(parameterData.faktor_konversi);
            $('#nilai_alpha_detail').text(parameterData.nilai_alpha);
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
            url: base_url + '/Master_potensial_domestik/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_potensial_domestik').val(data.id);
                $('select[name="das"] option[value="' + data.das + '"]').prop('selected', true);
                $('select[name="titik_pantau"] option[value="' + data.titik_pantau + '"]').prop('selected', true);
                $('#jumlah_penduduk_update').val(data.jumlah_penduduk);
                $('select[name="faktor_emisi"] option[value="' + data.faktor_emisi + '"]').prop('selected', true);
                $('select[name="rasio_ekivalen_kota"] option[value="' + data.rasio_ekivalen_kota + '"]').prop('selected', true);
                $('select[name="koefisien_transfer_beban"] option[value="' + data.koefisien_transfer_beban + '"]').prop('selected', true);
                $('#faktor_konversi_update').val(data.faktor_konversi);
                $('#nilai_alpha_update').val(data.nilai_alpha);
                $('#pbp_domestik_update').val(data.pbp_domestik);
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
                    url: base_url + '/Master_potensial_domestik/deleted',
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

// =============== START: PERHITUNGAN ADD  ================
function hitungNilaiPBPDomestik() {
    var jumlah_penduduk_add = $("#jumlah_penduduk_add").val();
    var faktor_emisi_add = $("#faktor_emisi_add").val();
    var rasio_ekivalen_kota_add = $("#rasio_ekivalen_kota_add").val();
    var koefisien_transfer_beban_add = $("#koefisien_transfer_beban_add").val();
    var faktor_konversi_add = $("#faktor_konversi_add").val();
    var nilai_alpha_add = $("#nilai_alpha_add").val();

    var nilaiPBPAdd = (jumlah_penduduk_add * faktor_emisi_add * rasio_ekivalen_kota_add * koefisien_transfer_beban_add * nilai_alpha_add) / faktor_konversi_add;

    $("#pbp_domestik_add").val(nilaiPBPAdd);
}


$(document).ready(function () {
    var jumlah_penduduk_add = $("#jumlah_penduduk_add").eq(0);
    var nilai_alpha_add = $("#nilai_alpha_add").eq(0);
    var hitungPotensialDomestikButton = $('#hitung-potensial-domestik-button');
    [jumlah_penduduk_add, nilai_alpha_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [jumlah_penduduk_add, nilai_alpha_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungPotensialDomestikButton.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN ADD  ==================

// =============== START: PERHITUNGAN UPDATE  ================
function hitungNilaiPBPDomestikUpdate() {
    var jumlah_penduduk_update = $("#jumlah_penduduk_update").val();
    var faktor_emisi_update = $("#faktor_emisi_update").val();
    var rasio_ekivalen_kota_update = $("#rasio_ekivalen_kota_update").val();
    var koefisien_transfer_beban_update = $("#koefisien_transfer_beban_update").val();
    var faktor_konversi_update = $("#faktor_konversi_update").val();
    var nilai_alpha_update = $("#nilai_alpha_update").val();

    var nilaiPBPUpdate = (jumlah_penduduk_update * faktor_emisi_update * rasio_ekivalen_kota_update * koefisien_transfer_beban_update * nilai_alpha_update) / faktor_konversi_update;

    $("#pbp_domestik_update").val(nilaiPBPUpdate);
}
// =============== END: PERHITUNGAN UPDATE  ==================

// =============== START: CLEAR FORM ==================
function add() {
    $("#jumlah_penduduk_add").val('');
    $("#faktor_emisi_add").val('');
    $("#rasio_ekivalen_kota_add").val('');
    $("#koefisien_transfer_beban_add").val('');
    $("#nilai_alpha_add").val('');
    $("#pbp_domestik_add").val('');
    $("#hitung-potensial-domestik-button").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================