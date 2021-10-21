<div class="right_col" role="main">
  <div class="">

    <div class="row">

      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <?php echo $this->session->flashdata('failed'); ?>
            <h2>Data User <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Level</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($user->result() as $data) : ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data->nama_user; ?></td>
                  <td><?php echo $data->username; ?></td>
                  <td><?php echo $data->email; ?></td>
                  <td>
                    <?php 
                      if($data->level == 1) {
                        echo "Admin";
                      } elseif ($data->level == 2) {
                        echo "Pimpinan";
                      } else {
                        echo "Mahasiswa";
                      }
                    ?>
                  </td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-password<?php echo $data->id_user; ?>" class="btn btn-sm btn-warning">Ubah Sandi</a>
                    <a href="" data-toggle="modal" data-target=".modal-ubah<?php echo $data->id_user; ?>" class="btn btn-sm btn-primary">Ubah</a>
                    <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_user; ?>" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                </tr>

                <div class="modal fade modal-ubah<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Data User</h4>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url('/user/ubah/'.$data->id_user); ?>" method="post">
                          <div class="form-group">
                            <label>Nama User</label>
                            <input type="text" name="nama_user" value="<?php echo $data->nama_user; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Username</label>
                            <input type="text" name="username" value="<?php echo $data->username; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $data->email; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Level</label>
                            <select name="level" required="" class="form-control">
                              <option <?php if($data->level == 1) echo "selected"; ?> value="1">Admin</option>
                              <option <?php if($data->level == 2) echo "selected"; ?> value="2">Pimpinan</option>
                              <option <?php if($data->level == 3) echo "selected"; ?> value="3">Mahasiswa</option>
                            </select>
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

                <div class="modal fade modal-password<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Password Baru</h4>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url('/user/ubahpassword/'.$data->id_user); ?>" method="post">
                          <div class="form-group">
                            <label>Masukkan Password Baru</label>
                            <input type="text" name="password" required="" autocomplete="off" class="form-control">
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

                <div class="modal fade modal-hapus<?php echo $data->id_user; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data User</h4>
                      </div>
                      <div class="modal-body">
                        Apakah anda yakin ingin menghapus user <?php echo $data->nama_user; ?> ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <a href="<?php echo site_url('/user/hapus/'.$data->id_user); ?>" class="btn btn-sm btn-danger">Hapus</a>
                      </div>

                    </div>
                  </div>
                </div>

                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data User</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/user/tambah'); ?>" method="post">
          <div class="form-group">
            <label>Nama User</label>
            <input type="text" name="nama_user" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="text" autocomplete="off" name="password" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Level</label>
            <select name="level" required="" class="form-control">
              <option value="1">Admin</option>
              <option value="2">Pimpinan</option>
              <option value="3">Mahasiswa</option>
            </select>
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