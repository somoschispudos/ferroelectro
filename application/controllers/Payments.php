<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payments extends CI_Controller {

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
		$d['title'] = 'All payments';
        $h['title'] =  $d['title'];

		if(isset($_POST['save'])){
			$ammmount = $_POST['ammount'];
			$ammmount = str_replace('$', '', $ammmount);
			$ammmount = str_replace(',', '', $ammmount);
			$date = date('Y-m-d');

			$array = array(
				'code'			=>	$_POST['code'],
				'rate'			=>	$ammmount,
				'date_created'	=>	$date,
				'shipper'		=>	$_POST['shipper'],
				'destination'	=>	$_POST['destination']
			);

			$this->db->insert('payments', $array);
		}

		$d['payments'] = $this->model->all_payments();
		$d['rev_year'] = $this->model->all_paid_year();
		$d['rev_month'] = $this->model->all_paid_month();
		$d['rev_pending'] = $this->model->all_pending_pay_total();

        $this->load->view('header_view', $h);
		$this->load->view('payments_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function paid()
	{
		$id = $_POST['id'];
		$status = $_POST['status'];
		$date = date('Y-m-d');

		if($status == 1){
			$newstatus = 0;
		}else{
			$newstatus = 1;
		}

		$array = array(
			'status' 		=>	$newstatus,
			'date_paid'		=>	$date
		);

		$this->db->where('id', $id);
		$this->db->update('payments', $array);

		if($newstatus == 0){
			echo '##-##-####';
		}else{
			echo date('m-d-Y', strtotime($date));
		}
	}

	public function check_code()
	{
		$code = $_POST['code'];

		$check = $this->model->check_paymentcode($code);

		echo $check;
	}
}
