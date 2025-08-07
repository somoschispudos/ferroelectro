<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_bancos extends CI_Controller {

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

        if(isset($_POST['procesarAbono'])){
            //extraer post
			extract($_POST);

            $abono = str_replace('Q', '', $abono);
            $abono = str_replace(',', '', $abono);
            $fecha = date('Y-m-d', strtotime($fecha));

            $array = array(
                'id_banco'          =>  $banco,
                'id_poliza'         =>  $idpoliza,
                'fecha'             =>  $fecha,
                'ref_bancaria'      =>  $refbank,
                'tipo_doc'          =>  $tipodoc,
                'descripcion'       =>  $descripcion,
                'monto'             =>  $abono,
                'tipo_transaccion'  =>  'Egreso'
            );

            $this->db->insert('movimientos_bancarios', $array);

            //revisar si se hace actualización
            $suma_abonos = $this->model->get_movimientos_abonos($idpoliza);
            $suma_cargos = $this->model->get_movimientos_cargos($idpoliza);

            //si las sumas son iguales, actualizar poliza a cuadrada
            if($suma_abonos[0]['suma'] == $suma_cargos[0]['suma']){
                $array = array(
                    'status'    =>  4
                );

                $this->db->where('id', $idpoliza);
                $this->db->update('polizas', $array);
            }else{
                $array = array(
                    'status'    =>  2
                );

                $this->db->where('id', $idpoliza);
                $this->db->update('polizas', $array);
            }
        }

        $d['polizas'] = $this->model->get_polizas_bancos();
        $d['bancos'] = $this->model->all_bancos();

        // echo "<pre>";
        // print_r($t);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/cuentas_bancos_view', $d);
        $this->load->view('footer_view', $h);
    }


    public function carga_abonos(){
        $idpoliza = $_POST['idpoliza'];

        $abonos = $this->model->lista_movimientos_abonos($idpoliza);

        $html = '';

        if(!empty($abonos)){
            foreach($abonos as $a){
                // $totalAbono = $totalAbono + $a['monto'];
                $html .= '<table class="table table-bordered">';
                $html .= '<tr>';
                $html .= '<td>' . $a['nombre'] . '</td>';
                $html .= '<td>' . $a['ref_bancaria'] . '</td>';
                $html .= '<td style="text-align: right; width: 110px;">Q' . number_format($a['monto'], 2, '.', '') . '</td>';
                $html .= '</tr>';
                $html .= '</table>';
            }
        }

        echo $html;
    }

    public function saldos_banco($idb)
    {
        $d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

        $d['polizas'] = $this->model->get_polizas_bancos();
        $d['banco'] = $this->model->get_banco($idb);
        $d['bancos'] = $this->model->all_bancos_except($idb);
        $d['deudores'] = $this->model->get_deudores();

        if(isset($_POST['transferir'])){
            //extraer post
			extract($_POST);

            $fecha = date('Y-m-d', strtotime($fecha));
            $monto = str_replace('Q', '', $monto);
            $monto = str_replace(',', '', $monto);

            //sacar de banco actual
            $array = array(
                'id_banco'          =>  $idb,
                'id_poliza'         =>  0,
                'fecha'             =>  $fecha,
                'ref_bancaria'      =>  $refbank,
                'tipo_doc'          =>  $tipodoc,
                'descripcion'       =>  $descripcion,
                'monto'             =>  $monto,
                'tipo_transaccion'  =>  'Egreso'
            );

            $this->db->insert('movimientos_bancarios', $array);

            //pasar a otro banco
            $array = array(
                'id_banco'          =>  $banco,
                'id_poliza'         =>  0,
                'fecha'             =>  $fecha,
                'ref_bancaria'      =>  $refbank,
                'tipo_doc'          =>  $tipodoc,
                'descripcion'       =>  $descripcion,
                'monto'             =>  $monto,
                'tipo_transaccion'  =>  'ingreso'
            );

            $this->db->insert('movimientos_bancarios', $array);

        }

        if(isset($_POST['transferir_terceros'])){
            //extraer post
			extract($_POST);

            $fecha = date('Y-m-d', strtotime($fecha));
            $monto = str_replace('Q', '', $monto);
            $monto = str_replace(',', '', $monto);

            //sacar de banco actual
            $array = array(
                'id_banco'              =>  $idb,
                'id_cuenta_contable'    =>  $deudores,
                'fecha'                 =>  $fecha,
                'ref_bancaria'          =>  $refbank,
                'tipo_doc'              =>  $tipodoc,
                'descripcion'           =>  $descripcion,
                'monto'                 =>  $monto,
                'tipo_transaccion'      =>  'Egreso'
            );

            $this->db->insert('movimientos_bancarios', $array);
        }

        $saldoInicial = $d['banco'][0]['saldo_inicial'];

        $gastos = $this->model->get_gastos_banco($idb);
        $abonos = $this->model->get_abonos_banco($idb);

        $mergedArray = array_merge($gastos, $abonos);

        // echo "<pre>";
        // print_r($mergedArray);
        // die();

        $arrayMovs = [];

        foreach($mergedArray as $m){
            if(array_key_exists('tipo_transaccion', $m)){
                $fecha = $m['fecha'];
                $doc = $m['ref_bancaria'];
                $descripcion = $m['descripcion'];
                $tipo = $m['tipo_transaccion'];
                $monto = $m['monto'];
            }

            if(array_key_exists('bancoid', $m)){
                $fecha = $m['fecha_pago'];
                $doc = $m['doc'];
                $descripcion = 'Pago de venta #' . $m['idventa'];
                $tipo = 'Ingreso';
                $monto = $m['monto'];
            }

            $array = array(
                'fecha'         =>  $fecha,
                'doc'           =>  $doc,
                'descripcion'   =>  $descripcion,
                'tipo'          =>  $tipo,
                'monto'         =>  $monto,
            );

            array_push($arrayMovs, $array);
        }

        // Define a custom sorting function
        function sortByFechaAsc($a, $b) {
            return strtotime($a['fecha']) - strtotime($b['fecha']);
        }

        function sortByFechaDesc($a, $b) {
            return strtotime($b['fecha']) - strtotime($a['fecha']);
        }

        usort($arrayMovs, 'sortByFechaAsc');

        //insertar saldo Inicial

        $movimientosSaldos = [];
        $saldo = $saldoInicial;
        $totalMovs = count($arrayMovs) + 1;

        $c = 1;
        $k = 0;
        while($c <= $totalMovs){
            if($c == 1){
                $monto = $saldo;
                $fecha = '';
                $doc = '';
                $descripcion = 'Saldo Inicial';
                $tipo = '';
            }else{
                $fecha = $arrayMovs[$k]['fecha'];
                $doc = $arrayMovs[$k]['doc'];
                $descripcion = $arrayMovs[$k]['descripcion'];
                $tipo = $arrayMovs[$k]['tipo'];
                $monto = $arrayMovs[$k]['monto'];

                if($tipo == 'Egreso'){
                    $saldo = $saldo - $monto;
                }elseif($tipo == 'Ingreso'){
                    $saldo = $saldo + $monto;
                }

                $saldo = number_format($saldo, 2, '.', '');

                $k++;
            }

            $array = array(
                'fecha'         =>  $fecha,
                'doc'           =>  $doc,
                'descripcion'   =>  $descripcion,
                'tipo'          =>  $tipo,
                'monto'         =>  $monto,
                'saldo'         =>  $saldo
            );

            array_push($movimientosSaldos, $array);

            $c++;
        }

        usort($movimientosSaldos, 'sortByFechaDesc');

        $d['movimientos'] = $movimientosSaldos;


        // echo "<pre>";
        // print_r($movimientosSaldos);
        // echo "</pre>";
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/movimientos_bancarios_view', $d);
        // $this->load->view('table', $d);
        $this->load->view('footer_view', $h);
    }
}