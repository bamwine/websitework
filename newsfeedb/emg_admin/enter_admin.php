<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to SiteMine!!</title>

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

<div class="centered">

    <div class="page-header">
        <h2>SiteMine</h2>
    </div>


    <div class="panel panel-default">

        <div class="panel-body">
            <div class="page-header text-center"><h2>Enter Project Admin Credentials</h2></div>

            <?php
            if(isset($_POST{'submit'}))
            {
                $p_name = $_POST['p_name'];
                $admin_email = $_POST['admin_email'];
                $admin_uname = $_POST['admin_username'];
                $admin_password = md5($_POST['admin_password']);

//Site Path
            $sys_folder = dirname($_SERVER['PHP_SELF']);
            preg_match('!/([^/]+)/[^/]*$!', $sys_folder, $matches);
            $site_path =  "http://" . $_SERVER['HTTP_HOST'] .'/'.$matches[1];

                
                $db->enter_admin ($site_path, $p_name, $admin_email, $admin_uname, $admin_password);
            }
            ?>


            <form action="enter_admin.php" method="post">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="project_name">Project Name:</label>
                        <input type="text" class="form-control" name="p_name">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="admin_type">Admin Email:</label>
                        <input type="text" class="form-control" name="admin_email">
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Admin Username:</label>
                        <input type="text" class="form-control" name="admin_username">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Admin Password:</label>
                        <input type="text" class="form-control" name="admin_password">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <button class="btn btn-primary" name="submit">SUBMIT</button>
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
</div>
</body>
</html>
