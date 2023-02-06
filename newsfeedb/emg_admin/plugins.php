<?php include 'inc/header.php'; ?>

<!-- Page Content -->
<div id="page-content-wrapper">



    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Welcome to Plugin Store</p>

<p>The plugin Store will help you enhance the functionality of SiteMine to make your Website / System Better and more functional</p>
    <hr color="#fff" style="height:2px;">


    <h2>Plugins</h2>

    <div class="container-fluid">

        <div class="col-lg-8"  style="background:#fff; min-height:550px;">


            <?php
            $stmt = $db->runQuery( "SELECT * FROM emg_plugins ORDER BY id DESC" );
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            while($rows = $stmt->fetch()):
            ?>
            <!--First Plugin-->
            <ul class="media-list space-up border-bottom light-shadow">
                <li class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="<?php echo $rows['plugin_image']; ?>" style="width:100px; height:90px; margin:5px;"/>
                        </a>
                    </div>

                    <div class="media-body">
                        <h4 class="media-heading space-up bold"><?php echo $rows['plugin_name']; ?></h4>
                        <p style="margin:5px;"><?php echo substr($rows['plugin_details'], 0, 150); ?></p>
                        By: <a href="#" class="hover_underline"><?php echo $rows['fname']; ?></a> | <a href="#" class="hover">Published On: <?php $db->friendly_date($rows['dater']); ?></a> | <a href="#" data-toggle="modal" data-target="#myModal"><span class="label label-info sharp-corners">Download</span></a>

                    </div>
                    <br/>
                </li>
            </ul>
            <!--end of first Plugin-->
                <?php
            endwhile;
                ?>


            </div>
        
        
        <div class="col-lg-4 border-left" style="background:#fff; min-height:300px;">

            <a href="add-plugin.php" class="btn btn-success sharp-corners space-up">Add New Plugin</a>

            <a href="add-plugin.php" class="btn btn-success sharp-corners space-up">Premium Plugins</a>

            <a href="add-plugin.php" class="btn btn-success sharp-corners space-up">Latest Plugins</a>
        </div>

        </div>

    </div>


<?php include 'inc/footer.php'; ?>

<!--Modal-->

<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">Trying to Install Plugin!</div>
            <div class="modal-body">
                Sorry Plugins not yet Activated!
            </div>
        </div>
    </div>
</div>

<!--End of Modal-->