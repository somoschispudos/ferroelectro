<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_ventas extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index($from, $to, $asesor, $cliente, $departamento, $municipio)
	{
        $d['title'] = 'Reportes';
        $h['title'] =  $d['title'];
		$d['msg'] = '';
		$d['departamento'] = 0;
		$d['municipio'] = 0;

        if(isset($_POST['filtrar'])){

			if($_POST['fecha'] == ""){
				$from = date('Y-m-1');
				$to = date('Y-m-31');
			}else{
				$rangeArray = explode(" ", $_POST['fecha']);
				$from =$rangeArray[0];
				$to = $rangeArray[2];
			}

			$asesor = $_POST['asesor'];
			$cliente = $_POST['cliente'];
			if($_POST['departamento'] > 0){
				$departamento = $_POST['departamento'];
			}else{
				$departamento = 0;
			}

			if(isset($_POST['municipio'])){
				$municipio = $_POST['municipio'];
			}else{
				$municipio = 0;
			}
			// $d['ventas'] = $this->model->get_all_ventas_filtro($mes,$year,$asesor,$cliente);
			redirect(base_url('reportes/reportes_ventas/'.$from.'/'.$to.'/'.$asesor.'/'.$cliente.'/'.$departamento.'/'.$municipio));
        }

		// $d['mesURL'] = $mes;
		// $d['yearURL'] = $year;
		$d['asesorURL'] = $asesor;
		$d['clienteURL'] = $cliente;

		$d['ventas'] = $this->model->get_all_ventas_filtro($from,$to,$asesor,$cliente);

		$newVentas = array();
		if($departamento != 0){
			foreach($d['ventas'] as $v){
				if($departamento == $v['iddept'] && $municipio == $v['idmuni']){
					array_push($newVentas, $v);
				}
			}

			$d['ventas'] = $newVentas;
		}

		// echo "<pre>";
		// print_r($d['ventas']);
		// die();

		$d['asesores'] = $this->model->get_user_roles_all_status(2);
		$d['clientes'] = $this->model->get_all_clientes_all_status();

		$d['departamentos'] = $this->model->get_departamentos();
		$d['municipios'] = $this->model->get_municipios($d['departamentos'][0]['id']);

		// echo "<pre>";
        //     print_r($d['ventas']);
        //     die();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/reporte_ventas_view', $d);
        $this->load->view('footer_view', $h);
	}
}
