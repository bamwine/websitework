<?php include('header.php'); ?> 
 
   
  <section id="contentSection">
    
  <div class="row" >
  
  
	  
      <div class="col-lg-10 col-md-20 col-sm-15">
        <div class="left_content" >
          <div class="single_post_content" >
           <h2><span><?php echo $_GET['page']."\t";?> News</span></h2>
           
			<div class=" tab-content tab-content-t" >
					<div class="tab-pane active text-style"  >
						<div class=" con-w3l">
						<?php
				 $post_category = $_GET['page'];
                    $status = 0;
                    $stmt = $db->runQuery( "SELECT * FROM emg_posts WHERE status = 'publish' and post_category= :post_category ORDER BY id DESC" );
                    //$stmt = $db->runQuery( "SELECT * FROM emg_posts WHERE status = 'publish'  ORDER BY id DESC" );
                    
					$stmt->execute([":post_category"=>$post_category]);
					
					if($stmt->rowCount() > 0) {
					
                    while($rows = $stmt->fetch()):
                ?>
						
							
							<div class="col-md-3 m-wthree card">
								<div class="col-m">
									
									<?php $ff =$rows['post_image'];
									if(strtolower(end(explode(".",$ff))) =="mp3" || strtolower(end(explode(".",$ff))) =="mp4" )
									{?>
									<a href="#"  class="">
										
										<img src="images/audio.jpg" width="220px;" height="83px;" alt="">
									<audio controls style="width:220px;">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp4">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mpeg">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp3">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/ogg">
  Your browser does not support the audio element.
</audio>
									</a>
									<?php }  else {?>
									<a href="single_page.php?page=<?php echo $rows['id']; ?>" id="<?php echo $rows['id']; ?>"  class="news">
									
										
										<img src="<?php echo get_image_url($rows['post_image']); ?>" width="220px;" height="120px;" alt="">
									
									</a>
									<?php }
									?>
									
									
									<div class="mid-1">
										<div class="women">
											<h6><a href="single_page.php?page=<?php echo $rows['id']; ?>"><?php echo $rows['post_title']; ?></a></h6>							
											<a href="#"><i class="fa fa-user"></i>&nbsp;<?php echo $rows['author']; ?></a> <span><i class="fa fa-calendar"></i>&nbsp;<?php echo $rows['dater']; ?></span>
										</div>
											
									</div>
									
									
								</div>
								</br>
							</div>
							
							<?php
							endwhile;
							
					} else { ?>
						
						<div class="alert alert-info sharp-corners">
<strong><?php echo $_GET['page'];?> Updates!</strong>
<p>The Updates for this page are comming soon</p>
</div>
						
					<?php }
							?>
							
							
						 </div>
					</div>
					
				</div>
			
			
          </div>
            
	   </div>
	   
	   
	  
	  </div>
	  
	  <div class="col-lg-2 col-md-3 col-sm-4">
        <aside class="right_content">
           
		  <div class="single_sidebar wow fadeInDown">
            <h2><span>Advertisment</span></h2>
            <a class="sideAdd add" href="http://www.homebet.ug" target="_blank" id="homebet" ><img src="images/top_bet1.jpg" alt=""></a> </div>
          
         
        </aside>
      </div>
      
	  
    </div>
	
	
  
  </section>
  
<?php include('footer.php'); ?>  