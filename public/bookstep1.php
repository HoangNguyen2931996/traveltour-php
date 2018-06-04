
<?php
    
	include "../functions/DbConnect.php";
    include "../templates/public/inc/header.php";
    if(!isset($_SESSION['username'])){
        header("location:login.php");
    }
    include "../functions/Utils.php";

    $id = $_GET['id'];
    $queryDetail = "SELECT d.id As idDetail, date_depart,time_depart , price, d.id_tour As idTour, t.name As nameTour, time_depart, address_depart, slot, images, discount, item_tour, programs, note, t.discount FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id = '{$id}'";
	$resultDetail= $mysqli -> query($queryDetail);
	$objDetail = mysqli_fetch_assoc($resultDetail);


	$idUser = $_SESSION['idUser'];
	$queryUser = "SELECT * FROM user WHERE id_user = '{$idUser}'";
	$resultUser= $mysqli -> query($queryUser);
	$objUser = mysqli_fetch_assoc($resultUser);
	
?>

	<div class="main" role="main">		
		<div class="wrap clearfix">
			<!--main content-->
			<div class="content clearfix">
					<section class="three-fourth">
						<form id="booking" method="post" action="BookTourController.php?id=<?php echo $id ?>" class="booking">
							<fieldset id="infor_order" idDetail="<?php echo $id ?>">
								
								<?php
                                    if(isset($_GET['msg'])){
                                        if($_GET['msg'] == 1){
                                ?>
	                                        <p style="color: green; font-weight: bold;">Đặt tour thành công</p>
                                <?php
                                            
                                        } else{
                        		?>
                        					<p style="color: red; font-weight: bold;">xảy ra lỗi trong quá trình xử lý</p>
                        		<?php
                                            
                                        }
                                    }
                                ?>
								<h3><span>01 </span>Thông tin liên lạc</h3>
								
								<div class="row twins">
									<div class="f-item">
										<label for="name_orderer">Họ và tên</label>
										<input type="text" id="name_orderer" name="name_orderer" value="<?php echo $objUser['fullname'] ?>"/>
									</div>
									<div class="f-item">
										<label for="mail_orderer">Email</label>
										<input type="text" id="mail_orderer" name="mail_orderer" value=""/>
									</div>
								</div>
								
								<div class="row twins">
									<div class="f-item">
										<label for="phone_orderer">Điện thoại</label>
										<input type="text" id="phone_orderer" name="phone_orderer" />
									</div>
									<div class="f-item">
										<label for="address_orderer">Địa chỉ</label>
										<input type="text" id="address_orderer" name="address_orderer" />
									</div>
								</div>
								<div class="row">
									<div class="f-item">
										<label for="number_adults">Số người</label>
										<input type="number" id="number_adults" name="number" value="1" />
									</div>
									
								</div>
								<div class="row">
									<div class="f-item">
										<label>Ghi chú</label>
										<textarea rows="10" cols="10" name="note_orderer"></textarea>
									</div>
								</div>
							</fieldset>
							<script type="text/javascript">
								$("#number_adults").on("change paste keyup", function() {
				               		if($(this).val() < 1){
				               			$(this).val(1);
				               		}
				               		var parent = $(this).closest('.three-fourth');
			                   		var idDetail = parent.find('#infor_order').attr('idDetail');
				               		var  numberAdults = $(this).val();
		                     		$.ajax({
		 		       					url: 'BookForAdults.php',
		 		       					type: 'POST',
		 		       					cache: false,
		 		       					data: {
		 		       						NumberAdults: numberAdults,
		 		       						IdDetail: idDetail
		 		       					},
		 		       					success: function(data){
		 		       						$("#adults").html(data)
		 		       					},
		 		       					error: function (){
		 		       					}
		 		       				});
		            			 });
								
								 
							</script>
							<div id="adults" style="margin-top: 20px">
								<fieldset>
									<h3>Thông tin người đi<i></i> thứ 1</h3>
									<div class="row triplets">
										<div class="f-item">
											<label for="name_traveler">Họ và tên</label>
											<input type="text"  name="name_traveler[]" value="" />
										</div>
										<div class="f-item">
											<label>Giới tính</label>
											<select name="gender_traveler[]">
												<option value="0" selected="selected">Nam</option>
												<option value="1">Nữ</option>
											</select>
										</div>
										<div class="f-item datepicker">
											<label for="birth_traveler[]">Ngày sinh</label>
											<div class="datepicker-wrap"><input type="text"  name="birth_traveler" /></div>
										</div>
									</div>
									
									
									<div class="row">
										<div class="f-item">
											<label>Trị giá: <span style="color:red" id="price_travel_adults_1"><?php echo $objDetail['price']; ?></span> </label>
										</div>
									</div>
								</fieldset>
							</div>
							
							<input type="submit" class="gradient-button" value="Đặt tour" id="next-step" />
						</form>
					</section>
				
				<!--right sidebar-->
				<aside class="right-sidebar">
					<!--Booking details-->
					<article class="booking-details clearfix">
						<h1><?php echo substr($objDetail['nameTour'],  0, 15).'...'; ?>
							
						</h1>
					
						
						<div class="booking-info">
							<h6>Tên tour</h6>
							<p><?php echo $objDetail['nameTour']; ?></p>
							
							<h6>Khởi hành</h6>
							<p><?php echo convertDate($objDetail['date_depart'])  ?> <?php echo $objDetail['time_depart']?></p>
							<h6>Nơi tập trung</h6>
							<p><?php echo $objDetail['address_depart']; ?></p>
							<h6>Số chỗ còn nhận</h6>
						<?php 

							$queryCount = "SELECT COUNT(*) AS slot_ordered FROM traveler As t INNER JOIN personorder As p ON t.id_personorder = p.id WHERE p.idDetail = '{$id}'";
	            			$resultCount= $mysqli -> query($queryCount);
	            			$slotEmpty = $objDetail['slot'];
	            			$objCount = mysqli_fetch_assoc($resultCount);
	            			if($objCount){
	            				
	            				$slotEmpty = slotEmpty($slotEmpty, $objCount['slot_ordered']);
	            			}
						?>
							<p><?php echo $slotEmpty ?> chỗ</p>
							<h6>Dòng tour</h6>
							<p><?php echo $objDetail['item_tour']; ?></p>
						</div>
						<div class="price">
							<h2>Giá</h2>
							<p>Giá trên 1 người: <?php echo $objDetail['price']; ?></p>
							
							<p>Giảm giá: <?php echo $objDetail['discount']; ?>%</p>
						</div>
					</article>
				</aside>
				<!--//right sidebar-->
			</div>
			<!--//main content-->
		</div>
	</div>
	


<?php
    include "../templates/public/inc/footer.php"
?>