<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedores extends CI_Controller {

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
			$dpi = $_POST['dpi'];
			$nit = $_POST['nit'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$contacto = $_POST['contacto'];

			$array = array(
                'nombre'            =>  $nombre,
                'dpi'               =>  $dpi,
                'nit'               =>  $nit,
                'direccion'         =>  $direccion,
                'telefono'          =>  $telefono,
                'email'             =>  $email,
				'contacto'			=>	$contacto,
			);

			$this->db->insert('proveedores', $array);

			$d['msg'] = 'success';
		}

        $d['proveedores'] = $this->model->all_proveedores_all_status();
		$d['monedas'] = $this->model->all_monedas();

        $this->load->view('header_view', $h);
		$this->load->view('administracion/proveedores_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_proveedor($idu)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idu);
		$this->db->update('proveedores', $array);
		redirect(base_url('administracion/proveedores'));
	}

	public function reactivar_proveedores($idu)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idu);
		$this->db->update('proveedores', $array);
		redirect(base_url('administracion/proveedores'));
	}

	public function editar_proveedor($idu)
	{
		$d['title'] = 'Administración';
        $h['title'] =  $d['title'];


		if(isset($_POST['guardar'])){
			$nombre = $_POST['nombre'];
			$dpi = $_POST['dpi'];
			$nit = $_POST['nit'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$contacto = $_POST['contacto'];

			$array = array(
                'nombre'            =>  $nombre,
                'dpi'               =>  $dpi,
                'nit'               =>  $nit,
                'direccion'         =>  $direccion,
                'telefono'          =>  $telefono,
                'email'             =>  $email,
				'contacto'			=>	$contacto
			);

			$this->db->where('id', $idu);
			$this->db->update('proveedores', $array);

			redirect(base_url('administracion/proveedores'));
		}

		$d['proveedor'] = $this->model->get_proveedor($idu);
		$d['monedas'] = $this->model->all_monedas();

		$this->load->view('header_view', $h);
		$this->load->view('administracion/editar_proveedor_view', $d);
        $this->load->view('footer_view', $h);
	}
}
