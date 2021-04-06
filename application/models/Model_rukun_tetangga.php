<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_rukun_tetangga extends CI_Model {

    public function get($id = null)
    {
        $this->db->from('rt');
        if($id != null) {
            $this->db->where('id_rt', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'nama_rt' => $post['nama_rt'],
            'ketua_rt' => $post['ketua_rt'],
            'parent_rt' => $post['parent_rt']
        ];
        $this->db->insert('rt', $params);
    }

    public function edit($post)
    {
        $params = [
            'nama_rt' => $post['nama_rt'],
            'ketua_rt' => $post['ketua_rt'],
            'parent_rt' => $post['parent_rt']
        ];
        $this->db->where('id_rt', $post['id']);
        $this->db->update('rt', $params);
    }

    public function del($id)
    {
        $this->db->where('id_rt', $id);
        $this->db->delete('rt');
    }

    public function detail($id)
    {

        $this->db->from('rt');
        $this->db->join('rw', 'rw.id_rw = rt.parent_rt', 'left');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.id_anggota =  rt.ketua_rt', 'left');
        if($id != null) {
            $this->db->where('parent_rt', $id);
        }
        $query = $this->db->get();
        return $query;

    }


    //AMBIL DATA RT DI RW YANG SAMA DENGAN RT TERPILIH
    public function get_rt_sibling($id, $page)
    {
        if($page == 'add'):
            $rw = $this->get($id)->row_array();
            $rw = $rw['parent_rt'];
        else:
            $this->load->model('Model_warga');
            $warga = $this->Model_warga->get($id)->row_array();
            $rw = $this->get($warga['rt_domisili'])->row_array();
            $rw = $rw['parent_rt'];
        endif;
        
        $this->db->from('rt');
        $this->db->where('parent_rt', $rw);
        $query = $this->db->get();
        return $query;

    }

}