<style>
.txtHover:hover{
            background-color:rgba(255, 99, 71, 0.3);
            color:red;
            border-right:2px solid red;
        }
</style>
<div class="side-nav xyz">
    <div class="side-nav-inner">
        
        <ul class="side-nav-menu scrollable">
        <div class="ml-2" style="font-size:150%;font-weight:600;">MAIN</div>
            <li class="nav-item dropdown open">
                 <a class="dropdown-toggle txtHover" href="index.php" <?php if($page=="Main"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>> 
                        <span class="icon-holder">
                            <i class="anticon anticon-home"></i>
                        </span>
                        <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <div class="ml-2" style="font-size:150%;font-weight:600;">PAGES</div> 
                <a class="dropdown-toggle txtHover" href="javascript:void(0);" <?php if($page == "visiterUser" || $page == "Register User" || $page == "Buss User"){echo " style='background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-team"></i>
                    </span>
                    <span class="title">User</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="txtHover" <?php if($page == "visiterUser"){echo " style='background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="visitoruser.php">Visting User</a>
                    </li>
                    <li class="txtHover" <?php if($page == "Register User"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="registerd_user.php">Registered User</a>
                    </li>
                    <li class="txtHover" <?php if($page == "Buss User"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="business_users.php">Business User</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle txtHover" href="category.php"  <?php if($page == "category"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                      <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Category</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle txtHover" href="products.php"  <?php if($page == "product"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping"></i>
                    </span>
                    <span class="title">Product</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle txtHover" href="subscriptionplan.php"  <?php if($page == "subscription"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <!-- <i class="far fa-money-bill-alt"></i> -->
                        <i class="anticon anticon-dollar"></i>
                    </span>
                    <span class="title">Subscription Plan</span>
                </a>
            </li>
            <li class="nav-item dropdown">
            <div class="ml-2" style="font-size:150%;font-weight:600;">MANAGEMENT</div> 
                <a class="dropdown-toggle txtHover" href="javascript:void(0); "  <?php if($page == "Comuser" || $page == "Comprod" || $page == "Comweb"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-exclamation-circle"></i>
                    </span>
                    <span class="title">Complain</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li class="txtHover" <?php if($page == "Comuser"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="userComplaint.php"  >User</a>
                    </li>
                    <li class="txtHover" <?php if($page == "Comprod"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="productComplaint.php">Product</a>
                    </li>
                    <li class="txtHover"  <?php if($page == "Comweb"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="websiteComplaint.php">Website</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
            <div class="ml-2" style="font-size:150%;font-weight:600;">REPORT</div>
                <a class="dropdown-toggle txtHover" href="javascript:void(0); "   <?php if($page == "Chartuser" || $page == "Chartreguser" || $page == "Chartbususer" || $page == "Chartprod" || $page == "Chartsoldprod" || $page == "rev"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-bar-chart"></i>
                    </span>
                    <span class="title" >Chart</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>User</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="txtHover" <?php if($page == "Chartuser"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="visiting_user_chart.php">Visting User</a>
                            </li>
                            <li class="txtHover" <?php if($page == "Chartreguser"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="registered_user_chart.php">Registered User</a>
                            </li>
                            <li class="txtHover" <?php if($page == "Chartbususer"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="business_user_chart.php">Bussiness User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown ">
                        <a   href="javascript:void(0);">
                            <span>Product</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="txtHover"  <?php if($page == "Chartprod"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="listed_product_chart.php">Listed Product</a>
                            </li>
                            <li  class="txtHover" <?php if($page == "Chartsoldprod"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="sold_product_chart.php">Sold Product</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown txtHover"   <?php if($page == "rev"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                        <a href="revenue_chart.php">
                            <span>Revenue</span>
                            <span class="arrow">
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
  
    </div>
</div>