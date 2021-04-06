<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_wilayah extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('wilayah');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.id_anggota =  wilayah.pejabat_wilayah', 'left');
        if($id != null) {
            $this->db->where('id_wilayah', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_wilayah' => $post['nama_wilayah'],
            'pejabat_wilayah' => $post['pejabat_wilayah']
        ];
        $this->db->insert('wilayah', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_wilayah' => $post['nama_wilayah'],
            'pejabat_wilayah' => $post['pejabat_wilayah']
        ];
        $this->db->where('id_wilayah', $post['id']);
        $this->db->update('wilayah', $params);
    }

    public function del($id)
    {
        $this->db->where('id_wilayah', $id);
        $this->db->delete('wilayah');
    }


}