<?php include 'inc/header.php'; ?>

<!-- Page Content -->
<div id="page-content-wrapper">

	<p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>Create New Admin</small></p>
	<a href="index.php"><button class="btn btn-default white-bg">Make New Post</button></a>
	<hr color="#fff" style="height:2px;">
	<h3 class="page-header">Create New Admin</h3>


	<?php

	if(isset($_POST['submit']))
	{

		$admin_level = $_POST['admin_level'];
		$fname = $_POST['e_fname'];
		$e_email = $_POST['e_email'];
		$uname = $_POST['e_uname'];
		//$pwd = $_POST['e_pwd'];
		$pic = $_FILES['profile_pic'];
		$id = $_GET['user'];

		$db->edit_user($admin_level, $fname, $e_email, $uname, $pic, $id);

	}

	?>


	<div class="panel panel-purple sharp-corners light-shadow">
		<div class="panel-heading sharp-corners" style="background:#3C8DBC; color:#fff;"> <i class="fa fa-list"></i> Enter New Admin Details</div>
		<div class="panel-body">


			<img src="<?php $db->get_admin('admin_profile_pic', $_GET['user']); ?>" class="img-circle col-lg-5" style="width:130px; height:100px;">

			<form method="post" class="col-lg-10" enctype="multipart/form-data">
				<div class="form-group col-lg-4">
					<label for="FullName">Admin Level</label>
					<select name="admin_level" class="form-control">
						<option><?php $db->get_admin('admin_level', $_GET['user']); ?></option>
						<option>Main Admin</option>
						<option>Editor</option>
						<option>Publisher</option>
					</select>
				</div>


				<div class="form-group col-lg-4">
					<label for="FullName">Full Name</label>
					<input type="text" name="e_fname" class="form-control" value="<?php $db->get_admin('admin_fname', $_GET['user']); ?>">
				</div>

				<div class="form-group col-lg-4">
					<label for="FullName">Email Address</label>
					<input type="text" name="e_email" class="form-control" value="<?php $db->get_admin('admin_email', $_GET['user']); ?>">
				</div>


				<div class="form-group col-lg-4">
					<label for="username">Username</label>
					<input type="text" name="e_uname" class="form-control" value="<?php $db->get_admin('admin_uname', $_GET['user']); ?>">
				</div>

				<div class="form-group col-lg-4">
					<label for="password">Password</label>
					<input type="password" name="e_pwd" class="form-control">
				</div>


				<div class="form-group col-lg-4">
					<label for="profile_pic">Profile Pic</label>

					<input type="file" name="profile_pic" class="form-control">
					<small>This will replace current picture</small>
				</div>



				<div class="form-group col-lg-4">
					<button class="btn btn-primary sharp-corners" name="submit">SUBMIT</button>
				</div>



		</div>
		</form>


	</div>

	<!--End of panel-->

<?php include 'inc/footer.php'; ?>