<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct()
  	{
		parent::__construct();
    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

    public function getMunicipios()
    {
        $iddep = $_POST['iddep'];
        $municipios = $this->model->get_municipios($iddep);

        $html = '<select class="form-control" placeholder="Seleccionar Municipio..." autocomplete="off" name="municipio" id="municipios">';
        foreach($municipios as $m){
            $html .= '<option value="' . $m['id'] . '">' . $m['name'] . '</option>';
        }
        $html .= '</select>';

        echo $html;
    }

    public function add_producto()
    {
        $idp = $_POST['idp'];
        $cantidad = $_POST['cantidad'];
        $indes = $_POST['indes'];

        $existencia = $this->model->lista_inventario_conteo_productos($idp);
        if($cantidad > $existencia){
            echo 'mucho';
        }else{
            $producto = $this->model->get_producto($idp);

            $sku = $producto[0]['sku'];
            $nombre = $producto[0]['nombreproducto'];

            $venta = $producto[0]['venta'];
            $descuento = ($venta * $indes) / 100;
            $venta = $venta - $descuento;
            $total = $cantidad * $venta;
            $total = number_format($total, 2, '.', ',');
            $venta = number_format($venta, 2, '.', ',');

            if($indes > 0){
                $asterisk = '<span style="color: orange;">* Desc. %' . $indes . ' (Q' . number_format($descuento, 2, '.', ''). ')</span>';
            }else{
                $asterisk = '';
            }

			$notas = '* Desc. %' . $indes . ' (Q' . number_format($descuento, 2, '.', ''). ')';

            $inputs = '<input type="hidden" name="idp[]" value="'.$idp.'">';
            $inputs .= '<input type="hidden" name="cantidad[]" value="'.$cantidad.'">';
            $inputs .= '<input type="hidden" name="venta[]" value="'.$venta.'">';
            $inputs .= '<input type="hidden" name="totales[]" class="lostotales" value="'.$total.'">';
			$inputs .= '<input type="hidden" name="notas[]" value="'.$notas.'">';

            $html = '<tr>';
            $html .= '<td style="width: 70px; text-align: center;"><a href="javascript:void(0);" class="btn btn-danger btn-sm removeresto"><i class="fas fa-minus"></i></a>' . $inputs . '</td>';
            $html .= '<td style="text-align: center; width: 140px;">' . $sku . '</td>';
            $html .= '<td style="text-align: left; font-weight: bold;">'.$asterisk . ' '  . $nombre . '</td>';
            $html .= '<td style="text-align: center; width: 70px;">' . $cantidad . '</td>';
            $html .= '<td style="text-align: right; width: 100px;">' . 'Q' . $venta . '</td>';
            $html .= '<td style="text-align: right; width: 120px;">Q' . $total . '</td>';
            $html .= '</tr>';

            echo $html;
        }

    }

	public function saveimageneliminada()
	{
		$ventaid = $_POST['idventa'];
		$imagen = $_POST['imagen'];

		$img = $imagen;
		$img = str_replace('data:image/png;base64,', '', $img);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = 'eliminadosimg/imagen-'.$ventaid.'.png';
		$success = file_put_contents($file, $data);

		$array = array(
			'ideliminado'	=>	$ventaid,
			'base64image'	=>	$file
		);

		$this->db->insert('imagenes_eliminadas', $array);

		echo "insertado";
	}
}
