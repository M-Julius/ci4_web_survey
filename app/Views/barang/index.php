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
                                    <button class="btn btn-primary" 
                                    type="button" class="btn btn-primary" data-toggle="modal" data-target="#create"
                                    >Tambah</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body card-table">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>john@example.com</td>
                                    </tr>
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
<div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Form</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
            <div class="form-group">
                <label for="name">Nama Barang</label>
                <input class="form-control" id="name" required>
            </div>
            <div class="form-group">
                <label for="desc">Deskripsi Barang</label>
                <input class="form-control" id="desc" >
            </div>
            <div class="form-group">
                <label for="price">Harga Barang</label>
                <input class="form-control" id="price" required>
            </div>
            <center>
                <button class="btn btn-primary">Save changes</button>
            </center>
        </form>
      </div>
    </div>
  </div>
</div>
<?php echo  $this->endSection(); ?>

<?php echo $this->section('extra-js'); ?>

<script>
    
</script>

<?php echo  $this->endSection(); ?>