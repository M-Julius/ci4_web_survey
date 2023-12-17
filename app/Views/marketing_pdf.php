<div class="container">
    <div class="card-header bg-info text-white">
        <h4 class="card-title">Management Marketing</h4>
    </div>
    <!-- <div class="card-body"> -->
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Marketing</th>
                    <th>Alamat Marketing</th>
                    <th>No Telpon</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($marketings as $no => $row) {
                    $id = $row['marketing_id'];
                ?>
                    <tr>
                        <td><?= $no += 1; ?></td>
                        <td><?= $row['nama_marketing'] ?></td>
                        <td><?= $row['alamat_marketing'] ?></td>
                        <td><?= $row['nomor_telepon'] ?></td>
                        <td><?= $row['email'] ?></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
</div>