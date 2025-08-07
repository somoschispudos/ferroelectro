<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Facturas_anuladas extends CI_Controller {

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
        $d['title'] = 'Facturas Anuladas';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

        $d['anuladas'] = $this->model->get_factura_data_anuladas();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/facturas_anuladas_view', $d);
        $this->load->view('footer_view', $h);
    }
}