<?php
	session_start();
    include("../connection.php");
    $page = "Home";
    // if(!isset($_SESSION["front_user_id"]))
    // {
    //     header("Location:../user_login.php");
    // }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Ghost Marketer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
		
<!-- All FIles designing link -->
<?php include("include.php"); ?>
<style>
    .heart_nav{
		font-size:180%;
		color:black;
		/* background-color: white;
		border-radius: 50%;
		padding-top:2%;
		padding-bottom: 2%;
		padding-left: 2%;
		padding-right:2%; */
		text-align: center;
	}
	.subLogin
	{
		color:cornflowerblue;
		font-size:120%;
	}
	.login:hover{
		background-color:orange;
		color:white;
		border: 3px solid black; 
		/* box-shadow: 3px 3px 5px 2px black; */
		animation: pulse 1s ease-in-out;
  		transition: .3s;
	}
	.main-menu{
		font-weight:600;
		font-family: Georgia, 'Times New Roman', Times, serif;
		/* letter-spacing: 2px; */
	}
	.ghstHover:hover{
		color:brown;
	}
	.MultiCarousel { 
		float: left; 
		overflow: hidden; 
		padding: 15px; 
		width: 100%; 
		position:relative; 
		
	}
    .MultiCarousel .MultiCarousel-inner { 
		transition: 1s ease all; 
		float: left;
		background-color:whitesmoke;
 }
     .MultiCarousel .MultiCarousel-inner .item { float: left;}
    .MultiCarousel .MultiCarousel-inner .item > div 
	{
			text-align: center; 
			padding:10px; 
			margin:10px; 
			/* background:#ccc;  */
			color:#666;
	}
    .MultiCarousel .leftLst, .MultiCarousel .rightLst { 
		position:absolute; 
		border-radius:50%;
		top:calc(50% - 20px); 
	}
    .MultiCarousel .leftLst { left:0; }
    .MultiCarousel .rightLst { right:0; }
    .MultiCarousel .leftLst.over, .MultiCarousel .rightLst.over { pointer-events: none; background:#ccc; }
	@media (max-width : 411px){
  .gallery-overlay{
    width: 1000px;
    height: 279.03px;
    top:0;
    left:0;
  }
}
.main_card
{
    border:1px solid lightgrey ;
    /* background-color: white; */
}
.inner_card
{
    border-bottom:1px solid lightgrey ;
    font-weight:bold;
}
.inpt
{
  
    border:1px solid lightgrey;
    
}

input[type=file]::file-selector-button {
  margin-right: 20px;
  border: none;
  background:skyblue;
  padding: 10px 20px;
  border-radius: 10px;
  color: #fff;
  cursor: pointer;
  transition: background .2s ease-in-out;
}

input[type=file]::file-selector-button:hover {
  background: #0d45a5;
}

/* .sec-gallery{
    background-color: whitesmoke;
} */
</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->
    <!-- Main content start -->
<div class="sec-gallery bg0 p-t-145 p-b-98">
    <div class="main-content">
         <div class="container">
            <form action="" method="post" id="frm">
            <?php
                $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] ."");
                $result = mysqli_fetch_array($query);
            ?>
            <!-- <form id="profile" method="post" enctype="multipart/form-data"> -->
                
                <div class="card main_card">
                    <div class="card-header inner_card">
                        <h4 class="card-title">Basic Infomation</h4>
                    </div>
                    <div class="card-body">
                            <div class="media align-items-center">
                                <div class="avatar avatar-image  m-h-10 m-r-15" style="height: 80px; width: 80px">
                                                                            <!-- <input type="file" class="btn btn-tone"  id="btnUpload" name="btnUpload"/> -->
                                    <button type="button" id="btnImg" title="Edit Picture" name="btnImg">
                                        <?php
                                            if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
                                            {
                                                if($result['gender']=='male')
                                                {
                                                    echo"<img src='../image/male_profile.png' id='imgProfile' style='height: 80px; width: 80px'>";
                                                }
                                                else
                                                {
                                                    echo"<img src='../image/female_profile.png' id='imgProfile' style='height: 80px; width: 80px'>";
                                                }
                                            }
                                            else
                                            {
                                               echo"<img style='height: 80px; width: 80px' src='../user_profile/".$result['profile_img']."' id='imgProfile' />";
                                            }
                                            // echo $_SESSION['front_user_gender'];
                                        ?>
                                    </button>
                                </div>
                                <div class="m-l-20 m-r-20">
                                    <h5 class="m-b-5 font-size-18"><?php echo $result['owner_name']; ?></h5>
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
                                    <input type="text" class="form-control inpt" id="txtName" name="txtName" placeholder="Enter yourName" value="<?php echo $result['owner_name'] ?>"/>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="font-weight-semibold" for="email">Email:</label>
                                    <input type="text" class="form-control" id="txtMail" name="txtMail" readonly value="<?php echo $result['email'] ?>"  placeholder="email@example.com"/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label class="font-weight-semibold" for="phoneNumber">Phone Number:</label>
                                    <input type="number" class="form-control inpt" id="txtPhone" name="txtPhone" value="<?php echo $result['phone'] ?>" placeholder="Phone Number"/>
                                </div>
                                <!-- <div class="form-group col-md-4">
                                    <label class="font-weight-semibold" for="dob">Date of Birth:</label>
                                    <input type="text" class="form-control" id="dob" placeholder="Date of Birth">
                                </div> -->
                                <div class="form-group col-md-6 ml-5">
                                    <label class="font-weight-semibold form-check-label" for="language">Gender:</label>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input gn" <?php
                                            if($result['gender'] == "male")
                                            {
                                                echo "checked";
                                            }
                                        ?> id="rdGender1" value="male" name="rdGender">
                                        <label for="rdGender1" class="form-check-label">Male</label>
                                        <!-- male -->
                                    </div>
                                    <div class="form-check">
                                        <input type="radio" class="form-check-input gn" <?php
                                            if($result['gender'] == "female")
                                            {
                                                echo "checked";
                                            }
                                        ?> id="rdGender2" value="female"  name="rdGender">
                                        <label for="rdGender2" class="form-check-label">Female</label>
                                        <!-- female -->
                                    </div>
                                    <div class="form-check temp">
                                        <input type="radio" class="form-check-input gn" <?php
                                            if($result['gender'] == "others")
                                            {
                                                echo "checked";
                                            }
                                        ?> id="rdGender3" value="others"  name="rdGender">
                                        <label for="rdGender3" class="form-check-label">Others</label>
                                        <!-- others -->
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
                <div class="card main_card">
                    <div class="card-header inner_card">
                        <h4 class="card-title">Change Password</h4>
                    </div>
                        <div class="card-body">
                            <!-- <form id="secFrm" method="post"> -->
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="newPassword">Password:</label>
                                        <input type="password" class="form-control inpt" id="txtPwd" name="txtPwd"  placeholder="Password">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control inpt" id="txtCon" name="txtCon" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div>
                                    <!-- <button class="btn btn-dark" type="button" id="button2" name="button2">Save Change</button> -->
                                </div>
                            <!-- </form> -->
                        </div>
                    <!-- </div> -->
                </div>
                   
                   
                    <div class="card main_card">
                        <div class="card-header inner_card">
                            <h4 class="card-title">Address Details</h4>
                        </div>
                        <div class="card-body">
                            <!-- <form id="thirdFrm" method="post"> -->
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label class="font-weight-semibold" for="fullAddress">Full Address:</label>
                                        <textarea type="text" class="form-control inpt" id="txtAdd" name="txtAdd"    placeholder="Full Address"><?php echo $result['address'] ?></textarea>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="stateCity">Pincode No:</label>
                                        <input type="number" class="form-control inpt" id="pincode" name="pincode" value="<?php echo $result['pincode'] ?>" placeholder="Pincode">
                                    </div> <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="state">State:</label>
                                        <input type="text" class="form-control inpt" id="txtState" name="txtState" readonly  value="<?php echo $result['state'] ?>" placeholder="State">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="font-weight-semibold" for="City">City:</label>
                                        <input type="text" class="form-control inpt" id="txtCity" name="txtCity" readonly  value="<?php echo $result['city'] ?>" placeholder="City">
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
    </div>
</div>
    <!-- Main content end -->
	<!-- footer start -->
    <?php include("footer.php"); ?>
	<!-- footer end -->
	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="lnr lnr-chevron-up"></span>
		</span>
	</div>

<!--===============================================================================================-->
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>

<!-- Validation js -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="vendor/slick/slick.min.js"></script>
    <script src="js/slick-custom.js"></script>
<!--===============================================================================================-->
    <script src="vendor/parallax100/parallax100.js"></script>
<!--===============================================================================================-->
    <script src="vendor/lightbox2/js/lightbox.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/isotope/isotope.pkgd.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>
<!-- Bootstrapgrowl -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Pagination for page -->
<!-- <script type="text/javascript" src="path_to/jquery.js"></script>
<script type="text/javascript" src="path_to/jquery.simplePagination.js"></script> -->
	<!-- <script src="js/main.js"></script> -->
	<script src="../new_js/time.js"></script>
	<script src="../new_js/item_carousal.js"></script>
    <!-- Update Profile js -->
    <script src="../new_js/update_profile.js"></script>
    <script src="../new_js/user_footer.js"></script>
</body> 
</html>