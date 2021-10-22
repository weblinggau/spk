<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spk extends CI_Controller {

	function __construct() {
		parent::__construct();
		if (!($this->session->userdata('logged_in'))) {
			redirect(site_url("/login"));
		}
		$this->load->model('Spkmodel');
	}

	public function Kriteria()
	{
		$data["kriteria"] = $this->Spkmodel->getkriteria()->result();
		$data["title"] = "Data Kriteria";
	
		$this->load->view('layout/header', $data);
		$this->load->view('spk/kriteria', $data);
		$this->load->view('layout/footer');
	}

	public function addKriteria(){
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$jenis = $this->input->post('jenis');
		$datarr = array(
			'nama_kriteria' => $nama, 
			'bobot' => $bobot,
			'jenis' => $jenis,
		); 
		$this->Spkmodel->addKriteria($datarr);
		$dataker = $this->Spkmodel->getkriteria()->result();
		// addNilaikriteria
		foreach ($dataker as $key) {
			$id = array('id_data' => $key->id_data,);
			$nilai = $this->hitung($key->bobot);
			$isian = array('bobot' => $nilai, );
			$this->Spkmodel->addNilaikriteria($isian,$id);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil ditambahkan !</div>');
		redirect('spk/kriteria');
	}

	public function hapuskriteria($id){
		$this->Spkmodel->hapusKriteria($id);
		$dataker = $this->Spkmodel->getkriteria()->result();
		// addNilaikriteria
		foreach ($dataker as $key) {
			$id = array('id_data' => $key->id_data,);
			$nilai = $this->hitung($key->bobot);
			$isian = array('bobot' => $nilai, );
			$this->Spkmodel->addNilaikriteria($isian,$id);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil dihapus !</div>');
		redirect('spk/kriteria');

	}

	public function praeditkriteria(){
		$iddata = $this->input->post('iddata');
		$ambildata = $this->Spkmodel->praEditkriteria($iddata)->row();
		echo '
		<div class="form-group">
            <label>Nama Kriteria</label>
            <input type="hidden" name="iddata" value="'.$ambildata->id_data.'">
            <input type="text" name="nama" required="" class="form-control" value="'.$ambildata->nama_kriteria.'">
          </div>
          <div class="form-group">
            <label>Bobot</label>
            <input type="number" name="bobot" required="" class="form-control" value="'.$ambildata->bobot.'">
          </div>
          <div class="form-group">
            <label>Jenis</label>
            <select class="form-control" name="jenis">
            	<option value="'.$ambildata->status.'">'.$ambildata->status.'</option>
                  <option value="B">Benefit</option>
                  <option value="C">Cost</option>
            </select>
          </div>
		';
	}

	public function editkriteria(){
		$nama = $this->input->post('nama');
		$bobot = $this->input->post('bobot');
		$jenis = $this->input->post('jenis');
		$iddata = $this->input->post('iddata');
		$datarr = array(
			'nama_kriteria' => $nama, 
			'bobot' => $bobot,
			'status' => $jenis,
		); 
		$this->Spkmodel->updateKriteria($datarr,$iddata);
		$dataker = $this->Spkmodel->getkriteria()->result();
		// addNilaikriteria
		foreach ($dataker as $key) {
			$id = array('id_data' => $key->id_data,);
			$nilai = $this->hitung($key->bobot);
			$isian = array('bobot' => $nilai, );
			$this->Spkmodel->addNilaikriteria($isian,$id);
		}

		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil diubah !</div>');
		redirect('spk/kriteria');
	}

	public function input()	{
		$data["title"] = "Input Nilai Mahasiswa";
		$data["kriteria"] = "";
		$this->load->view('layout/header', $data);
		$this->load->view('spk/input', $data);
		$this->load->view('layout/footer');
	}

	private function hitung($data){
		$dataker = $this->Spkmodel->getkriteria()->result();
		foreach ($dataker as $key) {
			$arr[] = $key->bobot;
		}
		$jumlahbawah = array_sum($arr);

		$rumus = $data / $jumlahbawah ;
		return $rumus;
	}
	
}
