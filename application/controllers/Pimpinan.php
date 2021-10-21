<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pimpinan extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($session = $this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
		if ($session["level"] == 3) {
			redirect('/');
		}
	}

	public function index()
	{
		$session = $this->session->userdata('logged_in');
		$id_user = $session["id_user"];
		$data["title"] = "Pimpinan - SPK Beasiswa";
		$query1 = $this->db->query("SELECT * FROM pimpinan");
		$query2 = $this->db->query("SELECT * FROM user WHERE level = 2");
		$query3 = $this->db->query("SELECT *, pimpinan.foto AS fotopimpinan, pimpinan.email AS mail FROM pimpinan JOIN user ON pimpinan.id_user = user.id_user WHERE pimpinan.id_user = user.id_user AND pimpinan.id_user = $id_user");
		$pimpinan["pimpinan"] = $query1;
		$pimpinan["user"] = $query2;
		$pimpinan["userpimpinan"] = $query3->row();
		$this->load->view('layout/header', $data);
		$this->load->view('pimpinan', $pimpinan);
		$this->load->view('layout/footer');
	}

	public function tambah()
	{
		$id_user = htmlspecialchars(addslashes($_POST["id_user"]));
		$nama_pimpinan = htmlspecialchars(addslashes($_POST["nama_pimpinan"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$jenis_kelamin = htmlspecialchars(addslashes($_POST["jenis_kelamin"]));

		$foto = htmlspecialchars(addslashes($_FILES["foto"]["name"]));
		$ekstensi = explode(".", $foto);
        $ekstensi = strtolower(end($ekstensi));
        $uploadfoto = "IMG".date("Ymdhis").".".$ekstensi;

		$this->db->query("INSERT INTO pimpinan VALUES (
			null,
			'$id_user',
			'$nama_pimpinan',
			'$email',
			'$jenis_kelamin',
			'$uploadfoto'
		)");
		move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/images/". $uploadfoto);

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('/pimpinan');

	}

	public function ubah($id)
	{
		$nama_pimpinan = htmlspecialchars(addslashes($_POST["nama_pimpinan"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$jenis_kelamin = htmlspecialchars(addslashes($_POST["jenis_kelamin"]));

		$foto = htmlspecialchars(addslashes($_FILES["foto"]["name"]));
		$ekstensi = explode(".", $foto);
        $ekstensi = strtolower(end($ekstensi));
        $uploadfoto = "IMG".date("Ymdhis").".".$ekstensi;

        if ($foto == "") {
			$this->db->query("UPDATE pimpinan SET 
				nama_pimpinan = '$nama_pimpinan',
				email = '$email',
				jenis_kelamin = '$jenis_kelamin'
				WHERE id_pimpinan = $id
			");
        } else {
        	$result = $this->db->query("SELECT * FROM pimpinan WHERE id_pimpinan = $id");
			$data = $result->row();
			unlink("assets/images/$data->foto");

			$this->db->query("UPDATE pimpinan SET 
				nama_pimpinan = '$nama_pimpinan',
				email = '$email',
				jenis_kelamin = '$jenis_kelamin',
				foto = '$uploadfoto'
				WHERE id_pimpinan = $id
			");
			move_uploaded_file($_FILES["foto"]["tmp_name"], "assets/images/". $uploadfoto);
        }

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diperbarui !</div>');
		redirect('/pimpinan');

	}

	public function hapus($id)
	{
		$result = $this->db->query("SELECT * FROM pimpinan WHERE id_pimpinan = $id");
		$data = $result->row();
		unlink("assets/images/$data->foto");
		
		$this->db->query("DELETE FROM pimpinan WHERE id_pimpinan = $id");
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('/pimpinan');
	}
}
