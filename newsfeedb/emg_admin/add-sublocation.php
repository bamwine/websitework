<?php include 'inc/header.php'; ?>

<div id="page-content-wrapper" style="margin-top:-20px;">
    
    <h3 class="page-header">Add A Sub Location</h3>

    <div class="col-md-6">
        <?php
        if(isset($_POST['submit'])){
            $subloc = $db->validate($_POST['subloc'], 'Sub-location');
            $db->add_subloc ($subloc);
        }
        ?>
    <form method="post">

    <div class="form-group">
        <label for="add">Add Sub-Location</label>

        <input type="text" name="subloc" id="subloc" class="form-control sharp-corners" autofocus>
    </div>

    <div class="form-group">
        <button name="submit" class="btn btn-primary sharp-corners">Add Location</button>
    </div>

    </form>

    </div>
    </div>
<?php include 'inc/footer.php'; ?>