<?php
    $page="Chartsoldprod";
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
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "select count(*) from listing_products where sell_status = 'Sold'");
                                        $counter = mysqli_fetch_array($query);

                                        echo "<h3 class='text-center'>Total Sold Out Products : " . $counter[0] . "</h3>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `product_status` = 'Active' AND `sell_status` = 'Sold';");
                                        $counter = mysqli_fetch_array($query);

                                        echo "<h3 class='text-center'>Total Active Sold Out Products : " . $counter[0] . "</h3>";
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "select count(*) from listing_products where product_status = 'Block' and sell_status = 'Sold'");
                                        $counter = mysqli_fetch_array($query);

                                        echo "<h3 class='text-center'>Total Blocked Out Sold Products : " . $counter[0] . "</h3>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <canvas id="active_block" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-between align-items-center mt-5">
                        <div class="col-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <canvas id="tot_years" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="d-flex justify-content-between align-items-center">
                                <canvas id="curr_year_months" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    Year Wise Sold Out Line Chart
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card">
                                <div class="card-body text-center">
                                    Month Wise Sold Out Line Chart for Current Year
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
        // Year Wise Chart
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=sold_products_tot_year",
            success : function(response){
                var xvalues = 0;
                xvalues = [xvalues].concat(response.xvalues.split(","));
                xvalues.pop();
                var yvalues = 0;
                yvalues = [yvalues].concat(response.yvalues.split(","));
                yvalues.pop();
                new Chart("tot_years", {
                    type: "line",
                    data: {
                        labels: xvalues,
                        datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yvalues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        scales: {
                        yAxes: [{ticks: {min: 0, max:response.counter}}],
                        }
                    }
                });
            }
        })

        //Current Year Month Wise
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=sold_products_tot_months",
            success : function(response){
                var xvalues = 0;
                xvalues = [xvalues].concat(response.xvalues.split(","));
                xvalues.pop();
                var yvalues = 0;
                yvalues = [yvalues].concat(response.yvalues.split(","));
                yvalues.pop();
                new Chart("curr_year_months", {
                    type: "line",
                    data: {
                        labels: xvalues,
                        datasets: [{
                        fill: false,
                        lineTension: 0,
                        backgroundColor: "rgba(0,0,255,1.0)",
                        borderColor: "rgba(0,0,255,0.1)",
                        data: yvalues
                        }]
                    },
                    options: {
                        legend: {display: false},
                        scales: {
                        yAxes: [{ticks: {min: 0, max:response.counter}}],
                        }
                    }
                });
            }
        })
        
        // Pie Chart
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=sold_product_chart_actblock",
            success : function(response){
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                new Chart("active_block",{
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
                            text : "Bifurcation of Active / Block Products",
                        }
                    }
                });
            }
        })
    </script>
</body>

</html>