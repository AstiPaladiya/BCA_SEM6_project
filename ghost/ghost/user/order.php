<?php
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["front_user_id"]))
    {
        header("Location:../user_login.php");
    }

    $page = "Order";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ghost Marketer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include("include.php");
    ?>
    <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

    <style>
        .heart_nav{
            font-size:180%;
            color:black;
            /* background-color: white;
            border-radius: 50%;
            padding-top:2%;
            padding-bottom: 2%;
            padding-left: 2%;
            padding-right:2%; */
            text-align: center;
        }
        .subLogin
        {
            color:cornflowerblue;
            font-size:120%;
        }
        .main-menu{
            font-weight:600;
            font-family: Georgia, 'Times New Roman', Times, serif;
            /* letter-spacing: 2px; */
        }
        .login:hover
        {
            background-color:orange;
            color:white;
            border: 3px solid black; 
            /* box-shadow: 3px 3px 5px 2px black; */
            animation: pulse 1s ease-in-out;
            transition: .3s;
        }
		.bg10{
			background-color: red !important;
		}
        .thd
        {
            color:white;
        }
        .eyeBtn
        {
            font-size:260%;
            font-weight:bold;
            /* text-align: center; */
            /* color:lightskyblue; */
        }
        .tbl_style
        {
            text-align: center;
            font-size:110%;
        }
        .ret
        {
           color:red;
           font-weight:600;
            background-color: rgba(160,0,0,0.1);
            padding:5% 9%;
        }
        .del
        {
           color:green;
          
            background-color: rgba(0,160,0,0.1);
            padding:5% 9%;
        }
    </style>
</head>
<body class="animsition">

	<?php
        include("navbar.php");
    ?>

	<!-- content page -->
	<div class="bg0 p-t-100 p-b-80">
		<div class="container">
		<div class="wrap-table-shopping-cart rs1-table">
			<div class="tbl_main table-responsive">	
                <table class="table-shopping-cart table hover tbl_style table-bordered" id="tbl">
					<thead class="thead-dark">
                        <tr class="table_head">
                            <th style="color:white;font-size:19px;text-align:center;">Order Id</th>
                            <th style="color:white;font-size:19px;text-align:center;">Order Date</th>
                            <th style="color:white;font-size:19px;text-align:center;" class="p-l-30">Product Image</th>
                            <th style="color:white;font-size:19px;text-align:center;">Product Name</th>
                            <!-- <th style="color:white;font-size:19px;">Price</th>
                            <th style="color:white;font-size:19px;">Quantity</th>
                            <th style="color:white;font-size:19px;">Total Amount</th> -->
                            <th style="color:white;font-size:19px;text-align:center;">Status</th>
                            <!-- <th style="color:white;font-size:19px;">Location</th> -->
                            <th style="color:white;font-size:19px;text-align:center;">View More</th>
                            <th style="color:white;font-size:19px;text-align:center;">Return Order</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query=mysqli_query($con,"SELECT `sold_master`.`id`,`sold_master`.`quantity`,`sold_master`.`total_amount`,`sold_master`.`selling_date`,`listing_products`.`product_name`,`listing_products`.`img1`,`listing_products`.`price`,
                            `order_tracking`.`status`,`order_tracking`.`location` FROM `sold_master`
                            JOIN `listing_products` ON  `sold_master`.`product_id`=`listing_products`.`id`
                            JOIN `order_tracking` ON `sold_master`.`id`=`order_tracking`.`sell_master_id` WHERE `sold_master`.`buyer_user_id`= ".$_SESSION['front_user_id']."");
                            while($row=mysqli_fetch_array($query))
                            {
                        ?>
                        <tr class="table_row">
                            <td>
                                <?php echo $row['id']; ?>
                            </td>
                            <td>
                                <?php
                                        echo $row['selling_date'];
                                    
                                ?>
                            </td>
                            <td>
                                <div class="flex-w flex-m">
                                    <div class="wrap-pic-w size-w-50 bo-all-1 bocl12 m-r-30">
                                       <?php echo "<img src='../product_image/".$row['img1']."' alt='IMG'>"; ?> 
                                    </div>
                                </div>
                            </td>
                            <td>
                                <?php echo $row['product_name'] ?>
                            </td>
                            <td>
                                <?php
                                    $query_status=mysqli_query($con,"select count(*),status from return_order where sell_master_id=".$row['id']."");
                                    $row_status=mysqli_fetch_array($query_status);
                                    if($row_status[0]>0)
                                    {
                                        echo "<span class='badge badge-pill badge-danger'>".$row_status['status']."</span>";
                                        echo"</td>";
                                        echo"<td>";
                                        echo" <button type='button' class='btn btn-danger  btn-tone eyeView' data-id='".$row['id']."' style='font-size:16px;width:60px;height:45px' type='button' id='view' name='view' data-target='#btnEye' data-toggle='modal'><i class='far fa-eye' title='View More'></i></button>";
                                        echo"</td>";
                                    }
                                    else
                                    {
                                        if($row['status']=="Packing")
                                        {
                                            echo "<span class='badge badge-pill badge-info'>".$row['status']."</span>";
                                        }
                                        else if($row['status']=="In Transit")
                                        {
                                            echo "<span class='badge badge-pill badge-secondary'>".$row['status']."</span>";
                                        }
                                        else if($row['status']=="Delivered")
                                        {
                                            echo "<span class='badge badge-pill badge-success'>".$row['status']."</span>";
                                        }
                                       
                                        echo"</td>";
                                        echo"<td>";
                                        echo" <button type='button' class='btn btn-primary  btn-tone eyeView' data-id='".$row['id']."' style='font-size:16px;width:60px;height:45px' type='button' id='view' name='view' data-target='#btnEye' data-toggle='modal'><i class='far fa-eye' title='View More'></i></button>";
                                        echo"</td>";

                                    } 
                                ?>
                            <td>
                                <div class="flex-w flex-sb-m">
                                    <?php
                                        if($row_status[0]>0)
                                        {
                                            if($row_status['status'] == "Request")
                                            {?>
                                                <button type="button" d="canReturn"  data-id="<?php echo $row['id']?>"  class='flex-c-m txt-s-103 btn btn-danger cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 cancleBtn'>
                                                    Cancel Return Request
                                                    <!-- <span class="lnr lnr-chevron-right m-l-7"></span>
                                                    <span class="lnr lnr-chevron-right"></span> -->
                                                </button>
                                            <?php
                                            }
                                            else
                                            {?>
                                                <button type="button" disabled>
                                                    Return Order
                                                    <span class="lnr lnr-chevron-right m-l-7"></span>
                                                    <span class="lnr lnr-chevron-right"></span>
                                                </button>
                                            <?php
                                            }?>
                                            
                                        <?php
                                        }
                                        else
                                        {
                                            $query_return=mysqli_query($con,"SELECT `order_tracking`.`status`,DATEDIFF(NOW(), `order_tracking`.`updated_at`) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id`=`order_tracking`.`sell_master_id` JOIN `user_master` ON `user_master`.`id`=`sold_master`.`buyer_user_id` WHERE `user_master`.`id` = ". $_SESSION['front_user_id'] ." AND `sold_master`.`id` = ". $row['id'] .";");
                                            $result=mysqli_fetch_array($query_return);
                                            if($result['status'] != "Delivered")
                                            {?>
                                                <button type="button" disabled>
                                                    Return Order
                                                    <span class="lnr lnr-chevron-right m-l-7"></span>
                                                    <span class="lnr lnr-chevron-right"></span>
                                                </button>
                                        <?php
                                            }
                                            else if($result['status'] == "Delivered" && $result[1] > 7)
                                            {?>
                                                <button type="button" disabled>
                                                    Return Order
                                                    <span class="lnr lnr-chevron-right m-l-7"></span>
                                                    <span class="lnr lnr-chevron-right"></span>
                                                </button>
                                            <?php
                                            }
                                            else
                                            {?>
                                                <button type="button" id="Return" data-target='#btnReturn' data-toggle='modal' data-id="<?php echo $row['id']?>" class="flex-c-m txt-s-103 btn btn-success cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 returnBtn">
                                                    Return Order
                                                    <span class="lnr lnr-chevron-right m-l-7"></span>
                                                    <span class="lnr lnr-chevron-right"></span>
                                                </button>
                                            <?php
                                            }
                                        }
                                    ?>
                                    <!-- <button type="button" href="#" <?php 
                                        
                                        if($result[0] != 'Delivered')
                                        {
                                             echo "disabled";
                                        }
                                        else if($result[1]>7 && $result[0] == 'Delivered')
                                        {
                                            echo"disabled";
                                        }
                                        else
                                        {
                                            // $query_count=mysqli_query($con,"select count(*) from return_order where sell_master_id=".$row['id']."");
                                            // $row_count=mysqli_fetch_array($query_count);
                                            if($row_status[0]>0)
                                            {
                                                if($row_status['status'] != "Request")
                                                {
                                                    echo"disabled";
                                                }
                                                // if($row_status[0]<0)
                                                // {
                                                //   echo "enabled  data-target='#btnReturn' data-toggle='modal' class='flex-c-m txt-s-103 btn btn-success cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 returnBtn'";
                                                // }
                                                // else
                                                // {
                                                    // echo"disabled";
                                                // }
                                                // echo "enabled  data-target='#btnReturn' data-toggle='modal' class='flex-c-m txt-s-103 btn btn-success cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 returnBtn'";
                                               
                                            }
                                            else
                                            {
                                                echo "enabled  data-target='' data-toggle='' class='flex-c-m txt-s-103 btn btn-danger cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 cancleBtn'";
                                               
                                            }
                                        }
                                    ?> id="Return" data-target='#btnReturn' data-toggle='modal' data-id="<?php echo $row['id']?>" class="flex-c-m txt-s-103 btn btn-success cl6 size-a-2 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 returnBtn">
                                       
                                    <?php  
                                         if($row_status[0]>0 && $row_status['status']!='Request')
                                            {
                                                echo"Return Order";
                                            }
                                            else
                                            {
                                                echo "Cancle Return Request";
                                            } 
                                        ?>
                                        <span class="lnr lnr-chevron-right m-l-7"></span>
                                        <span class="lnr lnr-chevron-right"></span>
                                    </button> -->
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>    
                </table>
            </div>

                <!-- view more mode -->
                <div class="modal fade" id="btnEye" status="dialog" style="padding-top:5%;">
                    <div class="modal-dialog modal-dialog-scrollable">
                        <div class="modal-content  justify-content-center">
                            <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="labelDetail" style="font-size:170%;font-weight:bold;" >View More Product Detail</div>
                                    
                            </div>
                            <div class="modal-body">
                                <div id="detailTable">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Return Order model -->
                <div class="modal fade" id="btnReturn" status="dialog" style="padding-top:5%;">
                    <div class="modal-dialog ">
                        <div class="modal-content  justify-content-center">
                            <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="labelDetail" style="font-size:170%;font-weight:bold;" >Return Order</div>
                            </div>
                            <form id="reqFrm" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <h4>Reason for Return Order:</h4>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="Quality of product is not as expected" id="radio1">
                                            <label class="form-check-label" for="radio1">
                                                Quality of product is not as expected
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="Product arrived too late." id="radio2">
                                            <label class="form-check-label" for="radio2">
                                            Product arrived too late.
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="The  Product was damaged or defactive upon arrival." id="radio3">
                                            <label class="form-check-label" for="radio3">
                                            The  Product was damaged or defactive upon arrival.
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="Quality of the product was not as expected." id="radio4">
                                            <label class="form-check-label" for="radio4">
                                            Quality of the product was not as expected.
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="The merchant shipped wrong product." id="radio5">
                                            <label class="form-check-label" for="radio5">
                                            The merchant shipped wrong product.
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="The Product price was too high." id="radio6">
                                            <label class="form-check-label" for="radio6">
                                            The Product price was too high.
                                            </label>
                                        </div>
                                        <div class="form-check ml-3">
                                            <input class="form-check-input" type="radio" name="reasonReturn" value="Other" id="radio7">
                                            <label class="form-check-label" for="radio7">
                                            Other
                                            </label>
                                        </div>
                                        <div style="display:none;" id="OptionError">
                                            <span class="text-danger" style='font-size:small'>Please select of the above option</span>
                                        </div>
                                        <div class="form-group"><br/>
                                            <h4>Upload Product Image:</h4>
                                            <input type="file" name="txtFile" id="txtFile" class="form-control" accept="image/*" />
                                            <!-- <img src="" id="reqImg" name="reqImg" height="100px" width="100px"/> -->
                                        </div>
                                            
                                </div>    
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary rqu" id="btnReq" rqdata-id="<?php echo $row['id']; ?>" name="btnReq">Send Request</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>

	<!-- Footer -->
	<?php
		include("footer.php");
	?>
	

	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="lnr lnr-chevron-up"></span>
		</span>
	</div>

	

<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slick/slick.min.js"></script>
	<script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
	<script src="vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
	<script src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
  <!-- Validation js -->
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- Bootstrapgrowl -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="../new_js/order.js"></script>

<script src="../new_js/user_footer.js"></script>
    <script>
        $("#tbl").DataTable({
            // scrollX : true,
            // scrollY : true,
        });
    </script>

</body>
</html>


