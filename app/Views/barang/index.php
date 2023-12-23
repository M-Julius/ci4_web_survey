<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<main class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Management Barang</h4>
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
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($barangs as $no => $row) {
                                        $id = $row['barang_id'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?= $id; ?>
                                            </td>
                                            <td>
                                                <?= $row['nama_barang'] ?>
                                            </td>
                                            <td>
                                                <?= $row['deskripsi_barang'] ?>
                                            </td>
                                            <td>
                                                <?= $row['harga'] ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                                <a href="#" class="btn btn-danger btn-sm" data-barangid="<?= $id ?> ">
                                                    Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

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
                        <label for="name">Nama Barang</label>
                        <input class="form-control" id="name" required name="nama_barang" maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="desc">Deskripsi Barang</label>
                        <textarea class="form-control" id="desc" name="deskripsi_barang" maxlength="255"> </textarea>
                    </div>
                    <div class="form-group">
                        <label for="price">Harga Barang</label>
                        <input class="form-control" id="price" type="number" min="1" required name="harga"
                            maxlength="100">
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
    function fillformData(id, nama_barang, deskripsi_barang, harga) {
        $('#formData #name').val(nama_barang);
        $('#formData #desc').val(deskripsi_barang);
        $('#formData #price').val(harga);

        // Assuming you have an input field for the ID
        $('#formData #id').val(id);
    }

    // Event handler for Edit button click
    $('.btn-warning').on('click', function () {
        // Get the data from the row
        var row = $(this).closest('tr');
        var id = row.find('td:eq(0)').text();
        var nama_barang = row.find('td:eq(1)').text();
        var deskripsi_barang = row.find('td:eq(2)').text();
        var harga = row.find('td:eq(3)').text();

        // Fill the form with the data
        fillformData(id, nama_barang, deskripsi_barang, harga);

        // Show the modal
        $('#myForm').modal('show');
    });

    $('.btn-danger').click(function () {
        var barangId = $(this).data('barangid');
        var isDelete = confirm("Apakah anda yakin akan menghapus data ini?");

        if (isDelete) {
            $.ajax({
                url: '/barang/' + barangId,
                method: 'GET',
                success: function (response) {
                    response = JSON.parse(response);
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Refresh halaman setelah penghapusan berhasil
                    } else {
                        alert(response.message);
                    }
                },
                error: function () {
                    alert('Terjadi kesalahan saat menghapus barang.');
                }
            });
        }
    });
    
</script>

<?php echo $this->endSection(); ?>