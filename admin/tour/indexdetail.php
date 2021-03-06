
<?php 
	session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
	include "../../functions/DbConnect.php";
	include "../../functions/Utils.php";
	$id = $_GET['id'];
    $query = "SELECT t.id As idTour, t.name As nameTour, t.id_location, l.name As nameLocation, t.id_departure, l.name As nameLocation, d.name As nameDeparture, date_created, number_days, item_tour, discount, images, programs, note FROM tour As t INNER JOIN locations As l ON t.id_location = l.id INNER JOIN departures As d ON t.id_departure = d.id WHERE t.id = '{$id}'";
    $result = $mysqli -> query($query);
    $objTour = mysqli_fetch_assoc($result);
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
					<div class="row heading-bg">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						  <h5 class="txt-dark">Chi tiết tour: <?php echo $objTour['nameTour']?></h5>
						</div>
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
											<a class="btn btn-success btn-anim" href="adddetail.php?id=<?php echo $id ?>">
												<span>Thêm</span>
											</a>
										</p>
										<div class="table-wrap mt-40">
											<div class="table-responsive">
											  <table class="table table-hover table-bordered mb-0">
												<thead>
												  <tr>
												  	<th>ID</th>
													<th>Ngày khởi hành</th>
													<th>Giờ khởi hành</th>
													<th>Nơi tập trung</th>
													<th>Giá trên 1 người</th>
													
													
													<th>Số chỗ</th>
													<th class="text-nowrap">Action</th>
												  </tr>
												</thead>
												<tbody>
												<?php 
													$query = "SELECT d.id As idDetail, date_depart, price, d.id_tour As id_tour, time_depart, address_depart, slot FROM detailtour As d WHERE d.id_tour = '{$id}'";
															
                                            		$result = $mysqli -> query($query);
                                            		
		                                            while ($objDetail = mysqli_fetch_assoc($result)) {
		                                                $idDetail = $objDetail['idDetail'];
		                                                $date_depart = $objDetail['date_depart'];
		                                                $time_depart = $objDetail['time_depart'];
		                                               	$address_depart = $objDetail['address_depart'];
		                                               	$price = $objDetail['price'];
		                                               
		                                               	
		                                               	$slot = $objDetail['slot'];
		                                        ?>
														  <tr>
															<td><?php echo $idDetail ?></td>
															<td><?php echo convertDate($date_depart) ?></td>
															<td><?php echo $time_depart ?></td>
															<td><?php echo $address_depart ?></td>
															<td><?php echo $price ?></td>
															
														
															<td><?php echo $slot ?></td>
															
															<td class="text-nowrap">
																<a href="editdetail.php?id=<?php echo $idDetail; ?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="Edit"><i class="zmdi zmdi-edit txt-warning"></i></a>
																<a href="DelDetailController.php?id=<?php echo $idDetail; ?>&idTour=<?php echo $id ?>" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>
															</td>
														  </tr>
												<?php 
													}
												?>
											  </table>
											</div>
										</div>
										
									</div>
									<div class="form-actions mb-20" >
										<a href="index.php" type="button" class="btn btn-warning pull-left">Trở về</a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						</div>
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
        <script type="text/javascript" src="../../templates/admin/js/jquery.treegrid.min.js"></script>
		<script type="text/javascript" src="../../templates/admin/js/jquery.treegrid.bootstrap3.js"></script>
         <script type="text/javascript">
            $(document).ready(function() {
			    $('.tree').treegrid({
			    	expanderExpandedClass: 'glyphicon glyphicon-minus',
			        expanderCollapsedClass: 'glyphicon glyphicon-plus',
			      'initialState': 'collapsed',
			    });
			});
        </script>
    </body>
</html>