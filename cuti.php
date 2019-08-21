<!DOCTYPE html>
<html>
<?php
include "configuration/config_etc.php";
include "configuration/config_include.php";
etc();encryption();session();connect();head();body();timing();
//alltotal();
pagination();
?>

<?php
if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}
?>
<div class="wrapper">
<?php
theader();
menu();
?>
            <div class="content-wrapper">
                <section class="content-header">
</section>
                <section class="content">
                    <div class="row">
					  <div class="col-lg-12">
<!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
$halaman = "cuti"; // halaman
$dataapa = "Cuti"; // data
$tabeldatabase = "cuti"; // tabel database
$chmod = $chmenu6; // Hak akses Menu
$forward = $tabeldatabase; // tabel database
$forwardpage = $halaman; // halaman
$search = $_POST['search'];

?>

<!-- SETTING STOP -->


<!-- BREADCRUMB -->

<ol class="breadcrumb ">
<li><a href="<?php echo $_SESSION['baseurl']; ?>">Dashboard </a></li>
<li><a href="<?php echo $halaman;?>"><?php echo $dataapa ?></a></li>
<?php

if ($search != null || $search != "") {
?>
 <li> <a href="<?php echo $halaman;?>">Data <?php echo $dataapa ?></a></li>
  <li class="active"><?php
    echo $search;
?></li>
  <?php
} else {
?>
 <li class="active">Data <?php echo $dataapa ?></li>
  <?php
}
?>
</ol>

<!-- BREADCRUMB -->

<!-- BOX HAPUS BERHASIL -->

         <script>
 window.setTimeout(function() {
    $("#myAlert").fadeTo(500, 0).slideUp(1000, function(){
        $(this).remove();
    });
}, 5000);
</script>

                            <?php
$hapusberhasil = $_POST['hapusberhasil'];
$add = $_POST['add'];

if ($hapusberhasil == 1) {
?>
    <div id="myAlert"  class="alert alert-success alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil!</strong> <?php echo $dataapa;?> telah berhasil dihapus dari Data <?php echo $dataapa;?>.
</div>

<!-- BOX HAPUS BERHASIL -->
<?php
} elseif ($hapusberhasil == 2) {
?>
           <div id="myAlert" class="alert alert-danger alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal!</strong> <?php echo $dataapa;?> tidak bisa dihapus dari Data <?php echo $dataapa;?> karena telah melakukan transaksi sebelumnya, gunakan menu update untuk merubah informasi <?php echo $dataapa;?> .
</div>
<?php
} elseif ($hapusberhasil == 3) {
?>
           <div id="myAlert" class="alert alert-danger alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Gagal!</strong> Hanya user tertentu yang dapat mengupdate Data <?php echo $dataapa;?> .
</div>
<?php
}
if ($add == 1) {
?>
    <div id="myAlert"  class="alert alert-success alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil!</strong> <?php echo $dataapa;?> telah berhasil ditambahkan ke Data <?php echo $dataapa;?>.
</div>
<?php } elseif ($add == 2) {
?>
           <div id="myAlert" class="alert alert-success alert-dismissible fade in" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Berhasil!</strong> <?php echo $dataapa;?> telah berhasil diupdate ke Data <?php echo $dataapa;?>.
</div>
<?php
}
?>
       <!-- BOX INFORMASI -->
    <?php
if ($chmod == '1' || $chmod == '2' || $chmod == '3' || $chmod == '4' || $chmod == '5' || $_SESSION['jabatan'] == 'admin') {
} else {
?>
   <div class="callout callout-danger">
    <h4>Info</h4>
    <b>Hanya user tertentu yang dapat mengakses halaman <?php echo $dataapa;?> ini .</b>
    </div>
    <?php
}
?>

<?php
if ($chmod >= 1 || $_SESSION['jabatan'] == 'admin') {
?>

<?php
if($_SESSION['mod']=='2'){
  $nik = $_SESSION['username'];
  $sqla="SELECT cuti.no as no, COUNT( * ) AS totaldata ,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode where pegawai.nik = '$nik'";

}else{
        $sqla="SELECT cuti.no as no, COUNT( * ) AS totaldata ,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode where pegawai.nik like '%$search%' or pegawai.nama like '%$search%'";
}
$hasila=mysqli_query($conn,$sqla);
		$rowa=mysqli_fetch_assoc($hasila);
		$totaldata=$rowa['totaldata'];

?>
                           <div class="box">
            <div class="box-header">
            <h3 class="box-title">Data <?php echo $forward ?>  <span class="label label-default"><?php echo $totaldata; ?></span>
              <?php if($_SESSION['mod']=='2'){}else{?>
              <span class="label label-warning" onclick="window.location.href='configuration/config_export?forward=<?php echo $forward; ?>&search=<?php echo $search; ?>'">Export Xls</span>
              <?php } ?>
					</h3>

			  <form method="post">
			  <br/>
                <div class="input-group input-group-sm" style="width: 250px;">
                  <input type="text" name="search" class="form-control pull-right" <?php if($_SESSION['mod']=='2'){?>placeholder="SK Cuti"<?php }else{?>placeholder="Cari"<?php } ?>>
                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>
                </div>

				  </form>


            </div>

                                <!-- /.box-header -->
                                  <!-- /.Paginasi -->
                                 <?php
    error_reporting(E_ALL ^ E_DEPRECATED);
    if($_SESSION['mod']=='2'){
      $nik = $_SESSION['username'];
      $sql    = "SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode where pegawai.nik ='$nik' order by cuti.no desc";
    }else{
    $sql    = "SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode order by cuti.no desc";
}
    $result = mysqli_query($conn, $sql);
    $rpp    = 15;
    $reload = "$halaman"."?pagination=true";
    $page   = intval(isset($_GET["page"]) ? $_GET["page"] : 0);

    if ($page <= 0)
        $page = 1;
    $tcount  = mysqli_num_rows($result);
    $tpages  = ($tcount) ? ceil($tcount / $rpp) : 1;
    $count   = 0;
    $i       = ($page - 1) * $rpp;
    $no_urut = ($page - 1) * $rpp;
?>
                            <div class="box-body table-responsive">
                                    <table class="table table-hover ">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <?php if($_SESSION['mod']=='2'){}else{?>
                                                <th>Nik</th>
                                                <th>Nama Pegawai</th>
                                                <th>Section</th>
                                                <th>Departemen</th>
                                                <th>Jabatan</th>
                                                <th>Foto</th>
                                                <?php } ?>
                                                <th>Sk Cuti</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>
												<?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
                          <?php if($_SESSION['mod']=='2'){ ?>
                                                <th>Status</th>
                            <?php
                          }else{ ?>
                                                <th>Opsi</th>
                                                <?php }?>
												<?php }else{} ?>
                                            </tr>
                                        </thead>
                                          <?php
    error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    $search = $_POST['search'];

    if ($search != null || $search != "") {

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

           		if(isset($_POST['search'])){

                if($_SESSION['mod']=='2'){
                  $nik = $_SESSION['username'];
				$query1="SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode where pegawai.nik = '$nik' and cuti.skcuti like '%$search%' order by cuti.no desc limit $rpp";
}else{
  $query1="SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode where pegawai.nik like '%$search%' or pegawai.nama like '%$search%' order by cuti.no desc limit $rpp";
}
        $hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
            <?php if($_SESSION['mod']=='2'){}else{?>
					  <td><?php  echo $fill['nik']; ?></td>
					  <td><?php  echo $fill['nama']; ?></td>
					  <td><?php  echo $fill['lokasi']; ?></td>
					  <td><?php  echo $fill['departemen']; ?></td>
					  <td><?php  echo $fill['jabatan']; ?></td>
					  <td><div class="user-block"><img class="img-circle" src="<?php  echo $fill['foto']; ?>" alt="Image"></div></td>
            <?php } ?>
					  <td><?php  echo $fill['skcuti'].'/'.$fill['tanggal']; ?></td>
					  <td><?php  echo $fill['tglmulai']; ?></td>
					  <td><?php  echo $fill['tglselesai']; ?></td>
					  <td><?php  echo $fill['keterangan']; ?></td>
          <?php if($_SESSION['mod']=='2'){
          if($fill['status']==''){ echo '<td><span class="label label-default">Pending</span></td>';?>
            <?php }else if($fill['status']=='setuju'){ echo ' <td><span class="label label-success">Disetujui</span></td>';?>
					  <?php }else if($fill['status']=='tolak'){ echo '<td><span class="label label-danger">Ditolak</span></td>' ?>
            <?php }
          }else{ ?>
					  <td>
					  <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
					<button type="button" class="btn btn-success btn-xs" onclick="window.location.href='add_<?php echo $halaman;?>?no=<?php  echo $fill['no']; ?>'">Edit</button>
					 <?php } else {}?>

					 <?php	if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
					<button type="button" class="btn btn-danger btn-xs">Hapus</button>
					 <?php } else {}?>
						  </td>
<?php } ?>
            </tr><?php
					;
				}

				?>
                  </tbody></table>
 <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
		 <?php
			}

		}

	} else {
		while(($count<$rpp) && ($i<$tcount)) {
			mysqli_data_seek($result,$i);
			$fill = mysqli_fetch_array($result);
      echo print_r($fill['lokasi']);
			?>
                      <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
            <?php if($_SESSION['mod']=='2'){}else{?>
					  <td><?php  echo $fill['nik']; ?></td>
					  <td><?php  echo $fill['nama']; ?></td>
					  <td><?php  echo $fill['lokasi']; ?></td>
					  <td><?php  echo $fill['departemen']; ?></td>
					  <td><?php  echo $fill['jabatan']; ?></td>
					  <td><div class="user-block"><img class="img-circle" src="<?php  echo $fill['foto']; ?>" alt="Image"></div></td>
            <?php } ?>
					  <td><?php  echo $fill['skcuti'].'/'.$fill['tanggal']; ?></td>
					  <td><?php  echo $fill['tglmulai']; ?></td>
					  <td><?php  echo $fill['tglselesai']; ?></td>
					  <td><?php  echo $fill['keterangan']; ?></td>
            <?php if($_SESSION['mod']=='2'){
            if($fill['status']==''){ echo '<td><span class="label label-default">Pending</span></td>';?>
              <?php }else if($fill['status']=='setuju'){ echo ' <td><span class="label label-success">Disetujui</span></td>';?>
              <?php }else if($fill['status']=='tolak'){ echo '<td><span class="label label-danger">Ditolak</span></td>' ?>
              <?php }
            }else{ ?>

					  <td>
					  <?php	if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') { ?>
					<button type="button" class="btn btn-success btn-xs" onclick="window.location.href='add_<?php echo $halaman;?>?no=<?php  echo $fill['no']; ?>'">Edit</button>
					 <?php } else {}?>

					 <?php	if ($chmod >= 4 || $_SESSION['jabatan'] == 'admin') { ?>
             <button type="button" class="btn btn-danger btn-xs" onclick="window.location.href='component/delete/delete_master?no=<?php echo $fill['NO'].'&'; ?>forward=<?php echo $forward.'&';?>forwardpage=<?php echo $forwardpage.'&'; ?>chmod=<?php echo $chmod; ?>'">Hapus</button>
   					 <?php } else {}?>
					 </td>
<?php } ?>
         </tr>
			<?php
			$i++;
			$count++;
		}

		?>
                  </tbody></table>
				  <div align="right"><?php if($tcount>=$rpp){ echo paginate_one($reload, $page, $tpages);}else{} ?></div>
	<?php } ?>

                               </div>
                                <!-- /.box-body -->
                            </div>

							<?php } else {} ?>
                        </div>
                        <!-- ./col -->
                    </div>
                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                    </div>
                    <!-- /.row (main row) -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
           <?php footer();?>
            <div class="control-sidebar-bg"></div>
        </div>
        <!-- ./wrapper -->
        <script src="dist/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
        <script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
        <script src="dist/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="dist/plugins/morris/morris.min.js"></script>
        <script src="dist/plugins/sparkline/jquery.sparkline.min.js"></script>
        <script src="dist/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="dist/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
        <script src="dist/plugins/knob/jquery.knob.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
        <script src="dist/plugins/daterangepicker/daterangepicker.js"></script>
        <script src="dist/plugins/datepicker/bootstrap-datepicker.js"></script>
        <script src="dist/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
        <script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <script src="dist/plugins/fastclick/fastclick.js"></script>
        <script src="dist/js/app.min.js"></script>
        <script src="dist/js/pages/dashboard.js"></script>
        <script src="dist/js/demo.js"></script>
		<script src="dist/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="dist/plugins/fastclick/fastclick.js"></script>

    </body>
</html>
