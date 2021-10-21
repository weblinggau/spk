<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Nilai Kriteria - SPK Beasiswa";

		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		$query1 = $this->db->query("SELECT * FROM nilai_kriteria JOIN mahasiswa ON nilai_kriteria.id_mahasiswa = mahasiswa.id_mahasiswa");
		$query2 = $this->db->query("SELECT * FROM nilai_kriteria JOIN mahasiswa ON nilai_kriteria.id_mahasiswa = mahasiswa.id_mahasiswa JOIN user ON mahasiswa.id_user = user.id_user WHERE mahasiswa.id_user = user.id_user AND mahasiswa.id_user = $id_user");
		$query3 = $this->db->query("SELECT * FROM mahasiswa");
		$kriteria["kriteria"] = $query1;
		$kriteria["userkriteria"] = $query2->row();
		$kriteria["mahasiswa"] = $query3;

		$this->load->view('layout/header', $data);
		$this->load->view('kriteria', $kriteria);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		$mahasiswa = $this->db->query("SELECT * FROM mahasiswa JOIN user ON mahasiswa.id_user = user.id_user WHERE mahasiswa.id_user = user.id_user AND mahasiswa.id_user = $id_user");
		$mhs = $mahasiswa->row();

		$id_mahasiswa = $mhs->id_mahasiswa;

		$ekstensisk = ["pdf","doc","docx"];
		$sk_peringkat = htmlspecialchars(addslashes($_FILES["sk_peringkat"]["name"]));
		$ekstensi1 = explode(".", $sk_peringkat);
        $ekstensi1 = strtolower(end($ekstensi1));
        $uploadPeringkat = "SK_PERINGKAT".date("Ymdhis").".".$ekstensi1;
        if (!in_array($ekstensi1, $ekstensisk)) {
        	echo
            "<script>
        	alert('File SK Peringkat bukan berupa dokumen !');
        	document.location='../kriteria';
        	</script>";
           return false;
        }

        $ekstensirpt = ["pdf","doc","docx"];
        $raport = htmlspecialchars(addslashes($_FILES["raport"]["name"]));
		$ekstensi2 = explode(".", $raport);
        $ekstensi2 = strtolower(end($ekstensi2));
        $uploadRaport = "RAPORT".date("Ymdhis").".".$ekstensi2;
        if (!in_array($ekstensi2, $ekstensirpt)) {
        	echo
            "<script>
        	alert('File Raport bukan berupa dokumen !');
        	document.location='../kriteria';
        	</script>";
           return false;
        }

        $ekstensisrt = ["pdf","doc","docx"];
        $sertifikat = htmlspecialchars(addslashes($_FILES["sertifikat"]["name"]));
		$ekstensi3 = explode(".", $sertifikat);
        $ekstensi3 = strtolower(end($ekstensi3));
        $uploadSertifikat = "SERTIFIKAT".date("Ymdhis").".".$ekstensi3;
        if (!in_array($ekstensi3, $ekstensisrt)) {
        	echo
            "<script>
        	alert('File Sertifikat bukan berupa dokumen !');
        	document.location='../kriteria';
        	</script>";
           return false;
        }

        $ekstensisktm = ["pdf","doc","docx"];
        $sktm = htmlspecialchars(addslashes($_FILES["sktm"]["name"]));
		$ekstensi4 = explode(".", $sktm);
        $ekstensi4 = strtolower(end($ekstensi4));
        $uploadSktm = "SKTM".date("Ymdhis").".".$ekstensi4;
        if (!in_array($ekstensi4, $ekstensisktm)) {
        	echo
            "<script>
        	alert('File SKTM bukan berupa dokumen !');
        	document.location='../kriteria';
        	</script>";
           return false;
        }

        $tanggal = date("Y-m-d");

		$this->db->query("INSERT INTO nilai_kriteria VALUES (
			null,
			'$id_mahasiswa',
			'$uploadPeringkat',
			'$uploadRaport',
			'$uploadSertifikat',
			'$uploadSktm',
			'Belum Verifikasi',
			'$tanggal'
		)");
		move_uploaded_file($_FILES["sk_peringkat"]["tmp_name"], "assets/berkas/". $uploadPeringkat);
		move_uploaded_file($_FILES["raport"]["tmp_name"], "assets/berkas/". $uploadRaport);
		move_uploaded_file($_FILES["sertifikat"]["tmp_name"], "assets/berkas/". $uploadSertifikat);
		move_uploaded_file($_FILES["sktm"]["tmp_name"], "assets/berkas/". $uploadSktm);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/kriteria');

	}

	public function tambahmahasiswa()
	{

		$id_mahasiswa = htmlspecialchars(addslashes($_POST["id_mahasiswa"]));

		$sk_peringkat = htmlspecialchars(addslashes($_FILES["sk_peringkat"]["name"]));
		$ekstensi1 = explode(".", $sk_peringkat);
        $ekstensi1 = strtolower(end($ekstensi1));
        $uploadPeringkat = "SK_PERINGKAT".date("Ymdhis").".".$ekstensi1;

        $raport = htmlspecialchars(addslashes($_FILES["raport"]["name"]));
		$ekstensi2 = explode(".", $raport);
        $ekstensi2 = strtolower(end($ekstensi2));
        $uploadRaport = "RAPORT".date("Ymdhis").".".$ekstensi2;

        $sertifikat = htmlspecialchars(addslashes($_FILES["sertifikat"]["name"]));
		$ekstensi3 = explode(".", $sertifikat);
        $ekstensi3 = strtolower(end($ekstensi3));
        $uploadSertifikat = "SERTIFIKAT".date("Ymdhis").".".$ekstensi3;

        $sktm = htmlspecialchars(addslashes($_FILES["sktm"]["name"]));
		$ekstensi4 = explode(".", $sktm);
        $ekstensi4 = strtolower(end($ekstensi4));
        $uploadSktm = "SKTM".date("Ymdhis").".".$ekstensi4;

        $tanggal = date("Y-m-d");

		$this->db->query("INSERT INTO nilai_kriteria VALUES (
			null,
			'$id_mahasiswa',
			'$uploadPeringkat',
			'$uploadRaport',
			'$uploadSertifikat',
			'$uploadSktm',
			'Belum Verifikasi',
			'$tanggal'
		)");
		move_uploaded_file($_FILES["sk_peringkat"]["tmp_name"], "assets/berkas/". $uploadPeringkat);
		move_uploaded_file($_FILES["raport"]["tmp_name"], "assets/berkas/". $uploadRaport);
		move_uploaded_file($_FILES["sertifikat"]["tmp_name"], "assets/berkas/". $uploadSertifikat);
		move_uploaded_file($_FILES["sktm"]["tmp_name"], "assets/berkas/". $uploadSktm);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/kriteria');

	}

	public function ubahperingkat($id)
	{
		$sk_peringkat = htmlspecialchars(addslashes($_FILES["sk_peringkat"]["name"]));
		$ekstensi = explode(".", $sk_peringkat);
        $ekstensi = strtolower(end($ekstensi));
        $uploadPeringkat = "SK_PERINGKAT".date("Ymdhis").".".$ekstensi;

		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->sk_peringkat");
		$this->db->query("UPDATE nilai_kriteria SET 
			sk_peringkat = '$uploadPeringkat'
			WHERE id_nilai_kriteria = $id
		");
		move_uploaded_file($_FILES["sk_peringkat"]["tmp_name"], "assets/berkas/". $uploadPeringkat);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');

	}

	public function ubahraport($id)
	{
		$raport = htmlspecialchars(addslashes($_FILES["raport"]["name"]));
		$ekstensi = explode(".", $raport);
        $ekstensi = strtolower(end($ekstensi));
        $uploadRaport = "RAPORT".date("Ymdhis").".".$ekstensi;

		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->raport");
		$this->db->query("UPDATE nilai_kriteria SET 
			raport = '$uploadRaport'
			WHERE id_nilai_kriteria = $id
		");
		move_uploaded_file($_FILES["raport"]["tmp_name"], "assets/berkas/". $uploadRaport);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');

	}

	public function ubahsertifikat($id)
	{
		$sertifikat = htmlspecialchars(addslashes($_FILES["sertifikat"]["name"]));
		$ekstensi = explode(".", $sertifikat);
        $ekstensi = strtolower(end($ekstensi));
        $uploadSertifikat = "SERTIFIKAT".date("Ymdhis").".".$ekstensi;

		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->sertifikat");
		$this->db->query("UPDATE nilai_kriteria SET 
			sertifikat = '$uploadSertifikat'
			WHERE id_nilai_kriteria = $id
		");
		move_uploaded_file($_FILES["sertifikat"]["tmp_name"], "assets/berkas/". $uploadSertifikat);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');

	}

	public function ubahsktm($id)
	{
		$sktm = htmlspecialchars(addslashes($_FILES["sktm"]["name"]));
		$ekstensi = explode(".", $sktm);
        $ekstensi = strtolower(end($ekstensi));
        $uploadSktm = "SKTM".date("Ymdhis").".".$ekstensi;

		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->sktm");
		$this->db->query("UPDATE nilai_kriteria SET 
			sktm = '$uploadSktm'
			WHERE id_nilai_kriteria = $id
		");
		move_uploaded_file($_FILES["sktm"]["tmp_name"], "assets/berkas/". $uploadSktm);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');

	}

	public function ubahmahasiswa($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}

		$id_mahasiswa = htmlspecialchars(addslashes($_POST["id_mahasiswa"]));

	
		$this->db->query("UPDATE nilai_kriteria SET 
			id_mahasiswa = '$id_mahasiswa'
			WHERE id_nilai_kriteria = $id
		");

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');

	}

	public function hapus($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}

		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->sk_peringkat");
		unlink("assets/berkas/$data->raport");
		unlink("assets/berkas/$data->sertifikat");
		unlink("assets/berkas/$data->sktm");
		
		$this->db->query("DELETE FROM nilai_kriteria WHERE id_nilai_kriteria = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/kriteria');
	}

	public function kosongsk($id)
	{
		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE sk_peringkat = '$id'");
		$data = $result->row();
		unlink("assets/berkas/$data->sk_peringkat");
		
		$this->db->query("UPDATE nilai_kriteria SET sk_peringkat = '' WHERE sk_peringkat = '$id'");
		$this->session->set_flashdata('success', '<div class="alert alert-success">File berhasil dikosongkan !</div>');
		redirect('/kriteria');
	}

	public function kosongrp($id)
	{
		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE raport = '$id'");
		$data = $result->row();
		unlink("assets/berkas/$data->raport");
		
		$this->db->query("UPDATE nilai_kriteria SET raport = '' WHERE raport = '$id'");
		$this->session->set_flashdata('success', '<div class="alert alert-success">File berhasil dikosongkan !</div>');
		redirect('/kriteria');
	}

	public function kosongsr($id)
	{
		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE sertifikat = '$id'");
		$data = $result->row();
		unlink("assets/berkas/$data->sertifikat");
		
		$this->db->query("UPDATE nilai_kriteria SET sertifikat = '' WHERE sertifikat = '$id'");
		$this->session->set_flashdata('success', '<div class="alert alert-success">File berhasil dikosongkan !</div>');
		redirect('/kriteria');
	}

	public function kosongskt($id)
	{
		$result = $this->db->query("SELECT * FROM nilai_kriteria WHERE sktm = '$id'");
		$data = $result->row();
		unlink("assets/berkas/$data->sktm");
		
		$this->db->query("UPDATE nilai_kriteria SET sktm = '' WHERE sktm = '$id'");
		$this->session->set_flashdata('success', '<div class="alert alert-success">File berhasil dikosongkan !</div>');
		redirect('/kriteria');
	}

	public function verifikasi($id)
	{
		$this->db->query("UPDATE nilai_kriteria SET 
			status = 'Sudah Verifikasi'
			WHERE id_nilai_kriteria = $id
		");

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/kriteria');
	}

	public function download()
	{
		$this->load->library('zip');

		$sk_peringkat = htmlspecialchars(addslashes($_POST['sk_peringkat']));
		$raport = htmlspecialchars(addslashes($_POST['raport']));
		$sertifikat = htmlspecialchars(addslashes($_POST['sertifikat']));
		$sktm = htmlspecialchars(addslashes($_POST['sktm']));	
		$nama = htmlspecialchars(addslashes($_POST['nama']));	

		$download = array($sk_peringkat,$raport,$sertifikat,$sktm);

		foreach($download as $down) {

		$this->zip->read_file($down);

		}

		$this->zip->download('DOK'.'-'.$nama.'.zip');


	}

	public function cetak()
	{
		$mpdf = new \Mpdf\Mpdf();
		$mpdf = new \Mpdf\Mpdf(['format' => 'Legal']);
		$mpdf->AddPage('L'); 

		$query = $this->db->query("SELECT * FROM nilai_kriteria JOIN mahasiswa ON nilai_kriteria.id_mahasiswa = mahasiswa.id_mahasiswa");
		$kriteria["kriteria"] = $query;

		$data = $this->load->view('cetaknilaikriteria',$kriteria, TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output('LAPORAN DATA NILAI MAHASISWA'.date('Ymdhis').'.pdf', 'D');
	}
}
