<?= $this->extend('/layout/template');  ?>

<?= $this->section('content'); ?>
<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Indeks Kualitas Air</h3>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item active">Indeks Kualitas Air</li>
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
                        <div class="table-responsive">
                            <table class="table m-b-10 table-stripedd text-center" id="table_index_kualitas_air">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No.</th>
                                        <th>Periode</th>
                                        <th>Memenuhi Baku Mutu (%)</th>
                                        <th>Tercemar Ringan (%)</th>
                                        <th>Tercemar Sedang (%)</th>
                                        <th>Tercemar Berat (%)</th>
                                        <th>Nilai IKA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url('/assets/component/js/masterdata/index_kualitas_air.js'); ?>"></script>
<?= $this->endSection() ?>