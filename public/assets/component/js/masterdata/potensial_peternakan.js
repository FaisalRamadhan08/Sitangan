// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_potensial_peternakan').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_potensial_peternakan/ajax_list',
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
        url: base_url + '/Master_potensial_peternakan/detail_parameter',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#jumlah_ternak_detail').text(parameterData.jumlah_ternak);
            $('#jenis_ternak_detail').text(parameterData.jenis_ternak);
            $('#nama_parameter_detail').text(parameterData.nama_parameter);
            $('#faktor_emisi_detail').text(parameterData.faktor_emisi);
            $('#persentase_limbah_detail').text(parameterData.persentase_limbah);
            $('#faktor_pengali_detail').text(parameterData.faktor_pengali);
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
            url: base_url + '/Master_potensial_peternakan/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_potensial_peternakan').val(data.id);
                $('select[name="das"] option[value="' + data.das + '"]').prop('selected', true);
                $('select[name="titik_pantau"] option[value="' + data.titik_pantau + '"]').prop('selected', true);
                $('select[name="jenis_ternak"] option[value="' + data.jenis_ternak + '"]').prop('selected', true);
                $('select[name="nama_parameter"] option[value="' + data.nama_parameter + '"]').prop('selected', true);
                $('#jumlah_ternak_update').val(data.jumlah_ternak);
                $('#faktor_emisi_update').val(data.faktor_emisi);
                $('#persentase_limbah_update').val(data.persentase_limbah);
                $('#faktor_pengali_update').val(data.faktor_pengali);
                $('#pbp_peternakan_update').val(data.pbp_peternakan);
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
                    url: base_url + '/Master_potensial_peternakan/deleted',
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
    $("#jenis_ternak_add, #nama_parameter_add").change(function () {
        var jenisTernakadd = $("#jenis_ternak_add").val();
        var namaParameteradd = $("#nama_parameter_add").val();

        var parameter_add;
        if (jenisTernakadd === "sapi" && namaParameteradd === "bod") {
            parameter_add = 292;
        } else if (jenisTernakadd === "sapi" && namaParameteradd === "cod") {
            parameter_add = 717;
        } else if (jenisTernakadd === "sapi" && namaParameteradd === "total-n") {
            parameter_add = 0.933;
        } else if (jenisTernakadd === "sapi" && namaParameteradd === "total-p") {
            parameter_add = 0.153;
        } else if (jenisTernakadd === "domba" && namaParameteradd === "bod") {
            parameter_add = 55.7;
        } else if (jenisTernakadd === "domba" && namaParameteradd === "cod") {
            parameter_add = 136;
        } else if (jenisTernakadd === "domba" && namaParameteradd === "total-n") {
            parameter_add = 0.278;
        } else if (jenisTernakadd === "domba" && namaParameteradd === "total-p") {
            parameter_add = 0.063;
        } else if (jenisTernakadd === "ayam" && namaParameteradd === "bod") {
            parameter_add = 2.36;
        } else if (jenisTernakadd === "ayam" && namaParameteradd === "cod") {
            parameter_add = 5.59;
        } else if (jenisTernakadd === "ayam" && namaParameteradd === "total-n") {
            parameter_add = 0.002;
        } else if (jenisTernakadd === "ayam" && namaParameteradd === "total-p") {
            parameter_add = 0.003;
        } else if (jenisTernakadd === "itik" && namaParameteradd === "bod") {
            parameter_add = 0.88;
        } else if (jenisTernakadd === "itik" && namaParameteradd === "cod") {
            parameter_add = 2.22;
        } else if (jenisTernakadd === "itik" && namaParameteradd === "total-n") {
            parameter_add = 0.001;
        } else if (jenisTernakadd === "itik" && namaParameteradd === "total-p") {
            parameter_add = 0.005;
        } else if (jenisTernakadd === "kerbau" && namaParameteradd === "bod") {
            parameter_add = 207;
        } else if (jenisTernakadd === "kerbau" && namaParameteradd === "cod") {
            parameter_add = 530;
        } else if (jenisTernakadd === "kerbau" && namaParameteradd === "total-n") {
            parameter_add = 2.6;
        } else if (jenisTernakadd === "kerbau" && namaParameteradd === "total-p") {
            parameter_add = 0.39;
        } else if (jenisTernakadd === "kuda" && namaParameteradd === "bod") {
            parameter_add = 226;
        } else if (jenisTernakadd === "kuda" && namaParameteradd === "cod") {
            parameter_add = 558;
        } else if (jenisTernakadd === "kuda" && namaParameteradd === "total-n") {
            parameter_add = 38.083;
        } else if (jenisTernakadd === "kuda" && namaParameteradd === "total-p") {
            parameter_add = 0.306;
        } else if (jenisTernakadd === "kambing" && namaParameteradd === "bod") {
            parameter_add = 34.1;
        } else if (jenisTernakadd === "kambing" && namaParameteradd === "cod") {
            parameter_add = 92.9;
        } else if (jenisTernakadd === "kambing" && namaParameteradd === "total-n") {
            parameter_add = 1.624;
        } else if (jenisTernakadd === "kambing" && namaParameteradd === "total-p") {
            parameter_add = 0.115;
        }
        
        $("#faktor_emisi_add").val(parameter_add);
    });
});

$(document).ready(function () {
   $("#jenis_ternak_update, #nama_parameter_update").change(function () {
        var jenisTernakupdate = $("#jenis_ternak_update").val();
        var namaParameterupdate = $("#nama_parameter_update").val();

        var parameter_update;
        if (jenisTernakupdate === "sapi" && namaParameterupdate === "bod") {
            parameter_update = 292;
        } else if (jenisTernakupdate === "sapi" && namaParameterupdate === "cod") {
            parameter_update = 717;
        } else if (jenisTernakupdate === "sapi" && namaParameterupdate === "total-n") {
            parameter_update = 0.933;
        } else if (jenisTernakupdate === "sapi" && namaParameterupdate === "total-p") {
            parameter_update = 0.153;
        } else if (jenisTernakupdate === "domba" && namaParameterupdate === "bod") {
            parameter_update = 55.7;
        } else if (jenisTernakupdate === "domba" && namaParameterupdate === "cod") {
            parameter_update = 136;
        } else if (jenisTernakupdate === "domba" && namaParameterupdate === "total-n") {
            parameter_update = 0.278;
        } else if (jenisTernakupdate === "domba" && namaParameterupdate === "total-p") {
            parameter_update = 0.063;
        } else if (jenisTernakupdate === "ayam" && namaParameterupdate === "bod") {
            parameter_update = 2.36;
        } else if (jenisTernakupdate === "ayam" && namaParameterupdate === "cod") {
            parameter_update = 5.59;
        } else if (jenisTernakupdate === "ayam" && namaParameterupdate === "total-n") {
            parameter_update = 0.002;
        } else if (jenisTernakupdate === "ayam" && namaParameterupdate === "total-p") {
            parameter_update = 0.003;
        } else if (jenisTernakupdate === "itik" && namaParameterupdate === "bod") {
            parameter_update = 0.88;
        } else if (jenisTernakupdate === "itik" && namaParameterupdate === "cod") {
            parameter_update = 2.22;
        } else if (jenisTernakupdate === "itik" && namaParameterupdate === "total-n") {
            parameter_update = 0.001;
        } else if (jenisTernakupdate === "itik" && namaParameterupdate === "total-p") {
            parameter_update = 0.005;
        } else if (jenisTernakupdate === "kerbau" && namaParameterupdate === "bod") {
            parameter_update = 207;
        } else if (jenisTernakupdate === "kerbau" && namaParameterupdate === "cod") {
            parameter_update = 530;
        } else if (jenisTernakupdate === "kerbau" && namaParameterupdate === "total-n") {
            parameter_update = 2.6;
        } else if (jenisTernakupdate === "kerbau" && namaParameterupdate === "total-p") {
            parameter_update = 0.39;
        } else if (jenisTernakupdate === "kuda" && namaParameterupdate === "bod") {
            parameter_update = 226;
        } else if (jenisTernakupdate === "kuda" && namaParameterupdate === "cod") {
            parameter_update = 558;
        } else if (jenisTernakupdate === "kuda" && namaParameterupdate === "total-n") {
            parameter_update = 38.083;
        } else if (jenisTernakupdate === "kuda" && namaParameterupdate === "total-p") {
            parameter_update = 0.306;
        } else if (jenisTernakupdate === "kambing" && namaParameterupdate === "bod") {
            parameter_update = 34.1;
        } else if (jenisTernakupdate === "kambing" && namaParameterupdate === "cod") {
            parameter_update = 92.9;
        } else if (jenisTernakupdate === "kambing" && namaParameterupdate === "total-n") {
            parameter_update = 1.624;
        } else if (jenisTernakupdate === "kambing" && namaParameterupdate === "total-p") {
            parameter_update = 0.115;
        }
        
        $("#faktor_emisi_update").val(parameter_update);
    });
});
// ================ END: GET VALUE CHANGE ============================

// =============== START: PERHITUNGAN ADD  ===========================
function hitungNilaiPBPPeternakan() {
    var persentase_limbah_add = $("#persentase_limbah_add").val();
    var faktor_pengali_add = $("#faktor_pengali_add").val();
    var jumlah_ternak_add = $("#jumlah_ternak_add").val();
    var faktor_emisi_add = $("#faktor_emisi_add").val();

    var nilaiPBPAdd = (faktor_emisi_add * jumlah_ternak_add * persentase_limbah_add) / faktor_pengali_add;
    $("#pbp_peternakan_add").val(nilaiPBPAdd);
}


$(document).ready(function () {
    ;
    var jumlah_ternak_add = $("#jumlah_ternak_add").eq(0);
    var hitungPotensialpeternakanButton = $('#hitung-potensial-peternakan-button-add');
    [jumlah_ternak_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [jumlah_ternak_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungPotensialpeternakanButton.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN ADD  ==================

// =============== START: PERHITUNGAN UPDATE  ================
function hitungNilaiPBPPertanianUpdate() {
    var persentase_limbah_update = $("#persentase_limbah_update").val();
    var faktor_pengali_update = $("#faktor_pengali_update").val();
    var jumlah_ternak_update = $("#jumlah_ternak_update").val();
    var faktor_emisi_update = $("#faktor_emisi_update").val();

    var nilaiPBPupdate = (faktor_emisi_update * jumlah_ternak_update * persentase_limbah_update) / faktor_pengali_update;
    $("#pbp_peternakan_update").val(nilaiPBPupdate);
}

// =============== END: PERHITUNGAN UPDATE  ==================

// =============== START: CLEAR FORM ==================
function add() {
    $("#jumlah_ternak_add").val('');
    $("#faktor_emisi_add").val('');
    $("#pbp_peternakan_add").val('');
    $("#hitung-potensial-peternakan-button").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================