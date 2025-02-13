// ================== START: VARIABLE =================================
var base_url = $("#base_url").data('url');

$(document).ready(function () {
    getDataStatusmutuair();
    getDataIndexKualitasAir();
    getDataBebanPencemaranEksisting();
    getDataStatusmutuudara();
    getDataIndexKualitasUdara();
});

// ================== END: VARIABLE ===================================

// ================== START: STATUS MUTU AIR ==========================
function getDataStatusmutuair() {
    var filter = $('#filterstatusmutuair').val();
    $("#statusmutuair").html('');
    $.ajax({
        type: "POST",
        url: base_url + "/dashboard/chart_status_mutu_air",
        data: {
            filter: filter,
        },
        dataType: "JSON",
        success: function (response) {
            statusMutuAir(response)
        }
    });
}

function statusMutuAir(response) {
    const dataSource = {
        chart: {
            caption: "Status Mutu Air",
            formatnumberscale: "1",
            showvalues: "1",
            theme: "fusion",
            exportEnabled: "1",
        },
        categories: [{
            category: response.category
        }],
        dataset: response.dataset
    };
    FusionCharts.ready(function () {
        var myChart = new FusionCharts({
            type: "mscolumn3d",
            renderAt: "statusmutuair",
            width: "100%",
            height: "250%",
            dataFormat: "json",
            dataSource
        }).render();
    });
}
// ================== END: STATUS MUTU AIR ===========================

// ================== START: INDEX KUALITAS AIR ======================
function getDataIndexKualitasAir() {
    var filter = $('#filterindexkualitasair').val();
    $("#indexkualitasair").html('');
    $.ajax({
        type: "POST",
        url: base_url + "/dashboard/chart_index_kualitas_air",
        data: {
            filter: filter,
        },
        dataType: "JSON",
        success: function (response) {
            indexKualitasAir(response)
        }
    });
}

function indexKualitasAir(response) {
    const dataSource = {
        chart: {
            caption: "Indeks Kualitas Air",
            formatnumberscale: "1",
            showvalues: "1",
            theme: "fusion",
            exportEnabled: "1",
        },
        data: response.data
    };
    FusionCharts.ready(function () {
        var myChart = new FusionCharts({
            type: "line",
            renderAt: "indexkualitasair",
            width: "100%",
            height: "250%",
            dataFormat: "json",
            dataSource
        }).render();
    });
}

// ================== START: STATUS MUTU UDARA ==========================
function getDataStatusmutuudara() {
    var filter = $('#filterstatusmutuudara').val();
    $("#statusmutuudara").html('');
    $.ajax({
        type: "POST",
        url: base_url + "/dashboard/chart_status_mutu_udara",
        data: {
            filter: filter,
        },
        dataType: "JSON",
        success: function (response) {
            statusMutuUdara(response)
        }
    });
}

function statusMutuUdara(response) {
    const dataSource = {
        chart: {
            caption: "Status Mutu Udara",
            formatnumberscale: "1",
            showvalues: "1",
            theme: "fusion",
            exportEnabled: "1",
        },
        categories: [{
            category: response.category
        }],
        dataset: response.dataset
    };
    FusionCharts.ready(function () {
        var myChart = new FusionCharts({
            type: "mscolumn3d",
            renderAt: "statusmutuudara",
            width: "100%",
            height: "250%",
            dataFormat: "json",
            dataSource
        }).render();
    });
}
// ================== END: STATUS MUTU UDARA ===========================

// ================== START: INDEX KUALITAS UDARA ======================
function getDataIndexKualitasUdara() {
    var filter = $('#filterindexkualitasudara').val();
    $("#indexkualitasudara").html('');
    $.ajax({
        type: "POST",
        url: base_url + "/dashboard/chart_index_kualitas_udara",
        data: {
            filter: filter,
        },
        dataType: "JSON",
        success: function (response) {
            indexKualitasAir(response)
        }
    });
}

function indexKualitasUdara(response) {
    const dataSource = {
        chart: {
            caption: "Indeks Kualitas Udara",
            formatnumberscale: "1",
            showvalues: "1",
            theme: "fusion",
            exportEnabled: "1",
        },
        data: response.data
    };
    FusionCharts.ready(function () {
        var myChart = new FusionCharts({
            type: "line",
            renderAt: "indexkualitasudara",
            width: "100%",
            height: "250%",
            dataFormat: "json",
            dataSource
        }).render();
    });
}


// ================== END: INDEX KUALITAS UDARA ======================

// ================== START: BEBAN PENCEMARAN EKSISTING ============
function getDataBebanPencemaranEksisting()
{
    var filter = $('#filterbebanpencemaraneksisting').val();
    $('#bebanpencemaraneksisting').html('');
    $.ajax({
        type: "POST",
        url: base_url + "/dashboard/chart_beban_pencemaran_eksisting",
        data: {
            filter: filter,
        },
        dataType: "JSON",
        success: function (response) {
            BebanPencemaranEksiting(response)
        }
    });
}

function BebanPencemaranEksiting(response) {
    const dataSource = {
        chart: {
            caption: "Beban Pencemaran Eksisting BOD",
            formatnumberscale: "1",
            showvalues: "1",
            theme: "fusion",
            exportEnabled: "1",
        },
        categories: [{
            category: response.category
        }],
        dataset: response.dataset
    };
    FusionCharts.ready(function () {
        var myChart = new FusionCharts({
            type: "mscolumn3d",
            renderAt: "bebanpencemaraneksisting",
            width: "100%",
            height: "250%",
            dataFormat: "json",
            dataSource
        }).render();
    });
}
// ================== END: BEBAN PENCEMARAN EKSISTING ==============