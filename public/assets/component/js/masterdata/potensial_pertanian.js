// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_potensial_pertanian').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_potensial_pertanian/ajax_list',
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
        url: base_url + '/Master_potensial_pertanian/detail_parameter',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#jenis_pertanian_detail').text(parameterData.jenis_pertanian);
            $('#nama_parameter_detail').text(parameterData.nama_parameter);
            $('#faktor_emisi_detail').text(parameterData.faktor_emisi);
            $('#luas_lahan_detail').text(parameterData.luas_lahan);
            $('#faktor_pengali_detail').text(parameterData.faktor_pengali);
            $('#lama_musim_tanam_detail').text(parameterData.lama_musim_tanam);
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
            url: base_url + '/Master_potensial_pertanian/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_potensial_pertanian').val(data.id);
                $('select[name="das"] option[value="' + data.das + '"]').prop('selected', true);
                $('select[name="titik_pantau"] option[value="' + data.titik_pantau + '"]').prop('selected', true);
                $('select[name="jenis_pertanian"] option[value="' + data.jenis_pertanian + '"]').prop('selected', true);
                $('select[name="nama_parameter"] option[value="' + data.nama_parameter + '"]').prop('selected', true);
                $('#faktor_emisi_update').val(data.faktor_emisi);
                $('#luas_lahan_update').val(data.luas_lahan);
                $('#faktor_pengali_update').val(data.faktor_pengali);
                $('#lama_musim_tanam_update').val(data.lama_musim_tanam);
                $('#pbp_pertanian_update').val(data.pbp_pertanian);
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
                    url: base_url + '/Master_potensial_pertanian/deleted',
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

// ================ START: GET VALUE CHANGE ==========================
$(document).ready(function () {
    $("#jenis_pertanian_add, #nama_parameter_add").change(function () {
        var jenisPertanianadd = $("#jenis_pertanian_add").val();
        var namaParameteradd = $("#nama_parameter_add").val();

        if (jenisPertanianadd === "sawah") {
            var jenis_pertanian_add = 0.1;
        } else if (jenisPertanianadd === "palawija") {
            var jenis_pertanian_add = 0.01;
        } else if (jenisPertanianadd === "perkebunan lain") {
            var jenis_pertanian_add = 0.01;
        }

        var parameter_add;
        if (jenisPertanianadd === "sawah" && namaParameteradd === "tss") {
            parameter_add = 0.4;
        } else if (jenisPertanianadd === "sawah" && namaParameteradd === "bod") {
            parameter_add = 225;
        } else if (jenisPertanianadd === "sawah" && namaParameteradd === "cod") {
            parameter_add = 337.5;
        } else if (jenisPertanianadd === "sawah" && namaParameteradd === "total-n") {
            parameter_add = 20;
        } else if (jenisPertanianadd === "sawah" && namaParameteradd === "total-p") {
            parameter_add = 10;
        } else if (jenisPertanianadd === "palawija" && namaParameteradd === "tss") {
            parameter_add = 2.2;
        } else if (jenisPertanianadd === "palawija" && namaParameteradd === "bod") {
            parameter_add = 125;
        } else if (jenisPertanianadd === "palawija" && namaParameteradd === "cod") {
            parameter_add = 187.5;
        } else if (jenisPertanianadd === "palawija" && namaParameteradd === "total-n") {
            parameter_add = 10;
        } else if (jenisPertanianadd === "palawija" && namaParameteradd === "total-p") {
            parameter_add = 5;
        } else if (jenisPertanianadd === "perkebunan lain" && namaParameteradd === "tss") {
            parameter_add = 0.6;
        } else if (jenisPertanianadd === "perkebunan lain" && namaParameteradd === "bod") {
            parameter_add = 32.5;
        } else if (jenisPertanianadd === "perkebunan lain" && namaParameteradd === "cod") {
            parameter_add = 48.75;
        } else if (jenisPertanianadd === "perkebunan lain" && namaParameteradd === "total-n") {
            parameter_add = 3;
        } else if (jenisPertanianadd === "perkebunan lain" && namaParameteradd === "total-p") {
            parameter_add = 1.5;
        }

        $("#faktor_pengali_add").val(jenis_pertanian_add);
        $("#faktor_emisi_add").val(parameter_add);
    });
});

$(document).ready(function () {
    $("#jenis_pertanian_update, #nama_parameter_update").change(function () {
        var jenisPertanianUpdate = $("#jenis_pertanian_update").val();
        var namaParameterUpdate = $("#nama_parameter_update").val();

        if (jenisPertanianUpdate === "sawah") {
            var jenis_pertanian_update = 0.1;
        } else if (jenisPertanianUpdate === "palawija") {
            var jenis_pertanian_update = 0.01;
        } else if (jenisPertanianUpdate === "perkebunan lain") {
            var jenis_pertanian_update = 0.01;
        }

        var parameter_update;
        if (jenisPertanianUpdate === "sawah" && namaParameterUpdate === "tss") {
            parameter_update = 0.4;
        } else if (jenisPertanianUpdate === "sawah" && namaParameterUpdate === "bod") {
            parameter_update = 225;
        } else if (jenisPertanianUpdate === "sawah" && namaParameterUpdate === "cod") {
            parameter_update = 337.5;
        } else if (jenisPertanianUpdate === "sawah" && namaParameterUpdate === "total-n") {
            parameter_update = 20;
        } else if (jenisPertanianUpdate === "sawah" && namaParameterUpdate === "total-p") {
            parameter_update = 10;
        } else if (jenisPertanianUpdate === "palawija" && namaParameterUpdate === "tss") {
            parameter_update = 2.2;
        } else if (jenisPertanianUpdate === "palawija" && namaParameterUpdate === "bod") {
            parameter_update = 125;
        } else if (jenisPertanianUpdate === "palawija" && namaParameterUpdate === "cod") {
            parameter_update = 187.5;
        } else if (jenisPertanianUpdate === "palawija" && namaParameterUpdate === "total-n") {
            parameter_update = 10;
        } else if (jenisPertanianUpdate === "palawija" && namaParameterUpdate === "total-p") {
            parameter_update = 5;
        } else if (jenisPertanianUpdate === "perkebunan lain" && namaParameterUpdate === "tss") {
            parameter_update = 0.6;
        } else if (jenisPertanianUpdate === "perkebunan lain" && namaParameterUpdate === "bod") {
            parameter_update = 32.5;
        } else if (jenisPertanianUpdate === "perkebunan lain" && namaParameterUpdate === "cod") {
            parameter_update = 48.75;
        } else if (jenisPertanianUpdate === "perkebunan lain" && namaParameterUpdate === "total-n") {
            parameter_update = 3;
        } else if (jenisPertanianUpdate === "perkebunan lain" && namaParameterUpdate === "total-p") {
            parameter_update = 1.5;
        }

        $("#faktor_pengali_update").val(jenis_pertanian_update);
        $("#faktor_emisi_update").val(parameter_update);
    });
});
// ================ END: GET VALUE CHANGE ============================

// =============== START: PERHITUNGAN ADD  ===========================
function hitungNilaiPBPPertanian() {
    var faktor_emisi_add = $("#faktor_emisi_add").val();
    var luas_lahan_add = $("#luas_lahan_add").val();
    var faktor_pengali_add = $("#faktor_pengali_add").val();
    var lama_musim_tanam_add = $("#lama_musim_tanam_add").val();

    var nilaiPBPAdd = (faktor_emisi_add * luas_lahan_add * faktor_pengali_add) / lama_musim_tanam_add;
    $("#pbp_pertanian_add").val(nilaiPBPAdd);
}


$(document).ready(function () {
    ;
    var luas_lahan_add = $("#luas_lahan_add").eq(0);
    var lama_musim_tanam_add = $("#lama_musim_tanam_add").eq(0);
    var hitungPotensialpertanianButton = $('#hitung-potensial-pertanian-button');
    [lama_musim_tanam_add, luas_lahan_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [lama_musim_tanam_add, luas_lahan_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungPotensialpertanianButton.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN ADD  ==================

// =============== START: PERHITUNGAN UPDATE  ================
function hitungNilaiPBPPertanianUpdate() {
    var faktor_emisi_update = $("#faktor_emisi_update").val();
    var luas_lahan_update = $("#luas_lahan_update").val();
    var faktor_pengali_update = $("#faktor_pengali_update").val();
    var lama_musim_tanam_update = $("#lama_musim_tanam_update").val();

    var nilaiPBPupdate = (faktor_emisi_update * luas_lahan_update * faktor_pengali_update) / lama_musim_tanam_update;
    $("#pbp_pertanian_update").val(nilaiPBPupdate);
}
// =============== END: PERHITUNGAN UPDATE  ==================

// =============== START: CLEAR FORM ==================
function add() {
    $("#jenis_pertanian_add").val('');
    $("#nama_parameter_add").val('');
    $("#faktor_emisi_add").val('');
    $("#luas_lahan_add").val('');
    $("#faktor_pengali_add").val('');
    $("#lama_musim_tanam_add").val('');
    $("#pbp_pertanian_add").val('');
    $("#hitung-potensial-pertanian-button").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================