
<?php 
    session_start();
    if(!isset($_SESSION['username'])){
        header("location:../../public/login.php");
    }
    include "../../functions/DbConnect.php";
    include "../../functions/Utils.php";
    $id = $_GET['id'];
    $query = "SELECT id As idPerson, name As name_orderer,phone As phone_orderer, email As mail_orderer, address As address_orderer, note As note_orderer, num_passenger, idDetail, date_ordered, id_user FROM personorder WHERE id = '{$id}'";
    $result = $mysqli -> query($query);
    $objOrder = mysqli_fetch_assoc($result);
    $idDetail = $objOrder['idDetail'];

    $query = "SELECT d.id As idDetail, date_depart,time_depart , price, d.id_tour As idTour, t.name As nameTour, time_depart, address_depart, slot, images, item_tour, programs, note, t.discount FROM detailtour As d INNER JOIN tour As t ON d.id_tour = t.id WHERE d.id = '{$idDetail}'";
    $result = $mysqli -> query($query);
    $objDetail = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BK Tour</title>
        <!-- BOOTSTRAP STYLES-->
        <link href="../../templates/public/css/bootstrap.min.css" rel="stylesheet">
        <script src="../../templates/public/js/jquery-1.10.2.min.js"></script>
        <script src="../../templates/admin/js/jQuery.print.min.js"></script>
    </head>
    <body style="margin-top:20px" class="printableArea2" >
        <div class="container" id="ele1">
            <div class="row">
                <div class="well col-xs-10 col-sm-10 col-md-8 col-xs-offset-1 col-sm-offset-1 col-md-offset-3">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 text-right">
                            <p>
                            </p>
                            <p>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="text-center">
                            <h1>Thông tin đơn đặt tour</h1>
                        </div>
                        <div class="text-left">
                        <h3>Thông tin tour</h3>
                        <fmt:formatDate value="${objDetail.date_depart }" pattern="dd/MM/yyyy" var="fm_Date_Depart"/>
                         <p style="padding-left: 5%">Tên tour: <?php echo $objDetail['nameTour']  ?><br>
                         
                            khởi hành: <?php echo convertDate($objDetail['date_depart'])  ?> <?php echo $objDetail['time_depart']  ?><br>
                            nơi tập trung: <?php echo $objDetail['address_depart']  ?><br>
                            dòng tour: <?php echo $objDetail['item_tour']  ?><br></p>
                        </div>
                        <h3>Thông tin người đặt tour</h3>
                            <p style="padding-left: 5%">Họ tên: <?php echo $objOrder['name_orderer'] ?><br>
                            Địa chỉ: <?php echo $objOrder['address_orderer'] ?><br>
                            Số điện thoại: <?php echo $objOrder['phone_orderer'] ?><br>
                            Email: <?php echo $objOrder['mail_orderer'] ?><br>
                            Ghi chú: <?php echo $objOrder['note_orderer'] ?><br>
                            Tổng số khách: <?php echo $objOrder['num_passenger'] ?> <br></p>
                        </div>
                        <table class="table table-hover" id="table2excel">
                            <thead>
                                <tr>
                                    <th>Họ Tên</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Trị giá</th>
                                    <!-- <th class="col-md-2 text-center">Total</th> -->
                                </tr>
                            </thead>
                            <tbody>
                          
                            <?php 


                                $query = "SELECT id As id_traveler, name As name_traveler, gender, birth As birth_traveler FROM traveler WHERE id_personorder = '{$id}'";
                                $result = $mysqli -> query($query);
                                $sumPrice = 0;
                                while ($objTraveler = mysqli_fetch_assoc($result)) {
                                    $name_traveler = $objTraveler['name_traveler'];
                                    $gender = $objTraveler['gender'];
                                    $birth_traveler = $objTraveler['birth_traveler'];
                                    $sumPrice = $sumPrice + $objDetail['price'];
                            ?>
                            	
                                    <tr>
                                        <td class="col-md-3"><em><?php echo $name_traveler ?></em></td>
                                        <td class="col-md-1 text-center"><?php echo $birth_traveler ?></td>
                                        <?php 
                                            if($gender == 0){
                                        ?>
                                        	<td class="col-md-2" style="text-align: center">Nam</td>
                                        <?php 
                                            }
                                        ?>
                                        
                                        <?php 
                                            if($gender == 1){
                                        ?>
                                        	<td class="col-md-2" style="text-align: center">Nữ</td>
                                        <?php 
                                            }
                                        ?>
                                
                                        <td class="col-md-4 text-center"><?php echo number_format($objDetail['price'])  ?> VNĐ</td>
                                    </tr>
                            <?php 
                                }
                            ?>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <h4><strong>Total:</strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong>&nbsp;<?php echo number_format($sumPrice) ?> VNĐ</strong></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <h4><strong>Giảm: </strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong>&nbsp;<?php echo $objDetail['discount']  ?> %</strong></h4>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-right" colspan="5">
                                        <h4><strong>Thanh toán:</strong></h4>
                                    </td>
                                    <td class="text-center text-danger">
                                        <h4><strong>&nbsp;<?php echo currentPrice($sumPrice, $objDetail['discount']) ?></strong></h4>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row noprint print-link no-print" style="padding:30px">
                            <div class="col-md-6">
                                <a href="index.php" class="btn btn-default btn-lg btn-block">
                                Quay lại
                                </a>
                            </div>
                           
                        </div>
                    </div>
                </div>
            </div>
      
        <div id="trans_div" style="display:none"></div>
    </body>
</html>