<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login()
	{
        check_already_login();
		$this->load->view('backend/admin/login');
	}

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($post['login'])) {
            $this->load->model('Model_operator');
            $query = $this->Model_operator->login($post);
            if($query == "User tidak ditemukan" || $query == "Password Salah"){
                $this->session->set_flashdata('error_login', $query);
                redirect('auth/login');
            } else{
                $params = array(
                    'id_operator'       => $query->id_operator,
                    'level_operator'    => $query->level_operator
                );
                $this->session->set_userdata($params);
                redirect('dashboard');
                
            }
        }
    }

    public function logout()
    {
        $params = array('id_operator', 'level_operator');
        $this->session->unset_userdata($params);
        redirect('Auth/login');
    }

}

