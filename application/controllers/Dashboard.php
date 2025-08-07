<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();
		// phpinfo();
		if(!isset($_SESSION['logged'])){
			// echo $_SESSION['logged'];
			// print_r($_SESSION);
			// die('not set');
        	redirect(base_url());
   		}
  	}

	public function index()
	{
        $d['title'] = 'Dashboard';
        $h['title'] =  $d['title'];

        // $d['rev_year'] = $this->model->all_paid_year();
		// $d['rev_month'] = $this->model->all_paid_month();
		// $d['rev_pending'] = $this->model->all_pending_pay_total();

        $this->load->view('header_view', $h);
		$this->load->view('dashboard_view', $d);
        $this->load->view('footer_view', $h);
	}
}
