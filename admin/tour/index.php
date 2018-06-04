
<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
?>
<!DOCTYPE html>
<html lang="en">
    <?php
        include "../../templates/admin/inc/header.php"
    ?>
    <body>
        <!--Preloader-->
        <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div>
        <!--/Preloader-->
        <div class="wrapper theme-4-active pimary-color-red">
            <!-- Top Menu Items -->
            <?php
                include "../../templates/admin/inc/nav_bar.php"
            ?>
            <!-- /Top Menu Items -->
            <!-- Left Sidebar Menu -->
            <?php
                include "../../templates/admin/inc/left_bar.php"
            ?>
            <!-- /Left Sidebar Menu -->
            <!-- Right Sidebar Menu -->
            <div class="fixed-sidebar-right">
            </div>
            <!-- /Right Sidebar Menu -->
            <!-- Main Content -->
            <div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						  <h5 class="txt-dark">Tour</h5>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->
					<div class="row">
						<!-- Bordered Table -->
						<div class="col-sm-12">
							<div class="panel panel-default card-view">						
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<?php
		                                    if(isset($_GET['msg'])){
		                                        if($_GET['msg'] == 1){
		                                ?>
			                                        <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Xử lý thành công</h6>
													<hr class="light-grey-hr"/>
                                        <?php
		                                            
		                                        } else{
                                		?>
                                					<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Xảy ra lỗi trong quá trình xử lý</h6>
													<hr class="light-grey-hr"/>
                                		<?php
		                                            
		                                        }
		                                    }
		                                ?>
										<p class="text-muted">
											<a class="btn btn-success btn-anim" href="add.php">
												<span>Thêm</span>
											</a>
										</p>
										<div class="table-wrap mt-40">
											<div class="table-responsive">
											<form action="${pageContext.request.contextPath }/admin/location/del" method="post">
											  <table class="table table-hover table-bordered mb-0">
												<thead>
												  <tr>
													<th>Mã tour</th>
													<th>Tên tour</th>
													<th>Địa điểm</th>
													<th>Nơi khởi hành</th>
													<th>Số ngày</th>
													<th>Giảm giá</th>
													<th>Dòng tour</th>
													<th>Ảnh</th>
													<th>Chi tiết</th>
													<th class="text-nowrap">Chức năng</th>
													
												  </tr>
												</thead>
												<tbody>
												

												<?php 
													$query = "SELECT t.id As idTour, t.name As nameTour, l.name As nameLocation, d.name As nameDeparture, date_created, number_days, item_tour, discount, images, programs, note FROM tour As t  INNER JOIN locations As l ON t.id_location = l.id INNER JOIN departures As d ON t.id_departure = d.id ORDER BY idTour DESC";
															
                                            		$result = $mysqli -> query($query);
                                            		
		                                            while ($objTour = mysqli_fetch_assoc($result)) {
		                                                $idTour = $objTour['idTour'];
		                                                $nameTour = $objTour['nameTour'];
		                                               	$nameLocation = $objTour['nameLocation'];
		                                               	$nameDeparture = $objTour['nameDeparture'];
		                                               	$number_days = $objTour['number_days'];
		                                               	$discount = $objTour['discount'];
		                                               	$item_tour = $objTour['item_tour'];
		                                        ?>
													
													  <tr>
														<td><?php echo $idTour; ?></td>
														<td><a href="edit.php?id=<?php echo $idTour; ?>"><?php echo $nameTour; ?></a></td>
														<td><?php echo $nameLocation; ?></td>
														<td><?php echo $nameDeparture; ?></td>
														<td><?php echo $number_days; ?></td>
														<td><?php echo $discount; ?></td>
														<td><?php echo $item_tour; ?></td>
														<td><img style="width: 120px; height: 90px" alt="" src="../../upload/<?php echo $objTour['images']; ?>" /></td>
				                                       	<td class="text-nowrap">
															<a href="indexdetail.php?id=<?php echo $idTour; ?>" class="text-inverse pl-20" title="" data-toggle="tooltip" data-original-title="Detail"><i class="zmdi zmdi-balance-wallet txt-warning"></i></a>
														</td>
														<td class="text-nowrap">
															<a href="edit.php?id=<?php echo $idTour; ?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="Edit"><i class="zmdi zmdi-edit txt-warning"></i></a>
															
															<a href="DelController.php?id=<?php echo $idTour; ?>" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>
														</td>
														
													  </tr>

												<?php 
													}
												?>
												
												</tbody>
											  </table>
											</form>
											</div>
											
										
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- /Bordered Table -->
						
					</div>
					
				</div>               
                <!-- Footer -->
                <?php
                    include "../../templates/admin/inc/footer.php"
                ?>
                <!-- /Footer -->
            </div>
            <!-- /Main Content -->
        </div>
        
        <!-- JavaScript -->
        <!-- Piety JavaScript -->
         <script type="text/javascript">
            $(document).ready(function() {
                  $(".select2").select2();
                  $('#datetimepicker1').datetimepicker({
                        defaultDate: moment(),
                        sideBySide: true,
                        locale: 'vi'
                  });
            });
        </script>
    </body>
</html>