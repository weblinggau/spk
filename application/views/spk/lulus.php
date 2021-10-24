<div class="right_col" role="main">
  <div class="">

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <?php  
            $session = $this->session->userdata('logged_in');
          ?>
          <div class="x_title">
            <?php echo $this->session->flashdata('success'); ?>
            <h2>Hasil Perhitungan Kelulusan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>Peringkat</th>
                  <th>Nama Mahasiswa</th>
                  <th>Jumlah Nilai Kriteria</th>
                  <th>Nilai Akhir</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no=1;
                foreach ($mahasiswa as $mas) {
                 ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $mas->nama_mahasiswa; ?></td>
                  <td><?= $mas->vektor_s; ?></td>
                  <td><?= $mas->nilai_akhir; ?></td>
                </tr>
                <?php 
                  } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


