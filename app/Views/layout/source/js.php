<!-- START: Jquery -->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/jquery-3.5.1.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/jquery.ui.min.js'); ?>"></script>
<!-- START: Jquery -->

<!-- START: father icon -->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/feather-icon/feather.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/feather-icon/feather-icon.js'); ?>"></script>
<!-- END: father icon -->

<!-- START: Bootstrap js -->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/bootstrap/popper.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/bootstrap/bootstrap.min.js'); ?>"></script>
<!-- END: Bootstrap js -->

<!-- START: Lotie js -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<!-- END: Lotie js -->

<!-- START: fusion js -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
<!-- END: fusion js -->

<!-- START: recaptca js -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<!-- END: recaptca js -->

<!-- START: datapicker js -->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/date-picker/datepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/date-picker/datepicker.en.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/date-picker/datepicker.custom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/daterange-picker/moment.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/daterange-picker/daterangepicker.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/datepicker/daterange-picker/daterange-picker.custom.js'); ?>"></script>
<!-- END: datapicker js -->

<!-- START: Summernote js -->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/editor/summernote/summernote.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/editor/summernote/summernote.custom.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/tooltip-init.js'); ?>"></script>
<!-- END: Summernote js -->

<!-- START: datatables js assets-->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
<!-- END: datatables js assets-->

<!-- START: sweetalert js assets-->
<script type="text/javascript" src="<?php echo base_url('/assets/plugins/js/sweetalert2.js'); ?>"></script>
<!-- END: sweetalert js assets-->

<!-- START: sidebar js assets-->
<script type="text/javascript" src="<?php echo base_url('/assets/component/js/sidebar-menu.js'); ?>"></script>
<!-- END: sidebar js assets -->

<!-- START: script js assets-->
<script type="text/javascript" src="<?php echo base_url('/assets/component/js/script.js'); ?>"></script>
<!-- END: script js assets -->

<!-- MAPS JavaScript -->
<script>
    $('#informasiModal').on('shown.bs.modal', function() {
        var maps_status_mutu = L.map('maps_status_mutu').setView([-6.883856873179531, 107.54087392250707], 12.5);
        var tiles = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 25,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
        }).addTo(maps_status_mutu);
        maps_status_mutu.invalidateSize();

        //menampilkan batas administrasi kecamatan cimahi utara
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahiutara.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'yellow',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Kecamatan: </b>" + "Kecamatan Cimahi Utara", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan batas administrasi kecamatan cimahi tengah
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahitengah.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'green',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Kecamatan: </b>" + "Kecamatan Cimahi Tengah", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan batas administrasi kecamatan cimahi selatan
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahiselatan.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'red',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(maps_status_mutu);

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
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cisangkan", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan polyline sungai Cimahi
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCimahi.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'brown',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cimahi", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan polyline sungai Cibaligo
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCibaligo.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'purple',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibaligo", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan polyline sungai Cilisung
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCilisung.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'cyan',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibabat", {
                    maxHeight: 400
                });
            });
        });

        //menampilkan polyline sungai Cibeureum
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCibeureum.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'lime',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(maps_status_mutu);

            geoLayer.eachLayer(function(layer) {

                layer.bindPopup("<b> Nama Sungai: </b>" + "Sungai Cibeureum", {
                    maxHeight: 400
                });
            });
        });

        var latitudeValue = document.getElementById("latitude").value;
        var longitudeValue = document.getElementById("longitude").value;
        var latInput = document.querySelector("[name=latitude]");
        var lngInput = document.querySelector("[name=longitude]");

        var curLocation = [latitudeValue, longitudeValue];
        maps_status_mutu.attributionControl.setPrefix(false);
        var marker = new L.marker(curLocation, {
            draggable: 'true',
        });

        //get coordinate when marker drag
        marker.on('dragend', function(e) {
            var position = marker.getLatLng();
            marker.setLatLng(position, {
                curLocation
            }).bindPopup(position).update();
            $("#latitude").val(position.lat);
            $("#longitude").val(position.lng);
        });

        //get coordinate when map clicked
        maps_status_mutu.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker) {
                marker = L.marker(e.latlng).addTo(maps_status_mutu);
            } else {
                marker.setLatLng(e.latlng);
            }
            latInput.value = lat;
            lngInput.value = lng;
        });

        maps_status_mutu.addLayer(marker);
    });
</script>

<script>
    $('#addInformasiModal').on('shown.bs.modal', function() {
        var add_maps_status_mutu = L.map('add_maps_status_mutu').setView([-6.883856873179531, 107.54087392250707], 12.5);
        var tiles = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
            maxZoom: 25,
            subdomains: ["mt0", "mt1", "mt2", "mt3"],
        }).addTo(add_maps_status_mutu);
        add_maps_status_mutu.invalidateSize();

        //menampilkan batas administrasi kecamatan cimahi utara
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahiutara.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'yellow',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan batas administrasi kecamatan cimahi tengah
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahitengah.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'green',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan batas administrasi kecamatan cimahi selatan
        $.getJSON("<?= base_url('/assets/dataGis/adm-cimahiselatan.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'red',
                        fillOpacity: 0.5,
                        weight: 0.5,
                    }
                }
            }).addTo(add_maps_status_mutu);
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
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan polyline sungai Cimahi
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCimahi.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'brown',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan polyline sungai Cibaligo
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCibaligo.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'purple',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan polyline sungai Cilisung
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCilisung.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'cyan',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        //menampilkan polyline sungai Cibeureum
        $.getJSON("<?= base_url('/assets/dataGis/sungaiCibeureum.geojson') ?>", function(data) {
            geoLayer = L.geoJson(data, {
                style: function(feature) {
                    return {
                        color: 'lime',
                        fillOpacity: 1,
                        weight: 4,
                    }
                }
            }).addTo(add_maps_status_mutu);
        });

        var latInput2 = document.querySelector("#latitude_add");
        var lngInput2 = document.querySelector("#longitude_add");

        var curLocation = [-6.883856873179531, 107.54087392250707];
        add_maps_status_mutu.attributionControl.setPrefix(false);
        var marker2 = new L.marker(curLocation, {
            draggable: 'true',
        });

        //get coordinate when marker drag
        marker2.on('dragend', function(e) {
            var position = marker2.getLatLng();
            marker2.setLatLng(position, {
                curLocation
            }).bindPopup(position).update();
            $("#latitude_add").val(position.lat);
            $("#longitude_add").val(position.lng);
        });

        //get coordinate when map clicked
        add_maps_status_mutu.on("click", function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;
            if (!marker2) {
                marker2 = L.marker(e.latlng).addTo(add_maps_status_mutu);
            } else {
                marker2.setLatLng(e.latlng);
            }
            latInput2.value = lat;
            lngInput2.value = lng;
        });

        add_maps_status_mutu.addLayer(marker2);
    });
</script>

<script>
    $(function() {
        <?php if (session()->has("success")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'success!',
                text: '<?= session("success") ?>'
            })
        <?php } ?>
    });
</script>

<script>
    $(function() {

        <?php if (session()->has("error")) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '<?= session("error") ?>'
            })
        <?php } ?>
    });
</script>

<script>
    $(function() {

        <?php if (session()->has("warning")) { ?>
            Swal.fire({
                icon: 'warning',
                title: 'Warning!',
                text: '<?= session("warning") ?>'
            })
        <?php } ?>
    });
</script>


<script>
    $(function() {

        <?php if (session()->has("info")) { ?>
            Swal.fire({
                icon: 'info',
                title: 'Hi!',
                text: '<?= session("info") ?>'
            })
        <?php } ?>
    });
</script>