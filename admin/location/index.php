
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
						  <h5 class="txt-dark">Địa điểm</h5>
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
											<a class="btn btn-success btn-anim" href="add.php">
												<span>Thêm</span>
											</a>
										</p>
										<div class="table-wrap mt-40">
											<div class="table-responsive">
											  <table class="table table-hover table-bordered mb-0 tree">
												<thead>
												  <tr>
													<th>Tên địa điểm</th>
													<th class="text-nowrap">Chức năng</th>
												  </tr>
												</thead>
												<tbody>

												<?php 
													$query = "SELECT * FROM locations";
                                            		$result = $mysqli -> query($query);
                                            		$id_table = 0;
                                            		$id_table_parent = 0;
		                                            while ($objLocation = mysqli_fetch_assoc($result)) {
		                                                $id = $objLocation['id'];
		                                                $name = $objLocation['name'];
		                                                $idParent = $objLocation['id_parent'];
		                                                if($idParent == 0){
		                                                	$id_table = $id_table + 1;
		                                                	$id_table_parent = $id_table;

		                                        ?>
		                                        			<tr class="treegrid-<?php echo $id_table ?>">
																<td><?php echo $name; ?></td>
																<td class="text-nowrap">
																	<a href="edit.php?id=<?php echo $id ;?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="Edit"><i class="zmdi zmdi-edit txt-warning"></i></a>
																	<a href="DelController.php?id=<?php echo $id ;?>" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>
																</td>
															</tr>
		                                        <?php        	
		                                                }
		                                                $resultTwo = $mysqli -> query($query);
		                                                while ($itemLocation = mysqli_fetch_assoc($resultTwo)) {
															if($id == $itemLocation['id_parent']){
																$id_table = $id_table + 1;
												?>		
																<tr class="treegrid-<?php echo $id_table ?> treegrid-parent-<?php echo $id_table_parent ?>">
																	<td style="padding-left: 100px"><?php echo $itemLocation['name']; ?></td>
																	<td class="text-nowrap">
																		<a href="edit.php?id=<?php echo $itemLocation['id']; ?>" class="text-inverse pr-10" title="" data-toggle="tooltip" data-original-title="Edit"><i class="zmdi zmdi-edit txt-warning"></i></a>
																		<a href="DelController.php?id=<?php echo $itemLocation['id']; ?>" class="text-inverse" title="" data-toggle="tooltip" data-original-title="Delete"><i class="zmdi zmdi-delete txt-danger"></i></a>
																	</td>
															  	</tr>
												<?php 
															}
													  	}
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