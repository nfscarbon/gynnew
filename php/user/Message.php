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
                <h4 class="page-title">Message</h4>
            </div>
            <div class="flex-box_right">
                <ol class="breadcrumb">
                    <li>Main Menu</li>
                    <li class="active">Message</li>
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
                            <?php if($_SESSION['logged_user']['MemberType'] == 1) { ?>
                                <a href="message_form.php" class="caption-helper" style="float: right">Add Message</a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="box-body flip-scroll">

                        <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">title</th>
                                    <th scope="col">Member Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $check_query = "SELECT * FROM messages"; $result = mysqli_query($db, $check_query); ?>
                                    <?php //if (mysqli_num_rows($result) > 1)  { ?>
                                        <?php while ($res = mysqli_fetch_array($result)) { ?>

                                            <?php
                                            $member_query = "SELECT MemberName FROM members WHERE MemberId = ".$res['memberid'];
                                            $member_result = mysqli_query($db, $member_query);
                                            $member = mysqli_fetch_assoc($member_result);
                                            ?>

                                            <tr>
                                                <td scope="row"><?php echo $res['id'] ?></td>
                                                <td><?php echo $res['title'] ?></td>
                                                <td><?php echo $member['MemberName'] ?></td>
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
                                                    <a href="message_form.php?id=<?php echo $res['id'] ?>">Edit</a>
                                                    <?php }else{ ?>
                                                    <a href="message_form.php?id=<?php echo $res['id'] ?>">View</a>
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