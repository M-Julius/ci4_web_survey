<div class="container">
    <div class="card-header bg-info text-white">
        <h4 class="card-title">Management Barang</h4>
    </div>
    <!-- <div class="card-body"> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($barangs as $no => $row) {
                    $id = $row['barang_id'];
                ?>
                    <tr>
                        <td><?= $no += 1; ?></td>
                        <td><?= $row['nama_barang'] ?></td>
                        <td><?= $row['deskripsi_barang'] ?></td>
                        <td><?= $row['harga'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
</div>