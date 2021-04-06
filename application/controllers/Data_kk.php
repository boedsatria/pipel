<?php defined('BASEPATH') or exit('No direct script access allowed');

class Data_kk extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        check_not_login();
        $this->load->model(['Data_kk', 'category_m', 'unit_m']);
    }

    function get_ajax() {
        $list = $this->Model_data_kk->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $data_kk) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $data_kk->email_warga;
            $row[] = $data_kk->telp_warga;
            $row[] = $data_kk->alamat_warga;
            $row[] = $data_kk->rt_warga;
            $row[] = $data_kk->nokk_warga;
            $row[] = $data_kk->fotokk_warga != null ? 
            '<img src="'.base_url('uploads/warga_kk/'.$data_kk->fotokk_warga).'" 
            class="img" style="width:100px">' : null;
            $row[] = $data_kk->status_warga;
            // add html for action
            $row[] = '<a href="'.site_url('data_kk/edit/'.$data_kk->id_warga)
            .'" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Update</a>
                    <a href="'.site_url('data_kk/del/'.$data_kk->id_warga)
            .'" onclick="return confirm(\'Yakin hapus data?\')"  
            class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>';
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->Model_data_kk->count_all(),
                    "recordsFiltered" => $this->Model_data_kk->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $data['row'] = $this->Model_data_kk->get();
        $this->template->load('backend/template', 'backend/admin/data_kk', $data);
    }

    public function add()
    {
        $data_kk = new stdClass();
        $data_kk->id_warga = null;
        $data_kk->email_warga = null;
        $data_kk->telp_warga = null;
        $data_kk->alamat_warga = null;
        $data_kk->image = null;

        $query_category = $this->category_m->get();
        $category[null] = '-Pilih-';
        foreach ($query_category->result() as $unt) {
            $category[$unt->category_id] = $unt->name;
        }

        $query_unit = $this->unit_m->get();
        $unit[null] = '-Pilih-';
        foreach ($query_unit->result() as $unt) {
            $unit[$unt->unit_id] = $unt->name;
        }

        $data = array(
            'page'      => 'add',
            'row'       => $item,
            'category'  => $category, 'selectedcategory' => null,
            'unit'      => $unit, 'selectedunit' => null,
        );
        $this->template->load('template', 'product/item/item_form', $data);
    }

    public function edit($id)
    {
        $query = $this->item_m->get($id);
        if ($query->num_rows() > 0) {
            $item = $query->row();


            $query_category = $this->category_m->get();
            $category[null] = '-Pilih-';
            foreach ($query_category->result() as $unt) {
                $category[$unt->category_id] = $unt->name;
            }

            $query_unit = $this->unit_m->get();
            $unit[null] = '-Pilih-';
            foreach ($query_unit->result() as $unt) {
                $unit[$unt->unit_id] = $unt->name;
            }

            $data = array(
                'page'      => 'edit',
                'row'       => $item,
                'category'  => $category, 'selectedcategory' => $item->category_id,
                'unit'      => $unit, 'selectedunit' => $item->unit_id,
            );
            $this->template->load('template', 'product/item/item_form', $data);
        } else {
            echo "<script>alert('Tidak Ada Data');";
            echo "window.location='" . site_url('item') . "';</script>";
        }
    }

    public function process()
    {
        $config['upload_path']   = './uploads/product/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      =  2048;
        $config['file_name']     =  'item-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
        $this->load->library('upload', $config);

        $post = $this->input->post(null, TRUE);
        if (isset($_POST['add'])) {
            if ($this->item_m->check_barcode($post['barcode'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Code $post[barcode] Sudah Digunakan Code Barang Lain..!!");
                redirect('item/add');
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {
                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->add($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data Telah Disimpan');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', "$error");
                        redirect('item/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->add($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data Telah Disimpan');
                    }
                    redirect('item');
                }
            }
        } else if (isset($_POST['edit'])) {
            if ($this->item_m->check_barcode($post['barcode'], $post['id'])->num_rows() > 0) {
                $this->session->set_flashdata('error', "Code $post[barcode] Sudah Digunakan Code Barang Lain..!!");
                redirect('item/edit/' . $post['id']);
            } else {
                if (@$_FILES['image']['name'] != null) {
                    if ($this->upload->do_upload('image')) {

                        $item = $this->item_m->get($post['id'])->row();
                        if($item->image != null) {
                            $target_file = './uploads/product/'.$item->image;
                            unlink($target_file);
                        }

                        $post['image'] = $this->upload->data('file_name');
                        $this->item_m->edit($post);
                        if ($this->db->affected_rows() > 0) {
                            $this->session->set_flashdata('success', 'Data Telah Disimpan');
                        }
                        redirect('item');
                    } else {
                        $error = $this->upload->display_errors();
                        $this->session->set_flashdata('error', "$error");
                        redirect('item/add');
                    }
                } else {
                    $post['image'] = null;
                    $this->item_m->edit($post);
                    if ($this->db->affected_rows() > 0) {
                        $this->session->set_flashdata('success', 'Data Telah Disimpan');
                    }
                    redirect('item');
                }
            }
        }
    }

    public function del($id)
    {
        $item = $this->item_m->get($id)->row();
        if($item->image != null) {
        $target_file = './uploads/product/'.$item->image;
        unlink($target_file);
        }

        $this->item_m->del($id);
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('success', 'Data Telah Dihapus');
        }
        redirect('item');
    }

   function barcode_qrcode($id) {
        $data['row'] = $this->item_m->get($id)->row();
        $this->template->load('template', 'product/item/barcode_qrcode', $data);
   }

   function barcode_print($id) {
       $this->Fungsi->PdfGenerator('coba', 'coba', 'A4', 'landscape');
   }

}



















