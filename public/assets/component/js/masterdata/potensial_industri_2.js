// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_potensial_industri_2').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_potensial_industri_2/ajax_list',
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
        url: base_url + '/Master_potensial_industri_2/detail_parameter',
        type: 'GET',
        data: {
            id: parameterId
        },
        dataType: 'json',
        success: function (response) {
            var parameterData = response.row;
            $('#param_1_formula_2_detail').text(parameterData.param_1_formula_2);
            $('#param_2_formula_2_detail').text(parameterData.param_2_formula_2);
            $('#param_3_formula_2_detail').text(parameterData.param_3_formula_2);
            $('#param_4_formula_2_detail').text(parameterData.param_4_formula_2);
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
            url: base_url + '/Master_potensial_industri_2/show_updated',
            type: 'GET',
            data: {
                id: id
            },
            dataType: 'json',
            success: function (response) {
                var data = response.row;
                $('#id_update_potensial_industri_2').val(data.id);
                $('select[name="kecamatan"] option[value="' + data.kecamatan + '"]').prop('selected', true);
                $('#nama_perusahaan_update').val(data.nama_perusahaan);
                $('#param_1_formula_2_update').val(data.param_1_formula_2);
                $('#param_2_formula_2_update').val(data.param_2_formula_2);
                $('#param_3_formula_2_update').val(data.param_3_formula_2);
                $('#param_4_formula_2_update').val(data.param_4_formula_2);
                $('#pbp_industri_formula_2_update').val(data.pbp_industri_formula_2);
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
                    url: base_url + '/Master_potensial_industri_2/deleted',
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
function hitungNilaiPBPindustri2() {
    var param_1_formula_2_add = $("#param_1_formula_2_add").val();
    var param_2_formula_2_add = $("#param_2_formula_2_add").val();
    var param_3_formula_2_add = $("#param_3_formula_2_add").val();
    var param_4_formula_2_add = $("#param_4_formula_2_add").val();

    var nilaiPBPAdd = (param_1_formula_2_add * param_2_formula_2_add * param_3_formula_2_add) / param_4_formula_2_add;
    $("#pbp_industri_formula_2_add").val(nilaiPBPAdd);
}


$(document).ready(function () {
    ;
    var param_1_formula_2_add = $("#param_1_formula_2_add").eq(0);
    var param_2_formula_2_add = $("#param_2_formula_2_add").eq(0);
    var param_3_formula_2_add = $("#param_3_formula_2_add").eq(0);
    var hitungPotensialindustri2Button = $('#hitung-potensial-industri-2-button-add');
    [param_1_formula_2_add, param_2_formula_2_add, param_3_formula_2_add].forEach(function (input) {
        input.on('input', function () {
            var anyEmpty = [param_1_formula_2_add, param_2_formula_2_add, param_3_formula_2_add].some(function (input) {
                return input.val().trim() === '';
            });
            hitungPotensialindustri2Button.prop('disabled', anyEmpty);
        });
    });
});
// =============== END: PERHITUNGAN ADD  ==================

// =============== START: PERHITUNGAN UPDATE  ================
function hitungNilaiPBPindustri2Update() {
    var param_1_formula_2_update = $("#param_1_formula_2_update").val();
    var param_2_formula_2_update = $("#param_2_formula_2_update").val();
    var param_3_formula_2_update = $("#param_3_formula_2_update").val();
    var param_4_formula_2_update = $("#param_4_formula_2_update").val();

    var nilaiPBPupdate = (param_1_formula_2_update * param_2_formula_2_update * param_3_formula_2_update) / param_4_formula_2_update;
    $("#pbp_industri_formula_2_update").val(nilaiPBPupdate);
}

// =============== END: PERHITUNGAN UPDATE  ==================

// =============== START: CLEAR FORM ==================
function add() {
    $("#nama_perusahaan_add").val('');
    $("#param_2_formula_2_add").val('');
    $("#param_3_formula_2").val('');
    $("#pbp_industri_formula_2_add").val('');
    $("#hitung-potensial-industri-2-button-add").prop('disabled', true);
}
// =============== END: CLEAR FORM  ==================