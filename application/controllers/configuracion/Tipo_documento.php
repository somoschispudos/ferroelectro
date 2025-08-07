<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_documento extends CI_Controller {

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
			// echo "<pre>";
            // print_r($_POST);
            // die();
            $gasto = $_POST['gasto'];
            $origen = $_POST['origen'];

            $iva_compras = 0;
            if(isset($_POST['iva_compras'])){
                $iva_compras = 1;
            }

            $combustible = 0;
            if(isset($_POST['combustible'])){
                $combustible = 1;
            }

            $idp = $_POST['valoridp'];

            $retencion_iva = 0;
            if(isset($_POST['retencion_iva'])){
                $retencion_iva = 1;
            }

            $retencion_isr = 0;
            if(isset($_POST['retencion_isr'])){
                $retencion_isr = 1;
            }

            $peq_contr = 0;
            if(isset($_POST['peq_contr'])){
                $peq_contr = 1;
            }

            $nota_credito = 0;
            if(isset($_POST['nota_credito'])){
                $nota_credito = 1;
            }

            $extento = 0;
            if(isset($_POST['extento'])){
                $extento = 1;
            }

            $ret_isr = $_POST['ret_isr'];
            $ret_iva = $_POST['ret_iva'];

            $array = array(
                'gasto'         =>  $gasto,
                'origen'        =>  $origen,
                'iva_compras'   =>  $iva_compras,
                'combustible'   =>  $combustible,
                'idp'           =>  $idp,
                'retencion_iva' =>  $retencion_iva,
                'retencion_isr' =>  $retencion_isr,
                'peque_cont'    =>  $peq_contr,
                'nota_credito'  =>  $nota_credito,
                'extento'       =>  $extento,
                'por_ret_isr'   =>  $ret_isr,
                'por_ret_iva'   =>  $ret_iva
            );

            $this->db->insert('tipo_gasto', $array);
            $d['msg'] = 'success';
		}

		$d['tipo_gastos'] = $this->model->all_tipo_gastos();

        // echo "<pre>";
        // print_r($d['tipo_gastos']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('configuracion/tipo_documento_view', $d);
        $this->load->view('footer_view', $h);
	}

	// public function eliminar_categoria($idu)
	// {
	// 	$array = array(
	// 		'status'	=>	0
	// 	);

	// 	$this->db->where('id', $idu);
	// 	$this->db->update('categorias', $array);
	// 	redirect(base_url('configuracion/categorias'));
	// }

	// public function reactivar_categoria($idu)
	// {
	// 	$array = array(
	// 		'status'	=>	1
	// 	);

	// 	$this->db->where('id', $idu);
	// 	$this->db->update('categorias', $array);
	// 	redirect(base_url('configuracion/categorias'));
	// }
}
