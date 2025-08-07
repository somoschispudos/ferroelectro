<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pending extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}else{
			if($_SESSION['role'] == 2){
				redirect(base_url('trips/' . $_SESSION['uid']));
			}
		}
  	}

	public function index()
	{
		$d['title'] = 'Pending payments';
        $h['title'] =  $d['title'];

		$d['payments'] = $this->model->all_pending_payments();
		$d['rev_year'] = $this->model->all_paid_year();
		$d['rev_month'] = $this->model->all_paid_month();
		$d['rev_pending'] = $this->model->all_pending_pay_total();

        $this->load->view('header_view', $h);
		$this->load->view('pending_payments_view', $d);
        $this->load->view('footer_view', $h);
	}
}
