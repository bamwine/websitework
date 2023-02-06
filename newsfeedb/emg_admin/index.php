<?php
include 'inc/header.php';
error_reporting (0);
?>


<script>function pu () {document.getElementById('load').innerHTML="<img src='img/loader2.gif'>";}</script>
<script type="text/javascript">
    document.getElementById("setpage").addEventListener("focus", hyphenate)
    function hyph()
    {
        var host = "<?php $db->get_site('hostname'); ?>";
        var title = document.getElementById('title').value;
        var comp = title.replace(/\s/g, "-");
        document.getElementById('displax').innerHTML = "POST PATH: <i><u>"+host+"/"+comp+"</u></i>";
    }
</script>
<script type="text/javascript">
    
</script>
<!-- Page Content -->
<div id="page-content-wrapper">



    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Welcome to Admin Panel</p>

    
    <hr color="#fff" style="height:2px;">

    <h2>Create New Post</h2>

    <div class="container-fluid">

        <div class="col-lg-8"  style="background:#fff; min-height:550px;">
            <br>

            <?php
            $post_title = $post_content;
            if(isset($_POST['publish'])) {

                $post_title = trim($_POST['post_title']);
                $post_content = trim($_POST['post_content']);
                $post_image = $_FILES['fileUpload'];
                $post_category = $_POST['post_category'];
                $page = $_POST['post_page'];
//getting the additional info values
                $fieldname = $_POST['fieldname'];
                $fieldvalue = $_POST['fieldvalue'];



                $author = $_POST['post_owner'];
                if(empty($author)) {
                    $author = $userRow['admin_uname'];
                }
                $tags =  $_POST['tag'];
                $new_tag = $_POST['new_tag'];
                $status = "publish";
                $filename = basename($post_image["name"]);

                if(empty($post_content))
                {
                    ?>

                    <div class='alert alert-danger fade in'
                         style="border-radius: inherit; border-left:3px solid red;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong>
                        Please Enter Some details about your post!
                    </div>
                    <?php
                }
                else if(empty($post_title))
                {

                    ?>

                    <div class='alert alert-danger fade in'
                         style="border-radius: inherit; border-left:3px solid red;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong>
                        Please Provide a Post Title!
                    </div>
                    <?php
                }
                //checking if the image exists
                else if (empty($filename)) {
                    ?>
                    <div class='alert alert-danger fade in' style="border-radius: inherit; border-left:3px solid red;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong>
                        The Image Field is empty!
                    </div>
                    <?php
                } else {
                    //checking if the post_category is empty
                    if ($post_category == "--Choose category--") {
                        //receive new category
                        $new_cat = $_POST['new_category'];
                        /*Entering the values into the db*/
                        $db->enter($post_title, $post_content, $post_image, $new_cat, $page, $status, $author, $tags, $fieldname ,$fieldvalue);
                        $db->enter_cat($new_cat);

                    } else {

                        /*Entering the values into the db*/
                        $db->enter($post_title, $post_content, $post_image, $post_category,  $page, $status, $author, $tags, $new_tag, $fieldname ,$fieldvalue);
                        //We wait for response from process
                    }
                }
            }

            ?>

            <form action="index.php" method="post" enctype="multipart/form-data">
                <h2>Title</h2>
                <div class="form-group">

                    <input type="text"  style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;" class="form-control input-lg" id="title" name="post_title" placeholder="Enter Title Here" value="<?php echo $post_title; ?>">
                    <div id="displax"></div>
                </div>

                <h3>Details / Specifications</h3>
                <!--New Editor-->

                <textarea id="wysihtml5" name="post_content" class="form-control sharp-corners" rows="10" style="width:100%;"><?php echo $post_content; ?></textarea>


                <br>
                <!--End of New Editor-->



                <?php
                if($userRow['admin_level'] != "Main_Admin")
                {
                }else {
                ?>
                <div class="panel panel-default sharp-corners">
                    <div class="panel-heading sharp-corners">
                        <h3 class="panel-title">CHANGE POST OWNER</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <select name="post_owner" class="form-control">
                                <option><?php echo $userRow['admin_uname']; ?></option>
                                <?php
                                $stmt = $db->runQuery ( "SELECT admin_uname FROM emg_meta" );
                                $stmt->execute([":admin_uname"=>$admin_uname]);
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                while($rows = $stmt->fetch()):

                                    ?>
                                    <option><?php echo $rows['admin_uname']; ?></option>
                                    <?php
                                endwhile;
                                ?>

                            </select>

                            
                        </div>

                    </div>
                </div>
                <!--End of panel-->

<?php } ?>

                <div class="panel panel-default sharp-corners">
                    <div class="panel-heading sharp-corners">
                        <h3 class="panel-title">Additional Info</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        //getting the additional fields
                        $s = $db->runQuery( "SELECT * FROM emg_more_fields" );
                        $s->execute();
                        $s->setFetchMode(PDO::FETCH_ASSOC);
                        if($s->rowCount() < 1){
                            echo "<b class='text-primary'>**No extra fields found**</b><br/><br/>";
                            ?>
                            <a href="add-more-fields.php" class="btn btn-primary">
                                <i class="fa fa-plus-circle"></i> Add More Fields
                            </a>
                            <br/>
                            The added fields will apply to all posts
                            <?php

                        }else{
                            while($re = $s->fetch()):
                            ?>
                                <div class="border-bottom space-up" style="height:46px;">
                                    <div style="margin-top:5px;">
                            <div class="form-group col-md-6" style="font-size:16px;">
                                <input type="text" name="fieldname[]" id="fieldname" class="form-control sharp-corners no-border" value="<?php echo ucwords($re['fieldName']); ?>" readonly style="background:#fff;">
                            </div>

                            <div class="form-group col-md-6">
                                <input type="text" name="fieldvalue[]" id="fieldValue" class="form-control sharp-corners">
                            </div>
                                    </div>
                            </div>

                                <a href="add-more-fields.php" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> Add More Fields
                                </a>
                                <br/>
                                The added fields will apply to all posts
                            <?php
                            endwhile;
                        }

                        ?>

                        </div>

                </div>




        </div>
        <!--End of first division-->








        <!--Begin second division--->

        <div class="col-lg-4">

        <div class="col-md-12">

            <p style="font-size:20px; font-weight:bold;">SAVE YOUR POST</p>
            <div class="panel panel-default" style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-weight:bold;">SAVE POST</h3>
                </div>
                <div class="panel-body">
                    <button class="btn btn-primary"  style="border-radius: inherit; width:100%;" name="publish" onclick="pu()">PUBLISH POST</button>
                    <div id="load"></div>
                    <!--<br><br>
					<button class="btn btn-warning"  style="width:100%; -webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;" name="draft">SAVE DRAFT</button>
-->
                    <hr/>
                    <div class="form-group">
                        <h4>Set Page</h4>
                        <select name="post_page" id=setpage" onchange="hyph()" class="form-control" style="border-radius: inherit;">
                            <option>--Choose Page Where post will Appear--</option>
                            <option>Home</option>
                            <option>About</option>

                            <?php
                            $stmt = $db->runQuery( "SELECT post_title FROM emg_pages ORDER BY id DESC" );

                            $stmt->execute();

                            $stmt->setFetchMode(PDO::FETCH_ASSOC);

                            while($r = $stmt->fetch()):

                                ?>
                                <option><?php echo $r['post_title'];  ?></option>
                                <?php


                            endwhile;
                            ?>

                        </select>
                    </div>

                </div>
            </div>
        </div>
        <!--/-End of col-md-->

        <div class="col-md-12">

            <div class="panel panel-default" style="border-radius: inherit;">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-weight:bold;">CATEGORY</h3>
                </div>
                <div class="panel-body" style="overflow-y:scroll;">
                    <select name="post_category" class="form-control" style="border-radius: inherit;" id="cat" onchange="disable()">
                        <option>--Choose category--</option>
                        <?php
                        $get = $db->runQuery("SELECT category FROM emg_post_cats");

                        $get->execute();

                        $get->setFetchMode(PDO::FETCH_ASSOC);

                        while($r = $get->fetch()):
                            echo"<option>";
                            echo htmlspecialchars($r['category']);
                            echo"</option>";

                        endwhile;

                        ?>
                    </select>
                    <br>
                    <a href="#" style="text-decoration: underline;"><i class="fa fa-plus"></i> Add New Category</a>

                    <input type="text" id="new" onclick="note()" class="form-control" name="new_category" style="border-radius: inherit;">
                    <div id="small_note"></div>

                </div>
            </div>
            

            <div class="panel panel-default  sharp-corners">
                <div class="panel-heading sharp-corners">
                    <h3 class="panel-title bold">TAGS</h3>
                </div>
                <div class="panel-body">
                        <div class="form-group">
                            <select id="tag"  name="tag[]" class="form-control select2 sharp-corners" onclick="tag_disable()" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                                <?php
                                $stmt = $db->runQuery ( "SELECT tags FROM emg_tags" );
                                $stmt->execute();
                                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                                while($rows = $stmt->fetch()):
                                    ?>
                                        <option><?php echo $rows['tags']; ?></option>
                                <?php
                                endwhile;
                                ?>
                            </select>


                            <br><br/>
                            <a href="#" style="text-decoration: underline;"><i class="fa fa-plus"></i> Add New Tag</a>

                            <input type="text" id="new_tag" class="form-control sharp-corners" name="new_tag">


                    </div>
                </div>
        </div>
        <!--/-End of col-md-->



            <div class="panel panel-default sharp-corners">
                <div class="panel-heading">
                    <h3 class="panel-title" style="font-weight:bold;">UPLOAD AN IMAGE</h3>
                </div>

                <div class="panel-body" style="overflow: hidden;">

                    <input id="fileUpload" type="file" name="fileUpload" class="upload" onclick="preview()">

                    <div>
                        <p id="profile_pic" style="width:100%;">Upload Image</p>
                    </div>
                    <!--/--Checkbox-->

                </div>





</div>



            <a href="#">Thanks for using <u>Sitemine</u> beta Version</a>
            <a class="facebookBtn smGlobalBtn" href="social-media-profile-url" ></a>
            <a class="twitterBtn smGlobalBtn" href="social-media-profile-url" ></a>
            <a class="googleplusBtn smGlobalBtn" href="social-media-profile-url" ></a>
            <a class="pinterestBtn smGlobalBtn" href="social-media-profile-url" ></a>
            <a class="linkedinBtn smGlobalBtn" href="social-media-profile-url" ></a>
        </div>


        </div>

        <!--End of second division-->




    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

</form>



<?php include 'inc/footer.php'; ?>


