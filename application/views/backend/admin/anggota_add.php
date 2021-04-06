<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Anggota Keluarga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active">Tambah Data Anggota Keluarga</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- KONDISI PARAMETER EDIT ATAU ADD -->
    <?php $p = ($page == "edit" ? $row->parent_anggota : $p); ?>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Form Tambah Data Anggota Keluarga</h3>
                <div class="float-right">
                      <a href="<?=site_url('warga/list/'.$p)?>" class="btn btn-danger btn-sm">
                        <i class="fa fa-undo"> </i> Back
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php // echo validation_errors(); ?>
              <form action="<?=site_url('warga/process_anggota/'.$p)?>" method="post" enctype="multipart/form-data">
                <div class="card-body">
                        
                  <div class="form-group">
                      <label>Nama </label>
                      <input type="text"  name="nama_anggota" value="<?=$row->nama_anggota?>" class="form-control" required>
                  </div>
                  <div class="form-group">
                      <label>Email </label>
                      <input type="hidden" name="id" value="<?=$row->id_anggota?>" />
                      <input type="text"  name="email_anggota" value="<?=$row->email_anggota?>" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label>No. Telephone</label>
                      <input type="text"  name="telp_anggota" value="<?=$row->telp_anggota?>" class="form-control" required>
                  </div>

                  <div class="form-group">
                      <label>No KTP</label>
                      <input type="text"  name="ktp_anggota" value="<?=$row->ktp_anggota?>" class="form-control" required>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-3">
                      <label>Tempat Lahir</label>
                      <input type="text" name="tempat_lahir" value="<?=$row->tempat_lahir?>" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                      <label>Tanggal Lahir:</label>
                      <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" name="tgl_lahir" value="<?=$row->tgl_lahir?>" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.form group -->
                        
                  <div class="form-group">
                    <label for="foto_anggota">Foto </label>
                    <?php if($page == 'edit') {
                      if($row->foto_anggota != null) {?>
                      <div style="margin-bottom : 5px;">
                          <img src="<?= base_url('uploads/anggota/' . $row->foto_anggota) ?>" style="width:30%;">
                      </div>

                      <?php
                          }
                      } ?>
                    <input type="file" name="foto_anggota" id="foto_anggota" class="form-control">
                    <small>(Lewati Jika Tidak ada gambar di <?=$page == 'edit' ? 'Ganti' : 'Upload'?>)</small>
                  </div>

                  <!-- radio -->
                  <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <div class="col-md-12">
                      <div class="icheck-primary d-inline mr-5">
                        <input value="1" type="radio" id="radioPrimary1" name="jenis_kelamin" <?= ($row->jenis_kelamin == 1 ? "checked" : "") ?>>
                        <label for="radioPrimary1">
                          Laki-laki
                        </label>
                      </div>
                      <div class="icheck-primary d-inline">
                        <input value="2" type="radio" id="radioPrimary2" name="jenis_kelamin" <?= ($row->jenis_kelamin == 2 ? "checked" : "") ?>>
                        <label for="radioPrimary2">
                          Perempuan
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
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
 
