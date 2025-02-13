<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Sistem Informasi Geografis</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Sistem Informasi Geografis</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid dashboard-default-sec">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div id="map" style="width: 100%; height: 550px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var peta1 = L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoiZmFyYWF6YXAiLCJhIjoiY2wwbmo4Mm9oMWdlcTNyb2FhbTdzZWllaSJ9.ao75zdAbmYguTd2L21oKzQ', {
        maxZoom: 25,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1
    });

    var peta2 = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
        maxZoom: 25,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    });

    var peta3 = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 25,
        tileSize: 512,
        zoomOffset: -1
    });

    var peta4 = L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}', {
        maxZoom: 25,
        subdomains: ["mt0", "mt1", "mt2", "mt3"],
    });

    var map = L.map('map', {
        center: [-6.880244, 107.542076],
        zoom: 13,
        layers: [peta1],
    });

    var baseLayers = {
        'Default': peta1,
        'Satellite Maps': peta2,
        'OpenStreets Maps': peta3,
        'Terrain Maps': peta4,
    };

    var layerControl = L.control.layers(baseLayers).addTo(map);


    //menampilkan batas administrasi kecamatan cimahi utara
    $.getJSON("<?= base_url('assets/dataGis/adm-cimahiutara.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'yellow',
                    fillOpacity: 0.5,
                    weight: 0.5,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {
            layer.bindPopup("<b> Nama Kecamatan: </b>" + "Kecamatan Cimahi Utara", {
                maxHeight: 400
            });
        });
    });

    //menampilkan batas administrasi kecamatan cimahi tengah
    $.getJSON("<?= base_url('assets/dataGis/adm-cimahitengah.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'green',
                    fillOpacity: 0.5,
                    weight: 0.5,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Kecamatan: </b>" + "Kecamatan Cimahi Tengah", {
                maxHeight: 400
            });
        });
    });

    //menampilkan batas administrasi kecamatan cimahi selatan
    $.getJSON("<?= base_url('assets/dataGis/adm-cimahiselatan.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'red',
                    fillOpacity: 0.5,
                    weight: 0.5,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Kecamatan: </b>" + "Kecamatan Cimahi Selatan", {
                maxHeight: 400
            });
        });
    });


    //menampilkan polyline sungai Cisangkan
    $.getJSON("<?= base_url('/assets/dataGis/sungaiCisangkan.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cisangkan", {
                maxHeight: 400
            });
        });
    });

    //menampilkan polyline sungai Cimahi
    $.getJSON("<?= base_url('assets/dataGis/sungaiCimahi.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'brown',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cimahi", {
                maxHeight: 400
            });
        });
    });


    //menampilkan polyline sungai Cibaligo
    $.getJSON("<?= base_url('assets/dataGis/sungaiCibaligo.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'purple',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibaligo", {
                maxHeight: 400
            });
        });
    });

    //menampilkan polyline sungai Cilisung
    $.getJSON("<?= base_url('assets/dataGis/sungaiCilisung.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'cyan',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibabat", {
                maxHeight: 400
            });
        });
    });

    //menampilkan polyline sungai Cibeureum
    $.getJSON("<?= base_url('assets/dataGis/sungaiCibeureum.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'lime',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibeureum", {
                maxHeight: 400
            });
        });
    });

    //menampilkan titik PT.Logam Bima
    $.getJSON("<?= base_url('/assets/dataGis/PT.LogamBima.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Lokasi: </b>" + "PT. Logam Bima", {
                maxHeight: 400
            });
        });
    });

    //menampilkan titik kantor kelurahan cigugur tengah
    $.getJSON("<?= base_url('assets/dataGis/kelurahanCigugurTgh.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Lokasi: </b>" + "Kantor Kelurahan Cigugur Tengah", {
                maxHeight: 400
            });
        });
    });


    //menampilkan titik PT. Jenshiang
    $.getJSON("<?= base_url('assets/dataGis/PT.Jenshiang.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Lokasi: </b>" + "PT. Jenshiang Nusantara", {
                maxHeight: 400
            });
        });
    });

    //menampilkan titik perumahan pilar mas
    $.getJSON("<?= base_url('assets/dataGis/perumPilarMas.geojson') ?>", function(data) {
        geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    color: 'blue',
                    fillOpacity: 1,
                    weight: 4,
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {

            layer.bindPopup("<b> Nama Lokasi: </b>" + "Perumahan Pilar Mas", {
                maxHeight: 400
            });
        });
    });

    <?php foreach ($maps as $key => $value) { ?> L.marker([<?= $value['latitude'] ?>, <?= $value['longitude'] ?>]).addTo(map)
        <?php
        $gambar = $value['gambar'] ? "../assets/images/gis/{$value['gambar']}" : "../assets/images/default/default.jpg";
        $video = $value['video'] ? "../assets/video/gis/{$value['video']}" : "../assets/video/default/default.mp4";
        ?>
            .bindPopup(
                "<b> Nama Sungai: </b><?= $value['nama_sungai'] ?><br>" +
                "<b> Nama Titik Pantau: </b><?= $value['titik_pantau'] ?><br>" +
                "<b> Koordinat: </b><?= $value['latitude'] ?>, <?= $value['longitude'] ?><br>" +
                "<b> Status Mutu: </b><?= $value['status_mutu_air'] ?><br>" +
                "<b> Nilai PIJ: </b><?= $value['nilai_pij'] ?><br>" +
                "<b> Foto: </b><img src='<?= $gambar ?>' width='100%' height='200px'>" +
                "<b> Video: </b><?php if ($video) { ?><video src='<?= $video ?>' type='video/mp4' width='100%' height='200px' controls></video><?php } ?>"
            );

    <?php } ?>
</script>

<?= $this->endSection() ?>