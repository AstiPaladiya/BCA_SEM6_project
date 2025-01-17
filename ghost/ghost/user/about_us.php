<?php
	session_start();
    include("../connection.php");
	$page = "About_Us";
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
.imgStyle
{
	padding-left: 30%;
}
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

        <!-- Main Content -->

        <section class="sec-story bg0 p-t-150 p-b-100">
		<div class="container">
			<div class="flex-w flex-sb-t">
				<div class="size-w-31 wrap-pic-w how-shadow2 bo-all-15 bocl0 w-full-md">
					<img src="../image/banner_ghost.png" alt="IMG">
				</div>

				<div class="size-w-32 p-t-43 w-full-md">
					<h3 class="txt-center txt-l-401 cl15 p-b-44">
						Story Behind Ghost Marketer
					</h3>

					<p class="txt-center txt-m-115 cl6 p-b-25">
						Ghost Marketer was actually a concept that came in the minds of 2 young IT students, who are currently CEO of Ghost Marketer.
					</p>

					<p class="txt-center txt-m-115 cl6 p-b-25">
						We wanted to build a full fledged platform for E-Commerce where each and every person is involved actively and every person can easily sell their product, whether it is new or an old item.
					</p>

                    <p class="txt-center txt-m-115 cl6 p-b-25">
						The name "Ghost Marketer" came from the thought that we are marketing your products, but actually you don't have met us, so you haven't known us. So we are ghostly marketing your product that's why we have named the website as "Ghost Marketer".
					</p>

					<p class="txt-center txt-m-115 cl6 p-b-25">
						The pleasure that we received when we launched the website was immense. There was a great support from our parents as well as from our connected faculty Prof. Mr. Maulik Chudawala did a great help for us.  
					</p>

					<div class="flex-w flex-c-b p-t-50 p-t-30">
						<img class="m-r-55" src="images/icons/sign.png" alt="SIGN">

						<div class="flex-col-l p-b-5">
							<span class="txt-m-401 cl10 p-b-2 text-danger">
								Asti Paladiya
							</span>

							<span class="txt-s-106 cl6">
								Co - CEO of Ghost Marketer
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- We Bring -->
	<section class="sec-bring bg-img1 p-t-145 p-b-100">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-40">
				<h3 class="txt-center txt-l-101 cl3 respon1">
					We bring
				</h3>
			</div>
			
			<div class="how-pos6-parent">
				<!--  -->
				<div class="flex-c-b how-pos6 dis-none-lg">
					<div class="size-w-28 wrap-pic-max-s w-full-sm">
						<img src="../image/banner_ghost.png" alt="IMG">
					</div>
				</div>
				
					
				<!--  -->
				<div class="flex-w flex-sb m-rl--15 m-rl-0-lg respon20">
					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-e w-full-lg">
							<div class="size-w-26 flex-r-m txt-right txt-m-109 cl3 respon6-01">
								Genuine Dealers
							</div>

							<!-- <div class="size-w-25 flex-r-m respon6-02">
								<img src="images/icons/symbol-20.png" alt="SYMBOL">
							</div> -->

							<p class="txt-right txt-s-101 cl6 p-t-7 respon6-03">
								The dealers which are registered on our website are all genuine.
							</p>
						</div>
					</div>

					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-s w-full-lg">
							<!-- <div class="size-w-25 flex-m">
								<img src="images/icons/symbol-23.png" alt="SYMBOL">
							</div> -->

							<div class="size-w-26 flex-m txt-m-109 cl3">
								7 Days Return Policy
							</div>

							<p class="txt-s-101 cl6 p-t-7">
								We have a return policy of 7 days on all listed products.
							</p>
						</div>
					</div>

					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-c p-r-6 w-full-lg">
							<div class="size-w-26 flex-r-m txt-right txt-m-109 cl3 respon6-01">
								Chat for C2C
							</div>

							<!-- <div class="size-w-25 flex-r-m respon6-02">
								<img src="images/icons/symbol-21.png" alt="SYMBOL">
							</div> -->

							<p class="txt-right txt-s-101 cl6 p-t-7 respon6-03">
								We have a live chatting feature for Customer to Customer product selling.
							</p>
						</div>
					</div>

					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-c p-l-6 w-full-lg">
							<!-- <div class="size-w-25 flex-m">
								<img src="images/icons/symbol-24.png" alt="SYMBOL">
							</div> -->

							<div class="size-w-26 flex-m txt-m-109 cl3">
								Listen to Feedback
							</div>

							<p class="txt-s-101 cl6 p-t-7">
								We are constantly hearing your valuable feedback and working on them as fast as possible.
							</p>
						</div>
					</div>

					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-s w-full-lg">
							<div class="size-w-26 flex-r-m txt-right txt-m-109 cl3 respon6-01">
								Premium Features
							</div>

							<!-- <div class="size-w-25 flex-r-m respon6-02">
								<img src="images/icons/symbol-22.png" alt="SYMBOL">
							</div> -->

							<p class="txt-right txt-s-101 cl6 p-t-7 respon6-03">
								We have premium features available starting from affordable prices.
							</p>
						</div>
					</div>

					<div class="size-w-24 flex-col p-t-50 p-b-30 respon5">
						<div class="flex-w flex-str size-w-27 al-self-e w-full-lg">
							<!-- <div class="size-w-25 flex-m">
								<img src="images/icons/symbol-25.png" alt="SYMBOL">
							</div> -->

							<div class="size-w-26 flex-m txt-m-109 cl3">
								Best Service
							</div>

							<p class="txt-s-101 cl6 p-t-7">
								We are not the one that don't listen to our users. We are constantly in touch which are users.
							</p>
						</div>
					</div>
				</div>
				
			</div>
		</div>
	</section>

	<!-- Our farmers -->
	<section class="sec-farmer bg0 p-t-145 p-b-70">
		<div class="container">
			<div class="size-a-1 flex-col-c-m p-b-70">
				<div class="txt-center txt-m-201 text-danger cl10 how-pos1-parent m-b-14">
					Our Building Blocks

					<!-- <div class="how-pos1">
						<img src="images/icons/symbol-02.png" alt="IMG">
					</div> -->
				</div>

				<h3 class="txt-center txt-l-101 cl3 respon1">
					Our CEOs
				</h3>
			</div>



			<div class="row">
				<div class="col-sm-8 col-md-4 p-b-30 m-rl-auto">
					<div class="hov10 trans-04">
						<a href="#" class="hov-img0">
							<img src="../image/deep.jpeg" alt="IMG" width="700px" height="350px">
						</a>

						<div class="flex-col-c-m bg0 p-rl-15 p-t-37 p-b-35">
							<a class="txt-m-114 text-danger cl3 txt-center hov-cl10 trans-04 p-b-9">
								Deep Ganatra
							</a>

							<span class="txt-s-101 cl6 txt-center">
								Co - CEO of Ghost Marketer
							</span>

							<div class="flex-w flex-c-m p-t-30">
								<a href="https://www.instagram.com/deepganatra007/" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-instagram.png" alt="instagram">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-instagram2.png" alt="instagram">
								</a>

								<!-- <a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-twitter.png" alt="twitter">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-twitter2.png" alt="twitter">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-google.png" alt="google">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-google2.png" alt="google">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-facebook.png" alt="facebook">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-facebook2.png" alt="facebook">
								</a> -->
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-8 col-md-4 p-b-30 m-rl-auto">
					<div class="hov10 trans-04">
						<a href="#" class="hov-img0">
							<img src="../image/asti.jpeg" alt="IMG" width="700px" height="350px">
						</a>

						<div class="flex-col-c-m bg0 p-rl-15 p-t-37 p-b-35">
							<a class="txt-m-114 text-danger cl3 txt-center hov-cl10 trans-04 p-b-9">
								Asti Paladiya
							</a>

							<span class="txt-s-101 cl6 txt-center">
                                Co - CEO of Ghost Marketer
							</span>

							<div class="flex-w flex-c-m p-t-30">
								<a href="https://www.instagram.com/asti_paladiya_/" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-instagram.png" alt="instagram">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-instagram2.png" alt="instagram">
								</a>

								<!-- <a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-twitter.png" alt="twitter">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-twitter2.png" alt="twitter">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-google.png" alt="google">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-google2.png" alt="google">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-facebook.png" alt="facebook">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-facebook2.png" alt="facebook">
								</a> -->
							</div>
						</div>
					</div>
				</div>

				<!-- <div class="col-sm-8 col-md-4 p-b-30 m-rl-auto">
					<div class="hov10 trans-04">
						<a href="#" class="hov-img0">
							<img src="images/farmer-03.jpg" alt="IMG">
						</a>

						<div class="flex-col-c-m bg0 p-rl-15 p-t-37 p-b-35">
							<a href="#" class="txt-m-114 cl3 txt-center hov-cl10 trans-04 p-b-9">
								Carl Herrera
							</a>

							<span class="txt-s-101 cl6 txt-center">
								Vegetables
							</span>

							<div class="flex-w flex-c-m p-t-30">
								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-instagram.png" alt="instagram">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-instagram2.png" alt="instagram">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-twitter.png" alt="twitter">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-twitter2.png" alt="twitter">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-google.png" alt="google">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-google2.png" alt="google">
								</a>

								<a href="#" class="wrap-pic-max-s pos-relative lh-10 hov6 m-all-8">
									<img class="hov6-child1 trans-04" src="images/icons/icon-facebook.png" alt="facebook">
									<img class="ab-t-l hov6-child2 trans-04" src="images/icons/icon-facebook2.png" alt="facebook">
								</a>
							</div>
						</div>
					</div>
				</div> -->
			</div>
		</div>
	</section>

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
	<!-- <script src="../new_js/contact_us.js"></script> -->
	<!-- map js -->
	<!-- <script src="../new_js/map.js"></script> -->
</body>
</html>