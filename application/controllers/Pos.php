<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pos extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
		$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");

    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index()
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];

        // $venta = $this->model->get_lasuma_venta(46);
        // echo "<pre>";
        // print_r($venta);
        // die();

        if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4 || $_SESSION['rol'] == 5){
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
            $d['ventas'] = $this->model->get_all_ventas();
        }elseif($_SESSION['rol'] == 2){
			$this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
            $d['ventas'] = $this->model->get_all_ventas_asesor($_SESSION['uid']);
        }

		// echo "<pre>";
		// print_r($d['ventas']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('pos_view', $d);
        $this->load->view('footer_view', $h);
	}

    public function nueva_venta()
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];
        //id asesor
        // $idasesor = $_SESSION['uid'];

		if(isset($_POST['guardarcliente'])){
			//get primer asesor
			$asesores = $this->model->all_users_ventas();
			$asesor = $asesores[0]['idusuario'];
			$nombre = $_POST['nombre'];
			$nit = $_POST['nit'];
			$razonsocial = $_POST['razonsocial'];
			$contacto = $_POST['contacto'];
			$email = $_POST['email'];
			$direccion = $_POST['direccion'];

			$array = array(
				'nombre'		=>	$nombre,
				'nit'			=>	$nit,
				'razonsocial'	=>	$razonsocial,
				'contacto'		=>	$contacto,
				'email'			=>	$email,
				'direccion'		=>	$direccion,
				'asesor'		=>	$asesor
			);

			$this->db->insert('clientes', $array);
		}

        if(isset($_POST['guardar'])){
            $cliente = $_POST['clientes'];
            $fecha = date('Y-m-d');

            //get asesor cliente
            $clienteInfo = $this->model->get_cliente($cliente);
            $idasesor = $clienteInfo[0]['idasesor'];

            $array = array(
                'idcliente' =>  $cliente,
                'idasesor'  =>  $idasesor,
                'fecha'     =>  $fecha
            );

            $this->db->insert('ventas', $array);

            $idv = $this->db->insert_id();

            redirect(base_url('pos/lista_venta/'.$idv));
        }

		if(isset($_POST['guardarcf'])){
            $cliente = $_POST['clientes'];
            $fecha = date('Y-m-d');

            //get asesor cliente
            $clienteInfo = $this->model->get_cliente($cliente);
            $idasesor = $clienteInfo[0]['idasesor'];

            $array = array(
                'idcliente' =>  $cliente,
                'idasesor'  =>  $idasesor,
                'fecha'     =>  $fecha
            );

            $this->db->insert('ventas', $array);

            $idv = $this->db->insert_id();

            redirect(base_url('pos/lista_venta/'.$idv));
        }

        $d['ventas'] = array();
        if($_SESSION['rol'] == 1){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }elseif($_SESSION['rol'] == 2){
            $d['clientes'] = $this->model->get_all_clientes_asesor($_SESSION['uid']);
        }elseif($_SESSION['rol'] == 5){
            $d['clientes'] = $this->model->get_all_clientes_all_status();
        }


        $this->load->view('header_view', $h);
		$this->load->view('nueva_venta_view', $d);
        $this->load->view('footer_view', $h);
	}

    public function lista_venta($idv)
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];

        $d['ventas'] = array();

        if(isset($_POST['finalizar'])){
            $idpA = $_POST['idp'];
            $descuento = $_POST['porcentaje'];
            $allTotales = 0;

            foreach ($idpA as $key => $value){
                $cantidad = $_POST['cantidad'][$key];
                $formapago = $_POST['formapago'];
                $venta = $_POST['venta'][$key];
                $venta = str_replace(',', '', $venta);

                $totalThis = $cantidad * $venta;
                $idp = $value;
                $allTotales = $allTotales + $totalThis;

                // reducir inventario
                $cpr = 1;
                while($cpr <= $cantidad){
                    $ventaPrecio = $_POST['venta'][$key];
					$notas = $_POST['notas'][$key];
                    $ventaPrecio = str_replace(',', '', $ventaPrecio);

                    $array = array(
                        'idventa'   =>  $idv,
                        'venta'     =>  $ventaPrecio,
						'nota'		=>	$notas,
                        'status'    =>  2
                    );

                    $this->db->where('idproducto', $idp);
                    $this->db->where('idventa', 0);
                    $this->db->limit(1);
                    $this->db->update('inventario', $array);

                    // echo "<pre>";
                    // print_r($array);


                    $cpr = $cpr + 1;
                }

                // die();
            }

            $array = array(
                'total'         =>  $allTotales,
                'descuento'     =>  $descuento,
                'formapago'     =>  $formapago,
                'status'        =>  2
            );

            $this->db->where('id', $idv);
            $this->db->update('ventas', $array);

            if($_POST['formapago'] == 2 || $_POST['formapago'] == 3){
                $laventa = $this->model->get_venta_id($idv);
                $lafecha = date('Y-d-m');
                $dias = 0;
                if($_POST['formapago'] == 2){
                    $dias = 15;
                }elseif($_POST['formapago'] == 3){
                    $dias = 30;
                }

                $array = array(
                    'idcliente'         =>  $laventa[0]['idcliente'],
                    'idventa'           =>  $idv,
                    'fecha_credito'     =>  $lafecha,
                    'diascredito'       =>  $dias,
                    'status'            =>  1
                );

                $this->db->insert('creditos', $array);
            }

            redirect(base_url('pos/editar_lista_venta/' . $idv));
        }

        $laventa = $this->model->get_venta_id($idv);

        $d['productos'] = $this->model->all_productos_all_status();
        $d['cliente'] = $this->model->get_cliente($laventa[0]['idcliente']);
        $d['venta'] = $this->model->get_venta($idv);

        $this->load->view('header_view', $h);
		$this->load->view('lista_venta_view', $d);
        $this->load->view('footer_view', $h);
	}

    public function editar_lista_venta($idv)
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];
		$d['msg'] = '';

        $d['ventas'] = array();

        // $suma = $this->model->get_lasuma_venta($idv);
        // echo "<pre>";
        //     print_r($suma);
        //     die();


        if(isset($_POST['agregar'])){
            echo "<pre>";
            print_r($_POST);
            die();
        }

        if(isset($_POST['crear_nota'])){
            $array = array(
                'status'    =>  2
            );

            $this->db->where('id', $idv);
            $this->db->update('ventas', $array);
        }

		if(isset($_POST['agregar_nuevo'])){
			$idp = $_POST['productos'];
			$cantidad = $_POST['cantidad'];
			$descuentopor = $_POST['descuento'];
			$idv = $_POST['idventa'];

			$producto = $this->model->get_producto($idp);

			$venta = $producto[0]['venta'];
            $descuento = ($venta * $descuentopor) / 100;
            $venta = $venta - $descuento;
            $total = $cantidad * $venta;
			$nota = "";

			if($descuento > 0){
				$nota = '* Desc. %' . $descuentopor . ' (Q' . number_format($descuento, 2, '.', ''). ')';
			}

			$total = number_format($total, 2, '.', '');
            $venta = number_format($venta, 2, '.', '');

			// reducir inventario
			$cpr = 1;
			while($cpr <= $cantidad){
				$array = array(
					'idventa'   =>  $idv,
					'venta'     =>  $venta,
					'nota'		=>	$nota,
					'status'    =>  2
				);

				$this->db->where('idproducto', $idp);
				$this->db->where('idventa', 0);
				$this->db->limit(1);
				$this->db->update('inventario', $array);

				$cpr = $cpr + 1;
			}
		}

		if(isset($_POST['editarventa'])){
			// echo "<pre>";
			// print_r($_POST);
			// die();
			$idp = $_POST['idp'];
			$idv = $_POST['idventa'];
			$cantidad = $_POST['cantidad'];
			$venta = $_POST['venta'];
			$descuento = $_POST['descuento'];
			$descuento = str_replace('Q', '', $descuento);
			$descuento = str_replace(',', '', $descuento);

			//limpar el producto
			$array = array(
				'idventa'		=>	0,
				'venta'			=>	0,
				'status'		=>	1
			);

			$this->db->where('idproducto', $idp);
			$this->db->where('idventa', $idv);
			$this->db->update('inventario', $array);

			$c = 1;

			while($c <= $cantidad){
				$array = array(
					'idventa'		=>	$idv,
					'venta'			=>	$descuento
				);

				$this->db->where('idproducto', $idp);
				$this->db->where('idventa', 0);
				$this->db->limit(1);
				$this->db->update('inventario', $array);

				$c = $c+1;
			}

			$d['msg'] = "editado";
		}

        if(isset($_POST['facturar_pedido'])){
            $productosAgregados = $this->model->get_productos_venta($idv);
            $ventadata = $this->model->get_venta($idv);

            // echo "<pre>";
            // print_r($ventadata);
            // echo "</pre>";
            // die();
   
            include APPPATH . 'third_party/infile/clases.php';

            $documento_fel = new DocumentoFel();
	        $datos_emisor = new DatosEmisor();

            $datos_emisor->setAfiliacionIVA("GEN");
            $datos_emisor->setCodigoEstablecimiento(1);
            $datos_emisor->setCodigoPostal("01001");
            $datos_emisor->setCorreoEmisor("importadora.dlc@gmail.com");
            $datos_emisor->setDepartamento("Chiquimula");
            $datos_emisor->setMunicipio("Chiquimula");
            $datos_emisor->setDireccion("13 avenida 4-10 zona 1, Chiquimula");
            $datos_emisor->setNITEmisor(NITEMISOR);
            $datos_emisor->setNombreComercial("FERROELECTRO");
            $datos_emisor->setNombreEmisor("Importadora DLC, SA");
            $datos_emisor->setPais("GT");
            $documento_fel->setDatosEmisor($datos_emisor);

            $datos_generales = new DatosGenerales();
            $datos_generales->setCodigoMoneda("GTQ");

            $fech1 = date('Y-m-d');
            $hora = date('H:i:s');
            $lafecha = $fech1 . 'T' . $hora . '-06:00';
            // echo $lafecha;
            // die($lafecha);
            // $datos_generales->setFechaHoraEmision("2022-07-05T14:46:00-06:00");
            $datos_generales->setFechaHoraEmision($lafecha);
            //$datos_generales->setNumeroAcceso(11111);
            $datos_generales->setTipo("FACT");
            $documento_fel->setDatosGenerales($datos_generales);

            $datos_receptor = new DatosReceptor();
            $datos_receptor->setCodigoPostal("01002");
            //para multiples correos usar ; sin espacios
            $datos_receptor->setCorreoReceptor($ventadata[0]['email']);
            // $datos_receptor->setDepartamento($ventadata[0]['departamento']);
            $datos_receptor->setDireccion($ventadata[0]['direccion']);
            //EN CASO DE NO TENER NIT, AGREGAR CF
            $datos_receptor->setIDReceptor($ventadata[0]['nit']);
            // $datos_receptor->setIDReceptor('Consumidor Final');
            // $datos_receptor->setMunicipio($ventadata[0]['municipio']);
            // $datos_receptor->setNombreReceptor($ventasdata[0]['razonsocial']);
            $datos_receptor->setNombreReceptor($ventadata[0]['razonsocial']);
            $datos_receptor->setPais("GT");
            // $datos_receptor->setTipoEspecial("CUI");
            $documento_fel->setDatosReceptor($datos_receptor);

            $frases = new Frases();
            $frases->setTipoFrase(1);
            $frases->setCodigoEscenario(1);
            $documento_fel->setFrases($frases);

            $lineas = 1;
            $granTotal = 0;
            $sumasImpuestos = 0;
            $descuentoP = $ventadata[0]['descuento'];
            foreach($productosAgregados as $p){
                $items = new Items();

                $items->setNumeroLinea($lineas);
                $items->setBienOServicio("B");

                $cantidad = $this->model->lista_inventario_conteo_venta($idv, $p['idproducto']);
                $elPrecioProducto = $p['inventarioVenta'];
                $totaldeVenta = $p['inventarioVenta'] * $cantidad;
                $descuentoVenta = $totaldeVenta * $descuentoP;
                // echo "Descuento "  . $descuentoVenta;
                // $totaldeVenta = $totaldeVenta;
                // echo "<br>";
                // echo $totaldeVenta;
                $calculoUniDesc = $p['inventarioVenta'] * $descuentoP;
                $calculoUniDescTotal = $p['inventarioVenta'] - $calculoUniDesc;
                $calculoUniDescTotal = number_format($calculoUniDescTotal, 2, '.', '');

                $items->setCantidad($cantidad);
                $items->setDescripcion($p['sku'] . '|' . $p['nombreproducto']);
                $items->setDescuento($descuentoVenta);
                $items->setPrecio($totaldeVenta);
                $items->setPrecioUnitario($elPrecioProducto);
                $items->setUnidadMedida("UND");

                // echo $calculoUniDescTotal .  ' - ' . ($totaldeVenta - $calculoUniDesc);
                // echo "<br>";

                $items->setTotal($totaldeVenta-$descuentoVenta);

                $montoGravable  = number_format(($totaldeVenta - $descuentoVenta) / 1.12, 2, '.', '');
                $montoImpuesto = number_format(($totaldeVenta - $descuentoVenta) - $montoGravable, 2, '.', '');
                $sumasImpuestos = $sumasImpuestos + $montoImpuesto;
                $sumasImpuestos = number_format($sumasImpuestos, 2, '.', '');

                // $percentminus = ($p['venta'] * $cantidad) - $percent;
                // echo "<br>";
                // echo "sumas impuesto " . $sumasImpuestos;

                //por item sacar dividir por 1.12

                $granTotal = $granTotal + ($totaldeVenta-$descuentoVenta);

                for ($j = 1; $j <= 1; $j++) {

                    $impuestos_detalle = new ImpuestosDetalle();

                    $impuestos_detalle->setNombreCorto("IVA");
                    $impuestos_detalle->setCodigoUnidadGravable(1);
                    //monto sin impuesto
                    $impuestos_detalle->setMontoGravable($montoGravable);
                    //$impuestos_detalle->setCantidadUnidadesGravables(78.00);
                    $impuestos_detalle->setMontoImpuesto($montoImpuesto);

                    $items->setImpuestosDetalle($impuestos_detalle);
                }

                $documento_fel->setItems($items);

                $lineas += 1;
            }

            // die();

            $total_impuestos = new TotalImpuestos();
            $total_impuestos->setNombreCorto("IVA");
            //total de todos los impuestos
            $total_impuestos->setTotalMontoImpuesto($sumasImpuestos);
            $documento_fel->setImpuestosResumen($total_impuestos);

            $totales = new Totales();
            //suma de todos los totales con impuesto
            $totales->setGranTotal($granTotal);

            $documento_fel->setTotales($totales);


            $adendas = new Adendas();
            $adendas->setAdenda("Cajero", $_SESSION['nombre']);
            // $adendas->setAdenda("Lote", "45121");
            $adendas->setAdenda("OrdenCompra", "V-".$idv);
            //T = ticket || C = carta
            // $adendas->setAdenda("Diseno", $_POST['tipofactura']);

            $documento_fel->setAdenda($adendas);

            //var_dump($documento_fel);

            // Objeto para enviar los datos para generacion del XML
            $generar_xml = new GenerarXml();
                // Para el caso de la certificacion
            $respuesta = $generar_xml->ToXml($documento_fel);



            $conexion = new ConexionServicioFel();

            //$conexion->setUrl("https://testing.ingface.net:8443/fel/certificacion/dte");
            $conexion->setMetodo("POST");
            $conexion->setContentType("application/xml");
            $conexion->setUsuario(NITEMISOR . "PRO"); //prefijo
            // $conexion->setLlave("F4D555505AB7C1D5320E38F99943AD82");
            //produccion
            $conexion->setLlave("89C062B5BE23D37AC7FDE9F30F9F2417");
            //$conexion->setIdentificador("pruebas7");
            // echo "<pre>";
            // print_r($conexion);
            // die('conexion ');
            $firma = new FirmaEmisor();
            
            //usuario firma como llave es siempre el prefijo
            //(llave, token)
            // $xml_firmado = $firma->firmar($respuesta->getXml(), "102727171", "5fb23db71861dadf2c7365cd2b2142d1");
            //produccion
            //die(NITEMISOR . ' ' . TOKEN);
            $xml_firmado = $firma->firmar($respuesta->getXml(), NITEMISOR . "PRO", TOKEN);
            


            $servicio = new ServicioFel();
            $respuesta_servicio = $servicio->Certificar($conexion, $xml_firmado);

//             print_r($respuesta_servicio);
// 			die(TOKEN);
            // resultados facturación
            // echo $respuesta_servicio->getResultado();
            // die('fin');
            // echo "<br>";
            // echo "https://report.feel.com.gt/ingfacereport/ingfacereport_documento?uuid=" . $respuesta_servicio->getUuid();
            // echo "<br>";
            foreach ($respuesta_servicio->getDescripcionErrores() as $errores) {
                echo $errores->mensaje_error;
                echo "<br>";
            }

			var_dump($respuesta_servicio);

            if($respuesta_servicio->getCantidadErrores() == 0){

                $array = array(
                    'idventa'   =>  $idv,
                    'idusuario' =>  $_SESSION['uid'],
                    'fechahora' =>  $lafecha,
                    'uuid'      =>  $respuesta_servicio->getUuid(),
                    'numero'    =>  $respuesta_servicio->getNumero(),
                    'urldoc'    =>  "https://report.feel.com.gt/ingfacereport/ingfacereport_documento?uuid=" . $respuesta_servicio->getUuid()
                );

                // echo '<pre class="prettyprint"><code class="xml">' . htmlspecialchars($xml_firmado) . '</code></pre>';

                $this->db->insert('facturas', $array);

                // die();

                $array = array(
                    'status'    =>  3
                );

                $this->db->where('id', $idv);
                $this->db->update('ventas', $array);

            }else{
                foreach ($respuesta_servicio->getDescripcionErrores() as $errores) {
                    echo '<li>'. $errores->mensaje_error.'</li>';
                }
                // echo '<hr>';
                // echo '<pre class="prettyprint"><code class="xml">' . htmlspecialchars($xml_firmado) . '</code></pre>';
                // die();
            }
        }

        if(isset($_POST['guardar_venta'])){

            echo "<pre>";
            print_r($_POST);
            die();

            $idpA = $_POST['idp'];
            $descuento = $_POST['porcentaje'];
            $allTotales = 0;

            foreach ($idpA as $key => $value){
                $cantidad = $_POST['cantidad'][$key];
                $formapago = $_POST['formapago'];
                $venta = $_POST['venta'][$key];
                $venta = str_replace(',', '', $venta);

                $totalThis = $cantidad * $venta;
                $idp = $value;
                $allTotales = $allTotales + $totalThis;

                // reducir inventario
                $cpr = 0;
                while($cpr <= $cantidad){
                    $ventaPrecio = $_POST['venta'][$key];
                    $ventaPrecio = str_replace(',', '', $ventaPrecio);

                    $array = array(
                        'idventa'   =>  $idv,
                        'venta'     =>  $ventaPrecio,
                        'status'    =>  2
                    );

                    $this->db->where('idproducto', $idp);
                    $this->db->where('status', 1);
                    $this->db->limit(1);
                    $this->db->update('inventario', $array);

                    $cpr = $cpr + 1;
                }
            }

            $array = array(
                'total'         =>  $allTotales,
                'descuento'     =>  $descuento,
                'formapago'     =>  $formapago,
                'status'        =>  1
            );

            $this->db->where('id', $idv);
            $this->db->update('ventas', $array);

            redirect(base_url('pos'));
        }

        $laventa = $this->model->get_venta_id($idv);

        $this->db->query("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''));");
        $d['productos'] = $this->model->all_productos_all_status();
        $d['cliente'] = $this->model->get_cliente($laventa[0]['idcliente']);
        $d['productosAgregados'] = $this->model->get_productos_venta($idv);
        $d['ventadata'] = $this->model->get_venta($idv);
        $d['facturadata'] = array();
        if($d['ventadata'][0]['status'] >= 3){
            $d['facturadata'] = $this->model->get_factura_data($idv);
        }
        // echo "<pre>";
        // print_r($d['ventadata']);
        // echo "</pre>";
        // echo "<pre>";
        // print_r($d['productosAgregados']);
        // die();

        $this->load->view('header_view', $h);
		$this->load->view('editar_lista_venta_view', $d);
        $this->load->view('footer_view', $h);
	}

    public function ver_nota($idv)
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];
        //id asesor
        $idasesor = $_SESSION['uid'];

        $d['productosAgregados'] = $this->model->get_productos_venta($idv);
        $d['ventadata'] = $this->model->get_venta($idv);
        $d['listaex'] = $this->model->get_mi_exhibidores($idv);

        $this->load->view('header_invoice', $h);
		$this->load->view('invoice_view', $d);
        // $this->load->view('footer_view', $h);
	}

    public function ver_orden($idv)
	{
        $d['title'] = 'POS';
        $h['title'] =  $d['title'];
        //id asesor
        $idasesor = $_SESSION['uid'];

        $d['productosAgregados'] = $this->model->get_productos_venta($idv);
        $d['ventadata'] = $this->model->get_venta($idv);
        $d['listaex'] = $this->model->get_mi_exhibidores($idv);

        $this->load->view('header_invoice', $h);
		$this->load->view('orden_pedido_view', $d);
        // $this->load->view('footer_view', $h);
	}

    public function anular_factura($idfactura)
    {
        $factura = $this->model->get_factura_data_idfactura($idfactura);
        $idv = $factura[0]['idventa'];
        $venta = $this->model->get_venta($idv);
        // $fechaEmisionArray = explode('T',$factura[0]['fechahora']);
        // $fechaEmision = date('d/m/Y', strtotime($fechaEmisionArray[0]));

        $fechaEmision = $factura[0]['fechahora'];

        // die($fechaEmision);
        $fech1 = date('Y-m-d');
        $hora = date('H:i:s');
        $fechaAnulacion = $fech1 . 'T' . $hora . '-06:00';
        $nitReceptor = $venta[0]['nit'];
        $nitEmisor = '120118580';
        $razon = 'Anulación por error en factura';
        $documento = $factura[0]['uuid'];

        include APPPATH . 'third_party/infile/clases.php';

        $anulacion_fel = new AnulacionFel();
        $anulacion_fel->setFechaEmisionDocumentoAnular($fechaEmision);
        $anulacion_fel->setFechaHoraAnulacion($fechaAnulacion);
        $anulacion_fel->setIDReceptor($nitReceptor);
        // $anulacion_fel->setIDReceptor("CF");
        $anulacion_fel->setNITEmisor($nitEmisor);
        // $anulacion_fel->setNITEmisor("CF");
        $anulacion_fel->setMotivoAnulacion($razon);
        $anulacion_fel->setNumeroDocumentoAnular($documento);

        $generar_xml = new GenerarXml();
        $respuesta = $generar_xml->ToXml($anulacion_fel);

        $conexion = new ConexionServicioFel();

        $conexion->setUrl("https://certificador.feel.com.gt/fel/anulacion/v2/dte/");
        $conexion->setMetodo("POST");
        $conexion->setContentType("application/json");
        $conexion->setUsuario(c . "PRO");
        $conexion->setLlave(LLAVE);
        #$conexion->setIdentificador("asdasdsd");

		$firma = new FirmaEmisor();

        $xml_firmado = $firma->firmar($respuesta->getXml(), NITEMISOR . "PRO", TOKEN);

        $servicio = new ServicioFel();
        $respuesta_servicio = $servicio->Certificar($conexion, $xml_firmado);

        // echo "<pre>";
        // var_dump($respuesta_servicio);
        // echo '<p> REsultado '.$respuesta_servicio->getResultado().'</p>';
        // echo '<p> Errores ' . $respuesta_servicio->getCantidadErrores() . '</p>';

        if($respuesta_servicio->getCantidadErrores() == 0){
            //eliminar productos de inventario
            $array = array(
                'idventa'   =>  0,
                'venta'     =>  0,
                'status'    =>  1
            );

            $this->db->where('idventa', $idv);
            $this->db->update('inventario', $array);

            //eliminar de venta
            $this->db->where('id', $idv);
            $this->db->delete('ventas');

            //eliminar creditos
            $this->db->where('idventa', $idv);
            $this->db->delete('creditos');

            //eliminar factura
            $array = array(
                'status'    =>  2
            );

            $this->db->where('idventa', $idv);
            $this->db->update('facturas', $array);


        }else{
            // print_r($respuesta_servicio->getDescripcionErrores());
            // die();
            foreach ($respuesta_servicio->getDescripcionErrores() as $errores) {
                echo '<li>'. $errores->mensaje_error.'</li>';
            }
            echo '<hr>';
            echo '<pre class="prettyprint"><code class="xml">' . htmlspecialchars($xml_firmado) . '</code></pre>';

            die();
        }

        redirect(base_url('pos'));
    }

    public function eliminar_pedido($idv)
    {
        //eliminar productos de inventario
        $array = array(
            'idventa'   =>  0,
            'venta'     =>  0,
            'status'    =>  1
        );

        $this->db->where('idventa', $idv);
        $this->db->update('inventario', $array);

        //eliminar de venta
		$array = array(
			'status'	=>	55
		);

        $this->db->where('id', $idv);
        $this->db->update('ventas', $array);

        //eliminar creditos
        $this->db->where('idventa', $idv);
        $this->db->delete('creditos');

        redirect(base_url('pos'));
    }
}
