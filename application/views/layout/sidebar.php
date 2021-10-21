<div class="navbar nav_title" style="border: 0;">
  <a href="<?php echo site_url('/'); ?>" class="site_title"><i class="fa fa-home"></i> <span>SPK Beasiswa</span></a>
</div>

<div class="clearfix"></div>
<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">                 
      <li><a href="<?php echo site_url('/'); ?>"><i class="fa fa-tachometer"></i> Dashboard</a></li>
      <?php  
        $session = $this->session->userdata('logged_in');
        if ($session["level"] == 1 OR $session["level"] == 2) :
      ?>
      <li><a href="<?php echo site_url('/pimpinan'); ?>"><i class="fa fa-user-secret"></i> Pimpinan</a></li>
      <?php endif; ?>
      <li><a href="<?php echo site_url('/mahasiswa'); ?>"><i class="fa fa-user"></i> Mahasiswa</a></li>
      <?php if ($session["level"] == 1 OR $session["level"] == 2 OR $session["level"] == 3) : ?>
      <li><a href="<?php echo site_url('/kriteria'); ?>"><i class="fa fa-edit"></i> Nilai Kriteria</a></li>
      <?php endif; ?>
      <?php if ($session["level"] == 1 OR $session["level"] == 3) : ?>
      <li><a href="<?php echo site_url('/jadwal'); ?>"><i class="fa fa-file"></i> Jadwal</a></li>
      <li><a href="<?php echo site_url('/pengumuman'); ?>"><i class="fa fa-bullhorn"></i> Pengumuman</a></li>
      <?php endif; ?>
      <?php if ($session["level"] == 1) : ?>
      <li><a href="<?php echo site_url('/user'); ?>"><i class="fa fa-users"></i> Manajemen User</a></li>
      <?php endif; ?>
      <li><a href="<?= base_url('spk/kriteria'); ?>"><i class="fa fa-list-alt"></i>Data Kriteria</a></li>
      <li><a href="<?= base_url('spk/input'); ?>"><i class="fa fa-file"></i>Input Nilai Mahasiswa</a></li>
      <li><a href="<?= base_url('spk/lulus'); ?>"><i class="fa fa-trophy"></i>Cek Kelulusan</a></li>
    </ul>
  </div>

</div>
<!-- /sidebar menu -->