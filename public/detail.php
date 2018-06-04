<?php
	include "../functions/DbConnect.php";
    include "../templates/public/inc/header.php";
    include "../functions/Utils.php";
    $id = $_GET['id'];
    $queryDetail = "SELECT d.id As idDetail, date_depart,time_depart , price, d.id_tour As idTour, t.name As nameTour, time_depart, address_depart, slot, images, discount, item_tour, programs, note, t.discount FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id = '{$id}'";
	$resultDetail= $mysqli -> query($queryDetail);
	$objDetail = mysqli_fetch_assoc($resultDetail);
	$idTour = $objDetail['idTour'];
?>

	<!--//header-->
	
<style>
  #default img {
	 display: inline;
	}
	.star img {
	 display: inline;
	}
</style>
	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
				<!--breadcrumbs-->
				<nav role="navigation" class="breadcrumbs clearfix">
					<!--crumbs-->
					<ul class="crumbs">
						<li><a href="javascript:void(0)" title="Home"><?php echo $objDetail['nameTour']?></a></li>
						                                   
					</ul>
				</nav>
				<!--//breadcrumbs-->

				<!--hotel three-fourth content-->
				<section class="three-fourth">
					<!--gallery-->
					<section class="gallery">
						<img src="../upload/<?php echo $objDetail['images']; ?>" alt="" width="850" height="531" />
					</section>
					<!--//gallery-->
				
					<!--inner navigation-->
					<nav class="inner-nav">
						<ul>
							<li class="description"><a href="#description" title="Description">Chi tiết</a></li>
							<li class="facilities"><a href="#facilities" title="Facilities">Chương trình</a></li>
							<li class="availability"><a href="#availability" title="Availability">Ngày khác</a></li>
							<li class="things-to-do"><a href="#things-to-do" title="Things to do">Lưu ý</a></li>
							
						</ul>
					</nav>
					<section id="description" class="tab-content">
						<article>
							<h1>Thông tin cơ bản</h1>
							<div class="text-wrap">
								<p>Tên tour: <?php echo $objDetail['nameTour']?></p>
								<p>Khởi hành: <?php echo convertDate($objDetail['date_depart'])  ?> <?php echo $objDetail['time_depart'] ?></p>
								<?php 
									$queryCount = "SELECT COUNT(*) AS slot_ordered FROM traveler As t INNER JOIN personorder As p ON t.id_personorder = p.id WHERE p.idDetail = '{$id}'";
			            			$resultCount= $mysqli -> query($queryCount);
			            			$slotEmpty = $objDetail['slot'];
			            			$objCount = mysqli_fetch_assoc($resultCount);
			            			if($objCount){
			            				
			            				$slotEmpty = slotEmpty($slotEmpty, $objCount['slot_ordered']);
			            			}
								?>
								<p>Số chỗ còn nhận: <?php echo $slotEmpty ?> chỗ</p>
								<p>Dòng tour: <?php echo $objDetail['item_tour'] ?></p>
								<p>Nơi tập trung: <?php echo $objDetail['address_depart'] ?></p>
							</div>
							
							
							<h1>Giá tour và phụ thu phòng đơn</h1>
							<div class="text-wrap">	
								<p>Giá trên 1 người: <?php echo number_format($objDetail['price'])  ?> VNĐ</p>
								
							</div>
						</article>
					</section>
					<section id="facilities" class="tab-content">
						<article>
							<h1>Chương trình của tour</h1>
							<div class="text-wrap">	
								<p><?php echo $objDetail['programs'] ?></p>
							</div>
						</article>
					</section>
					<!--availability-->
					<section id="availability" class="tab-content">
						<h1>Các ngày khác</h1>
						<div class="deals">
						<?php 
						
							$query = "SELECT d.id As idDetail, date_depart,time_depart , price,  d.id_tour As idTour, t.name As nameTour, time_depart, address_depart, slot, images, discount, item_tour, programs, number_days FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id != '{$id}' && d.id_tour = '{$idTour}'";
		            		$result = $mysqli -> query($query);
		            		
		                    while ($objTour = mysqli_fetch_assoc($result)) {
		                    	$idDetail = $objTour['idDetail'];

	                    		$queryCount = "SELECT COUNT(*) AS slot_ordered FROM traveler As t INNER JOIN personorder As p ON t.id_personorder = p.id WHERE p.idDetail = '{$idDetail}'";
		            			$resultCount= $mysqli -> query($queryCount);
		            			$slotEmpty = $objTour['slot'];
		            			$objCount = mysqli_fetch_assoc($resultCount);
		            			if($objCount){
		            				
		            				$slotEmpty = slotEmpty($slotEmpty, $objCount['slot_ordered']);
		            			}
		                       	

		                ?>
						
							<article class="full-width <?php if($objTour['discount'] > 0){ echo 'promo';} ?>">
								<?php if($objTour['discount'] > 0){ echo "<div class='ribbon-small'>- ".$objTour['discount']."%</div>";} ?>
								<figure><a href="detail.php?id=<?php echo $objTour['idDetail']; ?>" title=""><img src="../upload/<?php echo $objTour['images']; ?>" alt="" width="270" height="152" /></a></figure>
								<div class="details">
									<h1 style="width:400px; max-width:  100%"><?php echo substr( $objTour['nameTour'],  0, 45).'...'; ?></h1>
									
									<span class="address">Khởi hành: <?php echo convertDate($objTour['date_depart'])  ?> <?php echo $objTour['time_depart']?></span>
									<span class="address">Số ngày: <?php echo $objTour['number_days']?></span>
									<span class="price">Giá/1 người<em><?php echo number_format($objTour['price'])  ?> VNĐ</em> </span>
									<span class="address">Số chỗ còn nhận: <?php echo $slotEmpty  ?> chỗ</span>
									<span class="address">Dòng tour: <?php echo $objTour['item_tour']?></span>
									<a href="detail.php?id=<?php echo $objTour['idDetail']; ?>" title="Book now" class="gradient-button">Chi tiết</a>
								</div>
							</article>
							<!--//deal-->
						<?php 
							}
						?>	
							<!--//bottom navigation-->
						</div>
					</section>
					<section id="things-to-do" class="tab-content">
						<article>
							<h1>Lưu ý</h1>
							<div class="text-wrap">	
								<p><?php echo $objDetail['note'] ?></p>
							</div>
						</article>
					</section>
					
					
				</section>
				<!--//hotel content-->
				
				<!--sidebar-->
				<aside class="right-sidebar">
					<!--hotel details-->
					<article class="hotel-details clearfix">
						
						<span class="address"><?php echo $objDetail['nameTour']  ?></span>
					
						<div class="description">
							<p>Giá trên 1 người : <?php echo number_format($objDetail['price'])  ?> VNĐ</p>
							
						</div>
						
							<div class="details">
							
								<h4>Giảm giá <?php echo  $objDetail['discount'] ?> %</h4>
							
								<a style="margin-left: 70px" href="bookstep1.php?id=<?php echo $objDetail['idDetail']  ?>" title="Explore our deals" class="gradient-button">Đặt ngay</a>
							</div>
						
					</article>
					
					
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
					<!--//Deal of the day-->
				</aside>
				<!--//sidebar-->
			</div>
			<!--//main content-->
		</div>
	</div>
	


<?php
    include "../templates/public/inc/footer.php"
?>