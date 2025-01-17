<style>
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
        }
    body {
        top: 0px !important;
        }
    .icon-button__badge {
        position: absolute;
        top: 0px;
        right: 0px;
        width: 10px;
        height: 10px;
        background: red;
        color: #ffffff;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
    }
.txtHover:hover{
            background-color:rgba(255, 99, 71, 0.3);
            color:red;
            border-right:2px solid red;
}
</style>
<div class="header">
    <div class="logo logo-dark">
        <a href="index.php">
            <img src="../image/ghost2.png" class="mt-2" alt="Logo">
            <img class="logo-fold pb-2"  src="../image/logo.png" width="100%"  alt="Logo">
        </a>
    </div>
    <div class="logo logo-white">
        <a href="index.php">
            <img src="../image/ghost2.png" alt="Logo">
            <img class="logo-fold" src="../image/logo.png" alt="Logo">
        </a>
    </div>
    <div class="nav-wrap">
        <ul class="nav-left">
            <li class="desktop-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
            <li class="mobile-toggle">
                <a href="javascript:void(0);">
                    <i class="anticon"></i>
                </a>
            </li>
        </ul>
        <ul class="nav-right">
           
            <li class="scale-left">
                <div id="gettimehere"></div>
            </li>

            <?php
                if(!$_SESSION['plan_expired'])
                {?>
                    <li class="dropdown dropdown-animated scale-left">
                        <a href="javascript:void(0);" data-toggle="dropdown" id="notifyDropdown">
                            <i class="anticon anticon-bell notification-badge"></i>
                        </a>
                        <div class="dropdown-menu pop-notification"  style="width:500%">
                            <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                <p class="text-dark font-weight-semibold m-b-0">
                                    <span class="m-l-0"><i class="anticon anticon-bell"></i></span>
                                    <span class="m-l-10">Notifications</span> 
                                </p>
                            </div>
                            <div class="relative">
                                <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                    <?php
                                        $query = mysqli_query($con, "SELECT DATEDIFF(`expiary_date`, NOW()) FROM `user_master` WHERE `id` = ". $_SESSION['user_id'] .";");
                                        $result = mysqli_fetch_array($query);

                                        if($result[0] < 10)
                                        {?>
                                            <a class="dropdown-item d-block p-5 border-bottom">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-red avatar-icon">
                                                        <i class="anticon anticon-exclamation-circle"></i>
                                                    </div>
                                                    <div class="m-l-10">
                                                        <p class="m-b-0 text-danger">Premium Plan Expire</p>
                                                        <p class="m-b-0 text-danger"><small><?php echo $result[0] ?> days left</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                    ?>
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `complaint_user` WHERE `complainee_user_id` = ". $_SESSION['user_id'] ." AND `status` = 'Unseen'");
                                        $result = mysqli_fetch_array($query);

                                        if($result[0] != 0)
                                        {?>
                                            <a href="complaint.php" class="dropdown-item d-block p-5 border-bottom">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-red avatar-icon">
                                                        <i class="anticon anticon-warning"></i>
                                                    </div>
                                                    <div class="m-l-10">
                                                        <p class="m-b-0 text-dark">User Complain</p>
                                                        <p class="m-b-0"><small><?php echo $result[0] ?> Unseen</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                        // echo $result[0];
                                    ?>
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `complaint_product` JOIN `listing_products` ON `listing_products`.`id` = `complaint_product`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `complaint_product`.`status` = 'Unseen'");
                                        $result = mysqli_fetch_array($query);

                                        if($result[0] != 0)
                                        {?>
                                            <a href="complaint.php" class="dropdown-item d-block p-5 border-bottom">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-red avatar-icon">
                                                        <i class="anticon anticon-warning"></i>
                                                    </div>
                                                    <div class="m-l-10">
                                                        <p class="m-b-0 text-dark">Product Complain</p>
                                                        <p class="m-b-0"><small><?php echo $result[0] ?> Unseen</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                        // echo $result[0];
                                    ?>
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `order_tracking` JOIN `sold_master` ON `order_tracking`.`sell_master_id` = `sold_master`.`id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `listing_products`.`user_id` = ". $_SESSION['user_id'] ." AND `order_tracking`.`status` = 'Packing';");
                                        $result = mysqli_fetch_array($query);

                                        if($result[0] != 0)
                                        {?> 
                                            <a href="order.php" id="returnReqHeader" class="dropdown-item d-block p-5 border-bottom">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-cyan avatar-icon">
                                                        <i class="anticon anticon-shopping"></i>
                                                    </div>
                                                    <div class="m-l-10">
                                                        <p class="m-b-0 text-dark">New Orders</p>
                                                        <p class="m-b-0"><small><?php echo $result[0]; ?> Orders Pending to be send</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                    ?>
                                    <?php
                                        $query = mysqli_query($con, "SELECT COUNT(*) FROM `return_order` JOIN `sold_master` ON `sold_master`.`id` = `return_order`.`sell_master_id` JOIN `listing_products` ON `listing_products`.`id` = `sold_master`.`product_id` JOIN `user_master` ON `user_master`.`id` = `listing_products`.`user_id` WHERE `user_master`.`id` = ". $_SESSION['user_id'] ." AND `return_order`.`status` = 'Request'");
                                        $result = mysqli_fetch_array($query);

                                        if($result[0] != 0)
                                        {?> 
                                            <a href="order.php" id="returnReqHeader" class="dropdown-item d-block p-5 border-bottom">
                                                <div class="d-flex">
                                                    <div class="avatar avatar-cyan avatar-icon">
                                                        <i class="anticon anticon-frown"></i>
                                                    </div>
                                                    <div class="m-l-10">
                                                        <p class="m-b-0 text-dark">Return Request</p>
                                                        <p class="m-b-0"><small><?php echo $result[0]; ?> Return Product Requests Pending</small></p>
                                                    </div>
                                                </div>
                                            </a>
                                        <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php
                }
                else
                {?>
                    <li class="dropdown dropdown-animated scale-left">
                        <a href="javascript:void(0);" data-toggle="dropdown" id="notifyDropdown">
                            <i class="anticon anticon-bell notification-badge"></i>
                        </a>
                        <div class="dropdown-menu pop-notification"  style="width:500%">
                            <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                                <p class="text-dark font-weight-semibold m-b-0">
                                    <span class="m-l-0"><i class="anticon anticon-bell"></i></span>
                                    <span class="m-l-10">Notifications</span> 
                                </p>
                            </div>
                            <div class="relative">
                                <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                                    <a href="renewPlan.php" class="dropdown-item d-block p-5 border-bottom">
                                        <div class="d-flex">
                                            <div class="avatar avatar-red avatar-icon">
                                                <i class="anticon anticon-exclamation-circle"></i>
                                            </div>
                                            <div class="m-l-10">
                                                <p class="m-b-0 text-danger">Premium Plan Expired</p>
                                                
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                <?php
                }
            ?>
            <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" class="pointer" data-toggle="dropdown">
                
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <?php
                            $query = mysqli_query($con, "select * from user_master where role=1 and id='".$_SESSION['user_id']."'");
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
                                echo"<img  style='align:center' src='../user_profile/".$result['profile_img']."' />";
                            }
                        ?>
                   </div>
                 </a>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                            <?php
                                $query = mysqli_query($con, "select * from user_master where role=1 and id='".$_SESSION['user_id']."'");
                                $result = mysqli_fetch_array($query);
                        
                                if($result['profile_img']==null || $result['profile_img']=="" || !file_exists("../user_profile/".$result['profile_img']))
                                {
                                    if($result['gender']=='male')
                                    {
                                        echo"<img src='../image/male_profile.png' width='20%'>";
                                    }
                                    else
                                    {
                                        echo"<img src='../image/female_profile.png'>";
                                    }
                                }
                                else
                                {
                                    echo"<img ' src='../user_profile/".$result['profile_img']."'  />";
                                }
                            ?>
                                
                            </div>
                            <div class='m-l-10'>
                                <?php 
                                    echo "<p class='m-b-0 text-dark font-weight-bold' style='font-size:123%'>".$_SESSION['name']."</p>"; 
                                ?>
                                <p class='m-b-0 text-dark font-weight-semi' style="font-size:100%">Role:Business</p>
                            </div>
                        
                        </div>
                    </div>

                    <?php
                        if(!$_SESSION['plan_expired'])
                        {?>
                            <a href="update_profile.php" class="dropdown-item d-block p-h-15 p-v-10 txtHover">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                    <i class="anticon anticon-user" style="font-size:150%"></i>
                                        <span class="m-l-10" >Update Profile</span>
                                    </div>
                                    <!-- <i class="anticon font-size-10 anticon-right"></i> -->
                                </div>
                            </a>
                        <?php
                        }
                    ?>
                    <a href="logout.php" class="dropdown-item d-block p-h-15 p-v-10 txtHover">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                            <i class="anticon anticon-logout" style="font-size:150%"></i>   
                            <span class="m-l-10">Logout</span>
                            </div>
                            <!-- <i class="anticon font-size-10 anticon-right"></i> -->
                        </div>
                    </a>
                </div>
            </li>
            <li>
                <a href="javascript:void(0);" data-toggle="modal" data-target="#quick-view">
                     <i class="anticon anticon-setting"></i>
                </a>
            </li>
        </ul>
    </div>
</div>    
           