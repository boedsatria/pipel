<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Kelurahan/Desa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Kelurahan/Desa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <?php $p = ($page == "edit" ? $row->parent_kelurahan : $p); ?>
    
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Data Operator</h3>
                <div class="float-right">
                      <a href="<?=site_url('kecamatan/list/'.$p)?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('kelurahan/process/'.$p)?>" method="post">
                    <div class="card-body">
                    <div class="form-group">
                            <label>Nama Kelurahan *</label>
                            <select name="parent_kelurahan" class="form-control">
                              <option></option>
                              <?php
                              
                              foreach($kecamatan as $w): 
                                $selected = "";
                                if ($w->id_kecamatan == $p) $selected = "selected";
                              ?>
                                <option value="<?= $w->id_kecamatan ?>" <?= $selected ?>><?= $w->nama_kecamatan ?></option>
                              <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Nama Kelurahan / Desa Setempat *</label>
                            <input type="hidden" name="id" value="<?=$row->id_kelurahan?>" />
                            <input type="text"  name="nama_kelurahan" value="<?=$row->nama_kelurahan?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Pejabat Wilayah Setempat *</label>
                            <input type="hidden" name="id" value="<?=$row->id_kelurahan?>" />
                            <input type="text"  name="pejabat_kelurahan" value="<?=$row->pejabat_kelurahan?>" class="form-control" >
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
 
