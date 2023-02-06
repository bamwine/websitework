<?php include 'inc/header.php'; ?>



<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:20px;">
<!-- Page Content -->
<div id="page-content-wrapper">

	<p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>Delete Admin</small></p>
	
	<hr color="#fff" style="height:2px;">
	<?php $db->delete_admin ($_GET['user']); ?>

	<button class="btn btn-success"><a class="white-chars" href="users.php">GO BACK</a></button>
</div>

	</div>


