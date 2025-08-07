<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();
  	}

	public function index()
	{
		$d['msg'] = '';
		if(isset($_POST['login'])){
			$user= $_POST['username'];
			$password = sha1($_POST['password']);

				$check = $this->model->check_user($user, $password);

				// echo $user;
				// echo "<br>";
				// echo $password;
				// echo "<br>";
				// print_r($check);
				// die();

				if(count($check) > 0){
					$_SESSION['logged'] = true;
					$_SESSION['nombre'] = $check[0]['nombre'];
					$_SESSION['email'] = $check[0]['email'];
					$_SESSION['rol'] = $check[0]['idrol'];
					$_SESSION['rolname'] = $check[0]['rol'];
					$_SESSION['uid'] = $check[0]['idusuario'];

					// print_r($_SESSION);
					// die();

					redirect(base_url('dashboard'));
				}else{
					$d['msg'] = "error";
				}
		}
		$this->load->view('login_view', $d);
	}
}
