<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelurahan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_kelurahan');
        $this->load->model('model_rukun_warga');
        $this->load->model('model_kecamatan');
    }

    public function index()
    {
        $data['row'] = $this->model_kelurahan->get();
        $this->template->load('backend/template', 'backend/admin/kelurahan_detail', $data);
    }

    public function list($id = FALSE)
    {
        $data['row'] = $this->model_rukun_warga->detail($id);
        $data['detail'] = $this->model_kelurahan->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/kelurahan_detail', $data);
    }

    public function add($id) {
        $kelurahan = new stdClass();
        $kelurahan->id_kelurahan = null;
        $kelurahan->nama_kelurahan = null;
        $kelurahan->pejabat_kelurahan = null;
        $kelurahan->parent_kelurahan = null;

        $data = array(
            'page' => 'add',
            'row' => $kelurahan,
            'p'   => $id
        );
        $this->template->load('backend/template', 'backend/admin/kelurahan_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_kelurahan->get($id);
        if($query->num_rows() > 0) {
            $kelurahan = $query->row();
            
            $data = array(
                'page' => 'edit',
                'row' => $kelurahan,
                'p'   => $id
            );
            $this->template->load('backend/template', 'backend/admin/kelurahan_add', $data);
        } else {
            redirect('kecamatan/list/'.$id);
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        $back = $post['parent_kelurahan'];
       // print_r($post);die;
        if(isset($_POST['add'])) {
            $this->model_kelurahan->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_kelurahan->edit($post);
        }
                redirect('kecamatan/list/'.$back);
    }

    public function del($id, $p)
    {
        $this->model_kelurahan->del($id);
            redirect('kecamatan/list/'.$p);
    }
}

