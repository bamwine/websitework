
    public function enter_pod ($post_title, $post_content, $post_image, $post_category, $page, $status, $author, $tags, $new_tag, $fieldname, $fieldvalue)
    {

//checking if the title of this post already exists
$c = self::runQuery("SELECT post_title FROM emg_videos WHERE post_title = :post_title");
$c->execute([":post_title"=>$post_title]);
if($c->rowCount() > 0){
?>
<div class="alert alert-info sharp-corners">
<strong>Sorry Entry Failed!</strong>
<p>Another post with this title already exists, please try to change the title and then post.
Also update your Category, tags and Image. Thanks!
</p>
</div>

<?php

}else{
        //receiving the image file
        $filename = basename($post_image["name"]);
        $imageFileType = pathinfo($filename, PATHINFO_EXTENSION);
        // Allow certain file formats
        if ($imageFileType != "ogg" && $imageFileType != "mp3" && $imageFileType != "mp4"
            && $imageFileType != "gif" && $imageFileType != "awv"

        ) {
            ?>
            <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error!</strong>
                Sorry, only awv, mp3, mp4 & ogg files are allowed.
            </div>
            <?php
        } else {
            $rand = rand(0, 999999999);
            $ext = substr($filename, strrpos($filename, '.'));
            $ppx = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);
            $f_filename = $ppx . '-' . $rand . '' . $ext;
            $target_dir = "uploads/";
            $target_file = $target_dir . $f_filename;
            move_uploaded_file($post_image["tmp_name"], $target_file);
            $path = "uploads/" . $f_filename . "";
            $dater = date("Y-m-d H:i:s");

            $post_url = self::php_slug($post_title);
            $post_ID = rand(0, 9999999999);

            try {
                $stmt = self::runQuery("INSERT INTO emg_videos(post_ID, post_title, post_content, post_image, post_category, page_id, post_url, dater, status, author)
                                                             VALUES(:post_ID, :post_title, :post_content, :post_image, :post_category, :page_id,  :post_url, :dater, :status, :author)");

                $stmt->bindValue(":post_title", $post_title);
                $stmt->bindValue(":post_ID", $post_ID);
                $stmt->bindValue(":post_content", $post_content);
                $stmt->bindValue(":post_image", $path);
                $stmt->bindValue(":post_category", $post_category);
                $stmt->bindValue(":page_id", $page);
                $stmt->bindValue(":post_url", $post_url);
                $stmt->bindValue(":dater", $dater);
                $stmt->bindValue(":status", $status);
                $stmt->bindValue(":author", $author);
                $stmt->execute();

                if(!empty($tags)){
                //entering tags for this particular post
                foreach ($tags AS $tg):
                $s = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $s->bindValue(":tag", $tg);
                $s->bindValue(":post_id", $post_ID);
                $s->execute();
                endforeach;
                }

                if(!empty($new_tag)){
                //introducing  new tag
                $n = self::runQuery( "INSERT INTO emg_tags(tags) VALUES(:tag)" );
                $n->bindValue(":tag", $new_tag);
                $n->execute();

                //another transaction to enter the new_tag into the relate table also if all of them are available
                $t = self::runQuery( "INSERT INTO emg_post_tag_relate(tag, post_ID) VALUES(:tag, :post_id)" );
                $t->bindValue("tag", $new_tag);
                $t->bindValue(":post_id", $post_ID);
                $t->execute();
                }


                //entering the additioanl data
                for($i=0, $count = count($fieldname);$i<$count;$i++) {
                    $fName  = $fieldname[$i];
                    $fvalue = $fieldvalue[$i];

                   /* echo $fName;
                    echo "-";
                    echo $fvalue;
                   */
                    $ff = self::runQuery( "INSERT INTO emg_field_details (postID, fieldID, Detail) VALUES(:postid, :fieldid, :detail)" );
                    $ff ->bindValue(":postid", $post_ID);
                    $ff->bindValue(":fieldid", $fName);
                    $ff->bindValue(":detail", $fvalue);
                    $ff->execute();
                }

 ?>

                <div class='alert alert-success' style="border-radius: inherit; border-left:3px solid green;">
                    <strong>Success!</strong>
                    Post successfully created.
     <br/>
     <!--<a href="additional-info.php?id=<?php //echo $post_ID; ?>">Add More Information</a>-->

                </div>
                <?php
                return $stmt;

            } catch (PDOException $err) {
                ?>
                <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Admin Error! </strong>
                    <?php
                    echo $err->getMessage();

                    ?>
                </div>

                <?php

            }

        }
    }
}

 