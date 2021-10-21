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
    	$this->db->where('id_data',$id);
        $this->db->delete('data_kriteria');
        return;
    }


}