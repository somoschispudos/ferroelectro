<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Desperfectos extends CI_Controller {

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
		$marca = 0;
		$categoria = 0;

		$d['desperfectos'] = $this->model->all_desperfectos();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/desperfectos_view', $d);
        $this->load->view('footer_view', $h);
	}
}
