<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Data Wilayah Provinsi Jawa Barat *</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"> Data  Wilayah Provinsi Jawa Barat</li>
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
                <h3 class="card-title">Tabel Nama Kabupaten & Kotamadya</h3>
                
                  <div class="float-right">
                      <a href="<?=site_url('wilayah/add')?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"> </i> Add
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped datatables">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Nama Kabupaten & Kota</th>
                      <th>Nama Pejabat Wilayah</th>
                      <th style="width: 150px; text-align: center;">Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        foreach($row->result() as $key => $data) { 
                    ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><a href="<?=site_url('wilayah/list/').$data->id_wilayah?>">
                                        <?=$data->nama_wilayah?></a></td>
                            <td><?=$data->nama_anggota?></td>
                            <td>
                            <a href="<?=site_url('wilayah/edit/'.$data->id_wilayah)?>" 
                            class="btn btn-success btn-xs">
                              <i class="fa fa-pencil-alt"> </i> Update
                                </a>
                              <a href="<?=site_url('wilayah/del/'.$data->id_wilayah)?>" 
                              onclick="return confirm('Data akan Dihapus?')" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-alt"> </i> Delete
                                  </a>
                            
                            </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 
