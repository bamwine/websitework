<?php
include 'inc/header.php';
?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <h1 class="page-header">Admin Panel</h1>
        <hr color="#fff" style="height:2px;">
        <h2>All site Visits</h2>
        <p><a href="all-site.php" class="active">All</a> | Published | <a href="delete-podcast.php">Deleted</a></p>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12"  style="background:#fff;">

                    <br>


<table class="table-responsive table-striped" style="width:100%; border-left:1px solid #CCCCCC; height:;">
    <tr style="border:1px solid #CCCCCC; height:40px;">
        <th><words>No of Visits made today <?php
	echo date('y-m-d');?></words></th>
        
    </tr>
    <?php
	$kk=date('y-m-d');
    $query = "SELECT count(DISTINCT (post_content)) as work FROM emg_visit WHERE  date(dater) = '$kk' ORDER BY id DESC";
    
	$stmt = $db->runQuery($query);
	$stmt->execute();
    

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                     
                    <td> <b><?php echo $row['work']; ?></b></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>No visit yet, share the site</td>
            </tr>

            <?php
        } ?>

</table>


<br>

<table class="table-responsive table-striped" style="width:100%; border-left:1px solid #CCCCCC; height:;">
    <tr style="border:1px solid #CCCCCC; height:40px;">
        <th><words>Over Roll Visits</words></th>
        
    </tr>
    <?php
    $query = "SELECT count(DISTINCT (`post_content`)) as work FROM emg_visit ORDER BY id DESC";
    
	$stmt = $db->runQuery($query);
	$stmt->execute();
    

        if($stmt->rowCount()>0)
        {
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
                ?>
                <tr>
                     
                    <td> <b><?php echo $row['work']; ?></b></td>
                </tr>
                <?php
            }
        }
        else
        {
            ?>
            <tr>
                <td>No visit yet, share the site</td>
            </tr>

            <?php
        } ?>

</table>


</div>
                </div>
            </div>
        </div>



<?php include 'inc/footer.php'; ?>