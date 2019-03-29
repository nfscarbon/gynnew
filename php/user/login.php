<?php include('../includes/config.php'); ?>

<?php 
if (isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "";
    header('location: index.php');
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Login</title>
    <link href="css/StyleSheet.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="robots" content="index, follow">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="preloader" style="display: none;">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"></circle>
        </svg>
    </div>

    <div class="main-box" style="background: url(images/login-register.jpg)">

        <div class="form-box">
            <div class="login">
                <div class="white-box">
                    <form id="loginform" method="post" class="ajax-form form-horizontal form-material" style="<?php echo (isset($_POST['reg_user'])) ? 'display: none' : ''  ?>">
                        <div class="form-body">
                            <a href="../index.php" class="text-center db">
                                <img src="images/logo.png" height="60px" />
                            </a>

                            <?php include('errors.php'); ?>
                            
                            <input type="hidden" name="login_user" value="1">
                            <div class="form-group m-t-40">
                                <div class="col-xs-12">
                                    <input class="form-control" type="email" placeholder="Email" name="email" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" placeholder="Password" value="" name="password">
                                </div>
                            </div>
                            
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button type="submit" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">Log In</button>
                                </div>
                            </div>



                            <div class="form-group m-b-0">
                                <div class="col-sm-12 text-center">
                                    <p>Don't have an account? <a href="javascript:void(0);" id="signup" class="text-primary m-l-5"><b>Sign Up</b></a></p>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form id="registerform"  method="post" action="" class="ajax-form form-horizontal form-material" style="<?php echo (isset($_POST['reg_user'])) ? 'display: block' : ''  ?>">

                        <a href="../index.php" class="text-center db">
                            <img src="images/logo.png" height="60px" />
                        </a>

                        <?php include('errors.php'); ?>          
                            
                        <input type="hidden" name="reg_user" value="1">
                        <div class="form-group m-t-40">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" placeholder="First Name" name="MemberName">
                            </div>
                        </div>
                        <div class="form-group hide-display">
                            <div class="col-xs-12">
                                <input class="form-control" type="text" placeholder="Email" name="MemberEmailId">
                            </div>
                        </div>
                        <div class="form-group hide-display">
                            <div class="col-xs-12">
                                <input class="form-control" type="number" maxlength="10" placeholder="Phone" name="MembePhone">
                            </div>
                        </div>
                        <div class="form-group hide-display">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" placeholder="Password" name="MemberPassword">
                            </div>
                        </div>
                        <div class="form-group hide-display">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" placeholder="Confirm Password" name="confirm_MemberPassword">
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20 hide-display">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Sign Up</button>
                            </div>
                        </div>








                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>Already have an account? <a href="javascript:void(0);" id="signin" class="text-primary m-l-5"><b>Sign In</b></a></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

</body>

<script src="js/jquery-1.11.3.min.js"></script>
<script>
    $(document).ready(function () {
        $("#signup").click(function () {
            $("#loginform").hide();
            $("#registerform").show();
        });
        $("#signin").click(function () {
            $("#loginform").show();
            $("#registerform").hide();
        });
    });


</script>
</html>
