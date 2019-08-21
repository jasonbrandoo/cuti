<?php
include "configuration/config_connect.php";
include "configuration/config_chmod.php";
?>
<aside class="main-sidebar">

  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo $_SESSION['avatar']; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['nama']; ?></p>
        <a href="#"><i class="fa fa-circle text-online"></i> Online</a>
      </div>
    </div>

    <ul class="sidebar-menu">
      <!-- <li class="header">MENU UTAMA</li> -->
      <li class="treeview">
        <a href="index"> <i class="fa fa-dashboard"></i> <span>Dashboard</span> </a>

      </li>



      <?php

      if ($chmenu1 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-user"></i> <span>Admin</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="admin"><i class="fa fa-circle-o"></i>Data Admin</a>
          </li>
          <li>
            <a href="add_admin"><i class="fa fa-circle-o"></i>Tambah Admin</a>
          </li>
        </ul>
      </li>

      <?php } else { }
      if ($chmenu2 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-folder-close"></i> <span>Departemen</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="departemen"><i class="fa fa-circle-o"></i>Data Departemen</a>
          </li>
          <li>
            <a href="add_departemen"><i class="fa fa-circle-o"></i>Tambah Departemen</a>
          </li>
        </ul>
      </li>

      <?php } else { }
      if ($chmenu3 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <!-- <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-map-marker"></i> <span>Lokasi</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="lokasi"><i class="fa fa-circle-o"></i>Data Lokasi</a>
          </li>
          <li>
            <a href="add_lokasi"><i class="fa fa-circle-o"></i>Tambah Lokasi</a>
          </li>
        </ul>
      </li> -->

      <?php } else { }
      if ($chmenu4 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-flag"></i> <span>Jabatan</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="jabatan"><i class="fa fa-circle-o"></i>Data Jabatan</a>
          </li>
          <li>
            <a href="add_jabatan"><i class="fa fa-circle-o"></i>Tambah Jabatan</a>
          </li>
        </ul>
      </li>

      <?php } else { }
      if ($chmenu5 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-list"></i> <span>Pegawai</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="pegawai"><i class="fa fa-circle-o"></i>Data Pegawai</a>
          </li>
          <li>
            <a href="add_pegawai"><i class="fa fa-circle-o"></i>Tambah Pegawai</a>
          </li>
        </ul>
      </li>

      <?php } else { }
      if ($chmenu6 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="add_cuti"> <i class="glyphicon glyphicon-edit"></i> <span>Pengajuan Cuti</span> <span class="pull-right-container"> </span> </a>

      </li>



      <?php } else { }
      if ($chmenu7 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="approvement"> <i class="glyphicon glyphicon-check"></i> <span>Approvement</span> <span class="pull-right-container"> </span> </a>
      </li>


      <?php } else { }
      if ($chmenu8 >= 1 || $_SESSION['jabatan'] == 'admin') { ?>

      <li class="treeview">
        <a href="approvement"> <i class="glyphicon glyphicon-list-alt"></i> <span>Laporan</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="cuti"><i class="fa fa-circle-o"></i>Histori Cuti</a>
          </li>
        </ul>
      </li>

      <?php } else { }
      if ($chmenu9 >= 1 || $_SESSION['jabatan'] == 'pegawai') { ?>
      <li class="treeview">
        <a href="#"> <i class="glyphicon glyphicon-list-alt"></i> <span>Profile</span> <span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i> </span> </a>
        <ul class="treeview-menu">
          <li>
            <a href="add_pegawai?no=<?php echo $_SESSION['nouser'] ?>"><i class="fa fa-circle-o"></i>Edit Profile</a>
          </li>
        </ul>
      </li>


      <?php } else { } ?>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
