// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');
// ================== END: VARIABLE ===================================

// ================== START: Ajax List ================================
$(document).ready(function () {
    table = $('#table_informasi_titik_pantau').DataTable({
        "processing": false,
        "serverSide": true,
        "aLengthMenu": [
            [5, 10, 20, 50, 100],
            [5, 10, 20, 50, 100]
        ],
        "order": [],
        "ajax": {
            "url": base_url + '/Master_informasi_titik_pantau/ajax_list',
            "type": "POST"
        },
        "columnDefs": [{
            "targets": [],
            "orderable": false,
        }, ],
    });
});
// ================== END: Ajax List ==================================

// =========== START:Crud Master Informasi Titik Pantau ===============
$(document).on('click', '.tampil_detail_btn', function () {
    var informasiId = $(this).data('id');
    detailInformasi(informasiId);
});

function detailInformasi(informasiId) {
    $.ajax({
        url: base_url + '/Master_informasi_titik_pantau/detail_informasi_titik_pantau',
        type: 'GET',
        data: {
            id_informasi_titik: informasiId
        },
        dataType: 'json',
        success: function (response) {
            var informasiData = response.row;
            var imagePath = base_url + '/assets/images/gis/' + informasiData.gambar;
            var videoPath = base_url + '/assets/video/gis/' + informasiData.video;
            if (informasiData.gambar === "") {
                var defaultImages = base_url + '/assets/images/default/default.jpg'
                $('#images').attr('src', defaultImages);
            } else {
                $('#images').attr('src', imagePath);
            }

            if (informasiData.video === "") {
                var defaultVideo = base_url + '/assets/video/default/default.mp4'
                $('#videoPlayer').attr('src', defaultVideo);
            } else {
                $('#videoPlayer').attr('src', videoPath);
            }
        },
        error: function (xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
// =============== END:Crud Master Informasi Titik Pantau ======================