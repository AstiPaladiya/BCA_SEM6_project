<?php
    $page = "Delivered Order Chart";
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
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(`sold_master`.`id`) FROM `sold_master` JOIN `order_tracking` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `sold_master`.`id` NOT IN (SELECT `id` FROM `return_order`) AND `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] ."");
                                        $counter = mysqli_fetch_array($query);

                                        echo "<h3 class='text-center'>Total Delivered Products : " . $counter[0] . "</h3>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Current Year Month Wise Delivered Order</h5>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <canvas id="current_year_delivered_orders" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title" id="cardTitle">Selected Year Month Wise Delivered Order</h5>

                                    <select id="selectedYear" class="form-control">
                                        <option value="">-- Select a Year --</option>
                                        <?php
                                            $query = mysqli_query($con, "SELECT DISTINCT YEAR(`order_tracking`.`created_at`) FROM `order_tracking` JOIN `sold_master` ON `sold_master`.`id` = `order_tracking`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `order_tracking`.`status` = 'Delivered' AND `user_master`.`id` = ". $_SESSION['user_id'] .";");
                                            while($row = mysqli_fetch_array($query))
                                            {?>
                                                <option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                    <div class="d-flex justify-content-between align-items-center mt-3" id="AddNewCanvasHere">
                                        <canvas id="particular_year_delivered_orders" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                    </div>
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
        //Year Change ajax call
        $("#selectedYear").change(function(){
            if($(this).val() != "" && $(this).val() != null)
            {
                const json = {"year" : $(this).val()};

                $("#cardTitle").text(json.year + " Year Month Wise Delivered Order");

                $.ajax({
                    type : "POST",
                    method : "POST",
                    dataType : "JSON",
                    data : json,
                    url : "../crud.php?what=particularBusinessSelectedYearMonthWise",
                    success : function(response){
                        var xvalues = 0;
                        xvalues = [xvalues].concat(response.xvalues.split(","));
                        xvalues.pop();
                        var yvalues = 0;
                        yvalues = [yvalues].concat(response.yvalues.split(","));
                        yvalues.pop();
                        new Chart("particular_year_delivered_orders", {
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
            }
            else
            {
                $("#cardTitle").text("Selected Year Month Wise Delivered Order");
                $("#particular_year_delivered_orders").remove();

                $("#AddNewCanvasHere").html("<canvas id='particular_year_delivered_orders' style='width:100%;max-width:600px;margin: 0 auto;'></canvas>");
            }
        });

        //Current Year Month Wise
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=particularBusinessCurrentYearMonthWise",
            success : function(response){
                var xvalues = 0;
                xvalues = [xvalues].concat(response.xvalues.split(","));
                xvalues.pop();
                var yvalues = 0;
                yvalues = [yvalues].concat(response.yvalues.split(","));
                yvalues.pop();
                new Chart("current_year_delivered_orders", {
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
    </script>
</body>

</html>