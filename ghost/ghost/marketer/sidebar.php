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
                <a class="dropdown-toggle txtHover" href="index.php" <?php if($page == "Index"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-home"></i>
                    </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
            <div class="ml-2" style="font-size:150%;font-weight:600;">PAGES</div>
                <a class="dropdown-toggle txtHover" href="products.php" <?php if($page == "viewProduct"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                    <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Product</span>
                </a>
                <!-- <ul class="dropdown-menu">
                    <li>
                        <a href="visitoruser.php">Visting User</a>
                    </li>
                    <li>
                        <a href="registerd_user.php">Registered User</a>
                    </li>
                    <li>
                        <a href="business_users.php">Business User</a>
                    </li>
                </ul> -->
            </li>
            <!-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="category.php">
                    <span class="icon-holder">
                      <i class="anticon anticon-appstore"></i>
                    </span>
                    <span class="title">Catagory</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="products.php">
                    <span class="icon-holder">
                        <i class="anticon anticon-shopping"></i>
                    </span>
                    <span class="title">Products</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="subscriptionplan.php">
                    <span class="icon-holder">
                        <i class="far fa-money-bill-alt"></i>
                    </span>
                    <span class="title">Subscription Plan</span>
                </a>
            </li> -->
            <!-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                    <h3>MANAGEMENT</h3> 
                    <span class="icon-holder">
                        <i class="anticon anticon-exclamation-circle"></i>
                    </span>
                    <span class="title">Complain</span>
                    <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="form-elements.html">User</a>
                    </li>
                    <li>
                        <a href="form-layouts.html">Product</a>
                    </li>
                    <li>
                        <a href="form-validation.html">Website</a>
                    </li>
                </ul>
            </li> -->
            <li class="nav-item dropdown">
            <div class="ml-2" style="font-size:150%;font-weight:600;">REPORT</div>
                <a class="dropdown-toggle txtHover" href="revenue.php" <?php if($page == "rev"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                    <span class="icon-holder">
                        <i class="anticon anticon-bar-chart"></i>
                    </span>
                    <span class="title">Revenue Report</span>
                    <!-- <span class="arrow">
                        <i class="arrow-icon"></i>
                    </span> -->
                </a>
                <!-- <ul class="dropdown-menu">
                <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>User</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="visiting_user_chart.php">Visting User</a>
                            </li>
                            <li>
                                <a href="registered_user_chart.php">Registered User</a>
                            </li>
                            <li>
                                <a href="business_user_chart.php">Bussiness User</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="javascript:void(0);">
                            <span>Product</span>
                            <span class="arrow">
                                <i class="arrow-icon"></i>
                            </span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="listed_product_chart.php">Listed Product</a>
                            </li>
                            <li>
                                <a href="sold_product_chart.php">Sold Product</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="revenue_chart.php">
                            <span>Revenue</span>
                            <span class="arrow">
                            </span>
                        </a>
                    </li>
                </ul> -->
            </li>
        </ul>
  
    </div>
</div>