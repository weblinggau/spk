<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Login extends CI_Controller {
	function __construct()   
    {   
        parent::__construct();   

         $this->load->model('Mlogin');
    }
	   
	public function index()
	{
		$this->load->view('login');
	}

	public function registrasi()
	{
		$username = htmlspecialchars(addslashes($_POST["username"]));
		$password = htmlspecialchars(addslashes(sha1($_POST["password"])));
		$nama_user = htmlspecialchars(addslashes($_POST["nama_user"]));
		$email = htmlspecialchars(addslashes($_POST["email"]));
		$created = date("Y-m-d");

		$cekuser = $this->db->query("SELECT count(*) AS un FROM user WHERE username = '$username'");
		$data = $cekuser->row();
		if ($data->un > 0) {
			$this->session->set_flashdata('faileds', '<div class="alert alert-danger">Username sudah terdaftar !</div>');
			echo "<script>document.location='../login#signup';</script>";
		} else {
		
			$this->db->query("INSERT INTO user VALUES (
				null,
				'$username',
				'$password',
				'$nama_user',
				'$email',
				'3',
				'$created',
				null
			)");

			$this->session->set_flashdata('success', '<div class="alert alert-success">Akun berhasil dibuat !</div>');
			redirect('/login');
		}

	}
	
	public function act()
	{
		$this->load->model('Mlogin');
		if(isset($_POST['login'])){
			$user= $this->input->post('username',true);
			$pass= sha1($this->input->post('password',true));
			$level= $this->input->post('level',true);
			
			$cek= $this->Mlogin->proseslogin($user,$pass,$level);
		
			$data=$this->db->get_where('user',array('username'=>$user,'password'=>$pass,'level'=>$level))->row();
			if($data)
			{
				$session=array(
					'id_user'=>$data->id_user,
					'username'=>$user,
					'nama_user'=>$data->nama_user,
					'email'=>$data->email,
					'level'=>$data->level
				);
				$this->session->set_userdata('logged_in',$session);
				redirect('apps');
				
			}
		
			else
			
			{
				$this->session->set_flashdata('failed', '<div class="alert alert-danger">Username atau Password salah !</div>');
				redirect('/login');
			}
		
		}
	}
	
	
	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('/login');
	}
}	   
