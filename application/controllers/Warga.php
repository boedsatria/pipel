<?php defined('BASEPATH') or exit('No direct script access allowed');

class Warga extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Model_warga', 'Model_rukun_tetangga']);
    }

    function get_ajax() {
        $list = $this->Model_warga->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $warga) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = '<a href="'.site_url('warga/list_anggota/'.$warga->id_anggota).'">'.$warga->nama_anggota.'</a>';
            $row[] = $warga->ktp_anggota;
            $row[] = $warga->nokk_warga;
            $row[] = $warga->alamat_warga.' '.$warga->nama_rt. ' / '.$warga->nama_rw.'</br>
                        Kelurahan / Desa '.$warga->nama_kelurahan. ', Kecamatan '.$warga->nama_kecamatan.'</br>'
                        .$warga->nama_wilayah;

            // add html for action
            $row[] = '<a href="'.site_url('warga/edit_anggota/'.$warga->id_anggota).'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('warga/edit_anggota/'.$warga->id_anggota).'" onclick="return confirm(\'Yakin hapus data?\')"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Model_warga->count_all(),
                    "recordsFiltered" => $this->Model_warga->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $data['row'] = $this->Model_warga->get();
        $this->template->load('backend/template', 'backend/admin/data_warga', $data);
    }

    public function list($id = FALSE)
    {
        // print_r($this->Model_warga->anggota($id));die;
        $data['row'] = $this->Model_warga->anggota($id);
        $data['detail'] = $this->Model_warga->get($id)->row_array();
        $this->template->load('backend/template', 'backend/admin/warga_detail', $data);
    }

    public function list_anggota($id = FALSE)
    {
        // $data['row'] = $this->Model_warga->get_anggota($id);
       
        $data['detail'] = $this->Model_warga->get_anggota($id)->row_array();
        // print_r($data['detail']);die;
        $this->template->load('backend/template', 'backend/admin/anggota_detail', $data);
    }

    public function add($id)
    {
        $warga = new stdClass();
        $warga->id_warga = null;
        $warga->alamat_warga = null;

        //TAMBAHAN PARSING DARI ID
        $warga->rt_domisili = $id;

        $warga->nokk_warga = null;
        $warga->fotokk_warga = ($warga->id_warga != null ? $warga->fotokk_warga : null);
        $warga->status_warga = null;
        $data = array(
            'page'      => 'add',
            'row'       => $warga,
            'p'         => $id
        );
        $this->template->load('backend/template', 'backend/admin/warga_add', $data);
    }

    public function anggota_add($id)
    {
        $anggota = new stdClass();
        $anggota->id_anggota = null;
        $anggota->nama_anggota = null;
        $anggota->email_anggota = null;
        $anggota->telp_anggota = null;
        $anggota->ktp_anggota = null;
        $anggota->tempat_lahir = null;
        $anggota->tgl_lahir = null;
        $anggota->foto_anggota = ($anggota->id_anggota != null ? $anggota->foto_anggota : null);
        $anggota->jenis_kelamin = null;
        $anggota->status_perkawinan = null;
        $anggota->parent_anggota = $id;
        $data = array(
            'page'      => 'add',
            'row'       => $anggota,
            'p'         => $id
        );
        $this->template->load('backend/template', 'backend/admin/anggota_add', $data);
    }

    public function edit($id)
    {
        $query = $this->Model_warga->get($id);
        if ($query->num_rows() > 0) {
            $warga = $query->row();

            $data = array(
                'page'      => 'edit',
                'row'       => $warga,
                'p'         => $id
            );
            $this->template->load('backend/template', 'backend/admin/warga_add', $data);
        } else {
            $this->session->set_flashdata('swal', '
                Swal.fire({
                    title: "Error",
                    text: "Tidak ada data",
                    icon: "error"
                });
            ');
            redirect (site_url('rukun_tetangga/list/'.$id));
        }
    }

    public function edit_anggota($id)
    {
        $query = $this->Model_warga->get_anggota($id);
        if ($query->num_rows() > 0) {
            $anggota = $query->row();

            $data = array(
                'page'      => 'edit',
                'row'       => $anggota,
                'p'         => $id
            );
            $this->template->load('backend/template', 'backend/admin/anggota_add', $data);
        } else {
            $this->session->set_flashdata('messages', "Tidak Ada Data");
            redirect (site_url('warga'));
        }
    }

    public function process()
    {
        // print_r($_FILES);die;
        $config['upload_path']   = './uploads/foto_kk/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      =  2048;
        $config['file_name']     =  'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);

        //BACK BUTTON
        $back = $post['rt_domisili'];

        if (isset($_POST['add'])) {
            if ($this->Model_warga->check_nokk($post['nokk_warga'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Code $post[nokk_warga] Sudah Ada");
                redirect('warga/add/'.$back);
            } else {
                if ($_FILES['fotokk_warga']['name'] != null) {
                    if ($this->upload->do_upload('fotokk_warga')) {
                        $post['fotokk_warga'] = $this->upload->data('file_name');
                        $id = $this->Model_warga->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('swal', '
                                Swal.fire({
                                    title: "Success",
                                    text: "Data Telah Disimpan",
                                    icon: "success"
                                });
                            ');
                        }
                        redirect('rukun_tetangga/list/'.$back);
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('swal', '
                            Swal.fire({
                                title: "Error",
                                text: "'.preg_replace('~</?p[^>]*>~', '', $error).'",
                                icon: "error"
                            });
                        ');
                        redirect('warga/add/'.$back);
                    }
                } else {
                    $post['fotokk_warga'] = null;
                    $id = $this->Model_warga->add($post);
                    // print_r($id );die;
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('swal', '
                            Swal.fire({
                                title: "Success",
                                text: "Data Telah Disimpan!",
                                icon: "success"
                            });
                        ');
                    }
                    redirect('rukun_tetangga/list/'.$back);
                    // die;
                }
            }
        } 
        if (isset($_POST['edit'])) {
        
            if ($_FILES['fotokk_warga']['name'] != null) {
                if ($this->upload->do_upload('fotokk_warga')) {

                    $item = $this->Model_warga->get($post['id'])->row();
                    if($warga->fotokk_warga != null) {
                        $target_file = './uploads/warga/'.$warga->fotokk_warga;
                        unlink($target_file);
                    }

                    $post['fotokk_warga'] = $this->upload->data('file_name');
                    $this->Model_warga->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('swal', '
                            Swal.fire({
                                title: "Success",
                                text: "Data Telah Disimpan",
                                icon: "success"
                            });
                        ');
                    }
                    redirect('rukun_tetangga/list/'.$back);
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Error",
                            text: "'.preg_replace('~</?p[^>]*>~', '', $error).'",
                            icon: "error"
                        });
                    ');
                    redirect('warga/add/'.$post['id']);
                }
            } else {
                $post['fotokk_warga'] = null;
                $this->Model_warga->edit($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Success",
                            text: "Data Telah Disimpan",
                            icon: "success"
                        });
                    ');
                }
                redirect('rukun_tetangga/list/'.$back);
            }
        }
    }

    public function process_anggota($p)
    {
        $config['upload_path']   = './uploads/anggota/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      =  2048;
        $config['file_name']     =  'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        $post['parent_anggota'] = $p;

        //BACK BUTTON
        $back = $p;
// print_r($_FILES);
// print_r($post);
// die;
        if (isset($_POST['add'])) {
            $post['parent_anggota'] = $p;
            if ($_FILES['foto_anggota']['name'] != null) {
                if ($this->upload->do_upload('foto_anggota')) {
                    $post['foto_anggota'] = $this->upload->data('file_name');
                    $id = $this->Model_warga->add_anggota($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('swal', '
                            Swal.fire({
                                title: "Success",
                                text: "Data Telah Disimpan",
                                icon: "success"
                            });
                        ');
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Error",
                            text: "'.preg_replace('~</?p[^>]*>~', '', $error).'",
                            icon: "error"
                        });
                    ');
                } 
            } else {
                $post['foto_anggota'] = null;
                $id = $this->Model_warga->add_anggota($post);
                // print_r($id );die;
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Success",
                            text: "Data Telah Disimpan!",
                            icon: "success"
                        });
                    ');
                }
                // die;
            }
            redirect('warga/list_anggota/'.$id);
        } 
        if (isset($_POST['edit'])) {
        
            if ($_FILES['foto_anggota']['name'] != null) {
                if ($this->upload->do_upload('foto_anggota')) {

                    $item = $this->Model_warga->get($post['id'])->row();
                    if($item->foto_anggota != null) {
                        $target_file = './uploads/anggota/'.$item->foto_anggota;
                        unlink($target_file);
                    }

                    $post['foto_anggota'] = $this->upload->data('file_name');
                    $this->Model_warga->edit_anggota($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('swal', '
                            Swal.fire({
                                title: "Success",
                                text: "Data Telah Disimpan",
                                icon: "success"
                            });
                        ');
                    }
                } else {
                    $error = $this->upload->display_errors();
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Error",
                            text: "'.preg_replace('~</?p[^>]*>~', '', $error).'",
                            icon: "error"
                        });
                    ');
                }
            } else {
                // $post['foto_anggota'] = null;
                $this->Model_warga->edit_anggota($post);
                if ($this->db->affected_rows() > 0) {
                    $this->session->set_flashdata('swal', '
                        Swal.fire({
                            title: "Success",
                            text: "Data Telah Disimpan",
                            icon: "success"
                        });
                    ');
                }
            }
            
            redirect('warga/list_anggota/'.$post['id']);
        }
    }

    public function del($id)
    {
        $item = $this->Model_warga->get($id)->row();
        $back = $item->rt_domisili;

        // print_r($item->fotokk_warga);die;
        if($item->fotokk_warga != null) {
        $target_file = './uploads/foto_kk/'.$item->fotokk_warga;
        unlink($target_file);
        }

        $this->Model_warga->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('swal', '
                Swal.fire({
                    title: "Success",
                    text: "Data Berhasil di Hapus",
                    icon: "error"
                });
            ');
        }
        redirect('rukun_tetangga/list/'.$back);
    }

    

}



















