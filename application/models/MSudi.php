<?php

class MSudi extends CI_Model
{
    function AddData($tabel, $data = array())
    {
        $this->db->insert($tabel, $data);
    }

    function UpdateData($tabel, $fieldid, $fieldvalue, $data = array())
    {
        $this->db->where($fieldid, $fieldvalue)->update($tabel, $data);
    }

    function DeleteData($tabel, $fieldid, $fieldvalue)
    {
        $this->db->where($fieldid, $fieldvalue)->delete($tabel);
    }
    function GetData($tabel)
    {
        $query = $this->db->get($tabel);
        return $query->result();
    }
    function GetDataWhere($tabel, $id, $nilai)
    {
        $this->db->where($id, $nilai);
        $query = $this->db->get($tabel);
        return $query;
    }
    function GetDataWhere2($tabel, $id, $nilai, $id2, $nilai2)
    {
        // if ($nilai != null) {
        $this->db->where($id, $nilai);
        // }
        // if ($nilai2 != null) {
        $this->db->where($id2, $nilai2);
        // }

        $query = $this->db->get($tabel);
        return $query;
    }
    
    function GetDataKontrak()
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->join('kontrak','kontrak.id_pegawai = pegawai.id_pegawai');
        $this->db->join('jabatan_pegawai','jabatan_pegawai.id_jabatan = kontrak.id_jabatan');
        $query = $this->db->get();
        $this->db->where('kontrak.id_pegawai','ASC');
        return $query;
    }
}
