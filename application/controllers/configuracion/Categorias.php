<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {

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
			$categoria = $_POST['categoria'];

			$check = $this->model->check_categoria($categoria);

			if(empty($check)){
				$array = array(
					'categoria'	=>	$categoria
				);

				$this->db->insert('categorias', $array);

				$d['msg'] = 'success';
			}else{
				$d['msg'] = 'duplicate';
			}

		}

		$d['categorias'] = $this->model->all_categorias_all_status();

        $this->load->view('header_view', $h);
		$this->load->view('configuracion/categorias_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_categoria($idu)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idu);
		$this->db->update('categorias', $array);
		redirect(base_url('configuracion/categorias'));
	}

	public function reactivar_categoria($idu)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idu);
		$this->db->update('categorias', $array);
		redirect(base_url('configuracion/categorias'));
	}
}
