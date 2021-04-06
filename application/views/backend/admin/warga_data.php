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
                      <a href="<?=site_url('warga/add')?>" class="btn btn-primary btn-flat">
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
                      <th>Email</th>
                      <th>No.Telp</th>
                      <th>Alamat</th>
                      <th>RT</th>
                      <th>NO. KK</th>
                      <th>image KK</th>
                      <th>Status</th>
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
                            <td><?=$data->email_warga?></td>
                            <td><?=$data->telp_warga?></td>
                            <td><?=$data->alamat_warga?></td>
                            <td><?=$data->nama_rt?></td>
                            <td><?=$data->nokk_warga?></td>
                            <td><?php if ($data->fotokk_warga != null) { ?>
                   <img src="<?= base_url('uploads/foto_kk/' . $data->fotokk_warga) ?>" style="width:150px;">
                                <?php } ?></td>
                            <td><?=$data->status_warga?></td>
                            <td>
                            <a href="<?=site_url('warga/edit/'.$data->id_warga)?>" 
                            class="btn btn-success btn-xs">
                              <i class="fa fa-pencil-alt"> </i> Update
                                </a>
                              <a href="<?=site_url('warga/del/'.$data->id_warga)?>" 
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
 
