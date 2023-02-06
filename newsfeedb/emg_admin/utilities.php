<?php include 'inc/header.php'; ?>


<!-- Page Content -->
<div id="page-content-wrapper">

    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>Utilities</small></p>
    <a href="index.php"><button class="btn btn-default white-bg">Make New Post</button></a>
    <hr color="#fff" style="height:2px;">
    <h3 class="page-header">Enter Website Utilities</h3>

    <!--start of entry form-->

    <div class="col-lg-8">

        <h2 class="page-header">Enter Social Media Handles</h2>

        <?php
        if(isset($_POST['submit']))
        {
            $facebook = $_POST['facebook'];
            $twitter = $_POST['twitter'];
            $google = $_POST['google'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $addr = $_POST['addr'];

            $db->enter_utilities($facebook, $twitter, $google, $phone, $email, $addr);

        }
        ?>
        <form method="post">

        <div class="form-group">
            <label for="facebook">Facebook Handle <i class="fa fa-facebook-square"></i></label>
            <input type="text" name="facebook" class="form-control" value="<?php $db->get_util('fbk'); ?>">
        </div>

        <div class="form-group">
            <label for="twitter">Twitter Handle <i class="fa fa-twitter-square"></i></label>
            <input type="text" name="twitter" class="form-control" value="<?php $db->get_util('twiter'); ?>">
    </div>


        <div class="form-group">
            <label for="google">Google Plus <i class="fa fa-google-plus-official"></i></label>
            <input type="text" name="google" class="form-control" value="<?php $db->get_util('google'); ?>">
            </div>


        <div class="form-group">
            <label for="phone">Phone Numbers <small>(Multiple phone numbers are permitted)</small><i class="fa fa-phone-square"></i></label>
            <input type="text" name="phone" class="form-control" value="<?php $db->get_util('phone'); ?>">
        </div>

            <div class="form-group">
                <label for="Email">Company Email Address <i class="fa fa-envelope-square"></i></label>
                <input type="email" name="email" id="email" class="form-control" value="<?php $db->get_util('email'); ?>">
            </div>

        <div class="form-group">
            <label for="Address">Address <i class="fa fa-map-marker"></i></label>

            <textarea name="addr" class="form-control"><?php $db->get_util('address'); ?></textarea>
            </div>


            <br/>
        <div class="form-group">
            <button class="btn btn-primary sharp-corners pull-right" name="submit">SUBMIT</button>
            </div>

        </form>
    <!--End of col-lg-8-->
    </div>


<?php include 'inc/footer.php';  ?>
