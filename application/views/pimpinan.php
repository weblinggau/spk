<div class="right_col" role="main">
  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php  
            $session = $this->session->userdata('logged_in');
            if($session["level"] == 1) :
          ?>
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>Data Pimpinan <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Email</th>
                  <th>Jenis Kelamin</th>
                  <th>Foto</th>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach($pimpinan->result() as $data) : ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data->nama_pimpinan; ?></td>
                  <td><?php echo $data->email; ?></td>
                  <td><?php echo $data->jenis_kelamin; ?></td>
                  <td><img src="<?php echo base_url('assets/images/'.$data->foto); ?>" width="50" class="img-thumbnail" alt=""></td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-ubah<?php echo $data->id_pimpinan; ?>" class="btn btn-sm btn-primary">Ubah</a>
                    <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_pimpinan; ?>" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                </tr>

                <div class="modal fade modal-ubah<?php echo $data->id_pimpinan; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Data Pimpinan</h4>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url('/pimpinan/ubah/'.$data->id_pimpinan); ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Nama Pimpinan</label>
                            <input type="text" name="nama_pimpinan" value="<?php echo $data->nama_pimpinan; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $data->email; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <input type="radio" name="jenis_kelamin" <?php if($data->jenis_kelamin == "Laki-laki") echo "checked"; ?> value="Laki-laki" required=""> Laki-laki 
                            <input type="radio" name="jenis_kelamin" <?php if($data->jenis_kelamin == "Perempuan") echo "checked"; ?> value="Perempuan" required=""> Perempuan
                          </div>
                          <div class="form-group">
                            <label>Foto</label><br>
                            <img src="<?php echo base_url('assets/images/'.$data->foto); ?>" width="100" alt="">
                            <input type="file" name="foto" class="form-control">
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

                <div class="modal fade modal-hapus<?php echo $data->id_pimpinan; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Hapus Data Pimpinan</h4>
                      </div>
                      <div class="modal-body">
                        Apakah anda yakin ingin menghapus pimpinan <?php echo $data->nama_pimpinan; ?> ?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        <a href="<?php echo site_url('/pimpinan/hapus/'.$data->id_pimpinan); ?>" class="btn btn-sm btn-danger">Hapus</a>
                      </div>

                    </div>
                  </div>
                </div>

                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <?php elseif($session["level"] == 2) : ?>
          <div class="x_title">
            Data Pimpinan
          </div>
          <div class="x_content">
            <?php if(empty($userpimpinan)) : ?>
            <form action="<?php echo site_url('/pimpinan/tambah'); ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label>Nama Pimpinan</label>
                <input type="hidden" name="id_user" required="" value="<?php echo $session["id_user"]; ?>">
                <input type="text" name="nama_pimpinan" value="<?php echo $session["nama_user"]; ?>" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $session["email"]; ?>" class="form-control">
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label><br>
                <input type="radio" name="jenis_kelamin" value="Laki-laki" required=""> Laki-laki 
                <input type="radio" name="jenis_kelamin" value="Perempuan" required=""> Perempuan
              </div>
              <div class="form-group">
                <label>Foto</label>
                <input type="file" name="foto" required="" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
              </div>
            </form>
            <?php else : ?>
            <img src="<?php echo base_url('assets/images/'.$userpimpinan->fotopimpinan); ?>" width="200" class="img-thumbnail" style="margin-bottom: 30px;" alt="">
              <table class="table table-hover">
                <tr>
                  <td width="150">Nama Pimpinan</td>
                  <td>: <?php echo $userpimpinan->nama_pimpinan; ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: <?php echo $userpimpinan->mail; ?></td>
                </tr>
                <tr>
                  <td>Jenis Kelamin</td>
                  <td>: <?php echo $userpimpinan->jenis_kelamin; ?></td>
                </tr>
              </table>
              <a href="" data-toggle="modal" data-target=".modal-ubah" class="btn btn-sm btn-primary">Ubah Data</a>

              <div class="modal fade modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel">Ubah Data Pimpinan</h4>
                      </div>
                      <div class="modal-body">
                        <form action="<?php echo site_url('/pimpinan/ubah/'.$userpimpinan->id_pimpinan); ?>" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <label>Nama Pimpinan</label>
                            <input type="text" name="nama_pimpinan" value="<?php echo $userpimpinan->nama_pimpinan; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?php echo $userpimpinan->email; ?>" required="" class="form-control">
                          </div>
                          <div class="form-group">
                            <label>Jenis Kelamin</label><br>
                            <input type="radio" name="jenis_kelamin" <?php if($userpimpinan->jenis_kelamin == "Laki-laki") echo "checked"; ?> value="Laki-laki" required=""> Laki-laki 
                            <input type="radio" name="jenis_kelamin" <?php if($userpimpinan->jenis_kelamin == "Perempuan") echo "checked"; ?> value="Perempuan" required=""> Perempuan
                          </div>
                          <div class="form-group">
                            <label>Foto</label><br>
                            <img src="<?php echo base_url('assets/images/'.$userpimpinan->foto); ?>" width="100" alt="">
                            <input type="file" name="foto" class="form-control">
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
            <?php endif; ?>
          </div>
          <?php endif; ?>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Data Pimpinan</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/pimpinan/tambah'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>User</label>
            <?php  
            $query = $this->db->query("SELECT * FROM user WHERE level = 2"); 
            $jsArray = "var prdName = new Array();\n";  
            echo '<select name="id_user" class="form-control" onchange="changeValue(this.value)">';  
            echo '<option>Pilih</option>';  
            foreach ($query->result() as $row) { 
                echo '<option value="' . $row->id_user . '">' . $row->nama_user . '</option>';  
                $jsArray .= "prdName['" . $row->id_user . "'] = {name:'" . addslashes($row->nama_user) . "',desc:'".addslashes($row->email)."'};\n";  
            }  
            echo '</select>';  
            ?>  
          </div>
          
          <div class="form-group">
            <label>Nama Pimpinan</label>
            <input type="text" name="nama_pimpinan" id="nama_user" readonly="" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" name="email" id="email" readonly="" required="" class="form-control">
          </div>
          <script type="text/javascript">  
            <?php echo $jsArray; ?>
            function changeValue(id){
            document.getElementById('nama_user').value = prdName[id].name;
            document.getElementById('email').value = prdName[id].desc;
            };
          </script>
          <div class="form-group">
            <label>Jenis Kelamin</label><br>
            <input type="radio" name="jenis_kelamin" value="Laki-laki" required=""> Laki-laki 
            <input type="radio" name="jenis_kelamin" value="Perempuan" required=""> Perempuan
          </div>
          <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" required="" class="form-control">
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