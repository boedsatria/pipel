<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kecamatan extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_kecamatan');
        $this->load->model('model_wilayah');
        $this->load->model('model_kelurahan');
    }

    public function index()
    {
        $data['row'] = $this->model_kecamatan->get();
        $this->template->load('backend/template', 'backend/admin/kecamatan_detail', $data);
    }

    public function list($id = FALSE)
    {
        $data['row'] = $this->model_kelurahan->detail($id);
        $data['detail'] = $this->model_kecamatan->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/kecamatan_detail', $data);
    }

    public function add($id) {
        $kecamatan = new stdClass();
        $kecamatan->id_kecamatan = null;
        $kecamatan->nama_kecamatan = null;
        $kecamatan->pejabat_kecamatan = null;
        $kecamatan->parent_kecamatan = $id;

        $data = array(
            'page'      => 'add',
            'row'       => $kecamatan,
            'wilayah'   => $this->model_wilayah->get()->result(),
            'p'         => $id
        );
        $this->template->load('backend/template', 'backend/admin/kecamatan_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_kecamatan->get($id);
        if($query->num_rows() > 0) {
            $wilayah = $query->row();
            
            $data = array(
                'page'      => 'edit',
                'row'       => $wilayah,
                'wilayah'   => $this->model_wilayah->get()->result(),
                'p'         => $id
            );
            $this->template->load('backend/template', 'backend/admin/kecamatan_add', $data);
        } else {
            redirect('wilayah/list/'.$id);
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        $back = $post['parent_kecamatan'];
        // print_r($post);die;
        if(isset($_POST['add'])) {
            $this->model_kecamatan->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_kecamatan->edit($post);
        }
        redirect('wilayah/list/'.$back);
    }

    public function del($id, $p)
    {
        $this->model_kecamatan->del($id);
            redirect('wilayah/list/'.$p);
    }
}

