<?php
    $page = "Marketer Chart";
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
   
     .main-content{
            background-color:whitesmoke;
        }  

        /* th
        {
            font-size:18px;
            color: white !important;
        }
        td
        {
            font-size:14px;
        } */
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
                    <!-- Marketer Data Modal -->
                    <div class="modal fade" id="exampleModalScrollable">
                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalScrollableTitle">Marketer Product Selling Break-Down</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <i class="anticon anticon-close"></i>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <?php
                                            $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, SUM(`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `sold_master`.`marketer_id`;");
                                            while($row = mysqli_fetch_array($query))
                                            {?>
                                                <tr>
                                                    <th><?php echo $row[0] ?></th>
                                                    <td><?php echo $row[1] ?></td>
                                                </tr>
                                            <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Total Products Sold by Marketer</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-4">Total Quantity</div>
                                <div class="col-4"><?php
                                    $query = mysqli_query($con, "SELECT SUM(`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`);");
                                    $result = mysqli_fetch_array($query);
                                    echo $result[0];
                                ?></div>
                                <div class="col-4">
                                    <button data-target="#exampleModalScrollable" class="btn btn-success btn-tone m-r-5" data-toggle="modal">View Break Down</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-8">
                                    <canvas id="marketer_pie" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                </div>
                                <div class="col-4">
                                    <div class="row" id="suns_data">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <select id="marketer_name" class="form-control">
                                        <option value="">-- Select Marketer --</option>
                                        <?php
                                            $query = mysqli_query($con, "SELECT * FROM `marketer` WHERE `user_id` = ". $_SESSION['user_id'] ."");
                                            while($row = mysqli_fetch_array($query))
                                            {?>
                                                <option value="<?php echo $row['id'] ?>"><?php echo $row['marketer_name'] ?></option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <canvas id="marketer_pie_individual" style="width:100%;max-width:600px;margin: 0 auto;"></canvas>
                                </div>
                                <div class="col-4">
                                    <div class="row" id="marketer_pie_individual_data">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Marketer Commission Break Down</h5>
                        </div>
                        <div class="card-body">
                            <table class="table hover" id="tblData">
                                <thead class="bg-dark">
                                    <tr>
                                        <th class="text-light">Marketer Name</th>
                                        <th class="text-light">Product Name</th>
                                        <th class="text-light">Quantity Sold</th>
                                        <th class="text-light">Commission</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, `listing_products`.`product_name`, SUM(`quantity`), SUM(`sold_master`.`marketer_commission`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `sold_master`.`product_id`;");

                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row['marketer_name'] ?></td>
                                                <td><?php echo $row['product_name'] ?></td>
                                                <td><?php echo $row[2] ?></td>
                                                <td><?php echo $row[3] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Marketer Wise Revenue Generated Break Down</h5>
                        </div>
                        <div class="card-body">
                            <table class="table hover" id="revMark">
                                <thead class="bg-dark">
                                    <th class="text-light">Marketer Name</th>
                                    <th class="text-light">Revenue Generated</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, SUM(`sold_master`.`total_amount`) FROM `sold_master` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL AND `sold_master`.`id` NOT IN (SELECT `return_order`.`sell_master_id` FROM `return_order`) GROUP BY `marketer`.`id`;");
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
                <!-- Footer -->
                <?php include("footer.php"); ?>
            </div>

            <!-- $query = mysqli_query($con, "SELECT `marketer`.`marketer_name`, SUM(`sold_master`.`quantity`) FROM `sold_master` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` JOIN `marketer` ON `marketer`.`id` = `sold_master`.`marketer_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `sold_master`.`marketer_id` IS NOT NULL GROUP BY `sold_master`.`marketer_id`;"); -->
                
            
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
        setInterval(() => {
            if(window.innerWidth < 500)
            {
                $("#tblData").addClass("table-responsive");
            }
            else
            {
                $("#tblData").removeClass("table-responsive");
            }
        }, 1000);
        $.ajax({
            type : "POST",
            method : "POST",
            dataType : "JSON",
            url : "../crud.php?what=getMarketerPieChart",
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
                new Chart("marketer_pie",{
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
                            text : "Marketer Product Sold",
                        }
                    }
                });
                $.each(xvalues, function(key, value){
                    $("#suns_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                })
            }
        })

        $("#marketer_name").change(function(){
            if($(this).val() != "" && $(this).val() != null)
            {
                const json = {"mid" : $(this).val()};
                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=getMarketerPieChartForIndividual",
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
                        new Chart("marketer_pie_individual",{
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
                                    text : "Marketer Individual Data",
                                }
                            }
                        });
                        $.each(xvalues, function(key, value){
                            $("#marketer_pie_individual_data").append(`<div class='col-6'><button class='btn' style='background-color:${colors[key]}'></button>&nbsp;${xvalues[key]}</div><div class='col-6'>${yvalues[key]}</div>`);
                        })
                    }
                })
            }
        });

        $("#tblData").DataTable();
        $("#revMark").DataTable();
    </script>
</body>

</html>