<?php include 'inc/header.php'; ?>



<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:-20px;">

    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>All Applicants</small></p>
    <a href="index.php"><button class="btn btn-default">Make New Post</button></a>
    <hr color="#fff" style="height:2px;">
    <h3>Applicants</h3>
    <div class="container-fluid">
        <div class="row">



            <?php
            //operation to update database with given action
                $action = $_GET['action'];
            $id = $_GET['idea'];
            try {
                $stmt = $db->runQuery("UPDATE razico_idea SET status = :status WHERE id = :id");
                $stmt->bindValue(":status", $action);
                $stmt->bindValue(":id", $id);
                $stmt->execute();
                ?>
                <div class="alert alert-success">
                    <strong>Success!</strong>
                    <p>The Idea was successfully <?php echo $_GET['action']; ?></p>
                </div>

                <?php
            } catch (PDOException $err)
            {
                ?>
                <div class="alert alert-danger">
                    <strong>System Error!</strong>
                    <p>An Error Occured while Operating</p>
                    <?php echo $err->getMessage(); ?>
                    <small><br/>Contact Admin to diagnose this error</small>
                </div>
            <?php


            }
            ?>

            </div>
        </div>

    <a href="applicants.php" class="btn btn-primary"><< GO BACK</a>
    </div>

<?php include 'inc/footer.php'; ?>
