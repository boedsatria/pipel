<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Model_operator extends CI_Model
{

    public function login($post)
    {
        // print_r(password_hash($post['password'], PASSWORD_DEFAULT));die;
        $this->db->from('operator');
        $this->db->where('username', $post['username']);
        $query = $this->db->get()->row();

        if(!isset($query)) {
            return 'User tidak ditemukan';
        }else if(password_verify($post['password'], $query->password)){
            return $query;
        }else{
            return 'Password Salah';
        }
    }

    public function get($id = null) 
    {
        $this->db->from('operator');
        if($id != null) {
            $this->db->where('id_operator', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function add($post)
    {
        $params['username'] = $post['username'];
        $params['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        $params['email'] = $post['email'];
        $params['nama_lengkap'] = $post['nama_lengkap'];
        $params['level_operator'] = $post['level_operator'];
        $this->db->insert('operator', $params);
        
    }

    public function edit($post) 
    {
        $params['username'] = $post['username'];
        if($post['password'] != ""){
            $params['password'] = password_hash($post['password'], PASSWORD_DEFAULT);
        } 
        $params['email'] = $post['email'];
        $params['nama_lengkap'] = $post['nama_lengkap'];
        $params['level_operator'] = $post['level_operator'];
        $this->db->where('id_operator', $post['id']);
        $this->db->update('operator', $params);   
    }

}