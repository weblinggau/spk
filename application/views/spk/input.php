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
            <h2>Data Nilai Mahasiswa <a href="" class="btn btn-sm btn-success" data-toggle="modal" data-target=".modal-tambah">Tambah</a></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <table id="datatable" class="table table-hover table-bordered">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Mahasiswa</th>
                  <?php 
                  foreach ($kriteria as $kr) {
                  ?>
                  <th><?= $kr->nama_kriteria ?></th>
                  <?php } ?>
                  <th>Opsi</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach ($nilai as $nil) {
                  
                 ?>
                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $nil->nama_mahasiswa; ?></td>
                  <?php 
                  $dataker = $this->Spkmodel->getNilairef($nil->id_mahasiswa)->result();
                  foreach ($dataker as $key) {
                  ?>
                  <td><?= $key->nilai_ref; ?></td>
                  <?php } ?>
                  <td>
                    <a href="" data-toggle="modal" data-target="#editnilai" data-id="<?= $nil->id_mahasiswa; ?>" class="btn btn-sm btn-primary">Ubah</a>
                    <a href="<?= base_url('spk/hapusnilai/').$nil->id_mahasiswa; ?>" class="btn btn-sm btn-danger">Hapus</a>
                  </td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- awal edit -->

<div class="modal fade" id="editkriteria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Data Kriteria</h5>
              <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <div class="modal-body">
            <form class="prodi" method="post" action="<?= base_url("spk/editkriteria")?>">
              <div class="modal-data"></div>
            </div>
            <div class="modal-footer">
              <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary btn-user">Edit Data</button>
            </div>
            </form>
          </div>
        </div>
      </div>

<!-- akhir edit -->

<div class="modal fade modal-tambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Tambah Data Nilai</h4>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('spk/addnilai'); ?>" method="post">
          <div class="form-group">
            <label>Nama Mahasiswa</label>
            <select class="form-control" name="idmahasiswa" required>
              <option selected>Open this select menu</option>
               <?php foreach ($mahasiswa as $mas) {
                      
              ?>
               <option value="<?= $mas->id_mahasiswa; ?>"><?= $mas->nama_mahasiswa; ?></option>
               <?php } ?>
            </select>
          </div>
          <?php foreach ($kriteria as $kir) {
            ?>
          <div class="form-group">
            <label><?=$kir->nama_kriteria ?></label>
            <input type="text" name="<?= $kir->id_data;?>" required="" class="form-control">
          </div>
          <?php } ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Tutup</button>
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
        </form>
      </div>

    </div>
  </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#editkriteria').on('show.bs.modal', function (e) {
            var userDat = $(e.relatedTarget).data('id');
            /* fungsi AJAX untuk melakukan fetch data */
            $.ajax({
                type : 'post',
                url : '<?= base_url("spk/praeditkriteria") ?>',
                /* detail per identifier ditampung pada berkas detail.php yang berada di folder application/view */
                data :  'iddata='+ userDat,
                /* memanggil fungsi getDetail dan mengirimkannya */
                success : function(data){
                $('.modal-data').html(data);
                /* menampilkan data dalam bentuk dokumen HTML */
                }
            });
         });
    });
  </script>