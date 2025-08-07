<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trips extends CI_Controller {

	public function __construct()
  	{
		parent::__construct();
    	session_start();

		if(!isset($_SESSION['logged'])){
        	redirect(base_url());
   		}
  	}

	public function index($iddriver)
	{
		$d['title'] = 'Trips';
        $h['title'] =  $d['title'];

		if(isset($_POST['saveend'])){
			$da = $_POST['date'];
			$da = str_replace('-', '/', $da);
			$date = date('Y-m-d', strtotime($da));
			$odometer = $_POST['odometer'];
			$idlist = $_POST['idlist'];

			$array = array(
				'date_ended'	=>	$date,
				'miles_end'		=>	$odometer,
				'status'		=>	1
			);

			$this->db->where('id', $idlist);
			$this->db->update('lists', $array);
		}

		if(isset($_POST['savestart'])){
			$da = $_POST['date'];
			$da = str_replace('-', '/', $da);
			$date = date('Y-m-d', strtotime($da));
			$odometer = $_POST['odometer'];

			$array = array(
				'id_driver'		=>	$iddriver,
				'date_created'	=>	$date,
				'miles_start'	=>	$odometer,
				'status'		=>	0
			);

			$this->db->insert('lists', $array);
			$listid = $this->db->insert_id();
			redirect(base_url('trips/list_trips/' . $listid));
		}

		$d['activelist'] = $this->model->active_list_driver($iddriver);
		$d['lists'] = $this->model->all_lists($iddriver);

		$thedriver = $this->model->get_driver($iddriver);
		$d['driver'] = $thedriver[0]['name'];
		$d['truck'] = $thedriver[0]['trailer'];
		$d['tractor'] = $thedriver[0]['tractor'];

        $this->load->view('header_view', $h);
		$this->load->view('trips_view', $d);
        $this->load->view('footer_view', $h);
	}

	public function new_list($iddriver)
	{
		$date = date('Y-m-d');

		$array = array(
			'id_driver'		=>	$iddriver,
			'date_created'	=>	$date
		);

		$this->db->insert('lists', $array);
		$listid = $this->db->insert_id();
		redirect(base_url('trips/list_trips/' . $listid));
	}

	public function list_trips($listid)
	{
		$d['title'] = 'Trips';
        $h['title'] =  $d['title'];

		if(isset($_POST['savetrip'])){
			$da = $_POST['date'];
			$da = str_replace('-', '/', $da);
			$date = date('Y-m-d', strtotime($da));
			$shipper = $_POST['shipper'];
			$fromcity = $_POST['fromcity'];
			// $fromstate = $_POST['fromstate'];
			$destination = $_POST['destination'];
			$tocity = $_POST['tocity'];
			// $tostate = $_POST['tostate'];
			$stops = $_POST['stops'];
			$notes = $_POST['notes'];

			// echo "<pre>";
			// print_r($_POST);
			// die();

			$array = array(
				'listid'		=>	$listid,
				'date'			=>	$date,
				'shipper'		=>	$shipper,
				'fromcity'		=>	$fromcity,
				'fromstate'		=>	'CA',
				'destination'	=>	$destination,
				'tocity'		=>	$tocity,
				'tostate'		=>	'CA',
				'stops'			=>	$stops,
				'notes'			=>	$notes
			);

			$this->db->insert('trips', $array);
		}

		if(isset($_POST['savefuel'])){
			$da = $_POST['date'];
			$da = str_replace('-', '/', $da);
			$date = date('Y-m-d', strtotime($da));
			$station = $_POST['station'];
			$city = $_POST['city'];
			$option = $_POST['option'];
			$gallons = $_POST['gallons'];
			$total = $_POST['total'];
			$total = str_replace('$', '', $total);
			$total = str_replace(',', '', $total);

			$array= array(
				'listid'		=>	$listid,
				'date'			=>	$date,
				'station'		=>	$station,
				'city'			=>	$city,
				'state'			=>	'CA',
				'option'		=>	$option,
				'gallons'		=>	$gallons,
				'total'			=>	$total
			);

			$this->db->insert('fuel', $array);
		}

		if(isset($_POST['saveexpenses'])){
			$da = $_POST['date'];
			$da = str_replace('-', '/', $da);
			$date = date('Y-m-d', strtotime($da));
			$total = $_POST['total'];
			$total = str_replace('$', '', $total);
			$total = str_replace(',', '', $total);
			$city = $_POST['city'];
			$purpose = $_POST['purpose'];

			$array= array(
				'listid'		=>	$listid,
				'date'			=>	$date,
				'total'			=>	$total,
				'city'			=>	$city,
				'state'			=>	'CA',
				'purpose'		=>	$purpose
			);

			$this->db->insert('expenses', $array);
		}

		$d['cities'] = $this->model->california_cities();
		$d['trips'] = $this->model->get_the_trips($listid);
		$d['fuel'] = $this->model->get_the_fuel($listid);
		$d['totalgallons'] = $this->model->total_gallons($listid);
		$d['totalmoney'] = $this->model->total_money($listid);
		$d['expenses'] = $this->model->get_the_expenses($listid);
		$d['totalexpenses'] = $this->model->total_expenses($listid);
		$d['activelist'] = $this->model->get_list($listid);

		$thedriver = $this->model->get_driver($d['activelist'][0]['id_driver']);
		$d['driver'] = $thedriver[0]['name'];
		$d['truck'] = $thedriver[0]['trailer'];
		$d['tractor'] = $thedriver[0]['tractor'];

		// echo "<pre>";
		// print_r($d['activelist']);
		// die();

        $this->load->view('header_view', $h);
		$this->load->view('list_trips_view', $d);
        $this->load->view('footer_view', $h);
	}
}
