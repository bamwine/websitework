<?php include('header.php'); ?> 
 
   
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-18 col-md-18 col-sm-18">
        <div class="left_content">
          <div class="single_post_content">
            <h2><span><?php echo $_GET['page']."\t";?></span></h2>
            <div class="single_post_content">
              <div class="bs-example">
    <div class="panel-group" id="accordion">
	
	<?php
                   $post_category = $_GET['page'];
                    $status = 0;
					$count = 1;
                    $stmt = $db->runQuery( "SELECT * FROM emg_posts WHERE status = 'publish' and post_category= :post_category ORDER BY RAND() DESC limit 4" );
                    $stmt->execute([":post_category"=>$post_category]);
                    while($rows = $stmt->fetch()):
                        ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $rows['post_ID']; ?>"><?php echo $rows['post_title']; ?></a>
                </h4>
            </div>
            <div id="<?php echo $rows['post_ID']; ?>" class="panel-collapse collapse in">
                <div class="panel-body">
                    <p><?php echo $rows['post_content']; ?> </p>
					<audio controls>
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp4">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mpeg">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp3">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/ogg">
  Your browser does not support the audio element.
</audio>
				</div>
            </div>
        </div>
		
		<?php
                  
				   endwhile;
                    ?>
              
        
        
    </div>
	
</div>
            </div>
           
          </div>
            
	   </div>
      </div>
      
	
	</div>
  </section>
  
<?php include('footer.php'); ?>  