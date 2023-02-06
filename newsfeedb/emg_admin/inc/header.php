<?php
session_start();
/*Checking for db  existence*/
if(!file_exists('config.php')){
    echo"<script>window.location='register.php'</script>";

}else {

    include_once 'config.php';

    if (!$db->is_logged() != "") {

        $db->redirect('login.php');

    }
}

$user_id = $_SESSION['user_session'];
$stmt = $db->runQuery("SELECT * FROM emg_meta WHERE id = :user_id");
$stmt->execute(array(":user_id" => $user_id));
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="icon" href="img/icon.jpg">
    <title><?php $db->get_title(); ?></title>

    <!--IE Compatibility modes-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--Mobile first-->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!--Custom styles-->
    <link href="css/style.css" rel="stylesheet">
    <!-- Custom Fon+ts -->
    <link rel="stylesheet" href="css/roykusemererwa.css">

    <link href="css/simple-sidebar.css" rel="stylesheet">


    <link rel="stylesheet" href="css/assets/css/bootstrap3-wysihtml5.css">

    <link rel="stylesheet" href="css/AdminLTE.min.css">

    <link rel="stylesheet" href="css/select2.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="js/script.js" type="text/javascript"></script>
    <script src="js/jquery.js" type="text/javascript"></script>
    <script src="js/bootstrap.min.js" type="text/javascript"></script>
    <script src="js/upload-script.js"></script>

</head>


<body style="background: #F1F1F1; font-family:open sans;">

<div id="wrapper">

    <!-- Sidebar -->
    <div id="sidebar-wrapper" style="background:#222D32; margin-top:-45px;">
        <ul class="sidebar-nav" id="sidebar-nav">
            <br><br>

            <li>
                <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>


            <li>
                <a href="all-posts.php"><i class="fa fa-list"></i> All Posts</a>
            </li>

			
			<li>
                <a href="Podcast.php"><i class="fa fa-files-o"></i> Podcast</a>
            </li>
			
			<li>
                <a href="all-podcast.php"><i class="fa fa-files-o"></i>All Podcast</a>
            </li>
			
			<li>
                <a href="all-site.php"><i class="fa fa-files-o"></i>No Of  site Visits</a>
            </li>
			
           <li>
                <a href="all-betvisit.php"><i class="fa fa-files-o"></i>Sports Bet Visits</a>
            </li>
			
           

            <?php
            //Access rights
            if($userRow['admin_level'] != "Main_Admin")
            {
            }else {
                ?>
                <li>
                    <a href="users.php" class="dropmenu"><i class="fa fa-users"></i> Users</a>
                </li>
                <?php
            }
            ?>

<!--
			
            <li>
                <a href="all-pages.php"><i class="fa fa-files-o"></i> All Pages</a>
            </li>

			 <li>
                <a href="messages.php"><i class="fa fa-envelope"></i>
                    Messages &nbsp&nbsp
                    <span class="pull-right-container">
              <span class="label label-danger">
                  <?php
                  $status = 0;
                  $stmt = $db->runQuery("SELECT COUNT(*) AS cmsg FROM emg_messages WHERE status = :status");
                  $stmt->execute([":status"=>$status]);
                  while($rows = $stmt->fetch()):
                      echo $rows['cmsg'];
                  endwhile;
                  ?>
              </span>
            </span>

                </a>
            </li>

            <li>
                <a href="utilities.php"><i class="fa fa-globe"></i> Utilities</a>
            </li>


            <li>
                <a href="plugins.php"><i class="fa fa-plug"></i> Plugins</a>
            </li>
			
			 <li>
                <a href="all_users.php"><i class="fa fa-users"></i> Jaguzza Users</a>
            </li>


            <li>
                <a href="#"><i class="fa fa-file-image-o"></i> All Media</a>
            </li>



            <li>
                <a href="#"><i class="fa fa-gears"></i> Plugins</a>
            </li>
            -->

        </ul>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="height:50px;background:#3C8DBC;border:1px solid #3C8DBC;">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">


                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background:#222222;">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a href="#menu-toggle" id="menu-toggle" class="hover_underline" style="margin-left:100px; color:#fff; font-size:19px; font-family:'Source Sans Pro';"><i class="fa fa-bars"></i> <?php $db->get_title(); ?></a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right" id="upper_nav">

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Roles </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Utilities </a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $userRow['admin_uname']; ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="#">My Profile</a>
                            </li>
                            <li>
                                <a href="edit-profile.php?user=<?php echo $user_id; ?>">Edit Profile</a>
                            </li>
                            <li>
                                <a href="users.php">Register New User</a>
                            </li>
                            <li>
                                <a href="logout.php">Logout</a>
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

