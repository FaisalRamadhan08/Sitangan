// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_users').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_users/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List ==================================

// ================== START: CLEAR Form ===============================
function addUser() {
    $("[name='nama']").val("");
    $("[name='email']").val("");
    $("[name='password']").val("");
}
// ================== END: CLEAR Form =================================

// ================= START:Crud Master Users ==========================
$(document).ready(function () {
    $(document).on('click', '.zoomable-image', function () {
        var imageUrl = $(this).attr('src');
        $('#zoomedImage').attr('src', imageUrl);
        $('#detailImagesModal').modal('show');
    });

    $(document).on('click', '.tampil_update_btn', function () {
        var usersId = $(this).data('id');
        updateUsers(usersId);
    });

    $(document).on('click', '.deleted_users_btn', function () {
        var usersId = $(this).data('id');
        deletedUsers(usersId);
    });

    function updateUsers(usersId) {
        $.ajax({
            url: base_url + '/Master_users/show_update_users',
            type: 'GET',
            data: {
                id_users: usersId
            },
            dataType: 'json',
            success: function (response) {
                var usersData = response.row;
                console.log(usersData);
                $('#id_update_master_user').val(usersData.id);
                $('#nama_update').val(usersData.nama);
                $('#email_update').val(usersData.email);
                $('#password_update').val("");
                $('select[name="status"] option[value="' + usersData.status + '"]').prop('selected', true);
                $('select[name="role"] option[value="' + usersData.role + '"]').prop('selected', true);
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }

    function deletedUsers(usersId) {
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
                    url: base_url + '/Master_users/deleted_users',
                    type: 'GET',
                    data: {
                        id_users: usersId
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
// =============== END:Crud Master Users ==============================