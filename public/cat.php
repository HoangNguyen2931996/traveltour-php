<?php
	include "../functions/DbConnect.php";
    include "../templates/public/inc/header.php";
    include "../functions/Utils.php";
    $id = $_GET['id'];
    $queryLocation = "SELECT * FROM locations WHERE id = '{$id}'";
	$resultLoction = $mysqli -> query($queryLocation);
	$objLocation = mysqli_fetch_assoc($resultLoction );
?>

	<!--//header-->
	
	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
				<nav role="navigation" class="breadcrumbs clearfix">
					<!--crumbs-->
					<ul class="crumbs">
						<li><a href="${pageContext.request.contextPath }/" title="Home">Home</a></li> 
						<li><?php echo $objLocation['name'] ?></li>                                       
					</ul>
					<!--//crumbs-->
				</nav>

				<!--three-fourth content-->
				<section class="three-fourth">
				
					<h1><?php echo $objLocation['name'] ?></h1>
					
					<section id="hotels" class="tab-content" style="width: 100%">
						<div class="deals">
						<?php 
						
							$query = "SELECT t.id As idTour, t.name As nameTour, number_days, discount, note, images, item_tour FROM tour As t INNER JOIN locations As l ON t.id_location = l.id WHERE l.id_parent = '{$id}' OR l.id = '{$id}' ORDER BY t.id DESC";
		            		$result = $mysqli -> query($query);
		            		
		                    while ($objTour = mysqli_fetch_assoc($result)) {
		                    	$idTour = $objTour['idTour'];
		                    	$queryDetail = "SELECT d.id As idDetail, date_depart, price, slot, time_depart FROM detailtour As d 	WHERE d.id_tour = '{$idTour}' ORDER BY date_depart ASC LIMIT 1";
		            			$resultDetail= $mysqli -> query($queryDetail);
		            			$objDetail = mysqli_fetch_assoc($resultDetail);
		            			if($objDetail){
		            				
		                  			$idDetail = $objDetail['idDetail'];
		                  			$price = $objDetail['price'];
		                  			$queryCount = "SELECT COUNT(*) AS slot_ordered FROM traveler As t INNER JOIN personorder As p ON t.id_personorder = p.id WHERE p.idDetail = '{$idDetail}'";
			            			$resultCount= $mysqli -> query($queryCount);
			            			$slotEmpty = $objDetail['slot'];
			            			$objCount = mysqli_fetch_assoc($resultCount);
			            			if($objCount){
			            				
			            				$slotEmpty = slotEmpty($slotEmpty, $objCount['slot_ordered']);
			            			}
			            			$date_depart = convertDate($objDetail['date_depart']);
			            			$time_depart = $objDetail['time_depart'];
		            			} else{
		            				$idDetail = 0;
		            				$price = 0;
		            				$slotEmpty = 0;
		            				$date_depart = convertDate('0000-00-00');
		            				$time_depart = "00:00";
		            			}
		                       	

		                ?>
						
						
							<article class="full-width <?php if($objTour['discount'] > 0){ echo 'promo';} ?> ">
								<?php if($objTour['discount'] > 0){ echo "<div class='ribbon-small'>- ".$objTour['discount']."%</div>";} ?>
								

								<figure><a href="detail.php?id=<?php echo $idDetail; ?>" title=""><img src="../upload/<?php echo $objTour['images']; ?>" alt="" width="270" height="152" /></a></figure>
								<div class="details">
									<h1 style="width:450px; max-width:  100%"><?php echo substr( $objTour['nameTour'],  0, 45).'...'; ?></h1>
									
									<span class="address">Khởi hành: <?php echo $date_depart;  ?> <?php echo $time_depart ?></span>
									<span class="address">Số ngày: <?php echo $objTour['number_days']; ?></span>
									<span class="price">Giá/1 người<em><?php echo number_format($price)  ?> VNĐ</em> </span>
									<span class="address">Số chỗ còn nhận: <?php echo $slotEmpty ?></span>
									<span class="address">Dòng tour: <?php echo $objTour['item_tour']; ?></span>
									<a href="detail.php?id=<?php echo $idDetail; ?>" title="Book now" class="gradient-button">Chi tiết</a>
								</div>
							</article>
						
						<?php 
							}	
						?>
						
							<!--//bottom navigation-->
						</div>
					</section>
				</section>
				<!--//three-fourth content-->
				
				<!--sidebar-->
				<aside class="right-sidebar">
				
					<article class="default clearfix">
						<h2>Điểm đến yêu thích</h2>
						<?php 
				
							$query = "SELECT t.id_location As id,l.name As nameLocation, SUM(num_passenger) As sum_passenger,t.id As id_tour, t.images FROM personorder As p INNER JOIN detailtour As d ON p.idDetail = d.id INNER JOIN tour AS t ON d.id_tour =t.id INNER JOIN locations AS l ON l.id = t.id_location GROUP BY t.id_location ";
			        		$result = $mysqli -> query($query);
			        		
			                while ($objPrefer = mysqli_fetch_assoc($result)) {
			                	

			            ?>	
						<div class="deal-of-the-day">
							<a href="cat.php?id=<?php echo $objPrefer['id']; ?>">
								<figure><img src="../upload/<?php echo $objPrefer['images']; ?>" alt="" width="230" height="130" /></figure>
								<h3><?php echo $objPrefer['nameLocation']; ?>
								</h3>
								<p>Đã có <span class="price"><?php echo $objPrefer['sum_passenger']; ?><small> lượt khách</small></span></p>
							</a>
						</div>
						<?php 
							}
						?>
					</article>
				
				</aside>
				<!--//sidebar-->
			</div>
			<!--//main content-->
		</div>
	</div>
	


<?php
    include "../templates/public/inc/footer.php"
?>