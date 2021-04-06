<?php defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_wilayah');
        $this->load->model('model_kecamatan');
    }

    public function index()
    {
        $data['row'] = $this->model_wilayah->get();
        $this->template->load('backend/template', 'backend/admin/wilayah_data', $data);
    }

    public function list($id = FALSE)
    {
        $data['row'] = $this->model_kecamatan->detail($id);
        $data['detail'] = $this->model_wilayah->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/wilayah_detail', $data);
    }

    public function add() {
        $wilayah = new stdClass();
        $wilayah->id_wilayah = null;
        $wilayah->nama_wilayah = null;
        $wilayah->pejabat_wilayah = null;
        $data = array(
            'page' => 'add',
            'row' => $wilayah
        );
        $this->template->load('backend/template', 'backend/admin/wilayah_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_wilayah->get($id);
        if($query->num_rows() > 0) {
            $wilayah = $query->row();
            $data = array(
                'page' => 'edit',
                'row' => $wilayah
            );
            $this->template->load('backend/template', 'backend/admin/wilayah_add', $data);
        } else {
            redirect(site_url('wilayah'));
        }
    }

    public function process()
    {
        $post = $this->input->post(null, TRUE);
        if(isset($_POST['add'])) {
            $this->model_wilayah->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_wilayah->edit($post);
        }

        if($this->db->affected_rows() > 0) {
                
            }
                redirect(site_url('wilayah'));
    }

    public function del($id)
    {
        $this->model_wilayah->del($id);
        if($this->db->affected_rows() > 0) {
                
            }
            redirect(site_url('wilayah'));
    }
}

