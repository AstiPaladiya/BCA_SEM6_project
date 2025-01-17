<?php
    $page="rev";
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
                    <div class="card">
                        <div class="card-header">
                            <h2 class="card-title" id="title">Select Type of Report</h2>
                        </div>
                        <div class="card-body">
                            <select name="report_sel" id="report_sel" class="form-control">
                                <option value="">-- Select Type of Report --</option>
                                <option value="current_year_month_wise">Current Year Month Wise Revenue</option>
                                <option value="current_year_product_wise">Current Year Product Wise Selling</option>
                                <option value="selected_year_month_wise">Selected Year Month Wise Revenue</option>
                                <option value="selected_year_product_wise">Selected Year Product Wise Selling</option>
                            </select><br>

                            <select name="selected_year" id="selected_year" class="form-control" style="display:none;">
                                <option value="">-- Select Year --</option>
                                <?php
                                    $query = mysqli_query($con, "SELECT DISTINCT YEAR(`created_at`) FROM `sold_master` WHERE `marketer_id` = ". $_SESSION['mark_id'] ."");
                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
                                    <?php
                                    }
                                ?>
                            </select><br>

                            <div class="d-flex justify-content-between align-items-center" id="canvas_div">
                                <canvas id="marketer_chart" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
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
        $("#report_sel").change(function(){
            $("#selected_year").hide();
            if($(this).val() == "" || $(this).val() == null)
            {
                $("#title").html("Select Type of Report");
                $("#marketer_chart").remove();

                $("#canvas_div").append(`<canvas id="marketer_chart" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>`);
            }
            else if($(this).val() == "current_year_month_wise")
            {
                var year = new Date().getFullYear();
                $("#title").html(`${year} Year Month Wise Revenue Report`);

                $.ajax({
                    type : "POST",
                    method : "POST",
                    dataType : "JSON",
                    url : "../crud.php?what=current_year_month_wise_revenue_for_marketer",
                    success : function(response){
                        var xvalues = 0;
                        xvalues = [xvalues].concat(response.xvalues.split(","));
                        xvalues.pop();
                        var yvalues = 0;
                        yvalues = [yvalues].concat(response.yvalues.split(","));
                        yvalues.pop();
                        new Chart("marketer_chart", {
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
            else if($(this).val() == "current_year_product_wise")
            {
                var year = new Date().getFullYear();
                $("#title").html(`${year} Year Product Wise Revenue Report`);
                $.ajax({
                    type : "POST",
                    method : "POST",
                    dataType : "JSON",
                    url : "../crud.php?what=current_year_product_wise_revenue_for_marketer",
                    success : function(response){
                        var xvalues = 0;
                        xvalues = [xvalues].concat(response.xvalues.split(","));
                        xvalues.pop();
                        var yvalues = 0;
                        yvalues = [yvalues].concat(response.yvalues.split(","));
                        yvalues.pop();
                        new Chart("marketer_chart", {
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
            else if($(this).val() == "selected_year_month_wise")
            {
                $("#selected_year").show();
                $("#title").html(`Select Year for Report`);

                $("#selected_year").prop("selectedIndex", 0);

                $("#marketer_chart").remove();

                $("#canvas_div").append(`<canvas id="marketer_chart" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>`);
            }
            else if($(this).val() == "selected_year_product_wise")
            {
                $("#selected_year").show();
                $("#title").html("Select Year for Report");

                $("#selected_year").prop("selectedIndex", 0);

                $("#marketer_chart").remove();

                $("#canvas_div").append(`<canvas id="marketer_chart" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>`);
            }
        })

        $("#selected_year").change(function(){
            if($(this).val() == "" || $(this).val() == null)
            {
                $("#title").html("Select Year for Report");
                $("#marketer_chart").remove();

                $("#canvas_div").append(`<canvas id="marketer_chart" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>`);
            }
            else
            {
                var year = $(this).val();
                var report = $("#report_sel").val();

                if(report == "selected_year_month_wise")
                {
                    $("#title").html(`${year} Year Month Wise Revenue Report`);
                }
                else
                {
                    $("#title").html(`${year} Year Product Wise Revenue Report`);
                }

                const json = {"year" : year, "report" : report};

                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=custom_report_revenue_for_marketer",
                    success : function(response){
                        var xvalues = 0;
                        xvalues = [xvalues].concat(response.xvalues.split(","));
                        xvalues.pop();
                        var yvalues = 0;
                        yvalues = [yvalues].concat(response.yvalues.split(","));
                        yvalues.pop();
                        new Chart("marketer_chart", {
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
        })
    </script>
</body>

</html>