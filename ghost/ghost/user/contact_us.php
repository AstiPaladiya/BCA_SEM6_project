<?php
	session_start();
    include("../connection.php");
	$page = "Contact_Us";
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
	<!-- Item crousal link -->
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>

   
	<!-- <a href="https://2yu.co">2yu</a>
	<a href="https://embedgooglemap.2yu.co/">html embed google map</a> -->
<!-- All FIles designing link -->
<?php include("include.php"); ?>
<style>
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
.mapouter{position:relative;text-align:right;height:100%;width:100%;}
.gmap_canvas {overflow:hidden;background:none!important;height:100%;width:100%;}
/* Set the size of the div element that contains the map */
/* #map {
  height: 400px; /* The height is 400 pixels */
/*width: 100%; /* The width is the width of the web page */
/*} */
/* .imgStyle
{
	padding-left: 30%;
} */
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

</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->
    <!--Main content start  -->
    <!-- Form Contact -->

<section class="bg0 p-t-145 p-b-100">
	<!-- <div class="row"> -->
		<!-- <div class="col-6">
			 <section class="p-t-90 p-b-45" style="background-color:#ccc;"> 
				<div class="row text-center">
					<div class="col-sm-6 col-lg-3 p-b-50">
						<div class="flex-col-c-m p-rl-25">
							<div class="wrap-pic-max-s p-b-25">
								<img src="images/icons/icon-address.png" alt="IMG">
							</div>

							<h5 class="txt-m-114 cl3 txt-center p-b-9">
								Address
							</h5>

							<span class="txt-s-101 cl6 txt-center">
							C.B.Patel Computer College, Althan, Surat
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-3 p-b-50">
						<div class="flex-col-c-m p-rl-25">
							<div class="wrap-pic-max-s p-b-25">
								<img src="images/icons/icon-phone-03.png" alt="IMG">
							</div>

							<h5 class="txt-m-114 cl3 txt-center p-b-9">
								Phone
							</h5>

							<span class="txt-s-101 cl6 txt-center">
								(+91)63527 78198
							</span>

							<span class="txt-s-101 cl6 txt-center">
								(+91) 99247 21067
							</span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-3 p-b-50">
						<div class="flex-col-c-m p-rl-25">
							<div class="wrap-pic-max-s p-b-25 p-t-5">
								<img src="images/icons/icon-mail-03.png" alt="IMG">
							</div>

							<h5 class="txt-m-114 cl3 txt-center p-b-9">
								Emaill contact
							</h5>

							<span class="txt-s-101 cl6 txt-center">
								ghostmarketer2125@gmail.com
							</span>

							<span class="txt-s-101 cl6 txt-center">
								ryanpatel@example.com
							</span> 
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6 col-lg-3 p-b-50">
						<div class="flex-col-c-m p-rl-25">
							<div class="wrap-pic-max-s p-b-25">
								<img src="images/icons/icon-web.png" alt="IMG">
							</div>

							<h5 class="txt-m-114 cl3 txt-center p-b-9">
								Website
							</h5>

							<span class="txt-s-101 cl6 txt-center">
								<a href="https://ghostmarketer.000webhostapp.com">https://ghostmarketer.000webhostapp.com</a>
							</span>
						</div>
					</div>
				</div>
			</section>
		 </div>
		<div class="col-6"> -->
			<div class="container">
				<div class="size-a-1 flex-col-c-m p-b-70">
					<div class="txt-center txt-m-201 cl10 how-pos1-parent m-b-14">
						Get In Touch

						<div class="how-pos1">
							<!-- <img src="images/icons/symbol-02.png" alt="IMG"> -->
						</div>
					</div>

					<h3 class="txt-center txt-l-101 cl3 respon1">
						Leave us a message!
					</h3>
				</div>

				<form id="cntfrm"  method="post" >
					<div class="row">
						<div class="col-sm-6 p-b-30">
							<label>E-mail Address:</label>
							<div>
								<input  type="text" class="txt-s-101 cl3 plh1 size-a-46 bo-all-1 bocl15 focus1 p-rl-20" <?php 
									if(isset($_SESSION['front_mail']))
									{
										echo "value='". $_SESSION['front_mail'] ."' style='background-color:lightgray;' readonly";
									}
								?> id="txtMail" name="txtMail"/>
							</div>
						</div>
					</div>
						  <!-- <div class="col-sm-6 p-b-30"> 
							<div class="validate-input" data-validate = "Name is required">
								<input class="txt-s-101 cl3 plh1 size-a-46 bo-all-1 bocl15 focus1 p-rl-20" type="text" name="name" placeholder="Your Full Name *">
							</div>
						</div>  -->
					 <div class="row">
						<div class="col-sm-6 p-b-30">
							<label>Full Name:</label>
							<div>
								<input class="txt-s-101 cl3 plh1 size-a-46 bo-all-1 bocl15 focus1 p-rl-20" type="text" id="txtName" name="txtName" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 p-b-30">
							<label>Phone no:</label>
							<div>
								<input class="txt-s-101 cl3 plh1 size-a-46 bo-all-1 bocl15 focus1 p-rl-20" type="number" id="txtNum" name="txtNum" />
							</div>
						</div>
					</div>
					<div class="row">	
						<div class="col-12 p-b-30">
							<label>Message:</label>
							<div>
								<textarea class="txt-s-101 cl3 plh1 size-a-47 bo-all-1 bocl15 focus1 p-rl-20 p-tb-10"  id="txtMsg" name="txtMsg" ></textarea>
							</div>	
						</div>
					</div>

					<div class=" p-t-10">
						<button class="flex-c-m txt-s-103 cl0 bg10 size-a-2 hov-btn2 trans-04" id="btnCnt"  name="btnCnt" type="button">
							Send us now
						</button>
						 <!-- <button type="button" class="btn btn-success btn-tone" id="btnCnt" name="btnCnt">Send</button>  -->
					</div>
				</form>
			</div>
		<!-- </div> -->
	<!-- </div> -->
	</section> 
    <!-- Map -->
	<!-- <h3>My Google Maps Demo</h3> -->
    <!--The div element for the map -->
	<div class="mapouter">
		<div class="gmap_canvas">
			<iframe width="100%" height="70%" id="gmap_canvas" src="https://maps.google.com/maps?q=c.b. patel computer colleage&t=&z=10&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><
		</div>
	</div>

  
	<!-- Ccontact -->
	<section class="container-fluid p-t-90 p-b-45" style="background-color:whitesmoke;padding-left:8%;">
		<div class="row ">
			<div class="col-sm-6 col-lg-2 p-b-50 ml-3">
				<div class="flex-col-c-m p-rl-25">
					<div class="wrap-pic-max-s p-b-25 imgStyle" >
						<img src="../image/location.png" alt="IMG" width="60px" height="60px">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Address
					</h5>

					<span class="txt-s-101 cl6 txt-center">
					C.B.Patel Computer College, Althan, Surat
					</span>
				</div>
			</div>

			<div class="col-sm-6 col-lg-2 p-b-50 ml-3">
				<div class="flex-col-c-m p-rl-25">
					<div class="wrap-pic-max-s p-b-25  imgStyle">
						<img src="../image/telephone.png" alt="IMG" width="60px" height="60px">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Phone
					</h5>

					<span class="txt-s-101 cl6 txt-center">
						(+91)63527 78198
					</span>

					<span class="txt-s-101 cl6 txt-center">
						(+91) 99247 21067
					</span>
				</div>
			</div>

			<div class="col-sm-6 col-lg-2 p-b-50 ml-3">
				<div class="flex-col-c-m p-rl-10">
					<div class="wrap-pic-max-s p-b-25 p-t-5 imgStyle" >
						<img src="../image/envelope.png" alt="IMG" width="60px" height="60px">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Email contact
					</h5>

					<span class="txt-s-101 cl6 txt-center">
						ghostmarketer2125@gmail.com
					</span>

					<!-- <span class="txt-s-101 cl6 txt-center">
						ryanpatel@example.com
					</span> -->
				</div>
			</div>
			<div class="col-sm-6 col-lg-2 p-b-50 ml-2">
				<div class="flex-col-c-m p-rl-10">
					<div class="wrap-pic-max-s p-b-25 p-t-5 imgStyle" >
					<img src="../image/chat.png" alt="IMG" width="70px" height="60px">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Live Chat
					</h5>

					<!-- <span class="txt-s-101 cl6 txt-center">
						ghostmarketer2125@gmail.com
					</span> -->

					<!-- <span class="txt-s-101 cl6 txt-center">
						ryanpatel@example.com
					</span> -->
				</div>
			</div>

			<!-- <div class="col-sm-6 col-lg-2 p-b-50 ml-3">
				<div class="flex-col-c-m p-rl-25">
					<div class="wrap-pic-max-s p-b-25  p-t-5 imgStyle pl-2" >
						<img src="../image/chat.png" alt="IMG" width="100%" height="100%">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Live chat
					</h5>

					<span class="txt-s-101 cl6 txt-center">
						
					</span>
				</div>
			</div> -->

			<div class="col-sm-6 col-lg-2 p-b-50 ml-3">
				<div class="flex-col-c-m p-rl-25">
					<div class="wrap-pic-max-s p-b-25 imgStyle" >
						<img src="../image/globalization.png" alt="IMG" width="60px" height="60px">
					</div>

					<h5 class="txt-m-114 cl3 txt-center p-b-9">
						Website
					</h5>

					<span class="txt-s-101 cl6 txt-center">
						<a href="https://ghostmarketer.000webhostapp.com">https://ghostmarketer.000webhostapp.com</a>
					</span>
				</div>
			</div>

		</div>
	</section>
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
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/revolution/js/jquery.themepunch.tools.min.js"></script>
	<script src="vendor/revolution/js/jquery.themepunch.revolution.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.video.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.carousel.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.slideanims.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.actions.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.layeranimation.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.kenburn.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.navigation.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.migration.min.js"></script>
	<script src="vendor/revolution/js/extensions/revolution.extension.parallax.min.js"></script>
	<script src="js/revo-custom.js"></script>
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
<!-- Form validation cdn -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>

<!-- Bootstrapgrowl -->
<!-- <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB41DRUbKWJHPxaFjMAwdrzWzbVKartNGg&callback=initMap&v=weekly"
      defer
    ></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="js/main.js"></script>
	<script src="../new_js/time.js"></script>
	<script src="../new_js/item_carousal.js"></script>
	<script src="../new_js/user_footer.js"></script>
	<script src="../new_js/contact_us.js"></script>
	<!-- map js -->
	<!-- <script src="../new_js/map.js"></script> -->
</body>
</html>