<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Marcas extends CI_Controller {

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
            $marca = $_POST['marca'];

			$check = $this->model->check_marca($marca);

			// print_r($check);
			// die();

			if(empty($check)){
				$array = array(
					'marca'         =>  $marca
				);

				$this->db->insert('marcas', $array);

				$d['msg'] = 'success';
			}else{
				$d['msg'] = 'duplicate';
			}

		}

        $d['marcas'] = $this->model->all_marcas_all_status();

        // echo "<pre>";
        // print_r($d['marcas']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('configuracion/marcas_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_marca($idu)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idu);
		$this->db->update('marcas', $array);
		redirect(base_url('configuracion/marcas'));
	}

	public function reactivar_marca($idu)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idu);
		$this->db->update('marcas', $array);
		redirect(base_url('configuracion/marcas'));
	}
}
