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
	public function DataPegawai()
	{
		$data['tampil'] = $this->MSudi->GetData('pegawai');
		$data['title'] = 'Data Pegawai';
		$this->load->view('temp/header', $data);
		$data['content'] = 'VBlank';
		$this->load->view('datapegawai/datapegawai', $data);
		$this->load->view('temp/footer', $data);
	}
	public function DataJabatan()
	{
		$data['tampilJabatan'] = $this->MSudi->GetData('jabatan_pegawai');
		$data['title'] = 'Data Jabatan';
		$this->load->view('temp/header', $data);
		$data['content'] = 'VBlank';
		$this->load->view('datajabatan/datajabatan', $data);
		$this->load->view('temp/footer', $data);
	}
	

	// ========================================== Add Data =========================== // 
	public function FormAddPegawai()
	{
		
		$data['title'] = 'Add Pegawai';
		$this->load->view('temp/header', $data);
		$data['content'] = 'VBlank';
		$this->load->view('FormAdd/AddPegawai', $data);
		$this->load->view('temp/footer', $data);
	}
	public function addDataPegawai()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis Kelamin', 'required');
		if ($this->form_validation->run() == false) {
			$id_pegawai = $this->input->post('');
			$nama = $this->input->post('');
			$alamat = $this->input->post('');
			$tanggal_lahir = $this->input->post('');
			$jenis_kelamin = $this->input->post('');
			$add = array(
				'status' => false,
			);
			$data = json_encode($add);
			echo $data;
			print_r($data,'dataError:');
		} else {
			$id_pegawai = $this->input->post('id_pegawai');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$add = array(
				'id_pegawai' => $id_pegawai,
				'nama' => $nama,
				'alamat' => $alamat,
				'tanggal_lahir' => $tanggal_lahir,
				'jenis_kelamin' => $jenis_kelamin
			);
			$this->MSudi->AddData('pegawai', $add);
			$data = array(
				'status' => true,
				'add Data Success' => $add,
			);
			$data = json_encode($data);
			echo $data;
			print_r($data,'data');
		}
	}
	public function addDataJabatan()
	{
		
	}
	// ============================================ Edit Data =======================// 
	public function FormEditPegawai()
	{
		
		$data['title'] = 'Edit Pegawai';
		$this->load->view('temp/header', $data);
		$data['content'] = 'VBlank';
		$id_pegawai = $this->uri->segment(3);
		$data['show'] = $this->MSudi->GetDataWhere('pegawai', 'id_pegawai', $id_pegawai)->result();
		$this->load->view('FormEdit/EditDataPegawai', $data);
		$this->load->view('temp/footer', $data);
	}
	public function editDataPegawai()
	{
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('alamat', 'alamat', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis Kelamin', 'required');
		if ($this->form_validation->run() == false) {
			$id_pegawai = $this->input->post('');
			$nama = $this->input->post('');
			$alamat = $this->input->post('');
			$tanggal_lahir = $this->input->post('');
			$jenis_kelamin = $this->input->post('');
			$update = array(
				'status' => false,
			);
			$data = json_encode($update);
			echo $data;
		} else {
			$id_pegawai = $this->input->post('id_pegawai');
			$nama = $this->input->post('nama');
			$alamat = $this->input->post('alamat');
			$tanggal_lahir = $this->input->post('tanggal_lahir');
			$jenis_kelamin = $this->input->post('jenis_kelamin');
			$update = array(
				'id_pegawai' => $id_pegawai,
				'nama' => $nama,
				'alamat' => $alamat,
				'tanggal_lahir' => $tanggal_lahir,
				'jenis_kelamin' => $jenis_kelamin
			);

			$this->MSudi->UpdateData('pegawai', 'id_pegawai', $id_pegawai, $update);
			$data = array(
				'status' => true,
				'Data Diubah' => $update,
			);
			$data = json_encode($data);
			echo $data;
		}
	}
	public function editDataJabatan()
	{
		
	}
	
	// ============================================ Delete Data =======================// 
	public function deleteDataPegawai()
	{
		
	}
	public function deleteDataJabatan()
	{
		
	}




}
