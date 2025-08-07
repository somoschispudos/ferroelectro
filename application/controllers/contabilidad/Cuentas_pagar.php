<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuentas_pagar extends CI_Controller {

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
            $fecha = date('Y-m-d', strtotime($_POST['fecha']));
            $monto = $_POST['monto'];
            $monto = str_replace('Q', '', $monto);
            $monto = str_replace(',', '', $monto);
            $cuentaid = $_POST['cuenta'];
            $proveedorid = $_POST['proveedor'];
            $tipoid = $_POST['tipo_gastos'];
            $metodopago = $_POST['metodo_pago'];
            $referencia = $_POST['referencia'];
            $descripcion = $_POST['descripcion'];

            $array = array(
                'fecha'         =>  $fecha,
                'monto'         =>  $monto,
                'cuentaid'      =>  $cuentaid,
                'proveedorid'   =>  $proveedorid,
                'tipogastoid'   =>  $tipoid,
                'metodo'        =>  $metodopago,
                'referencia'    =>  $referencia,
                'descripcion'   =>  $descripcion
            );

            $this->db->insert('gastos', $array);

            $d['msg'] = 'success';
        }

        if(isset($_POST['enviarBancos'])){
            $polizas = $_POST['polizas'];

            foreach($polizas as $p){
                $array = array(
                    'status'    =>  3
                );

                $this->db->where('id', $p);
                $this->db->update('polizas', $array);
            }
        }

		$d['polizas'] = $this->model->get_polizas();

        // echo "<pre>";
        // print_r($t);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/cuentas_pagar_view', $d);
        $this->load->view('footer_view', $h);
    }

    public function nueva_poliza()
	{
        $d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

        if(isset($_POST['guardar'])){
            $fecha = date('Y-m-d', strtotime($_POST['fecha']));
            $tipoid = $_POST['tipo_poliza'];
            $concepto = $_POST['concepto'];

            $array = array(
                'fecha'     =>  $fecha,
                'tipoid'    =>  $tipoid,
                'concepto'  =>  $concepto
            );

            $this->db->insert('polizas', $array);

            $idpoliza = $this->db->insert_id();

            redirect(base_url('contabilidad/cuentas_pagar/editar_movimientos/' . $idpoliza));
        }

        $d['tipo_polizas'] = $this->model->tipo_polizas();

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/nueva_poliza_view', $d);
        $this->load->view('footer_view', $h);
    }

    public function editar_movimientos($idpoliza)
	{
        $d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

        if(isset($_POST['guardar_proveedor'])){
			$nombre = $_POST['nombre'];
			$dpi = $_POST['dpi'];
			$nit = $_POST['nit'];
			$direccion = $_POST['direccion'];
			$telefono = $_POST['telefono'];
			$email = $_POST['email'];
			$contacto = $_POST['contacto'];
			$pais = $_POST['pais'];
			$estado = $_POST['estado'];
			$codigopostal = $_POST['codigopostal'];
			$moneda = $_POST['moneda'];
			$condicionespago = $_POST['condicionespago'];
			$banco = $_POST['banco'];
			$tipocuenta = $_POST['tipocuenta'];
			$formapago = $_POST['formapago'];
			$cuentabancaria = $_POST['cuentabancaria'];
			$regimentributario = $_POST['regimentributario'];

			$array = array(
                'nombre'            =>  $nombre,
                'dpi'               =>  $dpi,
                'nit'               =>  $nit,
                'direccion'         =>  $direccion,
                'telefono'          =>  $telefono,
                'email'             =>  $email,
				'contacto'			=>	$contacto,
                'pais'              =>  $pais,
                'estado'            =>  $estado,
                'codigopostal'      =>  $codigopostal,
                'moneda'            =>  $moneda,
                'condicionespago'   =>  $condicionespago,
                'formapago'         =>  $formapago,
				'banco'				=>	$banco,
				'tipocuenta'		=>	$tipocuenta,
                'cuentabancaria'    =>  $cuentabancaria,
                'regimentributario' =>  $regimentributario
			);

			$this->db->insert('proveedores', $array);

			$d['msg'] = 'success';
		}

        if(isset($_POST['guardar'])){
            $cuenta_contable = $_POST['cuenta_contable'];
            $proveedor = $_POST['proveedor'];
            $fecha = date('Y-m-d', strtotime($_POST['fecha']));
            $documento = $_POST['documento'];
            $galones = $_POST['galones'];
            $tipodoc = $_POST['tipo_doc'];
            $serie = $_POST['serie'];
            $cargo = $_POST['cargo'];
            $cargo = str_replace('Q', '', $cargo);
            $cargo = str_replace(',', '', $cargo);
            $cargoSinResta = $cargo;

            $tipodocInfo = $this->model->single_tipo_documentos($tipodoc);
            $descripcion = $tipodocInfo[0]['documento'];

            //revisar iva credito
            $iva_credito = 0;
            if($tipodocInfo[0]['iva_credito'] == 1){
                //calcular iva_credito
                $iva = $tipodocInfo[0]['iva_credito_valor'] / 100;
                $iva_credito = number_format(($cargo * $iva), 2, '.', '');
                $iva_cc = $tipodocInfo[0]['iva_credito_id_cc'];
                $cuenta_contable_iva  = $this->model->get_cuenta_contable($iva_cc);
                $descripcion_iva = $cuenta_contable_iva[0]['nombre'];
            }

            $cargo = $cargo - $iva_credito;

            //revisar idp
            $idp_valor = 0;
            if($tipodocInfo[0]['idp'] == 1){
                $idp = $tipodocInfo[0]['idp_valor'];
                $idp_valor = number_format(($galones * $idp), 2, '.', '');
                $idp_cc = $tipodocInfo[0]['idp_id_cc'];
                //get cuenta contable
                $cuenta_contable_idp  = $this->model->get_cuenta_contable($idp_cc);
                $descripcion_idp = $cuenta_contable_idp[0]['nombre'];
            }

            $cargo = $cargo - $idp_valor;

            // die($galones);

            //cuentas pagar header
            $array = array(
                'idpoliza'              =>  $idpoliza,
                'id_cuenta_contable'    =>  $cuenta_contable,
                'idproveedor'           =>  $proveedor,
                'idtipodoc'             =>  $tipodoc,
                'fecha'                 =>  $fecha,
                'documento'             =>  $documento,
                'serie'                 =>  $serie,
                'galones'               =>  $galones,
                'monto'                 =>  $cargoSinResta
            );

            $this->db->insert('cuentas_pagar', $array);

            $array = array(
                'status'    =>  2
            );
            //actualizar poliza
            $this->db->where('id', $idpoliza);
            $this->db->update('polizas', $array);

            //insertar gasto
            $array = array(
                'id_poliza'             =>  $idpoliza,
                'id_cuenta_contable'    =>  $cuenta_contable,
                'descripcion'           =>  $descripcion,
                'monto'                 =>  $cargo,
                'tipo'                  =>  1
            );

            $this->db->insert('movimientos_gastos', $array);

            //insertar idp si existe
            if($idp_valor > 0){
                $array = array(
                    'id_poliza'             =>  $idpoliza,
                    'id_cuenta_contable'    =>  $idp_cc,
                    'descripcion'           =>  $descripcion_idp,
                    'monto'                 =>  $idp_valor,
                    'tipo'                  =>  1
                );

                $this->db->insert('movimientos_gastos', $array);
            }

            //insertar IVA si existe
            if($iva_credito > 0){
                $array = array(
                    'id_poliza'             =>  $idpoliza,
                    'id_cuenta_contable'    =>  $iva_cc,
                    'descripcion'           =>  $descripcion_iva,
                    'monto'                 =>  $iva_credito,
                    'tipo'                  =>  1
                );

                $this->db->insert('movimientos_gastos', $array);
            }
        }

        $d['poliza'] = $this->model->single_poliza($idpoliza);
        $d['statuspoliza'] = $d['poliza'][0]['status'];
        $d['idpoliza'] = $idpoliza;
        // $d['cuentas_contables'] = $this->model->cuentas_contables();
        $d['proveedores'] = $this->model->all_proveedores();
        // $d['tipo_gastos'] = $this->model->all_tipo_gastos();
        $d['tipo_documentos'] = $this->model->get_tipo_documentos();

        $d['cuentas_pagar'] = $this->model->get_cuentas_pagar($idpoliza);

        $d['alld'] = $this->model->get_doc_contables_all();

        if($d['poliza'][0]['status'] == 2 || $d['poliza'][0]['status'] == 4){
            $d['movimientos'] = $this->model->get_movimientos_gastos($idpoliza);
        }elseif($d['poliza'][0]['status'] == 1){
            $d['movimientos'] = array();
        }

        // echo "<pre>";
        // print_r($d['movimientos']);
        // die();

        $d['monedas'] = $this->model->all_monedas();
        $d['padres'] = $this->model->get_doc_contables_padre();

        // build tree
        $this->db->select('id, padre, nombre, codigo, idp, mostrar');
		$this->db->from('cuentas_contables');
		$query = $this->db->get();
		$data = $query->result();

		$hierarchy = array();
		foreach($data as $row) {
			$hierarchy[$row->padre][] = $row;
		}

		$treeObject = $this->build_tree($hierarchy);
        $treeArray = $array = json_decode(json_encode($treeObject), true);


        $treeResult = $this->getDepthThreeElements($treeArray);
        $d['cuentas_contables'] = $treeResult;

		// echo "<pre>";
		// print_r($treeResult);
        // die();


        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/editar_movimientos_view', $d);
        $this->load->view('footer_view', $h);
    }

    public function build_tree($data, $parent_id = 0, $depth = 0) {
		$tree = array();
		foreach($data[$parent_id] as $node) {
		  $node->depth = $depth;
		  if(isset($data[$node->id])) {
			$node->children = $this->build_tree($data, $node->id, $depth + 1);
		  }
		  $tree[] = $node;
		}
		return $tree;
	}

	function getDepthThreeElements($array) {
        $result = array();
        foreach ($array as $element) {
            if ($element['depth'] == 3) {
                $result[] = $element;
            }
            if (isset($element['children'])) {
                $result = array_merge($result, $this->getDepthThreeElements($element['children']));
            }
        }
        return $result;
    }




    public function loadHijos(){
        $id = $_POST['id'];

        $html = '<label for="hijo" style="color: #fff;">Cuenta Contable</label>';
        $html .= '<select name="hijo" class="form-select" id="hijos">';
        $html .= '<option checked="checked">Seleccionar Opción</option>';
        $data = $this->model->get_doc_contables_hijos($id);

        foreach($data as $d){
            $html .= '<option value="'.$d['id'].'">'.$d['codigo'] . ' ' . $d['nombre'] . '</option>';
        }

        $html .= '</select>';

        echo $html;
    }

    public function loadNietos(){
        $id = $_POST['id'];

        $html = '<label for="nieto" style="color: #fff;">Cuenta Contable</label>';
        $html .= '<select name="nieto" id="nietos" class="form-select">';
        $html .= '<option checked="checked">Seleccionar Opción</option>';
        $data = $this->model->get_doc_contables_hijos($id);

        foreach($data as $d){
            $html .= '<option value="'.$d['id'].'">'.$d['codigo'] . ' ' . $d['nombre'] . '</option>';
        }

        $html .= '</select>';

        echo $html;
    }

    public function loadBisnietos(){
        $id = $_POST['id'];

        $html = '<label for="nieto" style="color: #fff;">Cuenta Contable</label>';
        $html .= '<select name="cuenta_contable" id="bisnietos" class="form-select">';
        $html .= '<option checked="checked">Seleccionar Opción</option>';
        $data = $this->model->get_doc_contables_hijos($id);

        foreach($data as $d){
            $html .= '<option value="'.$d['id'].'">'.$d['codigo'] . ' ' . $d['nombre'] . '</option>';
        }

        $html .= '</select>';

        echo $html;
    }
}