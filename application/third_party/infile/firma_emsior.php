<!-- <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script> -->
<?php
	class FirmaEmisor {
		 public function firmar( $xml, $aliaspfx, $llave_pfx) {
		 	$url_servicio_firma = "https://signer-emisores.feel.com.gt/sign_solicitud_firmas/firma_xml";

			// echo "Clase Firma Emisor";
			// echo '<pre class="prettyprint"><code class="xml">' . htmlspecialchars($xml) . '</code></pre>';

        	$es_anulacion = "N";

        	if (strpos($xml, 'GTAnulacionDocumento') !== false) {
            	$es_anulacion = "S";
       		}

       		 $encoded_xml =  base64_encode($xml);

       		  $contenido_xml = array(
		            'llave' => $llave_pfx,
		            'archivo' => $encoded_xml,
		            'codigo' => "n/a",
		            'alias' => $aliaspfx,
		            'es_anulacion' => $es_anulacion
        		);


       		  $json_body = json_encode( $contenido_xml );

    		 $response = \Httpful\Request::post($url_servicio_firma)
				    ->sendsJson()
				    ->body($json_body)
				    ->send();


       		 return base64_decode($response->body->archivo);
		 }
	}
?>