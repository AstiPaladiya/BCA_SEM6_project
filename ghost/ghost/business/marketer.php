<?php
    $page = "Marketer";
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
        .editAssign:hover{
            cursor : pointer;
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
                    <!-- Switch Tabs -->
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Assign Product</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Add Marketer</a>
                        </li>
                    </ul>

                    <!-- Tab Contents -->
                    <!-- Assign Marketer Modal -->
                    <div class="tab-content m-t-15" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div style="font-size:23px;font-weight:bold">Product:</div>
                                <button class="btn btn-primary m-5" data-target="#assignprod" data-toggle="modal" id="assignProdBtn">Assign Product</button><br/><br/>
                                <div class="tbl_main table-responsive">
                                    <table id="tblProduct" class="table hover">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Marketer Name</th>
                                                <th>Product Name</th>
                                                <th>Commission</th>
                                                <th>Update</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                 $query = mysqli_query($con, "select * from marketer where user_id=" . $_SESSION['user_id'] . "");
                                                 while($row = mysqli_fetch_array($query))
                                                 {
                                                    $assign_prod = mysqli_query($con,"select * from assign_marketer where marketer_id=" . $row['id'] . "");
                                                    while($ans = mysqli_fetch_array($assign_prod))
                                                    {
                                                        $prd = mysqli_query($con, "select product_name from listing_products where id=" . $ans['product_id'] . "");
                                                        $prd_result = mysqli_fetch_array($prd);
                                                        echo "<tr>";
                                                        echo "<td>".$row['marketer_name']."</td>";
                                                        echo "<td id='editProductTable' >".$prd_result['product_name']."</td>";
                                                        echo "<td>" . $ans['comission'] . "</td>";
                                                        echo "<td><button data-target='#UpdateAssign'  class='btn btn-primary btn-tone editAssign' data-toggle='modal' title='Edit' style='width:60px;height:45px' data-id='".$ans['id']."'/><i class=' anticon anticon-edit btn_edit' title='Edit'></i></button></td>";
                                                        if($ans['status']=='Active')
                                                        {
                                                            echo "<td><button type='button' class='btn btn-success btn_styleprime activeAssign' id='btnProductActive' name='btnProductActive' data-id='".$ans['id']."'>Active</button></td>";
                                                        }
                                                        else
                                                        {
                                                            echo "<td><button type='button'  class='btn btn-danger btn_styledange blockAssign' id='btnProductBlock' name='btnProductBlock' data-id='".$ans['id']."'>Block</button></td>";
                                                        }
                                                        echo "</tr>";
                                                    }
                                                }
                                            
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Marketer Name</th>
                                                <th>Product Name</th>
                                                <th>Commission</th>
                                                <th>Update</th>
                                                <th>Status</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                <div style="font-size:23px;font-weight:bold">Marketer:</div>
                                <button class="btn btn-primary m-5" data-target="#addNewMarketer" data-toggle="modal" id="NewMarketer">Add New Marketer</button><br/><br/>
                            <div class="tbl_main table-responsive">
                                <table id="tblMarketer" class="table hover">
                                    <thead  class="thead-dark">
                                        <tr>
                                            <th>Marketer Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $query = mysqli_query($con, "select * from marketer where user_id=" . $_SESSION['user_id'] . "");
                                            while($row = mysqli_fetch_array($query))
                                            {
                                                echo "<tr>";
                                                echo "<td>".$row['marketer_name']."</td>";
                                                echo "<td>".$row['email']."</td>";
                                                if($row['status']=='Active')
                                                {
                                                    echo "<td><button type='button' class='btn btn-success btn_styleprime blockMarketer'  id='btnMarkterActive' name='btnMarketerActive' data-id=".$row['id'].">Active</button></td>";
                                                }
                                                else
                                                {
                                                    echo "<td><button type='button' class='btn btn-danger btn_styledange activeMarketer' id='btnMarketerBlock' name='btnMarkterBlock' data-id=".$row['id'].">Block</button></td>";
                                                }
                                                echo "</tr>";
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Marketer Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div> 
                        </div>
                    </div>
                     
                    <!--Add Marketer Model -->
                     <div class="modal fade" id="addNewMarketer" status="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >Add New Marketer</div>
                                </div>
                            <form method="post" id="marketer" enctype="multipart/form-data">
                                <div class="modal-body">
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Name:</label>
                                            <input type="text" id="txtName" name="txtName" class="form-control inpt_minifrm" placeholder="Name"/>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Email:</label>
                                            <input type="email" id="txtMail" name="txtMail" class="form-control inpt_minifrm" placeholder="E-mail address"/>
                                        </div>
                                        <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Password:</label>
                                            <input type="password" id="txtPwd" name="txtPwd" class="form-control inpt_minifrm" placeholder="Password"/>
                                            <span id="passChk" name="passChk" class='text-danger' style='font-size:small;display:none;'>Please enter atleast one small and capital alphabat charchter, one special keyword and one digit with minimum range of 5</span>
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
                <!-- Assign Product Model -->
                <div class="modal fade" id="assignprod" status="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >Assign Product</div>
                                </div>
                                <form method="post" id="product" enctype="multipart/form-data">
                              
                                <div class="modal-body">
                                    <div class="form-group">
                                                <label style="font-size:15px;font-weight:500">Marketer:</label>
                                                <select id="drpMark" name="drpMark" class="form-control inpt_minifrm">
                                                    <option value="">-- Select Marketer --</option>
                                                    <?php
                                                        $query = mysqli_query($con,"select * from marketer where user_id=".$_SESSION['user_id']." and status = 'Active'");
                                                        while($row=mysqli_fetch_array($query))
                                                        {
                                                            echo "<option value='".$row['id']."'>".$row['marketer_name']."</option>";
                                                        }
                                                    ?>
                                                </select>
                                    </div>
                                    <div class="form-group">
                                            <label style="font-size:15px;font-weight:500">Product:</label>
                                            <select id="drpPrd" name="drpPrd" class="form-control inpt_minifrm">
                                                <option value="">-- Select Product --</option>
                                                <?php
                                                     $query = mysqli_query($con,"select * from listing_products where user_id = ". $_SESSION['user_id'] ." and product_status = 'Active' and sell_status = 'Unsold'");
                                                     while($row=mysqli_fetch_array($query))
                                                     {
                                                        echo "<option value='".$row['id']."'>".$row['product_name']."</option>";
                                                     }
                                                ?>
                                            </select>
                                    </div>
                                    <div class="form-group">
                                        <label style="font-size:15px;font-weight:500">Comission:</label>
                                        <input type="number" id="txtCom" name="txtCom" class="form-control inpt_minifrm" placeholder="Comission"/>
                                        <br><span class='text-danger' style='font-size:small'>*Please enter Comission value only on percentage bases without percentage symbol*</span>
                                    </div>
                                </div>   
                                <div class="modal-footer">
                                    <button type="submit" id="btnProdctSubmit"  name="btnProdctSubmit" class="btn btn-primary btn_close">Save change</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>   
                 <!-- edit Product Model -->
                 <div class="modal fade" id="UpdateAssign" status="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                    <div class="modal-title" id="addNewPlanLabel" style="font-size:25px;font-weight:700;" >Edit Assign Product</div>
                                </div>
                                <form method="post" id="editmarketerproduct" enctype="multipart/form-data">
                                    <div class="modal-body" id="assignProduct">
                                    </div>   
                                <div class="modal-footer">
                                    <button type="button" id="btnEditProductSubmit"  name="btnEditProductSubmit" class="btn btn-primary btn_close">Save change</button>
                                    <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                </div>
                            </form> 
                        </div>
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
        $("#tblMarketer").DataTable();
        $("#tblProduct").DataTable();

    </script>

    <script src="../new_js/marketer.js"></script>

    <script>
        if(sessionStorage.getItem("current-admin-regusr") == "" || sessionStorage.getItem("current-admin-regusr") == null)
        {
            sessionStorage.setItem("current-admin-regusr", "home-tab");
        }
        else if(sessionStorage.getItem("current-admin-regusr") == "home-tab")
        {
            $("#myTab").children().find("a").removeClass("active");

        }
        else if(sessionStorage.getItem("current-admin-regusr") == "profile-tab")
        {
            $("#myTab").children().find("a").removeClass("active");

        }

    $(`#${sessionStorage.getItem("current-admin-regusr")}`).attr("aria-selected", true);
    $(`#${sessionStorage.getItem("current-admin-regusr")}`).addClass("active");

    $(".tab-pane").removeClass("active");
    $(".tab-pane").removeClass("show");
    $(`[aria-labelledby=${sessionStorage.getItem("current-admin-regusr")}]`).addClass("show");
    $(`[aria-labelledby=${sessionStorage.getItem("current-admin-regusr")}]`).addClass("active");

    $("#home-tab").click(function(){
        sessionStorage.setItem("current-admin-regusr", "home-tab");
    });
    $("#profile-tab").click(function(){
        sessionStorage.setItem("current-admin-regusr", "profile-tab");
    });
    </script>
</body>

</html>
