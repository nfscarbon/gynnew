<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$MemberId =  (isset($_GET['MemberId'])) ? $_GET['MemberId'] : 0;

if($MemberId)
{
    $user_check_query = "SELECT * FROM members WHERE MemberId = '".$MemberId."'"; $result = mysqli_query($db, $user_check_query);
    $res = mysqli_fetch_assoc($result);
}


// receive all input values from the form
$MemberId          = (isset($res['MemberId'])) ? $res['MemberId'] : '';
$MemberType        = (isset($res['MemberType'])) ? $res['MemberType'] : '';
$MemberName       = (isset($res['MemberName'])) ? $res['MemberName'] : '';
$MemberEmailId        = (isset($res['MemberEmailId'])) ? $res['MemberEmailId'] : '';
$MembePhone        = (isset($res['MembePhone'])) ? $res['MembePhone'] : '';
$MemberGender        = (isset($res['MemberGender'])) ? $res['MemberGender'] : '';
$MemberDob        = (isset($res['MemberDob'])) ? $res['MemberDob'] : '';
//$MemberJoiningDate        = (isset($res['MemberJoiningDate'])) ? $res['MemberJoiningDate'] : '';
$MemberPassword        = (isset($res['MemberPassword'])) ? $res['MemberPassword'] : '';
$MemberAddress        = (isset($res['MemberAddress'])) ? $res['MemberAddress'] : '';
$MemberActiveStatus          = (isset($res['MemberActiveStatus'])) ? $res['MemberActiveStatus'] : '';
$created = date('Y-m-d H:i:s');


// REGISTER USER
if (isset($_POST['reg_member'])) 
{

    //var_dump($_POST);


    // receive all input values from the form
    $MemberId          = mysqli_real_escape_string($db, $_POST['MemberId']);
    $MemberType        = mysqli_real_escape_string($db, $_POST['MemberType']);
    $MemberName        = mysqli_real_escape_string($db, $_POST['MemberName']);
    $MemberEmailId        = mysqli_real_escape_string($db, $_POST['MemberEmailId']);
    $MembePhone          = mysqli_real_escape_string($db, $_POST['MembePhone']);
    $MemberGender        = mysqli_real_escape_string($db, $_POST['MemberGender']);
    $MemberDob         = mysqli_real_escape_string($db, $_POST['MemberDob']);
    //$MemberJoiningDate        = mysqli_real_escape_string($db, $_POST['MemberJoiningDate']);
    $MemberPassword          = mysqli_real_escape_string($db, $_POST['MemberPassword']);
    $MemberAddress        = mysqli_real_escape_string($db, $_POST['MemberAddress']);
    $MemberActiveStatus          = mysqli_real_escape_string($db, $_POST['MemberActiveStatus']);

    if (empty($MemberType)) { array_push($errors, "MemberType is required"); }
    if (empty($MemberName)) { array_push($errors, "MemberName is required"); }
    if (empty($MemberEmailId)) { array_push($errors, "MemberEmailId is required"); }
    if (empty($MembePhone)) { array_push($errors, "MembePhone is required"); }
    if (empty($MemberDob)) { array_push($errors, "MemberDob is required"); }
    //if (empty($MemberPassword)) { array_push($errors, "MemberPassword is required"); }

    // if ($password_1 != $password_2) {
    //   array_push($errors, "The two passwords do not match");
    // }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) 
    {
        if($MemberId)
        {
            $query = "UPDATE members SET MemberType = '$MemberType', MemberName = '$MemberName', MemberEmailId = '$MemberEmailId', MembePhone = '$MembePhone', MemberGender = '$MemberGender', MemberDob = '$MemberDob', MemberAddress = '$MemberAddress', MemberActiveStatus = '$MemberActiveStatus', created = '$created'";

            if($MemberPassword)
            {
                $MemberPassword = sha1($MemberPassword);
                $query .= ", MemberPassword = '$MemberPassword'";
            }

            $query .= " WHERE MemberId = '".$MemberId."'";

            // echo $query;

            // exit();
            
        }
        else
        {
            $MemberPassword = sha1($MemberPassword);

            $query = "INSERT INTO members (MemberType, MemberName, MemberEmailId, MembePhone, MemberGender, MemberDob, MemberPassword, MemberAddress,  MemberActiveStatus, created) 
            VALUES('$MemberType', '$MemberName', '$MemberEmailId', '$MembePhone', '$MemberGender', '$MemberDob', '$MemberPassword', '$MemberAddress', '$MemberActiveStatus', '$created')";
        }

        mysqli_query($db, $query);
        $_SESSION['success'] = "member has been saved.";
        header('location: member.php');
    }
}
?>

<div class="adminbox-right" id="page-wrapper">
    <div class="container-fluid">
        <div class="flex-box bg-title">
            <div class="flex-box_left">
                <h4 class="page-title">Member</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Member</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Member <?php echo (isset($_GET['id'])) ? 'Edit' : 'Add' ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php include('errors.php'); ?>

                        <form action="" id="composeMailForm" method="post" class="ajax-form form-material form-horizontal form-bordered">

                            <input type="hidden" name="MemberId" value="<?php echo $MemberId ?>">
                            <input type="hidden" name="reg_member" value="1">
                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberName :</label>
                                <div class="controls">
                                    <input type="text" name="MemberName" value="<?php echo $MemberName ?>" class="uneditable-input">
                                </div>
                            </div>


                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberType :</label>
                                <div class="controls">
                                    <select name="MemberType" class="uneditable-input">
                                        <option value="1" <?php echo ($MemberType == 1) ? 'selected' : '' ?>>Admin</option>
                                        <option value="2" <?php echo ($MemberType == 2) ? 'selected' : '' ?>>User</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Member EmailId :</label>
                                <div class="controls">
                                    <input type="text" name="MemberEmailId" value="<?php echo $MemberEmailId ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MembePhone :</label>
                                <div class="controls">
                                    <input type="text" name="MembePhone" value="<?php echo $MembePhone ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberGender :</label>
                                <div class="controls">
                                    <select name="MemberGender" class="uneditable-input">
                                        <option value="1" <?php echo ($MemberType == 1) ? 'selected' : '' ?>>Male</option>
                                        <option value="2" <?php echo ($MemberType == 2) ? 'selected' : '' ?>>Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberDob :</label>
                                <div class="controls">
                                    <input type="text" name="MemberDob" value="<?php echo $MemberDob ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberPassword :</label>
                                <div class="controls">
                                    <input type="text" name="MemberPassword" value="<?php echo $MemberPassword ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberAddress :</label>
                                <div class="controls">
                                    <input type="text" name="MemberAddress" value="<?php echo $MemberAddress ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">MemberActiveStatus :</label>
                                <div class="controls">
                                    <select name="MemberActiveStatus" class="uneditable-input">
                                        <option value="1" <?php echo ($MemberActiveStatus == 1) ? 'selected' : '' ?>>Active</option>
                                        <option value="0" <?php echo ($MemberActiveStatus == 0) ? 'selected' : '' ?>>De-Active</option>
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