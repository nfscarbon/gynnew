<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
?>
<?php 
if($_SESSION['logged_user']['MemberType'] == 1)// admin
{
    include('admin_dashboard.php');
}
else
{
    include('user_dashboard.php');
}
?>
<?php include('footer.php') ?>