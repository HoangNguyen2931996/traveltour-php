<?php
	include "../functions/DbConnect.php";
    include "../templates/public/inc/header.php";
    include "../functions/Utils.php";
?>

	<!--//header-->
	
	<section class="slider clearfix">
		<div id="sequence">
			<ul>
			<?php 
				$query = "SELECT t.id As idTour, t.name As nameTour, number_days, discount, note, images FROM tour As t ORDER BY RAND() LIMIT 3";
        		$result = $mysqli -> query($query);
        		
                while ($objTour = mysqli_fetch_assoc($result)) {


            ?>
				<li>
					<div class="info animate-in">
						<h2><?php echo $objTour['nameTour'] ?></h2><br />
						<p>Giảm đến <?php echo $objTour['discount'] ?>%</p><br />
					</div>
					<img class="main-image animate-in" src="../upload/<?php echo $objTour['images']; ?>" alt="" />
				</li>
			<?php 
				}
			?>
			</ul>
			
		</div>
	</section>
	
	
	
	<div class="main" role="main">
		<div class="wrap clearfix">
			<section class="destinations clearfix full">
				<h1>Tour giảm giá sốc</h1>
				
				<?php 
					$i = 1;
					$query = "SELECT t.id As idTour, t.name As nameTour, number_days, item_tour, discount, note, images FROM tour As t WHERE discount > 0 ORDER BY idTour DESC LIMIT 8";
            		$result = $mysqli -> query($query);
            		
                    while ($objTourSale = mysqli_fetch_assoc($result)) {
                    	$idTour = $objTourSale['idTour'];
                    	$queryDetail = "SELECT d.id As idDetail, date_depart, price, slot, time_depart FROM detailtour As d 	WHERE d.id_tour = '{$idTour}' ORDER BY date_depart ASC LIMIT 1";
            			$resultDetail= $mysqli -> query($queryDetail);
                       	$objDetail = mysqli_fetch_assoc($resultDetail);
                  		$idDetail = $objDetail['idDetail'];

                ?>

						<article class="one-fourth <?php if($i % 4 == 0){ echo 'last';} ?> promo">
							<div class="ribbon-small">- <?php echo $objTourSale['discount']; ?> %</div>
							<figure><a href="detail.php?id=<?php echo $idDetail; ?>" title=""><img src="../upload/<?php echo $objTourSale['images']; ?>" alt="" width="270" height="152" /></a></figure>
							<div class="details">
								<a href="detail.php?id=<?php echo $idDetail; ?>" title="View all" class="gradient-button">Chi tiết</a>
								<h5> </h5>
								<span class="count"><?php echo convertDate($objDetail['date_depart'])  ?>| <?php echo $objTourSale['number_days']; ?> ngày</span>
								<div class="ribbon">
									<div class="half" >
										<a href="detail.php?id=<?php echo $idDetail; ?>" title="Chi tiết">
											<span  class="price" style="margin-left: -40px;margin-top:5px; width:inherit; font-size: 1.5em;"><?php echo number_format($objDetail['price'])  ?> VNĐ</span>
										</a>
									</div>
									<?php 
										$queryCount = "SELECT COUNT(*) AS slot_ordered FROM traveler As t INNER JOIN personorder As p ON t.id_personorder = p.id WHERE p.idDetail = '{$idDetail}'";
				            			$resultCount= $mysqli -> query($queryCount);
				            			$slotEmpty = $objDetail['slot'];
				            			$objCount = mysqli_fetch_assoc($resultCount);
				            			if($objCount){
				            				
				            				$slotEmpty = slotEmpty($slotEmpty, $objCount['slot_ordered']);
				            			}
									?>
									<div class="half">
										<a href="detail.php?id=<?php echo $idDetail; ?>" title="Chi tiết" >
											<span class="price" style="margin-left: -30px;margin-top:5px; width:inherit; font-size: 1.5em;">Còn <?php echo $slotEmpty ?> chỗ</span><br />
											<span class="price" style="margin-left: -30px; font-size: 1.3em;"><?php echo $objTourSale['item_tour']; ?></span>
										</a>
									</div>
									<?php 

									?>
								</div>
							</div>
						</article>
				
				<?php 
						
						$i = $i + 1;
					}
					
				?>
			</section>
			

			<section class="offers clearfix full">
			<?php 
				$j = 1;
				$query = "SELECT t.id_location As id,l.name As nameLocation, SUM(num_passenger) As sum_passenger,t.id As id_tour, t.images FROM personorder As p INNER JOIN detailtour As d ON p.idDetail = d.id INNER JOIN tour AS t ON d.id_tour =t.id INNER JOIN locations AS l ON l.id = t.id_location GROUP BY t.id_location LIMIT 8";
        		$result = $mysqli -> query($query);
        		
                while ($objPrefer = mysqli_fetch_assoc($result)) {
                	

            ?>	
					<article class="one-fourth <?php if($j % 4 == 0){ echo 'last';} ?>">
						<figure><a href="cat.php?id=<?php echo $objPrefer['id']; ?>" title=""><img src="../upload/<?php echo $objPrefer['images']; ?>" alt="" width="270" height="152" /></a></figure>
						<div class="details">
							<h4><?php echo $objPrefer['nameLocation']; ?>: đã có <?php echo $objPrefer['sum_passenger']; ?> lượt khách</h4>
							<a href="cat.php?id=<?php echo $objPrefer['id']; ?>" title="Explore our deals" class="gradient-button">Xem</a>
						</div>
					</article>
			<?php 
				$j = $j + 1;
				}
			?>
			</section>
		</div>
	</div>
	
	<!--//main-->
	


<?php
    include "../templates/public/inc/footer.php"
?>