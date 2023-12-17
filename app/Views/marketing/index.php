<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<main class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Management Marketing</h4>
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
                                        <th>Alamat Marketing</th>
                                        <th>Email</th>
                                        <th>No Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($marketings as $no => $row) {
                                        $id = $row['marketing_id'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $no+1; ?>
                                            </td>
                                            <td>
                                                <?= $row['nama_marketing'] ?>
                                            </td>
                                            <td>
                                                <?= $row['alamat_marketing'] ?>
                                            </td>
                                            <td>
                                                <?= $row['email'] ?>
                                            </td>
                                            <td>
                                                <?= $row['nomor_telepon'] ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <a href="/marketing/<?= $id ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus data ini ?')">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- button export -->
                            <div class="container d-flex  align-items-baseline justify-content-end">
                                <p class="mr-2">Export</p>
                                <a href="<?php echo site_url('/view_pdf_marketing') ?>" class="mr-2">PDF</a>
                                <p class="mr-2">|</p>
                                <!-- <a href="">Excel</a> -->
                                <form action="<?php echo site_url('/export_marketing'); ?>" method="post">
                                    <button type="submit" class="form-submit-button">XLSX</button>
                                </form>
                            </div>
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
                        <label for="name">Nama Marketing</label>
                        <input class="form-control" id="name" required name="nama_marketing">
                    </div>
                    <div class="form-group">
                        <label for="desc">Alamat Marketing</label>
                        <textarea class="form-control" id="desc" required name="alamat_marketing"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="eml">Email</label>
                        <input class="form-control" id="eml" required name="email"> </input>
                    </div>
                    <div class="form-group">
                        <label for="notelp">No Telpon</label>
                        <input class="form-control" id="notelp" required name="nomor_telepon"> </input>
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

<?php echo $this->section('extra-js'); ?>

<script>
    // Function to populate the form fields when Edit button is clicked
    function fillformData(id, nama_marketing, alamat_marketing, email, nomor_telepon) {
        $('#formData #name').val(nama_marketing);
        $('#formData #desc').val(alamat_marketing);
        $('#formData #eml').val(email);
        $('#formData #notelp').val(nomor_telepon);

        // Assuming you have an input field for the ID
        $('#formData #id').val(id);
    }

    // Event handler for Edit button click
    $('.btn-warning').on('click', function () {
        // Get the data from the row
        var row = $(this).closest('tr');
        var id = row.find('td:eq(0)').text().trim();
        var nama_marketing = row.find('td:eq(1)').text().trim();
        var alamat_marketing = row.find('td:eq(2)').text().trim();
        var email = row.find('td:eq(3)').text().trim();
        var noTelpon = row.find('td:eq(4)').text().trim();

        console.log(id, nama_marketing, alamat_marketing, email, noTelpon)
        // Fill the form with the data
        fillformData(id, nama_marketing, alamat_marketing, email, noTelpon);

        // Show the modal
        $('#myForm').modal('show');
    });
</script>

<?php echo $this->endSection(); ?>