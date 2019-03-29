<div class="adminbox-right" id="page-wrapper">
    <div class="container-fluid">
        <div class="flex-box bg-title">
            <div class="flex-box_left">
                <h4 class="page-title">Dashboard</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Dashboard</li>
                </ol>
            </div>
            <!-- /.col-lg-12 -->
        </div>

        <div class="row">

            <div class="col-lg-3 col-sm-6 col-xs-12">
                <div class="white-box analytics-info">
                    <h3 class="box-title">Total Amount Paid</h3>
                    <ul class="list-inline two-part">
                        <?php 
                        $check_query = "SELECT SUM(Amount) AS total_amount FROM subscription WHERE MemberId = '".$_SESSION['logged_user']['MemberId']."' "; 
                        $result = mysqli_query($db, $check_query); 
                        ?>
                        <?php $res = mysqli_fetch_assoc($result)?>

                        <li class="text-right"><i class="fa fa-usd text-success"></i><span class="counter text-success"><?php echo $res['total_amount'] ?></span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Due Payments</span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="box-body flip-scroll">

                        <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div> -->

        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Subscriptions</span>
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
                                $check_query = "SELECT SubscriptionId, MemberId, SlotId, PlanID, DateStart, DateEnd, Amount, status, created FROM subscription WHERE MemberId = '".$_SESSION['logged_user']['MemberId']."' "; 
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
        <div class="row">
            <div class="col-md-12">
                <div class="white-box">
                    <div class="box-title">
                        <div class="caption ">
                            <span class="caption-subject font-dark bold uppercase">Notification</span>
                            <span class="caption-helper"></span>
                        </div>
                    </div>
                    <div class="box-body flip-scroll">
                        <ul class="Ntfcton-listing-ul">

                            <?php $check_query = "SELECT * FROM messages WHERE memberid = '".$_SESSION['logged_user']['MemberId']."'"; 
                            $result = mysqli_query($db, $check_query); ?>

                            <?php while ($res = mysqli_fetch_array($result)) { ?>

                                <?php
                                $member_query = "SELECT MemberName FROM members WHERE MemberId = ".$res['memberid'];
                                $member_result = mysqli_query($db, $member_query);
                                $member = mysqli_fetch_assoc($member_result);
                                ?>

                                <li>
                                    <div class="Ntfcton-listing-disptn">
                                        <p><?php echo $res['message'] ?>.</p>
                                    </div>
                                    <div class="Ntfcton-listing-time-check">
                                        <span><?php echo date('d/m/Y h:iA', strtotime($res['created'])) ?></span>
                                    </div>
                                </li>

                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>