<!-- Footer -->
<footer class="bg2">
		<div class="container">
			<div class="wrap-footer flex-w p-t-60 p-b-62">
				<div class="footer-col1">
					<div class="footer-col-title">
						<a href="#">
							<img src="../image/ghost.png" alt="LOGO" class="rounded-circle">
						</a>
					</div>

					<p class="txt-s-101 cl0 size-w-10 p-b-16">
						A market place for C2C and B2C where you are the king, you sell your own product, buy products and make products.
					</p>

					<ul>
						<li class="txt-s-101 cl0 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-mail-02.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								ghostmarketer2125@gmail.com
							</span>
						</li>

						<li class="txt-s-101 cl0 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-pin-02.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								C.B.Patel Computer College, Althan, Surat
							</span>
						</li>

						<li class="txt-s-101 cl0 flex-t p-b-10">
							<span class="size-w-11">
								<img src="images/icons/icon-phone-02.png" alt="ICON-MAIL">
							</span>
							
							<span class="size-w-12 p-t-1">
								(+91) 63527 78198<br>
								(+91) 99247 21067
							</span>
						</li>
					</ul>
				</div>

				<!-- <div class="footer-col2">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl0">
							Information
						</span>
					</div>

					<ul>
						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								About our shop
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Top sellers
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Our blog
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								New products
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Secure shopping
							</a>
						</li>
					</ul>
				</div>

				<div class="footer-col3">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl0">
							My Account
						</span>
					</div>

					<ul>
						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								My account
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Discount
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Personal information
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								My address
							</a>
						</li>

						<li class="p-b-16">
							<a href="#" class="txt-s-101 cl0 hov-cl10 trans-04 p-tb-5">
								Order history
							</a>
						</li>
					</ul>
				</div> -->

				<div class="footer-col4">
					<div class="footer-col-title flex-m">
						<span class="txt-m-109 cl0">
							Feedback
						</span>
					</div>

					<p class="txt-s-101 cl0 p-b-33">
						Please feel free to share your issues, feedback and reviews to us. Your each review is important for us. We will look into your each and every reviews.
					</p>

					<form method="post" id="feedBackForm" class="flex-w">
						<!-- <input class="size-a-11 bg0 plh1 txt-s-111 cl3 p-rl-15" type="text" name="email" placeholder="Your email address">
						<button class="flex-c-m size-a-10 bg10 hov-btn2 trans-04">
							<img src="images/icons/icon-send.png" alt="SENT">
						</button> -->
						<div class="form-control">
							<input type="email" <?php
								if(isset($_SESSION['front_mail']))
								{
									echo "value='". $_SESSION['front_mail'] ."' readonly";
								}
							?> name="emailId" id="emailId" class="form-control" placeholder="Enter your email address">
							<span class="text-danger" id="emailError" style="font-size: smaller;">*Please enter email id.</span>
							<br/>
							<textarea name="feedBackTxt" id="feedBackTxt" class="form-control" cols="30" rows="10" placeholder="Enter your feedback here"></textarea>
							<span class="text-danger" style="font-size:smaller" id="feedBackError">*Please enter your feedback.</span>
							<br/>
							<button class="flex-c-m size-a-10 bg10 hov-btn2 trans-04" id="sendFeedbackBtn" type="button">
								<img src="images/icons/icon-send.png" alt="SENT">
							</button>
						</div>
					</form>
				</div> 
			</div>

			<div class="flex-w flex-sb-m bo-t-1 bocl16 p-tb-14">
				<span class="txt-s-101 cl0 p-tb-10 p-r-29">
					Copyright © 2023 Ghost Marketer. All rights reserved.
				</span>

				<!-- <div class="flex-w flex-m">
					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-01.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-02.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-03.png" alt="ICON-PAY">
					</a>

					<a href="#" class="m-r-29 m-tb-10">
						<img src="images/icons/icon-pay-04.png" alt="ICON-PAY">
					</a>

					<a href="#">
						<img src="images/icons/icon-pay-05.png" alt="ICON-PAY">
					</a>
				</div> -->
			</div>
		</div>
	</footer>