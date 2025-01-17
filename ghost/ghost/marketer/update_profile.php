<?php
    $page="Index";
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
        .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey ;
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
                    <form action="" method="post" id="markFrm">
                            <?php
                                $query = mysqli_query($con, "SELECT * FROM `marketer` WHERE `id` = ". $_SESSION['mark_id'] ."");
                                $result = mysqli_fetch_array($query);
                            ?>
                            <!-- <form id="profile" method="post" enctype="multipart/form-data"> -->
                
                            <div class="card main_card inpt_minifrm">
                                <div class="card-header inner_card">
                                    <h4 class="card-title heading">Basic Infomation</h4>
                                </div>
                                <div class="card-body" style="border-top:1px solid lightgrey">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                            <img src="../image/mark.png" alt="Profile">
                                        </div>
                                        <div class="m-l-20 m-r-20">
                                            <h5 class="m-b-5 font-size-18"><?php echo $result['marketer_name'] ?></h5>
                                            <p class="opacity-07 font-size-13 m-b-0">
                                                Role:Marketer
                                            </p>
                                        </div>
                                        <div>
                                            <!-- <button class="btn btn-tone btn-primary" type="button" id="btnUpload" name="btnUpload">Upload</button> -->
                                            <!-- <input type="file" accept="image/*"  id="btnInpt" name="btnInpt" hidden/> -->
                                        </div>
                                    </div>
                                    <hr class="m-v-25">
                                    <!-- <form id="frm" method="post"> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="userName">Name:</label>
                                                <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Enter your name" value="<?php echo $result['marketer_name'] ?>"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="email">Email:</label>
                                                <input type="text " class="form-control" id="txtMail" name="txtMail" readonly value="<?php echo $result['email'] ?>"  placeholder="email@example.com"/>
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <div class="card main_card inpt_minifrm">
                                    <div class="card-header inner_card">
                                        <h4 class="card-title heading">Change Password</h4>
                                    </div>
                                    <div class="card-body" style="border-top:1px solid lightgrey">
                                        <!-- <form id="secFrm" method="post"> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-semibold" for="newPassword">Password:</label>
                                                <input type="password" class="form-control" id="txtPwd" name="txtPwd"  placeholder="Password">
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                                <input type="password" class="form-control" id="txtCon" name="txtCon" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div>
                                            <button class="btn btn-dark" id="btnSub" type="button" name="btnSub">Save Change</button>
                                        </div>
                                    </div>
                            </div>
                    </form>        
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
    <script src="../new_js/marketer_update_profile.js"></script>
    </body>

</html>