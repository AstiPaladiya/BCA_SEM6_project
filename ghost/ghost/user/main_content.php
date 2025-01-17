<!-- Product -->
<div class="sec-gallery bg0 p-t-145 p-b-98">
		<div class="container">
		<div class="row gallery-lb isotope-grid isotope-grid-gallery">
			<?php
				$query_user=mysqli_query($con,"select * from user_master where role=1");
				while($row_user=mysqli_fetch_array($query_user))
				{	
					$query_product=mysqli_query($con,"select * from listing_products where user_id=".$row_user['id']."");
					while($row_product=mysqli_fetch_array($query_product))
					{
						echo "<div class='col-md-6 col-lg-4 p-b-30 isotope-item fruit-fill'>";
						echo"<div class='gallery-item wrap-pic-w'>";
						echo"<img src='../product_image/".$row_product['img1']."' width='370px' height='279.03px' alt='GALLERY'/>";
						echo"<div class='gallery-overlay flex-c-m trans-04'>";
						echo"<div class'gallery-content flex-w flex-c-m w-full'>";
						echo"<a class='flex-c-m gallery-btn m-all-5 trans-04 js-show-gallery js-gallery' style='color:red;' width='1200px' height='905px'   href='../product_image/".$row_product['img1']."'><img src='../image/fullscreen.png' width='50%' alt='OPEN'/></a><br/>";
						//  echo"<a href='#' class='flex-c-m gallery-btn m-all-5 trans-04'><img src='images/icons/icon-link.png' alt='LINK'></a>";
						echo"<div class='gallery-txt flex-col-c p-rl-15 p-t-10 trans-04'>";
						echo"<span class='txt-m-101 cl0 txt-center' style='text-decoration:underline;padding-bottom:10px;'>".$row_user['bussiness_name']."</span>";
						echo"<span class='txt-s-200 cl0 txt-center' style='font-size:130%;'>".$row_product['product_name']."</span>";
						echo"</div>";
						echo"</div>";
						echo"</div>";
						echo"</div>";
						echo"</div>";	
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