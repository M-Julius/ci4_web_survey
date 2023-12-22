<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

  <?php echo $this->renderSection('title'); ?>

  <!-- Icons-->
  <link href="<?php echo base_url('core-ui/vendors/@coreui/icons/css/coreui-icons.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('core-ui/vendors/flag-icon-css/css/flag-icon.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('core-ui/vendors/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('core-ui/vendors/simple-line-icons/css/simple-line-icons.css'); ?>" rel="stylesheet">
  <!-- Main styles for this application-->
  <link href="<?php echo base_url('core-ui/css/style.css'); ?>" rel="stylesheet">
  <link href="<?php echo base_url('core-ui/vendors/pace-progress/css/pace.min.css'); ?>" rel="stylesheet">

</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed sidebar-lg-show">
  <!-- Navbar -->
  <?php echo $this->include('layouts/component/navbar'); ?>
  <!-- end of navbar -->
  <div class="app-body">
    <!-- Sidebar -->
    <?php echo $this->include('layouts/component/sidebar'); ?>
    <!-- end of Sidebar -->

    <!-- Main Content -->
    <?php echo $this->renderSection('content'); ?>


    <!-- End of Main Content -->


  </div>
  <footer class="app-footer">
    <div>
      <a href="https://coreui.io">CoreUI</a>
      <span>&copy; 2018 creativeLabs.</span>
    </div>
    <div class="ml-auto">
      <span>Powered by</span>
      <a href="https://coreui.io">CoreUI</a>
    </div>
  </footer>
  <!-- Bootstrap and necessary plugins-->
  <script src="<?php echo base_url('core-ui/vendors/jquery/js/jquery.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/vendors/popper.js/js/popper.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/vendors/bootstrap/js/bootstrap.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/vendors/pace-progress/js/pace.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/vendors/@coreui/coreui/js/coreui.min.js'); ?>"></script>
  <!-- Plugins and scripts required by this view-->
  <script src="<?php echo base_url('core-ui/vendors/chart.js/js/Chart.min.js'); ?>"></script>
  <script
    src="<?php echo base_url('core-ui/vendors/@coreui/coreui-plugin-chartjs-custom-tooltips/js/custom-tooltips.min.js'); ?>"></script>
  <script src="<?php echo base_url('core-ui/js/main.js'); ?>"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <?php echo $this->renderSection('extra-js'); ?>
</body>

</html>