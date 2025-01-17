<?php
    $page = "Index";
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
<style>    
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
        .label_style
        {
            font-size:15px;
            font-weight:500;
            /* color:black; */
        }
         .inpt_minifrm{
            /* background-color:whitesmoke;  */
            border:1px solid lightgrey ;
        }
        .profile
        {
            vertical-align: middle;
            height: 100px; 
            width:100px;
            /* border-radius:10px; */
            /* margin-bottom: 10px;
            margin-left: 0px;
            margin-right:5px; */
        }
        /* @media (max-width : 411px){
            .profile{
            vertical-align: middle;
            height: 100px; 
            width:40px;
            border-radius:50%;
             height:500px; 
                 text-align:center;
                font-size:500px; 
            }
        } */
        /* .heading{
            font-size:20px;
            
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
                <!-- Put All Content Here -->
                <!-- <div class="sec-gallery bg0 p-t-145 p-b-98">
                    <div class="main-content">
                        <div class="container"> -->
                        <form action="" method="post" id="frm">
                            <?php
                                $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` = ". $_SESSION['user_id'] ."");
                                $result = mysqli_fetch_array($query);
                            ?>
                            <!-- <form id="profile" method="post" enctype="multipart/form-data"> -->
                
                            <div class="card main_card inpt_minifrm">
                                <div class="card-header inner_card">
                                    <h4 class="card-title heading">Basic Infomation</h4>
                                </div>
                                <div class="card-body" style="border-top:1px solid lightgrey">
                                        <div class="media align-items-center">
                                            <div class=" avatar avatar-image  m-h-10 m-r-15 profile" >
                                                    <!-- <input type="file" class="btn btn-tone"  id="btnUpload" name="btnUpload"/> -->
                                                <button type="button" style="border:0px;" id="btnImg" title="Edit Picture" name="btnImg">
                                                    <?php
                                                        if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
                                                        {
                                                            if($result['gender']=='male')
                                                            {
                                                                echo"<img src='../image/male_profile.png' id='imgProfile' class='profile'>";
                                                            }
                                                            else
                                                            {
                                                                echo"<img src='../image/female_profile.png' id='imgProfile' class='profile'>";
                                                            }
                                                        }
                                                        else
                                                        {
                                                            echo"<img class='profile' style='align:center' src='../user_profile/".$result['profile_img']."' id='imgProfile' />";
                                                        }
                                                    ?>
                                                </button>
                                            </div>
                                            <div class="m-l-20 m-r-20">
                                                <h5 class="m-b-5 font-size-16" style="font-weight:500"><?php echo $result['owner_name']; ?></h5>
                                                <p class="opacity-07 font-size-13 m-b-0">
                                                    (Recommended Dimensions:120x120 <br>
                                                    Recommended file size: 5MB)
                                                </p>
                                            </div>
                                            <div>
                                                <button class="btn btn-tone btn-primary" type="button" id="btnUpload" name="btnUpload">Upload</button>
                                                <input type="file" accept="image/*"  id="btnInpt" name="btnInpt" hidden/>
                                            </div>
                                        </div>
                                    <!-- </form> -->
                                

                                    <hr class="m-v-25">
                                    <!-- <form id="frm" method="post"> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="userName">Name:</label>
                                                <input type="text" class="form-control" id="txtName" name="txtName" placeholder="Enter yourName" value="<?php echo $result['owner_name'] ?>"/>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="email">Email:</label>
                                                <input type="text " class="form-control" id="txtMail" name="txtMail" readonly value="<?php echo $result['email'] ?>"  placeholder="email@example.com"/>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-3" style="margin-right:10%">
                                                <label class="font-weight-semibold" for="phoneNumber">Phone Number:</label>
                                                <input type="number" class="form-control" id="txtPhone" name="txtPhone" value="<?php echo $result['phone'] ?>" placeholder="Phone Number"/>
                                            </div>
                                            <!-- <div class="form-group col-md-4">
                                                <label class="font-weight-semibold" for="dob">Date of Birth:</label>
                                                <input type="text" class="form-control" id="dob" placeholder="Date of Birth">
                                            </div> -->
                                            <div class="form-group col-md-3" >
                                                <label class="font-weight-semibold form-check-label" for="language">Gender:</label>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input gn" <?php
                                                        if($result['gender'] == "male")
                                                        {
                                                            echo "checked";
                                                        }
                                                    ?> id="rdGender1" value="male"  name="rdGender">Male
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" class="form-check-input gn" <?php
                                                        if($result['gender'] == "female")
                                                        {
                                                            echo "checked";
                                                        }
                                                    ?> id="rdGender2" value="female"  name="rdGender">Female
                                                </div>
                                                <div class="form-check temp">
                                                    <input type="radio" class="form-check-input gn" <?php
                                                        if($result['gender'] == "others")
                                                        {
                                                            echo "checked";
                                                        }
                                                    ?> id="rdGender3" value="others"  name="rdGender">Others
                                                </div>
                                            </div>
                                            <!-- <div class="form-group col-md-6">
                                                <label for="gender">Gender:</label>
                                                <div class="form-check">
                                                    <input type="radio" id="rdgender1" class="form-check-input" value="Male"  name="rdGender"/>Male
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="rdgender2" class="form-check-input" value="Female"  name="rdGender"/>Female
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="rdgender3" class="form-check-input" value="Other" name="rdGender"/>Other
                                                </div>
                                            </div> -->
                                        </div>
                                        <div>
                                                <!-- <button class="btn btn-dark" type="button" id="button1" name="button1">Save Change</button> -->
                                        </div>
                                    <!-- </form> -->
                                </div>
                            </div>
                            <div class="card main_card inpt_minifrm">
                                <div class="card-header inner_card">
                                    <h4 class="card-title heading">Bussiness Information</h4>
                                </div>
                                    <div class="card-body" style="border-top:1px solid lightgrey">
                                        <!-- <form id="secFrm" method="post"> -->
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold" for="newPassword">Bussiness Name:</label>
                                                    <input type="text" class="form-control" id="txtBus" name="txtBus" value="<?php echo $result['bussiness_name'] ?>"  placeholder="Bussiness name">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="font-weight-semibold" for="confirmPassword">GST No.:</label>
                                                    <input type="text" class="form-control" id="txtGst" name="txtGst" value="<?php echo $result['gst_no'] ?>" placeholder="Gst No">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4" >
                                                        <label class="font-weight-semibold" for="confirmPassword">Current Subscription Plan:</label>
                                                        <input type="text" class="form-control inpt_sub" id="txtSub" name="txtSub" value="<?php 
                                                        $query_sub=mysqli_query($con,"select * from subscription_master where id=".$result['subscrib_id']."");
                                                        $row_sub=mysqli_fetch_array($query_sub); 
                                                        echo $row_sub['subscription_name'];
                                                        ?>"  readonly  placeholder="Current Subscription plan">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="font-weight-semibold" for="confirmPassword">Current Subscr. Plan Expiary Date:</label>
                                                    <input type="text" class="form-control" id="txtDat" name="txtDat" value="<?php echo $result['expiary_date'] ?>" readonly placeholder="Gst No">
                                                </div>
                                            </div>
                                            <div>
                                                <!-- <button class="btn btn-dark" type="button" id="button2" name="button2">Save Change</button> -->
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                <!-- </div> -->
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
                                                <!-- <button class="btn btn-dark" type="button" id="button2" name="button2">Save Change</button> -->
                                            </div>
                                        <!-- </form> -->
                                    </div>
                                <!-- </div> -->
                            </div>
                   
                   
                            <div class="card main_card inpt_minifrm">
                                <div class="card-header inner_card">
                                    <h4 class="card-title heading">Address Details</h4>
                                </div>
                                <div class="card-body" style="border-top:1px solid lightgrey">
                                    <!-- <form id="thirdFrm" method="post"> -->
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label class="font-weight-semibold" for="fullAddress">Full Address:</label>
                                                <textarea type="text" class="form-control" id="txtAdd" name="txtAdd"    placeholder="Full Address"><?php echo $result['address'] ?></textarea>
                                            </div>
                                            <div class="form-group col-md-3" style="margin-right:5%">
                                                <label class="font-weight-semibold" for="stateCity">Pincode No:</label>
                                                <input type="number" class="form-control " id="pincode" name="pincode" value="<?php echo $result['pincode'] ?>" placeholder="Pincode">
                                            </div> 
                                            <div class="form-group col-md-3" style="margin-right:5%">
                                                <label class="font-weight-semibold" for="state">State:</label>
                                                <input type="text" class="form-control" id="txtState" name="txtState" readonly  value="<?php echo $result['state'] ?>" placeholder="State">
                                            </div>
                                            <div class="form-group col-md-3" style="margin-right:5%">
                                                <label class="font-weight-semibold" for="City">City:</label>
                                                <input type="text" class="form-control " id="txtCity" name="txtCity" readonly  value="<?php echo $result['city'] ?>" placeholder="City">
                                            </div>
                                            
                                            <!-- <div class="form-group col-md-6">
                                                <label class="font-weight-semibold" for="language">Language</label>
                                                <select id="language-2" class="form-control">
                                                    <option>United State</option>
                                                    <option>United Kingdom</option>
                                                    <option>France</option>
                                                    <option>German</option>
                                                </select>
                                            </div> -->
                                        </div>
                                        <div>
                                            <button class="btn btn-dark" id="button3" type="button" name="button3">Save Change</button>
                                        </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                <!-- </div>
                </div>
             </div> -->
          
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
<script src="../new_js/bussiness_update_prof.js"></script>
</body>

</html>