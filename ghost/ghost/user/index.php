<?php
	session_start();
    include("../connection.php");
	$MAC = exec('getmac');
  
	// Storing 'getmac' value in $MAC
	$MAC = strtok($MAC, ' ');
	
	// Updating $MAC value using strtok function, 
	// strtok is used to split the string into tokens
	// split character of strtok is defined as a space
	// because getmac returns transport name after
	// MAC address   
	$query = mysqli_query($con, "select count(*) from visitor_master where mac_address='".$MAC."'");
	$row = mysqli_fetch_array($query);
	if($row[0]<0)
	{
		mysqli_query($con, "insert into visitor_master (mac_address) values ('" . $MAC . "') ");

	}
	$page = "Home";
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
<style>
    body {
        top: 0px !important;
        }
    .icon-button__badge {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 10px;
        height: 10px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
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

@media(max-width : 411px)
{
	.font-lato{
		/* font : 200; */
	}
}


</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->
	<!-- slider start -->
		<?php include("slider.php") ?>
	<!-- slider end -->
	<!-- item carousel start -->
	<?php include("item_carousal.php"); ?>
	<!-- item carousal end -->
	<!-- Main content start -->
		<!-- Product -->
	<div class="sec-gallery bg0 p-t-145 p-b-98">
		<div class="container">
		<div class="row gallery-lb isotope-grid isotope-grid-gallery">
			<?php
				$query_user=mysqli_query($con,"select * from user_master where role=1 and status='active'");
				while($row_user=mysqli_fetch_array($query_user))
				{	
					$query_product=mysqli_query($con,"select * from listing_products where user_id=".$row_user['id']." and product_status='Active' and sell_status = 'Unsold' ORDER BY `id` DESC LIMIT 1");
					while($row_product=mysqli_fetch_array($query_product))
					{?>
						<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill">
							<div class="gallery-item wrap-pic-w">
								<img src="../product_image/<?php echo $row_product['img1']; ?>" width='370px' height='279.03px' alt="GALLERY">

								<div class="gallery-overlay flex-c-m trans-04">
									<div class="gallery-content flex-w flex-c-m w-full">
										<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery mb-5" href="../product_image/<?php echo $row_product['img1']; ?>">
											<!-- <img src="../image/fullscreen.png" alt="OPEN"> -->
											<i class="anticon anticon-fullscreen mt-1" style="font-size:25px;color:red;" title="Full Screen"></i>
										</a>

										<!-- <a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
											<img src="images/icons/icon-link.png" alt="LINK">
										</a> -->

										<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
											<span class="txt-m-101 cl0 txt-center" style="text-decoration:underline;padding-bottom:10px;">
												<?php echo $row_user['bussiness_name']; ?>
											</span>

											<span class="txt-s-200 cl0 txt-center" style="font-size:130%;">
												<?php echo $row_product['product_name']; ?>
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- // echo "<div class='col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill'>";
						// echo"<div class='gallery-item wrap-pic-w'>";
						// echo"<img src='../product_image/".$row_product['img1']."' width='370px' height='279.03px' alt='GALLERY'/>";
						// echo"<div class='gallery-overlay flex-c-m trans-04'>";
						// echo"<div class'gallery-content flex-w flex-c-m w-full'>";
						// echo"<a class='flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery' style='color:red;' width='1200px' height='905px'   href='../product_image/".$row_product['img1']."'><img src='../image/fullscreen.png' width='50%' alt='OPEN'/></a><br/>";
						// //  echo"<a href='#' class='flex-c-m gallery-btn m-all-5 trans-04'><img src='images/icons/icon-link.png' alt='LINK'></a>";
						// echo"<div class='gallery-txt flex-col-c p-rl-15 p-t-10 trans-04'>";
						// echo"<span class='txt-m-101 cl0 txt-center' style='text-decoration:underline;padding-bottom:10px;'>".$row_user['bussiness_name']."</span>";
						// echo"<span class='txt-s-200 cl0 txt-center' style='font-size:130%;'>".$row_product['product_name']."</span>";
						// echo"</div>";
						// echo"</div>";
						// echo"</div>";
						// echo"</div>";
						// echo"</div>";	 -->
					<?php
					}
				}
			?>
		</div>
		<!-- <div class="row gallery-lb isotope-grid isotope-grid-gallery">
				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-01.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-01.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill fruit-juic-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-02.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-02.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-03.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-03.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill fruit-juic-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-04.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-04.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill other-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-05.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-05.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item dried-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-06.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-06.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill fruit-juic-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-07.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-07.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item dried-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-08.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-08.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item vegetable-fill other-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-09.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-09.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item vegetable-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-10.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-10.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item dried-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-11.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-11.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-6 col-lg-4 p-b-30 isotope-item dried-fill other-fill">
					<div class="gallery-item wrap-pic-w">
						<img src="images/gallery-12.jpg" alt="GALLERY">

						<div class="gallery-overlay flex-c-m trans-04">
							<div class="gallery-content flex-w flex-c-m w-full">
								<a class="flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery" href="images/gallery-12.jpg">
									<img src="images/icons/icon-open.png" alt="OPEN">
								</a>

								<a href="#" class="flex-c-m gallery-btn m-all-5 trans-04">
									<img src="images/icons/icon-link.png" alt="LINK">
								</a>

								<div class="gallery-txt flex-col-c p-rl-15 p-t-10 trans-04">
									<span class="txt-m-109 cl0 txt-center">
										Nam libero tempore
									</span>

									<span class="txt-s-106 cl0 txt-center">
										Vegetable
									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> -->

			<!-- Pagination -->
			<!-- <div class="flex-w flex-c-m p-t-48">
				<a href="#" class="flex-c-m txt-s-115 cl6 size-a-23 bo-all-1 bocl15 hov-btn1 trans-04 m-all-3 active-pagi1">
					1
				</a>

				<a href="#" class="flex-c-m txt-s-115 cl6 size-a-23 bo-all-1 bocl15 hov-btn1 trans-04 m-all-3">
					2
				</a>

				<a href="#" class="flex-c-m txt-s-115 cl6 size-a-24 how-btn1 bo-all-1 bocl15 hov-btn1 trans-04 m-all-3 p-b-1">
					Next
					<span class="lnr lnr-chevron-right m-t-3 m-l-7"></span>
					<span class="lnr lnr-chevron-right m-t-3"></span>
				</a>
			</div> -->
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

	
<!-- All FIles designing link -->
<?php include("include.php"); ?>
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
<!-- Bootstrapgrowl -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!-- Pagination for page -->

	<script src="js/main.js"></script>
	<script src="../new_js/time.js"></script>
	<script src="../new_js/item_carousal.js"></script>
	<script src="../new_js/user_footer.js"></script>
</body>
</html>