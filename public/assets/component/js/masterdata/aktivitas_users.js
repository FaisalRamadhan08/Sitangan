// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_aktivitas').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_aktivitas/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List ==================================