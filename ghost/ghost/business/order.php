<?php
    $page = "Orders";
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["name"]))
    {
        if(!isset($_SESSION["mail"]))
        {
            if(!isset($_SESSION["role"]))
            {
                if(!isset($_SESSION["user_id"]))
                {
                    header("Location:../bussiness_login.php");
                }
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Ghost Marketer Dashboard</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="../image/logo.png">

    <!-- page css -->

    <!-- Core css -->
    <link href="../assets/css/app.min.css" rel="stylesheet">
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
         th
        {
            font-size:17px;
        }
        td
        {
            font-size:14px;
        }
        .editcategory:hover{
            cursor : pointer;
        }
        .tbl_main
        {
            /* box-shadow:4px 4px  12px 1px grey; */
            
            /* box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
            box-shadow:0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: white;
            
        }
        .main-content{
            background-color:whitesmoke;
        }
        .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
        .label_style
        {
            font-size:15px;
            font-weight:500;
            /* color:black; */
        }
        .btn_styledange:hover{
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_styleprime:hover{
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:500;
            border:0px;
        }
        .btn_styleLoc:hover{
            background-color: rgba(123,104,238,0.3);
            color:darkslateblue;
            font-weight:500;
            border:0px;
        }
        /* .reject{
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.1); 
            padding-bottom:5%; 
            padding-left:7%;
            padding-top:5%;
            padding-right:7%;
            font-size:small;
        }
        .picked
        {
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:500;
            border:0px;
            padding-bottom:5%; 
            padding-left:7%;
            padding-top:5%;
            padding-right:7%;
            font-size:small;
        }
        .accept
        {
           color:blue;
           font-weight:500;
            background-color:rgba(0,0,255,0.1);
            padding-bottom:5%; 
            padding-left:7%;
            padding-top:5%;
            padding-right:7%;
            font-size:small;
        }
        .picked_up
        {
            color:medium violet red;
           font-weight:500;
            background-color:rgba(72,209,204,0.4);
            padding-bottom:5%; 
            padding-left:7%;
            padding-top:5%;
            padding-right:7%;
            font-size:small;
        }
        .unreject:hover
        {
           color:orange;
           font-weight:500;
            background-color:rgba(255,215,0,0.3);
            border:0px; */
            /* border-radius:15px; */
        /* } */
        /* .intransite
        {
           color:orange;
           font-weight:500;
            background-color:rgba(255,215,0,0.3);
            padding-bottom:6%; 
            padding-left:7%;
            padding-top:6%;
            padding-right:7%;
            border-radius:15px; 
        }
        .packing
        {
           color:dodgerblue;
           font-weight:500;
            background-color:rgba(30,144,255,0.2);
            padding-bottom:5%; 
            padding-left:10%;
            padding-top:5%;
            padding-right:10%;
        } */
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey;
        }
    
    </style>

</head>

<body>
    <div class="app">
        <div class="layout">
            <!-- Header START -->
            <?php
                include("header.php");
            ?>
            <!-- Header END -->

            <!-- Side Nav START -->
            <?php
                include("sidebar.php");
            ?>
            <!-- Side Nav END -->

            <!-- Page Container START -->
            <div class="page-container">
                
            <div class="main-content">
                <!-- Delivered Confirmation -->
                <div class="modal fade" id="confirmation_order">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure that the product is delivered ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="confirmBtn" class="btn btn-success btn_styleprime">Yes</button>
                                <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Change Location Modal -->
                <div class="modal fade" id="chang_location_modal">
                    <div class="modal-dialog justify-content-center">
                        <div class="modal-content justify-content-center">
                            <div class="modal-header justify-content-center">
                                <div  class="modal-title" id="exampleModalLabel" style="font-size:25px;font-weight:700;">Change Location</div>
                                <!-- <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                <div class='form-group'>
                                    <label class="form-label label_style" for="oldLoc">Old Location :</label>
                                    <input type="text" id="oldLoc" name="oldLoc" readonly class="form-control inpt_minifrm" />
                                </div>
                                <div class="form-group">
                                    <label class="form-label label_style" for="entLoc">Enter New Location :</label>
                                    <input type="text" id="entLoc" name="entLoc" class="form-control inpt_minifrm" />
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" id="saveloc" class="btn btn-primary btn_close">Change Location</button>
                                <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payment Confirmation Modal -->
                <div class="modal fade" id="payment_confirmation">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure that the refund has been transfered to customer bank account ?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success btn_styleprime" id="paymentBtn">Yes</button>
                                <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Put All Content Here -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undelivered Orders <span class='badge badge-pill bg-dark text-light'>(<?php
                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `order_tracking`.`status` != 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] .";");
                            $details = mysqli_fetch_array($query);

                            echo $details[0];
                        ?>)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Delivered Orders <span class='badge badge-pill bg-dark text-light'>(<?php
                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");
                            $details = mysqli_fetch_array($query);

                            echo $details[0];
                        ?>)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Return Orders Request <span class='badge badge-pill bg-dark text-light'>( <?php
                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `return_order`.`status` = 'Request'");
                            $details = mysqli_fetch_array($query);

                            echo $details[0];
                        ?> )</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact2-tab" data-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Return Orders <span class='badge badge-pill bg-dark text-light'>(<?php
                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`id` IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");
                            $details = mysqli_fetch_array($query);

                            echo $details[0];
                        ?>)</span></a>
                    </li>
                </ul>
                <div class="tab-content m-t-15" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class='tbl_main table-responsive'> 
                            <table class="table hover" id="undeliveredProduTbl">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Sold Through</th>
                                        <th>Customer Name</th>
                                        <th>Customer Address</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Current Location</th>
                                        <th>Location Setting</th>
                                        <th>Delivered Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `order_tracking`.`id`,`user_master`.`owner_name`,`user_master`.`address` , `listing_products`.`product_name`, `listing_products`.`price`, `sold_master`.`quantity`, `sold_master`.`total_amount`, `order_tracking`.`status`, `order_tracking`.`location`,`sold_master`.`marketer_id` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` JOIN `order_tracking` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` WHERE `order_tracking`.`status` != 'Delivered' AND `listing_products`.`user_id` = ". $_SESSION['user_id'] .";");

                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row['id'] ?></td>
                                                <td><?php
                                                    if($row['marketer_id'] == null || $row['marketer_id'] == "")
                                                    {
                                                        echo "Ghost Marketer";
                                                    }
                                                    else
                                                    {
                                                        $tempQuery = mysqli_query($con, "select marketer_name from marketer where id = ". $row['marketer_id'] ."");
                                                        $tempResult = mysqli_fetch_array($tempQuery);

                                                        echo $tempResult[0] . "(Marketer)";
                                                    }
                                                ?></td>
                                                <td><?php echo $row['owner_name'] ?></td>
                                                <td><?php echo $row['address'] ?></td>
                                                <td><?php echo $row['product_name'] ?></td>
                                                <td><?php echo ($row['total_amount'] / $row['quantity']) ?></td>
                                                <td><?php echo $row['quantity'] ?></td>
                                                <td><?php echo $row['total_amount'] ?></td>
                                                <td><?php
                                                    if($row['status'] == 'Packing')
                                                    {
                                                        echo "<span class='badge badge-pill badge-info'>Packing</span>";
                                                    }
                                                    else if($row['status'] == 'In Transit')
                                                    {
                                                        echo "<span class='badge badge-pill badge-warning'>In Transit</span>";
                                                    }
                                                ?></td>
                                                <td><?php echo $row['location'] ?></td>
                                                <td>
                                                    <button class="btn btn-success btn_styleprime chngLoc" data-toggle="modal" data-target="#chang_location_modal" data-loc="<?php echo $row['status'] ?>" data-id="<?php echo $row['id'] ?>">Change Location</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-secondary btn_styleLoc markDelivered" data-target="#confirmation_order" data-toggle="modal" data-id="<?php echo $row['id'] ?>" <?php
                                                        if($row['status'] == "Packing")
                                                        {
                                                            echo "disabled";
                                                        }
                                                    ?>>Mark as Delivered</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Sold Through</th>
                                        <th>Customer Name</th>
                                        <th>Customer Address</th>
                                        <th>Product Name</th>
                                        <th>Product Price</th>
                                        <th>Quantity</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th>Current Location</th>
                                        <th>Location Setting</th>
                                        <th>Delivered Setting</th>
                                    </tr>
                                </>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                       <div class="tbl_main table-responsive">
                            <table class="table hover" id="delivered_products_tbl">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Sold Through</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Delivery Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `user_master`.`owner_name`, `listing_products`.`product_name`, DATE(`order_tracking`.`updated_at`), `sold_master`.`id`, `sold_master`.`marketer_id` FROM 	`order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` WHERE `order_tracking`.`status` = 'Delivered' AND `order_tracking`.`location` = 'Buyer' AND `listing_products`.`user_id` = ". $_SESSION['user_id'] ."");

                                        while($row = mysqli_fetch_array($query))
                                        {
                                            $chckQuery = mysqli_query($con, "select count(*) from return_order where sell_master_id = ". $row[3] ."");
                                            $chckCounter = mysqli_fetch_array($chckQuery);

                                            if($chckCounter[0] == 0)
                                            {?>

                                                <tr>
                                                    <td><?php echo $row[3] ?></td>
                                                    <td><?php
                                                        if($row['marketer_id'] == "" || $row['marketer_id'] == null)
                                                        {
                                                            echo "Ghost Marketer";
                                                        }
                                                        else
                                                        {
                                                            $tempQuery = mysqli_query($con, "select marketer_name from marketer where id = ". $row['marketer_id'] ."");
                                                            $tempResult = mysqli_fetch_array($tempQuery);

                                                            echo $tempResult[0] . "(Marketer)";
                                                        }
                                                    ?></td>
                                                    <td><?php echo $row[0] ?></td>
                                                    <td><?php echo $row[1] ?></td>
                                                    <td><?php echo $row[2] ?></td>
                                                </tr>
                                            <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Sold Through</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Delivery Date</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <div class='tbl_main table-responsive'>
                            <table class="table hover" id="return_order_req">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Return Order Request ID</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Problem by Customer</th>
                                        <th>Image from Customer</th>
                                        <th>Current Status</th>
                                        <th>Accept Request</th>
                                        <th>Reject Request</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `return_order`.`id`,  `sold_master`.`id`, `user_master`.`owner_name`, `listing_products`.`product_name`, `return_order`.`order_problem`, `return_order`.`return_img`,  `return_order`.`status` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `sold_master`.`buyer_user_id` = `user_master`.`id` WHERE `return_order`.`status` = 'Request' AND `listing_products`.`user_id` = ". $_SESSION['user_id'] ."");
                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row[0] ?></td>
                                                <td><?php echo $row[1] ?></td>
                                                <td><?php echo $row[2] ?></td>
                                                <td><?php echo $row[3] ?></td>
                                                <td><?php echo $row[4] ?></td>
                                                <td><?php
                                                    if(trim($row[5]) == "" || trim($row[5]) == null)
                                                    {
                                                        echo "<span class='badge badge-pill badge-magenta'>Image Error or Image not found</span>";
                                                    }
                                                    else if(!file_exists("../return_images/" . trim($row[5])))
                                                    {
                                                        echo "<span class='badge badge-pill badge-magenta'>Image Error or Image not found</span>";
                                                    }
                                                    else
                                                    {
                                                        echo "<img src='../return_images/". trim($row[5]) ."' class='img rounded' width='90%'>";
                                                    }
                                                ?></td>
                                                <td><?php echo "<span class='badge badge-pill badge-danger'>". $row[6] ."</span>"; ?></td>
                                                <td>
                                                    <button class="btn btn-success btn_styleprime acceptReturn" data-id="<?php echo $row[0] ?>">Accept Request</button>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn_styledange rejectReturn" data-id="<?php echo $row[0] ?>">Reject Request</button>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Return Order Request ID</th>
                                        <th>Order ID</th>
                                        <th>Customer Name</th>
                                        <th>Product Name</th>
                                        <th>Problem by Customer</th>
                                        <th>Image from Customer</th>
                                        <th>Current Status</th>
                                        <th>Accept Request</th>
                                        <th>Reject Request</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                        <div class='tbl_main table-responsive'>
                        <table class="table hover" id="return_order_tbl">
                            <thead class="thead-dark">
                                <tr>
                                    <th>Return Order ID</th>
                                    <th>Customer Name</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Order Problem</th>
                                    <th>Status</th>
                                    <th>Update Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "SELECT `return_order`.`id`, `user_master`.`owner_name`, `listing_products`.`product_name`, `sold_master`.`quantity`, `return_order`.`order_problem`, `return_order`.`status` FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `sold_master`.`buyer_user_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `return_order`.`status` != 'Request';");

                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <tr>
                                            <td><?php echo $row[0] ?></td>
                                            <td><?php echo $row[1] ?></td>
                                            <td><?php echo $row[2] ?></td>
                                            <td><?php echo $row[3] ?></td>
                                            <td><?php echo $row[4] ?></td>
                                            <td><?php 
                                                    if($row[5] == "Accepted")
                                                    {
                                                        echo "<span class='badge badge-pill badge-primary'>". $row[5] ."</span>";
                                                    }
                                                    else if($row[5] == "Rejected")
                                                    {
                                                        echo "<span class='badge badge-pill badge-danger'>". $row[5] ."</span>";
                                                    }
                                                    else if($row[5] == "Picked Up")
                                                    {
                                                        echo "<span class='badge badge-pill badge-info'>". $row[5] ."</span>";
                                                    }
                                                    else if($row[5] == "Completed")
                                                    {
                                                        echo "<span class='badge badge-pill badge-success'>". $row[5] ."</span>";
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='badge badge-pill badge-secondary'>". $row[5] ."</span>";
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($row[5] == "Completed")
                                                    {
                                                        echo "<button class='btn btn-warning unreject' data-id='". $row[0] ."' disabled>Completed</button>";
                                                    }
                                                    else if($row[5] == "Accepted")
                                                    {
                                                        echo "<button class='btn btn-warning pickedUp unreject' data-id='". $row[0] ."'>Picked Up</button>";
                                                    }
                                                    else if($row[5] == "Rejected")
                                                    {
                                                        echo "<button class='btn btn-warning alterRejection unreject' data-id='". $row[0] ."'>Accept Request</button>";
                                                    }
                                                    else if($row[5] == "Picked Up")
                                                    {
                                                        echo "<button class='btn btn-warning receivedReturn unreject' data-id='". $row[0] ."'>Received Return</button>";
                                                    }
                                                    else if($row[5] == "Received Return")
                                                    {
                                                        echo "<button class='btn btn-warning makePayment unreject' data-target='#payment_confirmation' data-toggle='modal' data-id='". $row[0] ."'>Done Payment to Customer</button>";
                                                    }
                                                ?>
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
          
                <!-- Footer START -->
                    <?php include("footer.php"); ?>
                <!-- Footer END -->
            </div>
            <!-- Page Container END -->

            <!-- Quick theme START -->
            <?php include("theme.php"); ?>
            <!-- Quick theme END -->
        </div>
    </div>

    <?php include("include.php"); ?>
    <script src="../new_js/business_order.js"></script>
    <script>
        $("#undeliveredProduTbl").DataTable({
            // scrollY:true,
        });
        $("#delivered_products_tbl").DataTable({
            // scrollY:true,
        });
        $("#return_order_req").DataTable();
        $("#return_order_tbl").DataTable();
    </script>
</body>

</html>