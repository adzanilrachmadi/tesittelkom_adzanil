<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url(); ?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" id="login_form">
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" id="username" type="text" autofocus required oninput="$('#message').text('')">
                                    <!-- <div class="invalid-feedback">Please input username</div> -->
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" required oninput="$('#message').text('')">
                                    <!-- <div class="invalid-feedback">Please input password</div> -->
                                </div>
                                <p id="message" style="color:red; font-size: .9rem; text-align: center;"></p>
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Login">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>assets/dist/js/sb-admin-2.js"></script>
    <script>
        $("#login_form").submit((e) => {
            e.preventDefault();
            e.stopPropagation();
            // validate value
            var error = false;
            $("#login_form").find("input").each((i, ele) => {
                if ($(ele).val() == "") {
                    $(ele).addClass("is-invalid");
                    error = true;
                }
            });
            if (error) {
                return;
            }
            // process ajax call login
            var f = new FormData($("#login_form")[0]);
            $.ajax({
                url: "<?php echo base_url("auth/submit_login") ?>",
                data: f,
                method: "POST",
                cache: false,
                contentType: false,
                processData: false,
                type: "json",
                success: function(result) {
                    console.log(result);
                    var j = JSON.parse(result);
                    if (j.success) {
                        location.href = j.redirect;
                    } else {
                        $("#message").text(j.message);
                        $("#username").focus();
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        });
    </script>

</body>

</html>