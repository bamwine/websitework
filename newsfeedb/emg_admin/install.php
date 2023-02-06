<?php
     
$db_host = "localhost";

$db_username = "root";

$db_pass = "";

$db_name = "football";

try {       
$con = new PDO("mysql:host={$db_host};dbname={$db_name}", "$db_username", "$db_pass");

$con -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
    $posts = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_posts(id int(255) PRIMARY KEY NOT  NULL AUTO_INCREMENT, post_ID int(255) NOT NULL, post_title varchar(255) NOT  NULL, post_content text, post_image varchar(255) NOT  NULL, post_category varchar(255) NOT NULL, page_id varchar(255) NOT NULL, post_url varchar(255) NOT NULL, dater varchar(255) NOT NULL, status varchar(255) NOT NULL, author varchar(255) NOT NULL )" );
    $posts->execute();
    
    $pages = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_pages(id int(255) PRIMARY KEY NOT  NULL AUTO_INCREMENT, post_title varchar(255) NOT  NULL, post_content text, author varchar(255) NOT NULL, status varchar(255) NOT NULL, dater varchar(255) NOT NULL )" );
    $pages->execute();

    $project_meta = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_meta(id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, hostname varchar(255) NOT NULL, p_name varchar(255) NOT NULL, admin_email varchar(255) NOT NULL, admin_uname varchar(255) NOT NULL, admin_password varchar(255) NOT NULL, admin_fname varchar(255) NOT NULL, admin_level varchar(255) NOT NULL, admin_profile_pic varchar(255) NOT NULL, dater  varchar(255) NOT NULL, admin_color varchar(255) NOT NULL )" );
    $project_meta->execute();
    
    $project_contact = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_contact(id int(255) NOT NULL PRIMARY KEY AUTO_INCREMENT, fbk varchar(255) NOT NULL, twiter varchar(255) NOT NULL, google varchar(255) NOT NULL, phone varchar(255) NOT NULL, email varchar(255) NOT NULL, address varchar(255) NOT NULL)" );
    $project_contact->execute();
    
    
    $post_cats = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_post_cats(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, category varchar(255) NOT NULL)" );
    $post_cats->execute();
    
    $post_tags = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_tags(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, tags varchar(255) NOT NULL)" );
    $post_tags->execute();
    
    $post_tag_relate = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_post_tag_relate(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, tag varchar(255) NOT NULL, post_ID varchar(255) NOT NULL)" );
    $post_tag_relate->execute();
    
    $plugins = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_plugins(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, plugin_name varchar(255) NOT NULL, plugin_details varchar(255) NOT NULL, plugin_image varchar(255) NOT NULL, fname varchar(255) NOT NULL, dater varchar(255) NOT NULL)" );
    $plugins->execute();
    
    $more_fields = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_more_fields(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, fieldName varchar(255) NOT NULL)" );
    $more_fields->execute();
    
    $field_details = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_field_details(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, postID int(255) NOT NULL, fieldID varchar(255) NOT NULL, Detail varchar(255) NOT NULL)" );
    $field_details->execute();
    
    $messages = $con->prepare( "CREATE TABLE IF NOT EXISTS emg_messages(id int(255) PRIMARY KEY NOT NULL AUTO_INCREMENT, fullname varchar(255) NOT NULL, phone varchar(255) NOT NULL, email varchar(255) NOT NULL, message varchar(255) NOT NULL, dater varchar(255) NOT NULL, status varchar(255) NOT NULL)" );
    $messages->execute();
   
    
} catch (PDOException $err)
{
echo $err->getMessage();
}

echo'<link href="css/bootstrap.min.css" rel="stylesheet"><br/><link href="css/roykusemererwa.css" rel="stylesheet">';
 echo'
<div class="panel panel-default center-block" style="width:500px;">
    <div class="panel-body">
<h2>Great! <br>You are now good to go!!</h2>
        <h4>We officially welcome you to SiteMine</h4>
        <a href=enter_admin.php><button class="btn btn-info">Start Now</button></a>
    </div>
</div>
<img src="img/logo.png" class="img-responsive center-block fade in" style="width:35%;">
';
