<?php
include 'inc/header.php';
?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <h1 class="page-header">Admin Panel</h1>
        <hr color="#fff" style="height:2px;">

        <h2>All posts</h2>
        <p><a href="all-posts.php">All</a> | Published | <a href="deleted-posts.php" class="active">Deleted</a></p>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12"  style="background:#fff;">

                    <br>


                    <table class="table-responsive table-striped" style="width:100%; border-left:1px solid #CCCCCC; height:;">
                        <tr style="border:1px solid #CCCCCC; height:40px;">
                            <th><words>Post Title</words></th>
                            <th>Author</th>
                            <th>Category</th>
                            <th>Date/Time</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM emg_posts WHERE status = 'deleted' ORDER BY id DESC";
                        $records_per_page=20;
                        $newquery = $db->paging($query, $records_per_page);
                        $db->dataview($newquery);
                        $db->paginglink($query, $records_per_page);
                        ?>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>



<?php include 'inc/footer.php'; ?>