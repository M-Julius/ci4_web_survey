<div class="container">
    <div class="card-header bg-info text-white">
        <h4 class="card-title">Management Survey</h4>
    </div>
    <!-- <div class="card-body"> -->
    <div class="table-responsive">
        <table class="table">
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
                        <td><?= $no += 1; ?></td>
                        <td><?= $row->nama_marketing ?></td>
                        <td> <?= $row->nama_barang ?></td>
                        <td> <?= $row->nama_lokasi ?></td>
                        <td><?= $row->hasil_survey ?></td>
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
                        <td><?= $row->survey_datetime ?></td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
</div>