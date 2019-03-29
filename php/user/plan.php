<?php include('header.php') ?>
<?php 
if (!isset($_SESSION['logged_user'])) 
{
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
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
                            <span class="caption-subject font-dark bold uppercase">List</span>
                            <a href="slot_form.php" class="caption-helper" style="float: right">Add Plan</a>
                        </div>
                    </div>
                    <div class="box-body flip-scroll">

                        <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Plan Name</th>
                                    <th scope="col">Plan Price</th>
                                    <th scope="col">Plan Duration</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $user_check_query = "SELECT * FROM plan"; $result = mysqli_query($db, $user_check_query); ?>
                                <?php while ($res = mysqli_fetch_array($result)) { ?>
                                    <tr>
                                        <th scope="row"><?php echo $res['PlanId'] ?></th>
                                        <td><?php echo $res['PlanName'] ?></td>
                                        <td><?php echo $res['PlanPrice'] ?></td>
                                        <td><?php echo $res['PlanDuration'] ?></td>
                                        <td>
                                            <?php 
                                            if($res['status'] == 1) {
                                                echo "Active";
                                            }else{
                                                echo "De-Active";
                                            } 
                                            ?>
                                        </td>
                                        <td><?php echo $res['created'] ?></td>
                                        <td>
                                            <a href="plan_form.php?plan_id=<?php echo $res['PlanId'] ?>">Edit</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<?php include('footer.php') ?>