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
                    <h4 class="page-title">Subscriptions</h4>
                </div>
                <div class="flex-box_right">
                    <ol class="breadcrumb">
                        <li>Main Menu</li>
                        <li class="active">Subscriptions</li>
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
                                <a href="subscription_form.php" class="caption-helper" style="float: right">Add Member</a>
                            </div>
                        </div>
                        <div class="box-body flip-scroll">

                            <table class="table table-bordered table-striped table-condensed flip-content">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Member Name</th>
                                        <th scope="col">Slot</th>
                                        <th scope="col">Plan</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    $check_query = ''   ;
                                    if($_SESSION['logged_user']['MemberId']!=1){
                                    $check_query = "SELECT SubscriptionId, MemberId, SlotId, PlanID, DateStart, DateEnd, Amount, status, created FROM subscription where  MemberId = ".$_SESSION['logged_user']['MemberId']; }else{
                                        $check_query = "SELECT SubscriptionId, MemberId, SlotId, PlanID, DateStart, DateEnd, Amount, status, created FROM subscription";
                                    }
                                    $result = mysqli_query($db, $check_query); 
                                    ?>
                                        <?php //if (mysqli_num_rows($result) > 1)  { ?>
                                            <?php while ($res = mysqli_fetch_array($result)) { ?>
                                                <?php
                                                $plan_query = "SELECT PlanName FROM plan WHERE PlanId = ".$res['PlanID'];
                                                $plan_result = mysqli_query($db, $plan_query);
                                                $plan = mysqli_fetch_assoc($plan_result);

                                                $member_query = "SELECT MemberName FROM members WHERE MemberId = ".$res['MemberId'];
                                                $member_result = mysqli_query($db, $member_query);
                                                $member = mysqli_fetch_assoc($member_result);


                                                $slot_query = "SELECT name FROM slots WHERE id = ".$res['SlotId'];
                                                $slot_result = mysqli_query($db, $slot_query);
                                                $slot = mysqli_fetch_assoc($slot_result);
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo $res['SubscriptionId'] ?></th>
                                                    <td><?php echo $member['MemberName'] ?></td>
                                                    <td><?php echo $slot['name'] ?></td>
                                                    <td><?php echo $plan['PlanName'] ?></td>
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
                                                        <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                                        <a href="subscription_form.php?SubscriptionId=<?php echo $res['SubscriptionId'] ?>">Edit</a>
                                                        <?php } else { ?>
                                                        <a href="subscription_form.php?SubscriptionId=<?php echo $res['SubscriptionId'] ?>">View</a>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        <?php //} ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>



        </div>
    </div>
<?php include('footer.php') ?>