<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_kecamatan extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('kecamatan');
        $this->db->join('wilayah', 'wilayah.id_wilayah = kecamatan.parent_kecamatan', 'left');
        if($id != null) {
            $this->db->where('id_kecamatan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        
        $params = [
            'parent_kecamatan' => $post['parent_kecamatan'],
            'nama_kecamatan' => $post['nama_kecamatan'],
            'pejabat_kecamatan' => $post['pejabat_kecamatan']
        ];
        $this->db->insert('kecamatan', $params);
    }

    public function edit($post)
    {
        $params = [
            'parent_kecamatan' => $post['parent_kecamatan'],
            'nama_kecamatan' => $post['nama_kecamatan'],
            'pejabat_kecamatan' => $post['pejabat_kecamatan']
        ];
        $this->db->where('id_kecamatan', $post['id']);
        $this->db->update('kecamatan', $params);
    }

    public function del($id)
    {
        $this->db->where('id_kecamatan', $id);
        $this->db->delete('kecamatan');
    }

    public function detail($id)
    {

        $this->db->from('kecamatan');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.id_anggota =  kecamatan.pejabat_kecamatan', 'left');
        $this->db->join('wilayah', 'wilayah.id_wilayah = kecamatan.parent_kecamatan', 'left');
        if($id != null) {
            $this->db->where('parent_kecamatan', $id);
        }
        $query = $this->db->get();
        return $query;

    }

}