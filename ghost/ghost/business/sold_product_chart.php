<?php
    $page = "Sold Product Chart";
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

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="text-center">Total Products Sold</h4>
                                    <br>
                                    <h5 class="text-center"><?php
                                        $query = mysqli_query($con, "SELECT SUM(`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ."");

                                        $result = mysqli_fetch_array($query);

                                        if($result[0] == "" || $result[0] == null)
                                        {
                                            echo "Total :- 0 Units"; 
                                        }
                                        else
                                        {
                                            echo "Total :- " . $result[0] . " Units";
                                        }
                                    ?></h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-8">
                            <div class="d-flex justify-content-between align-items-center">
                                <canvas id="suns" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="row" id="suns_data">
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
            url : "../crud.php?what=product_wise_business_selling_pie_chart",
            success : function(response){
                // console.log(response);
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                xvalues.pop();
                yvalues.pop();
                colors.pop();
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
                            text : "Delivered / Undelivered Product Bifurcation",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#suns_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        });
    </script>
</body>

</html>