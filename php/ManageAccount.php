<?php include '../php/SecurityLoggedIn.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
	<script src="../js/ShowImageInForm.js"></script>
	<script src="../js/UpdateAccountAjax.js"></script>
</head>

<body>
	<?php include '../php/Menus.php' ?>
	<?php
	include '../php/DbConfig.php';
	$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
	
	$email = $_SESSION['email'];

	$sql = "SELECT * FROM users WHERE email='$email'";
	$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
		
	while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
		$email = $row['email'];
		$name = $row['name'];
		$surname1 = $row['surname1'];
		$surname2 = $row['surname2'];
		$telephone = $row['telephone'];
	}
	mysqli_free_result($emaitza);
	mysqli_close($esteka);
	?>
	<div class="main">
		<div class="container">
			<h1 style="text-align:center">Editatu profila</h1>
			<hr>
			<div class="row">
				<!-- left column -->

				<div class="col-md-3">
					<div class="text-center">
						<?php 
					$images = glob("../images/users/".$email.".*");
					if (empty($images)) {
						$avatar = "../images/Anonimoa.png";
					}
					else {
						$avatar = $images[0];
					}
					?>
						<img src="<?php echo $avatar; ?>" class="avatar img-circle" alt="avatar" id="argazki">
						<h6>Igo beste argazki bat...</h6>
					</div>
				</div>

				<!-- edit form column -->
				<div class="col-md-6 personal-info">
					<div class="alert alert-info alert-dismissable" style="display: none;" id="alerta">
						<a class="panel-close close" data-dismiss="alert">×</a>
						<i class="fa fa-refresh" aria-hidden="true"></i>
                        Aldaketak gorde dira.
					</div>
					<h4 style="text-align:center">Kontuaren datuak</h4>
					<form class="form-horizontal" role="form" name="eguneratu" id="eguneratu">
						<div class="form-group">
							<label class="col-lg-3 control-label" for="email">Email:</label>
							<div class="col-lg-12">
								<input class="form-control" type="text" id="email" name="email" value="<?php echo $email; ?>"
									readonly />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="name">Izena:</label>
							<div class="col-lg-12">
								<input class="form-control" type="text" id="name" name="name" value="<?php echo $name; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="surname1">Lehenengo abizena:</label>
							<div class="col-lg-12">
								<input class="form-control" type="text" id="surname1" name="surname1"
									value="<?php echo $surname1; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="surname2">Bigarren abizena:</label>
							<div class="col-lg-12">
								<input class="form-control" type="text" id="surname2" name="surname2"
									value="<?php echo $surname2; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="telephone">Telefonoa:</label>
							<div class="col-lg-12">
								<input class="form-control" type="number" id="telephone" name="telephone" pattern="[0-9]{9}"
									title="Telefonoak 9 digitu izan behar ditu" value="<?php echo $telephone; ?>" />
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="password1">Pasahitza:</label>
							<div class="col-lg-12">
								<input class="form-control" type="password" id="password1" name="password1" minlength="6"
									value="123456">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-6 control-label" for="password2">Pasahitza errepikatu:</label>
							<div class="col-lg-12">
								<input class="form-control" type="password" id="password2" name="password2" value="123456">
							</div>
						</div>
						</div class="form-group">
							<label class="col-lg-12 control-label" for="image">Argazkia aukeratu:</label>
							<div class="col-lg-12">
								<input type="file" class="form-control" id="image" name="image" accept="image/*" style="width: 50%;display: inline-block;">
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-3 control-label"></label>
							<br>
							<div class="col-lg-12">
								<input type="button" class="btn btn-success" value="Gorde aldaketak" id="gorde">
								<input type="reset" class="btn btn-danger" value="Berrezarri"
									onclick="location.href='ManageAccount.php'">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>