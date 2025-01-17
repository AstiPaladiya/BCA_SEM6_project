<?php
    $page = "Revenue Chart";
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
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title text-center">Total Revenue Generate : <?php
                                $query = mysqli_query($con, "SELECT SUM(`sold_master`.`total_amount`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] .";");
                                $result = mysqli_fetch_array($query);

                                echo $result[0];
                            ?></h5>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Current Year Month Wise</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Totally Year Wise</a>
                                </li>
                            </ul>
                            <div class="tab-content m-t-15" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <div class="row">
                                        <div class="col-8">
                                            <canvas id="currentYearRevenueMonth" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                        </div>
                                        <div class="col-4">
                                            <div class="row" id="currentYearRevenueMonthData">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="row">
                                        <div class="col-8">
                                            <canvas id="currentYearRevenueYear" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                        </div>
                                        <div class="col-4">
                                            <div class="row" id="currentYearRevenueYearData">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Most Selling Product Through Website</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NULL GROUP BY `listing_products`.`id` ORDER BY `tot_qty` DESC LIMIT 1;");

                                        $result = mysqli_fetch_array($query);

                                        echo $result[0] . " - " . $result[1];
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title">Most Selling Product Through Marketer</h5>
                                </div>
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, SUM(`sold_master`.`quantity`) AS `tot_qty` FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL GROUP BY `listing_products`.`id` ORDER BY `tot_qty` DESC LIMIT 1;");

                                        $result = mysqli_fetch_array($query);

                                        if($result == "" || $result == null)
                                        {
                                            echo "NA";
                                        }
                                        else
                                        {
                                            echo $result[0] . " - " . $result[1];
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer -->
                <?php include("footer.php"); ?>
            </div>
                
            
                <!-- Content Wrapper START -->
                <!-- Content Wrapper END -->
          
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
            url : "../crud.php?what=currentYearMonthWiseBifurReve",
            success : function(response){
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                xvalues.pop();
                yvalues.pop();
                colors.pop();
                // console.log(xvalues);
                // console.log(yvalues);
                // console.log(colors);
                new Chart("currentYearRevenueMonth",{
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
                            text : "Current Year Revenue Chart",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#currentYearRevenueMonthData").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        });

        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=currentYearYearWiseBifurReve",
            success : function(response){
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                xvalues.pop();
                yvalues.pop();
                colors.pop();
                // console.log(xvalues);
                // console.log(yvalues);
                // console.log(colors);
                new Chart("currentYearRevenueYear",{
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
                            text : "Current Year Revenue Chart",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#currentYearRevenueYearData").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        })
    </script>
</body>

</html>