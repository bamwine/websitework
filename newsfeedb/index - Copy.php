<?php include('header.php'); ?> 
 
   
  <section id="contentSection">
    <div class="row">
	<?php 	if( !isset($_GET['page'])||($_GET['page']==1)){ ?>
      <div class="col-lg-9 col-md-8 col-sm-8">
	  
            
        <div class="left_content">
          <div class="single_post_content">
            <h2><span>Sports News</span></h2>
			
			<div class=" tab-content tab-content-t ">
					<div class="tab-pane active text-style" >
					<div class=" con-w3l ">
					<?php
							
							$stmt = $db->runQuery( "SELECT *  FROM emg_posts WHERE status = 'publish' ORDER BY `emg_posts`.`id` DESC LIMIT 0,2 " );
							$stmt->execute();
							while($rows = $stmt->fetch()):
							?>
				
					<div class="col-lg-5 col-md-40 col-sm-1 card" style="width:47%">
					<ul class="business_catgnav  wow fadeInDown">
							

							<?php $ff =$rows['post_image'];
									if(strtolower(end(explode(".",$ff))) =="mp3" || strtolower(end(explode(".",$ff))) =="mp4" )
									{?>
					<li>

					<figure class="bsbig_fig"> <a href="#" class="featured_img"> <img height="200px;" src="images/audio.jpg"> <span class="overlay"></span> </a>
					<figcaption> <a href="#"><?php echo $rows['post_title']; ?></a> </figcaption>
					<p><audio controls style="width:100%;" >
					<source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp4">
					<source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mpeg">
					<source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp3">
					<source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/ogg">
					Your browser does not support the audio element.
					</audio>
					</a></p>
					</figure>

					</li>
									<?php }  else {?>
							
							
							<li>
							<figure class="bsbig_fig"> <a href="single_page.php?page=<?php echo $rows['id']; ?>" class="featured_img"> <img height="200px;" src="<?php echo get_image_url($rows['post_image']); ?>"> <span class="overlay"></span> </a>
							<figcaption class="" style ="font-size: 13px;"> <a href="single_page.php?page=<?php echo $rows['id']; ?>"><?php echo $rows['post_title']; ?></a> </figcaption>
							<p class="two_chars" ><?php echo $rows['post_content']; ?></p>
							</figure>
							</li>

							
							
							
					</ul>
					
					
					</div>
					
					<?php } endwhile;?>

					

					
					
					
						
				
					</div>
					</div>
					
			</div>
			
			
			
          </div>
            
	   </div>
	  
      </div>
      <?php } ?>
	 
	 <div class="col-lg-3 col-md-0 col-sm-1">
        <aside class="right_content">
           
		  <div class="single_sidebar wow fadeInDown">
            <h2><span>Advertisement</span></h2>
            <a class="sideAdd" href="#"><img src="images/add_img.jpg" alt=""></a> </div>
          
         
        </aside>
      </div>
	  
	  
	</div>
  <div class="row">
      <div class="col-lg-18 col-md-18 col-sm-15">
        <div class="left_content">
          <div class="single_post_content">
          
           
			<div class=" tab-content tab-content-t ">
					<div class="tab-pane active text-style  " >
						<div class="con-w3l ">
						<?php try {

    // Find out how many items are in the table
$stmt = $db->runQuery('SELECT  COUNT(*) as num FROM emg_posts ');
$stmt->execute();
$userRow = $stmt->fetch(PDO::FETCH_ASSOC);
$total =$userRow['num'];	
    // How many items to list per page
    $limit = 8;

    // How many pages will there be
    $pages = ceil($total / $limit);

    // What page are we currently on?
    $page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
        'options' => array(
            'default'   => 1,
            'min_range' => 1,
        ),
    )));

    // Calculate the offset for the query
    $offset = ($page - 1)  * $limit;

    // Some information to display to the user
    $start = $offset + 2;
    $end = min(($offset + $limit), $total);

    // The "back" link
   // $prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">BACK</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';
	$prevlink = ($page > 1) ? '<a href="?page=' . ($page - 1) . '" title="Previous page">BACK</a>' : '';

    // The "forward" link
    //$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">MORE</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';
	$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">MORE</a> ' :'';

    // Display the paging information
   //echo '<div class="col" id="paging"><p>', $prevlink, ' Page ', $page, ' of ', $pages, ' pages, displaying ', $start, '-', $end, ' of ', $total, ' results ', $nextlink, ' </p></div>';

    // Prepare the paged query
    $stmt = $db->runQuery("
        SELECT * FROM emg_posts WHERE status = 'publish'  ORDER BY id DESC
        LIMIT  :limit   OFFSET   :offset
    ");
		
    // Bind the query params
    $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    // Do we have any results?
    if ($stmt->rowCount() > 0) {
        // Define how we want to fetch the results
        $stmt->fetch(PDO::FETCH_ASSOC);
        $iterator = new IteratorIterator($stmt);

        // Display the results
		$d=1;
        foreach ($iterator as $rows) {
			if($d!=1){
		 ?>	
		
		<div class="col-md-3 m-wthree card">
								<div class="col-m">
									
									<?php $ff =$rows['post_image'];
									if(strtolower(end(explode(".",$ff))) =="mp3" || strtolower(end(explode(".",$ff))) =="mp4" )
									{?>
									<a href="#"  class="">
										
										<img src="images/audio.jpg" width="100%;" height="83px;" alt="">
									<audio controls style="width:100%;">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp4">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mpeg">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/mp3">
  <source src="emg_admin/<?php echo $rows['post_image']; ?>" type="audio/ogg">
  Your browser does not support the audio element.
</audio>
									</a>
									
									<div class="women">
											<h6><a href="single_page.php?page=<?php echo $rows['id']; ?>"><?php echo $rows['post_title']; ?></a></h6>							
											<a href="#"><i class="fa fa-user"></i>&nbsp;<?php echo $rows['author']; ?></a> <span><i class="fa fa-calendar"></i>&nbsp;<?php echo $rows['dater']; ?></span>
										</div>
										
									<?php }  else {?>
									
									<div class="mid-1">
										<div class="women">
											<h6><a href="single_page.php?page=<?php echo $rows['id']; ?>"  class="">
										
										<img src="<?php echo get_image_url($rows['post_image']); ?>" width="100%;" height="120px;" alt=""> 
										
									
									</a></h6>	
											<p><b><?php echo $rows['post_title']; ?></b></p>
											<a href="#"><i class="fa fa-user"></i>&nbsp;<?php echo $rows['author']; ?></a> <span><i class="fa fa-calendar"></i>&nbsp;<?php echo $rows['dater']; ?></span>
										
										</div>
											
									</div>
									
									<?php }
									?>
									
									
									
									
									
								</div>
								</br>
							</div>
							
						
		
		
	<?php
			}
        $d++;   
        }
	
    } else {
			echo '<div class="mid-1">
			<div class="women">
			<h6>End of content</h6>							
			</div>

			</div>';
    }

} catch (Exception $e) {
    //echo '<p>', $e->getMessage(), '</p>';
}

?>
							
						 </div>
					</div>
					
				</div>
			
			
			
          </div>
          <center><b><p align="center"><?php  echo $prevlink; ?>  &nbsp;&nbsp;  <?php  echo $nextlink; ?> </p></b>  </center>
		  
	   </div>
      </div>
      </div>
	
	
  
  
  </section>
  
<?php include('footer.php'); ?>  
