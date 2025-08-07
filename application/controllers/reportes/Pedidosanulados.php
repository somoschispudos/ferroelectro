<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pedidosanulados extends CI_Controller {

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

        // $venta = $this->model->get_lasuma_venta(46);
        // echo "<pre>";
        // print_r($venta);
        // die();

		$d['ventas'] = $this->model->get_all_ventas_anuladas();

		// echo "<pre>";
		// print_r($d['ventas']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/pedidosanulados_view', $d);
        $this->load->view('footer_view', $h);
	}
}
