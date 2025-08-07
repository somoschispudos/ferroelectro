<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nota_credito extends CI_Controller {

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

		if($_SESSION['rol'] == 1 || $_SESSION['rol'] == 3 || $_SESSION['rol'] == 4){
            $d['ventas'] = $this->model->get_all_ventas();
        }elseif($_SESSION['rol'] == 2){
            $d['ventas'] = $this->model->get_all_ventas_asesor($_SESSION['uid']);
        }

        $this->load->view('header_view', $h);
		$this->load->view('contabilidad/notas_credito_view', $d);
        $this->load->view('footer_view', $h);
    }

	public function edit_nota_credito($idv)
	{
		$d['title'] = 'Contabilidad';
        $h['title'] =  $d['title'];
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

        // if(isset($_POST['crear_nota'])){
        //     $array = array(
        //         'status'    =>  2
        //     );

        //     $this->db->where('id', $idv);
        //     $this->db->update('ventas', $array);
        // }

        if(isset($_POST['crear_nota'])){

            $losProductos = $_POST;
            $vals = array_count_values($_POST['idproducto']);
            $factura = $this->model->get_factura_data($idv);
            $uuid = $factura[0]['uuid'];
            $fechaEmision = $factura[0]['fechahora'];

            $productosNC = array();
            foreach($vals as $k => $v){
                $productID = $k;
                $cantidad = $v;

                $ventadata = $this->model->lista_inventario_array_venta($idv, $productID, $cantidad);
                $producto = $this->model->get_producto($productID);
                $sku = $producto[0]['sku'];
                $nombre = $producto[0]['nombreproducto'];
                $venta = $ventadata[0]['venta'];

                $array = array(
                    'productoID'    =>  $productID,
                    'cantidad'      =>  $cantidad,
                    'venta'         =>  $venta,
                    'sku'           =>  $sku,
                    'nombre'        =>  $nombre
                );

                array_push($productosNC, $array);
            }



            // echo "<pre>";
            // print_r($productosNC);
            $ventaInfo= $this->model->get_venta($idv);
            $facturaInfo = $this->model->get_factura_data($idv);
            $numeroFactura = $facturaInfo[0]['numero'];
            $uuidFactura = $facturaInfo[0]['uuid'];
            $uuidA = explode('-', $uuidFactura);
            $serieFactura = $uuidA[0];
            $fechaHoraArray = explode('T', $facturaInfo[0]['fechahora']);
            $fechaFactura = $fechaHoraArray[0];

            // echo "numero $numeroFactura";
            // echo "<br>";
            // echo "serie $serieFactura";
            // echo "<br>";
            // echo "fecha $fechaFactura";
            // echo "<pre>";
            // print_r($productosNC);
            // die();

            include APPPATH . 'third_party/infile/clases.php';

            $documento_fel = new DocumentoFel();
	        $datos_emisor = new DatosEmisor();

            $datos_emisor->setAfiliacionIVA("GEN");
            $datos_emisor->setCodigoEstablecimiento(1);
            $datos_emisor->setCodigoPostal("01001");
            $datos_emisor->setCorreoEmisor("fel@fel.com.gt");
            $datos_emisor->setDepartamento("Guatemala");
            $datos_emisor->setMunicipio("Guatemala");
            $datos_emisor->setDireccion("DIAGONAL 6 14-01 CENTRO COMERCIAL LAS MARGARITAS, LOCAL 5 ZONA 10");
            $datos_emisor->setNITEmisor("102727171");
            $datos_emisor->setNombreComercial("CORPORACION SYNERGY");
            $datos_emisor->setNombreEmisor("CORPORACION SYNERGY DE CENTROAMERICA, SOCIEDAD ANONIMA");
            $datos_emisor->setPais("GT");
            $documento_fel->setDatosEmisor($datos_emisor);

            $datos_generales = new DatosGenerales();
            $datos_generales->setCodigoMoneda("GTQ");

            $fech1 = date('Y-m-d');
            $hora = date('H:i:s');
            $lafecha = $fech1 . 'T' . $hora . '-06:00';
            $datos_generales->setFechaHoraEmision($lafecha);
            //$datos_generales->setNumeroAcceso(11111);
            $datos_generales->setTipo("NCRE");
            $documento_fel->setDatosGenerales($datos_generales);

            $datos_receptor = new DatosReceptor();
            $datos_receptor->setCodigoPostal("01002");
            //para multiples correos usar ; sin espacios
            $datos_receptor->setCorreoReceptor("");
            $datos_receptor->setDepartamento($ventaInfo[0]['departamento']);
            $datos_receptor->setDireccion($ventaInfo[0]['direccion']);
            //EN CASO DE NO TENER NIT, AGREGAR CF
            $datos_receptor->setIDReceptor($ventaInfo[0]['nit']);
            // $datos_receptor->setIDReceptor('CF');
            $datos_receptor->setMunicipio($ventaInfo[0]['municipio']);
            $datos_receptor->setNombreReceptor($ventaInfo[0]['razonsocial']);
            $datos_receptor->setPais("GT");
            // $datos_receptor->setTipoEspecial("CUI");
            $documento_fel->setDatosReceptor($datos_receptor);

            $frases = new Frases();
            $frases->setTipoFrase(1);
            $frases->setCodigoEscenario(1);
            // $frases->setResolucion("");
            // $frases->setFecha("");
            $documento_fel->setFrases($frases);

            $lineas = 1;
            $granTotal = 0;
            $sumasImpuestos = 0;
            $descuentoP = 0;
            foreach($productosNC as $p){
                $items = new Items();

                $items->setNumeroLinea($lineas);
                $items->setBienOServicio("B");

                // $cantidad = $this->model->lista_inventario_conteo_venta($idv, $p['idproducto']);
                $cantidad = $p['cantidad'];
                $elPrecioProducto = $p['venta'];
                $totaldeVenta = $p['venta'] * $cantidad;
                $descuentoVenta = $totaldeVenta * $descuentoP;
                $calculoUniDesc = $p['venta'] * $descuentoP;
                $calculoUniDescTotal = $p['venta'] - $calculoUniDesc;
                $calculoUniDescTotal = number_format($calculoUniDescTotal, 2, '.', '');

                $items->setCantidad($cantidad);
                $items->setDescripcion($p['sku'] . '|' . $p['nombre']);
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
            $totales->setGranTotal($granTotal);
            $documento_fel->setTotales($totales);


            $complemento_notas=new ComplementoNotas();
            $complemento_notas->setIdComplemento("notas");
            $complemento_notas->setNombrecomplemento("notas");
            $complemento_notas->setUriComplemento("notas");
            $complemento_notas->setRegimenAntiguo("");//enviar "Antiguo" cuando se quiera afectar una factura que no sea FEL.
            $complemento_notas->setNumeroAutorizacionDocumentoOrigen($uuid);
            $complemento_notas->setFechaEmisionDocumentoOrigen($fechaFactura);
            $complemento_notas->setMotivoAjuste("Por venta V-".$idv);
            $complemento_notas->setSerieDocumentoOrigen($serieFactura);
            $complemento_notas->setNumeroDocumentoOrigen($numeroFactura);

            $documento_fel->setComplementos($complemento_notas);

            $adendas = new Adendas();
            $adendas->setAdenda("Cajero", $_SESSION['nombre']);
            $adendas->setAdenda("OrdenCompra", "V-".$idv);

            $documento_fel->setAdenda($adendas);

            $generar_xml = new GenerarXml();
            $respuesta = $generar_xml->ToXml($documento_fel);

            echo "Ver respuesta";
            echo "<pre>";
            print_r($respuesta);
            echo "</pre>";

            $conexion = new ConexionServicioFel();

            //$conexion->setUrl("https://testing.ingface.net:8443/fel/certificacion/dte");
            $conexion->setUrl("https://certificador.feel.com.gt/fel/certificacion/v2/dte");
            $conexion->setMetodo("POST");
            $conexion->setContentType("application/xml");
            $conexion->setUsuario("CSCSAPRO");
            $conexion->setLlave("F4D555505AB7C1D5320E38F99943AD82");

            $firma = new FirmaEmisor();

            $xml_firmado = $firma->firmar($respuesta->getXml(), "CSCSAPRO", "de1a56aa97b5b5ba7605fe569cc55754");

            $servicio = new ServicioFel();
            $respuesta_servicio = $servicio->Certificar($conexion, $xml_firmado);

            foreach ($respuesta_servicio->getDescripcionErrores() as $errores) {
                echo $errores->mensaje_error;
                echo "<br>";
            }

            if($respuesta_servicio->getCantidadErrores() == 0){
                $fecha = date('Y-m-d');

                $array = array(
                    'idventa'   =>  $idv,
                    'idusuario' =>  $_SESSION['uid'],
                    'fechahora' =>  $lafecha,
                    'fecha'     =>  $fecha,
                    'uuid'      =>  $respuesta_servicio->getUuid(),
                    'serie'     =>  $respuesta_servicio->getSerie(),
                    'numero'    =>  $respuesta_servicio->getNumero()
                );

                $this->db->insert('notas_credito', $array);

                $insert_id = $this->db->insert_id();

                $array = array(
                    'nc'    =>  $insert_id
                );

                $this->db->where('id', $idv);
                $this->db->update('ventas', $array);

                ///regresar los productos y agregar la lista
                foreach($productosNC as $p){
                    $pid = $p['productoID'];
                    $cantidad = $p['cantidad'];

                    $ventadata = $this->model->lista_inventario_array_venta($idv, $pid, $cantidad);

                    foreach($ventadata as $v){
                        $array = array(
                            'idventa'   =>  0,
                            'venta'     =>  0,
                            'status'    =>  1
                        );

                        $this->db->where('id', $v['id']);
                        $this->db->update('inventario', $array);
                    }

                    //insertar lista
                    $array = array(
                        'id_nota'       =>  $insert_id,
                        'id_producto'   =>  $p['productoID'],
                        'cantidad'      =>  $p['cantidad'],
                        'venta'         =>  $p['venta'],
                        'sku'           =>  $p['sku'],
                        'nombre'        =>  $p['nombre'],
                    );

                    $this->db->insert('lista_nota_credito', $array);
                }

                die('Nota de crédito creada');
            }else{
                foreach ($respuesta_servicio->getDescripcionErrores() as $errores) {
                    echo '<li>'. $errores->mensaje_error.'</li>';
                }
                echo '<hr>';
                echo '<pre class="prettyprint"><code class="xml">' . htmlspecialchars($xml_firmado) . '</code></pre>';
                die();
            }
        }

        $laventa = $this->model->get_venta_id($idv);

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
		$this->load->view('contabilidad/lista_nota_view', $d);
        $this->load->view('footer_view', $h);
	}
}