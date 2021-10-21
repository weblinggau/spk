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
              Data Pengumuman
              <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <div class="container">
              <table id="datatable" class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Dokumen</th>
                    <th>Tanggal</th>
                    <th>Opsi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; foreach($pengumuman->result() as $data) : ?>
                  <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data->keterangan; ?></td>
                    <td><?php echo $data->dokumen; ?></td>
                    <td><?php echo $data->tanggal; ?></td>
                    <td>
                      <a href="" data-toggle="modal" data-target=".modal-ubah<?php echo $data->id_pengumuman; ?>" class="btn btn-sm btn-primary">Ubah</a>
                      <a href="" data-toggle="modal" data-target=".modal-hapus<?php echo $data->id_pengumuman; ?>" class="btn btn-sm btn-danger">Hapus</a>
                    </td>
                  </tr>

                  <div class="modal fade modal-ubah<?php echo $data->id_pengumuman; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Ubah Pengumuman</h4>
                        </div>
                        <div class="modal-body">
                          <form action="<?php echo site_url('/pengumuman/ubah/'.$data->id_pengumuman); ?>" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                              <label>Keterangan</label>
                              <textarea name="keterangan" rows="10" value="<?php echo $data->keterangan; ?>" required="" class="form-control"><?php echo $data->keterangan; ?></textarea>
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

                  <div class="modal fade modal-hapus<?php echo $data->id_pengumuman; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="myModalLabel">Hapus Pengumuman</h4>
                        </div>
                        <div class="modal-body">
                          Apakah anda yakin ingin menghapus pengumuman ini?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
                          <a href="<?php echo site_url('/pengumuman/hapus/'.$data->id_pengumuman); ?>" class="btn btn-sm btn-danger">Hapus</a>
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
          <div class="x_title">Daftar Pengumuman</div>
          <div class="x_content">
            <?php  
              $no = 1;
              foreach($pengumuman->result() as $data) :
            ?>
            <table class="table table-hover">
              <tr>
                <td>No</td>
                <td>Keterangan</td>
                <td>Dokumen</td>
                <td>Tanggal</td>
              </tr>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data->keterangan; ?></td>
                <td><a href="<?php echo base_url('assets/berkas/'.$data->dokumen); ?>" target="_blank" class="btn btn-sm btn-primary">Download Dokumen</a></td>
                <td><?php echo $data->tanggal; ?></td>
              </tr>
            </table>
            <?php endforeach; ?>
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
        <h4 class="modal-title" id="myModalLabel">Tambah Pengumuman Baru</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo site_url('/pengumuman/tambah'); ?>" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>Keterangan</label>
            <textarea name="keterangan" rows="10" required="" class="form-control"></textarea>
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