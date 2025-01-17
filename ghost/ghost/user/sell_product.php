<?php
	session_start();
    include("../connection.php");
    if(!isset($_SESSION["front_user_id"]))
    {
        header("Location:../user_login.php");
    }

    $page = "Sell_Product";
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
    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<style>
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
.lbl
{
 font-family:Verdana, Geneva, Tahoma, sans-serif;
  font-size:15px;
  color:#666;
  font-weight:300;
  /* text-transform:uppercase; */
  /* line-height: 1.6; */
}
.heading{
	font-family: Lato-Black;
	font-size: 25px;
	line-height: 1.2;
	text-transform: uppercase;
}
.inpt
{
	border-radius:2px;
	border-color:#666;
	font-size:14px;
	font-weight:200;
	color:#666;
}

/* CSS */
.btnSub {
  background:dodgerblue;
  border: 1px solid dodgerblue;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
  font-size: 16px;
  font-weight: 800;
  line-height: 16px;
  min-height: 40px;
  outline: 0;
  padding: 17px 40px;
  text-align: center;
  text-rendering: geometricprecision;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;
}

.btnSub:hover,
.btnSub:active {
  background-color: initial;
  background-position: 0 0;
  color: dodgerblue;
}

.btnSub:active {
  opacity: .5;
}
.btnRes{
	background:crimson;
  border: 1px solid crimson;
  border-radius: 6px;
  box-shadow: rgba(0, 0, 0, 0.1) 1px 2px 4px;
  box-sizing: border-box;
  color: #FFFFFF;
  cursor: pointer;
  display: inline-block;
  font-family: nunito,roboto,proxima-nova,"proxima nova",sans-serif;
  font-size: 16px;
  font-weight: 800;
  line-height: 16px;
  min-height: 40px;
  outline: 0;
  padding: 17px 40px;
  text-align: center;
  text-rendering: geometricprecision;
  text-transform: none;
  user-select: none;
  -webkit-user-select: none;
  touch-action: manipulation;
  vertical-align: middle;	
}
.btnRes:active {
  opacity: .5;
}
.btnRes:hover,
.btnRes:active {
  background-color: initial;
  background-position: 0 0;
  color:crimson;
}
.btnSub:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.btnRes:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24),0 17px 50px 0 rgba(0,0,0,0.19);
}
.setStyle
{
	padding-right:20%;
}
/* @media (max-width : 411px){
  .setStyle{
    padding-right:0%;
	padding-bottom:100px;
  }
} */
th
{
	font-size:18px;
}
td
{
	font-size:14px;
}
.editcategory:hover{
	cursor : pointer;
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
.btn_closestyle:hover{
    background-color: rgba(197, 239, 247,1);
    color:rgba(68, 108, 240,1);
    font-weight:500;
    border:0px;

}
.btn_styledange:hover{
    color:red;
    border:0px;
    font-weight:500;
    background-color: rgba(160,0,0,0.2); 
}
.btn_styleprime:hover{
    background-color: rgba(0,160,0,0.2);
    color:rgba(0, 160, 110, 1);
    font-weight:500;
    border:0px;
}
.btn_edit{
    font-size: 18px;
}


</style>
</head>
<body class="animsition">
    <!-- Header start -->
        <?php include("navbar.php"); ?>
    <!-- Header end -->

	<!-- Main ccontent start -->
	<div class="bg0 p-t-95 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-7 col-lg-8 p-b-50">
					<div id="sellProductForm" <?php
                        if(!$_SESSION['front_user_premium'])
                        {
                            $query = mysqli_query($con, "SELECT COUNT(*) FROM `listing_products` WHERE MONTH(`created_at`) = MONTH(NOW()) AND `user_id` = ". $_SESSION['front_user_id'] .";");
                            $result = mysqli_fetch_array($query);

                            if($result[0] >= 3)
                            {
                                echo "hidden";
                            }
                        }
                    ?>>
						<div class="cl3 p-b-28 heading">
							Product Details :
						</div>
					<form method="post" id="user_product" enctype="multipart/form-data">
						<div class="row p-b-50">
							<div class="col-sm-6 p-b-23">
								<div>
									<div class=" cl6 p-b-10 lbl">
										Catagory:<span class="cl12"></span>
									</div>

									<select class="cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 inpt" type="text" id="txtCat" name="txtCat">
											<option value="">-- Select Catagory --</option>
										<?php
											$query=mysqli_query($con,"select * from category_master");
											
											while($row=mysqli_fetch_array($query))
											{
												echo"<option value=".$row['id'].">".$row['name']."</option>";
											}
										?>
									</select>
								</div>
							</div>

							<!-- <div class="col-sm-6 p-b-23">
								<div>
									<div class="txt-s-101 cl6 p-b-10">
										Last Name <span class="cl12">*</span>
									</div>

									<input class="txt-s-120 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1" type="text" name="last-name">
								</div>
							</div> -->

							<div class="col-12 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Product Name:
									</div>

									<input class="cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 inpt" type="text" id="txtName" name="txtName" />
								</div>
							</div>

							<div class="col-12 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Product Description :<span class="cl12"></span>
									</div>
									
									<textarea class="plh2 cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 inpt p-rl-20 focus1 m-b-20" style="height:90px;" type="text" id="txtDes" name="txtDes"></textarea>
								</div>
							</div>
							<div class="col-12 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Price:<span class="cl12"></span>
									</div>

									<input class="cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1 inpt p-rl-20 focus1" type="number" id="txtPrice" name="txtPrice" />
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Image1: <span class="cl12"></span>
									</div>

									<input class="cl3 size-a-21 bo-all-1 bocl15 inpt p-rl-20 focus1"  accept="image/*"  type="file" id="img1" name="img1"/>
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Image2: <span class="cl12">*</span>
									</div>

									<input class="cl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1"  accept="image/*" disabled type="file" id="img2" name="img2"/>
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Image3: <span class="cl12">*</span>
									</div>

									<input class=" cl3 size-a-21 bo-all-1 bocl15 inpt p-rl-20 focus1"  accept="image/*" disabled type="file" id="img3" name="img3"/>
								</div>
							</div>

							<div class="col-sm-6 p-b-23">
								<div>
									<div class="cl6 p-b-10 lbl">
										Image4: <span class="cl12">*</span>
									</div>

									<input class="cxl3 size-a-21 bo-all-1 bocl15 p-rl-20 focus1"  accept="image/*" disabled type="file" id="img4" name="img4"/>
								</div>
							</div>
						</div>

						<h4 class="txt-m-124 cl3 p-b-19">
							<span class="setStyle" ><button type="submit" class="btnSub" id="btnSubmit" name="btnSubmit">Submit</button></span>
							<button class="btnRes" type="reset" id="btnReset" name="btnReset">Reset</button>
						</h4>
					</form>
					</div>
				</div>
					<!-- Insert Product Code start -->
					<?php
                            if(isset($_POST['btnSubmit']))
                            {
                         
                                move_uploaded_file($_FILES['img1']['tmp_name'],"../product_image/" . $_FILES['img1']['name']);

                                if(isset($_FILES['img2']))
                                {
                                    if($_FILES['img2']['name'] != "" && $_FILES['img2']['name'] != null)
                                    {
                                        move_uploaded_file($_FILES['img2']['tmp_name'],"../product_image/" . $_FILES['img2']['name']);
                                        $img2 = $_FILES['img2']['name'];
                                    }
                                }
                                if(isset($_FILES['img3']))
                                {
                                    if(($_FILES['img3']['name'] != "" && $_FILES['img3']['name'] != null))
                                    {
                                        move_uploaded_file($_FILES['img3']['tmp_name'],"../product_image/" . $_FILES['img3']['name']);
                                        $img3 = $_FILES['img3']['name'];
                                    }
                                }
                                if(isset($_FILES['img4']))
                                {
                                    if($_FILES['img4']['name'] != "" && $_FILES['img4']['name'] != null)
                                    {
                                        move_uploaded_file($_FILES['img4']['tmp_name'],"../product_image/" . $_FILES['img4']['name']);
                                        $img4 = $_FILES['img4']['name'];
                                    }
                                }
                                $cat = $_POST['txtCat'];
                                $name = $_POST['txtName'];
                                $des = $_POST['txtDes'];
                                $price = $_POST['txtPrice'];
                                $img1 = $_FILES['img1']['name'];
                                
                                if(!isset($img2))
                                {
                                    $img2 = null;
                                }
                                if(!isset($img3))
                                {
                                    $img3 = null;
                                }
                                if(!isset($img4))
                                {
                                    $img4 = null;
                                }

                                $query = mysqli_query($con, "insert into listing_products(user_id,catagory_id,product_name,product_description,price,img1,img2,img3,img4,sell_status,product_status) values (".$_SESSION["front_user_id"].",".$cat.",'".$name."','".$des."',".$price.",'".$img1."','".$img2."','".$img3."','".$img4."','Unsold','Active')");
                                echo "<script>window.location.replace('sell_product.php');</script>";
                            }
                        ?>
					<!-- Insert Product code end -->
						 <!-- Update Product Detail -->
						 <div class="modal fade" id="UpdateProduct" status="dialog" style="padding-top:5%;">
                            <div class="modal-dialog">
                                <div class="modal-content   justify-content-center ">
                                    <div class="modal-header  justify-content-center">
                                            <div class="modal-title" id="labelDetail" style="font-size:24px;font-weight:bold;" >Update Product Detail</div>
                                            
                                    </div>
                                    
                                    <form  method="post" id="updateForm" enctype="multipart/form-data">
                                        <div class="modal-body " id="editFrm">
                                        
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnUpdate" name="btnUpdateProduct" class="btn btn-primary btn_closestyle">Save changes</button>
                                            <button type="button" class="btn btn-dark btn-tone" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                       <!-- Update Product PHP Code Starts -->
                        <?php
                            if(isset($_POST['btnUpdateProduct']))
                            {
                                $product_id = $_POST['pid'];
                                $desc_upd = $_POST['txtDesUpd'];
                                $price_upd = $_POST['txtPriceUpd'];
                                $imgUpd1 = null;
                                $imgUpd2 = null;
                                $imgUpd3 = null;
                                $imgUpd4 = null;
                                if(isset($_POST['delete_img2']))
                                {
                                    $query = mysqli_query($con, "select img2, img3, img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img2']))
                                    {
                                        unlink("../product_image/" . $result['img2']);
                                    }
                                    if(file_exists("../product_image/" . $result['img3']))
                                    {
                                        unlink("../product_image/" . $result['img3']);
                                    }
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img2 = NULL, img3 = NULL, img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                else if(isset($_POST['delete_img3']))
                                {
                                    $query = mysqli_query($con, "select img3, img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img3']))
                                    {
                                        unlink("../product_image/" . $result['img3']);
                                    }
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img3 = NULL, img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                else if(isset($_POST['delete_img4']))
                                {
                                    $query = mysqli_query($con, "select img4 from listing_products where id = " . $_POST['pid'] . "");
                                    $result = mysqli_fetch_array($query);
                                    if(file_exists("../product_image/" . $result['img4']))
                                    {
                                        unlink("../product_image/" . $result['img4']);
                                    }
                                    $query = mysqli_query($con, "update listing_products set img4 = NULL where id = " . $_POST['pid'] . "");
                                }
                                $query = mysqli_query($con, "select img1, img2, img3, img4 from listing_products where id = ". $_POST['pid'] ."");
                                $oldimages = mysqli_fetch_array($query);
                                if($_FILES['img1Upd']['name'] != "" && $_FILES['img1Upd']['name'])
                                {
                                    $imgUpd1 = $_FILES['img1Upd'];
                                }
                                if($_FILES['img2Upd']['name'] != "" && $_FILES['img2Upd']['name'])
                                {
                                    $imgUpd2 = $_FILES['img2Upd'];
                                }
                                if($_FILES['img3Upd']['name'] != "" && $_FILES['img3Upd']['name'])
                                {
                                    $imgUpd3 = $_FILES['img3Upd'];
                                }
                                if($_FILES['img4Upd']['name'] != "" && $_FILES['img4Upd']['name'])
                                {
                                    $imgUpd4 = $_FILES['img4Upd'];
                                }
                                $upd_query = "product_description = '". $_POST['txtDesUpd'] ."', price = ". $_POST['txtPriceUpd'] ."";
                                if($imgUpd1 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img1']))
                                    {
                                        unlink("../product_image/" . $oldimages['img1']);
                                    }
                                    move_uploaded_file($_FILES['img1Upd']['tmp_name'], "../product_image/" . $_FILES['img1Upd']['name']);
                                    $upd_query .= ", img1 = '". $_FILES['img1Upd']['name'] ."'";
                                }
                                if($imgUpd2 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img2']))
                                    {
                                        unlink("../product_image/" . $oldimages['img2']);
                                    }
                                    move_uploaded_file($_FILES['img2Upd']['tmp_name'], "../product_image/" . $_FILES['img2Upd']['name']);
                                    $upd_query .= ", img2 = '". $_FILES['img2Upd']['name'] ."'";
                                }
                                if($imgUpd3 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img3']))
                                    {
                                        unlink("../product_image/" . $oldimages['img3']);
                                    }
                                    move_uploaded_file($_FILES['img3Upd']['tmp_name'], "../product_image/" . $_FILES['img3Upd']['name']);
                                    $upd_query .= ", img3 = '". $_FILES['img3Upd']['name'] ."'";
                                }
                                if($imgUpd4 != null)
                                {
                                    if(file_exists("../product_image/" . $oldimages['img4']))
                                    {
                                        unlink("../product_image/" . $oldimages['img4']);
                                    }
                                    move_uploaded_file($_FILES['img4Upd']['tmp_name'], "../product_image/" . $_FILES['img4Upd']['name']);
                                    $upd_query .= ", img4 = '". $_FILES['img4Upd']['name'] ."'";
                                }
                                $query = mysqli_query($con, "update listing_products set $upd_query where id = $product_id");
                                if($query != 0)
                                {
                                    echo "<script>window.location.replace('sell_product.php');</script>";
                                }
                            }
                        ?>
                        <!-- Update Product PHP Code Ends -->
				
						 <!-- View More Product Detail -->
						 <div class="modal fade" id="ViewMore" status="dialog" style="padding-top:5%;">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content  justify-content-center">
                                <div class="modal-header  justify-content-center">
                                        <div class="modal-title" id="labelDetail" style="font-size:170%;font-weight:bold;" >View More Product Detail</div>
                                        
                                </div>
                                <div class="modal-body">
                                    <div id="detailTable">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
			    <div>
            </div>
            
		</div>
        <div class="tbl_main table-responsive">
                <table id="tblPlan" class="table hover">
                            <thead ad class="thead-dark">
                               <tr>
                                    <th>Catagory Name</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Image1</th>
                                    <th>Update</th>
                                    <th>Sell Status</th>
                                    <th>Product Status</th>
                                    <th>View More</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $query = mysqli_query($con, "select * from listing_products where user_id=" . $_SESSION['front_user_id'] . "");

                                    while($row=mysqli_fetch_array($query))
                                    {
                                        $query_getcategory=mysqli_query($con,"select name from category_master where id=".$row['catagory_id']."");
                                        $name = mysqli_fetch_array($query_getcategory);
                                        echo "<tr>";
                                        echo "<td>".$name['name']."</td>";
                                         echo "<td>" . $row['product_name'] . "</td>";
                                        //echo "<td>" . $row['product_description'] . "</td>";
                                        echo "<td>". $row['price'] ."</td>";
                                        echo "<td><img src='../product_image/" . $row['img1'] . "' width='30%' class='rounded' width='200px'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img2'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img3'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        // echo "<td><img src='../product_image/" . $row['img4'] . "' class='rounded' width='100%' height='100%'/></td>";
                                        echo "<td><button type='button' data-target='#UpdateProduct'  class='editcategory btn btn-primary btn-tone' style='width:60px;height:45px' data-toggle='modal'  data-id='".$row['id']."'/><i class=' anticon anticon-edit btn_edit' title='Edit'></i></button></td>";

                                        if($row['sell_status']=='Unsold')
                                        {
                                            echo "<td><button type='button' id='btnUnsold' name='btnUnsold' data-id='" . $row['id'] . "' class='btn btn-success btn_styleprime UnSold'>Unsold</button></td>";
                                        }
                                        else
                                        {
                                            echo "<td><button type='button' disabled id='btnSold' data-id='".$row['id']."' name='btnSold' class='btn btn-danger  Sold'>Sold Out</button></td>";
 
                                        }
                                        if($row['product_status']=='Active')
                                        {
                                            echo "<td><button type='button' id='btnActive' name='btnActive' class='btn btn-success btn_styleprime block-active' data-id='". $row['id'] ."'>Active</button></td>";
                                        }
                                        else
                                        {
                                            echo "<td><button type='button' id='btnBlock' name='btnBlock' class='btn btn-danger btn_styledange active-block' data-id='".$row['id']."'>Block</button></td>";
                                        }
                                        echo "<td><button type='button' data-id='".$row['id']."' id='btnView'  name='btnView' data-target='#ViewMore' style='width:60px;height:45px' data-toggle='modal' class='btn viewmore btn-primary btn-tone' title='View More'><i class='far fa-eye' title='View More'></i></button></td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                            <!-- <tfoot>
                                 <tr>
                                    <th>Catagory</th>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Image1</th>
                                    <th>Update</th>
                                    <th>Sell_Status</th>
                                    <th>Product_Status</th>
                                    <th>View More</th>
                                </tr>
                            </tfoot> -->
                        </table>
                </div>
		</div>
	</div>
	<!-- Main content end -->
	
	<!-- footer start -->
    <?php include("footer.php"); ?>
	<!-- footer end -->
	<!-- Back to top -->
	<div class="btn-back-to-top bg0-hov" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<span class="lnr lnr-chevron-up"></span>
		</span>
	</div>

	
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

<!-- Form validation cdn -->
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/additional-methods.js"></script>
<script src="//cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.3.1/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<!-- Bootstrap Growl  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/main.js"></script>
<script src="../new_js/time.js"></script>
<script src="../new_js/item_carousal.js"></script>
<!-- Sell Product js -->
<script src="../new_js/sell_product.js"></script>
<script>
        $("#tblPlan").DataTable({
            // scrollX : true,
            // scrollY : true,
        });

        if(!$("#sellProductForm").is(":visible"))
        {
            $("#sellProductForm").parent().append("<div class='alert alert-danger'><h5 class='text-danger'><span class='alert-icon' style='font-size:150%;'><i class='anticon anticon-info-o'></i></span><span style='font-size:120%;'>In Ghost Marketer,</span><br><div style='margin-left:4%;'>You have only 3 free product upload facility in a month.<br>If you want to upload more products, please upgrade your account.<br/><br/><a class='btn btn-info' href='premiumAccount.php'>Upgrade Account >></a></div></h5></div>");
        }
    </script>
    <script src="../new_js/user_footer.js"></script>
</body>
</html>