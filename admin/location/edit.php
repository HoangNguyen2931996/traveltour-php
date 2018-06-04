<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
    include "../../functions/DbConnect.php";
    $id = $_GET['id'];
    $query = "SELECT * FROM locations WHERE id = '{$id}'";
    $result = $mysqli -> query($query);
    $objLocation = mysqli_fetch_assoc($result);
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
                          <h5 class="txt-dark">Sửa địa điểm</h5>
                        </div>
                        <!-- /Breadcrumb -->
                    </div>
                    <!-- /Title -->
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="form-wrap">
                                            <form id="add_cat" action="EditController.php?id=<?php echo $objLocation['id'] ?>" method="post">
                                           
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Tên địa điểm</label>
                                                            <input name="name" type="text" id="name" class="form-control" placeholder="Tên địa điểm" value="<?php echo $objLocation['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Khu vực</label>
                                                            <select name="id_parent" class="form-control select2">
                                                                <option value="0">Không có</option>
                                                                <?php 
                                                                    $query = "SELECT * FROM locations WHERE id_parent = '{$objLocation['id']}'";
                                                                    $result = $mysqli -> query($query);
                                                                    $check = 0;
                                                                    while ($itemLocation = mysqli_fetch_assoc($result)) {
                                                                        $check = $check +1;
                                                                    }
                                                                    $query = "SELECT * FROM locations";
                                                                    $result = $mysqli -> query($query);
                                                                    while ($itemLocation = mysqli_fetch_assoc($result)) {
                                                                        $id = $itemLocation['id'];
                                                                        $name = $itemLocation['name'];
                                                                        $idParent = $itemLocation['id_parent'];
                                                                        if($idParent == 0 && $id != $objLocation['id'] && $check ==0){
                                                                ?>
                                                                            <option <?php if($objLocation['id_parent'] == $id){echo "selected='selected'";} ?> value="<?php echo $id ?>"><?php echo $name ?></option>
                                                                <?php
                                                                        }
                                                                    }
                                                                ?>
                                                                   
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--/span-->
                                                </div>
                                                <!--/row-->
                                                <div class="form-actions">
                                                    <button type="submit" class="btn btn-success btn-icon left-icon mr-10 pull-left"> <i class="fa fa-check"></i> <span>Sửa</span></button>
                                                    <a class="btn btn-warning pull-left" href="index.php">Trở về</a>
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
                 
            });
        </script>
    </body>
</html>