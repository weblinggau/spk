<!-- page content -->
<div class="right_col" role="main">
  <!-- top tiles -->
  <div class="row tile_count">
    <?php echo $this->session->flashdata('failed'); ?>
    <h3>Selamat datang di Sistem Pendukung Keputusan Penerimaan Beasiswa Berpretasi Corporate social responbility (CSR)  di Universitas Bina Insan Menggunakan Metode Weight product (WP)</h3>
    <?php  
      $session = $this->session->userdata('logged_in');
      if ($session["level"] == 1) :
    ?>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user-secret"></i> Jumlah Pimpinan</span>
      <div class="count"><?php echo $pimpinan->jml; ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-users"></i> Jumlah Mahasiswa</span>
      <div class="count"><?php echo $mahasiswa->jml; ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-edit"></i> Data Kriteria</span>
      <div class="count green"><?php echo $kriteria->jml; ?></div>
    </div>
    <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-user"></i> Total User</span>
      <div class="count"><?php echo $user->jml; ?></div>
    </div>
    <?php endif; ?>
  </div>
  <!-- /top tiles -->
</div>
<!-- /page content -->