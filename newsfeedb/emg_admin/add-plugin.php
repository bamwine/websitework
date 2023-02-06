<?php include 'inc/header.php'; ?>

<!-- Page Content -->
<div id="page-content-wrapper">



    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Add a plugin</p>

<?php
if(isset($_POST['submit']))
{
    $fname = $db->validate($_POST['fname'], 'Author Full Name');
    $plugin_name = $db->validate($_POST['plugin_name'], 'Plugin Name');
    $plugin_image = $_FILES['plugin_image'];
    $plugin_details = $db->validate($_POST['plugin_details'], 'Plugin Details Field');
    $db->enter_plugin ($plugin_name, $plugin_details, $plugin_image, $fname);
}
?>

    <hr color="#fff" style="height:2px;">

    <form method="post" enctype="multipart/form-data">

    <div class="container-fluid">

        <div class="col-lg-12"  style="background:#fff; min-height:550px;">

            <h3 class="page-header">Author Full Name</h3>
            <div class="form-group">
                <input type="text" name="fname" id="fname" class="form-control input-lg" placeholder="Enter your Name..."/>
            </div>


            <h3 class="page-header">Plugin Image / Logo</h3>

            <div class="form-group">
                <input type="file" name="plugin_image" id="plugin_image class="form-control">
            </div>
            <!--
            <div style="position:relative;">
                <a class='btn btn-primary' href='javascript:;'>
                    Choose File...
                    <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file_source" size="90"  onchange='$("#upload-file-info").html($(this).val());'>
                </a>
                <br/>
                <span class='label label-info' id="upload-file-info" name="file_name"></span>
            </div>
-->
            <hr/>

            <h3 class="page-header">Plugin Name:</h3>
            <small>Make sure Plugin_Name is similar to the class attached to it (No space allowed in the name)</small>
            <div class="form-group">
                <input type="text" name="plugin_name" id="plugin_name" class="form-control input-lg" placeholder="Enter Plugin Name.."/>
            </div>


            <h3 class="page-header">What does your plugin do</h3>
            <textarea id="wysihtml5" name="plugin_details" class="form-control sharp-corners" rows="10" style="width:100%;" placeholder="Enter Plugin Details"></textarea>


<br/>

            <div class="form-group">
                <button class="btn btn-primary pull-right text-uppercase sharp-corners" name="submit">Submit</button>
            </div>
            </div>

        </form>

        </div>

    </div>


<?php include 'inc/footer.php'; ?>
