<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bancos  extends CI_Controller {

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
        $d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			$banco = $_POST['banco'];
			$cuenta = $_POST['cuenta'];
			$tipo = $_POST['tipo'];
			$moneda = $_POST['moneda'];

			$array = array(
				'nombre_banco'		=>	$banco,
				'cuenta'			=>	$cuenta,
				'tipo_cuenta'		=>	$tipo,
				'monedaid'			=>	$moneda
			);

			$this->db->insert('bancos', $array);

			$d['msg'] = 'success';
		}

		$d['monedas'] = $this->model->all_monedas_all_status();
		$d['bancos'] = $this->model->all_bancos();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/bancos_view', $d);
        $this->load->view('footer_view', $h);
    }




	public function eliminar_banco($idb)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idb);
		$this->db->update('bancos', $array);
		redirect(base_url('contabilidad/bancos'));
	}

	public function reactivar_banco($idb)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idb);
		$this->db->update('bancos', $array);
		redirect(base_url('contabilidad/bancos'));
	}
}