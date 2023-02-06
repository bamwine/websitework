<?php include 'inc/header.php'; ?>

<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:20px;">

    <p style="font-weight:600px; font-family:open sans; font-size:30px; margin-top:30px;">Pages Panel</p>
    <hr color="#fff" style="height:5px;">

    <h2>Create New Page</h2>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8"  style="background:#fff;">
                <br>
                <?php
                if(isset($_POST['publish'])) {

                    $post_title = trim($_POST['page_title']);
                    $post_content = trim($_POST['page_content']);
                    /*$post_image = $_FILES['fileUpload'];
                    $post_category = $_POST['post_category'];*/

                    $author = $userRow['admin_uname'];
                    $status = "publish";

                    if(empty($post_title) || empty($post_content))
                    {

                ?>
                <div class='alert alert-danger' style="border-radius: inherit; border-left:3px solid red;"><strong>Error! </strong>
                    <?php
                    echo "Please Enter all required details!";
                    ?>
                </div>
                <?php
                    }else {
                        /*Entering the values into the db*/
                        $db->enter_page($post_title, $post_content, $status, $author);

                    }

                }

                ?>

                <form method="post" enctype="multipart/form-data">
                    <h2>Page Name</h2>
                    <div class="form-group">
                        <input type="text"  style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;" class="form-control input-lg" id="title" name="page_title" placeholder="Enter Page Name here">
                    </div>

                    <h3>Some Details</h3>
                    <div class="form-group" style="font-family:Georgia; background:#ccc;">
                        <textarea class="form-control" name="page_content" id="textarea" placeholder="Enter text ..." rows="3" style="height:200px; width:100%; font-size:18px;"></textarea>
                    </div>

            </div>


            <div class="col-md-4">
                <p style="font-size:20px; font-weight:bold;">SAVE YOUR PAGE</p>
                <div class="panel panel-default" style="-webkit-border-radius: 1px;-moz-border-radius: 1px;border-radius: 1px;">
                    <div class="panel-heading">
                        <h3 class="panel-title" style="font-weight:bold;">SAVE PAGE</h3>
                    </div>
                    <div class="panel-body">
                        <button class="btn btn-primary"  style="border-radius: inherit; width:100%;" name="publish">PUBLISH PAGE</button>
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
                        <h3 class="panel-title" style="font-weight:bold;">Lorem Ipsum</h3>
                    </div>

                    <div class="panel-body" style="overflow-y:scroll;">
                        Lorem Ipsum
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

</form>


<?php include 'inc/footer.php';?>


