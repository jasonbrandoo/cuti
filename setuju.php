<head>
</head>
<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
include "configuration/config_chmod.php";
include "configuration/config_etc.php";
include "configuration/config_include.php";
etc();encryption();session();connect();timing();

if (!login_check()) {
?>
<meta http-equiv="refresh" content="0; url=logout" />
<?php
exit(0);
}

$chmod = $chmenu7;
if ($chmod >= 3 || $_SESSION['jabatan'] == 'admin') {
?>
<?php

$apr = $_GET['apr'];
$skcuti = $_GET['skcuti'];
$forwardpage = 'approvement';

if($apr == 'setuju'){

  $sql = "update cuti set status='setuju' where skcuti='".$skcuti."'";
  $hasil = mysqli_query($conn,$sql);
?>

<body onload="setTimeout(function() { document.frm1.submit() }, 10)">
<form action="<?php echo $forwardpage;?>" name="frm1" method="post">
<input type="hidden" name="add" value="2" />
</form>

<?php
}else if($apr == 'tolak'){

    $sql = "update cuti set status='tolak' where skcuti='".$skcuti."'";
    $hasil = mysqli_query($conn,$sql);
   ?>
   <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
   <form action="<?php echo $forwardpage;?>" name="frm1" method="post">
   <input type="hidden" name="add" value="2" />
   </form>
   <?php
}

?>
<table width="100%" align="center" cellspacing="0">
 <tr>
   <td height="500px" align="center" valign="middle"><img src="img/load.gif">
 </tr>
</table>
</body>
<?php }else{
?>
  <body onload="setTimeout(function() { document.frm1.submit() }, 10)">
  <form action="<?php echo $baseurl; ?>/<?php echo $forwardpage;?>" name="frm1" method="post">
  <input type="hidden" name="hapusberhasil" value="3" />
<?php
}
?>
