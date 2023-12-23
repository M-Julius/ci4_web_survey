<?php echo $this->extend('layouts/main'); ?>

<?php echo $this->section('content'); ?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<main class="main">
    <div class="container-fluid">
        <div class="animated fadeIn">
            <h4>Dashboard
                <?php
                $session = session();
                echo $session->get('username');
                ?>
            </h4>
            <div class="row">
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                        <div class="card-body pb-0">

                            <div class="text-value">
                                <?= $totalBarang ?>
                            </div>
                            <div>Barang</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas id="card-chart1" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-info">
                        <div class="card-body pb-0">
                            <div class="text-value">
                                <?= $totalLokasi ?>
                            </div>
                            <div>Lokasi</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas id="card-chart2" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-warning">
                        <div class="card-body pb-0">
                            <div class="text-value">
                                <?= $totalMarketing ?>
                            </div>
                            <div>Marketing</div>
                        </div>
                        <div class="chart-wrapper mt-3" style="height:70px;">
                            <canvas id="card-chart3" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body pb-0">
                            <div class="text-value">
                                <?= $totalSurveys ?>
                            </div>
                            <div>Survey</div>
                        </div>
                        <div class="chart-wrapper mt-3 mx-3" style="height:70px;">
                            <canvas id="card-chart4" class="chart" height="70"></canvas>
                        </div>
                    </div>
                </div>
                <!--/.col-->
                <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-danger">
                        <div class="card-body pb-0">
                            <div>Survey Bulan Berjalan Di Lokasi</div>
                        </div>

                        <canvas id="donutChart" width="400" height="400"></canvas>
                    </div>
                </div>
            </div>


        </div>

    </div>

    <script>

        var ctx = document.getElementById('donutChart').getContext('2d');
        var surveysByLocation = <?= json_encode($surveysByLocation) ?>;

        var labels = [];
        var data = [];
        var colors = [];

        surveysByLocation.forEach(function (item) {
            labels.push(item.nama_lokasi); // Ganti dengan properti yang sesuai dari data lokasi
            data.push(item.total_surveys); // Ganti dengan properti yang sesuai untuk jumlah survei
            colors.push(getRandomColor()); // Fungsi untuk mendapatkan warna acak (bisa diganti dengan warna lain)
        });

        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Surveys by Location'
                }
            }
        });

        function getRandomColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
    </script>

</main>



<?php echo $this->endSection(); ?>