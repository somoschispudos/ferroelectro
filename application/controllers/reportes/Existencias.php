<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Existencias extends CI_Controller {

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

		if(isset($_POST['filtrar'])){
            $marca = $_POST['marcaid'];
			$categoria = $_POST['categoriaid'];
		}

		if(isset($_POST['enviar_desperfecto'])){
			$cantidad = $_POST['cantidad'];
			$razon = $_POST['razon'];
			$idp = $_POST['idp'];
			$fecha = date('Y-m-d');

			$array = array(
				'fecha'		=>	$fecha,
				'idp'		=>	$idp,
				'cantidad'	=>	$cantidad,
				'razon'		=>	$razon
			);

			$this->db->insert('desperfectos', $array);

			$id_desperfecto = $this->db->insert_id();

			$array = array(
				'desperfecto' => $idp
			);

			$this->db->where('idproducto', $idp);
			$this->db->where('desperfecto', 0);
			$this->db->where('idventa', 0);
			$this->db->limit($cantidad);
			$this->db->update('inventario', $array);
			$d['msg'] = 'success';
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
		$this->load->view('reportes/existencias_view', $d);
        $this->load->view('footer_view', $h);
	}
}
