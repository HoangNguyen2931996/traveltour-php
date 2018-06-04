<?php 
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="HandheldFriendly" content="True">
	<title>BK Tour</title>
	<link rel="stylesheet" href="../templates/public/css/style.css" type="text/css" media="screen,projection,print" />
	<link rel="stylesheet" href="../templates/public/css/prettyPhoto.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="../templates/public/css/jquery.raty.css" type="text/css" media="screen" />
	
	<link rel="shortcut icon" href="../templates/public/images/favicon.ico" />
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../templates/public/js/jquery.raty.min.js"></script>
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
	<script type="text/javascript" src="../templates/public/js/jquery.validate.min.js"></script>
</head>
<body>
	<!--header-->
	<header>
		<div class="wrap clearfix">
			<h1 class="logo"><a href="index.php" title="Book Your Travel - home"><img style="height: 55px; width: 270px" src="../templates/public/images/txt/logo.png" alt="Book Your Travel" /></a></h1>
			<div class="ribbon">
				<nav>
					<ul class="profile-nav">
						<li class="active"><a href="javascript:void(0)" title="My Account">My Account</a></li>
						
						<?php 
							
							
							if(isset($_SESSION['fullname'])){
								$fullname = $_SESSION['fullname'];
								$idUser = $_SESSION['idUser'];
						?>
							<li><a href="account.php?id=<?php echo $idUser ?>" title="edit"><?php echo $fullname ?></a></li>
							<li><a href="LogoutController.php" title="logout">Logout</a></li>
						<?php 
							} else{
						?>
							<li><a href="login.php" title="login">Login</a></li>
							<li><a href="registration.php" title="Register">Register</a></li>
						<?php
							}
						?>
						
					</ul>
				</nav>
			</div>
			<!--//ribbon-->
			
			
			<!--//search-->
			
			<!--contact-->
			<div class="contact" style="margin-right: 100px">
				<span>BKtour@gmail.com</span>
				<span class="number">01692766061</span>
			</div>
			<!--//contact-->
		</div>
		
		<!--main navigation-->
		<nav class="main-nav" role="navigation" id="nav">
			<ul class="wrap">
				<li><a href="javascript:void(0)" title="Hotels">Du lịch</a>
					<ul>
					<?php 
                        $query = "SELECT * FROM locations";
                        $result = $mysqli -> query($query);
                        while ($objLocation = mysqli_fetch_assoc($result)) {
                            $id = $objLocation['id'];
                            $name = $objLocation['name'];
                            $idParent = $objLocation['id_parent'];
                            if($idParent == 0){
                    ?>
								<li><a href="cat.php?id=<?php echo $id ?>"><?php echo $name ?></a></li>
					<?php 
							}
						}
					?>
					</ul>
				</li>
				
			</ul>
		</nav>
		<!--//main navigation-->
	</header>