<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Wilayah Kabupaten/Kotamadya</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Wilayah Kabupaten/Kotamadya</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Data Wilayah Kabupaten/Kotamadya</h3>
                <div class="float-right">
                      <a href="<?=site_url('wilayah')?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('wilayah/process')?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Wilayah Tingkat Kabupaten  Kotamadya *</label>
                            <input type="hidden" name="id" value="<?=$row->id_wilayah?>" />
                            <input type="text"  name="nama_wilayah" value="<?=$row->nama_wilayah?>" 
                            class="form-control" required>
                        </div>

                    <div class="form-group">
                          <label for="pejabat_wilayah">Nama Pejabat Wilayah Kabupaten*</label>
                          <select class="form-control select2" name="pejabat_wilayah" 
                          value="<?=$row->pejabat_wilayah?>" id="pejabat_wilayah">
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
 
