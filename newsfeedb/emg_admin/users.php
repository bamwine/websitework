<?php include 'inc/header.php'; ?>

<!-- Page Content -->
<div id="page-content-wrapper">

	<p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>Create New Admin</small></p>
	<a href="index.php"><button class="btn btn-default">Make New Post</button></a>
	<hr color="#fff" style="height:2px;">
	<h3 class="page-header">Create New Admin</h3>


<?php

if(isset($_POST['submit']))
{

    $admin_level = $_POST['admin_level'];
    $fname = $_POST['e_fname'];
    $e_email = filter_var($_POST['e_email'], FILTER_VALIDATE_EMAIL);
    $uname = $_POST['e_uname'];
    $pwd = md5($_POST['e_pwd']);
    $pic = $_FILES['profile_pic'];


    if(empty($fname) || empty($e_email) || empty($uname) || empty($pwd))
    {
        ?>

        <div class="alert alert-danger error-msg">
            <strong>Error!</strong>
            <p>Empty Field or email Anomally detected, please enter all data and a correct email address</p>
        </div>
            <?php

    }else {
        //proccessing of form begins
        $db->enter_user ($admin_level, $fname, $e_email, $uname, $pwd, $pic);
    }

}

?>


	<div class="panel panel-purple sharp-corners light-shadow">
        <div class="panel-heading sharp-corners" style="background:#3C8DBC; color:#fff;"> <i class="fa fa-list"></i> Enter New Admin Details</div>
		<div class="panel-body">

				<img src="img/placeholder2.png" class="img-circle col-lg-5" style="width:130px; height:100px;">

			<form method="post" class="col-lg-10" enctype="multipart/form-data">
		<div class="form-group col-lg-4">
			<label for="FullName">Admin Level</label>
			<select name="admin_level" class="form-control">
				<option>Main_Admin</option>
				<option>Editor</option>
				<option>Publisher</option>
			</select>
		</div>


		<div class="form-group col-lg-4">
		<label for="FullName">Full Name</label>
			<input type="text" name="e_fname" class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="FullName">Email Address</label>
			<input type="text" name="e_email" class="form-control">
		</div>


		<div class="form-group col-lg-4">
			<label for="username">Username</label>
			<input type="text" name="e_uname" class="form-control">
		</div>

		<div class="form-group col-lg-4">
			<label for="password">Password</label>
			<input type="password" name="e_pwd" class="form-control">
		</div>


		<div class="form-group col-lg-4">
			<label for="profile_pic">Profile Pic</label>
			<input type="file" name="profile_pic" class="form-control">
		</div>



				<div class="form-group col-lg-4">
					<button class="btn btn-primary sharp-corners" name="submit">SUBMIT</button>
				</div>



		</div>
		</form>


	</div>

    <!--End of panel-->



    <h2 class="page-header">Admins List</h2>

    <div class="panel sharp-corners light-shadow">

        <div class="panel-heading sharp-corners" style="background:#3C8DBC; color:#fff;"> <i class="fa fa-list"></i> ALL USERS</div>

        <div class="panel-body">
    <?php
    $stmt = $db->runQuery ( "SELECT * FROM emg_meta" );
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    while($rows = $stmt->fetch()):

        $uname = $rows['admin_uname'];
    ?>

        <div class="col-md-4">
            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">

                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-<?php echo $rows['admin_color']; ?>">
                    <div class="widget-user-image">
                        <img class="img-circle" src="<?php echo $rows['admin_profile_pic']; ?>" alt="User Avatar" style="width:60px; height:60px;">
                    </div>

                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username"><?php echo $rows['admin_fname']; ?></h3>
                    <h5 class="widget-user-desc"><?php echo $rows['admin_level']; ?></h5>
                </div>
                <br>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">Posts <span class="pull-right badge bg-blue"><?php $db->count_item ('emg_posts', 'author', $uname); ?></span></a></li>
                        <li><a href="delete_admin.php?user=<?php echo $rows['id']; ?>" class="underline">Delete Profile</a></li>
                    </ul>
                </div>
            </div>
            <!-- /.widget-user -->
        </div>

<!--End of user-row-->
<?php
endwhile;
 ?>

        </div>
    </div>

    </div>



<?php include 'inc/footer.php'; ?>