<?php 
	#session start
	
	error_reporting(0);

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

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Restro - Website Home Page  </title>
	<meta charset="utf-8">
	
	

	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/carouFredSel.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/main.js"></script>
</head>
<body>

	<!--  start header  -->
	<header>
		<div class="wrapper">
			<div class="logo">
				<a href=""><img src="img/logo.png" alt="Restro" title=""/></a>
			</div>

			<nav>
			
			
				<ul>
					<!-- <li><a href="" class="active">Home</a></li>-->
					
					
					
					
					
				    <li><a href="">Our Story</a></li>
					<li><a href="restaurant.php">Restaurant</a></li>
					<li><a href="menu.php">Menu</a></li>
					<li><a href="">News</a></li>
					<li><a href="">Reviews</a></li>
					<?php if($_SESSION['email']==""){?>
					<li><a href="login.php">Login</a></li> 
					<?php } else{ ?>
					<li><a href="logout.php">Logout</a></li>
					<?php } ?>
				</ul>
			</nav>
		</div>
	</header><!--  end header  -->


	<!--  start hero  -->
	<section class="hero">
		<div class="caption">
			<h3>Restro</h3>
			<h4>
				<span class="rsep"></span>
				A paradise for Foodies~
				<span class="lsep"></span>
			</h4>
			
		</div>
		  <br><br>
		
		<div align="middle">
			<form action="" method="get">
				<input style="width:40%;" type="search" name="search" placeholder="Search menu">
				<input type="submit" value="Search">
			</form>
		</div>
		
		
	</section><!--  end hero  -->
</div>


	<!--  start menu  -->
	<section class="menu">
		<div class="wrapper">
			<div class="menu_title">
				<h2>The Menu</h2>
			</div>
			
			<?php
				$i=0;
				if($_GET['search'] != ''){
					$q="SELECT * FROM menu WHERE MName LIKE '%$_GET[search]%'";
				}else{
					$q="SELECT * from menu";
				}
				$r=$connection->query($q);
				while($data=mysqli_fetch_assoc($r)){?>
			<div class="mean_menu">
			
			<?php
				if($i%2==0 && $i<7){
					$i++;
			?>
				<!--  left menu row  -->
				<article class="lmenu">
					<ul>
						<li>
							<div class="item_info">
								<h3 class="item_name"><?=$data['MName'];?></h3>
								<p class="item_desc">Cheese, tomato, mushrooms, onions.</p>
							</div>
							<h4 class="price"><?=$data['Price'];?></h4>
							<span class="separator"></span>
							
							
							
						</li>
					</ul>
			<?php } else if($i%2!=0 && $i<7){
					$i++;
			?>
				<!--  right menu row  -->
				<article class="rmenu">
					<ul>
						<li>
							<div class="item_info">
								<h3 class="item_name"><?=$data['MName'];?></h3>
								<p class="item_desc">Tuna, Sweetcorn, Cheese.</p>
							</div>
							<h4 class="price"><?=$data['Price'];?></h4>
							<span class="separator"></span>
						</li>
					</ul>
				</article>
			</div>
			<?php }else if($i>=7 && $i%2==0){
				$i++;
			?>
			<!--  hidden menu items  -->
			<div class="hidden_items">
				<!--  left menu row  -->
				<article class="lmenu">
					<ul>
						<li>
							<div class="item_info">
								<h3 class="item_name"><?=$data['MName'];?></h3>
								<p class="item_desc">Cheese, tomato, mushrooms, onions.</p>
							</div>
							<h4 class="price"><?=$data['Price'];?></h4>
						<span class="separator"></span>
						</li>
					</ul>
				</article>
				<?php }else if($i>=7 && $i%2 !=0){
					$i++;

				?>
				<!--  right menu row  -->
				<article class="rmenu">
					<ul>
						<li>
							<div class="item_info">
								<h3 class="item_name"><?=$data['MName'];?></h3>
								<p class="item_desc">Cheese, tomato, mushrooms, onions.</p>
							</div>
							<h4 class="price"><?=$data['Price'];?></h4>
						<span class="separator"></span>
						</li>
					</ul>
				</article>
				<?php }
				}
				?>
			</div>
		
			<div class="load-more">
				<a href="#" id="more_items">
					show more
					<hr/>
					<span class="bottom_arrow"></span>
				</a>
			</div>
		</div>
	</section><!--  end menu  -->


	<!--  start featured dishes  -->
	<section class="featured_dishes">
		<div class="wrapper">
			<section class="info">
				<div class="title">
					<h3>Featured Dishes</h3>
					<span class="separator"></span>
				</div>
				<div class="slider_nav" id="slider_nav">
				</div>
			</section>

			<section class="dishes" id="dishes">

				<article>
					<div class="dishe_img">
						<a href="#"><img src="img/dish1.jpg" alt="" title=""/></a>					
					</div>
					<div class="dish_info">
						<a href="#"><h2>Four season Pizza</h2></a>
						<h3>595bdt</h3>
					</div>
					<ul class="rating">
						<li></li>
						<li></li>
						<li></li>
						<li></li>
						<li class="no-star"></li>
					</ul>
				</article>

				<article>
					<div class="dishe_img">
						<a href="#"><img src="img/dish2.jpg" alt="" title=""/></a>					
					</div>
					<div class="dish_info">
						<a href="#"><h2>Pasta Basta</h2></a>
						<h3>290bdt</h3>
					</div>
					<ul class="rating">
						<li></li>
						<li></li>
						<li></li>
						<li class="no-star"></li>
						<li class="no-star"></li>
					</ul>
				</article>

			
			</section>
		</div>
	</section><!--  end featured_dishes  -->


	<!--  start gallery  -->
	<section class="gallery">
		<div class="wrapper">
			<section class="info">
				<div class="title">
					<h3>The Gallery</h3>
					<span class="separator"></span>
				</div>
			</section>

			<div class="media">
				<section>
					<a href="#">
						<img src="img/img1.jpg" alt="" title=""/>
					</a>
				</section>

				<section>
					<div class="hhalf">
						<a href="#">
							<img src="img/img2.jpg" alt="" title=""/>
						</a>
					</div>
					<div class="hhalf">
						<a href="#">
							<img src="img/img3.jpg" alt="" title=""/>
						</a>
					</div>
				</section>

				<section>
					<div class="hhalf">
						<a href="#">
							<img src="img/img4.jpg" alt="" title=""/>
						</a>
					</div>
					<div class="hhalf">
						<a href="#">
							<img src="img/img5.jpg" alt="" title=""/>
						</a>
					</div>
				</section>
			</div>
		</div>
	</section><!--  end gallery  -->


	<!--  start footer  -->
	<footer>
		<div class="wrapper">
			<!-- adresse1  -->
			<section class="adress">
				<p>Contact Us</p> 
				<p class="e-mail">Arefeen.choyon@gmail.com</p>
				<p class="e-mail">Suraiajabeen@gmail.com</p>
			</section>

			<!--  adress2  -->
			
			<!--  footer navigation  -->
			<section class="footer_nav">
				<nav>
					<ul>
						<li><a href="">Blog</a></li>
						<li><a href="">Careers</a></li>
						<li><a href="">Privacy Policy</a></li>
						<li><a href="">Contact</a></li>
					</ul>
				</nav>
			</section>

			<!--  footer copyrights  -->
			<section class="copyrights">
				<img src="img/footer_logo.png" class="footer_logo" alt="" title="">
				<p>© All Rights Reserved 2016.</p>
				
			</section>
		</div>
	</footer><!--  end footer  -->
    <script src='../ga.js'></script>

</body>
</html>