<?php defined('BASEPATH') or exit('No direct script access allowed');

class Rukun_tetangga extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model('model_rukun_tetangga');
        $this->load->model('model_rukun_warga');
        $this->load->model('model_warga');
    }

    public function index()
    {
        $data['row'] = $this->model_rukun_tetangga->get();
        $this->template->load('backend/template', 'backend/admin/rt_data', $data);
    }
    

    public function list($id = FALSE)
    {
        $data['row'] = $this->model_warga->detail($id);
        $data['detail'] = $this->model_rukun_tetangga->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/rt_detail', $data);
    }

    public function add($id) {
        $rukun_tetangga = new stdClass();
        $rukun_tetangga->id_rt = null;
        $rukun_tetangga->nama_rt = null;
        $rukun_tetangga->ketua_rt = null;
        $rukun_tetangga->parent_rt = null;

        $data = array(
            'page' => 'add',
            'rukun_warga'   => $this->model_rukun_warga->get()->result(),
            'row' => $rukun_tetangga,
            'p'   => $id
        );
        $this->template->load('backend/template', 'backend/admin/rt_add', $data);
    }

    public function edit($id)
    {
        $query = $this->model_rukun_tetangga->get($id);
        if($query->num_rows() > 0) {
            $rukun_tetangga = $query->row();
            
            $data = array(
                'page' => 'edit',
                'rukun_warga'   => $this->model_rukun_warga->get()->result(),
                'row' => $rukun_tetangga
            );
            $this->template->load('backend/template', 'backend/admin/rt_add', $data);
        } else {
            redirect('rukun_warga/list/'.$id);
        }
    }

    public function process($id)
    {
        $post = $this->input->post(null, TRUE);
        $back = $post['parent_rt'];
        if(isset($_POST['add'])) {
            $this->model_rukun_tetangga->add($post);
        } else if(isset($_POST['edit'])) {
            $this->model_rukun_tetangga->edit($post);
        }
               redirect('rukun_warga/list/'.$id);
    }

    public function del($id, $p)
    {
        $this->model_rukun_tetangga->del($id);
            redirect('rukun_warga/list/'.$p);
    }
}

