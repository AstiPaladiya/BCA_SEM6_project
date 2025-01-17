<style>
    .goog-te-banner-frame.skiptranslate {
        display: none !important;
        }
    body {
        top: 0px !important;
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
            <li class="dropdown dropdown-animated scale-left">
                <!-- <a href="javascript:void(0);" data-toggle="dropdown">
                    <i class="anticon anticon-bell notification-badge"></i>
                </a> -->
                <div class="dropdown-menu pop-notification"  style="width:500%">
                    <div class="p-v-15 p-h-25 border-bottom d-flex justify-content-between align-items-center">
                        <!-- <p class="text-dark font-weight-semibold m-b-0">
                            <span class="m-l-0"><i class="anticon anticon-bell"></i>Notification</span>
                            <span class="m-l-10">Notification</span> 
                        </p> -->
                    </div>
                    <div class="relative">
                        <div class="overflow-y-auto relative scrollable" style="max-height: 300px">
                            <a href="javascript:void(0);" class="dropdown-item d-block p-5 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-blue avatar-icon">
                                        <i class="anticon anticon-user-add"></i>
                                    </div>
                                    <div class="m-l-10">
                                        <p class="m-b-0 text-dark">User Complain</p>
                                        <!-- <p class="m-b-0"><small>8 min ago</small></p> -->
                                    </div>
                                </div>
                            </a>
                            <a href="javascript:void(0);" class="dropdown-item d-block p-5 border-bottom">
                                <div class="d-flex">
                                    <div class="avatar avatar-cyan avatar-icon">
                                        <i class="anticon anticon-shopping"></i>
                                    </div>
                                    <div class="m-l-10">
                                        <p class="m-b-0 text-dark">Product Complain</p>
                                        <!-- <p class="m-b-0"><small>7 hours ago</small></p> -->
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </li>
            <li class="dropdown dropdown-animated scale-left">
                <a href="javascript:void(0);" class="pointer" data-toggle="dropdown">
                
                    <div class="avatar avatar-image  m-h-10 m-r-15">
                        <?php 
                             if($_SESSION['admin']=="Deep Ganatra")
                             {
                                echo "<img src='../image/male_profile.png' alt='Profile' width='20%' height='20%'/>";
                              
                            }
                            else
                            {
                                echo "<img src='../image/female_profile.png' alt='Profile' width='20%' height='20%'>";
                               
                            }
                        ?>
                    </div>
                 </a>
                <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                    <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                        <div class="d-flex m-r-50">
                            <div class="avatar avatar-lg avatar-image">
                                <?php 
                                    if($_SESSION['admin']=="Deep Ganatra")
                                    {
                                        echo "<img src='../image/male_profile.png' alt='Profile'/>";
                                       
                                    }
                                    else
                                    {
                                        echo "<img src='../image/female_profile.png' alt='Profile' />";
                                        
                                    }
                                ?>
                                
                            </div>
                            <div class='m-l-10'>
                                <?php 
                                    echo "<p class='m-b-0 text-dark font-weight-bold' style='font-size:123%'>".$_SESSION['admin']."</p>"; 
                                ?>
                                <p class='m-b-0 text-dark font-weight-semi' style="font-size:100%">Role:Admin</p>
                            </div>
                        
                        </div>
                    </div>
                    <!-- <a href="javascript:void(0);" class="dropdown-item d-block p-h-15 p-v-10 txtHover">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                               <i class="anticon anticon-bell notification-badge" style="font-size:150%"></i>
                                <span class="m-l-10 ">Notification</span>
                            </div>
                            <i class="anticon font-size-10 anticon-right"></i>
                        </div>
                    </a> -->
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
           