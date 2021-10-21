<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Jadwal - SPK Beasiswa";

		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];

		$query = $this->db->query("SELECT * FROM jadwal JOIN mahasiswa ON jadwal.id_mahasiswa = mahasiswa.id_mahasiswa ORDER BY id_jadwal DESC");
		$query0 = $this->db->query("SELECT * FROM jadwal JOIN mahasiswa ON jadwal.id_mahasiswa = mahasiswa.id_mahasiswa JOIN user ON mahasiswa.id_user = user.id_user WHERE mahasiswa.id_user = mahasiswa.id_user AND mahasiswa.id_user = $id_user");
		$query1 = $this->db->query("SELECT * FROM mahasiswa");
		$jadwal["jadwal"] = $query;
		$jadwal["jadwalmhs"] = $query0->row();
		$jadwal["mahasiswa"] = $query1;
		$this->load->view('layout/header', $data);
		$this->load->view('jadwal', $jadwal);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		$id_mahasiswa = htmlspecialchars(addslashes($_POST["id_mahasiswa"]));
		$tanggal = htmlspecialchars(addslashes($_POST["tanggal"]));

		$dokumen = htmlspecialchars(addslashes($_FILES["dokumen"]["name"]));
		$ekstensi = explode(".", $dokumen);
        $ekstensi = strtolower(end($ekstensi));
        $uploaddokumen = "DOK".date("Ymdhis").".".$ekstensi;

		$this->db->query("INSERT INTO jadwal VALUES (
			null,
			'$id_mahasiswa',
			'$tanggal',
			'$uploaddokumen'
		)");
		move_uploaded_file($_FILES["dokumen"]["tmp_name"], "assets/berkas/". $uploaddokumen);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/jadwal');

	}

	public function ubah($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		$id_mahasiswa = htmlspecialchars(addslashes($_POST["id_mahasiswa"]));
		$tanggal = htmlspecialchars(addslashes($_POST["tanggal"]));

		$dokumen = htmlspecialchars(addslashes($_FILES["dokumen"]["name"]));
		$ekstensi = explode(".", $dokumen);
        $ekstensi = strtolower(end($ekstensi));
        $uploaddokumen = "DOK".date("Ymdhis").".".$ekstensi;

		if ($dokumen == "") {
			$this->db->query("UPDATE jadwal SET 
				id_mahasiswa = '$id_mahasiswa',
				tanggal = '$tanggal'
				WHERE id_jadwal = $id
			");
		} else {
			$result = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal = $id");
			$data = $result->row();
			unlink("assets/berkas/$data->dokumen");
			$this->db->query("UPDATE jadwal SET 
				id_mahasiswa = '$id_mahasiswa',
				tanggal = '$tanggal',
				dokumen = '$uploaddokumen'
				WHERE id_jadwal = $id
			");
			move_uploaded_file($_FILES["dokumen"]["tmp_name"], "assets/berkas/". $uploaddokumen);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/jadwal');

	}

	public function hapus($id)
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];
		if ($session_data["level"] != 1) {
			redirect('/');
		}
		
		$result = $this->db->query("SELECT * FROM jadwal WHERE id_jadwal = $id");
		$data = $result->row();
		unlink("assets/berkas/$data->dokumen");
		
		$this->db->query("DELETE FROM jadwal WHERE id_jadwal = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/jadwal');
	}

	public function cetak()
	{
		$mpdf = new \Mpdf\Mpdf();
		$mpdf = new \Mpdf\Mpdf(['format' => 'A4']);
		$mpdf->AddPage('L'); 

		$query = $this->db->query("SELECT * FROM jadwal JOIN mahasiswa ON jadwal.id_mahasiswa = mahasiswa.id_mahasiswa");
		$jadwal["jadwal"] = $query;

		$data = $this->load->view('cetakjadwal',$jadwal, TRUE);
		$mpdf->WriteHTML($data);
		$mpdf->Output('DATA JADWAL WAWANCARA MAHASISWA'.date('Ymdhis').'.pdf', 'D');
	}
}
