<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporteespecial extends CI_Controller {

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
        $d['title'] = 'Reportes';
        $h['title'] =  $d['title'];
		$d['msg'] = '';
		
		$d['ventas'] = $this->model->get_all_ventas_asc();

		// echo "<pre>";
        // print_r($ventas);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/reporte_especial_view', $d);
        $this->load->view('footer_view', $h);
	}
}
