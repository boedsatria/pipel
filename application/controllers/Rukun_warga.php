<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rukun_warga extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['model_rukun_warga', 'model_rukun_tetangga', 'model_kelurahan']);  
         
    }

    public function index()
    {
        $data['row'] = $this->model_rukun_warga->get();
        $this->template->load('backend/template', 'backend/admin/rw_detail', $data);
    }

    public function list($id = FALSE)
    {
        $data['row'] = $this->model_rukun_tetangga->detail($id);
        $data['detail'] = $this->model_rukun_warga->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/rw_detail', $data);
    }

    public function add($id) {
        $rukun_warga = new stdClass();
        $rukun_warga->id_rw = null;
        $rukun_warga->nama_rw = null;
        $rukun_warga->ketua_rw = null;
        $rukun_warga->parent_rw = null;

        $data = array(
            'page' => 'add',
            'kelurahan'   => $this->model_kelurahan->get()->result(),
            'row' => $rukun_warga,
            'p'   => $id
        );
        $this->template->load('backend/template', 'backend/admin/rw_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_rukun_warga->get($id);
        if($query->num_rows() > 0) {
            $rukun_warga = $query->row();

            $data = array(
            'page' => 'edit',
            'kelurahan'   => $this->model_kelurahan->get()->result(),
            'row'  => $rukun_warga,
            'p'    => $id
            );
            $this->template->load('backend/template', 'backend/admin/rw_add', $data);
        } else {
            redirect('kelurahan/list/'.$id);
        }
    }

    public function process($id)
    {
        $post = $this->input->post(null, TRUE);
        $back = $post['parent_rw'];
        if(isset($_POST['add'])) {
            $this->model_rukun_warga->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_rukun_warga->edit($post);
        }
                redirect('kelurahan/list/'.$id);
    }

    public function del($id, $p)
    {
        $this->model_rukun_warga->del($id);
            redirect('kelurahan/list/'.$p);
    }
}

