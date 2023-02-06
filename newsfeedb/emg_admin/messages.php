<?php
include 'inc/header.php';
?>

<!-- Page Content -->
<div id="page-content-wrapper">

    <h1 class="page-header">Admin Panel</h1>
    <hr color="#fff" style="height:2px;">

    <h2><i class="fa fa-envelope-o"></i> All Messages</h2>
    <p>Please Reply to these messages using your official email addresses</p>
    <p><a href="messages.php" class="active">New</a> | <a href="all-messages.php">All</a></p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12"  style="background:#fff;">

                <br>
                <style>
                    b{
                        color:black;
                    }
                </style>
                <!--Recording visits on product-->
                <script>
                    function seen(msgid)
                    {

                        var hostname = '<?php $db->get_site('hostname'); ?>';

                        document.getElementById("statusx").innerHTML = "<img src='img/loader12.gif'> Marking..";

                        var xhttp;

                        if (window.XMLHttpRequest) {
                            xhttp = new XMLHttpRequest();
                        } else {
                            // code for IE6, IE5
                            xhttp = new ActiveXObject("Microsoft.XMLHTTP");
                        }
                        xhttp.onreadystatechange = function () {
                            if (xhttp.readyState == 4 && xhttp.status == 200) {
                                document.getElementById("statusx").innerHTML = xhttp.responseText;
                            }
                        };
                        xhttp.open("GET", hostname+"/emg_admin/seen.php?msgid="+msgid,
                            true);
                        xhttp.send();

                    }
                </script>
                <!--End of visits recorder-->

                <?php
                $status = 0;
                $stmt = $db->runQuery( "SELECT * FROM emg_messages WHERE status = :status ORDER BY id DESC" );
                $stmt->execute([":status"=>$status]);
                while($rows = $stmt->fetch()):
                ?>
                <div class="panel sharp-corners light-shadow">
                    <div class="panel-heading border-bottom" style="background:#F1F1F1;">
                        <i class="fa fa-envelope-o"></i> <b><?php echo $rows['fullname']; ?></b> Sent you a Message
                    </div>
                    <div class="panel-body">

                        <b class="bold">Name:</b> <?php echo $rows['fullname']; ?><br/>
                        <b>Reply to:</b> <?php echo $rows['email']; ?><br/>
                        <b>Phone Number:</b> <?php echo $rows['phone']; ?><br/>
                        <b>Time Sent:</b> <?php $db->friendly_date($rows['dater']); ?> <small>(<?php $db->timeago($rows['dater']); ?>)</small>
                        <br/>
                        <b>Message:</b>
                        <br/>
                        <?php echo $rows['message']; ?>

                        <br/>
                        <button id="statusx" class="btn btn-primary sharp-corners" onclick="seen(<?php echo $rows['id']; ?>)">
                            Mark As Seen
                        </button>
                    </div>
                </div>
                    <?php
                    endwhile;
                    ?>


</div>

            </div>

        </div>

    </div>

<?php include 'inc/footer.php'; ?>