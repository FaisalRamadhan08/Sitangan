// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_index_kualitas_air').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "columns": [
            {'data': 'nomor', orderable: false},
            {'data': 'tahun', orderable: false},
            {'data': 'memenuhi_baku_mutu', 'orderable': false, 'render': formatDecimal},
            {'data': 'tercemar_ringan', 'orderable': false, 'render': formatDecimal},
            {'data': 'tercemar_sedang', 'orderable': false, 'render': formatDecimal},
            {'data': 'tercemar_berat', 'orderable': false, 'render': formatDecimal},
            {
                'data': 'total',
                'orderable': false,
                'render': function (data, type, row) {
                    var total = (parseFloat(row.memenuhi_baku_mutu) * 70 / 100) +
                        (parseFloat(row.tercemar_ringan) * 50 / 100) +
                        (parseFloat(row.tercemar_sedang) * 30 / 100) +
                        (parseFloat(row.tercemar_berat) * 10 / 100);
                    return parseFloat(total).toFixed(2);
                }
            },
        ],
        "ajax": {
            "url": base_url + '/Master_index_kualitas_air/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });

    function formatDecimal(data, type, row) {
        if (type === 'display') {
            return parseFloat(data).toFixed(2);
        }
        return data;
    }
});
// ================== END: Ajax List ==================================