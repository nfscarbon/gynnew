﻿<?php include('header.php') ?>
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
                            <span class="caption-subject font-dark bold uppercase">List</span>
                            <a href="slot_form.php" class="caption-helper" style="float: right">Add Slot</a>
                        </div>
                    </div>
                    <div class="box-body flip-scroll">

                        <table class="table table-bordered table-striped table-condensed flip-content">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Slot Start Timing</th>
                                    <th scope="col">Slot End Timing</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $check_query = "SELECT * FROM slots"; $result = mysqli_query($db, $check_query); ?>
                                    <?php //if (mysqli_num_rows($result) > 1)  { ?>
                                        <?php while ($res = mysqli_fetch_array($result)) { ?>
                                            <tr>
                                                <th scope="row"><?php echo $res['id'] ?></th>
                                                <td><?php echo $res['name'] ?></td>
                                                <td><?php echo $res['SlotStartTiming'] ?></td>
                                                <td><?php echo $res['SlotEndTiming'] ?></td>
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
                                                    <a href="slot_form.php?id=<?php echo $res['id'] ?>">Edit</a>
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