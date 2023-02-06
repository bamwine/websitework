<?php include 'inc/header.php'; ?>

    <script>
        var countBox =1;
        var boxName = 0;
        function addInput()
        {
            var boxName="textBox"+countBox;
            document.getElementById('response').innerHTML+='<br/><br/>' +
                '<div class="form-group">'+
            '<label for="fName">Field Name</label>'+
        '<input type="text" name="fName[]" id="fName" class="form-control">'+
        '</div>';
            countBox += 1;
        }
    </script>


    <!-- Page Content -->
    <div id="page-content-wrapper">



        <p style="font-weight:600px; font-family:open sans; font-size:30px;">Add More Fields to your posts</p>


        <hr color="#fff" style="height:2px;">


        <h2>Create New Fields</h2>

        <div class="container-fluid">

            <div class="col-lg-8"  style="background:#fff; min-height:550px;">
                <br>

                <?php
                if(isset($_POST['submit'])){
                    $fieldname = $_POST['fName'];
                    $db->enter_fields($fieldname);
                }
                ?>
<!--Fields-->
                <h3 class="page-header">
                    Enter a New Field Name (s)
                </h3>

                <form method="post">

                <div class="form-group">
                    <label for="fName">Field Name</label>
                    <input type="text" name="fName[]" id="fName" class="form-control">
                </div>


                <span id="response"></span>

<!--Button to add input-->
                <div class="form-group col-md-12">
                    <input type="button" onclick="addInput()" value="+Add Field" class="btn btn-success"/>
                </div>
                    <!--End of Button to Add Input-->

                    <!--Button to submit data-->
                <div class="form-group col-md-12 space-up">
                    <button class="btn btn-primary sharp-corners" name="submit">SUBMIT</button>
                </div>
                    <!--End of button to submit data-->

                </form>

                </div>



            <div class="col-lg-4">

                <div class="col-md-12" style="background:#fff;">

                    <h4 class="page-header">More Useful Plugins</h4>

                    <?php
                    $stmt = $db->runQuery( "SELECT * FROM emg_plugins ORDER BY id DESC LIMIT 3" );
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
                                    <a href="plugins.php"><span class="label label-info sharp-corners">Download</span></a>

                                </div>
                                <br/>
                            </li>
                        </ul>
                        <!--end of first Plugin-->
                        <?php
                    endwhile;
                    ?>

<a href="plugins.php" class="btn btn-primary sharp-corners center-block">View More</a>

                </div>
                </div>




            </div>
        </div>
    </div>






<?php include 'inc/footer.php'; ?>