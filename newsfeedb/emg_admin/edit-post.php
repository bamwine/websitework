<?php include 'inc/header.php'; ?>

    <!-- Page Content -->
    <div id="page-content-wrapper" style="margin-top:-20px;">

        <p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>Edit Post</small></p>
        <a href="index.php"><button class="btn btn-default">Make New Post</button></a>
        <hr color="#fff" style="height:2px;">
        <h3>Edit Post</h3>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8"  style="background:#fff; min-height:500px;">
                    <br>
                    <?php
                    if(isset($_POST['publish'])) {

                        $post_title = trim($_POST['post_title']);
                        $post_content = trim($_POST['post_content']);
                        $post_image = $_FILES['fileUpload'];
                        $post_category = $_POST['post_category'];
                        $post_id = $_GET['id'];
                        $author = $userRow['admin_uname'];
                        $status = "publish";
                        $filename = basename($post_image["name"]);

                        /*Updating the values in the db*/
                        $db->update_post($post_id, $post_title, $post_content, $post_image, $post_category, $status, $author);
                        //We wait for response from process

                    }

                    ?>

                    <form action="edit-post.php?id=<?php echo $_GET['id']; ?>" method="post" enctype="multipart/form-data">
                        <h3>Title</h3>
                        <div class="form-group">
                            <input type="text"  style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;" class="form-control input-lg" id="title" name="post_title" value="<?php $db->get_by_id ($_GET['id'], 'post_title'); ?>">
                        </div>

                        <h3>Details</h3>


                        <textarea id="wysihtml5" name="post_content" class="form-control" rows="10"><?php $db->get_by_id($_GET['id'], 'post_content');  ?></textarea>
                        <br>

                        <br/>
                        <a href="additional-info.php?id=<?php $db->get_by_id($_GET['id'], 'post_ID');  ?>"
                           class="underline">Add More Info</a>
                        <br/>
                </div>


                <div class="col-md-4">
                    <p style="font-size:20px; font-weight:bold;">SAVE YOUR POST</p>
                    <div class="panel panel-default" style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-weight:bold;">UPDATE POST</h3>
                        </div>
                        <div class="panel-body">
                            <button class="btn btn-primary"  style="border-radius: inherit; width:100%;" name="publish">UPDATE POST</button>
                            <!--<br><br>
							<button class="btn btn-warning"  style="width:100%; -webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;" name="draft">SAVE DRAFT</button>
							-->
                        </div>
                    </div>
                </div>
                <!--/-End of col-md-->

                <div class="col-md-4">

                    <div class="panel panel-default" style="border-radius: inherit;">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-weight:bold;">CATEGORY</h3>
                        </div>
                        <div class="panel-body" style="overflow-y:scroll;">
                            <select name="post_category" class="form-control" style="border-radius: inherit;" id="cat" onchange="disable()">

                                <option><?php $db->get_by_id($_GET['id'], 'post_category'); ?></option>
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
                </div>
                <!--/-End of col-md-->

                <div class="col-md-4">

                    <div class="panel panel-default" style="border-radius: inherit;">
                        <div class="panel-heading">
                            <h3 class="panel-title" style="font-weight:bold;">UPLOAD AN IMAGE</h3>
                        </div>

                        <div class="panel-body" style="overflow-y:scroll;">

                            <input id="fileUpload" type="file" name="fileUpload" class="upload" value="<?php $db->get_by_id($_GET['id'], 'post_image'); ?>" onclick="preview()">

                            <div style="border:0px solid gray; width:273px;height:200px;">
                                <p id="profile_pic" style="width:100%;">Upload Image</p>
                                <img src="<?php $db->get_by_id($_GET['id'], 'post_image')?>" style="width:100%; height:100%;">

                            </div>
                            <!--/--Checkbox-->

                        </div>

                    </div>

                    <a href="#">Thanks for using <u>Sitemine</u> beta Version</a>
                </div>


            </div>
        </div>
    </div>
    <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    </form>
<?php include 'inc/footer.php'; ?>