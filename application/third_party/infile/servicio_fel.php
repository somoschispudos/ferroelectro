<?php
class ServicioFel {

	public function Certificar($conexion, $xml)
	{

		$respuesta = new RespuestaServicioFel();

		$url_servicio_fel = "";



		if (strpos($xml, 'dte:GTAnulacionDocumento') !== false) {

            //$url_servicio_fel = "https://testing.ingface.net:8443/fel/anulacion/dte";
            $url_servicio_fel = "https://certificador.feel.com.gt/fel/anulacion/v2/dte/";
        }


        if (strpos($xml, 'dte:GTDocumento') !== false) {
            //$url_servicio_fel = "https://testing.ingface.net:8443/fel/certificacion/dte";
            $url_servicio_fel = "https://certificador.feel.com.gt/fel/certificacion/v2/dte/";
        }



       try{

        $contenido_xml = array(
            'nit_emisor' => "",
            'correo_copia' => '',
            'xml_dte' => base64_encode($xml)
        );

        $json_body = json_encode( $contenido_xml );

    	 $response = \Httpful\Request::post($url_servicio_fel)
				    ->sendsJson()
				    ->body($json_body)
				    ->addHeaders(array(
      					  'Usuario' => $conexion->getUsuario(),
        				  'llave' => $conexion->getLlave(),
        				  "identificador" => $conexion->getIdentificador()
    					))
				    ->send();

	    if ($response->code == 200)
	    {

	    	  #var_dump($response->body);

       		  $respuesta->setResultado($response->body->resultado);
       		  $respuesta->setFecha($response->body->fecha);
       		  $respuesta->setOrigen($response->body->origen);
       		  $respuesta->setDescripcion($response->body->descripcion);
       		  $respuesta->setControlEmision($response->body->control_emision);
       		  $respuesta->setAlertasInfile($response->body->alertas_infile);
       		  $respuesta->setDescripcionAlertasInfile($response->body->descripcion_alertas_infile);
       		  $respuesta->setAlertasSat($response->body->alertas_sat);
       		  $respuesta->setDescripcionAlertasSat($response->body->descripcion_alertas_sat);
       		  $respuesta->setCantidadErrores($response->body->cantidad_errores);
       		  $respuesta->setDescripcionErrores($response->body->descripcion_errores);
       		  $respuesta->setInformacionAdicional($response->body->informacion_adicional);
       		  $respuesta->setUuid($response->body->uuid);
       		  $respuesta->setSerie($response->body->serie);
       		  $respuesta->setNumero($response->body->numero);
       		  $respuesta->setXmlCertificado($response->body->xml_certificado);
       		  $respuesta->setJsonRespuesta(json_encode($response->body));


	    } else
	    {
	    	 #var_dump($response->raw_headers);

	    	 $respuesta->setResultado(false);
	    	 $respuesta->setInfo($response->raw_headers);
	    	 $respuesta->setJsonRespuesta($response->raw_headers);
	    	 $respuesta->setOrigen("Conexion");
	    	 $respuesta->setCantidadErrores(0);
	    	 $respuesta->setFecha(date("c"));
	    }





        return $respuesta;

      }catch(Exception $error){
        echo("Error al enviar: " . $resultado_json);
		// echo $error;
        return $resultado_json;
      }

	}

 }
