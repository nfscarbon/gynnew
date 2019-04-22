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
   

    <div class="main-box" style="background: url(images/login-register.jpg)">

        <div class="form-box">
                <div class="white-box">
                    <form id="loginform" method="post" class="form-horizontal form-material" style="<?php echo (isset($_POST['reg_user'])) ? 'display: none' : ''  ?>">
                        <div >
                            <a href="../index.php" class="text-center db">
                                <img src="images/logo.png" height="60px" />
                            </a>

                            <?php include('errors.php'); ?>
                            
                            <input type="hidden" name="login_user" value="1">
                            <div class="form-group">
                                
                                    <input class="form-control" type="email" placeholder="Email" name="email" value="">
                                
                            </div>
                            <div class="form-group">
                               
                                    <input class="form-control" type="password" placeholder="Password" value="" name="password">
                               
                            </div>
                            
                            <div class="form-group text-center ">
                              
                                    <button type="submit" class="btn btn-info btn-block waves-effect">Log In</button>
                                
                            </div>



                            <div class="form-group m-b-0">
                                <div class="text-center">
                                    <p>Don't have an account? <a href="javascript:void(0);" id="signup" class=""><b>Sign Up</b></a></p>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form id="registerform"  method="post" action="" class="form-horizontal form-material" style="<?php echo (isset($_POST['reg_user'])) ? 'display: block' : ''  ?>">

                        <a href="../index.php" class="text-center db">
                            <img src="images/logo.png" height="60px" />
                        </a>

                        <?php include('errors.php'); ?>          
                            
                        <input type="hidden" name="reg_user" value="1">
                        <div class="form-group m-t-40">
                           
                                <input class="form-control" type="text" placeholder="First Name" name="MemberName">
                           
                        </div>
                        <div class="form-group hide-display">
                           
                                <input class="form-control" type="text" placeholder="Email" name="MemberEmailId">
                           
                        </div>
                        <div class="form-group hide-display">
                          
                                <input class="form-control" type="number" maxlength="10" placeholder="Phone" name="MembePhone">
                            
                        </div>
                        <div class="form-group hide-display">
                           
                                <input class="form-control" type="password" placeholder="Password" name="MemberPassword">
                           
                        </div>
                        <div class="form-group hide-display">
                          
                                <input class="form-control" type="password" placeholder="Confirm Password" name="confirm_MemberPassword">
                            
                        </div>
                        <div class="form-group text-center">
                           
                                <button class="btn btn-info btn-block waves-effect" type="submit">Sign Up</button>
                           
                        </div>

                    </form>
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
