<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monedas extends CI_Controller {

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
        $d['title'] = 'Configuración';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			$moneda = $_POST['moneda'];
			$simbolo = $_POST['simbolo'];

			$array = array(
				'moneda'	=>	$moneda,
				'simbolo'	=>	$simbolo
			);

			$this->db->insert('monedas', $array);

			$d['msg'] = 'success';
		}

		$d['monedas'] = $this->model->all_monedas_all_status();

        $this->load->view('header_view', $h);
		$this->load->view('configuracion/monedas_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_moneda($idu)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idu);
		$this->db->update('monedas', $array);
		redirect(base_url('configuracion/monedas'));
	}

	public function reactivar_moneda($idu)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idu);
		$this->db->update('monedas', $array);
		redirect(base_url('configuracion/monedas'));
	}
}
