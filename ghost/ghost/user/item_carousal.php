<div class="row">
		<div class="MultiCarousel" id="categoryAll" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="1000">
            <div class="MultiCarousel-inner">
                <!-- <div class="item">
                    <div class="pad15">

                        <p><img src="../image/ghost2.png" width="100%" class="rounded-circle"/></p>
                        <p class="lead">Multi Item Carousel</p> -->
                        <!-- <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p> 
                    </div>
                </div> -->
                <?php 
                    $query=mysqli_query($con,"select * from category_master");
                    while($row=mysqli_fetch_array($query))
                    {
                        echo "<a href='specificCategory.php?id=". $row['id'] ."'><div class='item'>";
                        echo "<div class='pad15'>";
                        echo "<p><img src='../image/category_images/". $row['icon'] ."' width='50%' class='rounded-circle'/></p>";
                        echo "<p class='lead' style='color:black;font-weight:bold;'>".$row['name']."</p>";
                        echo "</div>";
                        echo "</div></a>";
                    }
                ?>
                <!-- <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>
                <div class="item">
                    <div class="pad15">
                        <p class="lead">Multi Item Carousel</p>
                        <p>₹ 1</p>
                        <p>₹ 6000</p>
                        <p>50% off</p>
                    </div>
                </div>-->
            </div>
            <button class="btn btn-primary leftLst"><</button>
            <button class="btn btn-primary rightLst">></button>
        </div>
	</div>
	<!-- <div class="row">
	    <div class="col-md-12 text-center">
	        <br/><br/><br/>
	        <hr/>
	        <p>Settings</p>
	        <p>Change data items for xs,sm,md and lg display items respectively. Ex:data-items="1,3,5,6"</p>
	        <p>Change data slide for slides per click Ex:data-slide="1"</p>
	    </div> -->
	</div>