<?php include("server.php"); ?>
<?php $result = mysqli_query($db, "SELECT * FROM user"); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM user WHERE id=$id");

		if (count(array($record)) == 1 ) {
			$n = mysqli_fetch_array($record);
			$nama = $n['nama'];
			$no_meja = $n['no_meja'];
			$detail_pesanan = $n['detail_pesanan'];
		}
	}
?>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>UAS Crud Restaurant</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<!-- header -->
	<div class="header">
		<span>
			UAS Crud Restaurant
		</span>
	</div>
	<!-- Alert jika CRUD data -->
	<?php if (isset($_SESSION['alert'])) : ?>
	<label>
		<input type="checkbox" class="alertCheckbox" autocomplete="off" />
		<div class="alert success">
			<span class="alertClose">X</span>
			<span class="alertText">
				<?php
					echo $_SESSION['alert'];
					unset($_SESSION['alert']);
				?>
				<br class="clear" />
			</span>
		</div>
	</label>
	<?php endif ?>

	<div class="content">
		<h3>
			Pesan Di sini
		</h3>
		<!-- Form CRUD data -->
		<form action="server.php" method="POST" class="form">
				<div class="form-input">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<input type="text" name="nama" placeholder="Masukan Nama" value="<?php echo $nama; ?>" class="input">
					<input type="text" name="no_meja" placeholder="Masukan No Meja" value="<?php echo $no_meja; ?>" class="input">
					<textarea type="textarea" name="detail_pesanan" placeholder="Masukan Detail Pesanan" value="<?php echo $detail_pesanan; ?>" class="input" rows="4" cols="50"></textarea>
					<?php if ($update == true): ?>
					<input type="submit" name="update" value="Update" class="button">
					<?php else: ?>
					<input type="submit" name="save" value="Save" class="button">
					<?php endif ?>
				</div>
			</form>
		<!-- Table data -->
		<table class="styled-table">
		<thead>
			<thead>
				<tr>
					<th>Nama</th>
					<th>No Meja</th>
					<th>Detail Pesanan</th>
					<th colspan="2">Setting</th>
				</tr>
			</thead>
			<?php while ($row = mysqli_fetch_array($result)) { ?>
			<tbody>
				<tr>
					<td><?php echo $row['nama']; ?></td>
					<td><?php echo $row['no_meja']; ?></td>
					<td style="width:50%"><?php echo $row['detail_pesanan']; ?></td>
					<td><a href="index.php?edit=<?php echo $row['id'] ?>" class="edit">Edit</a></td>
					<td><a href="server.php?del=<?php echo $row['id'] ?>" class="delete">Delete</a></td>
				</tr>
			</tbody>
			<?php } ?>
		</table>
	</div>

</body>
</html>