<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    } 
    include "../../functions/DbConnect.php";
    $id = $_GET['id'];
    $query = "SELECT d.id As idDetail, date_depart,time_depart , price, d.id_tour As idTour,  t.name As nameTour, time_depart, address_depart, slot, images, item_tour, programs, note, t.discount FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id = '{$id}'";
    $result = $mysqli -> query($query);
    $objDetail = mysqli_fetch_assoc($result);
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
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                          <h5 class="txt-dark">Sửa chi tiết tour: <?php echo $objDetail['nameTour'] ?></h5>
                        </div>
                        
                        <!-- /Breadcrumb -->
                    </div>
                    <!-- /Title -->
                    
                    <!-- Row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="form-wrap">
                                            <form action="EditDetailController.php?id=<?php echo $objDetail['idDetail'] ?>&idTour=<?php echo $objDetail['idTour'] ?>" method="post">
                                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10 text-left">Ngày khởi hành</label>
                                                            <div class='input-group date' id='datetimepicker1'>
                                                                <input type='text' class="form-control" name="string_date_depart" value="<?php echo $objDetail['date_depart'] ?>"/>
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10 text-left">Giờ khởi hành</label>
                                                            <div class='input-group date' id='datetimepicker2'>
                                                                <input type='text' class="form-control" name="time_depart" value="<?php echo $objDetail['time_depart'] ?>"/>
                                                                <span class="input-group-addon">
                                                                    <span class="fa fa-calendar"></span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Địa điểm tập trung</label>
                                                            <input name="address_depart" type="text" class="form-control" value="<?php echo $objDetail['address_depart'] ?>"placeholder="Địa điểm tập trung">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Giá trên 1  người</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">VNĐ</div>
                                                                <input name="price" type="text" class="form-control" id="exampleInputuname" placeholder="" value="<?php echo $objDetail['price'] ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Số chỗ</label>
                                                            <input name="slot" type="text" class="form-control" placeholder="Số chỗ" value="<?php echo $objDetail['slot'] ?>">
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Sửa</span></button>
                                                    <a href="indexdetail.php?id=<?php echo $objDetail['idTour'] ?>" type="button" class="btn btn-warning pull-left">Trở về</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Row -->
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
                        format: 'YYYY-MM-DD'
                  });
                  $('#datetimepicker2').datetimepicker({
                        defaultDate: moment(),
                        sideBySide: true,
                        format: 'hh:mm'
                  });
            });
        </script>
    </body>
</html>