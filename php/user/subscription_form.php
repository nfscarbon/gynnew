<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$SubscriptionId =  (isset($_GET['SubscriptionId'])) ? $_GET['SubscriptionId'] : 0;

if($SubscriptionId)
{
    $user_check_query = "SELECT * FROM subscription WHERE SubscriptionId = '".$SubscriptionId."'"; $result = mysqli_query($db, $user_check_query);
    $res = mysqli_fetch_assoc($result);
}

//get All Members
if($_SESSION['logged_user']['MemberType'] == 2){


   $members_query = "SELECT * FROM members WHERE MemberId = ".$_SESSION['logged_user']['MemberId'];     

}
else
{

   $members_query = "SELECT * FROM members WHERE MemberActiveStatus = 1"; 
}

$members_queryresult = mysqli_query($db, $members_query);
//$members_res = mysqli_fetch_assoc($members_queryresult);


//get All plan
$plan_query = "SELECT * FROM plan WHERE status = 1"; 
$plan_queryresult = mysqli_query($db, $plan_query);
//$plan_res = mysqli_fetch_assoc($plan_queryresult);

//get All plan
$slot_query = "SELECT * FROM slots WHERE status = 1"; 
$slot_queryresult = mysqli_query($db, $slot_query);
//$slot_res = mysqli_fetch_assoc($slot_queryresult);


// receive all input values from the form
$SubscriptionId     = (isset($res['SubscriptionId'])) ? $res['SubscriptionId'] : '';
$MemberId           = (isset($res['MemberId'])) ? $res['MemberId'] : '';
$SlotId             = (isset($res['SlotId'])) ? $res['SlotId'] : '';
$PlanID             = (isset($res['PlanID'])) ? $res['PlanID'] : '';
$DateStart          = (isset($res['DateStart'])) ? $res['DateStart'] : '';
$DateEnd            = (isset($res['DateEnd'])) ? $res['DateEnd'] : '';
$Amount             = (isset($res['Amount'])) ? $res['Amount'] : '';
$status             = (isset($res['status'])) ? $res['status'] : '';
$created            = date('Y-m-d H:i:s');


// REGISTER USER


if(isset($_GET['razorpay_payment_id'])){
$id = isset($_GET['razorpay_payment_id']);    
  



$SlotId=$_SESSION['SlotId'];
$MemberId=$_SESSION['MemberId'];
$PlanID=$_SESSION['PlanID'];
$DateStart=$_SESSION['DateStart'];
$DateEnd=$_SESSION['DateEnd'];
$Amount=$_SESSION['amount'];
$status=1;
$created = date('Y-m-d H:i:s');
            $query = "INSERT INTO subscription (SlotId, MemberId, PlanID, DateStart, DateEnd, Amount, status, created) 
            VALUES('$SlotId', '$MemberId', '$PlanID', '$DateStart', $DateEnd, $Amount, '$status', '$created')";
        

        $result = mysqli_query($db, $query);

      /* echo "<script>console.log( 'Debug Objects: PlanPrice  $query ' );</script>"; */
    

        $_SESSION['success'] = "Subscription has been saved.";
       // header('location: subscriptions.php');

}

if (isset($_POST['reg_subscription'])) 
{

    if($_SESSION['logged_user']['MemberType'] == 2){
        /**
        Not admin
        **/
    

        $plan_check_query = "SELECT * FROM plan WHERE PlanId = '".$_POST['PlanID']."'"; 
        $result = mysqli_query($db, $plan_check_query);
        $plan_res = mysqli_fetch_assoc($result);

        $DateStart       = date('Y-m-d');
        $DateEnd         = date('Y-m-d', strtotime($DateStart. ' + '.$plan_res['PlanDuration'].' days'));
        $Amount          = $plan_res['PlanPrice'];

      
    
       // receive all input values from the form
    // $SubscriptionId  = mysqli_real_escape_string($db, $_POST['SubscriptionId']);
    $SlotId          = mysqli_real_escape_string($db, $_POST['SlotId']);
    $MemberId        = mysqli_real_escape_string($db, $_POST['MemberId']);
    $PlanID          = mysqli_real_escape_string($db, $_POST['PlanID']);

$_SESSION['amount']=$Amount;
$_SESSION['SubscriptionId']=$SubscriptionId;
$_SESSION['SlotId']=$SlotId;
$_SESSION['MemberId']=$MemberId;
$_SESSION['PlanID']=$PlanID;
$_SESSION['DateStart']=$DateStart;
$_SESSION['DateEnd']=$DateEnd;

    $url = "payment/pay.php?Amount=".$Amount."&SlotId=".$SlotId;

   header("location: $url");

    }else{
    
    
    
   


    // receive all input values from the form
    $SubscriptionId  = mysqli_real_escape_string($db, $_POST['SubscriptionId']);
    $SlotId          = mysqli_real_escape_string($db, $_POST['SlotId']);
    $MemberId        = mysqli_real_escape_string($db, $_POST['MemberId']);
    $PlanID          = mysqli_real_escape_string($db, $_POST['PlanID']);




    // $DateStart       = mysqli_real_escape_string($db, $_POST['DateStart']);
    // $DateEnd         = mysqli_real_escape_string($db, $_POST['DateEnd']);
    // $Amount          = mysqli_real_escape_string($db, $_POST['Amount']);

    $DateStart       = '';
    $DateEnd         = '';
    $Amount          = '';

    $status          = mysqli_real_escape_string($db, $_POST['status']);

    if (empty($MemberId)) { array_push($errors, "MemberId is required"); }
    if (empty($SlotId)) { array_push($errors, "SlotId is required"); }
    if (empty($PlanID)) { array_push($errors, "PlanID is required"); }
    // if (empty($DateStart)) { array_push($errors, "DateStart is required"); }
    // if (empty($DateEnd)) { array_push($errors, "DateEnd is required"); }
    // if (empty($Amount)) { array_push($errors, "Amount is required"); }

    // var_dump($errors);

    // exit();

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) 
    {

        $plan_check_query = "SELECT * FROM plan WHERE PlanId = '".$PlanID."'"; 
        $result = mysqli_query($db, $plan_check_query);
        $plan_res = mysqli_fetch_assoc($result);

        $DateStart       = date('Y-m-d');
        $DateEnd         = date('Y-m-d', strtotime($DateStart. ' + '.$plan_res['PlanDuration'].' days'));
        $Amount          = $plan_res['PlanPrice'];


        if($SubscriptionId)
        {
            $query = "UPDATE subscription SET SlotId = '$SlotId', MemberId = '$MemberId', PlanID = '$PlanID', DateStart = '$DateStart', DateEnd = '$DateEnd', Amount = '$Amount', status = '$status', created = '$created' WHERE SubscriptionId = '".$SubscriptionId."'";
            
        }
        else
        {
            $query = "INSERT INTO subscription (SlotId, MemberId, PlanID, DateStart, DateEnd, Amount, status, created) 
            VALUES('$SlotId', '$MemberId', '$PlanID', '$DateStart', $DateEnd, $Amount, '$status', '$created')";
        }

        $result = mysqli_query($db, $query);

      //  echo "<script>console.log( 'Debug Objects: PlanPrice " .  mysqli_fetch_assoc("SELECT LAST_INSERT_ID()"). "' );</script>"; 
    

        $_SESSION['success'] = "Subscription has been saved.";
        header('location: subscriptions.php');
    }}
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
                            <span class="caption-subject font-dark bold uppercase">Subscription <?php echo (isset($_GET['SubscriptionId'])) ? 'Edit' : 'Add' ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php include('errors.php'); ?>

                        <form action="" id="composeMailForm" method="post" class="ajax-form form-material form-horizontal form-bordered">

                            <input type="hidden" name="SubscriptionId" value="<?php echo $SubscriptionId ?>">
                            <input type="hidden" name="reg_subscription" value="1">
                            <div class="control-group">
                                <label for="textfield" class="control-label">Member Name :</label>
                                <div class="controls">
                                    <select name="MemberId" class="uneditable-input">
                                        <?php while ($members_res = mysqli_fetch_array($members_queryresult)) { ?>
                                            <option value="<?php echo $members_res['MemberId'] ?>" <?php echo ($members_res['MemberId'] == $MemberId) ? 'selected' : '' ?>><?php echo $members_res['MemberName'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Slot Name :</label>
                                <div class="controls">
                                    <select name="SlotId" class="uneditable-input">
                                        <?php while ($slot_res = mysqli_fetch_array($slot_queryresult)) { ?>
                                            <option value="<?php echo $slot_res['id'] ?>" <?php echo ($slot_res['id'] == $SlotId) ? 'selected' : '' ?>><?php echo $slot_res['name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">PlanId :</label>
                                <div class="controls">
                                    <select name="PlanID" class="uneditable-input" >
                                        <?php while ($plan_res = mysqli_fetch_assoc($plan_queryresult)) { ?>
                                            
                                            <option value="<?php echo $plan_res['PlanId'] ?>" 
                                            
                                             <?php echo ($plan_res['PlanId'] == $PlanID) ? 
                                               'selected' : '' ?>>
                                            <?php echo ($plan_res['PlanName'] ."  --- Price INR  ".$plan_res['PlanPrice']) ?>
                                        
                                        </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            
                                

                                    <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                    <div class="control-group">
                                        <label for="textfield" class="control-label">status :</label>
                                <div class="controls">
                                    <select name="status" class="uneditable-input">
                                        <option value="1" <?php echo ($status == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo ($status == 0) ? 'selected' : '' ?>>De-Active</option>
                                    </select>
                                     </div>
                                     </div>
                                    <?php } ?>
                               
                            



                            <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                <div class="control-group">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            <?php } ?>
                             <?php if($_SESSION['logged_user']['MemberType'] != 1) { ?>
                                <div class="control-group">
                                    <button type="pay" id="myclick" class="btn btn-success">Pay</button>
                                </div>
                            <?php } ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?php if($_SESSION['logged_user']['MemberType'] == 2) { ?>
    <script type="text/javascript">
        $(document).ready(function(){
            $('input, select, textarea').attr('readonly', true);
        })


    </script>
<?php } ?>

<?php include('footer.php') ?>