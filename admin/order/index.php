
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
						  <h5 class="txt-dark">Đơn đặt hàng</h5>
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
										<div class="form-wrap mt-40">
										</div>
										<div class="table-wrap mt-40">
											<div class="table-responsive">
											  <table class="table table-hover table-bordered mb-0">
												<thead>
												  <tr>
													<th>Tên</th>
													<th>Email</th>
													<th>Số điện thoại</th>
													<th>Địa chỉ</th>
													<th>Thông tin thêm</th>
													<th>Số khách</th>
													<th>Thời gian đặt</th>
													<th class="text-nowrap">Chức năng</th>
												  </tr>
												</thead>
												<tbody>
												<?php 
													$query = "SELECT id As idPerson, name As name_orderer,phone As phone_orderer, email As mail_orderer, address As address_orderer, note As note_orderer, num_passenger, idDetail, date_ordered FROM personorder ORDER BY idPerson DESC";
                                            		$result = $mysqli -> query($query);
                                            		
		                                            while ($objOrder = mysqli_fetch_assoc($result)) {
		                                            	$idPerson = $objOrder['idPerson'];
		                                                $name_orderer = $objOrder['name_orderer'];
		                                                $mail_orderer = $objOrder['mail_orderer'];
		                                                $phone_orderer = $objOrder['phone_orderer'];
		                                                $address_orderer = $objOrder['address_orderer'];
		                                                $note_orderer = $objOrder['note_orderer'];
		                                                $num_passenger = $objOrder['num_passenger'];
		                                                $date_ordered = $objOrder['date_ordered'];
		                                                
		                                               
		                                        ?>
													  <tr>
														<td><?php echo $name_orderer ?></td>
														<td><?php echo $mail_orderer ?></td>
														<td><?php echo $phone_orderer ?></td>
														<td><?php echo $address_orderer ?></td>
														<td><?php echo $note_orderer ?></td>
														<td><?php echo $num_passenger ?></td>
														<td><?php echo $date_ordered ?></td>
														<td class="text-nowrap">
															<a href="view.php?id=<?php echo $idPerson ?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="View"><i class="zmdi zmdi-eye txt-warning"></i></a>
															<a href="DelController.php?id=<?php echo $idPerson ?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>
														</td>
													  </tr>
												<?php 
													}
												?>
												</tbody>
											  </table>
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