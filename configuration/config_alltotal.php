<?php
include 'config_connect.php';

  // Total Admin Terdaftar

  $sqlx2="SELECT COUNT( * ) AS data FROM user where jabatan ='admin'";
	$hasilx2=mysqli_query($conn,$sqlx2);
	$row=mysqli_fetch_assoc($hasilx2);
	$adminterdaftar=$row['data'];

  // Total Petani Terdaftar

  $sqlx2="SELECT COUNT( * ) AS data FROM pegawai";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $karyawanterdaftar=$row['data'];

  // Total Rotasi Terdaftar

  $sqlx2="SELECT COUNT( * ) AS data FROM cuti where status='setuju'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $cutisetuju=$row['data'];

  // Total Gaji Terdaftar

  $sqlx2="SELECT COUNT( * ) AS data FROM cuti where status='tolak'";
  $hasilx2=mysqli_query($conn,$sqlx2);
  $row=mysqli_fetch_assoc($hasilx2);
  $cutiditolak=$row['data'];



?>
