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
        .btn_styledange:hover{
            color:red;
            font-weight:500;
            background-color: rgba(160,0,0,0.2); 
        }
        .btn_close:hover{
            background-color: rgba(197, 239, 247,1);
            color:rgba(68, 108, 240,1);
            font-weight:500;

       }
       
    </style>

</head>

<body>
    <div class="app">
        <div class="container-fluid p-0 h-100">
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
            <div class="row no-gutters h-100 full-height">
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
                                            <img src="image/ghost2.png" class="hdr-top-image" width="100%" height="100%"/>  
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="hdr">Sign Up</td>
                                        <td>
                                                <img src="image/ghost2.png" class="hdr-image" width="130%" height="130%"/>  
                                        </td>
                                     </tr>
                                </table>
                                <p class="m-b-30">Create your account to get access</p>
                                <form method="post" id="frm">
                                     <div class="form-group">
                                        <label class="font-weight-semibold"  for="txtName">Name:</label>
                                        <input type="text" class="form-control inpt inpt-mobile" id="txtName" name="txtName" placeholder="Name"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="txtAdd">Address:</label>
                                        <textarea type="text" class="form-control inpt inpt-mobile" id="txtAdd" name="txtAdd" placeholder="Address"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="txtMail">Email-Id:</label>
                                        <input type="text" class="form-control inpt inpt-mobile" id="txtMail" name="txtMail" placeholder="Email"/>
                                    </div>
                                    <div class="form-group" id="inpt">
                                        <label class="font-weight-semibold" for="password">Password:</label>
                                            <div class="input-group-append">
                                                 <input type="password" class="form-control inpt inpt-mobile" id="txtPwd" name="txtPwd" placeholder="Password"/>
                                                <span class="input-group-text inpt" style="background-color:white"><a  id="btnEye"><i class="far fa-eye"></i></a></span>
                                            </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="confirmPassword">Confirm Password:</label>
                                        <input type="password" class="form-control inpt inpt-mobile" id="txtCon" name="txtCon" placeholder="Confirm Password">
                                    </div>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="font-weight-semibold" for="phone_no">Phone no:</label>
                                                        <input type="number" class="form-control inpt phone inpt-mobile" id="txtPhone" name="txtPhone" placeholder="Phone no"/>
                                                </div>                                           
                                            </td>
                                            <td>
                                                <div class="form-group gen">
                                                     <label class="font-weight-semibold form-check-label" for="gender">Gender:</label>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="rdGender1" value="male" required name="rdGender">Male
                                                         </div>
                                                        <div class="form-check">
                                                            <input type="radio" class="form-check-input" id="rdGender2" value="female" required name="rdGender">Female
                                                        </div>
                                                         <div class="form-check temp">
                                                            <input type="radio" class="form-check-input" id="rdGender3" value="others" required name="rdGender">Other
                                                        </div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    <table>
                                        <tr>
                                            <td>
                                                <div class="form-group">
                                                    <label class="font-weight-semibold" for="pincode">Pincode:</label>
                                                    <input type="number" id="pincode" name="pincode" class="form-control" style="width:150%;border:1px ridge black" />
                                                 </div>                                           
                                            </td>
                                            <td style="padding-left:100px">
                                                <div class="form-group">
                                                    <label class="font-weight-semibold" for="state">State:</label>
                                                    <input type="text" id="state" name="state" class="form-control" style="width:200%;border:1px ridge black" readonly="readonly" />
                                                 </div>                                           
                                            </td>
                                            <td style="padding-left:100px">
                                                <div class="form-group">
                                                    <label class="font-weight-semibold" for="city">City:</label>
                                                    <input type="text" id="city" class="form-control" name="city" style="width:200%;border:1px ridge black" readonly="readonly" />
                                                </div>       
                                            </td>
                                        </tr>
                                    </table>
                                   
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <div class="from-group">
                                                <input type="checkbox"  name="chk" id="inpt-mobile"/>
                                                I have read and agree with this website<br/><a href="#" data-target="#exampleModalScrollable" data-toggle="modal" id="chk" style="border-bottom:1px solid blue;"> Terms and Conditions.</a>
                                                <div id="chker" class="text-danger" style='font-size:small;font-weight:bold;'></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between p-t-15">
                                        <button class="btn btn-primary btn-lg btn_close" id="btnSubmit" type="button" name="btnSUbmit">Sign In</button>
                                        <button class="btn btn-danger btn-lg btn_styledange" id="btnReset" type="button" name="btnReset">Reset</button>
                                    </div>
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
        <script src="new_js/user_regitration.js" ></script>
    
</body>

</html>