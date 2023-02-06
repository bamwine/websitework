<?php
session_start();

/*Checking for db  existence*/
if(!file_exists('config.php')){
    echo"<script>window.location='register.php'</script>";
}
require_once 'config.php';

if($db->is_logged() != "")
{
    $db->redirect('index.php');
}

if(isset($_POST['login_submit']))
{

    $uname = filter_var($_POST['txt_uname_email'], FILTER_VALIDATE_EMAIL);
    $umail = filter_var($_POST['txt_uname_email'], FILTER_VALIDATE_EMAIL);
    $pass = $_POST['txt_uname_password'];

     
    if($db->login($uname,$umail,$pass))
    {
        $db->redirect('index.php');

    }else{
        $error = "Wrong Details !";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php $db->get_title(); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

<img src="img/logo.png" class="img-circle center-block" style="width:10%; margin-top:20px; box-shadow:2px 2px 2px 2px #ccc; border:0px solid gray;">

<div class="centered">

    <div class="page-header text-center">
        <h2>Login</h2>
    </div>

    <?php
    if(isset($error))
    {
   ?>
        <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error! </strong>
    Invalid Login Details!
    </div>
    <?php
    }
    ?>
<form action="login.php" method="post">

    <div class="panel panel-default" style="width:400px;">

        <div class="panel-body">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email Address:</label>
                    <input type="email" name="txt_uname_email" class="form-control" id="email>
                </div>

            </div>


            <div class="col-md-12">
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="txt_uname_password" id="password">
                </div>

            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-primary" name="login_submit" style="margin-left:-14px;">SUBMIT</button>
                </div>

            </div>
</div>
        </div>
    </div>
        </div>
</form>




    <p class="text-center">
        &copy; SiteMine <?php echo date('Y'); ?>
        <br />
        <small>A Product Of Evolution Media Group Uganda</small>
    </p>

</body>
</html>
