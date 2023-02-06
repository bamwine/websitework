<?php include 'inc/header.php'; ?>
<div id="page-content-wrapper" style="margin-top:-20px;">


    <h3 class="page-header">Watermark Image</h3>

    <?php
    //checking if the GD image manipulation library exists on this server
  $image->check_GD();
    ?>
    
    <form action="" id="upload-form" method="post" enctype="multipart/form-data">
        <div class="form-group">
        <input type="file" name="image_file" id="image_file" class="form-control"/>
        <input type="submit" name="submit" value="Send Image" class="btn btn-primary"/>
            </div>
    </form>

    /**
    * -----INSTRUCTIONS----<br/>
    * Make sure you have a file called watermark.png in your emg_admin/ root folder<br/>
    * The watermark.png is the file with the watermark you want to be plaed on top of each image<br/>
    * The watermark.png file should be with dimensions width: 281px and Height:92px<br/>
    */
    <?php
    if(isset($_POST['submit']))
    {
        $imager = $_FILES['image_file'];
        $image->watermark($imager);
    }


    ?>

    </div>

<?php include 'inc/footer.php'; ?>