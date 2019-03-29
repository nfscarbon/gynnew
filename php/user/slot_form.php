<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

$id =  (isset($_GET['id'])) ? $_GET['id'] : 0;

if($id)
{
    $user_check_query = "SELECT * FROM slots WHERE id = '".$id."'"; $result = mysqli_query($db, $user_check_query);
    $res = mysqli_fetch_assoc($result);
}


// receive all input values from the form
$id          = (isset($res['id'])) ? $res['id'] : '';
$name        = (isset($res['name'])) ? $res['name'] : '';
$SlotStartTiming       = (isset($res['SlotStartTiming'])) ? $res['SlotStartTiming'] : '';
$SlotEndTiming        = (isset($res['SlotEndTiming'])) ? $res['SlotEndTiming'] : '';
$status          = (isset($res['status'])) ? $res['status'] : '';
$created = date('Y-m-d H:i:s');


// REGISTER USER
if (isset($_POST['reg_slot'])) 
{

    //var_dump($_POST);


    // receive all input values from the form
    $id          = mysqli_real_escape_string($db, $_POST['id']);
    $name        = mysqli_real_escape_string($db, $_POST['name']);
    $SlotStartTiming       = mysqli_real_escape_string($db, $_POST['SlotStartTiming']);
    $SlotEndTiming        = mysqli_real_escape_string($db, $_POST['SlotEndTiming']);
    $status          = mysqli_real_escape_string($db, $_POST['status']);

    if (empty($name)) { array_push($errors, "name is required"); }
    if (empty($SlotStartTiming)) { array_push($errors, "SlotStartTiming is required"); }
    if (empty($SlotEndTiming)) { array_push($errors, "SlotEndTiming is required"); }
    //if (empty($PlanDuration)) { array_push($errors, "PlanDuration is required"); }
    //if (empty($status)) { array_push($errors, "status is required"); }

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) 
    {
        if($id)
        {
            $query = "UPDATE slots SET name = '$name', SlotStartTiming = '$SlotStartTiming', SlotEndTiming = '$SlotEndTiming', status = '$status', created = '$created' WHERE id = '".$id."'";
            
        }
        else
        {
            $query = "INSERT INTO slots (name, SlotStartTiming, SlotEndTiming, status, created) 
            VALUES('$name', '$SlotStartTiming', '$SlotEndTiming', '$status', '$created')";
        }

        mysqli_query($db, $query);
        $_SESSION['success'] = "Slots has been saved.";
        header('location: slot.php');
    }
}
?>

<div class="adminbox-right" id="page-wrapper">
    <div class="container-fluid">
        <div class="flex-box bg-title">
            <div class="flex-box_left">
                <h4 class="page-title">Slot</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Slot</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Slot <?php echo (isset($_GET['id'])) ? 'Edit' : 'Add' ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php include('errors.php'); ?>

                        <form action="" id="composeMailForm" method="post" class="ajax-form form-material form-horizontal form-bordered">

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="reg_slot" value="1">
                            <div class="control-group">
                                <label for="textfield" class="control-label">Name :</label>
                                <div class="controls">
                                    <input type="text" name="name" value="<?php echo $name ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Slot Start Timing :</label>
                                <div class="controls">
                                    <input type="text" name="SlotStartTiming" value="<?php echo $SlotStartTiming ?>" class="uneditable-input">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Slot End Timing :</label>
                                <div class="controls">
                                    <input type="text" name="SlotEndTiming" value="<?php echo $SlotEndTiming ?>" class="uneditable-input">
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