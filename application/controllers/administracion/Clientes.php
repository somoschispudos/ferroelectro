<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

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
		
		$d['asesores'] = $this->model->get_user_roles_all_status(2);

        if($_SESSION['rol'] == 1){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }elseif($_SESSION['rol'] == 2){
            $d['clientes'] = $this->model->get_all_clientes_asesor($_SESSION['uid']);
        }elseif($_SESSION['rol'] == 5){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }

        $this->load->view('header_view', $h);
		$this->load->view('administracion/clientes_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_cliente($idc)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idc);
		$this->db->update('clientes', $array);
		redirect(base_url('administracion/clientes'));
	}

	public function reactivar_cliente($idc)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idc);
		$this->db->update('clientes', $array);
		redirect(base_url('administracion/clientes'));
	}

	public function editar_cliente($idc)
	{
		$d['title'] = 'Administración';
        $h['title'] =  $d['title'];


		if(isset($_POST['guardar'])){
			$nombre = $_POST['nombre'];
			$nit = $_POST['nit'];
			$razonsocial = $_POST['razonsocial'];
			$contacto = $_POST['contacto'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];

			$array = array(
				'nombre'		=>	$nombre,
				'nit'			=>	$nit,
				'razonsocial'	=>	$razonsocial,
				'contacto'		=>	$contacto,
				'email'			=>	$email,
				'direccion'		=>	$direccion,
				'asesor'		=>	1
			);

			// echo "<pre>";
			// print_r($array);
			// die();

			$this->db->where('id', $idc);
			$this->db->update('clientes', $array);

			redirect(base_url('administracion/clientes'));
		}

		$d['clientes'] = $this->model->get_cliente($idc);
		// echo "<pre>";
		// print_r($d['clientes']);
		// die();
		$d['cliente'] = $this->model->get_cliente($idc);
		$d['roles'] = $this->model->all_roles();
		$d['asesores'] = $this->model->get_user_roles_all_status(2);

		$this->load->view('header_view', $h);
		$this->load->view('administracion/editar_cliente_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function nuevo_cliente()
	{
		$d['title'] = 'Administración';
        $h['title'] =  $d['title'];

		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			//get primer asesor
			$asesores = $this->model->all_users_ventas();
			$asesor = $asesores[0]['idusuario'];
			$nombre = $_POST['nombre'];
			$nit = $_POST['nit'];
			$razonsocial = $_POST['razonsocial'];
			$contacto = $_POST['contacto'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];

			$array = array(
				'nombre'		=>	$nombre,
				'nit'			=>	$nit,
				'razonsocial'	=>	$razonsocial,
				'contacto'		=>	$contacto,
				'email'			=>	$email,
				'direccion'		=>	$direccion,
				'asesor'		=>	$asesor
			);

			$this->db->insert('clientes', $array);

			$d['msg'] = 'success';
			redirect(base_url('administracion/clientes'));
		}

		$d['asesores'] = $this->model->get_user_roles_all_status(2);

        if($_SESSION['rol'] == 1){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }elseif($_SESSION['rol'] == 2){
            $d['clientes'] = $this->model->get_all_clientes_asesor($_SESSION['uid']);
        }elseif($_SESSION['rol'] == 5){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }

		$this->load->view('header_view', $h);
		$this->load->view('administracion/nuevo_cliente_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function searchNIT()
	{
		$nit = $_POST['nit'];

		$curl = curl_init();

		curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://consultareceptores.feel.com.gt/rest/action',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS =>'{
			"emisor_codigo": "'.NITEMISOR.'",
			"emisor_clave": "'.LLAVE.'",
			"nit_consulta": "'.$nit.'"
		}',
		CURLOPT_HTTPHEADER => array(
			'Content-Type: text/plain'
		),
		));

		$response = curl_exec($curl);

		curl_close($curl);

		$array = json_decode($response, true);

		echo $array['nombre'];
	}
}
