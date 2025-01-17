<?php
    $page="Main";
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["admin"]))
    {
        header("Location:login.php");
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
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Total Revenue Generated</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                                $query = mysqli_query($con, "SELECT SUM(`rate`) FROM `subscription_selling` JOIN `subscription_master` ON `subscription_selling`.`subscription_id` = `subscription_master`.`id`;");
                                                $result = mysqli_fetch_array($query);
                                                // echo $result[0];
                                                if($result == "" || $result == null)
                                                {
                                                    echo "0 Rs.";
                                                }
                                                else
                                                {
                                                    echo $result[0] . " Rs.";
                                                }
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
                                        <h5 class="m-b-0 text-muted">Total Complaints for <?php
                                            echo DATE("F-Y");
                                        ?></h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                            $counter = 0;
                                            $query = mysqli_query($con, "select count(*) from complaint_product where month(created_at) = month(now()) and year(created_at) = year(now())");
                                            $result = mysqli_fetch_array($query);

                                            $counter = $counter + $result[0];

                                            $query = mysqli_query($con, "select count(*) from complaint_user where month(created_at) = month(now()) and year(created_at) = year(now())");
                                            $result = mysqli_fetch_array($query);

                                            $counter = $counter + $result[0];

                                            $query = mysqli_query($con, "select count(*) from feedback where month(created_at) = month(now()) and year(created_at) = year(now())");
                                            $result = mysqli_fetch_array($query);

                                            $counter = $counter + $result[0];

                                            echo $counter . " Received";
                                        ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-red">
                                        <i class="anticon anticon-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                        $query = mysqli_query($con, "select count(quantity) from sold_master");
                        $row = mysqli_fetch_array($query);
                        if($row[0] == 0)
                        {
                            $row[0] = 0;
                            $row[1] = 0;
                        }
                        else
                        {
                            $query = mysqli_query($con, "select sum(quantity), sum(total_amount) from sold_master");
                            $row = mysqli_fetch_array($query);
                        }
                    ?>

                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="m-b-0 text-muted">Total Items Sold in Units</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                                echo $row[0] . " Units";
                                            ?></span>
                                        </h2>
                                    </div>
                                    <div class="avatar avatar-icon avatar-lg avatar-orange">
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
                                        <h5 class="m-b-0 text-muted">Total Amount of Item Sold</h5>
                                        <h2 class="m-b-0">
                                            <span><?php
                                                echo $row[1] . " Rs.";
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
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <h5 class="m-b-0 text-muted m-2 mt-4">Total Website Traffic Bifurcation</h5>
                            <div class="card-body">
                            <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="d-flex  justify-content-between align-items-center">
                                            <canvas id="users" style="width:100%;max-width:600px;margin:0auto;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4">
                                        <div class="row" id="user_data">
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
                            <h5 class="m-b-0 text-muted m-2 mt-4">Total Revenue Bifurcation</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 col-md-12">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <canvas id="subs" style="width:100%;max-width:600px;margin:0 auto;"></canvas>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <div class="row" id="revenue">
                                        </div>
                                    </div>
                                </div>
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
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getuserbifurcation",
            success : function(response){
                // console.log(response);
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                // console.log(xvalues);
                // console.log(yvalues);
                // console.log(colors);
                new Chart("users",{
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
                            text : "Bifurcation of user data",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#user_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        });

        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getplansbifurcation",
            success : function(response){
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                colors.pop();
                xvalues.pop();
                yvalues.pop();

                new Chart("subs",{
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
                            text : "Bifurcation of subscription revenue data",
                        }
                    }
                })
                $.each(xvalues, function(key, value){
                    $("#revenue").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        })
    </script>
</body>

</html>