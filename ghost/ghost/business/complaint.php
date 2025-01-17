<?php
    $page = "Complaint";
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
                <!-- Put All Content Here -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Product Complaints</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Business Complaints</a>
                    </li>
                </ul>
                <div class="tab-content m-t-15" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="tbl_main table-responsive">
                            <table class="table hover"id="undeliveredProduTbl">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date of Complaint</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Complaint</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, `listing_products`.`img1`, `complaint_product`.`message`, `complaint_product`.`created_at` FROM `complaint_product` JOIN `listing_products` ON `listing_products`.`id` = `complaint_product`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] .";");

                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row['created_at']; ?></td>
                                                <td><?php echo $row['product_name']; ?></td>
                                                <td>
                                                    <img src="../product_image/<?php echo $row['img1'] ?>" height="120px" width="120px">
                                                </td>
                                                <td><?php echo $row['message'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date of Complaint</th>
                                        <th>Product Name</th>
                                        <th>Product Image</th>
                                        <th>Complaint</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="tbl_main table-responsive">
                            <table class="table hover" id="delivered_products_tbl">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Date of Complaint</th>
                                        <th>Message</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `complaint_user`.`created_at`, `complaint_user`.`message` FROM `complaint_user` WHERE `complaint_user`.`complainee_user_id` = ". $_SESSION['user_id'] .";");

                                        while($row = mysqli_fetch_array($query))
                                        {?>

                                            <tr>
                                                <td><?php echo $row[0] ?></td>
                                                <td><?php echo $row[1] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date of Complaint</th>
                                        <th>Message</th>
                                    </tr>
                                </tfoot>
                            </table>
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
        if(sessionStorage.getItem("current") != "home-tab" && sessionStorage.getItem("current") != "profile-tab")
        {
            $("#home-tab").click();
        }
        $("#undeliveredProduTbl").DataTable({
            // scrollY:true,
        });
        $("#delivered_products_tbl").DataTable({
            // scrollY:true,
        });
        // $("#return_order_req").DataTable();
        // $("#return_order_tbl").DataTable();
    </script>
</body>

</html>