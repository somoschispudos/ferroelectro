<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas extends CI_Controller {

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

		if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4 || $_SESSION['rol'] == 5){
            $d['ventas'] = $this->model->get_all_ventas();
        }elseif($_SESSION['rol'] == 2){
            $d['ventas'] = $this->model->get_all_ventas_asesor($_SESSION['uid']);
        }

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/cuentas_view', $d);
        $this->load->view('footer_view', $h);
    }

    public function pagos($idv)
	{
        $d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
		$d['msg'] = '';


		if(isset($_POST['pagar'])){
			$banco = $_POST['banco'];
			$fecha = date('Y-m-d', strtotime($_POST['fecha']));
			$monto = $_POST['abono'];
			$monto = str_replace('Q', '', $monto);
			$monto = str_replace(',', '', $monto);
			$doc = $_POST['doc'];

			$array = array(
				'idusuario'		=>	$_SESSION['uid'],
				'idventa'		=>	$idv,
				'fecha_pago'	=>	$fecha,
				'monto'			=>	$monto,
				'doc'			=>	$doc,
				'bancoid'		=>	$banco
			);

			$this->db->insert('pagos', $array);

			$venta = $this->model->get_venta($idv);
			$total = $venta[0]['total'];
			$getPagos = $this->model->getpagos_suma($idv);
			$pagado = $getPagos[0]['sumapagos'];
            $pendiente = $total - $pagado;

			if($pendiente == 0){
				$array = array(
					'status'	=>	4
				);

				$this->db->where('id', $idv);
				$this->db->update('ventas', $array);
			}

			$d['msg'] = 'success';
		}

		$laventa = $this->model->get_venta_id($idv);
        $d['cliente'] = $this->model->get_cliente($laventa[0]['idcliente']);
        $d['venta'] = $this->model->get_venta($idv);
		$d['bancos'] = $this->model->all_bancos();

		$d['pagos'] = $this->model->getpagos($idv);

		// echo "<pre>";
		// print_r($d['venta']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/pagos_view', $d);
        $this->load->view('footer_view', $h);
    }
}