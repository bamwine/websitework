<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome to SiteMine!</title>

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
        <h3>Create Your Project</h3>
    </div>


    <div class="panel panel-default">

        <div class="panel-body">
            <div class="page-header text-center"><h2>Enter Database Credentials</h2></div>

            <?php
            error_reporting('0');
            if(isset($_POST['submit'])) {
                $dbname = $_POST['db_name'];
                $server_name = $_POST['server_name'];
                $db_uname = $_POST['db_uname'];
                $db_password = $_POST['db_password'];

//Creating config file and writing values to it
                $file = fopen("config.php", "w");
                echo fwrite($file, "<?php
                \n

/*
 * Config file
 * First create the database before initiating @SiteMine
 * Include all db_connection details in this file
 * db_connection @params
 * @db_host
 * @db_username
 * @db_ pass
 * @db_name
 */


\$db_host = \"$server_name\";

\$db_username = \"$db_uname\";

\$db_pass = \"$db_password\";

\$db_name = \"$dbname\";


/*
 * We connect to the database
 * using the given @params
 *
 */

\$con = new PDO(\"mysql:host={\$db_host};dbname={\$db_name}\", \$db_username, \$db_pass);

\$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

/**
 * Here we include the class that is going to use
 * this config file to operate
 *
 * The class that has all the processes which is the db class
 */

require_once 'inc/class.SM.php';

/**
 * Then we instantiate a new object of the class db
 * with null @params
 */

\$db = new SM(\$con);
");
                ?>
                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <strong>Great!</strong>
                </div>
                <?php

                fclose($file);


                //Another File for installing sitemine
                if (file_exists('install.php')) {
                    $file = fopen('install.php', 'r+');
                    $new_content = "<?php
     
\$db_host = \"$server_name\";

\$db_username = \"$db_uname\";

\$db_pass = \"$db_password\";

\$db_name = \"$dbname\";

try {       
\$con = new PDO(\"mysql:host={\$db_host};dbname={\$db_name}\", \"\$db_username\", \"\$db_pass\");

\$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    \$posts = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_posts(id int(255) PRIMARY KEY NOT  NULL AUTO_INCREMENT, post_ID int(255) NOT NULL, post_title varchar(255) NOT  NULL, post_content text, post_image varchar(255) NOT  NULL, post_category varchar(255) NOT NULL, page_id varchar(255) NOT NULL, post_url varchar(255) NOT NULL, dater varchar(255) NOT NULL, status varchar(255) NOT NULL, author varchar(255) NOT NULL )\" );
    \$posts->execute();
    
    \$pages = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_pages(id int(255) PRIMARY KEY NOT  NULL AUTO_INCREMENT, post_title varchar(255) NOT  NULL, post_content text, author varchar(255) NOT NULL, status varchar(255) NOT NULL, dater varchar(255) NOT NULL )\" );
    \$pages->execute();

    \$project_meta = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_meta(id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, hostname varchar(255) NOT NULL, p_name varchar(255) NOT NULL, admin_email varchar(255) NOT NULL, admin_uname varchar(255) NOT NULL, admin_password varchar(255) NOT NULL, admin_fname varchar(255) NOT NULL, admin_level varchar(255) NOT NULL, admin_profile_pic varchar(255) NOT NULL, dater  varchar(255) NOT NULL, admin_color varchar(255) NOT NULL )\" );
    \$project_meta->execute();
    
    \$project_contact = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_contact(id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, fbk varchar(255) NOT NULL, twiter varchar(255) NOT NULL, google varchar(255) NOT NULL, phone varchar(255) NOT NULL, email varchar(255) NOT NULL, address varchar(255) NOT NULL)\" );
    \$project_contact->execute();
    
    
    \$post_cats = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_post_cats(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, category varchar(255) NOT NULL)\" );
    \$post_cats->execute();
    
    \$post_tags = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_tags(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, tags varchar(255) NOT NULL)\" );
    \$post_tags->execute();
    
    \$post_tag_relate = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_post_tag_relate(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, tag varchar(255) NOT NULL, post_ID varchar(255) NOT NULL)\" );
    \$post_tag_relate->execute();
    
    \$plugins = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_plugins(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, plugin_name varchar(255) NOT NULL, plugin_details varchar(255) NOT NULL, plugin_image varchar(255) NOT NULL, fname varchar(255) NOT NULL, dater varchar(255) NOT NULL)\" );
    \$plugins->execute();
    
    \$more_fields = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_more_fields(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, fieldName varchar(255) NOT NULL)\" );
    \$more_fields->execute();
    
    \$field_details = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_field_details(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, postID int(255) NOT NULL, fieldID varchar(255) NOT NULL, Detail varchar(255) NOT NULL)\" );
    \$field_details->execute();
    
    \$messages = \$con->prepare( \"CREATE TABLE IF NOT EXISTS emg_messages(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, fullname varchar(255) NOT NULL, phone varchar(255) NOT NULL, email varchar(255) NOT NULL, message varchar(255) NOT NULL, dater varchar(255) NOT NULL, status varchar(255) NOT NULL)\" );
    \$messages->execute();
   
    
} catch (PDOException \$err)
{
echo \$err->getMessage();
}

echo'<link href=\"css/bootstrap.min.css\" rel=\"stylesheet\"><br/><link href=\"css/roykusemererwa.css\" rel=\"stylesheet\">';
 echo'
<div class=\"panel panel-default center-block\" style=\"width:500px;\">
    <div class=\"panel-body\">
<h2>Great! <br>You are now good to go!!</h2>
        <h4>We officially welcome you to SiteMine</h4>
        <a href=enter_admin.php><button class=\"btn btn-info\">Start Now</button></a>
    </div>
</div>
<img src=\"img/logo.png\" class=\"img-responsive center-block fade in\" style=\"width:35%;\">
';
";
                    $old_content = file_get_contents($file);
                    echo fwrite($file, $new_content . $old_content);

                    ?>

                    <a href="install.php"><button class='btn btn-success'>Run The Install</button></a>

                    <?php
                    fclose($file);
                } else {
                    echo "Error! Failed to populate Install File";
                }

            }

            ?>


            <form action="register.php" method="post">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="database_name">Database Name:</label>
                        <input type="text" class="form-control" name="db_name">
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="server_name">Server Name:</label>
                        <input type="text" class="form-control" name="server_name" value="localhost">
                    </div>

                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Database Username:</label>
                        <input type="text" class="form-control" name="db_uname">
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="username">Database Password:</label>
                        <input type="text" class="form-control" name="db_password">
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
</body>
</html>
