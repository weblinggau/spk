<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mahasiswa extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Mahasiswa - SPK Beasiswa";

		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		$query1 = $this->db->query("SELECT * FROM mahasiswa");
		$query2 = $this->db->query("SELECT *, mahasiswa.email AS mail FROM mahasiswa JOIN user ON mahasiswa.id_user = user.id_user WHERE mahasiswa.id_user = user.id_user AND mahasiswa.id_user = $id_user");
		$mahasiswa["mahasiswa"] = $query1;
		$mahasiswa["usermahasiswa"] = $query2->row();
		$this->load->view('layout/header', $data);
		$this->load->view('mahasiswa', $mahasiswa);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		$nama_user = $session_data["nama_user"];
		$email = $session_data["email"];

		$nis = htmlspecialchars(addslashes($_POST["nis"]));
		$nik = htmlspecialchars(addslashes($_POST["nik"]));
		$no_kk = htmlspecialchars(addslashes($_POST["no_kk"]));
		$no_telepon = htmlspecialchars(addslashes($_POST["no_telepon"]));
		$fakultas = htmlspecialchars(addslashes($_POST["fakultas"]));
		$prodi = htmlspecialchars(addslashes($_POST["prodi"]));
		$keterangan = htmlspecialchars(addslashes($_POST["keterangan"]));

		$foto = htmlspecialchars(addslashes($_FILES["foto"]["name"]));
		$ekstensi = explode(".", $foto);
        $ekstensi = strtolower(end($ekstensi));
        $uploadfoto = "IMG".date("Ymdhis").".".$ekstensi;

		$this->db->query("INSERT INTO mahasiswa VALUES (
			null,
			'$id_user',
			'$nis',
			'$nik',
			'$no_kk',
			'$nama_user',
			'$no_telepon',
			'$email',
			'$fakultas',
			'$prodi',
			'$keterangan',
			'$uploadfoto'
		)");
		move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/images/". $uploadfoto);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/mahasiswa');

	}

	public function ubah()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];

		$nis = htmlspecialchars(addslashes($_POST["nis"]));
		$nik = htmlspecialchars(addslashes($_POST["nik"]));
		$no_kk = htmlspecialchars(addslashes($_POST["no_kk"]));
		$nama_mahasiswa = htmlspecialchars(addslashes($_POST["nama_mahasiswa"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$no_telepon = htmlspecialchars(addslashes($_POST["no_telepon"]));
		$fakultas = htmlspecialchars(addslashes($_POST["fakultas"]));
		$prodi = htmlspecialchars(addslashes($_POST["prodi"]));
		$keterangan = htmlspecialchars(addslashes($_POST["keterangan"]));

		$foto = htmlspecialchars(addslashes($_FILES["foto"]["name"]));
		$ekstensi = explode(".", $foto);
        $ekstensi = strtolower(end($ekstensi));
        $uploadfoto = "IMG".date("Ymdhis").".".$ekstensi;

		if ($foto == "") {
			$this->db->query("UPDATE mahasiswa SET 
				nis = '$nis',
				nik = '$nik',
				no_kk = '$no_kk',
				nama_mahasiswa = '$nama_mahasiswa',
				no_telepon = '$no_telepon',
				email = '$email',
				fakultas = '$fakultas',
				prodi = '$prodi',
				keterangan = '$keterangan'
				WHERE id_user = $id_user
			");
		} else {
			$result = $this->db->query("SELECT * FROM mahasiswa WHERE id_user = $id_user");
			$data = $result->row();
			unlink("assets/images/$data->foto");
			$this->db->query("UPDATE mahasiswa SET 
				nis = '$nis',
				nik = '$nik',
				no_kk = '$no_kk',
				nama_mahasiswa = '$nama_mahasiswa',
				no_telepon = '$no_telepon',
				email = '$email',
				fakultas = '$fakultas',
				prodi = '$prodi',
				keterangan = '$keterangan',
				foto = '$uploadfoto'
				WHERE id_user = $id_user
			");
			move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/images/". $uploadfoto);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/mahasiswa');

	}

	public function ubahmahasiswa($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}

		$nis = htmlspecialchars(addslashes($_POST["nis"]));
		$nik = htmlspecialchars(addslashes($_POST["nik"]));
		$no_kk = htmlspecialchars(addslashes($_POST["no_kk"]));
		$nama_mahasiswa = htmlspecialchars(addslashes($_POST["nama_mahasiswa"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$no_telepon = htmlspecialchars(addslashes($_POST["no_telepon"]));
		$fakultas = htmlspecialchars(addslashes($_POST["fakultas"]));
		$prodi = htmlspecialchars(addslashes($_POST["prodi"]));
		$keterangan = htmlspecialchars(addslashes($_POST["keterangan"]));

		$foto = htmlspecialchars(addslashes($_FILES["foto"]["name"]));
		$ekstensi = explode(".", $foto);
        $ekstensi = strtolower(end($ekstensi));
        $uploadfoto = "IMG".date("Ymdhis").".".$ekstensi;

		if ($foto == "") {
			$this->db->query("UPDATE mahasiswa SET 
				nis = '$nis',
				nik = '$nik',
				no_kk = '$no_kk',
				nama_mahasiswa = '$nama_mahasiswa',
				no_telepon = '$no_telepon',
				email = '$email',
				fakultas = '$fakultas',
				prodi = '$prodi',
				keterangan = '$keterangan'
				WHERE id_mahasiswa = $id
			");
		} else {
			$result = $this->db->query("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id");
			$data = $result->row();
			unlink("assets/images/$data->foto");
			$this->db->query("UPDATE mahasiswa SET 
				nis = '$nis',
				nik = '$nik',
				no_kk = '$no_kk',
				nama_mahasiswa = '$nama_mahasiswa',
				no_telepon = '$no_telepon',
				email = '$email',
				fakultas = '$fakultas',
				prodi = '$prodi',
				keterangan = '$keterangan',
				foto = '$uploadfoto'
				WHERE id_mahasiswa = $id
			");
			move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/images/". $uploadfoto);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/mahasiswa');

	}

	public function hapus($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		
		$result = $this->db->query("SELECT * FROM mahasiswa WHERE id_mahasiswa = $id");
		$data = $result->row();
		unlink("assets/images/$data->foto");
		
		$this->db->query("DELETE FROM mahasiswa WHERE id_mahasiswa = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/mahasiswa');
	}
}
