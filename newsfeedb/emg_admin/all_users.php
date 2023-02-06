<?php include 'inc/header.php'; ?>



<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:-20px;">
 <h1 class="page-header">JAGUZA USERS</h1>
   <table class="table-responsive table-striped" style="width:100%; border-left:1px solid #CCCCCC; height:;">
    <tr style="border:1px solid #CCCCCC; height:40px;">
        <th>Name</th>
        <th>Email</th>
        <th>Activated</th>
        <th>Last Modified</th>
    </tr>
    <?php
    $query = "SELECT * FROM users WHERE activated = '1' ORDER BY id DESC";
	$s = $db->runQuery($query); 
   //$s->execute();
					$s->setFetchMode(PDO::FETCH_ASSOC);
					While($rows = $s->fetch()):
    ?>
	
	<tr style="border:1px solid #CCCCCC; height:40px;">
        <th><?php  Echo $rows['full_name']; ?></th>
        <th><?php  Echo $rows['email']; ?></th>
        <th><?php  Echo $rows['activated']; ?></th>
        <th><?php echo date('M j Y g:i A', strtotime($rows['modified'])) ?></th>
    </tr>
	
	<?php   
		Endwhile;
				?>
</table>
    </div>

<?php include 'inc/footer.php'; ?>
