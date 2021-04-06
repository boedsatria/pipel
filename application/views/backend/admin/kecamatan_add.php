<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Kecamatan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Kecamatan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php $p = ($page == "edit" ? $row->parent_kecamatan : $p); ?>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Data Kecamatan</h3>
                <div class="float-right">
                      <a href="<?=site_url('wilayah/list/'.$p)?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('kecamatan/process')?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Wilayah *</label>
                            <select name="parent_kecamatan" class="form-control">
                              <option></option>
                              <?php
                              
                              foreach($wilayah as $w): 
                                $selected = "";
                                if ($w->id_wilayah == $p) $selected = "selected";
                              ?>
                                <option value="<?= $w->id_wilayah ?>" <?= $selected ?>><?= $w->nama_wilayah ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Nama Kecamatan *</label>
                            <input type="hidden" name="id" value="<?=$row->id_kecamatan?>" />
                            <input type="text"  name="nama_kecamatan" 
                            value="<?=$row->nama_kecamatan?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                          <label for="pejabat_kecamatan">Nama Pejabat Kecamatan *</label>
                          <select class="form-control select2" name="pejabat_kecamatan" 
                          value="<?=$row->pejabat_kecamatan?>" id="pejabat_kecamatan">
                          <option value="">--Pilih Disini--</option>
                    
                         </select>
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
 
