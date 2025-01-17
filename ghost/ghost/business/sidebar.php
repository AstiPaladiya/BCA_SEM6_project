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
            <?php
                if(!$_SESSION['plan_expired'])
                {?>
                    <li class="nav-item dropdown">
                        <div  class="ml-2" style="font-size:150%;font-weight:600;">Pages</div>
                        <a class="dropdown-toggle  txtHover" href="marketer.php"  <?php if($page == "Marketer"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <span class="icon-holder">
                            <i class="anticon anticon-user"></i>
                            </span>
                            <span class="title">Marketer</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle  txtHover" href="product.php" <?php if($page == "Products"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <span class="icon-holder">
                            <i class="anticon anticon-appstore"></i>
                            </span>
                            <span class="title">Product</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="dropdown-toggle  txtHover" href="order.php" <?php if($page == "Orders"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <span class="icon-holder">
                                <i class="anticon anticon-shopping"></i>
                            </span>
                            <span class="title">Order</span>
                        </a>
                    </li>
                <?php
                }
                else
                {?>
                    <li class="nav-item dropdown">
                        <div class="ml-2" style="font-size:150%;font-weight:600;">Pages</div>
                        <a class="dropdown-toggle  txtHover" href="order.php" <?php if($page == "Orders"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <span class="icon-holder">
                                <i class="anticon anticon-shopping"></i>
                            </span>
                            <span class="title">Order</span>
                        </a>
                    </li>
                <?php
                }
            ?>
            <!-- <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="subscriptionplan.php">
                    <span class="icon-holder">
                        <i style="color:grey"><link type="image/png" sizes="16x16" rel="icon" href=".../icons8-subscription-16.png"></i>
                    </span>
                    <span class="title">Subscription Plan</span>
                </a>
            </li> -->
            <li class="nav-item dropdown">
                <?php
                    if($_SESSION['plan_expired'])
                    {?><div class="ml-2" style="font-size:150%;font-weight:600;">MANAGEMENT</div>
                        <a class="dropdown-toggle  txtHover" href="renewPlan.php" <?php if($page == "Renew"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>> 
                            <div>
                                <span class="icon-holder">
                                    <i class="anticon anticon-exclamation-circle"></i>
                                </span>
                                <span class="title">Renew Your Plan</span>
                            </div>
                        </a>
                    <?php
                    }
                    else
                    {?>
                        <div class="ml-2" style="font-size:150%;font-weight:600;">MANAGEMENT</div>
                        <a class="dropdown-toggle  txtHover" href="complaint.php" <?php if($page == "Complaint"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <div>
                                <span class="icon-holder">
                                    <i class="anticon anticon-exclamation-circle"></i>
                                </span>
                                <span class="title">Complain</span>
                            </div>
                        </a>
                    <?php
                    }
                ?>
                
            </li>

            <?php
                if(!$_SESSION['plan_expired'])
                {?>
                    <li class="nav-item dropdown">
                    <div class="ml-2" style="font-size:150%;font-weight:600;">REPORT</div>
                        <a class="dropdown-toggle  txtHover" href="javascript:void(0);" <?php if($page == "Delivered Order Chart" || $page == "Return Order Chart" || $page == "Listed Product Chart" || $page == "Sold Product Chart" || $page == "Marketer Chart" || $page == "Revenue Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                            <div>
                                <span class="icon-holder">
                                    <i class="anticon anticon-bar-chart"></i>
                                </span>
                                <span class="title">Chart</span>
                                <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                        <li class="nav-item dropdown">
                                <a href="javascript:void(0);">
                                    <span>Order</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="txtHover" <?php if($page == "Delivered Order Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                        <a href="delivered_order.php">Delivered Order</a>
                                    </li>
                                    <li class=" txtHover" <?php if($page == "Return Order Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                        <a href="return_order.php">Return Order</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown">
                                <a href="javascript:void(0);" >
                                    <span>Product</span>
                                    <span class="arrow">
                                        <i class="arrow-icon"></i>
                                    </span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class=" txtHover" <?php if($page == "Listed Product Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                        <a href="listed_product_chart.php">Listed Product</a>
                                    </li>
                                    <li class=" txtHover" <?php if($page == "Sold Product Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                        <a href="sold_product_chart.php">Sold Product</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item dropdown  txtHover" <?php if($page == "Marketer Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="marketer_chart.php">
                                    <span>Marketer</span>
                                    <span class="arrow">
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item dropdown  txtHover" <?php if($page == "Revenue Chart"){echo "style=' background-color:rgba(255, 99, 71, 0.3);color:red;border-right:2px solid red;'";} ?>>
                                <a href="revenue_business_chart.php">
                                    <span>Revenue</span>
                                    <span class="arrow">
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php
                }
            ?>
        </ul>
  
    </div>
</div>