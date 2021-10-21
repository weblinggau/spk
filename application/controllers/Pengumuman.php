<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumuman extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Pengumuman - SPK Beasiswa";

		$query = $this->db->query("SELECT * FROM pengumuman ORDER BY id_pengumuman DESC");
		$pengumuman["pengumuman"] = $query;
		$this->load->view('layout/header', $data);
		$this->load->view('pengumuman', $pengumuman);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		$keterangan = addslashes($_POST["keterangan"]);
		$tanggal = date("Y-m-d");

		$dokumen = htmlspecialchars(addslashes($_FILES["dokumen"]["name"]));
		$ekstensi = explode(".", $dokumen);
        $ekstensi = strtolower(end($ekstensi));
        $uploaddokumen = "DOK".date("Ymdhis").".".$ekstensi;

		$this->db->query("INSERT INTO pengumuman VALUES (
			null,
			'$keterangan',
			'$uploaddokumen',
			'$tanggal'
		)");
		move_uploaded_file($_FILES["dokumen"]["tmp_name"], "assets/berkas/". $uploaddokumen);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/pengumuman');

	}

	public function ubah($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		$keterangan = addslashes($_POST["keterangan"]);
		$tanggal = htmlspecialchars(addslashes($_POST["tanggal"]));

		$dokumen = htmlspecialchars(addslashes($_FILES["dokumen"]["name"]));
		$ekstensi = explode(".", $dokumen);
        $ekstensi = strtolower(end($ekstensi));
        $uploaddokumen = "DOK".date("Ymdhis").".".$ekstensi;

		if ($dokumen == "") {
			$this->db->query("UPDATE pengumuman SET 
				keterangan = '$keterangan',
				WHERE id_pengumuman = $id
			");
		} else {
			$result = $this->db->query("SELECT * FROM pengumuman WHERE id_pengumuman = $id");
			$data = $result->row();
			unlink("assets/berkas/$data->dokumen");
			$this->db->query("UPDATE pengumuman SET 
				keterangan = '$keterangan',
				dokumen = '$uploaddokumen'
				WHERE id_pengumuman = $id
			");
			move_uploaded_file($_FILES["dokumen"]["tmp_name"], "assets/berkas/". $uploaddokumen);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/pengumuman');

	}

	public function hapus($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		
		$result = $this->db->query("SELECT * FROM pengumuman WHERE id_pengumuman = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->dokumen");
		
		$this->db->query("DELETE FROM pengumuman WHERE id_pengumuman = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/pengumuman');
	}
}
