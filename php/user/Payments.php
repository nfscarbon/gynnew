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
                <h4 class="page-title">Payment</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Payment</li>
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
                        </div>
                    </div>
                    <div class="box-body flip-scroll">

                        <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $check_query = "SELECT SubscriptionId, MemberId, SlotId, PlanID, DateStart, DateEnd, Amount, status, created FROM subscription"; 
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
                                                <td><?php echo $res['Amount'] ?></td>
                                                <td><?php echo $res['created'] ?></td>
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