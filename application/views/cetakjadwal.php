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
  <h2>DATA JADWAL WAWANCARA MAHASISWA</h2>
</div>
<table border="1" cellpadding="10" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Nama Mahasiswa</th>
    <th>Tanggal</th>
  </tr>
  <?php $no = 1; foreach($jadwal->result() as $data) : ?>
  <tr>
    <td><?php echo $no++; ?></td>
    <td><?php echo $data->nama_mahasiswa; ?></td>
    <td><?php echo $data->tanggal; ?></td>
  </tr>
  <?php endforeach; ?>
</table>