<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index()
	{
        $d['title'] = 'Administración';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			$nombre = $_POST['nombre'];
			$email = $_POST['email'];
			$usuario = $_POST['usuario'];
			$clave = sha1($_POST['clave']);
			$rol = $_POST['rol'];

			$array = array(
				'nombre'	=>	$nombre,
				'email'		=>	$email,
				'usuario'	=>	$usuario,
				'clave'		=>	$clave,
				'rol'		=>	$rol
			);

			$this->db->insert('usuarios', $array);

			$d['msg'] = 'success';
		}

		$d['usuarios'] = $this->model->all_users_all_status();
		$d['roles'] = $this->model->all_roles();

        $this->load->view('header_view', $h);
		$this->load->view('administracion/usuarios_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_usuario($idu)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idu);
		$this->db->update('usuarios', $array);
		redirect(base_url('administracion/usuarios'));
	}

	public function reactivar_usuario($idu)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idu);
		$this->db->update('usuarios', $array);
		redirect(base_url('administracion/usuarios'));
	}

	public function editar_usuario($idu)
	{
		$d['title'] = 'Administración';
        $h['title'] =  $d['title'];


		if(isset($_POST['guardar'])){
			$nombre = $_POST['nombre'];
			$email = $_POST['email'];
			$usuario = $_POST['usuario'];
			$rol = $_POST['rol'];

			$array = array(
				'nombre'	=>	$nombre,
				'email'		=>	$email,
				'usuario'	=>	$usuario,
				'rol'		=>	$rol
			);

			$this->db->where('id', $idu);
			$this->db->update('usuarios', $array);

			redirect(base_url('administracion/usuarios'));
		}

		$d['usuario'] = $this->model->get_user($idu);
		$d['roles'] = $this->model->all_roles();

		$this->load->view('header_view', $h);
		$this->load->view('administracion/editar_usuario_view', $d);
        $this->load->view('footer_view', $h);
	}
}
