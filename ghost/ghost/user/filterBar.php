<style>
    /* .btn_styleFilter{
        background-color: whitesmoke;
        padding-left: 15px;
        padding-right: 15px;
    } */
    /* .tbl_main
        { */
            /* box-shadow:4px 4px  12px 1px grey; */
            
            /* box-shadow: inset -10px -10px 15px rgba(255, 255, 255, 0.5), 
           inset 10px 10px 15px rgba(70, 70, 70, 0.12);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: whitesmoke;
            
        } */
</style>
<div class="leftbar p-t-15 btn_styleFilter tbl_main">
    <!--  -->
    <!-- <div class="size-a-21 pos-relative">
        <input class="s-full bo-all-1 bocl15 p-rl-20" type="text" name="search" placeholder="Search products...">
        <button class="flex-c-m fs-18 size-a-22 ab-t-r hov11">
            <img class="hov11-child trans-04" src="images/icons/icon-search.png" alt="ICON">
        </button>
    </div> -->

    <!--  -->
    <div class="p-t-45">
        <h4 class="txt-m-101 cl3">
            FILTER BY PRICE :
        </h4>

        <div class="filter-price p-t-20">
            <div class="wra-filter-bar">
                <!-- <div id="filter-bar"></div> -->
                <select name="price_range" id="price_range" class="form-control">
                    <option value="">-- Select Price Range --</option>
                    <option value="all" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "all")
                            {
                                echo "selected";
                            }
                        }
                    ?>>All Products</option>
                    <option value="1" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "1")
                            {
                                echo "selected";
                            }
                        }
                    ?>>Below &#8377; 100</option>
                    <option value="2" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "2")
                            {
                                echo "selected";
                            }
                        }
                    ?>>&#8377; 101 to &#8377; 300</option>
                    <option value="3" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "3")
                            {
                                echo "selected";
                            }
                        }
                    ?>>&#8377; 301 to &#8377; 500</option>
                    <option value="4" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "4")
                            {
                                echo "selected";
                            }
                        }
                    ?>>&#8377; 501 to &#8377; 1000</option>
                    <option value="5" <?php
                        if(isset($_GET['priceFilter']))
                        {
                            if($_GET['priceFilter'] == "5")
                            {
                                echo "selected";
                            }
                        }
                    ?>>Above &#8377; 1001</option>
                </select>
            </div>

            <div class="flex-sb-m flex-w p-t-16">
                <!-- <div class="txt-s-115 cl9 p-t-10 p-b-10 m-r-20">
                    Price: &#8377; <span id="value-lower">1</span> - &#8377; <span id="value-upper"><?php
                        $rangeQuery = mysqli_query($con, "select max(price) from listing_products");
                        $range = mysqli_fetch_array($rangeQuery);
                        echo round($range[0]);
                    ?></span>
                </div> -->

                <!-- <div>
                    <button title="Click to filter products" id="priceFilterBtn" class="txt-s-107 cl6 hov-cl10 trans-04">
                        Filter
                    </button>
                </div> -->
            </div>
        </div>
    </div>
        
    <!--  -->
    <div class="p-t-40">
        <h4 class="txt-m-101 cl3 p-b-20">
            Categories :
        </h4>

        <ul>
            <li class='p-b-5'>
                <a href="shop.php" class='flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3' <?php
                    if(!isset($_GET['id']))
                    {
                        echo "style=color:red;";
                    }
                ?>>
                    <span class='m-r-10'>All Products</span>
                    <span><?php
                        $allProductQuery = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `listing_products`.`user_id` NOT IN (SELECT `user_master`.`id` FROM `user_master` WHERE DATEDIFF(`user_master`.`expiary_date`, NOW()) < 0) AND `listing_products`.`product_status` = 'Active';");
                        $allProductCount = mysqli_fetch_array($allProductQuery);

                        echo $allProductCount[0];
                    ?></span>
                </a>
            </li>
            <?php
                $categoryWiseQuery = mysqli_query($con, "select * from  category_master");
                while($categoryWiseResult = mysqli_fetch_array($categoryWiseQuery))
                {
                    echo "<li class='p-b-5'>";

                    if(isset($_GET['id']))
                    {
                        if($_GET['id'] == $categoryWiseResult['id'])
                        {
                            echo "<a href='specificCategory.php?id=". $categoryWiseResult['id'] ."' class='flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3' style='color:red;'><span class='m-r-10'>". $categoryWiseResult['name'] ."</span>";
                        }
                        else
                        {
                            echo "<a href='specificCategory.php?id=". $categoryWiseResult['id'] ."' class='flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3'><span class='m-r-10'>". $categoryWiseResult['name'] ."</span>";
                        }
                    }
                    else
                    {
                        echo "<a href='specificCategory.php?id=". $categoryWiseResult['id'] ."' class='flex-sb-m flex-w txt-s-101 cl6 hov-cl10 trans-04 p-tb-3'><span class='m-r-10'>". $categoryWiseResult['name'] ."</span>";
                    }

                    $tempoQuery = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE `listing_products`.`user_id` NOT IN (SELECT `user_master`.`id` FROM `user_master` WHERE DATEDIFF(`user_master`.`expiary_date`, NOW()) < 0) AND `listing_products`.`product_status` = 'Active' AND `listing_products`.`catagory_id` = ". $categoryWiseResult['id'] .";");
                    $tempoRe = mysqli_fetch_array($tempoQuery);

                    echo "<span>". $tempoRe[0] ."</span></a>";

                    echo "</li>";	
                }
            ?>
        </ul>
    </div>

    <!--  -->
    <div class="p-t-40">
        <h4 class="txt-m-101 cl3 p-b-20">
            Products :
        </h4>
         <ul>
            <li class="flex-w flex-sb-t p-b-30">
                <div class=" flex-col-l p-t-12">
                    <a class="txt-m-103 cl3 trans-04 p-b-12">
                        New Products
                    </a>

                    <!-- <span class="txt-m-104 cl9"> -->
                        <select name="businessCategory" id="businessCategory" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="all"><a href="businessProducts.php">All Products</a></option>
                            <?php
                                $query = mysqli_query($con, "select * from category_master");
                                while($row = mysqli_fetch_array($query))
                                {?>
                                    <option value="<?php echo $row['id'] ?>"><a href="businessProducts.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></option>
                                <?php
                                }
                            ?>
                        </select>
                    <!-- </span> -->
                </div>
            </li>

            <li class="flex-w flex-sb-t p-b-30">
                <div class=" flex-col-l p-t-12">
                    <a class="txt-m-103 cl3 trans-04 p-b-12">
                        Second Hand Products
                    </a>

                    <!-- <span class="txt-m-104 cl9"> -->
                        <select name="businessCategory" id="customerCategory" class="form-control">
                            <option value="">-- Select --</option>
                            <option value="all"><a href="customerProducts.php">All Products</a></option>
                            <?php
                                $query = mysqli_query($con, "select * from category_master");
                                while($row = mysqli_fetch_array($query))
                                {?>
                                    <option value="<?php echo $row['id'] ?>"><a href="customerProducts.php?id=<?php echo $row['id'] ?>"><?php echo $row['name'] ?></a></option>
                                <?php
                                }
                            ?>
                        </select>
                    <!-- </span> -->
                </div>
            </li>

            <!-- <li class="flex-w flex-sb-t p-b-30">
                <a href="#" class="size-w-50 wrap-pic-w bo-all-1 bocl12 hov8 trans-04">
                    <img src="images/best-sell-03.jpg" alt="IMG">
                </a>

                <div class="size-w-51 flex-col-l p-t-12">
                    <a href="#" class="txt-m-103 cl3 hov-cl10 trans-04 p-b-12">
                        Eggplant
                    </a>

                    <span class="txt-m-104 cl9">
                        18$
                    </span>
                </div>
            </li> -->

            <!-- <li class="flex-w flex-sb-t p-b-30">
                <a href="#" class="size-w-50 wrap-pic-w bo-all-1 bocl12 hov8 trans-04">
                    <img src="images/best-sell-04.jpg" alt="IMG">
                </a>

                <div class="size-w-51 flex-col-l p-t-12">
                    <a href="#" class="txt-m-103 cl3 hov-cl10 trans-04 p-b-12">
                        Carrot
                    </a>

                    <span class="txt-m-104 cl9">
                        17$
                    </span>
                </div>
            </li> -->
        </ul>
    </div>
</div>