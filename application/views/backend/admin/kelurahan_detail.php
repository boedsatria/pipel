<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Data Kelurahan <?=$detail['nama_kelurahan'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"> Data Kelurahan</li>
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
            <div class="card-body">
            <div class="post">
                      <div>
                        <img class="float-left mr-3 img-circle img-bordered-sm" src="<?=base_url()?>assets/dist/img/default-150x150.png" alt="user image">
                        <h3 class="username">
                          <a href="#">Kelurahan <?=$detail['nama_kelurahan'] ?></a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </h3>
                        <span class="btn bg-primary">Tanggal peresmian	10 Maret 1997*</span>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        Lorem ipsum represents a long-held tradition for designers,
                        typographers and the like. Some people hate it and argue for
                        its demise, but others ignore the hate as they create awesome
                        tools to help create filler text for everyone from bacon lovers
                        to Charlie Sheen fans.*
                      </p>
                    </div>
            </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tabel Rukun Warga</h3>
                  <div class="float-right">
                      <a href="<?=site_url('rukun_warga/add/'.$detail['id_kelurahan'])?>" class="btn btn-primary btn-flat">
                      <i class="fas fa-plus"></i> Add
                      </a>
                      <a href="<?=site_url('kecamatan/list/'.$detail['parent_kelurahan'])?>" class="btn btn-danger btn-flat">
                      <i class="fas fa-undo-alt"></i> Kecamatan
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped datatables">
                  <thead>
                    <tr>
                      <th style="width: 10px">No.</th>
                      <th>Nama RW</th>
                      <th>Ketua RW</th>
                      <th>Kelurahan</th>
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
                            <td><a href="<?=site_url('rukun_warga/list/').$data->id_rw?>">  <?=$data->nama_rw?></a></td>
                            <td><?=$data->nama_anggota?></td>
                            <td><?=$data->nama_kelurahan?></td>
                            <td>
                            <a href="<?=site_url('rukun_warga/edit/'.$data->id_rw)?>" class="btn btn-success btn-xs">
                              <i class="fa fa-pencil-alt"> </i> Update
                                </a>
                              <a href="<?=site_url('rukun_warga/del/'.$data->id_rw)?>" onclick="return confirm('Data akan Dihapus?')" class="btn btn-danger btn-xs">
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
 
