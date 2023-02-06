<?php include 'inc/header.php'; ?>


<script>
    function get_cat ()
    {
        var cat = document.getElementById('category').value;
        document.getElementById('displaycat').innerHTML = cat;
    }
</script>


<!-- Page Content -->
<div id="page-content-wrapper">

<h3 class="page-header">Add A Custom Category</h3>



    <div class="col-md-6 space-up border-bottom">

        <h4 class="page-header">Enter your New Category Here</h4>

        <?php
        if(isset($_POST{'submit'}))
        {
            $category = $_POST['category'];

            //checking if the category already exists
            $check = $db->runQuery( "SELECT * FROM emg_post_cats WHERE category = :category" );
            $check->execute([":category"=>$category]);
            $check->fetch(PDO::FETCH_ASSOC);

            if($check->rowCount() > 0){
                ?>
                <div class="alert alert-danger">
                    <p>The Category you entered already exists</p>
                </div>
                <?php
            }else {
                $exec = $db->runQuery("INSERT INTO emg_post_cats(category) VALUES(:category)");
                $exec->bindValue(":category", $category);
                $exec->execute();
                ?>
                <div class="alert alert-success sharp-corners">
                    <strong>Success!</strong>
                    <p>Category Successfully submitted!</p>
                </div>
                <?php
            }
        }
        ?>
        <form method="post">

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" class="form-control">
            </div>

            <div class="form-group">
                <button name="submit" class="btn btn-primary sharp-corners">Submit Category</button>
            </div>

        </form>


    </div>

    <hr/>


    <!--Entering the subcategory of a certain category-->

    <div class="col-md-8 border-bottom space-up">

        <h3>Enter a SubCategory Here</h3>
        
        
        <?php
        //submitting the subctegory
        if(isset($_POST['sub_submit']))
        {
            $sub = $_POST['sub'];
            $chose_cat = $_POST['chose_cat'];
            //finding the id of the chosen category
            $cc = $db->runQuery( "SELECT * FROM emg_post_cats WHERE category = :category" );
            $cc->execute([":category"=>$chose_cat]);
            while($re = $cc->fetch()):
            $cat_id = $re['id'];

            //inserting
            $insert = $db->runQuery( "INSERT INTO emg_sub_cats (main_cat_id, sub_cat)VALUES(:id, :sub_cat)" );
            $insert->bindValue(":id", $cat_id);
            $insert->bindValue(":sub_cat", $sub);
            $insert->execute();
            ?>
            <div class="alert alert-success sharp-corners">
                <strong>Success!!</strong>
                <p>Sub Category was successfully submitted</p>
            </div>
        <?php


            endwhile;
        }
        ?>
        <small>Choose a Category to Enter its subcategory</small>
        <div class="form-group">

            <form method="post">

<select class="form-control" name="chose_cat" id="category" onchange="get_cat();">
<option>---Choose Category--</option>
    <?php
    $stmt = $db->runQuery( "SELECT * FROM emg_post_cats" );
    $stmt->execute();
    while($rows = $stmt->fetch()):
    ?>
    <option>
        <?php echo $rows['category']; ?>
    </option>
    <?php
    endwhile;
    ?>

    </select>

            
            <br/>
            Enter Subcategory for <font class="bold underline" id="displaycat"></font>



            <div class="form-group">
                <label for="subcategory">Sub-Category</label>
                <input type="text" name="sub" id="sub" class="form-control sharp-corners">
            </div>


            <div class="form-group">
                <button class="btn btn-primary sharp-corners" name="sub_submit">Submit Sub-Category</button>
            </div>

                </form>

            </div>
</div>

    <br/><br/>

    </div>

<?php include 'inc/footer.php'; ?>
<br/><Br/><br/><Br/><br/><Br/><br/><Br/><br/><Br/>