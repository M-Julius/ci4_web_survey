<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<main class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Management Surveyor Marketing</h4>
            <div class="row">
                <div class="col-lg-12">
                    <!-- Card Section -->
                    <div class="card card-section">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4 class="card-title mb-0">Data</h4>
                                </div>
                                <div class="col-md-6 text-right">
                                    <button class="btn btn-primary" type="button" class="btn btn-primary"
                                        data-toggle="modal" data-target="#myForm">Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-table">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama Marketing</th>
                                        <th>Nama Komoditas</th>
                                        <th>Alamat Lokasi</th>
                                        <th>Hasil Survey</th>
                                        <th>Repeat Order</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($surveys as $no => $row) {
                                        $id = $row->survey_id;
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $no+1 ?>
                                            </td>
                                            <td>
                                                <?= $row->nama_marketing ?>
                                            </td>
                                            <td>
                                                <?= $row->nama_barang ?>
                                            </td>
                                            <td>
                                                <?= $row->nama_lokasi ?>
                                            </td>
                                            <td>
                                                <?= $row->hasil_survey ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($row->repeat_order == "1") {
                                                    echo "Ya";
                                                } else {
                                                    if ($row->repeat_order == "0") {
                                                        echo "Tidak";
                                                    } else {
                                                        echo "-";
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?= $row->survey_datetime ?>
                                            </td>
                                            
                                        </tr>
                                        
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- button export -->
                            <div class="container d-flex  align-items-baseline justify-content-end">
                                <p class="mr-2">Export</p>
                                <a href="<?php echo site_url('/view_pdf_survey') ?>" class="mr-2">PDF</a>
                                <p class="mr-2">|</p>
                                <!-- <a href="">Excel</a> -->
                                <form action="<?php echo site_url('/export_survey'); ?>" method="post">
                                    <button type="submit" class="form-submit-button">XLSX</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<style>
    .form-submit-button {
        border: none;
        outline: none;
        background: none;
        cursor: pointer;
        color: #20a8d8;
        padding: 0;
        /* text-decoration: underline; */
        font-family: inherit;
        font-size: inherit;
    }

    button:hover {
        text-decoration: underline;
        cursor: pointer;
        color: #167495;
    }
</style>
<!-- Modal -->
<div class="modal fade" id="myForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="formData">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="komoditas">Komoditas</label>
                        <select class="form-control" id="id_komoditas" name="id_komoditas" required>
                            <?php foreach ($komoditas as $kmd): ?>
                                <option value="<?= $kmd['barang_id'] ?>">
                                    <?= $kmd['nama_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="market">Marketing</label>
                        <select class="form-control" id="id_marketing" name="id_marketing" required>
                            <?php foreach ($marketings as $marketing): ?>
                                <option value="<?= $marketing['marketing_id'] ?>">
                                    <?= $marketing['nama_marketing'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="loc">Lokasi</label>
                        <select class="form-control" id="id_lokasi" name="id_lokasi" required>
                            <?php foreach ($locations as $loc): ?>
                                <option value="<?= $loc['lokasi_id'] ?>">
                                    <?= $loc['nama_lokasi'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">Hasil Survey</label>
                        <textarea class="form-control" id="desc" name="hasil_survey"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="order">Repeat Order</label>
                        <select class="form-control" id="repeat_order" name="repeat_order" required>
                            <option value="1">
                                Ya
                            </option>
                            <option value="0">
                                Tidak
                            </option>
                        </select>
                    </div>
                    <center>
                        <button class="btn btn-primary">Save</button>
                    </center>
                </form>
            </div>
        </div>
    </div>
</div>
<?php echo $this->endSection(); ?>