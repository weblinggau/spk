<style>
  body {
    font-family: sans-serif;
  }
  table {
    width: 100%;
  }
  table, tr, th, td {
    border-collapse: collapse;
  }
</style>
<div style="text-align: center;">
  <h1>UNIVERISTAS BINA INSAN</h1>
  <hr><br><br>
  <h2>LAPORAN DATA NILAI KRITERIA</h2>
</div>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>No</th>
    <th>NIS</th>
    <th>NIK</th>
    <th>Nama Mahasiswa</th>
    <th>Status</th>
    <th>Tanggal</th>
  </tr>
  <?php $no = 1; foreach($kriteria->result() as $data) : ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data->nis; ?></td>
    <td><?php echo $data->nik; ?></td>
    <td><?php echo $data->nama_mahasiswa; ?></td>
    <td><?php echo $data->status; ?></td>
    <td><?php echo $data->tanggal; ?></td>
  </tr>
  <?php endforeach; ?>
</table>