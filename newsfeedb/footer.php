 
  <footer id="footer">
    <!--div class="footer_top">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInLeftBig">
            <h2>Flickr Images</h2>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInDown">
            <h2>Tag</h2>
            <ul class="tag_nav">
			
			 <?php
				 
			$stmt = $db->runQuery( "SELECT * FROM emg_post_cats  ORDER BY RAND() limit 6" );
			$stmt->execute();
			while($rows = $stmt->fetch()):
				?>
              <li><a href="single_page2.php?page=<?php echo $rows['category'];?>"><?php echo $rows['category'];?></a></li>
               
				 
				 <?php
				endwhile;
				?>
            </ul>
          </div>
        </div>
        
		
		<div class="col-lg-4 col-md-4 col-sm-4">
          <div class="footer_widget wow fadeInRightBig">
            <h2>Contact</h2>
            <p>Daily Sports Uganda is the biggest active Ugandan based Media Service promoting Ugandan and East African Sports across it's media properties</p>
            <address>
            Daily Sports Uganda,Located at UBC Station &nbsp;&nbsp;&nbsp; Phone: +256 756 049680  Email: dailysportsuganda@gmail.com 
            </address>
          </div>
        </div>
      </div>
    </div-->
    
	
	<div class="footer_bottom">
      <p class="copyright">Copyright &copy; 2018 Daily Sports Uganda<br/> <a href="index.php">All Rights Reserved</a></p>
    <!--  <p class="developer" style="color:white;">Developed By Innocat Technologies</p>  -->
    </div>
  </footer>
</div>
<script src="assets/js/jquery.min.js"></script> 
<script src="assets/js/wow.min.js"></script> 
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="assets/js/jquery.newsTicker.min.js"></script> 
<script src="assets/js/jquery.fancybox.pack.js"></script> 
<script src="assets/js/custom.js"></script>
<script src="pages/assets/js/custom.js"></script>
	<script type="text/javascript">
	$(document).ready(function() {
	// Create two variable with the names of the months and days in an array
	var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
	var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

	// Create a newDate() object
	var newDate = new Date();
	// Extract the current date from Date object
	newDate.setDate(newDate.getDate());
	// Output the day, date, month and year    
	$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

	setInterval( function() {
		// Create a newDate() object and extract the seconds of the current time on the visitor's
		var seconds = new Date().getSeconds();
		// Add a leading zero to seconds value
		$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
		},1000);
		
	setInterval( function() {
		// Create a newDate() object and extract the minutes of the current time on the visitor's
		var minutes = new Date().getMinutes();
		// Add a leading zero to the minutes value
		$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
		},1000);
		
	setInterval( function() {
		// Create a newDate() object and extract the hours of the current time on the visitor's
		var hours = new Date().getHours();
		// Add a leading zero to the hours value
		$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
		}, 1000);
		
	}); 
	</script>
	
	<script type="text/javascript">

    $(document).ready(function(){

		
		
			$(".add").click(function(event) {
			  //event.preventDefault();
  //alert(this.id);
  
  var numValue =this.id;
  // Send the input data to the server using get

            $.post("new.php", {addcart: numValue} , function(data){

            });

});




			$(".news").click(function(event) {
			  //event.preventDefault();
  //alert(this.id);
  
  var numValue =this.id;
  // Send the input data to the server using get

            $.post("new.php", {addcart: numValue} , function(data){

            });

});

    });
	
	


    </script>
</body>
</html>