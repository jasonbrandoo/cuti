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
                <!-- Main content -->
                <section class="content">
                    <div class="row">
					  <div class="col-lg-12">
                        <!-- ./col -->

<!-- SETTING START-->

<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
$halaman = "admin"; // halaman
$dataapa = "Admin"; // data
$tabeldatabase = "user"; // tabel database
$chmod = $chmenu1; // Hak akses Menu
$forward = $tabeldatabase; // tabel database
$forwardpage = $halaman; // halaman
$search = $_POST['search'];
$insert = $_POST['insert'];
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

<!-- BOX INSERT BERHASIL -->

         <script>
 window.setTimeout(function() {
    $("#myAlert").fadeTo(500, 0).slideUp(1000, function(){
        $(this).remove();
    });
}, 5000);
</script>
<?php
	if($insert == "1"){
		?>
	<div id="myAlert" class="alert alert-success alert-dismissible fade in" role="alert">
	 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong> Berhasil!</strong> <?php echo $dataapa;?> telah berhasil <b>ditambahkan</b> ke Data <?php echo $dataapa;?>.
</div>

<?php
	}
	if($insert == "3"){
		?>
	<div id="myAlert" class="alert alert-success alert-dismissible fade in" role="alert">
	 <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong> Berhasil!</strong> <?php echo $dataapa;?> telah <b>terupdate</b>.
</div>

<!-- BOX UPDATE GAGAL -->
<?php
	}
	?>

       <!-- BOX INFORMASI -->
    <?php
if ($chmod >= 2 || $_SESSION['jabatan'] == 'admin') {
	?>


	<!-- KONTEN BODY AWAL -->
                            <div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Data <?php echo $dataapa;?></h3>
            </div>
                                <!-- /.box-header -->

                                <div class="box-body">
								<div class="table-responsive">
    <!----------------KONTEN------------------->
      <?php
	  error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

	  $username=$password=$nama=$avatar=$jabatan=$insert=$no="";
	  $no = $_GET["no"];
	  $insert = '1';



		if(($no != null || $no != "") && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin')){

			   $sql="select * from $tabeldatabase where no='$no'";
                  $hasil2 = mysqli_query($conn,$sql);


                  while ($fill = mysqli_fetch_assoc($hasil2)){


                  $username = $fill["userna_me"];
                  $password = $fill["pa_ssword"];
                  $nama= $fill["nama"];
                  $avatar = $fill["avatar"];
                  $insert = '3';

		}
		}
		?>
	<div id="main">
	 <div class="container-fluid">

          <form class="form-horizontal" method="post" action="add_<?php echo $halaman; ?>" id="Myform" enctype="multipart/form-data">
              <div class="box-body">

			  <div class="row">
                <div class="form-group col-md-6 col-xs-12" >
                  <label for="username" class="col-sm-3 control-label">*Username:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>"  placeholder="Masukan Username" maxlength="20" required>
                  </div>
                </div>
				</div>

				<div class="row">
				   <div class="form-group col-md-6 col-xs-12" >
                  <label for="password" class="col-sm-3 control-label">*Password:</label>
                  <div class="col-sm-9">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" maxlength="50" required>
                  </div>
                </div>
				</div>

				 <div class="row">
                <div class="form-group col-md-6 col-xs-12" >
                  <label for="nama" class="col-sm-3 control-label">*Nama Lengkap:</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>"  placeholder="Masukan Nama lengkap" maxlength="25" required>
                  </div>
                </div>
				</div>

        <?php if($avatar == null || $avatar == ""){ ?>

			<div class="row">
                <div class="form-group col-md-6 col-xs-12" >
                  <label for="avatar" class="col-sm-3 control-label">Avatar:</label>
                  <div class="col-sm-9">
                    <input type="file" name="avatar">
                  </div>
                </div>
				</div>

        <?php }else{ ?>
          <div class="row">
                    <div class="form-group col-md-6 col-xs-12" >
                      <label for="avatar" class="col-sm-3 control-label">Avatar:</label>
                      <div class="col-sm-9">
      <img src="<?php echo $avatar; ?>" class="img-rounded" alt="Image" width="210" height="210">
      <input type="file" name="avatar">
    </div>
  </div>
</div>
<?php }?>

<?php if($_SESSION['jabatan'] == 'admin'){ ?>
      <div class="row">
        <div class="form-group col-md-6 col-xs-12" >
               <label for="jabatan" class="col-sm-3 control-label">Jabatan:</label>
               <div class="col-sm-9">
                 <select class="form-control select2" style="width: 100%;" name="jabatan" required>
                   <option></option>
          <?php
    $sql=mysqli_query($conn,"select distinct(nama) from jabatan");
    while ($row=mysqli_fetch_assoc($sql)){
      if ($jabatan==$row['nama'])
      echo "<option value='".$row['nama']."' selected='selected'>".$row['nama']."</option>";
      else
      echo "<option value='".$row['nama']."'>".$row['nama']."</option>";
    }
  ?>
                 </select>
        </div>
               </div>
             </div>
             <?php }else{} ?>
			<input type="hidden" class="form-control" id="insert" name="insert" value="<?php echo $insert;?>" maxlength="1" >



              </div>
              <!-- /.box-body -->
              <div class="box-footer" >
                <button type="submit" class="btn btn-default pull-left btn-flat" name="simpan" onclick="document.getElementById('Myform').submit();" ><span class="glyphicon glyphicon-floppy-disk"></span> Simpan</button>
              </div>
              <!-- /.box-footer -->


 </form>
</div>
<?php


   if($_SERVER["REQUEST_METHOD"] == "POST"){

                  $username = $_POST["username"];
				          $password = md5($_POST["password"]);
				          $password = sha1($password);
                  $password = $password;
                  $nama= $_POST["nama"];
                  $jabatan= $_POST["jabatan"];
                  $namaavatar = $_FILES['avatar']['name'];
                  $ukuranavatar = $_FILES['avatar']['size'];
                  $tipeavatar = $_FILES['avatar']['type'];
                  $tmp = $_FILES['avatar']['tmp_name'];
                  $avatar = "dist/upload/".$namaavatar;
				          $insert = ($_POST["insert"]);


 					   $sql="select * from $tabeldatabase where userna_me ='$username'";
        $result=mysqli_query($conn,$sql);

              if(mysqli_num_rows($result)>0){
				  if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000 && $username != null)) && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin')){
                  move_uploaded_file($tmp, $avatar);
                  $sql1 = "update $tabeldatabase set pa_ssword='$password', nama='$nama', jabatan='$jabatan',avatar='$avatar' where userna_me='$username'";
			            $updatean = mysqli_query($conn, $sql1);
				  }else if($chmod >= 3 || $_SESSION['jabatan'] == 'admin'){
                $avatar = "dist/upload/index.jpg";
                $sql1 = "update $tabeldatabase set pa_ssword='$password', nama='$nama', jabatan='$jabatan',avatar='$avatar' where userna_me='$username'";
                $updatean = mysqli_query($conn, $sql1);
        }else{
					  ?>
					    <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
  <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>" name="frm1" method="post">
  <input type="hidden" name="hapusberhasil" value="3" />
  </form>
					  <?php
				  }
			  }
			else if((($tipeavatar == "image/jpeg" || $tipeavatar == "image/png") && ($ukuranavatar <= 10000000 && $username != null && $password != null && $nama != null)) && ( $chmod >= 2 || $_SESSION['jabatan'] == 'admin')){
           move_uploaded_file($tmp, $avatar);
					 $sql2 = "insert into $tabeldatabase values( '$username','$password','$nama','$jabatan','$avatar','')";

					 $insertan = mysqli_query($conn, $sql2);
         }else{
           $avatar = "dist/upload/index.jpg";
           $sql2 = "insert into $tabeldatabase values( '$username','$password','$nama','$jabatan','$avatar','')";

           $insertan = mysqli_query($conn, $sql2);
         }

  }


         ?>

<script>
function myFunction() {
    document.getElementById("Myform").submit();
}
</script>

	  <!-- KONTEN BODY AKHIR -->

                                </div>
								</div>

                                <!-- /.box-body -->
                            </div>
                        </div>

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
                        <!-- ./col -->
                    </div>

                    <!-- /.row -->
                    <!-- Main row -->
                    <div class="row">
                        <!-- Left col -->
                        <!-- /.Left col -->
                    </div>
                    <!-- /.row (main row) -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            <?php  footer(); ?>
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
        <script src="dist/js/demo.js"></script>
		<script src="dist/plugins/datatables/jquery.dataTables.min.js"></script>
		<script src="dist/plugins/datatables/dataTables.bootstrap.min.js"></script>
		<script src="dist/plugins/slimScroll/jquery.slimscroll.min.js"></script>
		<script src="dist/plugins/fastclick/fastclick.js"></script>
		<script src="dist/plugins/select2/select2.full.min.js"></script>
		<script src="dist/plugins/input-mask/jquery.inputmask.js"></script>
		<script src="dist/plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
		<script src="dist/plugins/input-mask/jquery.inputmask.extensions.js"></script>
		<script src="dist/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="dist/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "yyyy/mm/dd"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("yyyy-mm-dd", {"placeholder": "yyyy/mm/dd"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'YYYY/MM/DD h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Hari Ini': [moment(), moment()],
            'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Akhir 7 Hari': [moment().subtract(6, 'days'), moment()],
            'Akhir 30 Hari': [moment().subtract(29, 'days'), moment()],
            'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
            'Akhir Bulan': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

	 $('.datepicker').datepicker({
    dateFormat: 'yyyy-mm-dd'
 });

   //Date picker 2
   $('#datepicker2').datepicker('update', new Date());

    $('#datepicker2').datepicker({
      autoclose: true
    });

	 $('.datepicker2').datepicker({
    dateFormat: 'yyyy-mm-dd'
 });


    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>
