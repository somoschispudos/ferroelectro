<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rotacion extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

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

		if(isset($_POST['filtrar'])){
            $marca = $_POST['marcaid'];
			$categoria = $_POST['categoriaid'];
		}

		$d['marcaURL'] = $marca;
		$d['categoriaURL'] = $categoria;
		$d['productos'] = $this->model->all_productos_all_status_filtro($marca, $categoria);
		$d['categorias'] = $this->model->all_categorias_activa();
		$d['marcas'] = $this->model->all_marcas();

		// echo "<pre>";
		// print_r($d['productos'] );
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('reportes/rotacion_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function historial_rotacion($idpr)
	{
		$d['title'] = 'Reportes';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		$d['historial'] = $this->model->get_all_ventas_producto($idpr);

		// echo "<pre>";
		// print_r($d['historial']);
		// die();

		$this->load->view('header_view', $h);
		$this->load->view('reportes/historial_rotacion_view', $d);
        $this->load->view('footer_view', $h);
	}
}
