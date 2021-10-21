<?php $session = $this->session->userdata('logged_in'); ?>
<div class="right_col" role="main">
  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>Data Mahasiswa <a href="<?php echo site_url('/laporan/mahasiswa'); ?>" class="btn btn-sm btn-default">Cetak Laporan</a></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php if($session["level"] == 1 OR $session["level"] == 2) : ?>
            <div class="container">
              <table id="datatable" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>NIS</th>
                    <th>NIK</th>
                    <th>No. KK</th>
                    <th>Nama Mahasiswa</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($mahasiswa->result() as $data) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data->nis; ?></td>
                    <td><?php echo $data->nik; ?></td>
                    <td><?php echo $data->no_kk; ?></td>
                    <td><?php echo $data->nama_mahasiswa; ?></td>
                    <td>
                      <a href="" data-toggle="modal" data-target=".modal-detail<?php echo $data->id_mahasiswa; ?>" class="btn btn-sm btn-info">Detail</a>
                      <?php if($session["level"] == 1) : ?>
                      <a href="" data-toggle="modal" data-target=".modal-ubah<?php echo $data->id_mahasiswa; ?>" class="btn btn-sm btn-primary">Ubah</a>
                      <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_mahasiswa; ?>" class="btn btn-sm btn-danger">Hapus</a>
                      <?php endif; ?>
                    </td>
                  </tr>

                  <div class="modal fade modal-detail<?php echo $data->id_mahasiswa; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Detail Data Mahasiswa</h4>
                        </div>
                        <div class="modal-body">
                          <img width="200" src="<?php echo base_url('assets/images/'.$data->foto); ?>" alt=""><br><br>
                          <div class="container">
                            <div class="row">
                              <div class="col-md-3">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-12">
                                      NIS <br>
                                      NIK <br>
                                      No. KK <br>
                                      Nama Mahasiswa <br>
                                      No Telepon <br>
                                      Email <br>
                                      Fakultas <br>
                                      Program Studi <br>
                                      Keterangan
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <div class="col-md-9">
                                <div class="container">
                                  <div class="row">
                                    <div class="col-md-12">
                                      : <?php echo $data->nis; ?> <br>
                                      : <?php echo $data->nik; ?> <br>
                                      : <?php echo $data->no_kk; ?> <br>
                                      : <?php echo $data->nama_mahasiswa; ?> <br>
                                      : <?php echo $data->no_telepon; ?> <br>
                                      : <?php echo $data->email; ?> <br>
                                      : <?php echo $data->fakultas; ?> <br>
                                      : <?php echo $data->prodi; ?> <br>
                                      : <?php echo $data->keterangan; ?> <br>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade modal-ubah<?php echo $data->id_mahasiswa; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Mahasiswa</h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo site_url('/mahasiswa/ubahmahasiswa/'.$data->id_mahasiswa); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>NIS</label>
                              <input type="text" name="nis" value="<?php echo $data->nis; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>NIK</label>
                              <input type="text" name="nik" value="<?php echo $data->nik; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>No. KK</label>
                              <input type="text" name="no_kk" value="<?php echo $data->no_kk; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Nama Mahasiswa</label>
                              <input type="text" name="nama_mahasiswa" value="<?php echo $data->nama_mahasiswa; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>No Telepon</label>
                              <input type="number" name="no_telepon" value="<?php echo $data->no_telepon; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Email</label>
                              <input type="email" name="email" value="<?php echo $data->email; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Fakultas</label>
                              <input type="text" name="fakultas" value="<?php echo $data->fakultas; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Program Studi</label>
                              <input type="text" name="prodi" value="<?php echo $data->prodi; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Keterangan</label>
                              <input type="text" name="keterangan" value="<?php echo $data->keterangan; ?>" required="" class="form-control">
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

                  <div class="modal fade modal-hapus<?php echo $data->id_mahasiswa; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Mahasiswa</h4>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus Mahasiswa <?php echo $data->nama_mahasiswa; ?> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <a href="<?php echo site_url('/mahasiswa/hapus/'.$data->id_mahasiswa); ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else : ?>
            <?php if(empty($usermahasiswa->id_user)) : ?>
            <form action="<?php echo site_url('/mahasiswa/tambah'); ?>" method="post" enctype="multipart/form-data" class="col-md-6">
              <div class="form-group">
                <b><?php echo $session["nama_user"]; ?><br>
                <?php echo $session["email"]; ?><br></b>
              </div>
              <div class="form-group">
                <label>NIS</label>
                <input type="number" name="nis" autofocus="" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>NIK</label>
                <input type="number" name="nik" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>No KK</label>
                <input type="number" name="no_kk" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>No Telepon</label>
                <input type="number" name="no_telepon" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Fakultas</label>
                <input type="text" name="fakultas" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Program Studi</label>
                <input type="text" name="prodi" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" name="keterangan" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Upload Pas Foto</label>
                <input type="file" name="foto" required="" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
              </div>
            </form>
            <?php else : ?>
              <img src="<?php echo base_url('assets/images/'.$usermahasiswa->foto); ?>" width="200" class="img-thumbnail" style="margin-bottom: 30px;" alt="">
              <table class="table table-hover">
                <tr>
                  <td width="150">NIS</td>
                  <td>: <?php echo $usermahasiswa->nis; ?></td>
                </tr>
                <tr>
                  <td>NIK</td>
                  <td>: <?php echo $usermahasiswa->nik; ?></td>
                </tr>
                <tr>
                  <td>No. KK</td>
                  <td>: <?php echo $usermahasiswa->no_kk; ?></td>
                </tr>
                <tr>
                  <td>Nama Mahasiswa</td>
                  <td>: <?php echo $usermahasiswa->nama_mahasiswa; ?></td>
                </tr>
                <tr>
                  <td>No Telepon</td>
                  <td>: <?php echo $usermahasiswa->no_telepon; ?></td>
                </tr>
                <tr>
                  <td>Email</td>
                  <td>: <?php echo $usermahasiswa->mail; ?></td>
                </tr>
                <tr>
                  <td>Fakultas</td>
                  <td>: <?php echo $usermahasiswa->fakultas; ?></td>
                </tr>
                <tr>
                  <td>Program Studi</td>
                  <td>: <?php echo $usermahasiswa->prodi; ?></td>
                </tr>
              </table>
              <a href="" data-toggle="modal" data-target=".modal-ubah" class="btn btn-sm btn-primary">Ubah Data</a>

              <div class="modal fade modal-ubah" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ubah Data Mahasiswa</h4>
                    </div>
                    <div class="modal-body">
                      <form action="<?php echo site_url('/mahasiswa/ubah'); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>NIS</label>
                          <input type="number" name="nis" value="<?php echo $usermahasiswa->nis; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>NIK</label>
                          <input type="number" name="nik" value="<?php echo $usermahasiswa->nik; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>No KK</label>
                          <input type="number" name="no_kk" value="<?php echo $usermahasiswa->no_kk; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Nama Mahasiswa</label>
                          <input type="text" name="nama_mahasiswa" value="<?php echo $usermahasiswa->nama_mahasiswa; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>No Telepon</label>
                          <input type="number" name="no_telepon" value="<?php echo $usermahasiswa->no_telepon; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Email</label>
                          <input type="email" name="email" value="<?php echo $usermahasiswa->mail; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Fakultas</label>
                          <input type="text" name="fakultas" value="<?php echo $usermahasiswa->fakultas; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Program Studi</label>
                          <input type="text" name="prodi" value="<?php echo $usermahasiswa->prodi; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Keterangan</label>
                          <input type="text" name="keterangan" value="<?php echo $usermahasiswa->keterangan; ?>" required="" class="form-control">
                        </div>
                        <div class="form-group">
                          <label>Ubah Pas Foto</label>
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
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>