<?php
	include "../functions/DbConnect.php";
    include "../templates/public/inc/header.php";
    include "../functions/Utils.php";
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id_user = '$id'";
	$result = $mysqli -> query($query);
	$objUser = mysqli_fetch_assoc($result)
?>

	<!--//header-->
	
	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
				<section class="three-fourth">
				
					<h1>My account</h1>
					
					<!--inner navigation-->
					<nav class="inner-nav">
						<ul>
							<li><a href="#MySettings" title="Settings">Sửa tài khoản</a></li>
							<li><a href="#MyBookings" title="My Bookings">Đơn đặt tour</a></li>
							
						</ul>
					</nav>
					<!--//inner navigation-->
					
					
					
					<section id="MySettings" class="tab-content">
						<article class="mysettings">
							<h1>Sửa tài khoản</h1>
						
							<?php
                                if(isset($_GET['msg'])){
                                    if($_GET['msg'] == 1){
                            ?>
                                        <p style="color: green">Xửa thành công</p>
                            <?php
                                        
                                    } else{
                    		?>
                    					<p style="color: red">Xửa thất bại</p>
                    		<?php
                                        
                                    }
                                }
                            ?>
							<form action="EditAccount.php?id=<?php echo $id ?>" method="post">
								<table>
									<tr>
										<th>Username</th>
										<td>
											<!--edit fields-->
											<div class="">
												<input type="text"  disabled = "disabled" value="<?php echo $objUser['username'] ?>"/>
											</div>
										</td>
									</tr>
									<tr>
										<th>Fullname</th>
										<td>
											<!--edit fields-->
											<div class="">
												<input type="text" name="fullname" value="<?php echo $objUser['fullname'] ?>" />
											</div>
										</td>
									</tr>
									<tr>
										<th>Password</th>
										<td>
											<div class="">
												<input type="password" name="password" />
											</div>
										</td>
									</tr>
									
								</table>
								<input style="margin-top: 10px; margin-left: 270px" type="submit" class="gradient-button" value="Sửa" id="next-step" />
							</form>
						</article>
					</section>
					<section id="MyBookings" class="tab-content">
						<!--booking-->
						<article class="bookings">
							<h1><a href="javascript:void(0)">Các đơn đặt tour gần đây</a></h1>
							<div class="b-info">
								<table>
								
								<?php 
									$query = "SELECT id As idPerson, name As name_orderer,phone As phone_orderer, email As mail_orderer, address As address_orderer, note As note_orderer, num_passenger, idDetail, date_ordered FROM personorder WHERE id_user = '{$id}'";
                            		$result = $mysqli -> query($query);
                            		
                                    while ($objPersonOrder = mysqli_fetch_assoc($result)) {
                                        
                                       
                                ?>
									<tr>
										<th><?php  echo $objPersonOrder['name_orderer'] ?></th>
									</tr>
								<?php 
									}
								?>
								</table>
							</div>
							<div class="actions">
							<?php 
								$query = "SELECT id As idPerson, name As name_orderer,phone As phone_orderer, email As mail_orderer, address As address_orderer, note As note_orderer, num_passenger, idDetail, date_ordered FROM personorder WHERE id_user = '{$id}'";
                        		$result = $mysqli -> query($query);
                        		
                                while ($objPersonOrder = mysqli_fetch_assoc($result)) {
                                    
                                   
                            ?>
								<a href="view.php?id=<?php echo $objPersonOrder['idPerson'] ?>" class="gradient-button">Xem</a>

							<?php 
								}
							?>
							</div>
						</article>
					</section>
				</section>
				
			</div>
			<!--//main content-->
		</div>
	</div>
	


<?php
    include "../templates/public/inc/footer.php"
?>