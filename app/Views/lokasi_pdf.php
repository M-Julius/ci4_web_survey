<div class="container">
    <div class="card-header bg-info text-white">
        <h4 class="card-title">Management Lokasi</h4>
    </div>
    <!-- <div class="card-body"> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lokasis as $no => $row) {
                    $id = $row['lokasi_id'];
                ?>
                    <tr>
                        <td><?= $no += 1; ?></td>
                        <td><?= $row['nama_lokasi'] ?></td>
                        <td><?= $row['alamat_lokasi'] ?></td>
                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
</div>