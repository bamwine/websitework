  <?php include('emg_admin/config.php'); 
  
  function get_image_url($type = '') {
        if (file_exists('emg_admin/' . $type))
            $image_url = 'emg_admin/' . $type ;
        else
            $image_url ='images/logo.jpg';

        return $image_url;
    }
	
	
	function match_all($haystack)
{
	
	$needles = array('awv','mp3','mp4','ogg');

    if(empty($needles)){
        return false;
    }

    foreach($needles as $needle){
        if (strpos($haystack, $needle) !== false) {
            return true;
        }
    }
    return false;
}


  ?>  

<!DOCTYPE html>
<html>
<head>
<title>DailySports Media| Africa's Biggest sports media</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="assets/css/animate.css">
<link rel="stylesheet" type="text/css" href="assets/css/font.css">
<link rel="stylesheet" type="text/css" href="assets/css/li-scroller.css">
<link rel="stylesheet" type="text/css" href="assets/css/slick.css">
<link rel="stylesheet" type="text/css" href="assets/css/jquery.fancybox.css">
<link rel="stylesheet" type="text/css" href="assets/css/theme.css">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">
<link rel="stylesheet" type="text/css" href="assets/css/style2.css">
<link rel="icon" href="images/icon.jpg">
<style type="text/css">

.card {
    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	 margin: 10px 10px 20px 10px;
	 border: 1px solid #BFBFBF;
	 height:300px;
	 overflow:hidden;
	
}

.two_chars{
   line-height: 1.5em;
    height: 7.5em;
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
}

</style>


</head>
<body >

<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container " style="width:100%;">
  <header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
               <li><a style="font-size:15px;" href="index.php">Home</a></li>
              <li><a style="font-size:15px;" href="about.php">About</a></li>
              <li><a style="font-size:15px;" href="contact.php">Contact</a></li>
            </ul>
          </div>
          <div class="header_top_right">
             <p style="font-size:15px;" id="Date">Friday, December 05, 2045</p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
		
        <div class="logo_area">
		<a href="index.php" class="logo"><img style="height:100px;" src="images/logo.jpg" alt=""></a>
		</div>
		
         <div class="logo_area" style="float:right">
		<a href="http://www.homebet.ug" target="_blank" class="logo add" id="homebet"><img style="height:100px;" src="images/top_bet.jpg" alt=""></a>
		</div>
		
        </div>
      </div>
	  
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="index.php"><span class="fa fa-home desktop-home"></span><span class="mobile-show">Home</span></a></li>
          <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Football">Football</a></li>
              <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Basketball">Basketball</a></li>
               <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Athletics">Athletics</a></li>
                <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Rugby">Rugby</a></li>
                 <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Motorsport">Motorsport</a></li>
                  <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Cricket">Cricket</a></li>
                 <li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page2.php?page=Golf">Golf</a></li> 
          <li class="dropdown"> <a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">More Sports</a>
            <ul class="dropdown-menu" role="menu">
             <li><a style="font-size:17px;" href="single_page2.php?page=Netball" tabindex="-1" class="menu-item">Netball</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Vollyball" tabindex="-1" class="menu-item">Vollyball</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Boxing" tabindex="-1" class="menu-item">Boxing</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Hockey" tabindex="-1" class="menu-item">Hockey</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Swimming" tabindex="-1" class="menu-item">Swimming</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Chess" tabindex="-1" class="menu-item">Chess</a></li>
                  <li><a style="font-size:17px;" href="single_page2.php?page=Chess" tabindex="-1" class="menu-item">Football Agency</a></li>
                 
            </ul>
          </li>
<li><a style="font-size:16px;font-family:'Times New Roman', Times, serif;" href="single_page3.php?page=Podcast">Podcast</a></li>        </ul>
      </div>
    </nav>
  
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"> <span>Latest News</span>
          <ul id="ticker01" class="news_sticker">
		  <?php
				 
			$stmt = $db->runQuery( "SELECT * FROM emg_posts WHERE status = 'publish' and `post_image` NOT LIKE '%mp4%' and `post_image` NOT LIKE '%mp3%' ORDER BY RAND()   limit 9" );
			$stmt->execute();
			while($rows = $stmt->fetch()):

//if(match_all(strtolower($rows['post_image']))){
   //echo "Matching pets.";

 
					?>
            <li><a href="single_page.php?page=<?php echo $rows['id']; ?>"><img src="<?php echo get_image_url($rows['post_image']);?>" height="20" width="25" alt=""><?php echo $rows['post_title']; ?></a></li>
				<?php
					
               // }	
				
				endwhile;
				
				?>
          </ul>
          <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="https://m.facebook.com/Dailysports2016"></a></li>
              <li class="twitter"><a href="https://twitter.com/Dailysportsmedia"></a></li>
           <!--   <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>  -->
              <li class="mail"><a href="mailto:dailysportsmedia@gmail.com"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>