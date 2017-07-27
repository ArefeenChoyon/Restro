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
	
	
	if($_GET['delete']=='active' && isset($_GET['MenuID'])){
		$q="DELETE FROM menu WHERE MenuID='$_GET[MenuID]'";
			
		$r=$connection->query($q);
			
		if($r){
			header("Location: menu.php");
		}
	}
	if(isset($_POST['update_data'])){
		$MName=$_POST['update_MName'];
		$Price=$_POST['update_Price'];
		$restaurant_name=$_POST['update_restaurant_name'];
		$MenuID=$_POST['MenuID'];
		
		$q="UPDATE menu SET MName='$MName', Price='$Price', restaurant_name='$restaurant_name' WHERE MenuID='$MenuID'";
		
		$r=$connection->query($q);
		
		if($r){
			header('Location: menu.php');
		}
	}

?>


<!Doctype html>
<html lang="en">
<head>
	<title>Menu</title>
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
				<h1>Menu Info</h1>
			</div>
			<?php
				if(isset($_POST['submit'])){
					if($_POST['MName'] !="" && $_POST['Price'] !="" && $_POST['restaurant_name'] !="" ){
						$MName=$_POST['MName'];
						$Price=$_POST['Price'];
						$RestaurantName=$_POST['restaurant_name'];
						
						$q="INSERT INTO menu(MName,Price,restaurant_name) VALUES('$MName','$Price','$RestaurantName');";
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
				<input type="text" class="form-control col-md-4" name="MName" id="MName" placeholder="Menu name">
			  </div>
			  <div class="form-group">
				<input type="text" class="form-control col-md-4" name="Price" id="Price" placeholder="Menu Price">
			  </div>
			  <div class="form-group">
				<input type="text" class="form-control col-md-4" name="restaurant_name" id="restaurant_name" placeholder="Restaurant Name">
			  </div>
			  <button type="submit" name="submit" class="btn btn-primary">Insert</button>
			</form>
			
			<br>
			<hr>
			<?php } ?>
			
			<?php
				$query="SELECT * FROM menu";
				$result=$connection->query($query);

			?>
			<div>
				<table class="table table-striped">
					<thead>
					  <tr>
						<th>Menu Name</th>
						<th>Price</th>
						<th>Restaurant Name</th>
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
						<?php if($_GET['update']=='active' && $data['MenuID']== $_GET['MenuID']){?>
						<form action='' method='post'>
							<td>
								<input type='text' name='update_MName' value='<?=$data['MName'];?>'>
							</td>
							<td>
								<input type='text' name='update_Price' value='<?=$data['Price'];?>'>
							</td>
							<td>
								<input type='text' name='update_restaurant_name' value='<?=$data['restaurant_name'];?>'>
							</td>
							<input type='hidden' name='MenuID' value="<?=$data['MenuID'];?>">
							<td>
								<button type="submit" class="btn btn-info" name='update_data'><span class="glyphicon glyphicon-ok"></span></button>
							</td>
						</form>
						<?php }else{?>
							<td><?=$data['MName'];?></td>
							<td><?=$data['Price'];?></td>
							<td><?=$data['restaurant_name'];?></td>
						<?php }?>
						<?php if($_SESSION['email'] != ''){
							if($_GET['update']=='active' && $data['MenuID']== $_GET['MenuID']){?>
								<td></td>
								<?php }else{
						?>
							<td><a href="?update=active&MenuID=<?=$data['MenuID'];?>"><span class="glyphicon glyphicon-edit"></span></a></td>
							<td><a href="?delete=active&MenuID=<?=$data['MenuID'];?>"><span class="glyphicon glyphicon-remove"></span></a></td>
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