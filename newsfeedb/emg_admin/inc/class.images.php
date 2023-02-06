<?php

class img extends SM {

    /**
     * This class enables the manipulation of images like
     * Watermarking
     * Resize
     * changing image file extensions
     *
     */


    /**
     * The PHP GD library extension is used for manipulation of Images on your server
     * This function will check if the GD library exists on your server in order to have theses function work
     */

    public function check_GD ()
    {
        if(extension_loaded('gd') && function_exists('gd_info')){
            //echo "PHP GD library is installed on your server";
            //GD Exists
        }else{
            echo "<font color='red'>An Extension neccesary for image manipulation is missing on your server";
            echo "<br/>Check this link for installation instructions: http://php.net/manual/en/image.installation.php";
            echo "</font>";
        }
    }


    /**
     * @param $width
     * @param $height
     * @return string
     * function to resize image to sepcified width and height
     */
    public function resize ($width, $height)
    {
        //get the original image x, y
        list ($w, $h) = getimagesize($_FILES['image']['tmp_name']);
        //calculate new image size with ratio
        $ratio = max($width/$w, $height/$h);
        $h = ceil($height / $ratio);
        $x = ($w - $width / $ratio) / 2;
        $w = ceil($width / $ratio);

        //new file name
        $path = 'uploads/'.$width.'x'.$height.'_'.$_FILES['image']['name'];
        //read binary data from image file
        $imgString = file_get_contents($_FILES['image']['tmp_name']);
        //create image from string
        $image = imagecreatefromstring($imgString);
        $tmp = imagecreatetruecolor($width, $height);
        imagecopyresampled($tmp, $image,
            0, 0,
            $x, 0,
            $width, $height,
            $w, $h);
        //save image

        switch($_FILES['image']['type'])
        {
            case 'image/jpeg';
                imagejpeg($tmp, $path, 100);
                break;
            case 'image/png';
                imagepng($tmp, $path, 0);
                break;
            case 'image/gif';
                imagegif($tmp, $path);
                break;
            default;
                exit;
                break;
        }

        return $path;

        //cleanup memory
        imagedestroy($image);
        imagedestroy($tmp);

    }

    /**
     * @param $image
     * function to watermark any image
     */
    public function watermark ($imager)
    {
        $image_name = $imager["name"]; //file name
        $image_size = $imager["size"]; //file size
        $image_temp = $imager["tmp_name"]; //file temp
        $image_type = $imager["type"]; //file type

        $max_size = 800; //max image size in Pixels
        $destination_folder = 'uploads/';
        //watermark should be width: 281px and height: 92px
        $watermark_png_file = 'watermark.png'; //path to watermark image

        switch(strtolower($image_type)){ //determine uploaded image type
            //Create new image from file
            case 'image/png':
                $image_resource =  imagecreatefrompng($image_temp);
                break;
            case 'image/gif':
                $image_resource =  imagecreatefromgif($image_temp);
                break;
            case 'image/jpeg': case 'image/pjpeg':
            $image_resource = imagecreatefromjpeg($image_temp);
            break;
            default:
                $image_resource = false;
        }

        if($image_resource){
            //Copy and resize part of an image with resampling
            list($img_width, $img_height) = getimagesize($image_temp);

            //Construct a proportional size of new image
            $image_scale        = min($max_size / $img_width, $max_size / $img_height);
            $new_image_width    = ceil($image_scale * $img_width);
            $new_image_height   = ceil($image_scale * $img_height);
            $new_canvas         = imagecreatetruecolor($new_image_width , $new_image_height);

            //Resize image with new height and width
            if(imagecopyresampled($new_canvas, $image_resource , 0, 0, 0, 0, $new_image_width, $new_image_height, $img_width, $img_height))
            {

                if(!is_dir($destination_folder)){
                    mkdir($destination_folder);//create dir if it doesn't exist
                }

                //calculate center position of watermark image
                $watermark_left = ($new_image_width/2)-(300/2); //watermark left
                $watermark_bottom = ($new_image_height/2)-(100/2); //watermark bottom

                $watermark = imagecreatefrompng($watermark_png_file); //watermark image

                //use PHP imagecopy() to merge two images.
                imagecopy($new_canvas, $watermark, $watermark_left, $watermark_bottom, 0, 0, 300, 100); //merge image

                //output image direcly on the browser.
                //header('Content-Type: image/jpeg');
                //imagejpeg($new_canvas, NULL , 90);

                //Or Save image to the folder
                imagejpeg($new_canvas, $destination_folder.'/'.$image_name , 90);

                //free up memory
                imagedestroy($new_canvas);
                imagedestroy($image_resource);
                die();
            }
        }

    }
}