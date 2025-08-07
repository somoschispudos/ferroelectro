<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

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
        $d['title'] = 'Inventario';
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

        $d['compras'] = $this->model->all_compras();

        // echo "<pre>";
        // print_r($d['marcas']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('inventario/compras_view', $d);
        $this->load->view('footer_view', $h);
	}

    public function nueva_compra()
	{
        $d['title'] = 'Inventario';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['guardar'])){
			$fecha = date('Y-m-d', strtotime($_POST['fecha']));
			$descripcion = $_POST['descripcion'];

			$array = array(
				'fecha'			=>	$fecha,
				'descripcion'	=>	$descripcion
			);

			$this->db->insert('compras', $array);

			$lastid = $this->db->insert_id();

			redirect(base_url('inventario/compras/lista_compra/' . $lastid));
		}

		if(isset($_POST['guardarArchivo'])){
			$fecha = date('Y-m-d', strtotime($_POST['fecha']));
			$descripcion = $_POST['descripcion'];

			$array = array(
				'fecha'			=>	$fecha,
				'descripcion'	=>	$descripcion
			);

			$this->db->insert('compras', $array);

			$compraid = $this->db->insert_id();

			if (isset($_FILES["csv_file"]) && $_FILES["csv_file"]["error"] == UPLOAD_ERR_OK) {
				$fileType = $_FILES["csv_file"]["type"];

				$tmpName = $_FILES['csv_file']['tmp_name'];
				$csvAsArray = array_map('str_getcsv', file($tmpName));
				array_shift($csvAsArray);

				$modelProducto = $this->model->get_producto_sku($csvAsArray[0][2]);

				
				// echo "<pre>";
				// print_r($modelProducto);
				// echo "<hr>";
				// echo "<pre>";
				// print_r($csvAsArray);
				// echo "</pre>";
				// die();

				$arrayNoCarga = array();

				foreach($csvAsArray as $csv){
					$sku = $csv[0];
					$costo = $csv[1];
					$cantidad = $csv[2];

					$modelProducto = $this->model->get_producto_sku($sku);

					if(count($modelProducto) > 0){
						$idproducto = $modelProducto[0]['id'];

						$conteo = 1;

						while($conteo <= $cantidad){
							$array = array(
								'idcompra'		=>	$compraid,
								'idproducto'	=>	$idproducto,
								'costo'			=>	$costo
							);

							$this->db->insert('inventario', $array);

							$conteo = $conteo + 1;
						}

						//get all products not sold
						$novendidos = $this->model->all_productos_id_not_sold($idproducto);

						$sumaTodosPrecio = 0;
						foreach($novendidos as $n){
							$sumaTodosPrecio = $sumaTodosPrecio + $n['costo'];
						}

						$promedioCosto = $sumaTodosPrecio / count($novendidos);
						$promedioCosto = number_format($promedioCosto, 2, '.', '');

						$array = array(
							'costo'	=>	$promedioCosto
						);

						$this->db->where('id', $idproducto);
						$this->db->update('productos', $array);
					}else{
						array_push($arrayNoCarga, $sku);
					}
				}

				$enlace = ' <a href="'.base_url('inventario/compras/lista_compra/' . $compraid).'" class="btn btn-sm btn-info">VER CARGA</a>';

				if(count($arrayNoCarga) > 0){
					$listaSKUs = implode(", ", $arrayNoCarga);
					$d['msg'] = "Los siguientes SKUs no se han encontrado en la carga: " . $listaSKUs . '.' . $enlace;
				}else{
					$d['msg'] = "Carga completa ha sido exitosa.".$enlace;
				}
			}

			// redirect(base_url('inventario/compras'));
		}

        $d['proveedores'] = $this->model->all_proveedores_all_status();
		$d['categorias'] = $this->model->all_categorias_activa();
		$d['marcas'] = $this->model->all_marcas();
		$d['productos'] = $this->model->all_productos_all_status();

        // echo "<pre>";
        // print_r($d['marcas']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('inventario/nueva_compra_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function lista_compra($compraid)
	{
        $d['title'] = 'Inventario';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

		if(isset($_POST['agregar'])){
			$idproducto = $_POST['productos'];
			$cantidad = $_POST['cantidad'];
			$costo = $_POST['costo'];
			$costo = str_replace('Q', '', $costo);
			$costo = str_replace(',', '', $costo);

			$conteo = 1;

			while($conteo <= $cantidad){
				$array = array(
					'idcompra'		=>	$compraid,
					'idproducto'	=>	$idproducto,
					'costo'			=>	$costo
				);

				$this->db->insert('inventario', $array);

				$conteo = $conteo + 1;
			}

			//get all products not sold
			$novendidos = $this->model->all_productos_id_not_sold($idproducto);

			$sumaTodosPrecio = 0;
			foreach($novendidos as $n){
				$sumaTodosPrecio = $sumaTodosPrecio + $n['costo'];
			}

			$promedioCosto = $sumaTodosPrecio / count($novendidos);
			$promedioCosto = number_format($promedioCosto, 2, '.', '');

			$array = array(
				'costo'	=>	$promedioCosto
			);

			$this->db->where('id', $idproducto);
			$this->db->update('productos', $array);
		}

		$d['compra'] = $this->model->get_compra($compraid);
		$d['productos'] = $this->model->all_productos_all_status();
		$d['listaproductos'] = $this->model->lista_inventario($compraid);

        // echo "<pre>";
        // print_r($d['listaproductos']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('inventario/lista_compra_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function eliminar_lista($idcompra, $idproducto){
		$this->db->where('idcompra', $idcompra);
		$this->db->where('idproducto', $idproducto);
		$this->db->delete('inventario');

		redirect(base_url('inventario/compras/lista_compra/' . $idcompra));
	}
}
