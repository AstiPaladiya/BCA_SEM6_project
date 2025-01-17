<?php
    session_start();
    include("../connection.php");

    $page = "Order";
?>
<html>
    <head>
        <title>Order Confirmed</title>
        <?php
            include("include.php");
        ?>
        <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
        <style>
            .main-menu{
            font-weight:600;
            font-family: Georgia, 'Times New Roman', Times, serif;
            /* letter-spacing: 2px; */
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
    <body>
        <?php
            // include("navbar.php")
        ?>
        <div class="container-fluid">
            <div class="row align-items-center h-100">
                <div class="col-6 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="card-title text-center">Order Confirmed</h1>
                            <img src="images/check.gif" width="15%" class="mx-auto d-block" />
                        </div>
                        <div class="card-body">
                            <span class="h5">Order Number : <?php
                                // echo $_SESSION['order_id'];
                                for($i = 0; $i < count($_SESSION['oids']); $i++)
                                {
                                    if($i == (count($_SESSION['oids'])) - 1)
                                    {
                                        echo $_SESSION['oids'][$i];
                                    }
                                    else
                                    {
                                        echo $_SESSION['oids'][$i] . ", ";
                                    }
                                }
                            ?></span>
                            <br/>

                            <div class="row mt-5 h-6">
                                <div class="col-6">Product Name : </div>
                                <div class="col-6"><?php
                                    // $query = mysqli_query($con, "select * from listing_products where id = ". $_SESSION['product_id'] ."");
                                    // $result = mysqli_fetch_array($query);

                                    // echo $result['product_name'];
                                    for($i = 0; $i < count($_SESSION['pnames']); $i++)
                                    {
                                        if($i == (count($_SESSION['pnames'])) - 1)
                                        {
                                            echo $_SESSION['pnames'][$i];
                                        }
                                        else
                                        {
                                            echo $_SESSION['pnames'][$i] . ", ";
                                        }
                                    }
                                ?></div>

                                <div class="col-6">Order Quantity : </div>
                                <div class="col-6"><?php
                                    echo $_SESSION['total_qty'];
                                ?></div>

                                <div class="col-6">Order Amount : </div>
                                <div class="col-6"><?php
                                    echo $_SESSION['total'];
                                ?></div>

                                <div class="col-6">Payment Mode : </div>
                                <div class="col-6"><?php
                                    echo "Cash on Delivery";
                                ?></div>

                                <div class="col-6">Delivery Address : </div>
                                <div class="col-6"><?php
                                    $query = mysqli_query($con, "SELECT `address` FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] ."");
                                    $result = mysqli_fetch_array($query);

                                    echo $result[0];
                                ?></div>

                                <br/></br>
                                <div class="col-12 text-center">
                                    Your order will be delivered within 7 days working days.
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-6">
                                    <div class="text-left">
                                        <button class="btn btn-success printInvoice">Print Invoice</button>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <a href="index.php" class="btn btn-info">Continue Shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===============================================================================================-->	
<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/additional-methods.min.js" integrity="sha512-6S5LYNn3ZJCIm0f9L6BCerqFlQ4f5MwNKq+EthDXabtaJvg3TuFLhpno9pcm+5Ynm6jdA9xfpQoMz2fcjVMk9g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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
    <script>
        $(".printInvoice").click(function(){
            window.print();
        })
    </script>
    </body>
</html>