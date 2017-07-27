<?php 
	error_reporting(0);
	#session start
	session_start();
	
	#define db information
	$db="restro";
	$username="root";
	$pass="";
	$serverName=$_SERVER['SERVER_NAME'];
	
	$connection=new mysqli($serverName,$username,$pass,$db);
	
	if($connection->error){
		die('Connection failed!!');
	}
	
	
	if(isset($_GET['contact'])){
		$q="DELETE FROM restaurant WHERE contact_no='$_GET[contact]'";
			
		$r=$connection->query($q);
			
		if($r){
			header("Location: restaurant.php");
		}
	}
	if(isset($_POST['update_data'])){
		$name=$_POST['update_name'];
		$address=$_POST['update_address'];
		$contact=$_POST['update_contact_no'];
		$id=$_POST['id'];
		
		$q="UPDATE restaurant SET name='$name', address='$address', contact_no='$contact' WHERE id='$id'";
		
		$r=$connection->query($q);
		
		if($r){
			header('Location: restaurant.php');
		}
	}

?>


<!Doctype html>
<html lang="en">
<head>
	<title>Restaurant</title>
	<meta charset="utf-8">
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

	<!-- Optional theme -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	<!-- Latest compiled and minified JavaScript -->	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
	

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

    
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-4">
				<h1>Restaurant Info</h1>
			</div>
			<?php
				if(isset($_POST['submit'])){
					if($_POST['name'] !="" && $_POST['address'] !="" && $_POST['contact'] !="" ){
						$name=$_POST['name'];
						$address=$_POST['address'];
						$contact=$_POST['contact'];
						
						$q="INSERT INTO restaurant(name,address,contact_no) VALUES('$name','$address','$contact');";
						$result=$connection->query($q);
						if($result){
							echo "Inserted Data!";
						}
						
					}
				}

			?>
			<?php if($_SESSION['email'] != ''){?>
			<form action="" method="post" class="form-inline">
			  <div class="form-group">
				<input type="text" class="form-control col-md-4" name="name" id="name" placeholder="Restaurant name">
			  </div>
			  <div class="form-group">
				<input type="text" class="form-control col-md-4" name="address" id="address" placeholder="Restaurant address">
			  </div>
			  <div class="form-group">
				<input type="text" class="form-control col-md-4" name="contact" id="contact" placeholder="Contact information">
			  </div>
			  <button type="submit" name="submit" class="btn btn-primary">Insert</button>
			</form>
			
			<br>
			<hr>
			<?php } ?>
			
			<?php
				$query="SELECT * FROM restaurant";
				$result=$connection->query($query);

			?>
			<div>
				<table class="table table-striped">
					<thead>
					  <tr>
						<th>Name</th>
						<th>Address</th>
						<th>Contact Info</th>
						<?php if($_SESSION['email'] != ''){ ?>
						<th>Update</th>
						<th>Delete</th>
						<?php } ?>
						
					  </tr>
					</thead>
					<tbody>
					<?php 
						while($data=mysqli_fetch_assoc($result)){
					?>
					  <tr>
						<?php if($_GET['update']=='active' && $data['id']== $_GET['id']){?>
						<form action='' method='post'>
							<td>
								<input type='text' name='update_name' value='<?=$data['name'];?>'>
							</td>
							<td>
								<input type='text' name='update_address' value='<?=$data['address'];?>'>
							</td>
							<td>
								<input type='text' name='update_contact_no' value='<?=$data['contact_no'];?>'>
							</td>
							<input type='hidden' name='id' value="<?=$data['id'];?>">
							<td>
								<button type="submit" class="btn btn-info" name='update_data'><span class="glyphicon glyphicon-ok"></span></button>
							</td>
						</form>
						<?php }else{?>
							<td><?=$data['name'];?></td>
							<td><?=$data['address'];?></td>
							<td><?=$data['contact_no'];?></td>
						<?php }?>
						<?php if($_SESSION['email'] != ''){
							if($_GET['update']=='active' && $data['id']== $_GET['id']){?>
								<td></td>
								<?php }else{
						?>
							<td><a href="?update=active&id=<?=$data['id'];?>"><span class="glyphicon glyphicon-edit"></span></a></td>
							<td><a href="?contact=<?=$data['contact_no'];?>"><span class="glyphicon glyphicon-remove"></span></a></td>
						<?php 
							}
						} ?>
					  </tr>
					  <?php }?>
					</tbody>
				  </table>
			</div>
		</div>
	</div>
	
    <script src='../ga.js'></script>

</body>
</html>