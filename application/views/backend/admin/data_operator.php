<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Data Operator</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('Dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"> Data Operator</li>
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
                <h3 class="card-title">Tabel Operator</h3>
                  <div class="float-right">
                      <a href="<?=site_url('operator/add')?>" class="btn btn-primary btn-flat">
                        <i class="fa fa-user-plus"> </i> Add
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Nama Lengkap</th>
                      <th>Level</th>
                      <th style="width: 150px">Action</th>
                    </tr>
                  </thead>
                    <tbody>
                    <?php 
                        $no = 1;
                        foreach($row->result() as $key => $data) { 
                    ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$data->username?></td>
                            <td><?=$data->email?></td>
                            <td><?=$data->nama_lengkap?></td>
                            <td><?=$data->level_operator == 1 ? "Admin" : "Editor"?></td>
                            <td>
                            <a href="<?=site_url('operator/edit/'.$data->id_operator)?>" class="btn btn-success btn-xs">
                              <i class="fa fa-pencil-alt"> </i> Update
                                </a>
                              <a href="<?=site_url('operator/del/'.$data->id_operator)?>" class="btn btn-danger btn-xs">
                                <i class="fa fa-trash-alt"> </i> Delete
                                  </a>
                            
                            </td>
                        </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <ul class="pagination pagination-sm m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">&laquo;</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">&raquo;</a></li>
                </ul>
              </div>
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
 
