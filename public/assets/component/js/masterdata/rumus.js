// ================== START: VARIABLE ================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ==================================

// ================== START: Ajax List ===============================
$(document).ready(function () {
    table = $('#table_rumus').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_rumus/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List =================================

// ================= START:Crud Master Rumus =========================
$(document).ready(function () {
    $(document).on('click', '.deleted_rumus_btn', function () {
        var rumusId = $(this).data('id');
        deletedRumus(rumusId);
    });

    function deletedRumus(rumusId) {
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
                    url: base_url + '/Master_rumus/deleted_rumus',
                    type: 'GET',
                    data: {
                        id_rumus: rumusId
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
// =============== END:Crud Master Rumus =============================

// ================== START: CLEAR Form ===============================
function addRumus() {
    $("[name='judul_rumus']").val("");
    $('.summernote').summernote('code', '');
}
// ================== END: CLEAR Form =================================