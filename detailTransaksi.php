<!DOCTYPE html>
<html>
<head>
	<title>Detail Transaksi</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php  
		include("hf/reference.php");
	?>
</head>
<body>
	<div class="container">		
		<?php include("hf/menubar.php"); ?>
		<?php 
			if(isset($_GET['detailTransaksi'])) {
			$id_transaksi = $_GET['detailTransaksi'];

			$items = getDetailCart($id_transaksi);
		?>
		<br><br>
		<center>
		<h4>Detail transaksi</h4>
		<br>
		<table class="table table-stripped table-bordered table-hover ">
			<tr>
				<th>Nama produk</th>
				<th>Harga produk</th>
				<th>Jumlah pesanan</th>
				<th>Total Harga</th>
				<th colspan="2">status</th>
			</tr>			
		
		<?php  
			$sum = 0;
			$jumlah = 0;
				$resQ = getAllDetailCarting($id_transaksi);

				while($itemL = mysqli_fetch_array($resQ)) {
					$status_transaksi = $itemL['status'];
					$tanggal_transaksi = $itemL['tanggal_transaksi'];
					$jam = $itemL['jam'];
				}

				while($item = mysqli_fetch_array($items)) {
					$id_item = $item['id_items'];
					$id_keranjang = $item['id_keranjang'];
					$id_produk = $item['id_produk'];
					$id_user = $item['id_user'];
					$total_harga = $item['total_harga'];
					$status = $item['status'];
					$jumlah_pesanan = $item['jumlah'];


					$queri = "SELECT * FROM t_produk WHERE id_produk = '$id_produk'";
					$hasil = mysqli_query($conn,$queri);
					while($data = mysqli_fetch_array($hasil)) {
						$nama_produk = $data['nama_prod'];
						$harga_produk = $data['harga'];
					}

					echo "<tr>";
					echo "<td>";
					echo $nama_produk;
					echo "</td>";
					echo "<td>";
					echo $harga_produk;
					echo "</td>";
					echo "<td>";
					echo $jumlah_pesanan;
					echo "</td>";
					echo "<td>";
					echo $total_harga;	
					echo "</td>";
					
					if($status=='Accepted') {
						echo "<td><b><font color='Green'>".$status."</font></b></td>";
					}
					if($status=='Requested') {
						echo "<td><b><font color='brown'>".$status."</font></b></td>";
					}
					if($status=='Rejected') {
						echo "<td><b><font color='red'>".$status."</font></b></td>";
					}
					echo "</tr>";

					$sum += $total_harga;
					$jumlah += $jumlah_pesanan;
				}				
		?>
			<tr>			
				<td colspan="2"><b>Total</b></td>
				<td><b><?php echo $jumlah; ?></b></td>
				<td><b><?php echo $sum; ?></b></td>
			</tr>
		</table>		
		</center>

		<a href="keranjang.php?riwayatTransaksi=<?php echo $_SESSION['id']; ?>" class="btn btn-primary">Kembali</a>

		<?php } ?>
	</div>
</body>
</html>