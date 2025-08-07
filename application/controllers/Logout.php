<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();
  	}

	public function index()
	{
        // echo $_SESSION['logged'];
        // die('test');
        $_SESSION = array();
		session_destroy();
		redirect(base_url());
	}
}
