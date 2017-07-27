
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
	
	$try="";
	if(isset($_POST['email'])){
		$email=$_POST['email'];
		$password=$_POST['password'];
		
		
		$query="SELECT id FROM login WHERE email='$email' AND pass='$password'";
		
		$result=$connection->query($query);
		
		if(mysqli_num_rows($result) > 0 ){
			$_SESSION['email']=$email;
			
			header('Location: index.php');
		}else{
			$try="Invalid input. Try Again!!";
		}
	
	}

?>

<!Doctype html>
<head>


	
<link rel="stylesheet" type="text/css" href="css/login.css">
<script src="http://mymaplist.com/js/vendor/TweenLite.min.js"></script>

<script type="text/javascript" src="js/login.js"></script>

<!-- This is a very simple parallax effect achieved by simple CSS 3 multiple backgrounds, made by http://twitter.com/msurguy -->
</head>
<body>

<div class="container">
    <div class="row vertical-offset-100">
    	<div class="col-md-4 col-md-offset-4">
    		<div class="panel panel-default">
			  	<div class="panel-heading">
			    	<h3 class="panel-title">Please sign in</h3>
			 	</div>
			  	<div class="panel-body">
			    	<form action="" method="post" accept-charset="UTF-8" role="form">
                    <fieldset>
			    	  	<div class="form-group">
			    		    <input class="form-control" placeholder="E-mail" name="email" type="text">
			    		</div>
			    		<div class="form-group">
			    			<input class="form-control" placeholder="Password" name="password" type="password" value="">
			    		</div>
						<br>
						<hr>
						<h1 style="color:#fff;"><?=$try;?></h1>
			    		<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
			    	</fieldset>
			      	</form>
			    </div>
			</div>
		</div>
	</div>
</div>
</body>
<html>