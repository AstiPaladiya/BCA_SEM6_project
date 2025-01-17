<?php
    $page="Index";
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["mark_mail"]))
    {
        header("Location:../bussiness_login.php");
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
         .main-content{
            background-color:whitesmoke;
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

            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Total Products Sold List</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="product_list">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-light">Product Name</th>
                                        <th class="text-light">Total Quantity Sold</th>
                                        <th class="text-light">Selling Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`quantity`), `sold_master`.`created_at` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `sold_master`.`marketer_id` = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `product_id`;");
                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row[0] ?></td>
                                                <td><?php echo $row[1] ?></td>
                                                <td><?php echo $row[2] ?></td>
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

            <div class="modal fade" id="exampleModal2">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"><?php echo date("Y") . " Year Monthly Revenue Earned" ?></h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <i class="anticon anticon-close"></i>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table class="table" id="product_list">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-light">Month</th>
                                        <th class="text-light">Revenue</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT MONTHNAME(`created_at`), SUM(`marketer_commission`) FROM `sold_master` WHERE YEAR(`created_at`) = YEAR(NOW()) AND `marketer_id` = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY MONTHNAME(`created_at`);");
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
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="text-center card-title">Total Order by Your Link</h4>
                            </div>
                            <div class="card-body">
                                Total Number of Order Placed by Your Links are : <?php
                                    $query = mysqli_query($con, "select count(*) from sold_master where marketer_id = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`)");
                                    $result = mysqli_fetch_array($query);
                                    echo $result[0];
                                ?>

                                <div class="text-right"><button class="btn btn-info" <?php if($result[0] == 0){echo "disabled";} ?> data-target="#exampleModal" data-toggle="modal">Show Details</button></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="text-center card-title">Total Revenue Earned Till Now</h4>
                            </div>
                            <div class="card-body">
                                Total Revenue : <?php
                                    $query = mysqli_query($con, "select sum(marketer_commission) from sold_master where marketer_id = ". $_SESSION['mark_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`)");
                                    $result = mysqli_fetch_array($query);
                                    if($result[0] == null || $result[0] == "")
                                    {
                                        echo "0 Rs.";
                                    }
                                    else
                                    {
                                        echo $result[0] . " Rs.";
                                    }
                                ?>

                                <div class="text-right">
                                    <button class="btn btn-info" <?php if($result[0] == null || $result[0] == ""){echo "disabled";} ?> data-target="#exampleModal2" data-toggle="modal">Show Details</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="text-center card-title">Total Products Assigned (Active)</h4>
                            </div>
                            <div class="card-body">
                                Total : <?php
                                    $query = mysqli_query($con, "select count(*) from assign_marketer where marketer_id = ". $_SESSION['mark_id'] ." and status = 'Active'");
                                    $result = mysqli_fetch_array($query);
                                    echo $result[0]
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-6">
                    <div class="card">
                            <div class="card-header">
                                <h4 class="text-center card-title">Total Products Assigned (Block)</h4>
                            </div>
                            <div class="card-body">
                                Total : <?php
                                    $query = mysqli_query($con, "select count(*) from assign_marketer where marketer_id = ". $_SESSION['mark_id'] ." and status = 'Block'");
                                    $result = mysqli_fetch_array($query);
                                    echo $result[0]
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                
            
                <!-- Content Wrapper START -->
                <!-- Content Wrapper END -->
          
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
    <script>
    </script>
</body>

</html>