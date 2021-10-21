<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
		if ($session["level"] != 1) {
			redirect('/');
		}
	}

	public function index()
	{
		$data["title"] = "User - SPK Beasiswa";
		$query = $this->db->query("SELECT * FROM user");
		$user["user"] = $query;
		$this->load->view('layout/header', $data);
		$this->load->view('user', $user);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$username = htmlspecialchars(addslashes($_POST["username"]));
		$password = htmlspecialchars(addslashes(sha1($_POST["password"])));
		$nama_user = htmlspecialchars(addslashes($_POST["nama_user"]));
		$created = date("Y-m-d");
		$level = htmlspecialchars(addslashes($_POST["level"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));

		$cekuser = $this->db->query("SELECT count(*) AS un FROM user WHERE username = '$username'");
		$data = $cekuser->row();
		if ($data->un > 0) {
			$this->session->set_flashdata('failed', '<div class="alert alert-danger">Username sudah terdaftar !</div>');
			redirect('/user');
		} else {
		
			$this->db->query("INSERT INTO user VALUES (
				null,
				'$username',
				'$password',
				'$nama_user',
				'$email',
				'$level',
				'$created',
				null
			)");

			$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
			redirect('/user');
		}

	}

	public function ubah($id)
	{
		$username = htmlspecialchars(addslashes($_POST["username"]));
		$nama_user = htmlspecialchars(addslashes($_POST["nama_user"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$updated = date("Y-m-d");
		$level = htmlspecialchars(addslashes($_POST["level"]));

		$this->db->query("UPDATE user SET 
			username = '$username',
			nama_user = '$nama_user',
			email = '$email',
			level = '$level',
			updated = '$updated'
			WHERE id_user = $id
		");

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/user');

	}

	public function ubahpassword($id)
	{
		$password = htmlspecialchars(addslashes(sha1($_POST["password"])));

		$this->db->query("UPDATE user SET 
			password = '$password'
			WHERE id_user = $id
		");

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/user');

	}

	public function hapus($id)
	{
		$this->db->query("DELETE FROM user WHERE id_user = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/user');
	}
}
