<?php
    include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Ghost Marketer</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="image/logo.png"/>

    <!-- page css -->

    <!-- Core css -->
    <link href="assets/css/app.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

    <link href="//cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .inpt
        {
            border: none;
            border-bottom: 1px ridge black;
            border-radius: 0px;
            
        }
       
        .hdr
        {
            font-size:30px;
            font-weight: bold;
        }
        .hdr-image
        {
            
            margin-left: 150%;
           
        }
        .gen
        {
            padding-left:150px;
        }
        @media (max-width:768px)
        {
                
              .hdr-image
              {
                 display:none;
              }  
              .hdr-top-image
              {
                  display: block;
              }  
              .inpt-mobile
              {
                    width:100%;
              }
              .gen
              {
                padding-left:30px;
              }
        }
        @media(min-width:769px)
        {
            .hdr-top-image
              {
                  display: none;
              }  
        }
    

        .phone
        {
            width:90%;
        }
        .radio_gender
        {
            padding-left:100px;
        }
        label
        {
            font-size: 16px;
            font-weight:bold;
        
        }
        .tbl_main
        {
            /* box-shadow:4px 4px  12px 1px grey; */
            
            /* box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); */
            box-shadow:0 2px 4px 0 rgba(0, 0, 0, 0.2), 0 2px 10px 0 rgba(0, 0, 0, 0.19);
            padding-top: 15px;
            padding-bottom:15px;
            padding-left: 15px;
            padding-right: 15px;
            background-color: white;
        
            
        }
        .btn_next:hover{
            background-color: rgb(105,105,105,0.2);
            color:rgb(105,105,105, 1);
            font-weight:700;
            /* border:0px; */
            /* width:100px;
            height:40px; */
        }
        .btn_styledange:hover{
            color:red;
            /* border:0px; */
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_styleprime:hover{
            background-color: rgba(0,160,0,0.2);
            color:rgba(0, 160, 110, 1);
            font-weight:500;
            border:0px;
        }
        .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;
            border:0px;

       }
       .btn_res{
        width:100px;
       }
       /* .hov_a{
            border
       }
       .hov_a:hover{
            border-bottom:1px solid blue;  
            color:blue 
       } */
    </style>

</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
            <div class="row no-gutters h-100 full-height">

            <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalScrollableTitle">Terms & Condition</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        The agrreing to the terms and condition, you are agreeing to the following :
                        <ul class="ml-2">
                            <li>
                                Your business information like business name, email, etc will be shown with your products to our registered user. 
                            </li>
                            <li>
                                Customer can place a return request within 7 days of product delivery.
                            </li>
                            <li>
                                The products that you upload are all your responsibility and Ghost Marketer is not entitled to bear responsibility if it's defective or illegal.
                            </li>
                            <li>
                                If the product you upload found misleading, then Ghost Marketer deserves full right to block that product.
                            </li>
                            <li>
                                If more seviour complaints are found for the user, than Ghost Marketer serves full right to block your account.
                            </li>
                            <li>
                                On event of account bloackage, your plan subscribed money will not be refunded on any cases.
                            </li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                </div>
            </div>
                <div class="col-lg-4 d-none d-lg-flex bg" style="background-image:url('image/logo.png'); background-color:white;background-size:contain;">
                    <!-- <div class="d-flex h-100 p-h-40 p-v-15 flex-column justify-content-between">
                        <div>
                            <img src="assets/images/logo/logo-white.png" alt="">
                        </div>
                        <div>
                            <h1 class="text-white m-b-20 font-weight-normal">Exploring Enlink</h1>
                            <p class="text-white font-size-16 lh-2 w-80 opacity-08">Climb leg rub face on everything give attitude nap all day for under the bed. Chase mice attack feet but rub face on everything hopped up.</p>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-white">© 2019 ThemeNate</span>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Legal</a>
                                </li>
                                <li class="list-inline-item">
                                    <a class="text-white text-link" href="">Privacy</a>
                                </li>
                            </ul>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-8 bg-white">
                    <div class="container h-100">
                        <div class="row no-gutters h-100 align-items-center">
                            <div class="col-md-8 col-lg-7 col-xl-6 mx-auto"> 
                                <table>
                                    <tr>
                                        <td>
                                            <img src="image/ghost2.png" class="hdr-top-image" width="100%"/>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hdr">Sign Up</td>
                                        <td>
                                            <img src="image/ghost2.png" class="hdr-image" width="130%" height="130%"/>  
                                        </td>
                                     </tr>
                                </table>
                                <p class="m-b-30">Create your account to get full access</p>
                                <form method="post" id="frm">
                                    <!-- Progress Bar -->
                                    <div class="progress">
                                        <div class="progress-bar bg-success" id="pg1" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                                    </div>
                                    <!-- Progress Bar End -->

                                    <fieldset id="f1">
                                    
                                        <div class="form-group">
                                           <label class="font-weight-semibold"  for="txtName">Owner Name:</label>
                                           <input type="text" class="form-control inpt inpt-mobile" id="txtName" name="txtName" placeholder="Owner Name"/>
                                       </div>

                                       <div class="form-group">
                                            <label class="font-weight-semibold" for="txtMail">Email-Id:</label>
                                            <input type="text" class="form-control inpt inpt-mobile" id="txtMail" name="txtMail" placeholder="Email"/>
                                        </div>

                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="font-weight-semibold" for="txtPhone">Phone no:</label>
                                                            <input type="number" class="form-control inpt phone inpt-mobile" id="txtPhone" name="txtPhone" placeholder="Phone no"/>
                                                    </div>                                           
                                                </td>
                                                <td>
                                                    <div class="form-group gen">
                                                        <label class="font-weight-semibold form-check-label" for="gender">Gender:</label>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="rdGender1" value="male" required name="rdGender"><label for="rdGender1" style="font-weight:normal">Male</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input type="radio" class="form-check-input" id="rdGender2" value="female" required name="rdGender"><label for="rdGender2" style="font-weight:normal">Female</label>
                                                            </div>
                                                            <div class="form-check temp">
                                                                <input type="radio" class="form-check-input" id="rdGender3" value="others" required name="rdGender"><label for="rdGender3" style="font-weight:normal">Other</label>
                                                            </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="form-group" id="inpt">
                                            <label class="font-weight-semibold" for="password">Password:</label>
                                                <div class="input-group-append">
                                                    <input type="password" class="form-control inpt inpt-mobile" id="txtPwd" name="txtPwd" placeholder="Password"/>
                                                    <span class="input-group-text inpt" style="background-color:white"><a  id="btnEye"><i class="far fa-eye"></i></a></span>
                                                </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                            <input type="password" class="form-control inpt inpt-mobile" id="txtCon" name="txtCon" placeholder="Confirm Password">
                                        </div>

                                        <div class="form-group text-right">
                                            <button class="btn btn-secondary btn_next " type="button" id="next1">Next <i class="anticon anticon-double-right"></i></button>
                                        </div>
                                    </fieldset>

                                    <fieldset id="f2">
                                    
                                        <div class="form-group">
                                           <label class="font-weight-semibold"  for="busName">Business Name:</label>
                                           <input type="text" class="form-control inpt inpt-mobile" id="busName" name="busName" placeholder="Business Name"/>
                                       </div>

                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="gstin">GST Number:</label>
                                            <input type="text" class="form-control inpt inpt-mobile" id="gstin" name="gstin" placeholder="GST Number"/>
                                        </div>

                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label class="font-weight-semibold" for="pincode">Pincode:</label>
                                                        <input type="number" id="pincode" name="pincode" class="form-control" style="width:150%;border:1px ridge black" placeholder="Pincode" />
                                                    </div>                                           
                                                </td>
                                                <td style="padding-left:100px">
                                                    <div class="form-group">
                                                        <label class="font-weight-semibold" for="state">State:</label>
                                                        <input type="text" id="state" name="state" class="form-control" style="width:200%;border:1px ridge black" readonly="readonly" placeholder="State" />
                                                    </div>                                           
                                                </td>
                                                <td style="padding-left:100px">
                                                    <div class="form-group">
                                                        <label class="font-weight-semibold" for="city">City:</label>
                                                        <input type="text" id="city" class="form-control" name="city" style="width:200%;border:1px ridge black" readonly="readonly" placeholder="City" />
                                                    </div>       
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="form-group">
                                            <label class="font-weight-semibold" for="txtAdd">Address:</label>
                                            <textarea type="text" class="form-control inpt inpt-mobile" id="txtAdd" name="txtAdd" placeholder="Address"></textarea>
                                        </div>

                                        <div class="form-group">
                                            <div class="d-flex align-items-center justify-content-between p-t-15">
                                                <div class="from-group">
                                                    <input type="checkbox" name="chk" class="inpt-mobile"/>
                                                    I have read and agree with this website<br/><a href="#" data-target="#exampleModalScrollable" data-toggle="modal" class='hov_a' id="chk">Terms and Conditions.</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between p-t-15">
                                            <button class="btn btn-secondary  btn_next" id="prev1" type="button"><i class="anticon anticon-double-left"></i> Previous</button>
                                            <button class="btn btn-danger btn_styledange btn_res" type="reset" id="btnReset" name="btnReset">Reset</button>
                                            <button class="btn btn-secondary btn_next" id="next2" type="button" name="next2">Next <i class="anticon anticon-double-right"></i></button>
                                        </div>
                                    </fieldset>
                                    <fieldset id="f3">
                                    <div class="row align-items-center" id="monthly-view">
                                        <!-- <table class="table table-responsive hover" id="plans">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Plan Name</th>
                                                    <th>Facility</th>
                                                    <th>Rate</th>
                                                    <th>Duration</th>
                                                    <th>Buy Now</th>
                                                </tr>
                                            </thead>
                                        <?php
                                            $query = mysqli_query($con, "select * from subscription_master where status = 'Active'");
                                            
                                            echo "<div class='row'>";
                                            while ($row = mysqli_fetch_array($query)) 
                                            {?>
                                                <tr>
                                                    <td><?php echo $row['subscription_name'] ?></td>
                                                    <td><?php echo $row['description'] ?></td>
                                                    <td><?php echo "Rs. " . $row['rate'] ?></td>
                                                    <td><?php
                                                        if($row['time_perioud'] < 30)
                                                        {
                                                            echo $row['time_perioud'] . " Days";
                                                        }
                                                        else if($row['time_perioud'] < 360)
                                                        {
                                                            echo ($row['time_perioud'] / 30) . " Months";
                                                        }
                                                        else
                                                        {
                                                            echo (($row['time_perioud'] / 30) / 12) . " Years";
                                                        }
                                                    ?></td>
                                                    <td><button type="button" data-desc="<?php echo $row['description'] ?>" class="btn btn-success purchasenow" data-duration="<?php echo $row['time_perioud'] ?>" data-id="<?php echo $row['id'] ?>" data-price="<?php echo $row['rate'] ?>">Purchase</button></td>
                                                </tr>            
                                            <?php
                                           }
                                            
                                        ?>
                                        </table> -->
                                        <?php
                                            $query = mysqli_query($con, "SELECT * FROM `subscription_master` WHERE `status` = 'Active'");

                                            while($row = mysqli_fetch_array($query))
                                            {?>
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="card">
                                                        <h3 class="card-header"><?php echo $row['subscription_name'] ?></h3>
                                                        <div class="card-body">
                                                            <h5 class="card-title">Description</h5>
                                                            <p class="card-text"><?php echo $row['description'] ?></p>

                                                            <br/>
                                                            <h5>Price : <?php echo $row['rate'] ?></h5>
                                                        </div>
                                                        <div class="card-footer">
                                                            <button type="button" data-desc="<?php echo $row['description'] ?>" class="btn btn-success purchasenow" data-duration="<?php echo $row['time_perioud'] ?>" data-id="<?php echo $row['id'] ?>" data-price="<?php echo $row['rate'] ?>">Purchase</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                        ?>

                                        <button class="btn btn-secondary  btn_next" id="prev2" type="button"><i class="anticon anticon-double-left"></i> Previous</button>
                                    </fieldset>
                                        

                                    <!-- <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Username:</label>
                                        <input type="text" class="form-control inpt inpt-mobile" id="txtUser" name="txtUser" placeholder="Username"/>
                                    </div> -->
                                    
                                </form>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ALl Basic link -->
    <?php
        include("include.php");
    ?>
    

    <!-- Validation Js -->
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="new_js/business_registration.js" ></script>
        <script>
            // $("#plans").DataTable();
        </script>
    
</body>

</html>