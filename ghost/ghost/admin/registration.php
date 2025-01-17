<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration for Ghost Marketer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" />
</head>
<body>
    <div class="container-fluid">
        <form method="post" id="admin_registration">
            <h1 class="text-center">Admin Registration</h1>
            <div class="form-group">
                <label class="form-label" for="admin_name">Admin Name :</label>
                <input type="text" id="admin_name" name="admin_name" class="form-control" />
            </div>

            <div class="form-group">
                <label class="form-label" for="admin_name">Admin Email :</label>
                <input type="email" id="admin_email" name="admin_email" class="form-control" />
            </div>

            <div class="form-group">
                <label class="form-label" for="admin_name">Admin Password :</label>
                <input type="password" id="admin_pas" name="admin_pas" class="form-control" />
            </div>

            <div class="form-group">
                <label class="form-label" for="admin_name">Admin Phone Number :</label>
                <input type="number" id="admin_phno" name="admin_phno" class="form-control" />
            </div>

            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit" id="sub" name="sub">Save</button>
                <button class="btn btn-danger" type="reset">Reset</button>
            </div>
        </form>
    </div>
</body>
    <!-- Javascript Plugins -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js" integrity="sha512-pBoUgBw+mK85IYWlMTSeBQ0Djx3u23anXFNQfBiIm2D8MbVT9lr+IxUccP8AMMQ6LCvgnlhUCK3ZCThaBCr8Ng==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="../js/registration.js"></script>
</html>