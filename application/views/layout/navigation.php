<?php $session = $this->session->userdata('logged_in') ?>
<!-- top navigation -->
<div class="top_nav">
  <div class="nav_menu">
    <nav>
      <div class="nav toggle">
        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
      </div>

      <ul class="nav navbar-nav navbar-right">
        <li class="">
          <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <?php echo $session["nama_user"]; ?>
            <span class=" fa fa-angle-down"></span>
          </a>
          <ul class="dropdown-menu dropdown-usermenu pull-right">
            <li><a href="" data-toggle="modal" data-target=".modal-profil"><span class="fa fa-user"></span> Profile</a></li>
            <li><a href="" data-toggle="modal" data-target=".modal-password"><span class="fa fa-lock"></span> Ubah Password</a>
            </li>
            <li><a href="<?php echo site_url('/login/logout'); ?>"><i class="fa fa-sign-out pull-right"></i> Keluar</a></li>
          </ul>
        </li>
      </ul>
    </nav>
  </div>
</div>
<!-- /top navigation -->

<div class="modal fade modal-profil" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Detail & Ubah Profil</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/apps/ubahprofil'); ?>" method="post">
          <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="nama_user" value="<?php echo $session["nama_user"]; ?>" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $session["username"]; ?>" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" value="<?php echo $session["email"]; ?>" required="" class="form-control">
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>

<div class="modal fade modal-password" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Ubah Password Baru</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/apps/ubahpassword'); ?>" method="post">
          <div class="form-group">
              <label>Masukkan Password Sebelumnya</label>
              <input type="password" name="password_sebelum" required="" class="form-control">
            </div>
            <div class="form-group">
              <label>Masukkan Password Baru</label>
              <input type="password" name="password_baru" required="" class="form-control">
            </div>
            <div class="form-group">
              <label>Konfirmasi Password Baru</label>
              <input type="password" name="konfirmasi_password" required="" class="form-control">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>