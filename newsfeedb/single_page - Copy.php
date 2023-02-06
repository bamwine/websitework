
  
   <?php include('header.php'); ?>  

  <section id="contentSection">
    <div class="row">
	<?php
				 $post_category = $_GET['page'];
                    $stmt = $db->runQuery( "SELECT * FROM emg_posts WHERE  id= :post_ID " );
                    $stmt->execute([":post_ID"=>$post_category]);
                    while($rows = $stmt->fetch()):
                        ?>
	
      <div class="col-lg-18 col-md-18 col-sm-18">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="index.php">Home</a></li>
              <li><a href="single_page2.php?page=<?php echo $rows['post_category']; ?>"><?php echo $rows['post_category']; ?></a></li>
             
            </ol>
            <h1><?php echo $rows['post_title']; ?></h1>
            <div class="post_commentbox"> <a href="#"><i class="fa fa-user"></i><?php echo $rows['author']; ?></a> <span><i class="fa fa-calendar"></i><?php echo $rows['dater']; ?></span> <a href="#"><i class="fa fa-tags"></i><?php echo $rows['post_category']; ?></a> </div>
            
			
			<div class="single_page_content"> <img style="float:left; margin: 0px 9px 7px 0px" class="img-center" src="<?php echo get_image_url($rows['post_image']); ?>" alt="">
            <p><?php echo $rows['post_content']; ?></p>
			   
             
            
           </div>
        </div>
      </div>
      
	  
						
					<?php
					endwhile;
					?>
	  
	 
     
	</div>
  </section>
 
   <?php include_once('footer.php'); ?>  