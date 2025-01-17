setInterval(function(){
    const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
    var time = new Date();
    var day;
    switch (time.getDay()) {
    case 0:
        day = "Sunday";
        break;
    case 1:
        day = "Monday";
        break;
    case 2:
        day = "Tuesday";
        break;
    case 3:
        day = "Wednesday";
        break;
    case 4:
        day = "Thursday";
        break;
    case 5:
        day = "Friday";
        break;
    case 6:
        day = "Saturday";
    };
    var gettimehere = "<div><span style='font-weight:700;'>"+ time.getDate() +" "+ monthNames[time.getMonth()] +"</span><br><span>"+ time.getHours() +":"+ time.getMinutes() +":"+ time.getSeconds() +"</span></div>";
    $("#gettimehere").html(gettimehere);
},1000);
 