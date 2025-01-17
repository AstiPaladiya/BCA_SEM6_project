<?php
    session_start();
    include("../connection.php");
    $page = "Shop";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Wishlist</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include("include.php");
    ?>
    <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>

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
        .main-menu{
            font-weight:600;
            font-family: Georgia, 'Times New Roman', Times, serif;
            /* letter-spacing: 2px; */
        }
        .login:hover
        {
            background-color:orange;
            color:white;
            border: 3px solid black; 
            /* box-shadow: 3px 3px 5px 2px black; */
            animation: pulse 1s ease-in-out;
            transition: .3s;
        }
		.bg10{
			background-color: red !important;
		}
        .btn_styleupdate{
            background-color: firebrick;
            color:white;
        }
        .btn_styleproc{
            background-color:green;
            color:white;
        }
        .btn_styleproc:hover{
            background-color:black;
            color:white;
        }
    </style>
</head>
<body class="animsition">

	<?php
        include("navbar.php");
    ?>

	<!-- content page -->
	<div class="bg0 p-t-100 p-b-80">
		<div class="container">
		<div class="wrap-table-shopping-cart rs1-table">
				<table class="table-shopping-cart">
					<tr class="table_head bg12">
						<th class="column-1 p-l-30">Product Name</th>
						<th class="column-2">Unit Price</th>
						<th class="column-3">Stock Status</th>
						<th class="column-4">Shop Now</th>
					</tr>

                    <?php
                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `wishlist_master` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
                        $result = mysqli_fetch_array($query);

                        if($result[0] > 0)
                        {
                            $query = mysqli_query($con, "SELECT `wishlist_master`.`id` AS `wid`, `listing_products`.`img1`, `listing_products`.`id`, `listing_products`.`product_name`, `listing_products`.`price`, `listing_products`.`sell_status`, `user_master`.`role` FROM `wishlist_master` JOIN `listing_products` ON `listing_products`.`id` = `wishlist_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `wishlist_master`.`user_id` = ". $_SESSION['front_user_id'] .";");
    
                            while($row = mysqli_fetch_array($query))
                            {?>
                                <tr class="table_row">
                                    <td class="column-1">
                                        <div class="flex-w flex-m">
                                            <div class="wrap-pic-w size-w-50 bo-all-1 bocl12 m-r-30">
                                                <img src="../product_image/<?php echo $row['img1'] ?>" alt="IMG">
                                            </div>
    
                                            <span>
                                                <?php
                                                    echo $row['product_name'];
                                                ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        &#8377; <?php
                                            echo $row['price'];
                                        ?>
                                    </td>
                                    <td class="column-3">
                                        <div class="flex-t">
                                            <?php
                                                if($row['sell_status'] == "Sold")
                                                {?>
                                                    <!-- <span style="background-color:greenyellow"><img class="m-t-4 m-r-8" src="images/icons/icon-close.png" alt="IMG"></span> -->
                                                    <span class="size-w-53 txt-m-104 cl6">
                                                        <a class="btn btn-danger"><span style="color:white; font-size:large"><i class="anticon anticon-close-circle"></i></span><span class="ml-2" style="color:white;font-size:medium">Out of Stock</span></a>
                                                    </span>
                                                <?php
                                                }
                                                else
                                                {?>
                                                    <!-- <img class="m-t-4 m-r-8" src="images/icons/icon-list3.png" alt="IMG"> -->
                                                    <span style="color:white; font-size:large"><i class="anticon anticon-check-circle"></i></span>
                                                    <span class="ml-2 size-w-53 txt-m-104 cl6">
                                                        <a class="btn btn-success"><span style="color:white; font-size:large"><i class="anticon anticon-check-circle"></i></span><span class="ml-2" style="color:white;font-size:medium">In Stock</span></a>
                                                    </span>
                                                <?php
                                                }
                                            ?>
                                        </div>
                                    </td>
                                    <td class="column-4">
                                        <div class="flex-w flex-sb-m">
                                            <?php
                                                if($row['role'] == 1)
                                                {?>
                                                    <a href="buss_view_more.php?id=<?php echo $row['id'] ?>" class="flex-c-m txt-s-103 cl6 size-a-2 how-btn1 btn_styleproc bo-all-1 bocl11 ">
                                                <?php
                                                }else
                                                {?>
                                                    <a href="user_view_more.php?id=<?php echo $row['id'] ?>" class="flex-c-m txt-s-103 cl6 size-a-2 how-btn1 btn_styleproc bo-all-1 bocl11 ">
                                                <?php
                                                }
                                            ?>
                                                Shop now
                                                <span class="lnr lnr-chevron-right m-l-7"></span>
                                                <span class="lnr lnr-chevron-right"></span>
                                            </a>
    
                                            <div class="fs-15 hov-cl10 pointer">
                                                <span class="lnr lnr-cross removeFromWishlist" data-pid="<?php echo $row['id'] ?>"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            <?php
                            }
                        }
                        else
                        {?>
                        <tr>
                            <td colspan="4" class="text-center" style="color:grey;">
                                <h4>Products not found in wishlist.....</h4>
                            </td>
                        </tr>
                        <?php
                        }
                    ?>
				</table>
			</div>

			<div class="flex-w flex-sb-m p-t-30">
				<div class="flex-w flex-m m-r-50 m-tb-10">
					<button id="clearWishlistBtn" class="flex-c-m txt-s-103 cl6 btn-dark btn-tone size-h-9 how-btn1 bo-all-1 bocl11 <?php
						if($result[0] > 0)
						{
							echo "hov-btn1";
						}
					?>  trans-04 pointer p-rl-29 m-tb-10 m-r-30" <?php
						if($result[0] == 0)
						{
							echo "disabled";
						}
					?>>
						Clear wishlist
					</button>

					<!-- <div class="flex-c-m txt-s-103 cl6 size-h-9 how-btn1 bo-all-1 bocl11 hov-btn1 trans-04 pointer p-rl-29 m-tb-10">
						Update wishlist
					</div> -->
				</div>

				<a href="shop.php" class="flex-c-m txt-s-103 btn_styleupdate size-h-9 hov-btn2 trans-04 pointer p-rl-29 m-tb-10">
					Continue shopping
				</a>
			</div>
		</div>
	</div>

	<!-- Footer -->
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

    <!-- Bootstrapgrowl -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
		$("#clearWishlistBtn").click(function(){
			$.ajax({
				type : "POST",
				method : "POST",
				dataType : "JSON",
				url : "../crud.php?what=EmptyWishlist",
				success : function(response){
					if(response.success)
					{
						window.location.reload();
					}
					else
					{
						$.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Warning !</h1><p>"+response['message']+"</p></div>",
                        {
                            delay : 4000,
                            width : 400,
                            offset : {"from" : "top", "amount" : 20},
                            allow_dismiss : false,
                            align : "center",
                        }); 
					}
				}
			})
		})
        $(".removeFromWishlist").click(function(){
            const json = {"pid" : $(this).attr("data-pid")};

            $.ajax({
                type : "POST",
                method : "POST",
                data : json,
                dataType : "JSON",
                url : "../crud.php?what=removeWishList",
                success : function(response){
                    if(response.success)
                    {
                        window.location.reload();
                    }
                    else
                    {
                        $.bootstrapGrowl("<div class='text-center' style='background-color:#FF3232;opacity:1;font-weight:bold'><h1>Warning !</h1><p>"+response['message']+"</p></div>",
                        {
                            delay : 4000,
                            width : 400,
                            offset : {"from" : "top", "amount" : 20},
                            allow_dismiss : false,
                            align : "center",
                        }); 
                    }
                }
            })
        })
    </script>
    <script src="../new_js/user_footer.js"></script>

</body>
</html>