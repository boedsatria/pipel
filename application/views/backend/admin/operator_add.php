<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Operator</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Operator</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
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
                      <a href="<?=site_url('operator')?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('operator/process')?>" method="POST">
                <div class="card-body">

                  <div class="form-group">
                    <label for="username">Username</label>
                    <input type="hidden" name="id" value="<?=$row->id_operator?>" />
                    <input type="text" class="form-control" name="username" 
                    value="<?=$row->username?>" id="username" placeholder=" Username" required>
                  </div>

                  <div class="form-group" >
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value=""
                     id="password" placeholder="Password" 
                      <?= ($row->username == null ? "required" : "") ?>>
                  </div>

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" 
                    value="<?=$row->email?>" id="email" placeholder=" email" required>
                  </div>

                  <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_lengkap" 
                    value="<?=$row->nama_lengkap?>" id="nama_lengkap" placeholder=" Nama Lengkap" required>
                  </div>

                  <div class="form-group">
                    <label for="level_operator">Level Operator</label>
                    <select class="form-control select2" name="level_operator" id="level_operator" required>
                    <option value="">--Pilih Disini--</option>
                    <option value="1" <?=$row->level_operator == 1 ? "selected" : null ?> >Admin</option>
                    <option value="2" <?=$row->level_operator == 2 ? "selected" : null ?> >Editor</option>
                  </select>
                  </div>
                  
                <!-- /.card-body -->

                <div class="card-footer float-right">
                  <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">Simpan</button>
                    <button type="reset" class="btn btn-success btn-warning">Reset</button>
                      </div>
              </form>
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 
