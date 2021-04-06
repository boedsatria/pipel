<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Warga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Warga</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- KONDISI PARAMETER EDIT ATAU ADD -->
    <?php $p = ($page == "edit" ? $row->rt_domisili : $p); ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Data Warga</h3>
                <div class="float-right">
                      <a href="<?=site_url('rukun_tetangga/list/'.$p)?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('warga/process/'.$p)?>" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama RT *</label>
                            <select name="rt_domisili" class="form-control">
                              <option></option>
                              <?php
                              
                              foreach($rt as $r): 
                                $selected = "";
                                if ($r->id_rt == $p) $selected = "selected";
                              ?>
                                <option value="<?= $r->id_rt ?>" <?= $selected ?>><?= $r->nama_rt ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>


                        <div class="form-group">
                            <label>No. Kartu Keluarga</label>
                            <input type="text"  name="nokk_warga" value="<?=$row->nokk_warga?>" class="form-control" required>
                        </div>


                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat_warga" class="form-control" required><?= $row->alamat_warga?> </textarea>
                        </div>

                        <div class="form-group">
                        <label for="fotokk_warga">Foto Full Kartu Keluarga </label>
                        <?php if($page == 'edit') {
                          if($row->fotokk_warga != null) {?>

                              <div style="margin-bottom : 5px;">
                                  <img src="<?= base_url('uploads/foto_kk/' . $row->fotokk_warga) ?>" style="width:30%;">
                              </div>

                        <?php
                            }
                        } ?>
                        <input type="file" name="fotokk_warga" id="fotokk_warga" class="form-control">
                        <small>(Lewati Jika Tidak ada gambar di <?=$page == 'edit' ? 'Ganti' : 'Upload'?>)</small>
                    </div>
            
                        <div class="form-group">
                            <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">
                                <i class="fa fa-paper-plane"></i> Save
                            </button>
                            <button type="reset" class="btn btn-warning btn-flat">
                            <i class="fab fa-researchgate"></i> Reset
                            </button>
                        </div>
                        </div>
                    </form>
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 
