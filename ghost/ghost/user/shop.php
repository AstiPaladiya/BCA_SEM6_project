<?php
    session_start();
    include("../connection.php");
	$page = "Shop";

	$verify = "";
	$query = mysqli_query($con, "SELECT `listing_products`.`id` FROM `listing_products` WHERE `listing_products`.`user_id` IN (SELECT `user_master`.`id` FROM `user_master` WHERE `user_master`.`role` = 1 AND DATEDIFF(`user_master`.`expiary_date`, NOW()) <= 0);");
	while($result = mysqli_fetch_array($query))
	{
		$verify .= $result[0] . ",";
	}

	$verify = explode(",", $verify);
	array_pop($verify);

	$query = mysqli_query($con, "SELECT `listing_products`.`id`, DATEDIFF(NOW(), `listing_products`.`created_at`) FROM `listing_products` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`role` = 2 AND DATEDIFF(NOW(), `listing_products`.`created_at`) > 60 AND `listing_products`.`sell_status` = 'Unsold' AND `user_master`.`id` IN (SELECT `id` FROM `user_master` WHERE `user_master`.`subscrib_id` IS NULL OR DATEDIFF(`user_master`.`expiary_date`, NOW()) < 0);");
	while($row = mysqli_fetch_array($query))
	{
		$updateQuery = mysqli_query($con, "update listing_products set sell_status = 'Sold' where id = ". $row[0] ."");

		$deleteQuery = mysqli_query($con, "delete from wishlist_master where product_id = ". $row['0'] ."");
	}
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
    width: 1000px !important;
    height: 279.03px !important; 
    top:0 !important;
    left:0 !important;
  }
}
element.style {
    background-color: rgba(251, 251, 251, 0.15);
}
.hover-overlay .mask {
    --mdb-image-hover-transition: all 0.3s ease-in-out;
    opacity: 0;
    transition: var(--mdb-image-hover-transition);
}
.mask {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-attachment: fixed;
}
*, :after, :before {
    box-sizing: border-box;
}
div {
    display: block;
}
a {
    text-decoration: none;
}
a {
    color: var(--mdb-link-color);
}
/* user agent stylesheet */
a:-webkit-any-link {
    /* color: -webkit-link; */
    cursor: pointer;
}
.hover-zoom {
    --mdb-image-hover-zoom-transition: all 0.3s linear;
    --mdb-image-hover-zoom-transform: scale(1.1);
}
.card {
    --mdb-card-spacer-y: 1.5rem;
    --mdb-card-spacer-x: 1.5rem;
    --mdb-card-title-spacer-y: 0.5rem;
    --mdb-card-border-width: 1px;
    --mdb-card-border-color: var(--mdb-border-color-translucent);
    --mdb-card-border-radius: 0.5rem;
    --mdb-card-box-shadow: 0 2px 15px -3px rgba(0,0,0,0.07),0 10px 20px -2px rgba(0,0,0,0.04);
    --mdb-card-inner-border-radius: calc(0.5rem - 1px);
    --mdb-card-cap-padding-y: 0.75rem;
    --mdb-card-cap-padding-x: 1.5rem;
    --mdb-card-cap-bg: hsla(0,0%,100%,0);
    --mdb-card-bg: #fff;
    --mdb-card-img-overlay-padding: 1.5rem;
    --mdb-card-group-margin: 0.75rem;
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    height: var(--mdb-card-height);
    word-wrap: break-word;
    background-color: var(--mdb-card-bg);
    background-clip: border-box;
    border: var(--mdb-card-border-width) solid var(--mdb-card-border-color);
    border-radius: var(--mdb-card-border-radius);
    box-shadow: var(--mdb-card-box-shadow);
}
.product_name:hover{
	color:red;
}

.cart:hover
{
	color: blue;
	font-weight: bold;
	/* font-style:center; */
	/* border:2px solid sandybrown; */
	/* box-shadow: 1px 1px 10px 2px #ccc; */
	/* background-color:wheat; */
	font-size:130%;
	/* border-radius:4px 4px 3px 3px ; */

}
.removecart:hover{
	color:red;
	font-size:130%;
	font-weight:bold;
}
.top-right {
  position: absolute;
  top: 10px;
  right: 20px;
}
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
.product_hover:hover{
	box-shadow: 1px 1px 10px 2px #ccc;
}
.container{
	max-width: 1400px !important;
}
.hov-cl10:hover{
	color: red !important;
}
.soldouttag
{
	position:absolute;
	top:5px;
	right:0;
	font-size:large;
	font-weight:bolder;
	color:white;
	background-color:red;
	padding-top:5px;
	padding-left:10px;
	padding-right:10px;
	padding-bottom:5px;
}
.heart_nav{
	font-size:180%;
	color:black;
	
	/* padding-bottom: 2%;
	padding-left: 2%;
	padding-right:2%; */
	
}
</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->
	<!-- slider start-->
		<?php
		//  include("slider.php")
		  ?>
	<!-- slider end -->
	<!-- Main content start -->
<div class="sec-gallery bg0 p-t-10 p-b-98">
	<div class="container">
    
	<!-- Content page -->
		<section class="bg0 p-t-85 p-b-45">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-4 col-lg-3 m-rl-auto p-b-50">
						<?php
							include("filterBar.php");
						?>
					</div>

					<div class="col-sm-10 col-md-8 col-lg-9 m-rl-auto p-b-50">
						<div>
							<!-- <div class="flex-w flex-r-m p-b-45 flex-row-rev">
								<div class="flex-w flex-m p-tb-8">
									<div class="rs1-select2 bg0 size-w-52 bo-all-1 bocl15 m-tb-7 m-r-15">
										<select class="js-select2" name="sort">
											<option>Sort by popularity</option>
											<option>Sort by best sell</option>
											<option>Sort by special</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
									
									<div class="flex-w flex-m m-tb-7">
										<button class="dis-block lh-00 pos-relative how-icon1 m-r-15 js-show-list">
											<img class="icon-main trans-04" src="images/icons/icon-menu-list.png" alt="ICON">
											<img class="ab-t-l icon-hov trans-04" src="images/icons/icon-menu-list1.png" alt="ICON">
										</button>

										<button class="dis-block lh-00 pos-relative how-icon1 menu-active js-show-grid">
											<img class="icon-main trans-04" src="images/icons/icon-grid.png" alt="ICON">
											<img class="ab-t-l icon-hov trans-04" src="images/icons/icon-grid1.png" alt="ICON">
										</button>
									</div>
								</div>

								<span class="txt-s-101 cl9 m-r-30 size-w-53" id="showing_result_span">
									
								</span>
							</div> -->
							
					<!-- Shop grid -->
					<!-- <div class="shop-grid dis-none"> -->
					<form class='post mt-5'>
						<div class="row" >
							<?php
								if(isset($_GET['priceFilter']))
								{
									switch($_GET['priceFilter'])
									{
										case "1":
											$queryString = "select * from listing_products where product_status='Active' and price >= 1 and price <= 100";
											break;
										case "2":
											$queryString = "select * from listing_products where product_status='Active' and price >= 101 and price <= 300";
											break;
										case "3":
											$queryString = "select * from listing_products where product_status='Active' and price >= 301 and price <= 500";
											break;
										case "4":
											$queryString = "select * from listing_products where product_status='Active' and price >= 501 and price <= 1000";
											break;
										case "5":
											$queryString = "select * from listing_products where product_status='Active' and price >= 1001";
											break;
										case "all":
											$queryString = "select * from listing_products where product_status='Active'";
											break;
										default : 
											$queryString = "select * from listing_products where product_status='Active'";
											break;
									}

									//php code for filter here
									$query=mysqli_query($con, $queryString);
									while($row=mysqli_fetch_array($query))
									{
										if(in_array($row['id'], $verify) != 1)
										{
											if($row['sell_status']=='Unsold')
											{
												$query_user=mysqli_query($con,"select * from user_master where id=".$row['user_id']." and status = 'active'");
												while($row_user=mysqli_fetch_array($query_user))
												{
													if($row_user['role']=='1')
													{
														// Bussiness product
														echo "<div class='col-sm-8 col-md-4 p-b-20  m-rl-auto' >";
														echo "<div class='product_hover'>";
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Add to cart' addData-id='".$row['id']."' class='cart chkCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;'></i></a></span><br/>";
															}
															else
															{
																$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																if($chckWishlistResult[0] == 0)
																{
																	echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Add in Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																}
																else
																{
																	echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a class='btn-unwishlist' removedata-id='".$row['id']."' title='Remove Whishlist'><i class='fas fa-heart top-right fill-heart'></i></a></p></a>";
																}
																$query_cart=mysqli_query($con,"select count(*) from cart where product_id=".$row['id']." and user_id=".$_SESSION['front_user_id']."");
																$chkCartList=mysqli_fetch_array($query_cart);
																if($chkCartList[0] == 0)
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Add to cart' addData-id='".$row['id']."' class='cart chkCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;'></i></a></span><br/>";										
																}
																else
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Remove cart' removeData-id='".$row['id']."' class='removecart deleteCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;color:red;'></i></a></span><br/>";
																	
																}
															}
															echo "<span class='txt-s-101 c20 '>".$row_user['bussiness_name']."</span><br/>";
															echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
															echo "<div class='flex-w flex-c-m p-t-30'>";
															//Old
															// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
															//New
															echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`' href='buss_view_more.php?id=". $row['id'] ."'>View More</a></button>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
		
													}
													else
													{
														// User product
															
															
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto'>";
																echo "<div class='product_hover'>";
																echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																echo "<div class='flex-w flex-c-m p-t-30'>";
																//Old
																// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																//New
																echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																echo "</div>";
																echo "</div>";
																echo "</div>";
																echo "</div>";
															}
															else
															{
																$query_sessuser=mysqli_query($con,"select * from user_master where id=".$_SESSION['front_user_id']."");
																while($row_sessuser=mysqli_fetch_array($query_sessuser))
																{
																	if($row_sessuser['city']==$row_user['city'])
																	{
																		$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																		$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																		if($chckWishlistResult[0] == 0)
																		{
																			echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto'>";
																			echo "<div class='product_hover'>";
																			echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Add in Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																			echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																			echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																			echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																			echo "<div class='flex-w flex-c-m p-t-30'>";
																			//Old
																			// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																			//New
																			echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																		}
																		else
																		{
																			echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto' >";
																			echo "<div class='product_hover'>";
																			echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a class='btn-unwishlist' removedata-id='".$row['id']."' title='Remove Whishlist'><i class='fas fa-heart top-right fill-heart'></i></a></p></a>";
																			echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																			echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																			echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																			echo "<div class='flex-w flex-c-m p-t-30'>";
																			//Old
																			// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																			//New
																			echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																		}
																	}
																}
															}
															
															
													}
												}
											}
											else
											{
												// sold product
												$query_user=mysqli_query($con,"select * from user_master where id=".$row['user_id']." and status = 'active'");
												while($row_user=mysqli_fetch_array($query_user))
												{
													if($row_user['role']=='1')
													{
														// bussiness product
														echo "<div class='col-sm-8 col-md-4 p-b-20  m-rl-auto' >";
														echo "<div class='product_hover'>";
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
															}
															else
															{
																$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																if($chckWishlistResult[0] == 0)
																{
																	echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																}
																else
																{
																	echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																}
																$query_cart=mysqli_query($con,"select count(*) from cart where product_id=".$row['id']." and user_id=".$_SESSION['front_user_id']."");
																$chkCartList=mysqli_fetch_array($query_cart);
																if($chkCartList[0] == 0)
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";										
																}
																else
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																	
																}
															}
															echo "<span class='txt-s-101 c20 '>".$row_user['bussiness_name']."</span><br/>";
															echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
															echo "<div class='flex-w flex-c-m p-t-30'>";
															//Old
															// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
															//New
															echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`' href='buss_view_more.php?id=". $row['id'] ."'>View More</a></button>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
		
													}
													else
													{
														// user product
														// a
													}
												}
		
											}
										}
										
									}
								}
								else if(isset($_GET['categoryFilter']))
								{}
								else
								{
									$query=mysqli_query($con,"select * from listing_products where product_status='Active'");
									while($row=mysqli_fetch_array($query))
									{
										if(in_array($row['id'], $verify) != 1)
										{
											if($row['sell_status']=='Unsold')
											{
												$query_user=mysqli_query($con,"select * from user_master where id=".$row['user_id']." and status = 'active'");
												while($row_user=mysqli_fetch_array($query_user))
												{
													if($row_user['role']=='1')
													{
														// Bussiness product
														echo "<div class='col-sm-8 col-md-4 p-b-20  m-rl-auto' >";
														echo "<div class='product_hover'>";
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Add to cart' addData-id='".$row['id']."' class='cart chkCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;'></i></a></span><br/>";
															}
															else
															{
																$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																if($chckWishlistResult[0] == 0)
																{
																	echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Add in Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																}
																else
																{
																	echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a class='btn-unwishlist' removedata-id='".$row['id']."' title='Remove Whishlist'><i class='fas fa-heart top-right fill-heart'></i></a></p></a>";
																}
																$query_cart=mysqli_query($con,"select count(*) from cart where product_id=".$row['id']." and user_id=".$_SESSION['front_user_id']."");
																$chkCartList=mysqli_fetch_array($query_cart);
																if($chkCartList[0] == 0)
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Add to cart' addData-id='".$row['id']."' class='cart chkCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;'></i></a></span><br/>";										
																}
																else
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'><a href='#' title='Remove cart' removeData-id='".$row['id']."' class='removecart deleteCart'><i class='anticon anticon-shopping-cart rounded-circle' style='font-size:200%;font-weight:bold;color:red;'></i></a></span><br/>";
																	
																}
															}
															echo "<span class='txt-s-101 c20 '>".$row_user['bussiness_name']."</span><br/>";
															echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
															echo "<div class='flex-w flex-c-m p-t-30'>";
															//Old
															// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
															//New
															echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`' href='buss_view_more.php?id=". $row['id'] ."'>View More</a></button>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
		
													}
													else
													{
														// User product
															
															
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto' >";
																echo "<div class='product_hover'>";
																echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																echo "<div class='flex-w flex-c-m p-t-30'>";
																//Old
																// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																//New
																echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																echo "</div>";
																echo "</div>";
																echo "</div>";
																echo "</div>";
															}
															else
															{
																$query_sessuser=mysqli_query($con,"select * from user_master where id=".$_SESSION['front_user_id']."");
																while($row_sessuser=mysqli_fetch_array($query_sessuser))
																{
																	if($row_sessuser['city']==$row_user['city'])
																	{
																		$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																		$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																		if($chckWishlistResult[0] == 0)
																		{
																			echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto' >";
																			echo "<div class='product_hover'>";
																			echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a data-pid='". $row['id'] ."' class='btn-wishlist' title='Add in Whishlist'><i class='far fa-heart top-right heart'></i></a></p></a>";
																			echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																			echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																			echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																			echo "<div class='flex-w flex-c-m p-t-30'>";
																			//Old
																			// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																			//New
																			echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																		}
																		else
																		{
																			echo "<div class='col-sm-8 col-md-4 p-b-20 m-rl-auto' >";
																			echo "<div class='product_hover'>";																			
																			echo "<a class='hov-img0'><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'><a class='btn-unwishlist' removedata-id='".$row['id']."' title='Remove Whishlist'><i class='fas fa-heart top-right fill-heart'></i></a></p></a>";
																			echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																			echo "<span class='txt-s-101 c20 '>".$row_user['owner_name']."</span><br/>";
																			echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
																			echo "<div class='flex-w flex-c-m p-t-30'>";
																			//Old
																			// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
																			//New
																			echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a href='user_view_more.php?id=". $row['id'] ."' style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`'>View More</a></button>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																			echo "</div>";
																		}
																	}
																}
															}
															
													}
												}
											}
											else
											{
												// sold product
												$query_user=mysqli_query($con,"select * from user_master where id=".$row['user_id']." and status = 'active'");
												while($row_user=mysqli_fetch_array($query_user))
												{
													if($row_user['role']=='1')
													{
														// bussiness product
														echo "<div class='col-sm-8 col-md-4 p-b-20  m-rl-auto' >";
														echo "<div class='product_hover'>";
															// add-remove wishlist product
															if(!isset($_SESSION['front_user_id']) || $_SESSION['front_user_id'] == "" || $_SESSION['front_user_id'] == null)
															{
																echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
															}
															else
															{
																$chckWishlistQuery = mysqli_query($con, "select count(*) from wishlist_master where product_id = ". $row['id'] ." and user_id = ". $_SESSION['front_user_id'] ."");
																$chckWishlistResult = mysqli_fetch_array($chckWishlistQuery);
		
																if($chckWishlistResult[0] == 0)
																{
																	echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																}
																else
																{
																	echo "<a class='hov-img0' style='position:relative'><span style='position:absolute;top:5px;right:0;font-size:large;font-weight:bolder;color:white;background-color:red;'>Sold Out</span><img src='../product_image/".$row['img1']."' class='img' height='250px' alt='IMG'/><p class='text-over-img'></p></a>";
																}
																$query_cart=mysqli_query($con,"select count(*) from cart where product_id=".$row['id']." and user_id=".$_SESSION['front_user_id']."");
																$chkCartList=mysqli_fetch_array($query_cart);
																if($chkCartList[0] == 0)
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";										
																}
																else
																{
																	echo "<div class='flex-col-c-l bg0 p-rl-15 p-t-18 p-b-30'><a href='#' class='txt-m-114 cl3 product_name trans-04 p-b-1'>".$row['product_name']."</a><span style='float:right;'></span><br/>";
																	
																}
															}
															echo "<span class='txt-s-101 c20 '>".$row_user['bussiness_name']."</span><br/>";
															echo "<span class='txt-s-101 cl6'>".$row['price']."<img src='../image/rupeess.png'/></span>";
															echo "<div class='flex-w flex-c-m p-t-30'>";
															//Old
															// echo "<button class='btn btn-block btn-dark chkViewMore' data-id=".$row['id'].">View More</button>";
															//New
															echo "<button class='chkViewMore btn btn-block btn-dark' data-id=".$row['id']."><a style='color:white' onMouseOver='this.style.color=`black`' onMouseOut='this.style.color=`white`' href='buss_view_more.php?id=". $row['id'] ."'>View More</a></button>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
															echo "</div>";
		
													}
													else
													{
														// user product
														// a
													}
												}
		
											}
										}
										
									}
								}
							
							?>
						</div>
					</form>
					<div id='allProduct'></div>
					<br/>
					<span class="txt-s-101 cl9 m-r-30 size-w-53" id="showing_result_span"></span>
				
							<!-- Pagination -->
							<!-- <div class="flex-w flex-c-m p-t-47">
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
				</div>
			</div>
		
		</section>
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
<!-- <script type="text/javascript" src="../flaviusmatis-simplePagination.js-da97104/jquery.js"></script> -->
<script type="text/javascript" src="js/jquery.simplePagination.js"></script>
	<script src="js/main.js"></script>
	<script src="../new_js/time.js"></script>
	<script src="../new_js/item_carousal.js"></script>
				
	<script src="../new_js/user_shop.js"></script>
	<script>
		$(function(){
			var items = $(".product_hover").parent();
			
			var numItems = items.length;
			var perPage = 9;

			if(numItems < 9)
			{
				$("#showing_result_span").html("Showing 1 - "+ numItems +" from " + numItems + " results");
			}
			else
			{
				$("#showing_result_span").html("Showing 1 - 9 from " + numItems + " results");
			}

			items.slice(perPage).hide();

			$("#allProduct").pagination({
				items: numItems,
				itemsOnPage:perPage,
				cssStyle: 'light-theme',
				onPageClick: function (pageNumber) {
					var showFrom = perPage * (pageNumber - 1);
					var showTo = showFrom + perPage;
					// console.log("Showing " + showFrom + " - " + showTo + " of " + numItems + " results");
					$("#showing_result_span").html("Showing " + showFrom + " - " + showTo + " of " + numItems + " results");
					items.hide().slice(showFrom, showTo).show();
				}
			});
			
			//Hiding code start
			if(numItems == 0)
			{
				$("#allProduct").empty();
				$("#allProduct").html("<h3 class='text-danger'>No Products Found !!</h3>");
				$("#showing_result_span").hide();
			}
			//Hiding Code end

			$("#price_range").change(function(){
				if($("#price_range").val() != "" && $("#price_range").val() != null)
				{
					var selectedRange = $("#price_range").val();

					switch(selectedRange)
					{
						case "1" :
							$("#value-lower").html("1");
							$("#value-upper").html("100");

							window.location.href = "shop.php?priceFilter=1";
							break;
						case "2" :
							$("#value-lower").html("101");
							$("#value-upper").html("300");

							window.location.href = "shop.php?priceFilter=2";
							break;
						case "3" :
							$("#value-lower").html("301");
							$("#value-upper").html("500");

							window.location.href = "shop.php?priceFilter=3";
							break;
						case "4" :
							$("#value-lower").html("501");
							$("#value-upper").html("1000");

							window.location.href = "shop.php?priceFilter=4";
							break;
						case "5" :
							$("#value-lower").html("1001");
							$("#value-upper").html("Max");

							window.location.href = "shop.php?priceFilter=5";
							break;
						case "all":
							$.ajax({
								type : "POST",
								method : "POST",
								dataType : "JSON",
								url : "../crud.php?what=getMaxPriceProduct",
								success : function(response){
									$("#value-upper").html(response[0]);
								}
							})
							$("#value-lower").html("1");

							window.location.href = "shop.php?priceFilter=all";
							break;
					}
				}
			})
		});

		$("#businessCategory").change(function(){
			if($(this).val() != "" && $(this).val() != null)
			{
				if($(this).val() == "all")
				{
					window.location.href = "businessProducts.php";
				}
				else
				{
					window.location.href = "businessSpecificCategory.php?id=" + $("#businessCategory").val();
				}
			}
		})

		$("#customerCategory").change(function(){
			if($(this).val() != "" && $(this).val() != null)
			{
				if($(this).val() == "all")
				{
					window.location.href = "customerProducts.php";
				}
				else
				{
					window.location.href = "customerSpecificCategory.php?id=" + $("#customerCategory").val();
				}
			}
		})
	</script>
	<script src="../new_js/user_footer.js"></script>
</body>
</html>