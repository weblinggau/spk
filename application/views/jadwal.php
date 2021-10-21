<?php $session = $this->session->userdata('logged_in'); ?>
<div class="right_col" role="main">
  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php if($session["level"] == 1) : ?>
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>
              Data Jadwal
              <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a>
              <a href="<?php echo site_url('/jadwal/cetak'); ?>" class="btn btn-sm btn-default">Cetak Laporan</a>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <table id="datatable" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Mahasiswa</th>
                    <th>Tanggal</th>
                    <th>Dokumen</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($jadwal->result() as $data) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data->nama_mahasiswa; ?></td>
                    <td><?php echo $data->tanggal; ?></td>
                    <td><?php echo $data->dokumen; ?></td>
                    <td>
                      <a href="" data-toggle="modal" data-target=".modal-ubah<?php echo $data->id_jadwal; ?>" class="btn btn-sm btn-primary">Ubah</a>
                      <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_jadwal; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                  </tr>

                  <div class="modal fade modal-ubah<?php echo $data->id_jadwal; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Data Jadwal</h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo site_url('/jadwal/ubah/'.$data->id_jadwal); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Mahasiswa</label>
                              <select name="id_mahasiswa" required="" class="form-control">
                                <?php foreach ($mahasiswa->result() as $mhs) : ?>
                                <option <?php if($data->id_mahasiswa == $mhs->id_mahasiswa) echo "selected"; ?> value="<?php echo $mhs->id_mahasiswa; ?>"><?php echo $mhs->nik; ?> - <?php echo $mhs->nama_mahasiswa; ?></option>
                                <?php endforeach ?>
                              </select>
                            </div>
                            <div class="form-group">
                              <label>Tanggal</label>
                              <input type="date" name="tanggal" value="<?php echo $data->tanggal; ?>" required="" class="form-control">
                            </div>
                            <div class="form-group">
                              <label>Dokumen</label><br>
                              <small><?php echo $data->dokumen; ?></small>
                              <input type="file" name="dokumen" required="" class="form-control">
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

                  <div class="modal fade modal-hapus<?php echo $data->id_jadwal; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Data Mahasiswa</h4>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus jadwal mahasiswa <?php echo $data->nama_mahasiswa; ?> ?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <a href="<?php echo site_url('/jadwal/hapus/'.$data->id_jadwal); ?>" class="btn btn-sm btn-danger">Hapus</a>
                        </div>

                      </div>
                    </div>
                  </div>

                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
          <?php else : ?>
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>Jadwal Wawancara Anda</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <?php if(empty($jadwalmhs->id_mahasiswa)) : ?>
              Belum ada jadwal
            <?php else : ?>
            <a class="btn btn-sm btn-primary" href="<?php echo base_url('assets/berkas/'.$jadwalmhs->dokumen); ?>" target="_blank">Download Dokumen</a><br>
            <?php echo $jadwalmhs->tanggal; ?>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Jadwal</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/jadwal/tambah'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Mahasiswa</label>
            <select name="id_mahasiswa" required="" class="form-control">
              <?php foreach ($mahasiswa->result() as $mhs) : ?>
              <option value="<?php echo $mhs->id_mahasiswa; ?>"><?php echo $mhs->nik; ?> - <?php echo $mhs->nama_mahasiswa; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Tanggal</label>
            <input type="date" name="tanggal" required="" class="form-control">
          </div>
          <div class="form-group">
            <label>Dokumen</label>
            <input type="file" name="dokumen" required="" class="form-control">
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