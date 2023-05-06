<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kontrak extends CI_Controller {
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
		
		$data['title'] = 'Data Kontrak';
        $this->load->view('temp/header', $data);
        $data['content'] = 'VBlank';
        $this->load->view('datakontrak/datakontrak', $data);
        $this->load->view('temp/footer', $data);
    }
	public function GetKontrak()
	{
		$data = $this->MSudi->GetDataKontrak()->result();
		echo json_encode($data);
	}
	// ======================================== AddData ============================== //
	public function FormAddKontrak()
    {

        $data['title'] = 'Add Kontrak';
        $this->load->view('temp/header', $data);
        $data['content'] = 'VBlank';
		$data['tampil'] = $this->MSudi->GetData('pegawai');
		$data['show'] = $this->MSudi->GetData('jabatan_pegawai');
        $this->load->view('FormAdd/AddKontrak', $data);
        $this->load->view('temp/footer', $data);
    }
	public function AddDataKontrak()
	{
		$this->form_validation->set_rules('id_pegawai', 'nama pegawai', 'required');
        $this->form_validation->set_rules('id_jabatan', 'jabatan', 'required');
        if ($this->form_validation->run() == false) {
            $id_pegawai = $this->input->post('');
            $id_jabatan = $this->input->post('');
            $add = array(
                'status' => false,
            );
            $data = json_encode($add);
            echo $data;
            print_r($data, 'dataError:');
        } else {
            $id_pegawai = $this->input->post('id_pegawai');
            $id_jabatan = $this->input->post('id_jabatan');
            $tanggal_mulai = $this->input->post('tanggal_mulai');
            $tanggal_selesai = $this->input->post('tanggal_selesai');
            $add = array(
                'id_pegawai' => $id_pegawai,
                'id_jabatan' => $id_jabatan,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai,
            );
            $this->MSudi->AddData('kontrak', $add);
            $data = array(
                'status' => true,
                'add Data Success' => $add,
            );
            $data = json_encode($data);
            echo $data;
            print_r($data, 'data');
        }
	}
	// ======================================== EditData ============================== //
	public function FormEditKontrak()
    {

        $data['title'] = 'Edit Kontrak Pegawai';
        $this->load->view('temp/header', $data);
        $data['content'] = 'VBlank';
        $id_kontrak = $this->uri->segment(3);
        $data['show'] = $this->MSudi->GetDataWhere('kontrak', 'id_kontrak', $id_kontrak)->result();
		$data['show2'] =$this->MSudi->GetData('pegawai');
		$data['show3'] =$this->MSudi->GetData('jabatan_pegawai');
        $this->load->view('FormEdit/EditDataKontrak', $data);
        $this->load->view('temp/footer', $data);
    }
	public function editDataKontrak()
	{
		 // validasi data form
		 $this->form_validation->set_rules('id_pegawai', 'nama pegawai', 'required');
		 $this->form_validation->set_rules('id_jabatan', 'jabatan', 'required');
 
		 if ($this->form_validation->run() == false) {
			 // jika data tidak valid
			 $data = array(
				 'status' => false,
				 'pesan' => validation_errors(),
			 );
		 } else {
			 // jika data valid
			 $id_kontrak = $this->uri->segment(3);
			 $id_pegawai = $this->input->post('id_pegawai');
			 $id_jabatan = $this->input->post('id_jabatan');
			 $tanggal_mulai = $this->input->post('tanggal_mulai');
			 $tanggal_selesai = $this->input->post('tanggal_selesai');
			 $update = array(
				 'id_pegawai' => $id_pegawai,
				 'id_jabatan' => $id_jabatan,
				 'tanggal_mulai' => $tanggal_mulai,
				 'tanggal_selesai' => $tanggal_selesai,
			 );
 
			 // update data ke database
			 $this->MSudi->UpdateData('kontrak', 'id_kontrak', $id_kontrak, $update);
			 $data = array(
				 'status' => true,
				 'pesan' => 'Data berhasil diperbarui.',
				 'Data Diubah' => $update,
			 );
		 }
 
			 // tampilkan data dalam format JSON
		 $data = json_encode($data);
		 echo $data;
	}
	// ======================================== DeleteData ============================== //
	public function deleteDataKontrak()
	{
		$id_kontrak = $this->uri->segment(3);
		$hapus = array(
			'id_kontrak' =>$id_kontrak
		);
		$this->MSudi->DeleteData('kontrak','id_kontrak',$id_kontrak);
		
		$id_kontrak = $this->uri->segment('3');
		$data_kontrak = $this->MSudi->GetDataWhere('kontrak', 'id_kontrak', $id_kontrak);
		
		if (!$data_kontrak) {
			$data = array(
				'status' => false,
				'message' => 'Data tidak ditemukan',
			);
		} else {
			$delete = array(
				'id_kontrak' => $id_kontrak,
			);
			$this->MSudi->DeleteData('kontrak', 'id_kontrak', $id_kontrak);
			$data = array(
				'status' => true,
				'message' => 'Data berhasil dihapus',
				'Data Di Hapus' => $delete,
			);
		}
		$data = json_encode($data);
		echo $data;
		
	}
}
