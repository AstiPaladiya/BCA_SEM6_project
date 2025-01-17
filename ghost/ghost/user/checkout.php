<?php
    session_start();
    include("../connection.php");

	$page = "Shop";

	$flag = [];
	for($i = 0; $i < count($_SESSION['pids']); $i++)
	{
		$query = mysqli_query($con, "SELECT * FROM `listing_products` WHERE `id` = ". $_SESSION['pids'][$i] ."");
		$result = mysqli_fetch_array($query);

		if($result['product_status'] != "Active" || $result['sell_status'] != "Unsold")
		{
			array_push($flag, $_SESSION['pids'][$i]);
		}
	}

	$_SESSION['pids'] = array_diff($_SESSION['pids'], $flag);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Checkout</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include("include.php");
    ?>
    <style>
    .main-menu{
    font-weight:600;
    font-family: Georgia, 'Times New Roman', Times, serif;
    /* letter-spacing: 2px; */
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
    <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
</head>
<body class="animsition">

	<?php
        include("navbar.php");
    ?>

	<!-- content page -->
	<div class="bg0 p-t-95 p-b-50">
		<div class="container">
			<!-- Login -->
			<div>
				<div class="how-bor3 p-rl-15 p-tb-28 m-tb-33 dis-none js-panel1">
					<form class="size-w-60 m-rl-auto">
						<p class="txt-s-120 cl9 txt-center p-b-26">
							If you have shopped with us before, please enter your details in the boxes below. If you are a new customer, please proceed to the Billing & Shipping section.
						</p>

						<div class="row">
							<div class="col-sm-6 p-b-20">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Username or email <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-15 focus1" type="text" name="username">
								</div>
							</div>

							<div class="col-sm-6 p-b-20">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Password <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-15 focus1" type="password" name="password">
								</div>
							</div>

							<div class="col-12">
								<button class="flex-c-m txt-s-105 cl0 bg10 size-a-21 hov-btn2 trans-04 p-rl-10">
									Login
								</button>

								<div class="flex-w flex-m p-t-10 p-b-3">
									<input id="check-creatacc" class="size-a-35 m-r-10" type="checkbox" name="creatacc">
									<label for="check-creatacc" class="txt-s-101 cl9">
										Create an account?
									</label>
								</div>

								<a href="#" class="txt-s-101 cl9 hov-cl10 trans-04">
									Lost your password?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="row">
				<div class="col-md-7 col-lg-8 p-b-50">
					<div>
						<h4 class="txt-m-124 cl3 p-b-28">
							Billing details
						</h4>

						<div class="row p-b-50">
							<div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Full Name <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="first-name" value="<?php echo $_SESSION['front_name'] ?>" readonly>
								</div>
							</div>

							<!-- <div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Last Name <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="last-name">
								</div>
							</div> -->

							<!-- <div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Company Name
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="company-name">
								</div>
							</div> -->

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Country <span class="cl12">*</span>
									</div>

									<div class="rs1-select2 rs2-select2 bg0 w-full bo-all-1 bocl15 m-tb-7 m-r-15">
										<select class="js-select2" disabled name="country">
											<option>US</option>
											<option>UK</option>
                                            <option value="India" selected>India</option>
										</select>
										<div class="dropDownSelect2"></div>
									</div>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Address <span class="cl12">*</span>
									</div>

									<!-- <input class="plh2 txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 m-b-20" type="text" name="street" placeholder="Street address">

									<input class="plh2 txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="add" placeholder="Apartment, suite, unit etc. (optional)"> -->
                                    <textarea name="add" class="plh2 txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" cols="10" rows="10" readonly><?php
                                        $query = mysqli_query($con, "SELECT `address`, `state`, `city`, `pincode`, `phone` FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] .""); 
                                        $userAdd = mysqli_fetch_array($query);
                                        echo $userAdd[0];
                                    ?></textarea>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Town/City <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="city" value="<?php echo $userAdd['city'] ?>" readonly>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										State <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="state" value="<?php echo $userAdd['state'] ?>" readonly>
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Postcode / Zip <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="postcode" readonly value="<?php echo $userAdd['pincode'] ?>">
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Phone <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="phone" readonly value="<?php echo $userAdd['phone'] ?>">
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Email Address <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="email" readonly value="<?php echo $_SESSION['front_mail'] ?>">
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-md-5 col-lg-4 p-b-50">
					<div class="how-bor4 p-t-35 p-b-40 p-rl-30 m-t-5">
						<h4 class="txt-m-124 cl3 p-b-11">
							Your order
						</h4>

						<div class="flex-w flex-sb-m txt-m-103 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
							<span>
								Product
							</span>

							<span>
								Total
							</span>
						</div>
						
                        <?php
                            for($i = 0; $i < count($_SESSION['pids']); $i++)
                            {?>
                                <div class="flex-w flex-sb-m txt-s-101 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
                                    <span>
                                        <?php echo $_SESSION['pnames'][$i] ?>
                                        <img class="m-rl-3" src="images/icons/icon-multiply.png" alt="icon">
                                        <?php echo $_SESSION['qtys'][$i] ?>
                                    </span>

                                    <span>
                                        &#8377; <?php echo $_SESSION['prices'][$i] ?>
                                    </span>
                                </div>   
                            <?php
                            }
                        ?>
						<!--  -->
						<!-- <div class="flex-w flex-sb-m txt-s-101 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
							<span>
								Cherry 
								<img class="m-rl-3" src="images/icons/icon-multiply.png" alt="icon">
								2
							</span>

							<span>
								36$
							</span>
						</div>

						<div class="flex-w flex-sb-m txt-s-101 cl6 bo-b-1 bocl15 p-b-21 p-t-18">
							<span>
								Asparagus 
								<img class="m-rl-3" src="images/icons/icon-multiply.png" alt="icon">
								1
							</span>

							<span>
								12$
							</span>
						</div> -->
						
						<!--  -->
						<div class="flex-w flex-m txt-m-103 bo-b-1 bocl15 p-tb-23">
							<span class="size-w-61 cl6">
								Subtotal
							</span>

							<span class="size-w-62 cl9">
								&#8377; <?php echo $_SESSION['total'] ?>
							</span>
						</div>

						<div class="flex-w flex-m txt-m-103 p-tb-23">
							<span class="size-w-61 cl6">
								Total
							</span>

							<span class="size-w-62 cl10">
                                &#8377; <?php echo $_SESSION['total'] ?>
							</span>
						</div>

						<div class="bo-all-1 bocl15 p-b-25 m-b-30">
							<div class="flex-w flex-m bo-b-1 bocl15 p-rl-20 p-tb-16">
								<input class="m-r-15" id="radio1" type="radio" name="pay" value="payment" checked="checked">
								<label class="txt-m-103 cl6" for="radio1">
									Cash on Delivery
								</label>
							</div>

							<div class="content-payment bo-b-1 bocl15 p-rl-20 p-tb-15">
								<p class="txt-s-120 cl9">
									Please keep the cash ready on delivery with change. And please don't provide any knds of extra money or tips to our delivery agents.
								</p>
							</div>

							<div class="flex-w flex-m p-rl-20 p-t-17 p-b-10">
								<input class="m-r-15" id="radio2" disabled type="radio" name="pay" value="paypal">
								<label class="txt-m-103 cl6" for="radio2">
									Net Banking / UPI
								</label>

								<div class="w-full p-l-29 p-t-16">
									<a href="#"><img src="images/icons/paypal.png" alt="IMG"></a>
								</div>
							</div>

							<div class="content-paypal bo-tb-1 bocl15 p-rl-20 p-tb-15 m-tb-10 dis-none">
								<p class="txt-s-120 cl9">
									Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.
								</p>
							</div>

							<div class="p-l-49">
								<a href="#" class="txt-s-120 cl6 hov-cl10 trans-04 p-t-10 text-danger">
									*Currrently Not Available
								</a>
							</div>								
						</div>

						<button id="placeOrderBtn" class="flex-c-m txt-s-105 cl0 bg10 size-a-21 hov-btn2 trans-04 p-rl-10">
							Place order
						</button>
                        <div class="d-flex justify-content-center">
                            <div id="loadingID" class="spinner-border text-success lex-c-m txt-s-105 cl0 size-a-21 hov-btn2 trans-04 p-rl-10" role="status">
                            </div>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php
        include("footer.php");
    ?>
	

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
	<script src="js/main.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function(){
            $("#loadingID").toggle();
            $("#placeOrderBtn").show();

            $("#placeOrderBtn").click(function(){
                $("#loadingID").show();
                $("#placeOrderBtn").hide();
                $.ajax({
                    type : "POST",
                    method : "POST",
                    dataType : "JSON",
                    url : "../crud.php?what=checkoutUserRemoveCart",
                    success : function(response){
                        if(response.success)
                        {
                            window.location.replace("orderConfirmed.php");
                        }
                        else
                        {
                            $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Error</h1><p>"+ response["message"] +"</p></div>",{
                                delay : 2500,
                                allow_dismiss : false,
                                width : 400,
                                align : "center",
                            });

                            window.location.replace("cart.php");
                        }
                    }
                })
            })
        })
    </script>
	<script src="../new_js/user_footer.js"></script>
</body>
</html>