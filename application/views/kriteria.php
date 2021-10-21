<?php $session = $this->session->userdata('logged_in'); ?>
<div class="right_col" role="main">
  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>Data Nilai Kriteria 
            <?php if($session["level"] == 1) : ?>
            <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a>
            <a href="<?php echo site_url('/kriteria/cetak'); ?>" class="btn btn-sm btn-default">Cetak Laporan</a>
            <?php endif; ?>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php if($session["level"] == 1 OR $session["level"] == 2) : ?>
            <div class="container">
              <table id="datatable" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Dokumen</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($kriteria->result() as $data) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data->nama_mahasiswa; ?></td>
                    <td>
                      <a href="" data-toggle="modal" data-target=".modal-peringkat<?php echo $data->id_nilai_kriteria; ?>"><?php echo $data->sk_peringkat; ?></a><br>
                      <a href="" data-toggle="modal" data-target=".modal-raport<?php echo $data->id_nilai_kriteria; ?>"><?php echo $data->raport; ?></a><br>
                      <a href="" data-toggle="modal" data-target=".modal-sertifikat<?php echo $data->id_nilai_kriteria; ?>"><?php echo $data->sertifikat; ?></a><br>
                      <a href="" data-toggle="modal" data-target=".modal-sktm<?php echo $data->id_nilai_kriteria; ?>"><?php echo $data->sktm; ?></a>
                    </td>
                    <td><?php echo $data->status; ?></td>
                    <td><?php echo $data->tanggal; ?></td>
                    <td>
                      <?php if($session["level"] == 1) : ?>
                      <a href="" data-toggle="modal" data-target=".modal-download<?php echo $data->id_nilai_kriteria; ?>" class="btn btn-sm btn-default"><span class="fa fa-download"></span></a>
                      <a href="" data-toggle="modal" data-target=".modal-mahasiswa<?php echo $data->id_nilai_kriteria; ?>" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                      <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_nilai_kriteria; ?>" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                      <?php else : ?>
                      <a href="" data-toggle="modal" data-target=".modal-download<?php echo $data->id_nilai_kriteria; ?>" class="btn btn-sm btn-default"><span class="fa fa-download"></span></a>
                      <a href="" data-toggle="modal" data-target=".modal-verifikasi<?php echo $data->id_nilai_kriteria; ?>" class="btn btn-sm btn-success"><span class="fa fa-check"></span></a>
                      <?php endif; ?>
                    </td>
                  </tr>
                  

                  <div class="modal fade modal-mahasiswa<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Mahasiswa</h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo site_url('/kriteria/ubahmahasiswa/'.$data->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Mahasiswa</label>
                                <select name="id_mahasiswa" required="" class="form-control">
                                  <?php foreach ($mahasiswa->result() as $mhs) : ?>
                                  <option <?php if($mhs->id_mahasiswa == $data->id_mahasiswa) echo "selected"; ?> value="<?php echo $mhs->id_mahasiswa; ?>"><?php echo $mhs->nik; ?> - <?php echo $mhs->nama_mahasiswa; ?></option>
                                  <?php endforeach ?>
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

                  <div class="modal fade modal-peringkat<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Surat Keterangan Peringkat (JPG)</h4>
                        </div>
                        <div class="modal-body">
                          <img width="200" src="<?php echo base_url('assets/berkas/'.$data->sk_peringkat); ?>" alt=""><br>
                          <form action="<?php echo site_url('/kriteria/ubahperingkat/'.$data->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Ubah File</label>
                              <input type="file" name="sk_peringkat" required="" class="form-control">
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

                  <div class="modal fade modal-raport<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Raport (JPG)</h4>
                        </div>
                        <div class="modal-body">
                          <img width="200" src="<?php echo base_url('assets/berkas/'.$data->raport); ?>" alt=""><br>
                          <form action="<?php echo site_url('/kriteria/ubahraport/'.$data->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Ubah File</label>
                              <input type="file" name="raport" required="" class="form-control">
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

                  <div class="modal fade modal-sertifikat<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Sertifikat/Piagam (JPG)</h4>
                        </div>
                        <div class="modal-body">
                          <img width="200" src="<?php echo base_url('assets/berkas/'.$data->sertifikat); ?>" alt=""><br>
                          <form action="<?php echo site_url('/kriteria/ubahsertifikat/'.$data->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Ubah File</label>
                              <input type="file" name="sertifikat" required="" class="form-control">
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

                  <div class="modal fade modal-sktm<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Surat Keterangan Tidak mampu (JPG)</h4>
                        </div>
                        <div class="modal-body">
                          <img width="200" src="<?php echo base_url('assets/berkas/'.$data->sktm); ?>" alt=""><br>
                          <form action="<?php echo site_url('/kriteria/ubahsktm/'.$data->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Ubah File</label>
                              <input type="file" name="sktm" required="" class="form-control">
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

                  <div class="modal fade modal-hapus<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Nilai Kriteria</h4>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus nilai kriteria <?php echo $data->nama_mahasiswa; ?> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <a href="<?php echo site_url('/kriteria/hapus/'.$data->id_nilai_kriteria); ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade modal-verifikasi<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Verifikasi Nilai Kriteria</h4>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin melakukan verifikasi nilai kriteria <?php echo $data->nama_mahasiswa; ?> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <a href="<?php echo site_url('/kriteria/verifikasi/'.$data->id_nilai_kriteria); ?>" class="btn btn-sm btn-primary">Verifikasi</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <div class="modal fade modal-download<?php echo $data->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Download</h4>
                        </div>
                        <div class="modal-body">
                          Download Semua Dokumen ?
                          <form action="<?php echo site_url('kriteria/download'); ?>" method="post">
                            <div class="form-group">
                              <input type="hidden" name="nama" value="<?php echo $data->nama_mahasiswa; ?>" required="">
                              <input type="hidden" name="sk_peringkat" value="assets/berkas/<?php echo $data->sk_peringkat; ?>" required="">
                              <input type="hidden" name="raport" value="assets/berkas/<?php echo $data->raport; ?>" required="">
                              <input type="hidden" name="sertifikat" value="assets/berkas/<?php echo $data->sertifikat; ?>" required="">
                              <input type="hidden" name="sktm" value="assets/berkas/<?php echo $data->sktm; ?>" required="">
                            </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <button type="submit" class="btn btn-sm btn-primary">Download</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>

                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
            <?php else : ?>
            <?php if(empty($userkriteria->id_user)) : ?>
            <form action="<?php echo site_url('/kriteria/tambah'); ?>" method="post" enctype="multipart/form-data" class="col-md-6">
              <div class="form-group">
                <b><?php echo $session["nama_user"]; ?><br>
              </div>
              <div class="form-group">
                <label>Upload Surat Keterangan Peringkat</label>
                <input type="file" name="sk_peringkat" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Upload Raport</label>
                <input type="file" name="raport" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Upload Sertifikat/Piagam</label>
                <input type="file" name="sertifikat" required="" class="form-control">
              </div>
              <div class="form-group">
                <label>Upload Surat Keterangan Tidak Mampu</label>
                <input type="file" name="sktm" required="" class="form-control">
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
              </div>
            </form>
            <?php else : ?>
              <table class="table table-hover table-bordered">
                <tr>
                  <th width="150">Keterangan</th>
                  <th width="280">Type File</th>
                  <th>Opsi</th>
                </tr>
                <tr>
                  <td>SK Peringkat</td>
                  <td>
                    <?php 
                      error_reporting(0);
                      $file_sk_peringkat = explode(".", $userkriteria->sk_peringkat);
                      echo strtoupper($file_sk_peringkat[1]);
                    ?> 
                  </td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-peringkat<?php echo $userkriteria->id_nilai_kriteria; ?>" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                    <a href="<?php echo base_url('assets/berkas/'.$userkriteria->sk_peringkat); ?>" class="btn btn-sm btn-info"><span class="fa fa-file"></span></a>
                    <a href="<?php echo site_url('/kriteria/kosongsk/'.$userkriteria->sk_peringkat); ?>" onclick="return confirm('Apakah anda ingin menghapus atau mengosongkan file ini ?')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
                <tr>
                  <td>Raport</td>
                  <td>
                    <?php 
                      $file_raport = explode(".", $userkriteria->raport);
                      echo strtoupper($file_raport[1]);
                    ?> 
                  </td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-raport<?php echo $userkriteria->id_nilai_kriteria; ?>" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                    <a href="<?php echo base_url('assets/berkas/'.$userkriteria->raport); ?>" class="btn btn-sm btn-info"><span class="fa fa-file"></span></a>
                    <a href="<?php echo site_url('/kriteria/kosongrp/'.$userkriteria->raport); ?>" onclick="return confirm('Apakah anda ingin menghapus atau mengosongkan file ini ?')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
                <tr>
                  <td>Sertifikat</td>
                  <td>
                    <?php 
                      $file_sertifikat = explode(".", $userkriteria->sertifikat);
                      echo strtoupper($file_sertifikat[1]);
                    ?> 
                  </td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-sertifikat<?php echo $userkriteria->id_nilai_kriteria; ?>" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                    <a href="<?php echo base_url('assets/berkas/'.$userkriteria->sertifikat); ?>" class="btn btn-sm btn-info"><span class="fa fa-file"></span></a>
                    <a href="<?php echo site_url('/kriteria/kosongsr/'.$userkriteria->sertifikat); ?>" onclick="return confirm('Apakah anda ingin menghapus atau mengosongkan file ini ?')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
                <tr>
                  <td>SKTM</td>
                  <td>
                    <?php 
                      $file_sktm = explode(".", $userkriteria->sktm);
                      echo strtoupper($file_sktm[1]);
                    ?> 
                  </td>
                  <td>
                    <a href="" data-toggle="modal" data-target=".modal-sktm<?php echo $userkriteria->id_nilai_kriteria; ?>" class="btn btn-sm btn-primary"><span class="fa fa-edit"></span></a>
                    <a href="<?php echo base_url('assets/berkas/'.$userkriteria->sktm); ?>" class="btn btn-sm btn-info"><span class="fa fa-file"></span></a>
                    <a href="<?php echo site_url('/kriteria/kosongskt/'.$userkriteria->sktm); ?>" onclick="return confirm('Apakah anda ingin menghapus atau mengosongkan file ini ?')" class="btn btn-sm btn-danger"><span class="fa fa-trash"></span></a>
                  </td>
                </tr>
              </table>  

              <div class="modal fade modal-peringkat<?php echo $userkriteria->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ubah Surat Keterangan Peringkat</h4>
                    </div>
                    <div class="modal-body">
                      <img width="200" src="<?php echo base_url('assets/berkas/'.$userkriteria->sk_peringkat); ?>" alt=""><br>
                      <form action="<?php echo site_url('/kriteria/ubahperingkat/'.$userkriteria->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Ubah File</label>
                          <input type="file" name="sk_peringkat" required="" class="form-control">
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

              <div class="modal fade modal-raport<?php echo $userkriteria->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ubah Raport</h4>
                    </div>
                    <div class="modal-body">
                      <img width="200" src="<?php echo base_url('assets/berkas/'.$userkriteria->raport); ?>" alt=""><br>
                      <form action="<?php echo site_url('/kriteria/ubahraport/'.$userkriteria->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Ubah File</label>
                          <input type="file" name="raport" required="" class="form-control">
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

              <div class="modal fade modal-sertifikat<?php echo $userkriteria->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ubah Sertifikat/Piagam</h4>
                    </div>
                    <div class="modal-body">
                      <img width="200" src="<?php echo base_url('assets/berkas/'.$userkriteria->sertifikat); ?>" alt=""><br>
                      <form action="<?php echo site_url('/kriteria/ubahsertifikat/'.$userkriteria->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Ubah File</label>
                          <input type="file" name="sertifikat" required="" class="form-control">
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

              <div class="modal fade modal-sktm<?php echo $userkriteria->id_nilai_kriteria; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Ubah Surat Keterangan Tidak mampu</h4>
                    </div>
                    <div class="modal-body">
                      <img width="200" src="<?php echo base_url('assets/berkas/'.$userkriteria->sktm); ?>" alt=""><br>
                      <form action="<?php echo site_url('/kriteria/ubahsktm/'.$userkriteria->id_nilai_kriteria); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Ubah File</label>
                          <input type="file" name="sktm" required="" class="form-control">
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

<div class="modal fade modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Nilai Kriteria</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/kriteria/tambahmahasiswa'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Mahasiswa</label>
            <select name="id_mahasiswa" required="" class="form-control">
              <?php foreach ($mahasiswa->result() as $mhs) : ?>
              <option value="<?php echo $mhs->id_mahasiswa; ?>"><?php echo $mhs->nik; ?> - <?php echo $mhs->nama_mahasiswa; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Upload Surat Keterangan Peringkat (JPG)</label>
            <input type="file" name="sk_peringkat" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Upload Raport (JPG)</label>
            <input type="file" name="raport" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Upload Sertifikat/Piagam (JPG)</label>
            <input type="file" name="sertifikat" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Upload Surat Keterangan Tidak Mampu (JPG)</label>
            <input type="file" name="sktm" required="" class="form-control">
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