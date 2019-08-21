<?php include 'config_connect.php';
$search = $_GET['search'];
$forward = $_GET['forward'];
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$forward.xls");

?>
<?php if($forward == 'admin'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="SELECT * FROM user where (userna_me like '%$search%' or nama like '%$search%') and jabatan ='admin' order by no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'departemen'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                            <th>Kode Departemen</th>
                                            <th>Nama Departemen</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="SELECT * FROM  $forward where kode like '%$search%' or nama like '%$search%' order by no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['kode']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>

<?php if($forward == 'lokasi'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Lokasi</th>
                                                <th>Nama Lokasi</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
  $query1="SELECT * FROM  $forward where kode like '%$search%' or nama like '%$search%' order by no";

				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['kode']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'jabatan'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Jabatan</th>
                                                <th>Nama Jabatan</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="SELECT * FROM  $forward where kode like '%$search%' or nama like '%$search%' order by no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['kode']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>


<?php if($forward == 'pegawai'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>NIK</th>
                                                <th>Nama</th>
                                                <th>Tanggal Mulai Kerja</th>
                                                <th>Section</th>
                                                <th>Departemen</th>
                                                <th>Jabatan</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="select *,pegawai.no as no,pegawai.nama as nama,lokasi.nama as section, departemen.nama as departemen, jabatan.nama as jabatan from $forward INNER JOIN lokasi ON lokasi.kode = lokasi INNER JOIN departemen ON departemen.kode = departemen INNER JOIN jabatan ON jabatan.kode = jabatan where nik like '%$search%' or pegawai.nama like '%$search%' order by $forward.no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nik']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['tglkerja']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['section']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['departemen']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['jabatan']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>

<?php if($forward == 'gaji'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>No Kavling</th>
                                                <th>Nama Petani</th>
                                                <th>Periode</th>
                                                <th>Taksasi Berat</th>
                                                <th>Harga per kg</th>
                                                <th>Pendapatan Kotor</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

					$query1="SELECT *,gaji.no as no FROM  $forward inner join user on gaji.userna_me = user.userna_me where nokavling like '%$search%' or nama like '%$search%' or periode like '%$search%' order by gaji.no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nokavling']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['periode']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['taksasi']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['harga']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['pendapatan']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>

<?php if($forward == 'approvement'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                              <th>No</th>
                                              <th>Nik</th>
                                              <th>Nama Pegawai</th>
                                              <th>Section</th>
                                              <th>Departemen</th>
                                              <th>Jabatan</th>
                                              <th>Sk Cuti</th>
                                              <th>Tanggal Mulai</th>
                                              <th>Tanggal Selesai</th>
                                              <th>Keterangan</th>
                                              <th>Status</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  $query1="SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, lokasi.nama AS section, pegawai.nama as nama, cuti.no AS NO
  FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode INNER JOIN lokasi ON pegawai.lokasi = lokasi.kode where pegawai.nik like '%$search%' or pegawai.nama like '%$search%' order by cuti.no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
  <td><?php echo ++$no_urut;?></td>
  <td><?php  echo mysql_real_escape_string($fill['nik']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['section']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['departemen']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['jabatan']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['skcuti'].'/'.$fill['tanggal']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['tglmulai']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['tglselesai']); ?></td>
  <td><?php  echo mysql_real_escape_string($fill['keterangan']); ?></td>
  <?php if($fill['status']==''){ echo '<td><span class="label label-default">Pending</span></td>';?>
  <?php }else if($fill['status']=='setuju'){ echo ' <td><span class="label label-success">Disetujui</span></td>';?>
  <?php }else if($fill['status']=='tolak'){ echo '<td><span class="label label-danger">Ditolak</span></td>' ?>
  <?php } ?>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>



<?php if($forward == 'cuti'){ ?>
      <table class="table">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nik</th>
                                                <th>Nama Pegawai</th>
                                                <th>Section</th>
                                                <th>Departemen</th>
                                                <th>Jabatan</th>
                                                <th>Sk Cuti</th>
                                                <th>Tanggal Mulai</th>
                                                <th>Tanggal Selesai</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
										  <?php
	error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));

  $query1="SELECT *,departemen.nama AS departemen, jabatan.nama AS jabatan, lokasi.nama AS section, pegawai.nama as nama, cuti.no AS NO FROM $forward INNER JOIN pegawai ON pegawai.nik = cuti.nik INNER JOIN departemen ON pegawai.departemen = departemen.kode INNER JOIN jabatan ON pegawai.jabatan = jabatan.kode INNER JOIN lokasi ON pegawai.lokasi = lokasi.kode where pegawai.nik like '%$search%' or pegawai.nama like '%$search%' order by cuti.no";
				$hasil = mysqli_query($conn,$query1);
				$no = 1;
				while ($fill = mysqli_fetch_assoc($hasil)){
					?>
                     <tbody>
<tr>
					  <td><?php echo ++$no_urut;?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nik']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['nama']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['section']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['departemen']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['jabatan']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['skcuti'].'/'.$fill['tanggal']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['tglmulai']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['tglselesai']); ?></td>
					  <td><?php  echo mysql_real_escape_string($fill['keterangan']); ?></td>
					  </tr><?php
					;
				}

				?>
                  </tbody></table>
<?php } ?>
