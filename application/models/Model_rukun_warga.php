<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_rukun_warga extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('rw');
        $this->db->join('kelurahan', 'kelurahan.id_kelurahan = rw.parent_rw', 'left');
        if($id != null) {
            $this->db->where('id_rw', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_rw' => $post['nama_rw'],
            'ketua_rw' => $post['ketua_rw'],
            'parent_rw' => $post['parent_rw']
        ];
        $this->db->insert('rw', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_rw' => $post['nama_rw'],
            'ketua_rw' => $post['ketua_rw'],
            'parent_rw' => $post['parent_rw']
        ];
        $this->db->where('id_rw', $post['id']);
        $this->db->update('rw', $params);
    }

    public function del($id)
    {
        $this->db->where('id_rw', $id);
        $this->db->delete('rw');
    }

    public function detail($id)
    {

        $this->db->from('rw');
        $this->db->join('kelurahan', 'kelurahan.id_kelurahan = rw.parent_rw', 'left');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.id_anggota =  rw.ketua_rw', 'left');
        if($id != null) {
            $this->db->where('parent_rw', $id);
        }
        $query = $this->db->get();
        return $query;

    }

}