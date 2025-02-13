// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_potensial_industri_1').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_potensial_industri_1/ajax_list',
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
        url: base_url + '/Master_potensial_industri_1/detail_parameter',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#param_1_formula_1_detail').text(parameterData.param_1_formula_1);
            $('#param_2_formula_1_detail').text(parameterData.param_2_formula_1);
            $('#param_3_formula_1_detail').text(parameterData.param_3_formula_1);
            $('#param_4_formula_1_detail').text(parameterData.param_4_formula_1);
            $('#param_5_formula_1_detail').text(parameterData.param_5_formula_1);
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
            url: base_url + '/Master_potensial_industri_1/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_potensial_industri_1').val(data.id);
                $('select[name="kecamatan"] option[value="' + data.kecamatan + '"]').prop('selected', true);
                $('#nama_perusahaan_update').val(data.nama_perusahaan);
                $('#param_1_formula_1_update').val(data.param_1_formula_1);
                $('#param_2_formula_1_update').val(data.param_2_formula_1);
                $('#param_3_formula_1_update').val(data.param_3_formula_1);
                $('#param_4_formula_1_update').val(data.param_4_formula_1);
                $('#param_5_formula_1_update').val(data.param_5_formula_1);
                $('#pbp_industri_formula_1_update').val(data.pbp_industri_formula_1);
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
                    url: base_url + '/Master_potensial_industri_1/deleted',
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

// =============== START: PERHITUNGAN ADD  ===========================
function hitungNilaiPBPindustri1() {
    var param_1_formula_1_add = $("#param_1_formula_1_add").val();
    var param_2_formula_1_add = $("#param_2_formula_1_add").val();
    var param_3_formula_1_add = $("#param_3_formula_1_add").val();
    var param_4_formula_1_add = $("#param_4_formula_1_add").val();
    var param_5_formula_1_add = $("#param_5_formula_1_add").val();

    var nilaiPBPAdd = param_1_formula_1_add * param_2_formula_1_add * param_3_formula_1_add * param_4_formula_1_add * param_5_formula_1_add;
    $("#pbp_industri_formula_1_add").val(nilaiPBPAdd);
}


$(document).ready(function () {
    ;
    var param_1_formula_1_add = $("#param_1_formula_1_add").eq(0);
    var param_2_formula_1_add = $("#param_2_formula_1_add").eq(0);
    var param_3_formula_1_add = $("#param_3_formula_1_add").eq(0);
    var param_4_formula_1_add = $("#param_4_formula_1_add").eq(0);
    var param_5_formula_1_add = $("#param_5_formula_1_add").eq(0);
    var hitungPotensialindustri1Button = $('#hitung-potensial-industri-1-button-add');
    [param_1_formula_1_add, param_2_formula_1_add, param_3_formula_1_add, param_4_formula_1_add, param_5_formula_1_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [param_1_formula_1_add, param_2_formula_1_add, param_3_formula_1_add, param_4_formula_1_add, param_5_formula_1_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungPotensialindustri1Button.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN ADD  ==================

// =============== START: PERHITUNGAN UPDATE  ================
function hitungNilaiPBPindustri1Update() {
    var param_1_formula_1_update = $("#param_1_formula_1_update").val();
    var param_2_formula_1_update = $("#param_2_formula_1_update").val();
    var param_3_formula_1_update = $("#param_3_formula_1_update").val();
    var param_4_formula_1_update = $("#param_4_formula_1_update").val();
    var param_5_formula_1_update = $("#param_5_formula_1_update").val();

    var nilaiPBPupdate = param_1_formula_1_update * param_2_formula_1_update * param_3_formula_1_update * param_4_formula_1_update * param_5_formula_1_update;
    $("#pbp_industri_formula_1_update").val(nilaiPBPupdate);
}

// =============== END: PERHITUNGAN UPDATE  ==================

// =============== START: CLEAR FORM ==================
function add() {
    $("#nama_perusahaan_add").val('');
    $("#param_2_formula_1_add").val('');
    $("#param_3_formula_1_add").val('');
    $("#param_4_formula_1_add").val('');
    $("#param_5_formula_1_add").val('');
    $("#pbp_industri_formula_1_add").val('');
    $("#hitung-potensial-industri-1-button-add").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================