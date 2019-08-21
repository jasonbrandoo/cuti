<!DOCTYPE html>
<html>
<?php
include "configuration/config_include.php";
etc();encryption();session();connect();head();body();timing();
//alltotal();
//pagination();
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
                <!-- Content Header (Page header) -->
                <section class="content-header">
</section>
                <!-- Main content -->
                <section class="content">
                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <!-- ./col -->

<!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$halaman = "index"; // halaman
$dataapa = "Dashboard"; // data
$tabeldatabase = "index"; // tabel database
$forward = mysql_real_escape_string($tabeldatabase); // tabel database
$forwardpage = mysql_real_escape_string($halaman); // halaman
$search = $_POST['search'];
?>

<!-- SETTING STOP -->
       <!-- BOX INFORMASI -->
    <?php
if ($_SESSION['jabatan'] == 'admin') {
	?>

<!-- BREADCRUMB -->
<div class="col-lg-12">
<ol class="breadcrumb ">
<li><a href="#">Setting</a></li>
</ol>
</div>

<!-- BREADCRUMB -->


                   <?php
 $sql="select * from backset";
                  $hasil2 = mysqli_query($conn,$sql);


                  while ($fill = mysqli_fetch_assoc($hasil2)){

	$url = $fill['url'];
	$session = $fill['sessiontime'];
	$footer = $fill['footer'];
	$checkbox = $fill['responsive'];
				  }

?>

                                <!-- /.box-body -->

                        <!-- ./col -->

								</div>


								<div class="row">
								<?php if($_SESSION['jabatan'] !='admin'){}else{ ?>
								<div class="col-lg-6">
							 <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">General Setting</h3>
            </div>

                                <div class="box-body">

								            <form class="form-horizontal" method="post">
              <div class="box-body">

                <div class="form-group">
                  <label for="url" class="col-sm-2 control-label">Url Aplikasi</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="url" name="url" placeholder="Masukan URL dengan http://" value="<?php echo $url; ?>" maxlength="100">
                  </div>
                </div>

                <div class="form-group">
                  <label for="session" class="col-sm-2 control-label">Session</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="session" name="session" placeholder="Masukkan Waktu Session dalam Menit" value="<?php echo $session; ?>" maxlength="4">
                  </div>
                </div>

                <div class="form-group">
                  <label for="footer" class="col-sm-2 control-label">Footer</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="footer" name="footer" placeholder="Masukkan Footer" value="<?php echo $footer; ?>" maxlength="50">
                  </div>
                </div>

				<div class="form-group">
				 <label for="checkbox" class="col-sm-2 control-label">Responsive</label>
                  <div class="col-sm-10">
                    <div class="checkbox">
                      <label>
					  <?php if($checkbox == '0'){?>
					  <input type="checkbox" id="checkbox" name="checkbox" value="0" checked> Buat Theme jadi Responsive
					  <?php }else{ ?>
                        <input type="checkbox" id="checkbox" name="checkbox" value="0"> Buat Theme jadi Responsive
					  <?php } ?>
                      </label>
                    </div>
                  </div>
				  </div>

              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default pull-right btn-flat" name="simpan"><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
              </div>
              <!-- /.box-footer -->
            </form>
			<?php
			 if($_SERVER["REQUEST_METHOD"] == "POST"){
	$url = $session = $footer = $checkbox = "";
	$url = $_POST['url'];
	$session = $_POST['session'];
	$footer = $_POST['footer'];
	$checkbox = $_POST['checkbox'];

	if(!isset($_POST["checkbox"])){
		$checkbox = '1';
	}

	      if(isset($_POST['simpan'])){
				   $sql="select * from backset";
                  $result=mysqli_query($conn,$sql);

              if(mysqli_num_rows($result)>0){

				   $sql1 = "update backset set url='$url', sessiontime='$session', footer='$footer', responsive='$checkbox'";
				     $result = mysqli_query($conn, $sql1);?>
				<meta http-equiv="refresh" content="0;URL=''" /><?php
			  }else{
                $sql1 = "insert into backset (url,sessiontime,footer,responsive) values('$url','$session','$footer','$checkbox')";
			        $result = mysqli_query($conn, $sql1);?>
				<meta http-equiv="refresh" content="0;URL=''" /><?php
			  }
				  }
			 }
				  ?>

								</div>

                                <!-- /.box-body -->
								<div class="overlay" id="loading">
  <i class="fa fa-refresh fa-spin"></i>
</div>
                            </div>
							</div>

							<?php } ?>

                                <!-- /.box-body -->
                            </div>
<!-- TIMER -->
<div id="counter" style="display: none;">3</div>
<script type="text/javascript">
function countdown() {
    var i = document.getElementById('counter');
    if (parseInt(i.innerHTML)<=0) {
        $('#loading').hide();
			clearInterval(counter);
	 resetEverything();
	 recognition.stop();
    }
    i.innerHTML = parseInt(i.innerHTML)-1;

}
setInterval(function(){ countdown(); },1000);
</script>
<!-- /.TIMER -->

<?php
} else {
?>
   <div class="callout callout-danger">
    <h4>Info</h4>
    <b>Hanya user tertentu yang dapat mengakses halaman <?php echo $dataapa;?> ini .</b>
    </div>
    <?php
}
?>
						<!-- BATAS -->
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