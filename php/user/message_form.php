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
    $user_check_query = "SELECT * FROM messages WHERE id = '".$id."'"; $result = mysqli_query($db, $user_check_query);
    $res = mysqli_fetch_assoc($result);
}

//get All Members
$members_query = "SELECT * FROM members WHERE MemberActiveStatus = 1"; 
$members_queryresult = mysqli_query($db, $members_query);
//$members_res = mysqli_fetch_assoc($members_queryresult);


// receive all input values from the form
$id     = (isset($res['id'])) ? $res['id'] : '';
$memberid           = (isset($res['memberid'])) ? $res['memberid'] : '';
$title             = (isset($res['title'])) ? $res['title'] : '';
$message             = (isset($res['message'])) ? $res['message'] : '';
$status             = (isset($res['status'])) ? $res['status'] : '';
$created            = date('Y-m-d H:i:s');


// REGISTER USER
if (isset($_POST['reg_messages'])) 
{

    //var_dump($_POST);


    // receive all input values from the form
    $id  = mysqli_real_escape_string($db, $_POST['id']);
    $title          = mysqli_real_escape_string($db, $_POST['title']);
    $memberid        = mysqli_real_escape_string($db, $_POST['memberid']);
    $message          = mysqli_real_escape_string($db, $_POST['message']);
    $status          = mysqli_real_escape_string($db, $_POST['status']);

    if (empty($memberid)) { array_push($errors, "memberid is required"); }
    if (empty($title)) { array_push($errors, "title is required"); }
    if (empty($message)) { array_push($errors, "message is required"); }
    // if (empty($DateStart)) { array_push($errors, "DateStart is required"); }
    // if (empty($DateEnd)) { array_push($errors, "DateEnd is required"); }
    // if (empty($Amount)) { array_push($errors, "Amount is required"); }

    // var_dump($errors);

    // exit();

    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) 
    {

        if($id)
        {
            $query = "UPDATE messages SET title = '$title', memberid = '$memberid', message = '$message', status = '$status', created = '$created' WHERE id = '".$id."'";
            
        }
        else
        {
            $query = "INSERT INTO messages (title, memberid, message, status, created) 
            VALUES('$title', '$memberid', '$message', '$status', '$created')";
        }

        mysqli_query($db, $query);
        $_SESSION['success'] = "Message has been saved.";
        header('location: Message.php');
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
                            <span class="caption-subject font-dark bold uppercase">Subscription <?php echo (isset($_GET['id'])) ? 'Edit' : 'Add' ?></span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php include('errors.php'); ?>

                        <form action="" id="composeMailForm" method="post" class="ajax-form form-material form-horizontal form-bordered">

                            <input type="hidden" name="id" value="<?php echo $id ?>">
                            <input type="hidden" name="reg_messages" value="1">
                            <div class="control-group">
                                <label for="textfield" class="control-label">Title Name :</label>
                                <div class="controls">
                                    <input type="text" name="title" class="uneditable-input" value="<?php echo $title ?>" placeholder="Title">
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Member Name :</label>
                                <div class="controls">
                                    <select name="memberid" class="uneditable-input">
                                        <?php while ($members_res = mysqli_fetch_array($members_queryresult)) { ?>
                                            <option value="<?php echo $members_res['MemberId'] ?>" <?php echo ($members_res['MemberId'] == $memberid) ? 'selected' : '' ?>><?php echo $members_res['MemberName'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label for="textfield" class="control-label">Message :</label>
                                <div class="controls">
                                    <textarea type="text" name="message" class="uneditable-input" placeholder="message"><?php echo $message ?></textarea>
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

                            <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                <div class="control-group">
                                    <button type="submit" class="btn btn-success">Save</button>
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