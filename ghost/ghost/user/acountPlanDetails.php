<?php
    session_start();
    include("../connection.php");

    $page = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Premium Account Details</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        include("include.php");
    ?>
    <link rel="icon" type="image/png" href="../image/logo.png" class="rounded-circle"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">

    <style>
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
<body class="animsition">

	<?php
        include("navbar.php");
    ?>

	<!-- content page -->
	<div class="bg0 p-t-100 p-b-80">
		<div class="container">
		<div class="wrap-table-shopping-cart rs1-table">
			<div class="card">
                <div class="card-header">
                    <h1 class="card-title">
                        Current Plan Details
                    </h1>
                </div>
                <div class="card-body">
                    <?php
                        $query = mysqli_query($con, "SELECT `subscription_master`.`subscription_name`, `subscription_master`.`description`, `subscription_master`.`rate`, DATEDIFF(`user_master`.`expiary_date`, NOW()) FROM `subscription_master` JOIN `user_master` ON `user_master`.`subscrib_id` = `subscription_master`.`id` WHERE `user_master`.`id` = ". $_SESSION['front_user_id'] .";");
                        $result = mysqli_fetch_array($query);
                    ?>

                    <div class="row">
                        <div class="col-3">
                            Plan Name : 
                        </div>
                        <div class="col-9">
                            <?php echo $result['subscription_name']; ?>                            
                        </div>

                        <br/>

                        <div class="col-3">
                            Plan Description :
                        </div>
                        <div class="col-9">
                            <?php echo $result['description']; ?>
                        </div>

                        <br/>

                        <div class="col-3">
                            Rate :
                        </div>
                        <div class="col-9">
                            <?php echo $result['rate']; ?>
                        </div>

                        <br/>

                        <div class="col-3">
                            Days Left :
                        </div>
                        <div class="col-9">
                            <?php echo $result[3] . " Days"; ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Previous Plans Purchased
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <span id="oopps">Oops... No previously plan history found.</span>
                        <div class="table-responsive"> 
                            <table class="table table-plans" id="prebPlans">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Plan Name</th>
                                        <th>Description</th>
                                        <th>Rate</th>
                                        <th>Expired On</th>
                                        <th>Purchased On</th>
                                    </tr>
                                </thead>
                                <tbody id="tbl">
                                    <?php
                                        $query = mysqli_query($con, "SELECT `subscription_master`.`subscription_name`, `subscription_master`.`description`, `subscription_master`.`rate`, `subscription_selling`.`created_at`, `user_master`.`expiary_date` FROM `subscription_master` JOIN `subscription_selling` ON `subscription_selling`.`subscription_id` = `subscription_master`.`id` JOIN `user_master` ON `user_master`.`subscrib_id` = `subscription_master`.`id` WHERE `user_master`.`id` = ". $_SESSION['front_user_id'] ." AND DATEDIFF(`subscription_selling`.`expiary_date`, NOW()) < 0;");
    
                                        while($row = mysqli_fetch_array($query))
                                        {?>
                                            <tr>
                                                <td><?php echo $row[0] ?></td>
                                                <td><?php echo $row[1] ?></td>
                                                <td><?php echo $row[2] ?></td>
                                                <td><?php echo $row[4] ?></td>
                                                <td><?php echo $row[3] ?></td>
                                            </tr>    
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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

    <!-- Datatable -->
    <script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

    <!-- Bootstrapgrowl -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
		if($("#tbl").children().length == 0)
        {
            $(".table-plans").hide();
            $("#oopps").show();

        }
        else
        {
            $(".table-plans").show();
            $("#oopps").hide();
            $("#prebPlans").DataTable();
        }
    </script>

    <script src="../new_js/user_footer.js"></script>

</body>
</html>