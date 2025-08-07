<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
		$this->output->set_header('Pragma: no-cache');
		include($_SERVER['DOCUMENT_ROOT'].'/fileupload/src/php/class.fileuploader.php');

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

        $d['proveedores'] = $this->model->all_proveedores_all_status();
		$d['categorias'] = $this->model->all_categorias_activa();
		$d['marcas'] = $this->model->all_marcas();
		$d['productos'] = $this->model->all_productos_all_status();

		// echo "<pre>";
		// print_r($d['proveedores']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('administracion/productos_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_producto($idc)
	{
		$array = array(
			'status'	=>	0
		);

		$this->db->where('id', $idc);
		$this->db->update('productos', $array);
		redirect(base_url('administracion/productos'));
	}

	public function reactivar_producto($idc)
	{
		$array = array(
			'status'	=>	1
		);

		$this->db->where('id', $idc);
		$this->db->update('productos', $array);
		redirect(base_url('administracion/productos'));
	}

	public function editar_producto($idp)
	{
        $d['title'] = 'Administración';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			// $sku = strtoupper($_POST['sku']);

			//buscar en base de datos SKU
			// $searchSKU = $this->model->buscar_sku($sku);

				$nombreproducto  = $_POST['nombreproducto'];
				$proveedorid = $_POST['proveedorid'];
				$categoriaid = $_POST['categoriaid'];
				$marcaid = $_POST['marcaid'];
				$cantmin = $_POST['cantmin'];
				$sku = $_POST['sku'];

				$costo = $_POST['costo'];
				$costo = str_replace('Q', '', $costo);
				$costo = str_replace(',', '', $costo);

				$venta = $_POST['venta'];
				$venta = str_replace('Q', '', $venta);
				$venta = str_replace(',', '', $venta);

				$array = array(
					'sku'				=>	$sku,
					'nombreproducto '	=>	$nombreproducto,
					'proveedorid'		=>	$proveedorid,
					'categoriaid'		=>	$categoriaid,
					'marcaid'			=>	$marcaid,
					'cantmin'			=>	$cantmin,
					'costo'				=>	$costo,
					'venta'				=>	$venta
				);

				$this->db->where('id', $idp);
				$this->db->update('productos', $array);

				// $lastid = $this->db->insert_id();

				// initialize the FileUploader
				$FileUploader = new FileUploader('files', array(
					'uploadDir' => 'uploads/',
					'title' 	=> ['auto', 12],
				));

				// call to upload the files
				$upload = $FileUploader->upload();

				if($upload['isSuccess']) {
					// get the uploaded files
					$files = $upload['files'];

					$this->db->where('idproducto', $idp);
					$this->db->delete('imagenes');

					foreach($files as $f){
						$array = array(
							'idproducto'	=>	$idp,
							'format'		=>	$f['format'],
							'filename'		=>	$f['file']
						);

						$this->db->insert('imagenes', $array);
					}
				} else {
					// get the warnings
					echo "<pre>";
					print_r($upload['warnings']);
					die();
				}

				$d['msg'] = 'success';

				redirect(base_url('administracion/productos'));

		}

        $d['proveedores'] = $this->model->all_proveedores_all_status();
		$d['categorias'] = $this->model->all_categorias_activa();
		$d['marcas'] = $this->model->all_marcas();
		$d['producto'] = $this->model->get_producto($idp);

		// echo "<pre>";
		// print_r($d['proveedores']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('administracion/editar_producto_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function nuevo_producto()
	{
		$d['title'] = 'Administración';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			$sku = strtoupper($_POST['sku']);

			//buscar en base de datos SKU
			$searchSKU = $this->model->buscar_sku($sku);

			if(empty($searchSKU)){
				$nombreproducto  = $_POST['nombreproducto'];
				$proveedorid = $_POST['proveedorid'];
				$categoriaid = $_POST['categoriaid'];
				$marcaid = $_POST['marcaid'];
				$cantmin = $_POST['cantmin'];

				$costo = $_POST['costo'];
				$costo = str_replace('Q', '', $costo);
				$costo = str_replace(',', '', $costo);

				$venta = $_POST['venta'];
				$venta = str_replace('Q', '', $venta);
				$venta = str_replace(',', '', $venta);

				$array = array(
					'sku'				=>	$sku,
					'nombreproducto '	=>	$nombreproducto,
					'proveedorid'		=>	$proveedorid,
					'categoriaid'		=>	$categoriaid,
					'marcaid'			=>	$marcaid,
					'cantmin'			=>	$cantmin,
					'costo'				=>	$costo,
					'venta'				=>	$venta
				);

				$this->db->insert('productos', $array);

				$lastid = $this->db->insert_id();

				// initialize the FileUploader
				$FileUploader = new FileUploader('files', array(
					'uploadDir' => 'uploads/',
					'title' 	=> ['auto', 12],
				));

				// call to upload the files
				$upload = $FileUploader->upload();


				if($upload['isSuccess']) {
					// get the uploaded files
					$files = $upload['files'];
					foreach($files as $f){
						$array = array(
							'idproducto'	=>	$lastid,
							'format'		=>	$f['format'],
							'filename'		=>	$f['file']
						);

						$this->db->insert('imagenes', $array);
					}
				} else {
					// get the warnings
					echo "<pre>";
					print_r($upload['warnings']);
					die();
				}

				$d['msg'] = 'success';

				redirect(base_url('administracion/productos'));
			}else{
				$d['msg'] = 'duplicate';
			}


		}

		$d['proveedores'] = $this->model->all_proveedores_all_status();
		$d['categorias'] = $this->model->all_categorias_activa();
		$d['marcas'] = $this->model->all_marcas();

		$this->load->view('header_view', $h);
		$this->load->view('administracion/nuevo_producto_view', $d);
        $this->load->view('footer_view', $h);
	}
}
