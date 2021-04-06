<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Rukun Warga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Rukun Warga</li>
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
                <h3 class="card-title">Form Tambah Data Rukun Warga</h3>
                <div class="float-right">
                      <a href="<?=site_url('kelurahan/list/'.$p)?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('rukun_warga/process/'.$p)?>" method="post">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Nama Rukun Warga *</label>
                            <input type="hidden" name="id" value="<?=$row->id_rw?>" />
                            <input type="text"  name="nama_rw" 
                            value="<?=$row->nama_rw?>" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nama Ketua Rukun Warga *</label>
                            <input type="hidden" name="id" value="<?=$row->id_rw?>" />
                            <input type="text"  name="ketua_rw" 
                            value="<?=$row->ketua_rw?>" class="form-control" >
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
 
