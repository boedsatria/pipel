<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Fungsi {

    protected $ci;

    public function __construct() 
    {
        $this->ci =& get_instance();
    }

    public function user_login() 
    {
        $this->ci->load->model('model_operator');
        $id_operator = $this->ci->session->userdata('id_operator');
        $user_data = $this->ci->model_operator->get($id_operator)->row();
        return $user_data;
    }

}