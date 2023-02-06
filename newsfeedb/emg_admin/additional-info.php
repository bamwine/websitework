<?php include 'inc/header.php';?>

<!-- Page Content -->
<div id="page-content-wrapper">

    <h1 class="page-header">Additional Information</h1>
    <hr color="#fff" style="height:2px;">


    <?php
    $id = $_GET['id'];
    if(isset($_POST['submit'])){

        //adding images

        $j = 0; //Variable for indexing uploaded image

        $target_path = "uploads/"; //Declaring Path for uploaded images
        for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array

            $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
            $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.)
            $file_extension = end($ext); //store extensions in the variable

            $target_path = $target_path . md5(uniqid()) . "." . $ext[count($ext) - 1];//set the target path with a new name of image
            $j = $j + 1;//increment the number of uploaded images according to the files in array

            if (($_FILES["file"]["size"][$i] < 1000000000000) //Approx. 100kb files can be uploaded.
                && in_array($file_extension, $validextensions)
            ) {
                if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                    echo $j . ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';


                    //uploadinng the images to the database
                    $upload = $db->runQuery("INSERT INTO emg_post_images (postid, img)VALUES(:random_id, :image_name)");
                    $upload->bindValue(":random_id", $id);
                    $upload->bindValue(":image_name", $target_path);
                    $upload->execute();





                } else {//if file was not moved.
                    echo $j . ').<span id="error">please try again!.</span><br/><br/>';
                }
            } else {//if file size and file type was incorrect.
                echo $j . ').<span id="error">***Invalid file Size or Type***</span><br/><br/>';
            }
        }

    }
    ?>


    <form method="post" enctype="multipart/form-data">


        <div class="panel panel-default sharp-corners">

            <div class="panel-heading">
                <i class="fa fa-bars"></i> Listing Images
            </div>

            <div class="panel-body">
                <!--Start of Upload section-->
                <div id="maindiv">

                    <div id="formdiv">

                        First Two images will be shown. First Field is Compulsory. Only JPEG,PNG,JPG Type Image Uploaded. Image Size Should Be Less Than 100KB.

                        <div id="filediv"><input name="file[]" type="file" id="file"/></div><br/>

                        <input type="button" id="add_more" class="upload" value="Add More Files"/>


                        <br/>
                        <br/>

                    </div>


                </div>
                <!--End of Upload Section-->
</div>
            </div>

                <button class="btn btn-primary sharp-corners" name="submit">SUBMIT INFO</button>
    </form>
    </div>

<?php include 'inc/footer.php'; ?>
