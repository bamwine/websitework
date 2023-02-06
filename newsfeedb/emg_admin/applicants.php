<?php include 'inc/header.php'; ?>

<script>
    function del_appl ()
    {
        

    }
</script>

<!-- Page Content -->
<div id="page-content-wrapper" style="margin-top:-20px;">

    <p style="font-weight:600px; font-family:open sans; font-size:30px;">Admin Panel >> <small>All Applicants</small></p>
    <a href="index.php"><button class="btn btn-default">Make New Post</button></a>
    <hr color="#fff" style="height:2px;">
    <h3>Applicants</h3>
    <div class="container-fluid">
        <div class="row">

            <!--Start of col-lg-8-->
            <div class="col-lg-12"  style="background:#fff;">

           <table class="table table-stripped">

               <tr>
                   <th>First Name</th>
                   <th>Last Name</th>
                   <th>Phone Number</th>
                   <th>Email Address</th>
                   <th>Entry Level</th>
                   <th>Starting Term</th>
                   <th>Operation</th>
               </tr>

                   <?php
                   $stmt = $db->runQuery ( "SELECT * FROM emg_applicants" );
                   $stmt->execute();
                   $stmt->setFetchMode(PDO::FETCH_ASSOC);
                   while($rows = $stmt->fetch()):
                   ?>
               <tr>
                   <td><?php echo $rows['fname']; ?></td>
                   <td><?php echo $rows['lname']; ?></td>
                   <td><?php echo $rows['phone']; ?></td>
                   <td><?php echo $rows['email']; ?></td>
                   <td><?php echo $rows['entry_level']; ?></td>
                   <td><?php echo $rows['starting_term']; ?></td>
                   <td><a href="" onclick="del_appl('<?php echo $rows['id']; ?>')">Delete</a></td>

               </tr>

               <?php endwhile; ?>
           </table>


            </div>
            <!--End of col-lg-8-->

            </div>
        </div>
    </div>

<?php include 'inc/footer.php'; ?>
