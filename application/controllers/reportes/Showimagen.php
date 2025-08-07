<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Showimagen extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index($idv)
	{
		$imagen = $this->model->get_all_imagenes($idv);
		$imagenURL = base_url($imagen[0]['base64image']);
		echo '<img src="'.$imagenURL.'" alt="Imagen">';
	}
}
?>
