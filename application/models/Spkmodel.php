<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Spkmodel extends CI_Model {

    public function getkriteria(){
    	$this->db->select('*');
        $this->db->from('data_kriteria');
    	$data = $this->db->get();
    	return $data;
    }

    public function addKriteria($data){
    	$isian = array(
    		'nama_kriteria' => $data['nama_kriteria'],
    		'bobot' => $data['bobot'],
    		'status' => $data['jenis'],
    	);
    	$this->db->insert('data_kriteria',$isian);
    	return;
    }

    public function addNilaikriteria($data,$id){
    	$isian = array('bobot_w' => $data['bobot'],);
    	$this->db->where($id);
        $this->db->update('data_kriteria',$isian);
        return;
    }

    public function praEditkriteria($id){
    	$this->db->select('*');
        $this->db->from('data_kriteria');
        $this->db->where('id_data',$id);
        $data = $this->db->get();
        return $data;
    }

    public function updateKriteria($data,$id){
    	$this->db->where('id_data' ,$id);
        $this->db->update('data_kriteria',$data);
        return;
    }

    public function hapusKriteria($id){
    	$this->db->trans_start();

	    	$this->db->where('id_data',$id);
	        $this->db->delete('data_kriteria');

	        $this->db->where('id_kriteria',$id);
	        $this->db->delete('data_perhitungan');

        $this->db->trans_complete();
        return;
    }

    public function getNilaimahasiswa(){
    	$this->db->select('*');
      	$this->db->from('data_isian');
      	$this->db->join('mahasiswa','mahasiswa.id_mahasiswa = data_isian.id_mahasiswa','left');
      	$query = $this->db->get();
      	return $query;
    }

    public function getMahasiswa(){
    	$this->db->select('*');
      	$this->db->from('mahasiswa');
      	$query = $this->db->get();
      	return $query;
    }

    public function getNilairef($id){
    	$this->db->select('*');
      	$this->db->from('data_perhitungan');
      	$this->db->where('id_mahasiswa',$id);
      	$query = $this->db->get();
      	return $query;
    }

    public function addNilai($data){
	    	$isian = array(
	    		'id_mahasiswa' => $data['id_mahasiswa'],
	    		'id_kriteria' => $data['id_kriteria'],
	    		'nilai_ref' => $data['nilai_ref'],
	    	);
	    	$this->db->insert('data_perhitungan',$isian);
    }

    public function addisian($data){
    	$isian2 = array(
	    		'id_mahasiswa' => $data['id_mahasiswa'],
	    	);
	    $this->db->insert('data_isian',$isian2);
    }

    public function getKriterianilai($id){
    	$this->db->select('*');
      	$this->db->from('data_kriteria');
      	$this->db->where('id_data',$id);
      	$query = $this->db->get();
      	return $query;
    }
    

    public function valNilai($id){
    	$this->db->select('*');
      	$this->db->from('data_isian');
      	$this->db->where('id_mahasiswa',$id);
      	$query = $this->db->get();
      	return $query;
    }

    public function updateIsian($data){
    	$datas = array('vektor_s' => $data['vektor_s'], );
    	$this->db->where('id_mahasiswa' ,$data['id_mahasiswa']);
        $this->db->update('data_isian',$datas);
        return;
    }

    public function getNilaispek($id){
    	$this->db->select('*');
      	$this->db->from('mahasiswa');
      	$this->db->where('id_mahasiswa',$id);
      	$query = $this->db->get();
      	return $query;
    }

    public function getNilairefid($id){
    	$this->db->select('*');
      	$this->db->from('data_perhitungan');
      	$this->db->where('id_mahasiswa',$id);
      	$this->db->join('data_kriteria','data_kriteria.id_data = data_perhitungan.id_kriteria','left');
      	$query = $this->db->get();
      	return $query;
    }
    public function getNilaikerid($id,$data){
    	$this->db->select('*');
      	$this->db->from('data_perhitungan');
      	$this->db->where('id_mahasiswa',$id);
      	$this->db->where('id_kriteria',$data);
      	$query = $this->db->get();
      	return $query;
    }

    public function updateNilai($data){
	   $isian = array(
	   	'nilai_ref' => $data['nilai_ref'],
	   );
	   $this->db->where('id_mahasiswa' ,$data['id_mahasiswa']);
	   $this->db->where('id_kriteria' ,$data['id_kriteria']);
       $this->db->update('data_perhitungan',$isian);
       return;
    }

    public function hapusNilai($id){
    	$this->db->trans_start();
	    	$this->db->where('id_mahasiswa',$id);
	        $this->db->delete('data_isian');

	        $this->db->where('id_mahasiswa',$id);
	        $this->db->delete('data_perhitungan');
		$this->db->trans_complete();
    	
        return;
    }




}