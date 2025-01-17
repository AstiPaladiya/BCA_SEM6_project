<?php
    session_start();
    include("../connection.php");
    if(!isset($_SESSION["front_user_id"]))
    {
        header("Location:../user_login.php");
    }
    $page = "Chat";
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
    span{
        word-wrap: break-word;
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
    width: 1000px;
    height: 279.03px;
    top:0;
    left:0;
  }
}
.style_body{
    background-color:whitesmoke;
}
.style_recivemsg
{
    background-color:dodgerblue;
    color:white;
}
.style_sendmsg
{
    background-color:white;
    color:black;
}
.chat_list{
    background-color:aliceblue;
}
</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->
    <!-- Main content start -->
    <div class="p-t-95 p-b-50">
        <div class="container-fluid">
            <div class="chat chat-app row">
                <div class="chat-list chat_list" style="background-color:lightseagreen;color:white">
                    <div class="chat-user-tool" style="border-bottom:1px solid silver;">
                        <div>
                            <table class='mt-3'>
                                <tr>
                                <?php
                                    $query = mysqli_query($con, "SELECT * FROM `user_master` WHERE `id` = ". $_SESSION['front_user_id'] ."");
                                    $result = mysqli_fetch_array($query);
                                    if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
                                    {
                                        if($result['gender']=='male')
                                        {   echo"<td>";
                                            echo"<img src='../image/male_profile.png' class='avatar' id='imgProfile' style='height:50px; width: 50px'>";
                                            echo"</td>";
                                        }
                                        else
                                        {
                                            echo"<td>";
                                            echo"<img src='../image/female_profile.png' class='avatar' id='imgProfile' style='height: 50px; width: 50px'>";
                                            echo"</td>";  
                                        }
                                    }
                                    else
                                    {
                                        echo"<td>";
                                        echo"<img style='height: 50px; width: 50px' class='avatar' src='../user_profile/".$result['profile_img']."' id='imgProfile' />";
                                        echo"</td>";
                                    }
                                    echo"<td class='pl-2'>";
                                    echo "<span style='font-size:18px'> " . $_SESSION['front_name']."</span>";
                                    echo"</td>";
                                ?>
                                </tr>
                                
                            </table>
                        </div>
                    </div>
                    <div class="chat-user-list"  style="background-color:lightcyan;">
                        <!-- <a class="chat-list-item p-h-25" href="javascript:void(0);">
                            <div class="media align-items-center">
                                <div class="avatar avatar-image">
                                    <img src="assets/images/avatars/thumb-1.jpg" alt="">
                                </div>
                                <div class="p-l-15">
                                    <h5 class="m-b-0">Erin Gonzales</h5>
                                    <p class="msg-overflow m-b-0 text-muted font-size-13">
                                        Wow, that was cool!
                                    </p>
                                </div>
                            </div>
                        </a> -->

                        <?php
                            // $query = mysqli_query($con, "SELECT DISTINCT `product_id`, `sender_user_id`, `receiver_user_id` FROM `chat_master` WHERE `receiver_user_id`= ". $_SESSION['front_user_id'] ." OR `sender_user_id` = ". $_SESSION['front_user_id'] ."");  
                            $query = mysqli_query($con, "SELECT * FROM `chat_first` WHERE `user_first` = ". $_SESSION['front_user_id'] ." OR `user_second` = ". $_SESSION['front_user_id'] ."");       
                            while($row = mysqli_fetch_array($query))
                            {?>
                                <a class="chat-list-item p-h-25 changeChat" style="border-bottom:1px solid silver;" href="javascript:void(0);" <?php
                                    $tempChck = mysqli_query($con, "SELECT `sell_status`, `product_status` FROM `listing_products` WHERE `id` = ". $row['product_id'] ."");
                                    $tempResult = mysqli_fetch_array($tempChck);

                                    if($tempResult['sell_status'] == "Sold" || $tempResult['product_status'] == "Block")
                                    {
                                        echo "hidden";
                                    }
                                ?> data-pid="<?php echo $row['product_id'] ?>" data-uid="<?php
                                    if($row['user_first'] == $_SESSION['front_user_id'])
                                    {
                                        $flag = $row['user_second'];
                                        echo $row['user_second'];
                                    }
                                    else
                                    {
                                        $flag = $row['user_first'];
                                        echo $row['user_first'];
                                    }
                                ?>">
                                    <div class="media align-items-center">
                                        <div class="avatar avatar-image">
                                            <img src="../product_image/<?php
                                                $tempQuery = mysqli_query($con, "SELECT `img1` FROM `listing_products` WHERE `id` = ". $row['product_id'] ."");
                                                $temp = mysqli_fetch_array($tempQuery);
                                                echo $temp[0];
                                            ?>" alt="">
                                        </div>
                                        <div class="p-l-15">
                                            <h5 class="m-b-0"><?php
                                                $tempQuery = mysqli_query($con, "SELECT `product_name` FROM `listing_products` WHERE `id` = ". $row['product_id'] ."");
                                                $temp = mysqli_fetch_array($tempQuery);

                                                echo $temp[0];
                                            ?></h5>
                                            <p class="msg-overflow m-b-0 text-muted font-size-13">
                                                <?php
                                                    if($row['user_first'] == $_SESSION['front_user_id'])
                                                    {
                                                        $tempQuery = mysqli_query($con, "SELECT `owner_name` FROM `user_master` WHERE `id` = ". $row['user_second'] ."");
                                                        $temp = mysqli_fetch_array($tempQuery);

                                                        echo $temp[0];
                                                    }
                                                    else
                                                    {
                                                        // echo $row['sender_user_id'];
                                                        $tempQuery = mysqli_query($con, "SELECT `owner_name` FROM `user_master` WHERE `id` = ". $row['user_first'] ."");
                                                        $temp = mysqli_fetch_array($tempQuery);

                                                        echo $temp[0];
                                                    }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="text-right badge badge-pill badge-danger counterClass"><?php
                                            $unreadQuery = mysqli_query($con, "SELECT COUNT(*) FROM `chat_master` WHERE `sender_user_id` = ". $flag ." AND `receiver_user_id` = ". $_SESSION['front_user_id'] ." AND `read_by_receiver` = 'false'");

                                            $unreadResult = mysqli_fetch_array($unreadQuery);

                                            echo $unreadResult[0];
                                        ?></div>
                                    </div>
                                </a>
                            <?php
                            } 
                        ?>
                    </div>   
                </div>
                <div class="chat-content" >
                    <div class="conversation">
                        <div class="conversation-wrapper" >
                            <div class="conversation-header justify-content-between" >
                                <div class="media align-items-center" >
                                    <a href="javascript:void(0);" class="chat-close m-r-20 d-md-none d-block text-dark font-size-18 m-t-5" >
                                        <i class="anticon anticon-left-circle"></i>
                                    </a>
                                    <div class="avatar avatar-image">
                                        <img src="../image/logo.png" alt="">
                                    </div>
                                    <div class="p-l-15">
                                        <h6 class="m-b-0" id="receiver_name"><?php
                                            if(isset($_SESSION['receiver_name'])) 
                                            {
                                                echo $_SESSION['receiver_name'];
                                            }
                                        ?></h6>
                                        <p class="m-b-0 text-muted font-size-13 m-b-0">
                                            <!-- <span class="badge badge-success badge-dot m-r-5"></span> -->
                                            <span id="which_product"><?php
                                                if(isset($_SESSION['product_name']))
                                                {
                                                    echo $_SESSION['product_name'];
                                                }
                                            ?></span>
                                        </p>
                                    </div>
                                </div>
                                <!-- <div class="dropdown dropdown-animated scale-left">
                                    <a class="text-dark font-size-20" href="javascript:void(0);" data-toggle="dropdown">
                                        <i class="anticon anticon-setting"></i>
                                    </a>
                                    <div class="dropdown-menu">
                                        <button class="dropdown-item" type="button">Action</button>
                                        <button class="dropdown-item" type="button">Another action</button>
                                        <button class="dropdown-item" type="button">Something else here</button>
                                    </div>
                                </div> -->
                            </div>
                            <div class="conversation-body style_body" id="conversation-body">
                                <?php

                                    if(isset($_SESSION['product_chat_id']))
                                    {
                                        $query = mysqli_query($con, "SELECT * FROM `chat_master` WHERE `product_id` = ". $_SESSION['product_chat_id'] ." AND `sender_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .") AND `receiver_user_id` IN(". $_SESSION['front_user_id'] .", ". $_SESSION['receiver_user_id'] .")");

                                        $_SESSION['last_id'] = 0;
                                        while($row = mysqli_fetch_array($query))
                                        {
                                            if($row['receiver_user_id'] == $_SESSION['front_user_id'])
                                            {?>
                                                <!-- Message Received by me -->
                                                <div class="msg msg-recipient">
                                                    <div class="m-r-10">
                                                        <div class="avatar avatar-image">
                                                            <img src="../image/logo.png" alt="">
                                                        </div>
                                                    </div>
                                                    <div class="bubble">
                                                        <div class="bubble-wrapper style_recivemsg" style="background-color:lightseagreen;color:white;border:1px solid lightgrey;">
                                                            <span><?php
                                                                echo base64_decode($row['message']);
                                                            ?></span>
                                                            <br>
                                                        </div>
                                                        <div class="text-left">
                                                            <span style="color:black;font-size:x-small;"><?php
                                                                echo $row['created_at'];
                                                            ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            else
                                            {?>
                                                    <!-- Message Sent by me -->
                                                    <div class="msg msg-sent">
                                                        <div class="bubble">
                                                            <div class="bubble-wrapper style_sendmsg"  style="background-color:white;color:black;border:1px solid lightgrey;">
                                                                <span><?php
                                                                    echo base64_decode($row['message']);
                                                                ?></span><br/>
                                                            </div>
                                                            <div class="text-right">
                                                                <span style="color:black;font-size:x-small;"><?php 
                                                                    echo $row['created_at'];
                                                                ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            <?php
                                            } 
                                            
                                            $_SESSION['last_id'] = $row['id'];
                                        }

                                        ?>
                                            <script>
                                                $(document).ready(function(){
                                                    var pid = <?php echo $_SESSION['product_chat_id'] ?>;
                                                    var uid = <?php echo $_SESSION['receiver_user_id'] ?>;
                                                    var chats = $($(`a[data-pid='${pid}'][data-uid='${uid}']`).find(".counterClass")).text();

                                                    $($(`a[data-pid='${pid}'][data-uid='${uid}']`).find(".counterClass")).addClass("d-none");
                                                    console.log(chats);
                                                })
                                            </script>
                                        <?php
                                    }
                                ?>
                                <!-- <div class="msg justify-content-center">
                                    <div class="font-weight-semibold font-size-12"> 7:57PM </div>
                                </div>
                                <div class="msg msg-recipient">
                                    <div class="m-r-10">
                                        <div class="avatar avatar-image">
                                            <img src="assets/images/avatars/thumb-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="bubble">
                                        <div class="bubble-wrapper">
                                            <span>Hey, let me show you something nice!</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="msg msg-sent">
                                    <div class="bubble">
                                        <div class="bubble-wrapper">
                                            <span>Oh! What is it?</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="msg msg-recipient">
                                    <div class="m-r-10">
                                        <div class="avatar avatar-image">
                                            <img src="assets/images/avatars/thumb-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="bubble">
                                        <div class="bubble-wrapper p-5">
                                            <img src="https://s3.envato.com/files/249796117/preview.__large_preview.png" alt="https://s3.envato.com/files/249796117/preview.__large_preview.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="msg msg-recipient">
                                    <div class="bubble m-l-50">
                                        <div class="bubble-wrapper">
                                            <span>Applicator - Bootstrap 4 Admin Template</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="msg msg-recipient">
                                    <div class="bubble m-l-50">
                                        <div class="bubble-wrapper">
                                            <span>A creative, responsive and highly customizable admin template</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="msg msg-sent">
                                    <div class="bubble">
                                        <div class="bubble-wrapper">
                                            <span>Wow, that was cool!</span>
                                        </div>
                                    </div>
                                </div> -->
                            </div> 
                            <div class="conversation-footer" >
                                <input id="messageTxt" class="chat-input" type="text" placeholder="Type a message...">
                                <ul class="list-inline d-flex align-items-center m-b-0">
                                    <!-- <li class="list-inline-item m-r-15">
                                        <a class="text-gray font-size-20" href="javascript:void(0);" data-toggle="tooltip" title="Emoji">
                                            <i class="anticon anticon-smile"></i>
                                        </a>
                                    </li> 
                                    <li class="list-inline-item m-r-15">
                                        <a class="text-gray font-size-20" href="javascript:void(0);" data-toggle="tooltip" title="Attachment">
                                            <i class="anticon anticon-paper-clip"></i>
                                        </a>
                                    </li>     -->
                                    <li class="list-inline-item">
                                        <button class="d-md-block btn" style="background-color:lightseagreen;color:white" id="sendMessageBtn" <?php
                                            if(!isset($_SESSION['product_chat_id']))
                                            {
                                                echo "disabled";
                                            }
                                        ?>>
                                            <span class="m-r-10">Send</span>
                                            <i class="far fa-paper-plane"></i>
                                        </button>
                                        <!-- <a href="javascript:void(0);" class="text-gray font-size-20 d-md-none d-block">
                                            <i class="far fa-paper-plane"></i>
                                        </a> -->
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <!-- main content end -->
	
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

<script src="js/main.js"></script>
<script src="../new_js/time.js"></script>
<script src="../new_js/item_carousal.js"></script>
<script src="../new_js/user_footer.js"></script>
<script src="../new_js/user_chat.js"></script>
<script src="../new_js/custom_chat.js"></script>
</body>
</html>