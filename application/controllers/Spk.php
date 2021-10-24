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
		$data["kriteria"] = $this->Spkmodel->getkriteria()->result();
		$data["nilai"] = $this->Spkmodel->getNilaimahasiswa()->result();
		$data["mahasiswa"] = $this->Spkmodel->getMahasiswa()->result();
		
		$this->load->view('layout/header', $data);
		$this->load->view('spk/input', $data);
		$this->load->view('layout/footer');
	}

	public function addNilai(){
		$nama = $this->input->post('idmahasiswa');
		$ids = $this->input->post('idmahasiswa');
		$ker = $this->Spkmodel->getkriteria()->result();
		$val = count($this->Spkmodel->valNilai($nama)->result());
		if ($val >= 1) {
			$this->session->set_flashdata('success', '<div class="alert alert-warning">Data Sudah Ada !</div>');
			redirect('spk/input');
		}else{
			foreach ($ker as $k) {
				$datarr = array(
					'nilai_ref' => $this->input->post($k->id_data),
					'id_kriteria' => $k->id_data,
					'id_mahasiswa' => $nama,
					);
				$this->Spkmodel->addNilai($datarr);	
			}
			$this->Spkmodel->addisian($ids);

			$vektor = $this->hitungNilai($nama);
			$isian = array(
				'vektor_s' => $vektor, 
				'id_mahasiswa' => $nama,
			);

			$this->Spkmodel->updateIsian($isian);
			// var_dump($isian);
			$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil di tambahkan !</div>');
			redirect('spk/input');
		}
		
	}

	public function praEditnilai(){
		$idmahasiswa = $this->input->post('iddata');
		// $ker = $this->Spkmodel->getkriteria()->result();
		$nilai = $this->Spkmodel->getNilairefid($idmahasiswa)->result();
		$spek = $this->Spkmodel->getNilaispek($idmahasiswa)->row();
		echo '
			<div class="form-group">
            <label>Nama Mahasiswa</label>
            <input type="hidden" name="iddata" value="'.$spek->id_mahasiswa.'">
            <input type="text" name="" readonly value="'.$spek->nama_mahasiswa.'" class="form-control">
          </div>';
           foreach ($nilai as $kir) {
           	$nil = $this->Spkmodel->getNilaikerid($idmahasiswa,$kir->id_kriteria)->row();
           	echo '
            <div class="form-group">
            <label>'.$kir->nama_kriteria.'</label>
            <input type="text" name="'.$kir->id_kriteria.'" class="form-control" value="'.$nil->nilai_ref.'">
          </div>';
      		}
		
	}

	public function editNilai(){
		$nama = $this->input->post('iddata');
		$id = $this->input->post('iddata');
		$ker = $this->Spkmodel->getkriteria()->result();
		
		foreach ($ker as $k) {
			$datarr = array(
				'nilai_ref' => $this->input->post($k->id_data),
				'id_kriteria' => $k->id_data,
				'id_mahasiswa' => $nama,
				);
			$this->Spkmodel->updateNilai($datarr);	
		}
		$vektor = $this->hitungNilai($nama);
		$isian = array(
			'vektor_s' => $vektor, 
			'id_mahasiswa' => $nama,
		);

		$this->Spkmodel->updateIsian($isian);
		$this->session->set_flashdata('success', '<div class="alert alert-success">Data berhasil di ubah !</div>');
		redirect('spk/input');
		
	}

	public function hapusNilai($id){
		$this->Spkmodel->hapusNilai($id);
		$this->session->set_flashdata('success', '<div class="alert alert-warning">Data berhasil di hapus !</div>');
		redirect('spk/input');
	}

	public function lulus(){
		$cek = count($this->Spkmodel->getLulus()->result());
		$getmas = $this->Spkmodel->getLulus()->result();
		if ($cek > 0) {
			foreach ($getmas as $d) {
				$lulus = $this->hitungKelulusan($d->id_mahasiswa);
				$kelulusan = array(
					'id_mahasiswa' => $d->id_mahasiswa,
					'nilai_akhir' => $lulus
				);
				$this->Spkmodel->updateIsianLulus($kelulusan);
				// echo $kelulusan['nilai_akhir']."<br><br>";
			}

			$data["switch"] = 'terisi';
		}else{
			$data["switch"] = 'kosong';
		}
		$data["title"] = "Cek Kelulusan";
		$data["mahasiswa"] = $this->Spkmodel->getNilaiKelulusan()->result();
		// $test = $this->Spkmodel->getNilaiKelulusan()->result();
		// var_dump($test);
		$this->load->view('layout/header', $data);
		$this->load->view('spk/lulus', $data);
		$this->load->view('layout/footer');
	}


	private function hitungKelulusan($id){
		$dataker = $this->Spkmodel->getlulus()->result();
		foreach ($dataker as $key) {
			$arr[] = $key->vektor_s;
		}
		$jumlahbawah = array_sum($arr);

		$datamahas = $this->Spkmodel->getLulusmahas($id)->row();
		$rumus = $datamahas->vektor_s / $jumlahbawah ;
		
		return $rumus;
		// var_dump($rumus);
	}

	private function hitungNilai($id){
		$ambilnilai = $this->Spkmodel->getNilairef($id)->result();
		foreach ($ambilnilai as $ab) {
			$p = $this->Spkmodel->getKriterianilai($ab->id_kriteria)->row();
			if ($p->status == 'B') {
				$pk = $p->bobot_w;
			}elseif ($p->status == 'C') {
				$pk = "-".$p->bobot_w;
			}
			$a[] =pow($ab->nilai_ref, $pk);
		}
		$output = array_reduce($a, function($prev, $now){return $prev*$now;}, 1);
		return $output;
		// var_dump($a);
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

	public function test(){
		$dataker = $this->Spkmodel->getNilairef('7')->result();
		var_dump($dataker['0']->nilai_ref);
	}
	
}
