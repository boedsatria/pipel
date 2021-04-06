<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_kelurahan extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('kelurahan');
        if($id != null) {
            $this->db->where('id_kelurahan', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_kelurahan' => $post['nama_kelurahan'],
            'pejabat_kelurahan' => $post['pejabat_kelurahan'],
            'parent_kelurahan' => $post['parent_kelurahan']
        ];
        $this->db->insert('kelurahan', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_kelurahan' => $post['nama_kelurahan'],
            'pejabat_kelurahan' => $post['pejabat_kelurahan'],
            'parent_kelurahan' => $post['parent_kelurahan']
        ];
        $this->db->where('id_kelurahan', $post['id']);
        $this->db->update('kelurahan', $params);
    }

    public function del($id)
    {
        $this->db->where('id_kelurahan', $id);
        $this->db->delete('kelurahan');
    }

    public function detail($id)
    {

        $this->db->from('kelurahan');
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = kelurahan.parent_kelurahan', 'left');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.id_anggota = kelurahan.pejabat_kelurahan', 'left');
        if($id != null) {
            $this->db->where('parent_kelurahan', $id);
        }
        $query = $this->db->get();
        return $query;

    }

}