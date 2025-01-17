<?php
    session_start();
    include("../connection.php");
    $page = "Shop";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>User Shop Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include("include.php");
    ?>
    <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
    <style>
        .subLogin
        {
            color:cornflowerblue;
            font-size:120%;
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
    </style>
</head>
<body class="animsition">

	<?php
        include("navbar.php");
    ?>

	<!-- content page -->
	<div class="bg0 p-tb-100">
		<div class="container">
			<form id="cartForm">
				<div class="wrap-table-shopping-cart">
                    <?php
                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `cart` WHERE `user_id` = ". $_SESSION['front_user_id'] ."");
                        $result = mysqli_fetch_array($query);

                        if($result[0] > 0)
                        {?>
                            <table class="table-shopping-cart">
                                <tr class="table_head bg12">
                                    <th class="column-1 p-l-30">Product</th>
                                    <th class="column-2">Price</th>
                                    <th class="column-3">Quantity</th>
                                    <th class="column-4">Total</th>
                                </tr>

                                <?php
                                    $query = mysqli_query($con, "SELECT `cart`.`id` AS `cid`, `listing_products`.`img1`, `listing_products`.`product_name`, `listing_products`.`id` AS `pid`, `listing_products`.`price`, `cart`.`quantity` FROM `cart` JOIN `listing_products` ON `listing_products`.`id` = `cart`.`product_id` JOIN `user_master` ON `user_master`.`id` = `cart`.`user_id` WHERE `cart`.`user_id` = ". $_SESSION['front_user_id'] .";");

                                    while($row = mysqli_fetch_array($query))
                                    {?>
                                        <tr class="table_row">
                                            <td class="column-1">
                                                <div class="flex-w flex-m">
                                                    <div class="wrap-pic-w size-w-50 bo-all-1 bocl12 m-r-30">
                                                        <img src="../product_image/<?php echo $row['img1'] ?>" alt="IMG">
                                                    </div>

                                                    <span>
                                                        <?php echo $row['product_name'] ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="column-2">
                                                &#8377; <?php echo $row['price'] ?>
                                            </td>
                                            <td class="column-3">
                                                <div class="wrap-num-product flex-w flex-m bg12 p-rl-10">
                                                    <div class="btn-num-product-down flex-c-m fs-29"></div>

                                                    <input class="txt-m-102 cl6 txt-center num-product" type="number" readonly name="num-product1" value="<?php echo $row['quantity'] ?>" data-pid="<?php echo $row['pid'] ?>" data-cid="<?php echo $row['cid'] ?>">

                                                    <div class="btn-num-product-up flex-c-m fs-16"></div>
                                                </div>
                                            </td>
                                            <td class="column-4">
                                                <div class="flex-w flex-sb-m">
                                                    <span id="individualTotal">
                                                        &#8377; <?php echo round(($row['quantity'] * $row['price']),2) ?>
                                                    </span>

                                                    <div class="fs-15 hov-cl10 pointer">
                                                        <span class="lnr lnr-cross" data-id="<?php echo $row['cid'] ?>"></span>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                ?>
                                <!-- <tr class="table_row">
                                    <td class="column-1">
                                        <div class="flex-w flex-m">
                                            <div class="wrap-pic-w size-w-50 bo-all-1 bocl12 m-r-30">
                                                <img src="images/best-sell-01.jpg" alt="IMG">
                                            </div>

                                            <span>
                                                Cheery
                                            </span>
                                        </div>
                                    </td>
                                    <td class="column-2">
                                        $ 18.00
                                    </td>
                                    <td class="column-3">
                                        <div class="wrap-num-product flex-w flex-m bg12 p-rl-10">
                                            <div class="btn-num-product-down flex-c-m fs-29"></div>

                                            <input class="txt-m-102 cl6 txt-center num-product" type="number" name="num-product1" value="2">

                                            <div class="btn-num-product-up flex-c-m fs-16"></div>
                                        </div>
                                    </td>
                                    <td class="column-4">
                                        <div class="flex-w flex-sb-m">
                                            <span>
                                                36$
                                            </span>

                                            <div class="fs-15 hov-cl10 pointer">
                                                <span class="lnr lnr-cross"></span>
                                            </div>
                                        </div>
                                    </td>
                                </tr> -->
                            </table>
                        <?php
                        }
                        else
                        {?>
                            <h3>Products not found in cart ...</h3>
                        <?php
                        }
                    ?>
				</div>

				<div class="flex-w flex-sb-m p-t-20">

					<button type="button" <?php
                        if($result[0] == 0)
                        {
                            echo "hidden";
                        }
                    ?> id="updateCart" class="flex-c-m txt-s-105  size-a-33  btn_styleupdate hov-btn2 trans-04 pointer p-rl-10 m-tb-10">
						update CART
					</button>
				</div>

				<div class="flex-col-l p-t-68">
					<span class="txt-m-123 cl3 p-b-18">
						CART TOTALS :
					</span>
					
					<div class="flex-w flex-m bo-b-1 bocl15 w-full p-tb-18 ml-2">
						<span class="size-w-58 c16 txt-m-109 " style="font-size:18px;font-weight:600"   >
							Subtotal
						</span>

						<span class="size-w-59 txt-m-104 cl6">
							&#8377; <?php
                                if($result[0] == 0)
                                {
                                    echo "<span style='font-size:17px'>0.00</span>";
                                }
                                else
                                {
                                    $query = mysqli_query($con, "SELECT SUM(`listing_products`.`price` * `cart`.`quantity`) AS `total` FROM `cart` JOIN `listing_products` ON `listing_products`.`id` = `cart`.`product_id` WHERE `cart`.`user_id` = ". $_SESSION['front_user_id'] .";");

                                    $subTotal = mysqli_fetch_array($query);

                                    echo "<span style='font-size:17px'>".$subTotal[0]."</span>";
                                }
                            ?>
						</span>
					</div>

					<div class="flex-w flex-m bo-b-1 bocl15 w-full p-tb-18 m-2">
						<span class="size-w-58  c16 txt-m-109" style="font-size:18px;font-weight:600">
							Total
						</span>

						<span class="size-w-59 txt-m-104 cl10">
							&#8377; <?php
                                if($result[0] == 0)
                                {
                                    echo "<span style='font-size:17px'>0.00</span>";
                                }
                                else
                                {
                                    echo "<span style='font-size:17px;color:green;'>".$subTotal[0]."</span>";
                                }
                            ?>
						</span>
					</div>

					<button type="button" id="checkout" <?php
                        if($result[0] == 0)
                        {
                            echo "disabled";
                        }
                    ?> class="flex-c-m txt-s-105 btn_styleproc size-a-34 hov-btn2 trans-04 p-rl-10 m-t-43">
						proceed to checkout
					</button>
				</div>
			</form>
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
            $(".lnr-cross").click(function(){
                const json = {"cid" : $(this).attr('data-id')};

                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=removeFromCartFromUserChekout",
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
            $("#updateCart").click(function(){
                //make an ajax call to update quantity in cart

                const json = {};
                json['cid'] = "";
                json['qty'] = "";
                $.each($("input[name=num-product1]"), function(){
                    // console.log($(this).attr("data-cid"));
                    // json[$(this).attr("data-cid")] = this.value;
                    json['cid'] += $(this).attr("data-cid") + ", ";
                    json['qty'] += this.value + ", ";
                })

                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=updateUserCart",
                    success : function(response){
                        if(response.success){
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

            $("#checkout").click(function(){
                const json = {};
                json['pid'] = "";
                json['qty'] = "";
                $.each($("input[name=num-product1]"), function(){
                    // console.log($(this).attr("data-cid"));
                    // json[$(this).attr("data-cid")] = this.value;
                    json['pid'] += $(this).attr("data-pid") + ", ";
                    json['qty'] += this.value + ", ";
                })

                // console.log(json);

                $.ajax({
                    type : "POST",
                    method : "POST",
                    data : json,
                    dataType : "JSON",
                    url : "../crud.php?what=fromCartToCheckoutProcess",
                    success : function(response){
                        window.location.href = response.url;
                    }
                })
            })
        })
    </script>

<script src="../new_js/user_footer.js"></script>
</body>
</html>