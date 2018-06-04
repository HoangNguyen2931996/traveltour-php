<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
    include "../../functions/DbConnect.php";
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
    <!-- Title -->
                    <div class="row heading-bg">
                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <h5 class="txt-dark">Thêm tour</h5>
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
                                            <form action="EditController.php?id=<?php echo $objTour['idTour']?>" method="post" enctype="multipart/form-data">
                                        
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Tên tour</label>
                                                            <input name="nameTour" type="text" id="firstName" class="form-control" placeholder="Tên tour" value="<?php echo $objTour['nameTour']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Địa điểm</label>
                                                            <select name="id_location" class="form-control select2" data-placeholder="Choose a Category" tabindex="1">
                                                            <?php 
                                                                $query = "SELECT * FROM locations";
                                                                $result = $mysqli -> query($query);
                                                                
                                                                while ($objLocation = mysqli_fetch_assoc($result)) {
                                                                    $id = $objLocation['id'];
                                                                    $name = $objLocation['name'];
                                                                    $idParent = $objLocation['id_parent'];
                                                                    if($idParent != 0){
                                                                    

                                                            ?>
                                                                        <option <?php if($objTour['id_location'] == $id){ echo "selected = 'selected'";} ?> value="<?php echo $id; ?>"><?php echo $name; ?></option>
                                                            <?php 
                                                                    }
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Nơi khởi hành</label>
                                                            <select name="id_departure" class="form-control select2" data-placeholder="Choose a Category" tabindex="1">
                                                                <?php 
                                                                    $query = "SELECT * FROM departures";
                                                                    $result = $mysqli -> query($query);
                                                                    
                                                                    while ($objDeparture = mysqli_fetch_assoc($result)) {
                                                                        $id = $objDeparture['id'];
                                                                        $name = $objDeparture['name'];
                                                                       
                                                                ?>
                                                                    <option <?php if($objTour['id_departure'] == $id){ echo "selected = 'selected'";} ?> value="<?php echo $id?>"><?php echo $name?></option>
                                                                <?php 
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Số ngày</label>
                                                            <input name="number_days" type="text" id="number_days" class="form-control" placeholder="Số ngày" value="<?php echo $objTour['number_days'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Giảm giá</label>
                                                            <div class="input-group">
                                                                <div class="input-group-addon">%</div>
                                                                <select name="discount" class="form-control select2" data-placeholder="Choose a brand" tabindex="1">
                                                                <?php 
                                                                    for ($i=0; $i < 100; $i++) {                                                                     
                                                                ?>
                                                                    <option <?php if($objTour['discount'] == $i){ echo "selected = 'selected'";} ?> value="<?php echo $i?>"><?php echo $i?></option>
                                                                <?php 
                                                                    }
                                                                ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Dòng tour</label>
                                                            <div class="radio-list">
                                                                <div class="radio-inline pl-0">
                                                                    <div class="radio radio-info">
                                                                        <input type="radio" name="itemTour" id="radio1" value="1" <?php if($objTour['item_tour'] == 'Tiêu chuẩn'){ echo "checked";} ?>>
                                                                        <label for="radio1">Tiêu chuẩn</label>
                                                                    </div>
                                                                </div>
                                                                <div class="radio-inline">
                                                                    <div class="radio radio-info">
                                                                        <input type="radio" name="itemTour" id="radio2" value="0" <?php if($objTour['item_tour'] == "Cao cấp"){ echo "checked";} ?>>
                                                                        <label for="radio2">Cao cấp</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="seprator-block"></div>
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-comment-text mr-10"></i>Chương trình</h6>
                                                <hr class="light-grey-hr"/>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="programs" class="form-control" rows="4" id="programs" ><?php echo $objTour['programs']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                                <div class="seprator-block"></div>
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-comment-text mr-10"></i>Lưu ý</h6>
                                                <hr class="light-grey-hr"/>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <textarea name="note" class="form-control" rows="4" id="note"><?php echo $objTour['note']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="seprator-block"></div>
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-collection-image mr-10"></i>Ảnh chính</h6>
                                                <hr class="light-grey-hr"/>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <input name="picture" type="file" class="upload" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Ảnh cũ</label>
                                                            <img class="form-control" style="width: 120px; height: 90px" alt="" src="../../upload/<?php echo $objTour['images']; ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Sửa</span></button>
                                                    <a href="index.php" type="button" class="btn btn-warning pull-left">Trở về</a>
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
                        locale: 'vi'
                  });
            });
        </script>
    </body>
</html>