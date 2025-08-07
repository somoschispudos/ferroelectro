<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exhibidores extends CI_Controller {

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

		if(isset($_POST['guardar'])){
			$descripcion = $_POST['descripcion'];

			$check = $this->model->check_exhibidores($descripcion);

			if(empty($check)){
				$array = array(
					'descripcion'	=>	$descripcion
				);

				$this->db->insert('exhibidores', $array);

				$d['msg'] = 'success';
			}else{
				$d['msg'] = 'duplicate';
			}

		}

		$d['exhibidores'] = $this->model->all_exhibidores();

        $this->load->view('header_view', $h);
		$this->load->view('administracion/exhibidores_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_exhibidor($idex)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idex);
		$this->db->update('exhibidores', $array);
		redirect(base_url('administracion/exhibidores'));
	}

	public function reactivar_exhibidor($idex)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idex);
		$this->db->update('exhibidores', $array);
		redirect(base_url('administracion/exhibidores'));
	}
}
