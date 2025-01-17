<?php
    $page = "Products";
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
         th
        {
            font-size:17px;
        }
        td
        {
            font-size:14px;
        }
        .editcategory:hover{
            cursor : pointer;
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
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey;
        }
        input[type=file]::file-selector-button {
            /* margin-right: 5px; */
            border: none;
            background-color:rgba(108, 122, 137,1);
            padding: 7px 7px;
            /* margin-bottom:120px; */
            border-radius:7px;
            color:#fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }

        input[type=file]::file-selector-button:hover {
            color:black;
            background-color: rgba(239,239,240,1);
        }
        .btn_edit{
            font-size:20px;
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
                

                <!-- Content Wrapper START -->
                <div class="main-content">

                <!--Add Product Model -->
                    <div class="modal fade" id="addNewProduct" status="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >Add New Product</div>
                                </div>
                                <form method="post" id="product_frm" enctype="multipart/form-data">
                              
                                <div class="modal-body">
                                         <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Select Catagory:</label>
                                            <select id="drpCat" name="drpCat" class="form-control inpt_minifrm">
                                                <option value="">-- Select Catagory --</option>
                                                <?php
                                                     $query = mysqli_query($con,"select * from category_master");
                                                     while($row=mysqli_fetch_array($query))
                                                     {
                                                        echo "<option value='".$row['id']."'>".$row['name']."</option>";
                                                     }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Name:</label>
                                            <input type="text" id="txtName" name="txtName" class="form-control inpt_minifrm" placeholder="Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Description:</label>
                                            <textarea type="text" id="txtDes" name="txtDes" class="form-control inpt_minifrm" placeholder="Description"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Price:</label>
                                            <input type="number" id="txtPrice" name="txtPrice" class="form-control inpt_minifrm" placeholder="Price"/>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Image1:</label>
                                            <input type="file" class="form-control inpt_minifrm" accept="image/*" id="img1" name="img1" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Image2:</label>
                                            <input type="file" class="form-control inpt_minifrm" accept="image/*" disabled  id="img2" name="img2" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Image3:</label>
                                            <input type="file" class="form-control inpt_minifrm" accept="image/*" disabled id="img3" name="img3" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Image4:</label>
                                            <input type="file" class="form-control inpt_minifrm" accept="image/*" disabled id="img4" name="img4" />
                                        </div>
                                    
                                </div>   
                                <div class="modal-footer">
                                    <button type="submit" id="btnSubmit"  name="btnSubmit" class="btn btn-primary btn_close">Save change</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
                <!-- View More Product Detail -->
                <div class="modal fade" id="ViewMore" status="dialog">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                        <div class="modal-title" id="labelDetail" style="font-size:25px;font-weight:700;" >View Product Detail</div>
                                        
                                </div>
                                <div class="modal-body">
                                    <div id="detailTable">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                     <!-- Update Product Detail -->
                    <div class="modal fade" id="UpdateProduct" status="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content  justify-content-center">
                                    <div class="modal-header  justify-content-center">
                                            <div class="modal-title" id="labelDetail" style="font-size:25px;font-weight:700;" >Update Product Detail</div>
                                            
                                    </div>
                                    
                                    <form  method="post" id="updateForm" enctype="multipart/form-data">
                                        <div class="modal-body" id="editFrm">   
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnUpdateSubmit" name="btnUpdateSubmit" class="btn btn-primary btn_close">Save change</button>
                                            <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                       <!-- Update Product PHP Code Starts -->
                        <?php
                            if(isset($_POST['btnUpdateSubmit']))
                            {
                                $product_id = $_POST['pid'];
                                $desc_upd = $_POST['txtDesUpd'];
                                $price_upd = $_POST['txtPriceUpd'];
                                $imgUpd1 = null;
                                $imgUpd2 = null;
                                $imgUpd3 = null;
                                $imgUpd4 = null;
                                if(isset($_POST['delete_img2']))
                                {
                                    $query = mysqli_query($con, "select img2, img3, img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img2']))
                                    {
                                        unlink("../product_image/" . $result['img2']);
                                    }
                                    if(file_exists("../product_image/" . $result['img3']))
                                    {
                                        unlink("../product_image/" . $result['img3']);
                                    }
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img2 = NULL, img3 = NULL, img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                else if(isset($_POST['delete_img3']))
                                {
                                    $query = mysqli_query($con, "select img3, img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img3']))
                                    {
                                        unlink("../product_image/" . $result['img3']);
                                    }
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img3 = NULL, img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                else if(isset($_POST['delete_img4']))
                                {
                                    $query = mysqli_query($con, "select img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                $query = mysqli_query($con, "select img1, img2, img3, img4 from listing_products where id = ". $_POST['pid'] ."");
                                $oldimages = mysqli_fetch_array($query);
                                if($_FILES['img1Upd']['name'] != "" && $_FILES['img1Upd']['name'])
                                {
                                    $imgUpd1 = $_FILES['img1Upd'];
                                }
                                if($_FILES['img2Upd']['name'] != "" && $_FILES['img2Upd']['name'])
                                {
                                    $imgUpd2 = $_FILES['img2Upd'];
                                }
                                if($_FILES['img3Upd']['name'] != "" && $_FILES['img3Upd']['name'])
                                {
                                    $imgUpd3 = $_FILES['img3Upd'];
                                }
                                if($_FILES['img4Upd']['name'] != "" && $_FILES['img4Upd']['name'])
                                {
                                    $imgUpd4 = $_FILES['img4Upd'];
                                }
                                $upd_query = "product_description = '". $_POST['txtDesUpd'] ."', price = ". $_POST['txtPriceUpd'] ."";
                                if($imgUpd1 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img1']))
                                    {
                                        unlink("../product_image/" . $oldimages['img1']);
                                    }
                                    move_uploaded_file($_FILES['img1Upd']['tmp_name'], "../product_image/" . $_FILES['img1Upd']['name']);
                                    $upd_query .= ", img1 = '". $_FILES['img1Upd']['name'] ."'";
                                }
                                if($imgUpd2 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img2']))
                                    {
                                        unlink("../product_image/" . $oldimages['img2']);
                                    }
                                    move_uploaded_file($_FILES['img2Upd']['tmp_name'], "../product_image/" . $_FILES['img2Upd']['name']);
                                    $upd_query .= ", img2 = '". $_FILES['img2Upd']['name'] ."'";
                                }
                                if($imgUpd3 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img3']))
                                    {
                                        unlink("../product_image/" . $oldimages['img3']);
                                    }
                                    move_uploaded_file($_FILES['img3Upd']['tmp_name'], "../product_image/" . $_FILES['img3Upd']['name']);
                                    $upd_query .= ", img3 = '". $_FILES['img3Upd']['name'] ."'";
                                }
                                if($imgUpd4 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img4']))
                                    {
                                        unlink("../product_image/" . $oldimages['img4']);
                                    }
                                    move_uploaded_file($_FILES['img4Upd']['tmp_name'], "../product_image/" . $_FILES['img4Upd']['name']);
                                    $upd_query .= ", img4 = '". $_FILES['img4Upd']['name'] ."'";
                                }
                                $query = mysqli_query($con, "update listing_products set $upd_query where id = $product_id");
                                if($query != 0)
                                {
                                    echo "<script>window.location.replace('product.php');</script>";
                                }
                            }
                        ?>
                        <!-- Update Product PHP Code Ends -->

                        <?php
                            if(isset($_POST['btnSubmit']))
                            {
                         
                                move_uploaded_file($_FILES['img1']['tmp_name'],"../product_image/" . $_FILES['img1']['name']);

                                if(isset($_FILES['img2']))
                                {
                                    if($_FILES['img2']['name'] != "" && $_FILES['img2']['name'] != null)
                                    {
                                        move_uploaded_file($_FILES['img2']['tmp_name'],"../product_image/" . $_FILES['img2']['name']);
                                        $img2 = $_FILES['img2']['name'];
                                    }
                                }
                                if(isset($_FILES['img3']))
                                {
                                    if(($_FILES['img3']['name'] != "" && $_FILES['img3']['name'] != null))
                                    {
                                        move_uploaded_file($_FILES['img3']['tmp_name'],"../product_image/" . $_FILES['img3']['name']);
                                        $img3 = $_FILES['img3']['name'];
                                    }
                                }
                                if(isset($_FILES['img4']))
                                {
                                    if($_FILES['img4']['name'] != "" && $_FILES['img4']['name'] != null)
                                    {
                                        move_uploaded_file($_FILES['img4']['tmp_name'],"../product_image/" . $_FILES['img4']['name']);
                                        $img4 = $_FILES['img4']['name'];
                                    }
                                }
                                $cat = $_POST['drpCat'];
                                $name = $_POST['txtName'];
                                $des = $_POST['txtDes'];
                                $price = $_POST['txtPrice'];
                                $img1 = $_FILES['img1']['name'];
                                
                                if(!isset($img2))
                                {
                                    $img2 = null;
                                }
                                if(!isset($img3))
                                {
                                    $img3 = null;
                                }
                                if(!isset($img4))
                                {
                                    $img4 = null;
                                }

                                $query = mysqli_query($con, "insert into listing_products(user_id,catagory_id,product_name,product_description,price,img1,img2,img3,img4,sell_status,product_status) values (".$_SESSION["user_id"].",".$cat.",'".$name."','".$des."',".$price.",'".$img1."','".$img2."','".$img3."','".$img4."','Unsold','Active')");
                                echo "<script>window.location.replace('product.php');</script>";
                            }
                        ?>
                    <!-- button trigger model -->
                    <div style="font-size:23px;font-weight:bold">Product:</div>
                    <button class="btn btn-primary m-5" data-target="#addNewProduct" data-toggle="modal" id="NewProduct">Add New Product</button><br/><br/>
                    <div class="tbl_main table-responsive">
                        <table id="tblPlan" class="table hover">
                            <thead class="thead-dark">
                               <tr>
                                    <th>Catagory Name</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Image1</th>
                                    <th>Update</th>
                                    <th>Sell Status</th>
                                    <th>Product Status</th>
                                    <th>View More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "select * from listing_products where user_id=" . $_SESSION['user_id'] . "");

                                    while($row=mysqli_fetch_array($query))
                                    {
                                        $query_getcategory=mysqli_query($con,"select name from category_master where id=".$row['catagory_id']."");
                                        $name = mysqli_fetch_array($query_getcategory);
                                        echo "<tr>";
                                        echo "<td>".$name['name']."</td>";
                                         echo "<td>" . $row['product_name'] . "</td>";
                                        //echo "<td>" . $row['product_description'] . "</td>";
                                        echo "<td>". $row['price'] ."</td>";
                                        echo "<td><img src='../product_image/" . $row['img1'] . "' width='100px' class='rounded'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img2'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img3'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img4'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        echo "<td><button data-target='#UpdateProduct'  class='editcategory btn btn-primary btn-tone' data-toggle='modal' title='Edit' style='width:60px;height:45px' data-id='".$row['id']."'><i class=' anticon anticon-edit btn_edit' title='Edit'></i></button></td>";

                                        if($row['sell_status']=='Unsold')
                                        {
                                            echo "<td><button type='button' id='btnUnsold' name='btnUnsold' data-id='" . $row['id'] . "' class='btn btn-success UnSold'>Unsold</button></td>";
                                        }
                                        else
                                        {
                                            echo "<td><button type='button' id='btnSold'data-id='".$row['id']."' name='btnSold' class='btn btn-danger Sold'>Sold</button></td>";
 
                                        }
                                        if($row['product_status']=='Active')
                                        {
                                            echo "<td><button type='button' id='btnActive' name='btnActive' class='btn btn-success block-active' data-id='". $row['id'] ."'>Active</button></td>";
                                        }
                                        else
                                        {
                                            echo "<td><button type='button' id='btnBlock' name='btnBlock' class='btn btn-danger active-block' data-id='".$row['id']."'>Block</button></td>";
                                        }
                                        echo "<td><button type='button' data-id='".$row['id']."' id='btnView'  name='btnView' data-target='#ViewMore' data-toggle='modal' style='width:60px;height:45px' title='View more' class='btn viewmore btn-primary btn-tone'><i class='far fa-eye' title='View More'></i></button></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                            <tfoot>
                                 <tr>
                                    <th>Catagory</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image1</th>
                                    <th>Update</th>
                                    <th>Sell_Status</th>
                                    <th>Product_Status</th>
                                    <th>View More</th>
                                </tr>
                            </tfoot>
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
        $("#tblPlan").DataTable();
    </script>

    <script src="../new_js/bussiness_product.js"></script>
</body>

</html>
