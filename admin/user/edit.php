
<?php
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
    include "../../functions/DbConnect.php";
    $id = $_GET['id'];
    $query = "SELECT * FROM user WHERE id_user = '{$id}'";
    $result = $mysqli -> query($query);
    $objUser = mysqli_fetch_assoc($result);
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
                          <h5 class="txt-dark">Thêm người dùng</h5>
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
                                            <form action="EditController.php?id=<?php echo $id;?>" method="post">
                                            
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Username</label>
                                                           
                                                            <input name="username" type="text" class="form-control" placeholder="Tên đăng nhập" value="<?php echo $objUser['username'] ?>">
                                                           
                                                        </div>
                                                    </div>
                                                
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Fullname</label>
                                                            <input name="fullname" type="text"  class="form-control" placeholder="Tên đầy đủ" value="<?php echo $objUser['fullname'] ?>">
                                                           
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Password</label>
                                                            <input id="password" name="password" type="password"  class="form-control" placeholder="Mật khẩu">
                                                            
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                                
                                                <!-- Row -->
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label mb-10">Role</label>
                                                            <select name="role" class="form-control" data-placeholder="Choose a brand" tabindex="1">
                                                                <option <?php if($objUser['role'] == "Admin"){ echo "selected='selected'";} ?> value="Admin">Admin</option>
                                                                <option <?php if($objUser['role'] == "Customer"){ echo "selected='selected'";} ?> value="Customer">Customer</option>
                                                            </select>
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
    
    </body>
</html>