<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	function __construct()
	{
		parent::__construct();
		$this->load->model('MSudi');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$data['title'] = 'Home';
			$this->load->view('temp/header', $data);
			$data['content'] = 'VBlank';
			$this->load->view('home', $data);
			$this->load->view('temp/footer', $data);
	}

	// ======================================== GetData ============================== //
	public function DataKontrak()
	{
		$data['tampil'] = $this->MSudi->GetData('kontrak');
		$data['title'] = 'Data Kontrak';
		$this->load->view('temp/header', $data);
		$data['content'] = 'VBlank';
		$this->load->view('datakongtrak/datakongtrak', $data);
		$this->load->view('temp/footer', $data);
	}
	// ======================================== AddData ============================== //
	public function AddDataKontrak()
	{
		# code...
	}
	// ======================================== EditData ============================== //
	public function editDataKontrak(Type $var = null)
	{
		# code...
	}
	// ======================================== DeleteData ============================== //
	public function deleteDataKontrak(Type $var = null)
	{
		# code...
	}
}
