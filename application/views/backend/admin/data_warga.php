<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Data Warga</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"> Data Warga</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Warga</h3>
                
                  <div class="float-right">
                      <a href="<?=site_url('warga/anggota_add')?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"> </i> Add
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped" id="tabel_warga">
                  <thead>
                  <tr>
                    <th style="width: 10px">No.</th>
                      <th>Nama</th>
                      <th>No KTP</th>
                      <th>No KK</th>
                      <th>Alamat</th>
                      <th style="width: 150px; text-align: center;">Action</th>
                    </tr>
                  </thead>
                    <tbody>
                   
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 
