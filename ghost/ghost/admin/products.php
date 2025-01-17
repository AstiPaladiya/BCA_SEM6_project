<?php
    $page="product";
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
        .editcategory:hover{
            cursor : grab;
        }

        @media (max-width : 411px){
            .editcategory{
                width: 50%;
            }
        }
        th
        {
            font-size:17px;
        }
        td
        {
            font-size:14px;
        }
        .av
        {
            width:10%;
            height:10%;
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
       .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
        .label_style
        {
            font-size:15px;
            font-weight:500;
            /* color:black; */
        }
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey;
        }
        .btn_styledange:hover{
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_styleprime:hover{
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:500;
            border:0px;
        }
        .btn_styledangeclose:hover
        {
            color:red;
            border:0px;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        /* .Unsold_style
        {
           color:darkblue;
           font-weight:600;
            background-color:rgba(0,0,139,0.2);
            padding-bottom:5%; 
            padding-left:10%;
            padding-top:5%;
            padding-right:10%;
        }
        .Sold_style
        {
            color:purple;
           font-weight:600;
            background-color: rgba(128,0,128,0.2);
            padding-bottom:5%; 
            padding-left:20%;
            padding-top:5%;
            padding-right:20%;
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
                

                <!-- Content Wrapper START -->
                <div class="main-content">
                    <!-- Blocking/Activating Product Reason -->
                    <div class="modal fade" id="exampleModal">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header  justify-content-center">
                                        <div class="modal-title" id="reasonHeader" style="font-size:25px;font-weight:700;"></div>
                                </div>
                                <div class="modal-body">
                                    <!-- Reason Here -->
                                    <label class="form-label label_style" id="reason-Label-id"></label>
                                    <textarea class="form-control inpt_minifrm" id="reasonTxtArea" cols="30" rows="5" placeholder="Enter Reason Here...."></textarea>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary btn_close" id="saveReasonBtn">Save changes</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- View More Product Detail -->
                    <div class="modal fade" id="ViewMore" status="dialog">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                        <h5 class="modal-title" id="labelDetail" style="font-size:25px;font-weight:700;" >Product Detail</h5>
                                        
                                </div>
                                <div class="modal-body">
                                    <div id="viewMoreModel">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tbl_main table-responsive" >   
                        <table class="table hover" id="producttable">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-light">User Name</th>
                                    <th class="text-light">Category Name</th>
                                    <th class="text-light">Product Name</th>
                                    <th class="text-light">Price</th>
                                    <th class="text-light">Image</th>
                                    <th class="text-light">Sell Status</th>
                                    <th class="text-light">Product Status</th>
                                    <th class="text-light">View More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "SELECT `listing_products`.`id`, `listing_products`.`product_name`, `listing_products`.`price`, `listing_products`.`img1`, `listing_products`.`sell_status`, `listing_products`.`product_status`, `user_master`.`owner_name`, `category_master`.`name` FROM `listing_products` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` JOIN `category_master` ON `category_master`.`id` = `listing_products`.`catagory_id`;");

                                    while($result = mysqli_fetch_array($query))
                                    {?>
                                        <tr>
                                            <td><?php echo $result['owner_name'] ?></td>
                                            <td><?php echo $result['name'] ?></td>
                                            <td><?php echo $result['product_name'] ?></td>
                                            <td><?php echo $result['price'] ?></td>
                                            <td><img src="../product_image/<?php echo $result['img1'] ?>" width="30%" class="rounded" /></td>
                                            <td><?php if($result['sell_status']=="Unsold") 
                                                    {
                                                        echo "<span class='Unsold_style'>".$result['sell_status']."</span>";
                                                    }
                                                    else
                                                    {
                                                        echo "<span class='Sold_style'>".$result['sell_status']."</span>";
                                                    }
                                            ?></td>
                                            <td>
                                                <?php
                                                    if($result['product_status'] == "Active")
                                                    {
                                                        $class = "btn-success btn_styleprime blockProduct";
                                                    }
                                                    else
                                                    {
                                                        $class = "btn-danger btn_styledange activeProduct";
                                                    }
                                                ?>
                                                <button data-id="<?php echo $result['id'] ?>" class="btn <?php echo $class ?>"><?php echo $result['product_status'] ?></button>
                                            </td>
                                            <td><button type="button" class="btn btn-primary btn-tone btnViewMore" data-target="#ViewMore" style='width:60px;height:45px;' title='View More' style="" data-toggle="modal"  data-id="<?php echo $result['id'] ?>"><i class='far fa-eye' title='View More'></i></button></td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
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

    <?php include("include.php") ?>
    <script>
        $("#producttable").DataTable();
    </script>
    <!-- Catagory Js -->
      <script src="../new_js/admin_product.js"></script>
</body>

</html>