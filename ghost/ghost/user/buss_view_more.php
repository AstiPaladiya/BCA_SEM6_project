<?php
	session_start();
	include("../connection.php");

	$query=mysqli_query($con,"select * from listing_products where id=".$_GET['id']."");
	$result = mysqli_fetch_array($query);

	if($result['product_status'] != "Active")
	{
		header("Location:shop.php");
	}

	$page = "Shop";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Ghost Marketer</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<!-- <link href="../assets/css/app.min.css" rel="stylesheet"> -->
	<link href="https://cdn.jsdelivr.net/npm/anticon@0.0.1/dist/iconfont.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/4148554c18.js" crossorigin="anonymous"></script>
	<link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/lightbox2/css/lightbox.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/noui/nouislider.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slide100/slide100.css">
<!--===============================================================================================-->
	<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" /> -->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<style>	
.avatar>img {
    display: block;
    width: 100%;
    height: 100%;
}
.avatar{
	font-size: .875rem;
    text-align: center;
    background: #f1f2f3;
    color: #fff;
    white-space: nowrap;
    position: relative;
    overflow: hidden;
    vertical-align: middle;
    width: 40px;
    height: 40px;
    line-height: 40px;
    border-radius: 50%;
    display: inline-block;
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
.main-menu{
		font-weight:600;
		font-family: Georgia, 'Times New Roman', Times, serif;
		/* letter-spacing: 2px; */
	}
.pic-deep-image{
        height: 600px;
        width: 600px;
    }
    @media(max-width:300px){
        .pic-deep-image{
        height: 250px;
        width: 250px;
    }
    }
	.btnaddtocart
	{
		min-width:160px;
  		height:60px;
		opacity:0.9;
		letter-spacing: 2px;
		font-weight: 700;
	}
	.btnbuynow
	{
		min-width:160px;
		height:60px;
		opacity:0.9;
		background-color:firebrick;
		letter-spacing: 2px;
		font-weight: 700;
	}
	.btnbuynow_extra
	{
		padding:10%;
	}
	@media(max-width:300px){
        .btnbuynow{
			justify-content: center;
			-ms-align-items: center;
			align-items:center;

		}
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
	/* .tab_detail
	{
		margin-left:80px;
	}
	@media(max-width:300px){
        .tab_detail{
			margin-left: 0px;
			margin-right:120px;
		}
    } */
	.heart{
	font-size:160%;
	color:black;
	background-color: white;
	border-radius: 50%;
	padding-top:2%;
	padding-bottom: 2%;
	padding-left: 2%;
	padding-right:2%;
	text-align: center;
}

.heart:hover{
	font-size: 200%;
	color:black;
	background-color: white;
	border-radius: 50%;
	padding-top: 1%;
	padding-bottom: 1%;
	padding-left: 1%;
	padding-right:1%;
	text-align: center;
}
.fill-heart{
	font-size:160%;
	color:red;
	background-color: white;
	border-radius: 50%;
	padding-top:2%;
	padding-bottom: 2%;
	padding-left: 2%;
	padding-right:2%;
	text-align: center;
}
.fill-heart:hover{
	font-size: 200%;
	color:red;
	background-color: white;
	border-radius: 50%;
	padding-top: 1%;
	padding-bottom: 1%;
	padding-left: 1%;
	padding-right:1%;
	text-align: center;
}
/* .top-right {
  position: absolute;
  bottom: 10px;
  right:89px;
  bottom:47px;
} */
.soldouttag
{
	position:absolute;
	top:5px;
	right:0;
	font-size:large;
	font-weight:bolder;
	color:white;
	background-color:red;
	padding-top:10px;
	padding-left:40px;
	padding-right:40px;
	padding-bottom:10px;
	text-align: center;
}
.related_name
{
	font-size: 20px;
}
.related_name:hover
{
	font-size: 23px;
}
.related_price
{
	font-size: 17px;
	color:dimgray;
}
.related_price:hover
{
	font-size:19px;
	color:black;
}
</style>
</head>
<body class="animsition">

	<?php	
		include("navbar.php");
	?>
	
	<!-- Product detail -->
	<section class="sec-product-detail bg0 p-t-105 p-b-70">
		<div class="container">
			<div class="row">
			
                                
				<?php 
					if(isset($_GET['id']))
					{
						// echo $_GET['id'];
						$query=mysqli_query($con,"select * from listing_products where id=".$_GET['id']."");
						while($row=mysqli_fetch_array($query))
						{
							//sold or unsold product
							if($row['sell_status']=='Unsold')
							{
									echo"<div class='col-md-5 col-lg-5 '>";
									echo"<div class='m-r--30 m-r-0-lg'>";
										echo"<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>";
											echo"<ol class='carousel-indicators'>";
												echo"<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
													if($row['img2'] != "" && $row['img2'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='1'></li>";
													}
													if($row['img3'] != "" && $row['img3'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='2'></li>";
													}
													if($row['img4'] != "" && $row['img4'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='3'></li>";
													}
											echo"</ol>";
											echo"<div class='carousel-inner'>";
											echo"<div class='carousel-item active'>";
											echo"<img class='d-block img-fluid pic-deep-image bocl12'  src='../product_image/".$row['img1']."' alt='First slide'>";
											echo"</div>";
											if($row['img2'] != "" && $row['img2'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<img class='d-block pic-deep-image  bocl12' src='../product_image/".$row['img2']."' alt='Second slide'>";
												echo"</div>";
											}
											if($row['img3'] != "" && $row['img3'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<img class='d-block pic-deep-image   bocl12' src='../product_image/".$row['img3']."' alt='Second slide'>";
												echo"</div>";
											}
											if($row['img4'] != "" && $row['img4'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<img class='d-block pic-deep-image  bocl12' src='../product_image/".$row['img4']."' alt='Second slide'>";
												echo"</div>";
											}
											echo"</div>";
											echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon my-arrow" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
											</a>';
											echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
											<span class="carousel-control-next-icon my-arrow" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
											</a>';
											// echo"</div>";
											echo"</div>";
								// end carousal
							
								
								//  echo "<div id='slide100-01'>";
								// echo "<div class='wrap-main-pic-100 bo-all-1 bocl12 pos-relative'>";
								// echo "</div>";
									echo "<div class='wrap-thumb-100 flex-w flex-sb p-t-30'>";
								// 	if($row['img2']=="" || $row['img2']==null)
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 	}
								// 	else if($row['img3']=="" || $row['img3']==null )
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		  echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 	echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		   echo "</div>";
								// 		echo "</div>";
								// 	}
								// 	else if($row['img4']=="" || $row['img4']==null)
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		  echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 	echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		   echo "</div>";
								// 		echo "</div>";
								// 		echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img3']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 	}
								// 	else
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 	echo "</div>";
								// 	echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img3']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 	echo "</div>";
		
								// 	echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-3'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo"<img src='../product_image/".$row['img4']."' alt='IMG-SLIDE'>";
								// 				echo"</div>";
								// 			echo"</div>";
		
								// 			echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8'></div>";
								// 		echo"</div>";
								// 	echo"</div>";	
								// 	}
								//echo"</div>";	
								echo"</div>";
								echo"</div>";
								echo"</div>";
								// // Description
								echo "<div class='col-md-5 col-lg-6'>";
								echo "<div class='p-l-70 p-t-35 p-l-0-lg'>";
								echo"<h4 class='js-name1 txt-l-104 cl3 p-b-16'>".$row['product_name']."</h4>";
								echo "<span class='txt-m-117 cl9'>".$row['price']."<img src='../image/rupeess.png'/></span>";
								echo "<div class='flex-w flex-m p-t-30 p-b-27'>";
								echo"<span class='txt-s-115 cl6 p-b-3'>";
								echo"<p class='txt-s-101 cl6'>".$row['product_description']."</p>";
								echo"</span>";					
								echo"</div>";
								echo"<div class='flex-w flex-m p-t-55 p-b-30'>";
								echo"<div class='wrap-num-product flex-w flex-m p-rl-10 bg12 m-r-30 m-b-30'>";
								echo"<div class='btn-num-product-down flex-c-m fs-29'></div>";
								echo"<input class='txt-m-102 cl6 txt-center num-product' type='number' name='num-product' value='1' readonly>";
								echo"<div class='btn-num-product-up flex-c-m fs-16'></div>";
								echo"</div>";
								echo"</div>";
								echo"<div class='txt-s-107 p-b-6'>";

								if(!isset($_SESSION['front_user_id']))
								{
									echo"<button class='txt-s-103 btn cl0 bg10 btnaddtocart hov-btn2 trans-04 m-b-30'>Add to cart</button>";
									// echo"<span class='btnbuynow_extra'><button class='txt-s-103 btn cl0 bg10 hov-btn2 btnbuynow m-b-30'>Buy Now!</button></span>";
									echo "<button class='txt-s-103 btn ml-5 cl0 bg10 hov-btn2 btnbuynow noImplement m-b-30'>Buy Now!</button>";
								}
								else
								{
									echo"<button class='txt-s-103 btn cl0 bg10 btnaddtocart hov-btn2 trans-04 m-b-30 js-addcart1'>Add to cart</button>";
									// echo"<span class='btnbuynow_extra'><button class='txt-s-103 btn cl0 bg10 hov-btn2 btnbuynow m-b-30'>Buy Now!</button></span>";
									echo "<button class='txt-s-103 btn ml-5 cl0 bg10 hov-btn2 btnbuynow m-b-30'>Buy Now!</button>";
								}
								echo"</div>";
								echo"</div>";
								echo"</div>";
								echo"</div>";
							}
							else
							{
									echo"<div class='col-md-7 col-lg-6'>";
									echo"<div class='m-r--30 m-r-0-lg'>";
										echo"<div id='carouselExampleIndicators' class='carousel slide' data-ride='carousel'>";
											echo"<ol class='carousel-indicators'>";
												echo"<li data-target='#carouselExampleIndicators' data-slide-to='0' class='active'></li>";
													if($row['img2'] != "" && $row['img2'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='1'></li>";
													}
													if($row['img3'] != "" && $row['img3'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='2'></li>";
													}
													if($row['img4'] != "" && $row['img4'] != null)
													{
														echo"<li data-target='#carouselExampleIndicators' data-slide-to='3'></li>";
													}
											echo"</ol>";
											echo"<div class='carousel-inner'>";
											echo"<div class='carousel-item active'>";
											echo"<span  class='soldouttag'>Sold Out</span><img class='d-block img-fluid pic-deep-image  bo-all-1 bocl12' src='../product_image/".$row['img1']."' alt='First slide'>";
											echo"</div>";
											if($row['img2'] != "" && $row['img2'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<span  class='soldouttag'>Sold Out</span><img class='d-block pic-deep-image  bo-all-1 bocl12' src='../product_image/".$row['img2']."' alt='Second slide'>";
												echo"</div>";
											}
											if($row['img3'] != "" && $row['img3'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<span  class='soldouttag'>Sold Out</span><img class='d-block pic-deep-image  bo-all-1 bocl12' src='../product_image/".$row['img3']."' alt='Second slide'>";
												echo"</div>";
											}
											if($row['img4'] != "" && $row['img4'] != null)
											{
												echo"<div class='carousel-item'>";
												echo"<span  class='soldouttag'>Sold Out</span><img class='d-block pic-deep-image  bo-all-1 bocl12' src='../product_image/".$row['img4']."' alt='Second slide'>";
												echo"</div>";
											}
											echo"</div>";
											echo '<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
											<span class="carousel-control-prev-icon my-arrow" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
											</a>';
											echo '<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
											<span class="carousel-control-next-icon my-arrow" aria-hidden="true"></span>
											<span class="sr-only">Next</span>
											</a>';
											// echo"</div>";
											echo"</div>";
								// end carousal
							
								
								//  echo "<div id='slide100-01'>";
								// echo "<div class='wrap-main-pic-100 bo-all-1 bocl12 pos-relative'>";
								// echo "</div>";
									echo "<div class='wrap-thumb-100 flex-w flex-sb p-t-30'>";
								// 	if($row['img2']=="" || $row['img2']==null)
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 	}
								// 	else if($row['img3']=="" || $row['img3']==null )
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		  echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 	echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		   echo "</div>";
								// 		echo "</div>";
								// 	}
								// 	else if($row['img4']=="" || $row['img4']==null)
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		  echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 	echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		   echo "</div>";
								// 		echo "</div>";
								// 		echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img3']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 		echo "</div>";
								// 	}
								// 	else
								// 	{
								// 		echo "<div class='thumb-100'>";
								// 			echo "<div class='sub-frame sub-1'>";
								// 				echo "<div class='wrap-main-pic'>";
								// 					echo "<div class='main-pic'>";
								// 						echo "<img src='../product_image/".$row['img1']."' alt='IMG-SLIDE'>";
								// 					echo "</div>";
								// 				echo "</div>";
		
								// 			  echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 			echo "</div>";
								// 		echo"</div>";
								// 		echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img2']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 	echo "</div>";
								// 	echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-2'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo "<img src='../product_image/".$row['img3']."' alt='IMG-SLIDE'>";
								// 				echo "</div>";
								// 			echo "</div>";
								// 			 echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8 '></div>";
								// 		echo "</div>";
								// 	echo "</div>";
		
								// 	echo"<div class='thumb-100'>";
								// 		echo"<div class='sub-frame sub-3'>";
								// 			echo"<div class='wrap-main-pic'>";
								// 				echo"<div class='main-pic'>";
								// 					echo"<img src='../product_image/".$row['img4']."' alt='IMG-SLIDE'>";
								// 				echo"</div>";
								// 			echo"</div>";
		
								// 			echo "<div class='btn-sub-frame  bo-all-1 bocl12 hov8'></div>";
								// 		echo"</div>";
								// 	echo"</div>";	
								// 	}
								//echo"</div>";	
								echo"</div>";
								echo"</div>";
								echo"</div>";
								// // Description
								echo "<div class='col-md-5 col-lg-6'>";
								echo "<div class='p-l-70 p-t-35 p-l-0-lg'>";
								echo"<h4 class='js-name1 txt-l-104 cl3 p-b-16'>".$row['product_name']."</h4>";
								echo "<span class='txt-m-117 cl9'><strike>".$row['price']."<img src='../image/rupeess.png'/></strike></span>";
								echo"<p style='color:red;font-size:small'>*This product has been sold out</p>";
								echo "<div class='flex-w flex-m p-t-30 p-b-27'>";
								echo"<span class='txt-s-115 cl6 p-b-3'>";
								echo"<p class='txt-s-101 cl6'>".$row['product_description']."</p>";
								echo"</span>";					
								echo"</div>";
								echo"<div class='flex-w flex-m p-t-55 p-b-30'>";
								echo"<div class='wrap-num-product flex-w flex-m p-rl-10 bg12 m-r-30 m-b-30'>";
								echo"<div class='btn-num-product-down flex-c-m fs-29'></div>";
								echo"<input class='txt-m-102 cl6 txt-center num-product' type='number' name='num-product' value='1' readonly>";
								echo"<div class='btn-num-product-up flex-c-m fs-16'></div>";
								echo"</div>";
								
								echo"</div>";
								
								echo"<div class='txt-s-107 p-b-6'>";
								
								echo"<button class='txt-s-103 btn cl0 bg10 btnaddtocart  trans-04 m-b-30 js-addcart1' disabled>Add to cart</button>";
								// echo"<span class='btnbuynow_extra'><button class='txt-s-103 btn cl0 bg10  btnbuynow  m-b-30' disabled>Buy Now!</button></span>";
								echo "<button class='ml-5 txt-s-103 btn cl0 bg10  btnbuynow  m-b-30' disabled>Buy Now!</button>";
								
								echo"</div>";
								
								echo"</div>";
								echo"</div>";
								echo"</div>";
							}
						
						}
						
					}
				?>
			</div>

			<!-- Tab01 -->
			<div class="tab02 p-t-80 container">
				<!-- Nav tabs -->
				<ul class="nav nav-tabs" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" data-toggle="tab" href="#description" role="tab">Additional Information</a>
					</li>

					<li class="nav-item">
						<a class="nav-link" data-toggle="tab" href="#info" role="tab">Return Order Policy</a>
					</li>

					<?php
						if(isset($_SESSION['front_user_id']))
						{?>
							<li class="nav-item">
								<a class="nav-link" data-toggle="tab" href="#reviews" role="tab">Complaint</a>
							</li>
						<?php
						}
					?>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
					<!-- - -->
					<div class="tab-pane fade show active" id="description" role="tabpanel">
						<?php
							$customQuery = mysqli_query($con, "SELECT `user_master`.`bussiness_name`, `user_master`.`owner_name`, `user_master`.`email`, `user_master`.`address`, `user_master`.`gst_no` FROM `user_master` JOIN `listing_products` ON `listing_products`.`user_id` = `user_master`.`id` WHERE `listing_products`.`id` = ". $_GET['id'] .";");
							$customResult = mysqli_fetch_array($customQuery);
						?>
						<ul class="p-t-21">
							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Business Name
								</span>

								<span class="cl9 size-w-55">
									<?php
										echo $customResult['bussiness_name'];
									?>
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Owner Name
								</span>

								<span class="cl9 size-w-55">
									<?php
										echo $customResult['owner_name'];
									?>
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Business Email
								</span>

								<span class="cl9 size-w-55">
									<?php
										echo $customResult['email'];
									?>
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Address
								</span>

								<span class="cl9 size-w-55">
									<?php
										echo $customResult['address'];
									?>
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									GST Number
								</span>

								<span class="cl9 size-w-55">
									<?php
										echo $customResult['gst_no'];
									?>
								</span>
							</li>
						</ul>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="info" role="tabpanel">
						<ul class="p-t-21">
							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Days
								</span>

								<span class="cl9 size-w-55">
									Return Order request can be placed within 7 days of order delivery
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Conditions
								</span>

								<span class="cl9 size-w-55">
									<ol>
										<li>
											1) Product should be packed with all accessories.
										</li>
										<li>
											2) No damage should have been done to products.
										</li>
									</ol>
								</span>
							</li>

							<li class="txt-s-101 flex-w how-bor2 p-tb-14">
								<span class="cl6 size-w-54">
									Refund Process
								</span>

								<span class="cl9 size-w-55">
									Refund will be funded in user's account within 2 days of product received by seller.
								</span>
							</li>
						</ul>
					</div>

					<!-- - -->
					<div class="tab-pane fade" id="reviews" role="tabpanel">
						<div class="p-t-36">
							<!-- <h3 class="mb-5">
								Make a Complaint
							</h3> -->

							<form id="ComplaintForUser_Product" method="post">
								<h5 class='c16'>Select Complaint For :</h5>
								<div class="form-check form-check-inline ml-4 mt-3">
									<input class="form-check-input" type="radio" value="product" id="radio1" name="select_complaint" />
									<label class="form-check-label" for="radio1">
										For Product
									</label>
								</div>
								<div class="form-check form-check-inline ml-5">
									<input class="form-check-input" type="radio" value="business" id="radio2" name="select_complaint" />
									<label class="form-check-label" for="radio2">
										For Business
									</label>
								</div>
								<br/>
								<span class="text-danger" id="radioErrorForm" style="font-size:small;display:none;">Please select any one</span>

								<div class="form-group">
									<textarea name="complaint" placeholder="Enter your complaint here.." id="complaint" cols="10" rows="5" class="form-control"></textarea>
								</div>

								<div class="form-group">
									<button class="btn btn-danger" id="sendComplaint" type="button">Send Complaint</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
		<!-- Related product -->
	<section class="sec-related bg0 p-b-85">
		<div class="container">
			<!-- slide9 -->
			<div class="wrap-slick9">
				<div class="flex-w flex-sb-m p-b-33 p-rl-15">
					<h3 class="txt-l-112 cl3 m-r-20 respon1 p-tb-15">
						RELATED PRODUCTS :
					</h3>

					<div class="wrap-arrow-slick9 flex-w m-t-6"></div>
				</div>

				<div class="slick9">
				
				<?php
					if(isset($_GET['id']))
					{
							// echo $_GET['id'];
							$ids = [];
							$query=mysqli_query($con,"select * from listing_products where id=".$_GET['id']."");
							$ans=mysqli_fetch_array($query);
							$query_record=mysqli_query($con,"select * from listing_products join user_master on user_master.id - listing_products.user_id where catagory_id=".$ans['catagory_id']." and listing_products.id!=".$_GET['id']." and sell_status='Unsold' and product_status='Active' and user_master.role=1 LIMIT 4");
							while($row=mysqli_fetch_array($query_record))
							{
								if(!in_array($row[0], $ids))
								{
									array_push($ids, $row[0]);
									echo"<div class='item-slick9 p-all-15'>";
									// <!-- Block1 -->
									echo"<div class='block1'>";
									echo"<div class='block1-bg wrap-pic-w bo-all-2 bocl12 hov3 trans-04'>";
									echo"<img src='../product_image/".$row['img1']."' width='900px' height='370px' alt='IMG'>";
									echo"<div class='block1-content flex-col-c-m p-b-46'>";
									echo"<a href='buss_view_more.php?id=". $row[0] ."' class='txt-m-103 cl3 txt-center related_name hov-cl10 trans-04 js-name-b1' data-id='".$row['id']."'>".$row['product_name']."</a>";
									echo"<span class=' txt-m-104  p-t-21 trans-04 related_price'>".$row['price']."<span style='font-size:20px;'> &#8377;</span></span>";
									echo"</div>";
									echo"</div>";
									echo"</div>";
									echo"</div>";
								}
						
							}

					}
				?>
				</div>
			</div>
		</div>
	</section>
	<!-- Footer start -->
	<?php include("footer.php"); ?>
	<!-- Footar end -->
	

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
	<script src="vendor/noui/nouislider.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/slide100/slide100.js"></script>
	<script src="js/slide100-custom.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

	<!-- Jquery Validate -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- user_shop.js -->
<script src='../new_js/user_shop.js'></script>
<!-- Related Product -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
	$(document).ready(function(){
		$(".anticon-user").addClass("icon-user");
		$(".anticon-logout").addClass("icon-logout");
		$(".anticon-login").addClass("icon-login");
		$(".anticon-clock-circle").addClass("icon-clockcircleo");
		var numbs = $(".slick-track").children().length;
		
		if(numbs == 0)
		{
			$(".slick-track").parent().parent().parent().parent().parent().hide();
		}
	})

	$("#ComplaintForUser_Product").validate({
		rules : {
			select_complaint : {
				required : true,
			},
			complaint : {
				required : true,
			}
		},
		messages : {
			select_complaint : {
				required : "<span hidden></span>",
			},
			complaint : {
				required : "<span class='text-danger' style='font-size:small'>Please enter your complaint</span>",
			}
		},
		highlight : function(tag){
			if(tag.type == "radio")
			{
				$("#radioErrorForm").show();
			}
		},
		unhighlight : function(tag){
			if(tag.type == "radio")
			{
				$("#radioErrorForm").hide();
			}
		}
	});

	

	$(".btnbuynow").click(function(){
		if($(this).hasClass("noImplement"))
		{
			window.location.href = "../user_login.php";
		}
		else
		{
			const paramters = new URLSearchParams(window.location.search);
	
			const json = {"pid" : paramters.get("id"), "qty" : $("input[name=num-product]").val()};
			console.log(json);
	
			$.ajax({
				type : "POST",
				method : "POST",
				data : json,
				dataType : "JSON",
				url : "../crud.php?what=buyNowDirectlyFromViewMore",
				success : function(response){
					if(response.success)
					{
						window.location.href = response.url;
					}
					else
					{
						$.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold><h1>Error !</h1><p>"+response['message']+"</p></div>",
						{
							delay : 2500,
							width : 400,
							offset : {"from" : "top", "amount" : 20},
							allow_dismiss : false,
							align : "center",
						});
	
						setTimeout(() => {
							window.location.reload();
						}, 2500);
					}
				}
			})
		}
	})

	$(".btnaddtocart").click(function(){
		if($(this).hasClass("js-addcart1"))
		{
			const paramters = new URLSearchParams(window.location.search);
	
			const json = {"pid" : paramters.get("id"), "qty" : $("input[name=num-product]").val()};
	
			$.ajax({
				type : "POST",
				method : "POST",
				data : json,
				dataType : "JSON",
				url : "../crud.php?what=addParticularProductToCart",
				success : function(response)
				{
					if(response.login)
					{
						window.location.href = response.url;
					}
				}
			})
	
			$("body").children().find(".swal-button").click(function(){
				window.location.reload();
			})
		}
		else
		{
			window.location.href = "../user_login.php";
		}
	});

	$("#sendComplaint").click(function(event){
		if($("#ComplaintForUser_Product").valid())
		{
			event.preventDefault();
			var formData = $("#ComplaintForUser_Product").serializeArray();
			
			const json = {};

			$.each(formData, function(){
				json[this.name] = this.value;
			})

			let searchParams = new URLSearchParams(window.location.search);
			json['pid'] = searchParams.get("id");

			console.log(json);

			$.ajax({
				type : "POST",
				method : "POST",
				data : json,
				dataType : "JSON",
				url : "../crud.php?what=sendComplaintForUser_Product",
				success : function(response){
					if(response.success)
					{
						$.bootstrapGrowl("<div class='text-center' style='background-color:#1eff1e;opacity:1;font-weight:bold'><h1>Success!</h1><p>"+response.message+"</p></div>",{
							delay : 2500,
							width : 400,
							allow_dismiss : false,
							align : "center",
							offset : {"from" : "top", "amount" : 20},
						});

						$("#ComplaintForUser_Product").trigger("reset");
					}
					else
					{
						$.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error !</h1><p>"+ response.message +"</p></div>",
						{
							delay : 2500,
							width : 400,
							offset : {"from" : "top", "amount" : 20},
							allow_dismiss : false,
							align : "center",
						}); 
					}

					window.scrollTo({"top" : 0, "behaviour" : "smooth"});
				}
			})
		}
	})
</script>
<script src="../new_js/user_footer.js"></script>
</body>
</html>

