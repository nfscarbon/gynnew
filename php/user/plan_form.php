<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$plan_id =  (isset($_GET['plan_id'])) ? $_GET['plan_id'] : 0;

if($plan_id)
{
    $user_check_query = "SELECT * FROM plan WHERE PlanId = '".$plan_id."'"; $result = mysqli_query($db, $user_check_query);
    $res = mysqli_fetch_assoc($result);
}


// receive all input values from the form
$PlanId          = (isset($res['PlanId'])) ? $res['PlanId'] : '';
$PlanName        = (isset($res['PlanName'])) ? $res['PlanName'] : '';
$PlanPrice       = (isset($res['PlanPrice'])) ? $res['PlanPrice'] : '';
$discount        = (isset($res['discount'])) ? $res['discount'] : '';
$PlanDuration    = (isset($res['PlanDuration'])) ? $res['PlanDuration'] : '';
$status          = (isset($res['status'])) ? $res['status'] : '';
$created = date('Y-m-d H:i:s');


// REGISTER USER
if (isset($_POST['reg_plan'])) 
{

    //var_dump($_POST);


    // receive all input values from the form
    $PlanId          = mysqli_real_escape_string($db, $_POST['PlanId']);
    $PlanName        = mysqli_real_escape_string($db, $_POST['PlanName']);
    $PlanPrice       = mysqli_real_escape_string($db, $_POST['PlanPrice']);
    $discount        = mysqli_real_escape_string($db, $_POST['discount']);
    $PlanDuration    = mysqli_real_escape_string($db, $_POST['PlanDuration']);
    $status          = mysqli_real_escape_string($db, $_POST['status']);

    if (empty($PlanName)) { array_push($errors, "PlanName is required"); }
    if (empty($PlanPrice)) { array_push($errors, "PlanPrice is required"); }
    //if (empty($discount)) { array_push($errors, "discount is required"); }
    if (empty($PlanDuration)) { array_push($errors, "PlanDuration is required"); }
    //if (empty($status)) { array_push($errors, "status is required"); }


    // first check the database to make sure 
    // a user does not already exist with the same username and/or email
    // $user_check_query = "SELECT * FROM members WHERE username='$username' OR email='$email' LIMIT 1";
    // $result = mysqli_query($db, $user_check_query);
    // $user = mysqli_fetch_assoc($result);

    // if ($user) { // if user exists
    //     if ($user['username'] === $username) 
    //     {
    //         array_push($errors, "Username already exists");
    //     }

    //     if ($user['email'] === $email) 
    //     {
    //         array_push($errors, "email already exists");
    //     }
    // }

    // var_dump($errors);

    // exit();

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) 
    {
        if($PlanId)
        {
            $query = "UPDATE plan SET PlanName = '$PlanName', PlanPrice = '$PlanPrice', discount = '$discount', PlanDuration = '$PlanDuration', status = '$status', created = '$created' WHERE PlanId = '".$PlanId."'";
            
        }
        else
        {
            $query = "INSERT INTO plan (PlanName, PlanPrice, discount, PlanDuration, status, created) 
            VALUES('$PlanName', '$PlanPrice', '$discount', '$PlanDuration', '$status', '$created')";
        }

        mysqli_query($db, $query);
        $_SESSION['success'] = "Plan has been saved.";
        header('location: plan.php');
    }
}
?>

<div class="adminbox-right" id="page-wrapper">
    <div class="container-fluid">
        <div class="flex-box bg-title">
            <div class="flex-box_left">
                <h4 class="page-title">Plan</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Plan</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Plan <?php echo (isset($_GET['plan_id'])) ? 'Edit' : 'Add' ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php include('errors.php'); ?>

                        <form action="" id="composeMailForm" method="post" class="ajax-form form-material form-horizontal form-bordered">

                            <input type="hidden" name="PlanId" value="<?php echo $PlanId ?>">
                            <input type="hidden" name="reg_plan" value="1">
                            <div class="control-group">
                                <label for="textfield" class="control-label">Plan Name :</label>
                                <div class="controls">
                                    <input type="text" name="PlanName" value="<?php echo $PlanName ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Plan Price :</label>
                                <div class="controls">
                                    <input type="text" name="PlanPrice" value="<?php echo $PlanPrice ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Discount :</label>
                                <div class="controls">
                                    <input type="text" name="discount" value="<?php echo $discount ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Plan Duration :</label>
                                <div class="controls">
                                    <input type="text" name="PlanDuration" value="<?php echo $PlanDuration ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">status :</label>
                                <div class="controls">
                                    <select name="status" class="uneditable-input">
                                        <option value="1" <?php echo ($status == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo ($status == 0) ? 'selected' : '' ?>>De-Active</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <button type="submit" class="btn btn-success">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('footer.php') ?>