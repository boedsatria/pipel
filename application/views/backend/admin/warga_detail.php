<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1> Data No. KK <?=$detail['nokk_warga'] ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=site_url('dashboard')?>">Home</a></li>
              <li class="breadcrumb-item active"> Data No. KK <?=$detail['nokk_warga'] ?></li>
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
                          No. KK <a href="#"><?=$detail['nokk_warga'] ?></a>                          
                        </h3>
                      </div>
                      <!-- /.user-block -->
                      <p>
                        <?=$detail['alamat_warga']?>
                      </p>
                    </div>
            </div>
            </div>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Anggota Keluarga</h3>
                  <div class="float-right">
                      <a href="<?=site_url('warga/anggota_add/'.$detail['id_warga'])?>" class="btn btn-primary btn-flat">
                      <i class="fas fa-plus"></i> Add
                      </a>
                      <a href="<?=site_url('rukun_tetangga/list/'.$detail['rt_domisili'])?>" class="btn btn-danger btn-flat">
                      <i class="fas fa-undo-alt"></i> RT
                      </a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-bordered table-striped datatables">
                  <thead>
                    <tr>
                    <th style="width: 10px">No.</th>
                      <th>Nama</th>
                      <th>No KTP</th>
                      <th>TTL</th>
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
                            <td><a href="<?=site_url('warga/list_anggota/').$data->id_anggota; ?>">
                                  <?=$data->nama_anggota?> </a></td>
                            <td><?=$data->ktp_anggota?></td>
                            <td><?=$data->tempat_lahir?>, <?=tgl_indo_lengkap($data->tgl_lahir)?></td>
                            <td><?=$data->nama_status?></td>
                            <td>
                            <a href="<?=site_url('warga/edit_anggota/'.$data->id_anggota)?>" 
                            class="btn btn-success btn-xs">
                              <i class="fa fa-pencil-alt"> </i> Update
                                </a>
                              <a href="<?=site_url('warga/del_anggota/'.$data->id_anggota)?>" 
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

  
 
