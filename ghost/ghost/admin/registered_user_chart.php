<?php
    $page="Chartreguser";
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
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Year Wise Chart</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Month Wise Chart</a>
                        </li>
                    </ul>
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <canvas id="year_wise" style="width:100%;max-width:800px;margin: 0 auto;"></canvas>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-5">
                                <div class="row">
                                    <div class="col-10">
                                        <canvas id="user_bifur" style="width:100%;max-width:800px;margin: 0 auto;"></canvas>
                                    </div>
                                    <div class="col-2">
                                        <div id="user_bifur_data"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <label class="form-label" style="font-size:150%;font-weight:bold;" for="year_select">Select Year for Data :</label>
                            <select id="year_select" class="form-control mb-5">
                                <option value="">-- Select Year --</option>
                                <?php
                                    $query = mysqli_query($con, "SELECT DISTINCT YEAR(`created_at`) FROM `user_master` WHERE `role` = 2");
                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <option value="<?php echo $row[0] ?>"><?php echo $row[0] ?></option>
                                    <?php
                                    }
                                ?>
                            </select>
                            <div id="year_disp" style="font-size:150%;font-weight:bold;"></div>    
                            <div class="d-flex justify-content-between align-items-center">
                                <canvas id="month_wise" style="width:100%;max-width:800px;margin: 0 auto;"></canvas>
                                <br>
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

        // Month Wise Chart but according to year selected
        $("#year_select").change(function(){
            var year = $(this).val();
            if(year != "" && year != null)
            {
                const json = {"year" : year};
                
                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=getreguserlinechart_month_sel_year",
                    success : function(response){
                        $("#year_disp").html(response.year + " Year Data");
                        var xvalues = 0;
                        xvalues = [xvalues].concat(response.xvalues.split(","));
                        xvalues.pop();
                        var yvalues = 0;
                        yvalues = [yvalues].concat(response.yvalues.split(","));
                        yvalues.pop();
                        new Chart("month_wise", {
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

        // Year Wise Chart
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getreguser_year",
            success : function(response){
                var xvalues = 0;
                xvalues = [xvalues].concat(response.xvalues.split(","));
                xvalues.pop();
                var yvalues = 0;
                yvalues = [yvalues].concat(response.yvalues.split(","));
                yvalues.pop();
                new Chart("year_wise", {
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

        // Current Year month wise chart
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getreguser_month",
            success : function(response){
                $("#year_disp").html(response.year + " Year Data");
                var xvalues = 0;
                xvalues = [xvalues].concat(response.xvalues.split(","));
                xvalues.pop();
                var yvalues = 0;
                yvalues = [yvalues].concat(response.yvalues.split(","));
                yvalues.pop();
                new Chart("month_wise", {
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
            url : "../crud.php?what=user_page_chart_bifur",
            success : function(response){
                var xvalues = response.xvalues.split(",");
                var yvalues = response.yvalues.split(",");
                var colors = response.colors.split(",");
                new Chart("user_bifur",{
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
                    $("#user_bifur_data").append(`<div class='col-6' style='font-size:smaller'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        })
    </script>
</body>

</html>