<?php defined('BASEPATH') or exit('No direct script access allowed');

class Operator extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_operator');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['row'] = $this->model_operator->get();
        $this->template->load('backend/template', 'backend/admin/data_operator', $data);
    }
	
	public function add() {
        $operator = new stdClass();
        $operator->id_operator = null;
        $operator->username = null;
        $operator->password = null;
        $operator->email = null;
        $operator->nama_lengkap = null;
        $operator->level_operator = null;
        $data = array(
            'page' => 'add',
            'row' => $operator,
            
        );
        $this->template->load('backend/template', 'backend/admin/operator_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_operator->get($id);
        if($query->num_rows() > 0) {
            $operator = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $operator,
              
            );
            $this->template->load('backend/template', 'backend/admin/operator_add', $data);
        } else {
            redirect('operator');
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        // print_r($post);die;
        if(isset($_POST['add'])) {
            $this->model_operator->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_operator->edit($post);
        }

        if($this->db->affected_rows() > 0) {
                
            }
                redirect('operator');
    }

    public function del($id)
    {
        $this->model_operator->del($id);
        if($this->db->affected_rows() > 0) {
                
            }
                echo "<script>window.location='".site_url('operator')."';</script>";
    }

}

/* End of file Dashboard.php */
