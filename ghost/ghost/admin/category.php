<?php
    $page="category";
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
            cursor : pointer;
        }

        @media (max-width : 411px){
            .editcategory{
                width: 50%;
            }
        }
        .av
        {
            width:10%;
            height:10%;
        }
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
            margin-right: 20px;
            border: none;
            background-color:rgba(108, 122, 137,1);
            padding: 7px 7px;
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

                    <!-- Add Category Modal -->
                    <div class="modal fade" id="addcategory" status="dialog">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content justify-content-center">
                                <div class="modal-header justify-content-center">
                                    <h5 style="font-size:25px;font-weight:700;" >Add New Category</h5>
                                </div>
                                <hr>
                                <form id="add_category_form" class="form" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label class="form-label label_style">Category Name :</label>
                                            <input type="text" class="form-control inpt_minifrm"  id="cat_name" name="cat_name" />
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label label_style">Category Icon :</label><br/>
                                            <input type="file" class="inpt_minifrm form-control " accept="image/*" id="cat_icon" name="cat_icon" />
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn_close" name="save" id="save">Save Change</button>
                                    <button class="btn btn-dark btn-tone" type="button" data-toggle="modal" data-target="#addcategory">Close</button>
                                </div>
                                </form>

                                <?php
                                    if(isset($_POST['save']))
                                    {
                                        move_uploaded_file($_FILES['cat_icon']['tmp_name'], "../image/category_images/" . $_FILES['cat_icon']['name']);
                                        $query = mysqli_query($con, "insert into category_master(name, icon) values('". $_POST['cat_name'] ."', '". $_FILES['cat_icon']['name'] ."')");

                                        echo "<script>window.location.replace('category.php');</script>";
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <!-- Edit Category Modal -->
                    <div class="modal fade" id="editcategory">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content justify-content-center">
                                <div class="modal-header justify-content-center">
                                    <h5 class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;">Edit Category</h5>
                                </div>
                                <hr>
                                <form id="edit_category_form" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group" hidden>
                                        <input type="number" name="category_id" id="category_id" class="form-control" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label_style">Category Name :</label>
                                        <input type="text" name="editCategory" readonly="readonly" id="editCategory" class="form-control inpt_minifrm" />
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label label_style">Select New Icon :</label>
                                        <input type="file" accept="image/*" id="editIcon" name="editIcon" class="form-control inpt_minifrm" />
                                        <span class="font-italic text-danger" style="font-size: smaller;">*Only select category image if you want to change</span>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <hr>
                                    <button class="btn btn-primary btn_close" id="edit" name="edit" type="submit">Save Change</button>
                                    <button class="btn btn-dark btn-tone" type="button" id="updatemodalclose" data-toggle="modal" data-target="#editcategory">Close</button>
                                </div>
                                </form>

                                <?php
                                if(isset($_POST['edit']))
                                {
                                    //code for getting the size of image
                                    // $size = getimagesize($_FILES['editIcon']['tmp_name']);
                                    // $array = explode(' ',$size[3]);
                                    // $width = $array[0];
                                    // $height = $array[1];

                                    // // $firstquote = strpos($width, "\"");
                                    // $width = substr($width, strpos($width, "\"") + 1, (strripos($width, "\"") - 7));
                                    // $height = substr($height, strpos($height, "\"") + 1, strrpos($height, "\"") - 8);
                                    // echo "<script>alert('$width and $height');</script>";

                                    //code for updating database
                                    $query = "update category_master set name = '" . $_POST['editCategory'] . "'";
                                    if($_FILES['editIcon']['name'] == "")
                                    {
                                        //image not selected
                                        $query .= " where id = " . $_POST['category_id'] . "";
                                    }
                                    else
                                    {
                                        //image selected query
                                        $query .= ", icon = '" . $_FILES['editIcon']['name'] . "' where id = " . $_POST['category_id'] . "";

                                        //old image deleting code
                                        $get_old_image = mysqli_query($con, "select icon from category_master where id = ". $_POST['category_id'] ."");
                                        $result = mysqli_fetch_array($get_old_image);

                                        if(file_exists("../image/category_images/" . $result[0]))
                                        {
                                            unlink("../image/category_images/" . $result[0]);
                                        }

                                        move_uploaded_file($_FILES['editIcon']['tmp_name'], "../image/category_images/" . $_FILES['editIcon']['name']);
                                    }

                                    $edit_category_query = mysqli_query($con, $query);

                                    if($edit_category_query > 0)
                                    {
                                        echo "<script>window.location.replace('category.php');</script>";
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div style="font-size:23px;font-weight:bold">Category:</div>
                    <button class="btn btn-primary m-5 " data-target="#addcategory" data-toggle="modal" id="addcategory" >Add New Category</button><br/><br/>
                    <div class="tbl_main table-responsive" >   
                        <table class="table hover" id="categorytable">
                            <thead class="bg-dark">
                                <tr>
                                    <th class="text-light">Name</th>
                                    <th class="text-light">Icon</th>
                                    <th class="text-light">Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "select * from category_master");

                                    while($result = mysqli_fetch_array($query))
                                    {?>
                                        <tr>
                                            <td><?php echo $result['name'] ?></td>
                                            <td><img src="../image/category_images/<?php echo $result['icon']; ?>" class="avatar av rounded-square"></td>
                                            <td><button data-target="#editcategory" style='width:60px;height:45px;'  data-toggle="modal" class="editcategory btn btn-primary btn-tone" title="Edit Catagory" style='width:60px;height:45px' data-id="<?php echo $result['id'] ?>" ><i class=" anticon anticon-edit btn_edit " title="Edit Catagory"></i></button></td>
                                            <!-- <td><img data-target="#editcategory" class="editcategory avatar" data-toggle="modal" src="../image/edit-button.png" width="40%" data-id="<?php echo $result['id'] ?>"></td> -->
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
        $("#categorytable").DataTable();
    </script>
    <!-- Catagory Js -->
      <script src="../new_js/addcategory.js"></script>
</body>

</html>