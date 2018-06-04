<?php 
	include "../functions/DbConnect.php";
	$numberAdults = $_POST['NumberAdults'];
	$idDetail = $_POST['IdDetail'];
	$query = "SELECT d.id As idDetail, date_depart,time_depart , price, d.id_tour As idTour, t.name As nameTour, time_depart, address_depart, slot, images, item_tour, programs, note, t.discount FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id = '{$idDetail}'";
	$result = $mysqli -> query($query);
	$objDetail = mysqli_fetch_assoc($result);
	for($i=1; $i <= $numberAdults; $i++){
?>
	<fieldset>
		<h3>Thông tin người đi thứ <?php echo $i ?></h3>
		<div class="row triplets">
			<div class="f-item">
				<label for="name_traveler">Họ và tên</label>
				<input type="text"  name="name_traveler[]" value="" />
			</div>
			<div class="f-item">
				<label>Giới tính</label>
				<select class='selectadults' name="gender_traveler[]">
					<option value="0" selected="selected">Nam</option>
					<option value="1">Nữ</option>
				</select>
			</div>
			<div class="f-item datepicker">
				<label for="birth_traveler">Ngày sinh</label>
				<div class="datepicker-wrap"><input type="text"  name="birth_traveler[]" /></div>
			</div>
		</div>
		
		<div class="row">
			<div class="f-item">
				<label>Trị giá: <span style="color:red" id="price_travel_adults_<?php echo $i ?>"><?php echo number_format($objDetail['price'])  ?> VNĐ</span> </label>
			</div>
		</div>
	</fieldset>

<?php
	}

?>
	<script type='text/javascript'>
		$( document ).ready(function() {
			$('.datepicker-wrap input').datepicker({
				showOn: 'button',
				buttonImage: '/traveltour/templates/public/images/ico/calendar.png',
				buttonImageOnly: true
			});
			$('.selectadults').uniform();
		});
		
	</script>
