<style>
.txtHover:hover{
            background-color:rgba(255, 99, 71, 0.3);
            color:red;
            /* border-right:2px solid red; */
        }
		.btn_styleicon
		{
			font-size:18px;
			color:black;
		}
		.btn_stylebut
		{
			color:grey;
			font-size: 16px;

		}
		.btn_profstyle:hover
		{
			border:1px solid black;
		}
</style>
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop">
					<div class="left-header">
						<!-- Logo desktop -->		
						<div class="logo">
							<a href="index.php"><img src="../image/ghost2.png" alt="IMG-LOGO"></a>
						</div>	
					</div>
					
					<div class="center-header mt-5">
						<!-- Menu desktop -->
						<div class="menu-desktop">
							<ul class="main-menu">
								<li class="active-menu active ghstHover">
									<a href="index.php" <?php
										if($page == "Home")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>HOME</a>
									<!-- <ul class="sub-menu">
										<li><a href="index.html">Homepage 1</a></li>
										<li><a href="home-02.html">Homepage 2</a></li>
										<li><a href="home-03.html">Homepage 3</a></li>
										<li><a href="home-04.html">Homepage 4</a></li>
										<li><a href="home-05.html">Homepage 5</a></li>
										<li><a href="home-06.html">Homepage 6</a></li>
									</ul> -->
								</li>

								<li>
									<a href="shop.php" <?php
										if($page == "Shop")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>SHOP</a>
									<ul class="sub-menu">
										<?php
											$query=mysqli_query($con,"select id, name from category_master LIMIT 5");
											while($row=mysqli_fetch_array($query))
											{
												echo "<li><a href='specificCategory.php?id=". $row['id'] ."'>".$row['name']."</a></li>";
											}
										?>
										<li><a href="shop.php" class="show" style="font-size:100%;font-family:Arial, Helvetica, sans-serif;border-top:3px solid red;color:black;font-weight:bold;">SHOW MORE<i class="anticon anticon-double-right"></i></a></li>
										<!-- <li><a href="about-01.html">About 1</a></li>
										<li><a href="about-02.html">About 2</a></li>
										<li><a href="coming-soon.html">Coming Soon</a></li>
										<li><a href="error.html">404 Error</a></li>
										<li><a href="checkout.html">CheckOut</a></li>
										<li><a href="account.html">My Account</a></li>
										<li><a href="account-lost-pass.html">My Account Lost Pass</a></li>
										<li><a href="account-register.html">My Account Register</a></li>
										<li><a href="wishlist.html">Wishlist</a></li> -->
									</ul>
								</li>

								<li>
									<a href="sell_product.php" <?php
										if($page == "Sell_Product")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>SELL PRODUCT</a>
									<!-- <ul class="sub-menu">
										<li><a href="shop-sidebar-grid.html">Shop Sidebar Grid</a></li>
										<li><a href="shop-sidebar-list.html">Shop Sidebar List</a></li>
										<li><a href="shop-product-grid.html">Shop Product Grid</a></li>
										<li><a href="shop-product-list.html">Shop Product List</a></li>
										<li><a href="product-single.html">Product Single</a></li>
										<li><a href="shop-cart.html">Shop Cart</a></li>
									</ul> -->
								</li>

								<li>
									<a href="order.php" <?php
										if($page == "Order")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>ORDER</a>
									<!-- <ul class="sub-menu">
										<li><a href="blog-list.html">Blog List</a></li>
										<li><a href="blog-grid-01.html">Blog Grid 1</a></li>
										<li><a href="blog-grid-02.html">Blog Grid 2</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
									</ul> -->
								</li>

								<li>
									<a href="about_us.php" <?php
										if($page == "About_Us")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>ABOUT US</a>
									<!-- <ul class="sub-menu">
										<li><a href="gallery-01.html">Gallery 1</a></li>
										<li><a href="gallery-02.html">Gallery 2</a></li>
									</ul> -->
								</li>

								<li>
									<a href="contact_us.php" <?php
										if($page == "Contact_Us")
										{
											echo "style='color:red;border-bottom:1px solid red;'";
										}
									?>>CONTACT US</a>
									<!-- <ul class="sub-menu">
										<li><a href="contact-01.html">Contact 1</a></li>
										<li><a href="contact-02.html">Contact 2</a></li>
									</ul> -->
								</li>
							</ul>
						</div>
					</div>
						
					<div class="right-header">
						<!-- Icon header -->
						<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click p-t-8">
							<?php
								if(isset($_SESSION['front_user_id']))
								{?>
									<div class="h-full flex-m">
										<div class="icon-header-item flex-c-m trans-04 icon-header-noti chatsNavbar" data-notify="<?php
											$unreadQuery = mysqli_query($con, "SELECT COUNT(*) FROM `chat_master` WHERE `receiver_user_id` = ". $_SESSION['front_user_id'] ." AND `read_by_receiver` = 'false'");

											$unreadResult = mysqli_fetch_array($unreadQuery);
											if($unreadResult != "" && $unreadResult != null)
											{
												echo $unreadResult[0];
											}
											else
											{
												echo "0";
											}
										?>">
											<a href="chatMaster.php">
												<span style="font-size:large;color:black;">
													<img src="../image/chat.png" width="90%" title="ChatRoom"/>
												</span>
											</a>
										</div>
									</div>
								<?php
								}
							?>
						<?php
							if(isset($_SESSION['front_user_id']))
							{
								$cartQuery = mysqli_query($con, "SELECT COUNT(*) FROM `wishlist_master` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
								$cart = mysqli_fetch_array($cartQuery);
							?>
								<div class="h-full flex-m">
									<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo $cart[0] ?>">
										<a href="wishlist.php"><img src="../image/heart.png" width="75%" title="WishList" /></a>
									</div>
								</div>
							<?php
							}
						?>

							<?php
								if(isset($_SESSION['front_user_id']))
								{
									$cartQuery = mysqli_query($con, "SELECT COUNT(*) FROM `cart` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
									$cart = mysqli_fetch_array($cartQuery);
								?>
									<div class="h-full flex-m ml-2">
										<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo $cart[0] ?>">
										<a href="cart.php"><img src="../image/cart.png" width="70%" alt="CART" title="CartList"></a>
										</div>
									</div>
								<?php
								}
							?>
								
							<div class="wrap-cart-header h-full flex-m m-l-10 menu-click">
								<!-- <div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="2"> -->
									<?php
										if(!isset($_SESSION['front_user_id']))
										{?>
											<button class="btn login" style="background-color:sandybrown;border:2px solid black;font-weight: bold;font-size:90%;color: black;" type="button">LOG IN
												<i class="anticon anticon-login"></i>
											</button>
										<?php
										}
										else
										{?>
											<button class="avatar" type="button">
												<!-- <i class="anticon anticon-login"></i> -->
												
													<?php
														$query = mysqli_query($con, "select * from user_master where id='".$_SESSION['front_user_id']."'");
														$result = mysqli_fetch_array($query);
												
														if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
														{
															if($_SESSION['front_user_gender']=='male')
															{
																echo"<img src='../image/male_profile.png'>";
															}
															else
															{
																echo"<img src='../image/female_profile.png'>";
															}
														}
														else
														{
															echo"<img  src='../user_profile/".$result['profile_img']."' />";
														}
													?>
											</button>
										<?php
										}
									?>
									
								<!-- </div> -->

								<div class="cart-header menu-click-child trans-04">
									<table class="table">
										<tr>
											<td class="txtHover">
												<div class="flex-w flex-str m-b-2">
													<div class="size-w-10 flex-w flex-t" >
														<?php
															if(!isset($_SESSION['front_user_id']))
															{?>
																<a href="../user_login.php" class="btnSubLogin"><i class="fas fa-user btn_styleicon"></i><span class="subLogin ml-2 btn_stylebut" >User Login</span></a>
															<?php
															}
															else
															{?>
																<a href="update_profile.php" class="btnSubLogin">
																<i class="anticon anticon-user btn_styleicon"></i>
																	<span class="subLogin ml-1 btn_stylebut">Update Profile</span>
																</a>
															<?php
															}
														?>
													</div>
												</div>
											</td>
										</tr>
										<tr>
											<td class='txtHover'>
												<div class="flex-w flex-str m-b-2">
													<div class="size-w-10 flex-w flex-t">
														<?php
															if(!isset($_SESSION['front_user_id']))
															{?>
																<a href="../bussiness_login.php" class='btnSubLogin'><i class="fas fa-user-tie" style="font-size:20px;color:black;" ></i><span class="subLogin ml-2 btn_stylebut" >Business Login</span></a>
															<?php
															}
															else
															{?>
																<a href="logout.php" class='btnSubLogin'>
																	<i class="anticon anticon-logout btn_styleicon"></i>
																		<span class="subLogin btn_stylebut ml-1">Log Out</span>
																</a>
															<?php
															}
														?>
														
													</div>
												</div>
											</td>
										</tr>
										<?php
											if(isset($_SESSION['front_user_premium']) && $_SESSION['front_user_premium'])
											{?>
												<tr>
													<td class="txtHover">
														<div class="flex-w flex-str m-b-2">
															<div class="size-w-10 flex-w flex-t">
															<a href="acountPlanDetails.php" class="btnSubLogin">
															<i class="anticon anticon-clock-circle btn_styleicon"></i>
																<!-- <button class="btn btnSubLogin" style="border:none;"> -->
																	<span class="subLogin ml-1 btn_stylebut" ><?php
																		$query = mysqli_query($con, "SELECT DATEDIFF(`expiary_date`, NOW()) FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] .";");
																		$result = mysqli_fetch_array($query);

																		echo $result[0] . " Days Left";
																	?></span>
																<!-- </button> -->
															</a>
															</div>
														</div>
													</td>
												</tr>
											<?php
											}
											else
											{
												if(isset($_SESSION['front_user_id']))
												{?>
													<tr>
														<td class='txtHover'>
															<div class="flex-w flex-str m-b-2">
																<div class="size-w-10 flex-w flex-t">
																<a href="premiumAccount.php" class="btnSubLogin">
																	<i class="fas fa-arrow-circle-up btn_styleicon"></i>
																		<span class="subLogin ml-1 btn_stylebut">Upgrade Account</span>
																</a>
																</div>
															</div>
														</td>
													</tr>
												<?php
												}
											}
										?>
									</table>	
								</div>
							</div>
						</div>
					</div>
				</nav>
			</div>	
		</div>


		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.php"><img src="../image/ghost2.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m h-full wrap-menu-click m-r-15">
				<!-- <div class="h-full flex-m">
					<div class="icon-header-item flex-c-m trans-04 js-show-modal-search">
						<img src="images/icons/icon-search.png" alt="SEARCH">
					</div>
				</div> -->

				<?php
					if(isset($_SESSION['front_user_id']))
					{?>
						<div class="h-full flex-m">
							<div class="icon-header-item flex-c-m trans-04">
								<a href="chatMaster.php">
									<span style="font-size:large;color:black;">
									<img src="../image/chat.png" width="90%" title="ChatRoom"/>
									</span>
								</a>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(isset($_SESSION['front_user_id']))
					{
						$cartQuery = mysqli_query($con, "SELECT COUNT(*) FROM `wishlist_master` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
						$cart = mysqli_fetch_array($cartQuery);
					?>
						<div class="h-full flex-m">
							<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo $cart[0] ?>">
								<a href="wishlist.php"><img src="../image/heart.png" width="75%" title="WishList" /></a>
							</div>
						</div>
					<?php
					}
				?>

				<?php
					if(isset($_SESSION['front_user_id']))
					{
						$cartQuery = mysqli_query($con, "SELECT COUNT(*) FROM `cart` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
						$cart = mysqli_fetch_array($cartQuery);
					?>
						<div class="h-full flex-m">
							<div class="icon-header-item flex-c-m trans-04 icon-header-noti" data-notify="<?php echo $cart[0] ?>">
								<a href="cart.php"><img src="../image/cart.png" width="70%" alt="CART" title="CartList"></a>
							</div>
						</div>
					<?php
					}
				?>

				<div class="wrap-cart-header h-full flex-m m-l-5 menu-click">
					<div class="icon-header-item flex-c-m trans-04">
						<!-- <img src="images/icons/icon-cart-2.png" alt="CART"> -->
						<?php
							if(!isset($_SESSION['front_user_id']))
							{?>
								<button class="btn btnLoginMob  rounded-circle" style="border:1px solid black;padding:9px 9px;background-color:darksalmon;"><i class="anticon anticon-login" style="font-size:140%;font-weight:bold;"></i></button>
							<?php
							}
							else
							{?>
								<button class="btn_profstyle avatar" type="button">
									<?php
										$query = mysqli_query($con, "select * from user_master where role=2 and id='".$_SESSION['front_user_id']."'");
										$result = mysqli_fetch_array($query);
								
										if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
										{
											if($result['gender']=='male')
											{
												echo"<img src='../image/male_profile.png'>";
											}
											else
											{
												echo"<img src='../image/female_profile.png'>";
											}
										}
										else
										{
											echo"<img ' src='../user_profile/".$result['profile_img']."' />";
										}
									?>
								</button>
							<?php
							}
						?>
					</div>

					<div class="cart-header menu-click-child trans-04">
						<table class="table">
							<tr>
								<td class='txtHover'>
									<div class="flex-w flex-str m-b-25">
										<div class="size-w-15 flex-w flex-t" >
											<!-- <a href="../user_login.php"><img src="../image/user_loginperson.png" width="30%" /><span style="padding-left:13%;font-size:150%;">User<br><span style="padding-left: 36%;">Login</span></span></span></a> -->

											<?php
												if(!isset($_SESSION['front_user_id']))
												{?>
													<!-- <a href="../user_login.php"><button class="btn btnSubLogin" style="border:none;"><img src="../image/user_loginperson.png" width="20%" /><span class="subLogin">User Login</span></button></a> -->
													<a href="../user_login.php"><i class="fas fa-user btn_styleicon"></i><span class='ml-2' style='font-size:20px;color:grey;'>User Login</span></a>
												<?php
												}
												else
												{?>
													<a href="update_profile.php" class='btnSubLogin'>
														<i class="anticon anticon-user btn_styleicon"></i>
														<span class="subLogin btn_stylebut ml-1" >Update Profile</span>
													</button>
													</a>
												<?php
												}
											?>
										</div>

									</div>
								</td>
							</tr>
							<tr>
								<td class="txtHover">
									<div class="flex-w flex-str m-b-25">
										<div class="size-w-15 flex-w flex-t text-left">
											<!-- <a href="../bussiness_login.php"><img src="../image/bussiness_userlogin.png" width="20%" /><span style="padding-left:13%;font-size:150%;">Business<br><span style="padding-left: 30%;">Login</span></span></a> -->

											<?php
												if(!isset($_SESSION['front_user_id']))
												{?>
													<!-- <a href="../user_login.php"><img src="../image/user_loginperson.png" width="30%" /><span style="padding-left:13%;font-size:150%;">User<br><span style="padding-left: 36%;">Login</span></span></span></a> -->
													<a href="../bussiness_login.php"><i class="fas fa-user-tie btn_styleicon"></i><span class='ml-2' style='font-size:20px;color:grey;'>Business<br><span class='ml-4' style='font-size:20px;color:grey;'>Login</span></span></a>
												<?php
												}
												else
												{?>
													<a href="logout.php" class="btnSubLogin">
														<i class="anticon anticon-logout btn_styleicon"></i>
															<span class="subLogin ml-1 btn_stylebut">Log Out</span>
													</a>
													<!-- <a href="userProfile.php">
													<button class="btn btnSubLogin" style="border:none;">
														<span class="subLogin" style="font-size:130%;">Check Wishlist</span>
													</button>
													</a> -->
												<?php
												}
											?>
										</div>
									</div>
								</td>
							</tr>
							<?php
								if(isset($_SESSION['front_user_id']))
								{?>
									<tr>
										<td class="txtHover">
											<!-- <div class="flex-w flex-str m-b-25">
												<div class="size-w-15 flex-w flex-t">
													<a href="logout.php">
														<button class="btn btnSubLogin" style="border:none;">
															<span class="subLogin" style="font-size:130%;">Log Out</span>
														</button>
													</a>
												</div>
											</div> -->
											<?php
												if(isset($_SESSION['front_user_premium']) && $_SESSION['front_user_premium'])
												{?>
													<div class="flex-w flex-str m-b-2">
														<div class="size-w-10 flex-w flex-t">
														<a href="acountPlanDetails.php" class="btnSubLogin">
														<i class="anticon anticon-clock-circle btn_styleicon"></i>
															<!-- <button class="btn btnSubLogin" style="border:none;"> -->
																<span class="subLogin ml-1 btn_stylebut"><?php
																	$query = mysqli_query($con, "SELECT DATEDIFF(`expiary_date`, NOW()) FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] .";");
																	$result = mysqli_fetch_array($query);

																	echo $result[0] . " Days Left";
																?></span>
															<!-- </button> -->
														</a>
														</div>
													</div>
												<?php
												}
												else
												{
													if(isset($_SESSION['front_user_id']))
													{?>
														<!-- <tr>
															<td class=''> -->
																<div class="flex-w flex-str m-b-2">
																	<div class="size-w-10 flex-w flex-t">
																	<a href="premiumAccount.php" class="btnSubLogin">
																		<i class="fas fa-arrow-circle-up btn_styleicon"></i>
																			<span class="subLogin ml-1 btn_stylebut">Upgrade Account</span>
																	</a>
																	</div>
																</div>
															<!-- </td>
														</tr> -->
													<?php
													}
												}
											?>
										</td>
									</tr>
								<?php
								}
								?>
						</table>	
					</div>
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="main-menu-m">
				<li>
					<a href="index.php">HOME</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="index.html">Homepage 1</a></li>
						<li><a href="home-02.html">Homepage 2</a></li>
						<li><a href="home-03.html">Homepage 3</a></li>
						<li><a href="home-04.html">Homepage 4</a></li>
						<li><a href="home-05.html">Homepage 5</a></li>
						<li><a href="home-06.html">Homepage 6</a></li>
					</ul> -->

					<!-- <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<li>
					<a href="shop.php">SHOP</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="about-01.html">About 1</a></li>
						<li><a href="about-02.html">About 2</a></li>
						<li><a href="coming-soon.html">Coming Soon</a></li>
						<li><a href="error.html">404 Error</a></li>
						<li><a href="checkout.html">CheckOut</a></li>
						<li><a href="account.html">My Account</a></li>
						<li><a href="account-lost-pass.html">My Account Lost Pass</a></li>
						<li><a href="account-register.html">My Account Register</a></li>
						<li><a href="wishlist.html">Wishlist</a></li>
					</ul>

					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<li>
				<a href="sell_product.php">SELL PRODUCT</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="shop-sidebar-grid.html">Shop Sidebar Grid</a></li>
						<li><a href="shop-sidebar-list.html">Shop Sidebar List</a></li>
						<li><a href="shop-product-grid.html">Shop Product Grid</a></li>
						<li><a href="shop-product-list.html">Shop Product List</a></li>
						<li><a href="product-single.html">Product Single</a></li>
						<li><a href="shop-cart.html">Shop Cart</a></li>
					</ul>

					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<li>
					<a href="order.php">ORDER</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="blog-list.html">Blog List</a></li>
						<li><a href="blog-grid-01.html">Blog Grid 1</a></li>
						<li><a href="blog-grid-02.html">Blog Grid 2</a></li>
						<li><a href="blog-single.html">Blog Single</a></li>
					</ul>

					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<li>
					<a href="about_us.php">ABOUT US</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="gallery-01.html">Gallery 1</a></li>
						<li><a href="gallery-02.html">Gallery 2</a></li>
					</ul>

					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>

				<li>
					<a href="contact_us.php">CONTACT US</a>
					<!-- <ul class="sub-menu-m">
						<li><a href="contact-01.html">Contact 1</a></li>
						<li><a href="contact-02.html">Contact 2</a></li>
					</ul>

					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span> -->
				</li>
			</ul>
		</div>

		<!-- Modal Search -->
		<!-- <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
				<span class="lnr lnr-cross"></span>
			</button>
			
			<div class="container-search-header">
				<form class="wrap-search-header flex-w">
					<button class="flex-c-m trans-04">
						<span class="lnr lnr-magnifier"></span>
					</button>
					<input class="plh1" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div> -->
	</header>
<!-- End header -->