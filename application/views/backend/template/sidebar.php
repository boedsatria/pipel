<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <span class="brand-text font-weight-light">SATRIACORP.ID</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$this->fungsi->user_login()->username ?></a>
         
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          
          <li class="nav-item">
            <a href="<?=site_url('dashboard')?>" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
              </p>
            </a>
              </li>

              <li class="nav-item menu-open">
            <a href="<?=site_url('wilayah')?>" class="nav-link ">
            <i class="nav-icon fas fa-map"></i>
              <p>
                DATA PER WILAYAH
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-mail-bulk"></i>
              <p>
                PENGAJUAN SURAT
                <i class="nav-icon fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/UI/general.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Surat Pengantar</p>
                </a>
              </li>
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
              <p>
                LAPORAN WARGA
                <i class="nav-icon fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="<?=site_url('warga')?>" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Lihat Warga</p>
                </a>
              </li>
            
              <li class="nav-item">
                <a href="<?=site_url('Laporan_kelurahan')?>" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Area per Kelurahan/Desa</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?=site_url('Laporan_rw')?>" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Area per RW</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Area per RT</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-vote-yea"></i>
              <p>
                PEMILIHAN LOKAL
                <i class="nav-icon fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/forms/general.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Tingkat Kelurahan/Desa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/advanced.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Tingkat RW</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/forms/editors.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Tingkat RT</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon far fa-newspaper"></i>
              <p>
                INFORMASI
                <i class="nav-icon fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/tables/simple.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Informasi Warga</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Informasi RT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Informasi RW</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/data.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Informasi Kelurahan/Desa</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/tables/jsgrid.html" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Informasi Kecamatan</p>
                </a>
              </li>
            </ul>
          </li>


        <!-- Hak akses level Operator disini -->
        <?php if($this->session->userdata('level_operator') == 1) { ?>
        

          <li class="nav-item menu-open">
            <a href="#" class="nav-link ">
              <p>
                SETTING
              </p>
            </a>
          </li>
          
          <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-user-lock"></i>
              <p>
                OPERATOR
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?=site_url('operator')?>" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>List Operator</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?=site_url('operator/add')?>" class="nav-link">
                  <i class="nav-icon far fa-circle nav-icon"></i>
                  <p>Tambah Operator</p>
                </a>
              </li>
            </ul>
          </li>

        <?php } ?>
        <!-- Penutup Hak akses level -->


        <li class="nav-item ">
            <a href="<?=site_url('Auth/logout')?>" class="nav-link ">
            <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                LOGOUT
              </p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    
  </aside>

<!-- /.sidebar -->