<?php
    $page = "Index";
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
                <!-- Put All Content Here -->
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Total Marketer</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                                $query = mysqli_query($con, "SELECT COUNT(*) FROM `marketer` where `user_id` = ". $_SESSION['user_id'] ."");
                                                $result = mysqli_fetch_array($query);
                                                echo $result[0];
                                            ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-cyan">
                                    <i class="anticon anticon-team"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Net Revenue</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                            $revenue = 0;
                                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `sold_master` LEFT JOIN `listing_products` ON `sold_master`.`product_id` = `listing_products`.`id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ."");
                                            $result = mysqli_fetch_array($query);
                                            if($result[0] == 0)
                                            {
                                                $revenue = 0;
                                            }
                                            else
                                            {
                                                $query = mysqli_query($con, "SELECT SUM(`total_amount`) FROM `sold_master` LEFT JOIN `listing_products` ON `sold_master`.`product_id` = `listing_products`.`id` WHERE `listing_products`.`user_id` = " . $_SESSION['user_id'] . "");

                                                $result = mysqli_fetch_array($query);

                                                $revenue = $result[0];
                                            }

                                            echo $revenue . " Rs.";
                                        ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-blue">
                                        <i class="anticon anticon-dollar"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Orders</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");
                                            $details = mysqli_fetch_array($query);

                                            // echo $details[0];
                                            if($details == "" || $details == null)
                                            {
                                                echo "0";
                                            }
                                            else
                                            {
                                                echo $details[0];
                                            }
                                        ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-red">
                                        <i class="anticon anticon-profile"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Commission</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                            $query = mysqli_query($con, "SELECT SUM(`marketer_commission`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");

                                            $result = mysqli_fetch_array($query);

                                            if($result[0] == "" || $result[0] == null)
                                            {
                                                echo "0 Rs.";
                                            }
                                            else
                                            {
                                                echo $result[0] . "Rs.";
                                            }
                                        ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-gold">
                                        <i class="anticon anticon-bar-chart"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Total Marketers</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="m-b-0">
                                        <?php
                                            $query = mysqli_query($con, "select count(*) from marketer where user_id = " . $_SESSION['user_id'] . "");
                                            $result = mysqli_fetch_array($query);
                                            echo $result[0];
                                        ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Best Marketer</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="m-b-0">
                                        <?php
                                            $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `sold_master`.`marketer_id` IS NOT NULL AND `user_master`.`id` = ". $_SESSION['user_id'] ." GROUP BY `marketer`.`id` ORDER BY `tot_qty` DESC LIMIT 1;");
                                            $result = mysqli_fetch_array($query);
                                            
                                            echo $result[0] . "<br>Total Products Sold : " . $result[1];
                                        ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Sold / Unsold Product Bifurcation</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 col-md-10">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <canvas id="suns" style="width:100%;max-width:600px;margin:0 auto;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-2">
                                        <div class="row" id="suns_data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Delivered / Undelivered Product Bifurcation</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 col-md-10">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <canvas id="delundel" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-2">
                                        <div class="row" id="delundel_data">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="m-b-0 text-muted">Best Selling Product Till Now</h5>
                                <h2 class="m-b-0">
                                <?php
                                    $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." GROUP BY `sold_master`.`product_id` ORDER BY `tot_qty` DESC LIMIT 1;");
                                    $result = mysqli_fetch_array($query);

                                    // echo "<span style='font-size:18px;font-weight:800;'>Product Name :" . $result[0] ."</span> ";
                                    // echo "<br/><span style='font-size:18px;font-weight:800;'>Quantity Sold :" . $result[1] . "</span>";

                                    if($result == "" || $result == null)
                                    {
                                        echo "NA";
                                    }
                                    else
                                    {
                                        echo "<span style='font-size:18px;font-weight:800;'>Product Name :" . $result[0] ."</span> ";
                                        echo "<br/><span style='font-size:18px;font-weight:800;'>Quantity Sold :" . $result[1] . "</span>";
                                    }
                                ?>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <!-- <div class="card">
                            <div class="card-body">
                                <h5 class="m-b-0 text-muted">Best Selling Product of <?php
                                   echo date("F-Y"); 
                                ?></h5>
                                <?php
                                    $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND MONTHNAME(`sold_master`.`selling_date`) = MONTHNAME(NOW()) GROUP BY `sold_master`.`product_id` ORDER BY `tot_qty` DESC LIMIT 1;");
                                    $result = mysqli_fetch_array($query);

                                    // echo "<span class='mt-5'>" . $result[0] . " - " . $result[1] . "</span>";
                                    if($result == "" || $result == null)
                                    {
                                        echo "NA";
                                    }
                                    else
                                    {
                                        echo "<span style='font-size:18px;font-weight:800;'>Product Name :" . $result[0] ."</span> ";
                                        echo "<br/><span style='font-size:18px;font-weight:800;'>Quantity Sold :" . $result[1] . "</span>";
                                    }
                                ?>
                            </div>
                        </div> -->
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Best Selling Product of <?php echo date("F-Y"); ?></h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                                $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND MONTHNAME(`sold_master`.`selling_date`) = MONTHNAME(NOW()) GROUP BY `sold_master`.`product_id` ORDER BY `tot_qty` DESC LIMIT 1;");
                                                $result = mysqli_fetch_array($query);
                                                // echo $result[0];
                                                // echo "<span style='font-size:18px;font-weight:800;'>Product Name :" . $result[0]." </span>";
                                                // echo "<br><span style='font-size:18px;font-weight:800;'>Quantity Sold :" . $result[1]." </span>";
                                                if($result == "" || $result == null)
                                                {
                                                    echo "NA";
                                                }
                                                else
                                                {
                                                    echo "<span style='font-size:18px;font-weight:800;'>Product Name :" . $result[0] ."</span> ";
                                                    echo "<br/><span style='font-size:18px;font-weight:800;'>Quantity Sold :" . $result[1] . "</span>";
                                                }
                                            ?></span>
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="row mt-3">
                    <div class="col-lg-6 col-md-12">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Total Revenue Generated</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="m-b-0">
                                        <?php
                                            $revenue = 0;
                                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `sold_master` LEFT JOIN `listing_products` ON `sold_master`.`product_id` = `listing_products`.`id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ."");
                                            $result = mysqli_fetch_array($query);
                                            if($result[0] == 0)
                                            {
                                                $revenue = 0;
                                            }
                                            else
                                            {
                                                $query = mysqli_query($con, "SELECT SUM(`total_amount`) FROM `sold_master` LEFT JOIN `listing_products` ON `sold_master`.`product_id` = `listing_products`.`id` WHERE `listing_products`.`user_id` = " . $_SESSION['user_id'] . "");

                                                $result = mysqli_fetch_array($query);

                                                $revenue = $result[0];
                                            }

                                            echo $revenue . " Rs.";
                                        ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-12">
                    <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Total Marketers Commission</h5>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h2 class="m-b-0">
                                        <?php
                                            $query = mysqli_query($con, "SELECT SUM(`marketer_commission`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");

                                            $result = mysqli_fetch_array($query);

                                            if($result[0] == "" || $result[0] == null)
                                            {
                                                echo "0 Rs.";
                                            }
                                            else
                                            {
                                                echo $result[0] . "Rs.";
                                            }
                                        ?>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> -->
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
    <script>
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getsoldunsoldbifur",
            success : function(response){
                // console.log(response);
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                // console.log(xvalues);
                // console.log(yvalues);
                // console.log(colors);
                new Chart("suns",{
                    type : "doughnut",
                    data : {
                        labels : xvalues,
                        datasets : [{
                            backgroundColor : colors,
                            data : yvalues,
                        }]
                    },
                    options : {
                        title : {
                            display : true,
                            text : "Sold Unsold Product Bifurcation",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#suns_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        });

        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getdelundelbifur",
            success : function(response){
                // console.log(response);
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                // console.log(xvalues);
                // console.log(yvalues);
                // console.log(colors);
                new Chart("delundel",{
                    type : "doughnut",
                    data : {
                        labels : xvalues,
                        datasets : [{
                            backgroundColor : colors,
                            data : yvalues,
                        }]
                    },
                    options : {
                        title : {
                            display : true,
                            text : "Delivered / Undelivered Product Bifurcation",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#delundel_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        });
    </script>    
</body>

</html>