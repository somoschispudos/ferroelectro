<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utilidades extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index($from, $to, $asesor, $cliente)
	{
        $d['title'] = 'Reportes';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

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
			// $d['ventas'] = $this->model->get_all_ventas_filtro($mes,$year,$asesor,$cliente);
			redirect(base_url('reportes/utilidades/'.$from.'/'.$to.'/'.$asesor.'/'.$cliente));
        }

		$d['asesorURL'] = $asesor;
		$d['clienteURL'] = $cliente;

		$d['ventas'] = $this->model->get_all_ventas_filtro($from,$to,$asesor,$cliente);

		$d['asesores'] = $this->model->get_user_roles_all_status(2);
		$d['clientes'] = $this->model->get_all_clientes_all_status();

		// echo "<pre>";
        //     print_r($d['ventas']);
        //     die();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/reporte_utilidad_view', $d);
        $this->load->view('footer_view', $h);
	}
}
