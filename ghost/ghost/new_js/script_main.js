
$("#login").click(function(event){
  event.preventDefault();
  if($("#loginform").valid()){
    var formdata = $("#loginform").serializeArray();
    const json = {};
    $.each(formdata,function(){
      json[this.name] = this.value || "";
    })
    $.ajax({
      type:"POST",
      method:"POST",
      url:"../php_api/crud.php?what=login",
      data:json,
      success:function(resp){
        data = JSON.parse(resp);
        if(data["success"]){
          $.bootstrapGrowl(`<h5> ${data["message"]}  </h5>`,{  
            type: 'success',  
            delay: 2500,  
            align:'center',
            width:300
           }); 
          setTimeout(function(){
              window.location.replace('../pages/index.php');
          },2500)
        } else{
          $.bootstrapGrowl(`<h5> ${data["message"]}  </h5>`,{  
            type: 'danger',  
            delay: 2500,
            width:300,  
            align:'center'
           });           
        }       
      }
    })
  }

});
$("#register").click(function(event){
    event.preventDefault();   
    window.scrollTo({top: 0, behavior: 'smooth'});
    if($("#register_form").valid()){        
        var formdata = $("#register_form").serializeArray();
        const json = {};
        $.each(formdata,function(){
          json[this.name] = this.value || "";
        })
        $.ajax({
          type:"POST",
          method:"POST",
          url:"../php_api/crud.php?what=register",
          data:json,
          success:function(resp){            
            data = JSON.parse(resp);                        
            $.bootstrapGrowl(`<h5> ${data["message"]} </h5>`,{  
              type: 'info',  
              delay: 2500,  
              align:'center',
              width:300
             }); 
            setTimeout(function(){
                window.location.reload();
            },2500);
          }
        })
    }    
})
$("#register_form").validate({            
  rules: {                                                                
      firm_name: "required",
      first_name: "required",
      last_name:"required",
      email: {
        required: true,
        email: true
      },
      password: {
        required: true,
        minlength: 5
      },
      address:{
          required: true,
          minlength: 10
      },
      phone_no:{
          required: true,
          digits: true,
          minlength: 10,
          maxlength:10
      },
      pincode:{
          required:true,
          digits: true,
          minlength: 6,
          maxlength:6
      },
      confirmPassword:{
          required:true,
          equalTo:"#password"
      }
  },
  // Specify validation error messages
  messages: {
    firm_name:"<span class='text-danger'>Please enter your firm name</span>",
    first_name: "<span class='text-danger'>Please enter your first name</span>",
    last_name: "<span class='text-danger'>Please enter your last name</span>",
    password: {
      required: "<span class='text-danger'>Please provide a password</span>",
      minlength: "Your password must be at least 5 characters long"
    },
    email: "<span class='text-danger'>Please enter a valid email address</span>",
    address: {
      required:"<span class='text-danger'>Please Enter your Address</span>",
      minlength:"<span class='text-danger'>Address should be greater than 10 characters</span>"
    },
    phone_no:{
      required: "<span class='text-danger'>Please Enter Phone Number</span>",
      minlength:"<span class='text-danger'>Please enter 10 digit mobile number</span>",
      maxlength:"<span class='text-danger'>Please enter 10 digit mobile number</span>",
    },
    pincode:{
      required:"<span class='text-danger'>Please enter Pincode</span>",
      minlength:"<span class='text-danger'>Please enter valid Pincode</span>",
      maxlength:"<span class='text-danger'>Please enter valid Pincode</span>"
    },
    confirmPassword:{
      required:"<span class='text-danger'>Please enter Confirm Password</span>",
      equalTo:"<span class='text-danger'>Enter confirm Password same as Password </span>"
    }
  }
});      
