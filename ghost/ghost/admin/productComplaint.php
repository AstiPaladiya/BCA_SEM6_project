<?php
    $page="Comprod";
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
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <style>
          th
        {
            font-size:17px;
        }
        td
        {
            font-size:14px;
        }
        .tbl_main
        {
            /* box-shadow:4px 4px  12px 1px grey; */
            
            box-shadow:0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: white;
            
        }
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
                    <div class="tbl_main table-responsive">
                        <table class="table hover" id="web_complaint_tbl">
                            <thead>
                                <tr class="bg-dark">
                                    <th class="text-light">Complaint Date</th>
                                    <th class="text-light">Complainer Name</th>
                                    <th class="text-light">Product</th>
                                    <th class="text-light">Business / Owner Name</th>
                                    <th class="text-light">Message</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "SELECT * FROM `complaint_product`;");

                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <tr>
                                            <td><?php echo $row['created_at'] ?></td>
                                            <td><?php
                                                $chckQuery = mysqli_query($con, "SELECT `owner_name` FROM `user_master` WHERE `id` = ".$row['complainer_user_id']."");
                                                $chck = mysqli_fetch_array($chckQuery);

                                                echo $chck['owner_name'];
                                            ?></td>
                                            <td><?php
                                                $chckQuery = mysqli_query($con, "SELECT * FROM `listing_products` WHERE `id` = ". $row['product_id'] ."");
                                                $chckResult = mysqli_fetch_array($chckQuery);

                                                echo "<div class='row'>";

                                                echo "<div class='col-3'>";
                                                echo $chckResult['product_name'];
                                                echo "</div>";

                                                echo "<div class='col-9'>";
                                                echo "<img src='../product_image/". $chckResult['img1'] ."' height='100px' width='100px' class='img-fluid'>";
                                                echo "</div>";

                                                echo "</div>";
                                            ?></td>
                                            <td><?php
                                                $chckQuery = mysqli_query($con, "SELECT `bussiness_name`, `owner_name` FROM `user_master` JOIN `listing_products` ON `listing_products`.`user_id` = `user_master`.`id` WHERE `listing_products`.`id` = ". $row['product_id'] ."");
                                                $chckResult = mysqli_fetch_array($chckQuery);
                                                if($chckResult['bussiness_name'] == "" || $chckResult['bussiness_name'] == null)
                                                {
                                                    echo $chckResult['owner_name'];
                                                }
                                                else
                                                {
                                                    echo $chckResult['bussiness_name'];
                                                }
                                            ?></td>
                                            <td><?php echo $row['message'] ?></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th >Complaint Date</th>
                                    <th>Complainer Name</th>
                                    <th>Product</th>
                                    <th>Business / Owner Name</th>
                                    <th>Message</th>
                                </tr>
                            </tfoot>
                        </table>
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
        $("#web_complaint_tbl").DataTable();
    </script>
</body>

</html>