<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Apps extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
	}

	public function index()
	{
		$data["title"] = "Dashboard - SPK Beasiswa";

		$query1 = $this->db->query("SELECT count(*) AS jml FROM pimpinan");
		$statistik["pimpinan"] = $query1->row();
		$query2 = $this->db->query("SELECT count(*) AS jml FROM mahasiswa");
		$statistik["mahasiswa"] = $query1->row();
		$query3 = $this->db->query("SELECT count(*) AS jml FROM nilai_kriteria");
		$statistik["kriteria"] = $query3->row();
		$query4 = $this->db->query("SELECT count(*) AS jml FROM user");
		$statistik["user"] = $query4->row();

		$this->load->view('layout/header', $data);
		$this->load->view('home', $statistik);
		$this->load->view('layout/footer');
	}

	public function ubahprofil()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];

		$username = htmlspecialchars(addslashes($_POST["username"]));
		$nama_user = htmlspecialchars(addslashes($_POST["nama_user"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$updated = date("Y-m-d");

		$query = $this->db->query("UPDATE user SET 
			username = '$username',
			nama_user = '$nama_user',
			email = '$email',
			updated = '$updated'
			WHERE id_user = $id_user
		");
		echo "<script>
		alert('Profil berhasil diperbarui, anda akan logout terlebih dahulu !');
		document.location='../login/logout';
		</script>";
	}

	public function ubahpassword()
	{
		$session_data = $this->session->userdata('logged_in');
		$id_user = $session_data["id_user"];

		$password_sebelum = htmlspecialchars(addslashes(sha1($_POST["password_sebelum"])));
		$password_baru = htmlspecialchars(addslashes(sha1($_POST["password_baru"])));
		$konfirmasi_password = htmlspecialchars(addslashes(sha1($_POST["konfirmasi_password"])));

		$query = $this->db->query("SELECT * FROM user WHERE id_user = $id_user");
		$data = $query->row();

		if ($data->password != $password_sebelum) {
			$this->session->set_flashdata('failed', '<div class="alert alert-danger" style="border-radius: 0px; border: 0px solid #333;"><i class="fa fa-remove"></i> Password Sebelum Tidak Sesuai !</div>');
			redirect('/apps');
		} elseif ($password_baru != $konfirmasi_password) {
			$this->session->set_flashdata('failed', '<div class="alert alert-danger" style="border-radius: 0px; border: 0px solid #333;"><i class="fa fa-remove"></i> Konfirmasi Password Tidak Sesuai !</div>');
			redirect('/apps');
		} else {
			$query = $this->db->query("UPDATE user SET 
				password = '$password_baru'
				WHERE id_user = $id_user
			");
			echo "<script>
			alert('Password berhasil diperbarui, anda akan logout terlebih dahulu !');
			document.location='../login/logout';
			</script>";
		}
	}
}
