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
$halaman = "pegawai"; // halaman
$dataapa = "Pegawai"; // data
$tabeldatabase = "pegawai"; // tabel database
$chmod = $chmenu5; // Hak akses Menu
$forward = $tabeldatabase; // tabel database
$forwardpage = $halaman; // halaman
$search = $_POST['search'];
$insert = $_POST['insert'];

function autoNumber(){
  global $forward;
  $query = "SELECT MAX(RIGHT(kode, 4)) as max_id FROM $forward ORDER BY kode";
  $result = mysql_query($query);
  $data = mysql_fetch_array($result);
  $id_max = $data['max_id'];
  $sort_num = (int) substr($id_max, 1, 4);
  $sort_num++;
  $new_code = sprintf("%04s", $sort_num);
  return $new_code;
}
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
if ($chmod >= 2 || $_SESSION['jabatan'] == 'admin' || $_SESSION['jabatan'] == 'pegawai') {
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

        $nik=$nama=$tglkerja=$departemen=$jabatan=$lokasi=$foto=$password="";
        $no = $_GET["no"];
        $insert = '1';



        if(($no != null || $no != "") && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin' || $_SESSION['jabatan'] == 'pegawai')){

          $sql="select * from $tabeldatabase where no='$no'";
          $hasil2 = mysqli_query($conn,$sql);


          while ($fill = mysqli_fetch_assoc($hasil2)){


            $nik = $fill["nik"];
            $nama = $fill["nama"];
            $tglkerja = $fill["tglkerja"];
            $departemen = $fill["departemen"];
            $jabatan = $fill["jabatan"];
            // $lokasi = $fill["lokasi"];
            $foto = $fill["foto"];
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
                  <label for="nik" class="col-sm-3 control-label">NIK:</label>
                  <div class="col-sm-9">
                    <input type="number" class="form-control" id="nik" name="nik" value="<?php echo $nik; ?>"  placeholder="Masukan NIK" maxlength="50" required>
                  </div>
                </div>
              </div>

              <div class="row">
               <div class="form-group col-md-6 col-xs-12" >
                <label for="password" class="col-sm-3 control-label">Password:</label>
                <div class="col-sm-9">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukan Password" maxlength="100" required>
                </div>
              </div>
            </div>

            <div class="row">
             <div class="form-group col-md-6 col-xs-12" >
              <label for="nama" class="col-sm-3 control-label">Nama:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama; ?>" placeholder="Masukan Nama" maxlength="50" required>
              </div>
            </div>
          </div>


          <div class="row">
            <div class="form-group col-md-6 col-xs-12" >
              <label for="tglkerja" class="col-sm-3 control-label">Tanggal Mulai Kerja:</label>
              <div class="col-sm-9">
                <input type="text" class="form-control pull-right" id="datepicker" name="tglkerja" value="<?php echo $tglkerja; ?>" placeholder="Masukan Tanggal" required>
              </div>
            </div>
          </div>

          <div class="row">
           <div class="form-group col-md-6 col-xs-12" >
            <label for="lokasi" class="col-sm-3 control-label">Section:</label>
            <div class="col-sm-9">
              <input class="form-control" style="width: 100%;" name="lokasi" required>
            </div>
          </div>
        </div>

        <div class="row">
         <div class="form-group col-md-6 col-xs-12" >
          <label for="departemen" class="col-sm-3 control-label">Departemen:</label>
          <div class="col-sm-9">
            <select class="form-control select2" style="width: 100%;" name="departemen" required>
              <option></option>
              <?php
              $sql=mysqli_query($conn,"select * from departemen");
              while ($row=mysqli_fetch_assoc($sql)){
                if ($departemen==$row['kode']){ ?>
                  <option value="<?php echo $row['kode']; ?>" selected><?php echo $row['nama'];?></option>
                <?php }else{ ?>
                  <option value="<?php echo $row['kode']; ?>"><?php echo $row['nama'];?></option>
                  <?php
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>

      <div class="row">
       <div class="form-group col-md-6 col-xs-12" >
        <label for="jabatan" class="col-sm-3 control-label">Jabatan:</label>
        <div class="col-sm-9">
          <select class="form-control select2" style="width: 100%;" name="jabatan" required>
            <option></option>
            <?php
            $sql=mysqli_query($conn,"select * from jabatan");
            while ($row=mysqli_fetch_assoc($sql)){
              if ($jabatan==$row['kode']){ ?>
                <option value="<?php echo $row['kode']; ?>" selected><?php echo $row['nama'];?></option>
              <?php }else{ ?>
                <option value="<?php echo $row['kode']; ?>"><?php echo $row['nama'];?></option>
                <?php
              }
            }
            ?>
          </select>
        </div>
      </div>
    </div>


    <?php if($foto == null || $foto == ""){ ?>

     <div class="row">
      <div class="form-group col-md-6 col-xs-12" >
        <label for="foto" class="col-sm-3 control-label">Foto:</label>
        <div class="col-sm-9">
          <input type="file" name="foto">
        </div>
      </div>
    </div>

  <?php }else{ ?>
    <div class="row">
      <div class="form-group col-md-6 col-xs-12" >
        <label for="foto" class="col-sm-3 control-label">Foto:</label>
        <div class="col-sm-9">
          <img src="<?php echo $foto; ?>" class="img-rounded" alt="Image" width="210" height="210">
          <input type="file" name="foto">
        </div>
      </div>
    </div>
  <?php }?>

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

 $nik = $_POST["nik"];
 $password = md5($_POST["password"]);
 $password = sha1($password);
 $password = $password;
 $nama= $_POST["nama"];
 $tglkerja= $_POST["tglkerja"];
 $departemen= $_POST["departemen"];
 $jabatan= $_POST["jabatan"];
 $lokasi= $_POST["lokasi"];
 $namafoto = $_FILES['foto']['name'];
 $ukuranfoto = $_FILES['foto']['size'];
 $tipefoto = $_FILES['foto']['type'];
 $tmp = $_FILES['foto']['tmp_name'];
 $foto = "dist/upload/".$namafoto;
 $insert = ($_POST["insert"]);


 $sql="select * from $tabeldatabase where nik ='$nik'";
 $result=mysqli_query($conn,$sql);

 if(mysqli_num_rows($result)>0){
   if((($tipefoto == "image/jpeg" || $tipefoto == "image/png") && ($ukuranfoto <= 10000000 )) && ($chmod >= 3 || $_SESSION['jabatan'] == 'admin' || $_SESSION['jabatan'] == 'pegawai')){
     move_uploaded_file($tmp, $foto);
     $sql1 = "update $tabeldatabase set nama='$nama',password='$password', tglkerja='$tglkerja', departemen='$departemen', jabatan='$jabatan', lokasi='$lokasi', foto='$foto' where nik='$nik'";
     $updatean = mysqli_query($conn, $sql1);
   }else if(($chmod >= 3 || $_SESSION['jabatan'] == 'admin' || $_SESSION['jabatan'] == 'pegawai')){
     $foto = "dist/upload/index.jpg";
     $sql1 = "update $tabeldatabase set nama='$nama',password='$password', tglkerja='$tglkerja', departemen='$departemen', jabatan='$jabatan', lokasi='$lokasi', foto='$foto' where nik='$nik'";
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
  else if((($tipefoto == "image/jpeg" || $tipefoto == "image/png") && ($ukuranfoto <= 10000000)) && ( $chmod >= 2 || $_SESSION['jabatan'] == 'admin' || $_SESSION['jabatan'] == 'pegawai')){
    move_uploaded_file($tmp, $foto);
    $sql2 = "insert into $tabeldatabase values( '$nik','$nama','$tglkerja','$departemen','$jabatan','$lokasi','$foto','$password','')";

    $insertan = mysqli_query($conn, $sql2);
  }else {
    $foto = "dist/upload/index.jpg";
    $sql2 = "insert into $tabeldatabase values( '$nik','$nama','$tglkerja','$departemen','$jabatan','$lokasi','$foto','$password','')";

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
