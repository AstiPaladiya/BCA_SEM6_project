<?php
    $page="viewProduct";
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
        .cpyUrl
        {
           color:orange;
           font-weight:500;
            background-color:rgba(255,215,0,0.3);
            font-size:17px;
            padding-bottom:17%; 
            /* padding-left:20%; */
            padding-top:17%;
            /* padding-right:20%; */
            border:0px;
            /* border-radius:15px;  */
        }
        .cpyUrl:hover
        {
           color:white;
           font-weight:500;
            background-color:rgba(255,215,0,1);
            font-size:17px;
            padding-bottom:17%; 
            /* padding-left:20%; */
            padding-top:17%;
            /* padding-right:20%; */
            border:0px;
            /* border-radius:15px;  */
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

                <!-- Modal -->
                <div class="modal fade" id="exampleModal">
                    <div class="modal-dialog modal-lg justify-content-center">
                        <div class="modal-content justify-content-center">
                            <div class="modal-header justify-content-center">
                                <h5 class="modal-title" id="exampleModalLabel"  style="font-size:22px;font-weight:600;"></h5>
                                <!-- <button type="button" class="close btn" data-dismiss="modal">
                                    <i class="anticon anticon-close"></i>
                                </button> -->
                            </div>
                            <div class="modal-body">
                                <div class="tbl_main table-responsive">
                                    <table class="table hover" id="viewmore">
                                        <thead class="bg-dark">
                                            <tr>
                                                <th class="text-light">Month Name</th>
                                                <th class="text-light">Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableData"></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Month Name</th>
                                                <th >Quantity</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tbl_main  table-responsive">
                    <table class="table hover" id="view_assigned_products">
                        <thead class="thead-dark">
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Your Commission</th>
                                <th>Assigned On</th>
                                <th>Copy Url</th>
                                <th>Download Image</th>
                                <th>View Selling</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $query = mysqli_query($con, "SELECT `listing_products`.`product_name`, `listing_products`.`product_description`, `listing_products`.`price`, `assign_marketer`.`comission`, `assign_marketer`.`created_at`, `assign_marketer`.`link`, `assign_marketer`.`product_id`, `listing_products`.`img1` FROM `assign_marketer` JOIN `listing_products` ON `listing_products`.`id` = `assign_marketer`.`product_id` WHERE `assign_marketer`.`marketer_id` = ". $_SESSION['mark_id'] .";");

                                while($row = mysqli_fetch_array($query))
                                {?>
                                    <tr>
                                        <td><?php echo $row[0]; ?></td>
                                        <td><?php echo $row[1]; ?></td>
                                        <td><?php echo $row[2]; ?></td>
                                        <td><?php echo $row[3] . "% (" . (($row[3] * $row[2]) / 100) . " Rs.)"; ?></td>
                                        <td><?php echo $row[4]; ?></td>
                                        <td><button class="btn cpyUrl m-r-5 copyUrl" data-url="<?php echo $row[5] ?>" title="Click to Copy Url in Clipboard"><i class="far fa-copy" ></i></button></td>
                                        <td>
                                            <img src="../product_image/<?php echo $row['img1'] ?>" width="100px">
                                            <br>
                                            <div class="text-center">
                                                <a href="../product_image/<?php echo $row['img1'] ?>" download="<?php echo $row['img1'] ?>"><button class="btn btn-info btn-tone m-r-5" title="Download this image"><i class="anticon anticon-download"></i></button></a>
                                            </div>
                                        </td>
                                        <td><button class="btn btn-primary btn-tone viewSelling" data-target="#exampleModal" data-toggle="modal"  style='width:60px;height:45px' title='View More'   data-id="<?php echo $row['product_id'] ?>"><i class='far fa-eye' ></i></button></td>
                                    </tr>
                                <?php
                                }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Product Name</th>
                                <th>Description</th>
                                <td>Price</th>
                                <th>Your Commission</th>
                                <th>Assigned On</th>
                                <th>Copy Url</th>
                                <th>Download Image</th>
                                <th>View Selling</th>
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
        $("#view_assigned_products").DataTable();
        // $("#viewmore").DataTable();

        $("#view_assigned_products").on("click", ".copyUrl", function(){
            window.scrollTo({"top" : 0, "behaviour" : "smooth"});
            navigator.clipboard.writeText($(this).attr("data-url"));

            $.bootstrapGrowl("<div class='text-center'><h5>URL copied to clipboard</h5></div>",{
                type : "info",
                delay : 2000,
                allow_dismiss : false,
                align : "center",
                width : 300,
            });
        })
        // $(".copyUrl").click(function(){
        //     navigator.clipboard.writeText($(this).attr("data-url"));

        //     $.bootstrapGrowl("<div class='text-center'><h5>URL copied to clipboard</h5></div>",{
        //         type : "info",
        //         delay : 2000,
        //         allow_dismiss : false,
        //         align : "center",
        //         width : 300,
        //     });
        // });

        $("#view_assigned_products").on("click", ".viewSelling", function(){
            const json = {"id" : $(this).attr("data-id")};
            var tr = $(this).parent().parent();
            $.ajax({
                type : "POST",
                method : "POST",
                data : json,
                dataType : "JSON",
                url : "../crud.php?what=getSpecificMarketerDataForProduct",
                success : function(response){
                    $("#tableData").html(response);

                    $("#exampleModalLabel").text("Selling Report For " + $($(tr).find("td")[0]).text());
                }
            })
        })
        // $(".viewSelling").click(function(){
        //     const json = {"id" : $(this).attr("data-id")};
        //     var tr = $(this).parent().parent();
        //     $.ajax({
        //         type : "POST",
        //         method : "POST",
        //         data : json,
        //         dataType : "JSON",
        //         url : "../crud.php?what=getSpecificMarketerDataForProduct",
        //         success : function(response){
        //             $("#tableData").html(response);

        //             $("#exampleModalLabel").text("Selling Report For " + $($(tr).find("td")[0]).text());
        //         }
        //     })
        // })
    </script>
</body>

</html>