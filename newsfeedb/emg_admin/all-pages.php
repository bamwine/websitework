<?php
include 'inc/header.php';
?>

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <h1 class="page-header">Pages Panel</h1>
        <hr color="#fff" style="height:2px;">

        <a href="new-page.php"><button class="btn btn-default">Add New Page</button></a>

        <h2>All pages</h2>
        <p><a href="" class="active">All</a> | Published | Deleted</p>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12"  style="background:#fff;">

                    <br>


                    <table class="table-responsive table-striped" style="width:100%; border-left:1px solid #CCCCCC; height:;">
                        <tr style="border:1px solid #CCCCCC; height:40px;">
                            <th><words>Page Name</words></th>
                            <th>Page Author</th>
                            <th>Date/Time</th>
                        </tr>
                        <?php
                        $query = "SELECT * FROM emg_pages WHERE status = 'publish' ORDER BY ID DESC";
                        $records_per_page=10;
                        $newquery = $db->paging($query, $records_per_page);
                        $db->dataviewpages($newquery);
                        $db->paginglink($query, $records_per_page);
                        ?>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    </div>


<?php include 'inc/footer.php'; ?>