<?php include '../php/SecurityLoggedIn.php' ?>
<!DOCTYPE html>
<html>

<head>
	<?php include '../html/Head.html'?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="../js/ShowImageInForm.js"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
	<?php include '../php/Menus.php' ?>
<<<<<<< HEAD
=======
	<section class="main" id="s1">
		<div id="taula">
			<h2>Kontua kudeatu</h2>
			<br>
>>>>>>> c199932f9ea889b3a5fbdf387d1d6c720b02f7d2
            <?php
                include '../php/DbConfig.php';
				$esteka = mysqli_connect($zerbitzaria, $erabiltzailea, $gakoa, $db) or die("Errorea datu-baseko konexioan");
				
				$email = $_SESSION['email'];
			
				$sql = "SELECT * FROM users WHERE email='$email'";
				$emaitza = mysqli_query($esteka, $sql) or die("Errorea datu-baseko kontsultan");
				   
				while ($row = mysqli_fetch_array($emaitza, MYSQLI_ASSOC)) {
                    $email=$row['email'];
                    $name=$row['name'];
                    $surname1=$row['surname1'];
                    $surname2=$row['surname2'];
                    $tel=$row['telephone'];
				}
				mysqli_free_result($emaitza);
            ?>
<div class="container">
    <h1  style="text-align:center">Editatu perfilla</h1>
  	<hr>
	<div class="row">
      <!-- left column -->
      <div class="col-md-3">
        <div class="text-center">
          <img src="../images/Avatar.jpg" class="avatar img-circle" alt="avatar" id="argazki">
          <h6>Igo beste argazki bat...</h6>
          
          <input type="file" class="form-control" id="argazkiaa" accept="image/*">
        </div>
      </div>
      
      <!-- edit form column -->
      <div class="col-md-9 personal-info">
        <h3>Personal info</h3>       
        <form class="form-horizontal" role="form" action="#" method="post" name="eguneratu" id="eguneratu">
        <div class="form-group">
            <label class="col-lg-3 control-label">Email:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $email; ?>" readonly/>
            </div>
          </div>  
        <div class="form-group">
            <label class="col-lg-3 control-label">Izena:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $name; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Lehen abizena:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $surname1; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Bigarren abizena:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $surname2; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Telefonoa:</label>
            <div class="col-lg-8">
              <input class="form-control" type="text" value="<?php echo $tel; ?>"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Password:</label>
            <div class="col-lg-8">
              <input class="form-control" type="password" value="11111122333">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label">Confirm password:</label>
            <div class="col-lg-8">
              <input class="form-control" type="password" value="11111122333">
            </div>
          </div>
          <div class="form-group">
            <label class="col-lg-3 control-label"></label>
            <div class="col-lg-8">
              <input type="button" class="btn btn-primary" value="Save Changes">
              <span></span>
              <input type="reset" class="btn btn-default" value="Cancel">
            </div>
          </div>
        </form>
      </div>
  </div>
</div>
	<?php include '../html/Footer.html' ?>
</body>

</html>