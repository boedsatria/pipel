<?php defined('BASEPATH') or exit('No direct script access allowed');

class Model_warga extends CI_Model {

    // start datatables
    var $column_order = 
    array(null, 'nama_anggota', 'ktp_anggota', 'nokk_warga', 'nama_rt', 
    'nama_rw', 'nama_kelurahan', 'nama_kecamatan', 'nama_wilayah', null); 

    var $column_search = 
    array('nama_anggota', 'ktp_anggota', 'nokk_warga', 'nama_rt', 
    'nama_rw', 'nama_kelurahan', 'nama_kecamatan', 'nama_wilayah'); 
    //set column field database for datatable orderable

    var $order = array('id_warga' => 'asc'); // default order

    private function _get_datatables_query() {
        $this->db->select('*');
        $this->db->from('anggota_keluarga');
        $this->db->join('warga', 'warga.id_warga = anggota_keluarga.parent_anggota');
        $this->db->join('rt', 'rt.id_rt = warga.rt_domisili');
        $this->db->join('rw', 'rw.id_rw = rt.parent_rt');
        $this->db->join('kelurahan', 'kelurahan.id_kelurahan = rw.parent_rw');
        $this->db->join('kecamatan', 'kecamatan.id_kecamatan = kelurahan.parent_kelurahan');
        $this->db->join('wilayah', 'wilayah.id_wilayah = kecamatan.parent_kecamatan');

        $i = 0;
        foreach ($this->column_search as $warga) { // loop column
            if(@$_POST['search']['value']) { // if datatable send POST for search
                if($i===0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($warga, $_POST['search']['value']);
                } else {
                    $this->db->or_like($warga, $_POST['search']['value']);
                }
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if(isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        }  else if(isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables() {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all() {
        $this->db->from('anggota_keluarga');
        return $this->db->count_all_results();
    }
    // end datatables

    public function get($id = null)
    {
        $this->db->from('warga');
        if($id != null) {
            $this->db->where('id_warga', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get_anggota($id = null)
    {
        $this->db->from('anggota_keluarga');
        $this->db->join('status', 'status.id_status = anggota_keluarga.status_keluarga', 'left');
        $this->db->join('jenis_kelamin', 'jenis_kelamin.id_jenis_kelamin = anggota_keluarga.jenis_kelamin', 'left');
        $this->db->join('warga', 'warga.id_warga = anggota_keluarga.parent_anggota', 'left');
        $this->db->join('rt', 'rt.id_rt = warga.rt_domisili', 'left');
        if($id != null) {
            $this->db->where('id_anggota', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params = [
            'alamat_warga' => $post['alamat_warga'],
            'rt_domisili' => $post['rt_domisili'],
            'nokk_warga' => $post['nokk_warga'],
            'fotokk_warga' => $post['fotokk_warga'],
            // 'status_warga' => $post['status_warga']
        ];
        // print_r($params);die;
        $this->db->insert('warga', $params);
        $id = $this->db->insert_id();;
        return $id;
    }

    public function add_anggota($post)
    {
        $params = [
            'nama_anggota' => $post['nama_anggota'],
            'email_anggota' => $post['email_anggota'],
            'telp_anggota' => $post['telp_anggota'],
            'ktp_anggota' => $post['ktp_anggota'],
            'tempat_lahir' => $post['tempat_lahir'],
            'tgl_lahir' => $post['tgl_lahir'],
            'foto_anggota' => $post['foto_anggota'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            // 'status_perkawinan' => $post['status_perkawinan'],
            // 'status_keluarga' => $post['status_keluarga'],
            'parent_anggota' => $post['parent_anggota']
        ];
        $this->db->insert('anggota_keluarga', $params);
    }

    public function edit($post)
    {
        $params = [
            'alamat_warga' => $post['alamat_warga'],
            'rt_domisili' => $post['rt_domisili'],
            'nokk_warga' => $post['nokk_warga'],
            'fotokk_warga' => $post['fotokk_warga'],
            'status_warga' => $post['status_warga']
        ];
        if($post['fotokk_warga'] != null) {
            $params['fotokk_warga'] = $post['fotokk_warga'];
        }
        $this->db->where('id_warga', $post['id']);
        $this->db->update('warga', $params);
    }

    public function edit_anggota($post)
    {
        $params = [
            'nama_anggota' => $post['nama_anggota'],
            'email_anggota' => $post['email_anggota'],
            'telp_anggota' => $post['telp_anggota'],
            'ktp_anggota' => $post['ktp_anggota'],
            'tempat_lahir' => $post['tempat_lahir'],
            'tgl_lahir' => $post['tgl_lahir'],
            'jenis_kelamin' => $post['jenis_kelamin'],
            // 'status_perkawinan' => $post['status_perkawinan'],
            // 'status_keluarga' => $post['status_keluarga'],
            'parent_anggota' => $post['parent_anggota']
        ];
        
        if(isset($post['foto_anggota'])) {
            $params['foto_anggota'] = $post['foto_anggota'];
        }
        $this->db->where('id_anggota', $post['id']);
        $this->db->update('anggota_keluarga', $params);
    }


    public function del($id)
    {
        $this->db->where('id_warga', $id);
        $this->db->delete('warga');
    }

    public function detail($id)
    {

        $this->db->from('warga');
        $this->db->join('rt', 'rt.id_rt = warga.rt_domisili ', 'left');
        $this->db->join('anggota_keluarga', 'anggota_keluarga.parent_anggota = warga.id_warga ', 'left');
        // $this->db->where('status_keluarga', 1);
        if($id != null) {
            $this->db->where('rt_domisili', $id);
        }
        $this->db->group_by('nokk_warga');
        $query = $this->db->get();
        // print_r($query->result());die;
        return $query;

    }

    public function anggota($id)
    {

        $this->db->from('anggota_keluarga');
        $this->db->join('status', 'status.id_status = anggota_keluarga.status_keluarga ', 'left');
        if($id != null) {
            $this->db->where('parent_anggota', $id);
        }
        $query = $this->db->get();
        return $query;

    }
    public function check_nokk($no)
    {

        $this->db->from('warga');
        $this->db->where('nokk_warga', $no);
        $query = $this->db->get();
        return $query;

    }


}













