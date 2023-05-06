<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('MSudi');
        $this->load->library('form_validation');
        $this->load->helper('url', 'form', 'date');

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
            print_r($data, 'dataError:');
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
                'jenis_kelamin' => $jenis_kelamin,
            );
            $this->MSudi->AddData('pegawai', $add);
            $data = array(
                'status' => true,
                'add Data Success' => $add,
            );
            $data = json_encode($data);
            echo $data;
            print_r($data, 'data');
        }
    }
    public function FormAddJabatan()
    {

        $data['title'] = 'Add Jabatan';
        $this->load->view('temp/header', $data);
        $data['content'] = 'VBlank';
        $this->load->view('FormAdd/AddJabatan', $data);
        $this->load->view('temp/footer', $data);
    }
    public function addDataJabatan()
    {
        $this->form_validation->set_rules('nama_jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('gaji', 'Gaji Pokok', 'required');
        if ($this->form_validation->run() == false) {
            $nama_jabatan = $this->input->post('nama_jabatan');
            $gaji = $this->input->post('gaji');
            $add = array(
                'status' => false,
                'pesan' => validation_errors(),
            );
            $data = json_encode($add);
            echo $data;
        } else {
            $nama_jabatan = $this->input->post('nama_jabatan');
            $gaji = $this->input->post('gaji');
            $add = array(
                'nama_jabatan' => $nama_jabatan,
                'gaji' => $gaji,
            );
            $this->MSudi->AddData('jabatan_pegawai', $add);
            $data = array(
                'status' => true,
                'add Data Success' => $add,
            );
            $data = json_encode($data);
            echo $data;
        }
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
        // validasi data form
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis Kelamin', 'required');

        if ($this->form_validation->run() == false) {
            // jika data tidak valid
            $data = array(
                'status' => false,
                'pesan' => validation_errors(),
            );
        } else {
            // jika data valid
            $id_pegawai = $this->uri->segment(3);
            $nama = $this->input->post('nama');
            $alamat = $this->input->post('alamat');
            $tanggal_lahir = $this->input->post('tanggal_lahir');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $update = array(
                'nama' => $nama,
                'alamat' => $alamat,
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
            );

            // update data ke database
            $this->MSudi->UpdateData('pegawai', 'id_pegawai', $id_pegawai, $update);
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

    public function FormEditJabatan()
    {

        $data['title'] = 'Edit Jabatan';
        $this->load->view('temp/header', $data);
        $data['content'] = 'VBlank';
        $id_jabatan = $this->uri->segment(3);
        $data['showJ'] = $this->MSudi->GetDataWhere('jabatan_pegawai', 'id_jabatan', $id_jabatan)->result();
        $this->load->view('FormEdit/EditDataJabatan', $data);
        $this->load->view('temp/footer', $data);
    }
    public function editDataJabatan()
    {
        $this->form_validation->set_rules('nama_jabatan', 'nama', 'required');
        $this->form_validation->set_rules('gaji', 'alamat', 'required');

        if ($this->form_validation->run() == false) {
            $nama_jabatan = $this->input->post('nama_jabatan');
            $gaji = $this->input->post('gaji');
            $data = array(
                'status' => false,
                'pesan' => 'Data tidak valid.',
            );
        } else {
            $id_jabatan = $this->uri->segment(3);
            $nama_jabatan = $this->input->post('nama_jabatan');
            $gaji = $this->input->post('gaji');
            $update = array(
                'nama_jabatan' => $nama_jabatan,
                'gaji' => $gaji,
            );

            $this->MSudi->UpdateData('jabatan_pegawai', 'id_jabatan', $id_jabatan, $update);
            $data = array(
                'status' => true,
                'pesan' => 'Data berhasil diperbarui.',
                'Data Diubah' => $update,
            );
        }

        $data = json_encode($data);
        echo $data;
    }

    // ============================================ Delete Data =======================//
    public function deleteDataPegawai()
    {
        $id = $this->uri->segment('3');
        $data_pegawai = $this->MSudi->GetDataWhere('pegawai', 'id_pegawai', $id);

        if (!$data_pegawai) {
            $data = array(
                'status' => false,
                'message' => 'Data tidak ditemukan',
            );
        } else {
            $delete = array(
                'id_pegawai' => $id,
            );
            $this->MSudi->DeleteData('pegawai', 'id_pegawai', $id);
            $data = array(
                'status' => true,
                'message' => 'Data berhasil dihapus',
                'Data Di Hapus' => $delete,
            );
        }
        $data = json_encode($data);
        echo $data;

    }
    public function deleteDataJabatan()
    {
        $id = $this->uri->segment('3');
        $data_jabatan = $this->MSudi->GetDataWhere('jabatan', 'id_jabatan', $id);

        if (!$data_jabatan) {
            $data = array(
                'status' => false,
                'message' => 'Data tidak ditemukan',
            );
        } else {
            $delete = array(
                'id_jabatan' => $id,
            );
            $this->MSudi->DeleteData('jabatan', 'id_jabatan', $id);
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
