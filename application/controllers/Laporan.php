<?php 

defined('BASEPATH') OR die('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends CI_Controller {

  public function mahasiswa()
  {
    $data= $this->db->query("SELECT * FROM mahasiswa");

    $spreadsheet = new Spreadsheet;

    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'No')
    ->setCellValue('B1', 'NIS')
    ->setCellValue('C1', 'NIK')
    ->setCellValue('D1', 'No. KK')
    ->setCellValue('E1', 'Nama')
    ->setCellValue('F1', 'No Telepon')
    ->setCellValue('G1', 'Email')
    ->setCellValue('H1', 'Fakultas')
    ->setCellValue('I1', 'Program Studi');

    $kolom = 2;
    $nomor = 1;
    foreach($data->result() as $dt) {

      $spreadsheet->setActiveSheetIndex(0)
      ->setCellValue('A' . $kolom, $nomor)
      ->setCellValue('B' . $kolom, $dt->nis)
      ->setCellValue('C' . $kolom, $dt->nik)
      ->setCellValue('D' . $kolom, $dt->no_kk)
      ->setCellValue('E' . $kolom, $dt->nama_mahasiswa)
      ->setCellValue('F' . $kolom, $dt->no_telepon)
      ->setCellValue('G' . $kolom, $dt->email)
      ->setCellValue('H' . $kolom, $dt->fakultas)
      ->setCellValue('I' . $kolom, $dt->prodi);

      $kolom++;
      $nomor++;

    }

    $writer = new Xlsx($spreadsheet);

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="LAPORAN DATA MAHASISWA.xlsx"');
    header('Cache-Control: max-age=0');

    $writer->save('php://output');
  }


}