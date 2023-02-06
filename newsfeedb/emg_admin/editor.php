<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>editor</title>
	
	<!--IE Compatibility modes-->
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<!--Mobile first-->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">

	<!-- metisMenu stylesheet -->

	<link rel="stylesheet" href="css/assets/css/bootstrap3-wysihtml5.css">


</head>
<body>


<div class="container">
<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<style>
				ul.wysihtml5-toolbar > li {
					position: relative;
				}
			</style>
			<div class="row">
				<div class="col-lg-12">
					<div class="box">
						<header>
							<div class="icons">
								<i class="fa fa-th-large"></i>
							</div>
							<h5>Basic Editor</h5>

							<!-- .toolbar -->
							<div class="toolbar">
								<nav style="padding: 8px;">
									<a href="javascript:;" class="btn btn-default btn-xs collapse-box">
										<i class="fa fa-minus"></i>
									</a>
									<a href="javascript:;" class="btn btn-default btn-xs full-box">
										<i class="fa fa-expand"></i>
									</a>
									<a href="javascript:;" class="btn btn-danger btn-xs close-box">
										<i class="fa fa-times"></i>
									</a>
								</nav>
							</div><!-- /.toolbar -->
						</header>
						<div id="div-1" class="body">
							<form>
								<textarea id="wysihtml5" class="form-control" rows="10"></textarea>
								<div class="form-actions">
									<input type="submit" value="Submit" class="btn btn-primary">
								</div>
							</form>
						</div>
					</div>
				</div><!-- /.col-lg-12 -->
			</div><!-- /.row -->


			<select data-placeholder="Choose a Country..." class="form-control chzn-select" tabindex="2">
				<option value=""></option>
				<option value="United States">United States</option>
				<option value="United Kingdom">United Kingdom</option>
				<option value="Afghanistan">Afghanistan</option>
				<option value="Albania">Albania</option>
				<option value="Algeria">Algeria</option>
				<option value="American Samoa">American Samoa</option>
				<option value="Andorra">Andorra</option>
				<option value="Angola">Angola</option>
				<option value="Anguilla">Anguilla</option>
				<option value="Antarctica">Antarctica</option>
				<option value="Antigua and Barbuda">Antigua and Barbuda</option>
				<option value="Argentina">Argentina</option>
</select>

		</div>
		<!--jQuery -->

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

		<!--Bootstrap -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>

		<!-- MetisMenu -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.js"></script>

		<script src="css/assets/js/bootstrap3-wysihtml5.all.min.js"></script>


		<!-- Metis core scripts -->
		<script src="css/assets/js/core.min.js"></script>

		<!-- Metis demo scripts -->
		<script src="css/assets/js/app.js"></script>
		<script>
			$(function() {
				Metis.formWysiwyg();
			});
		</script>
		<script src="css/assets/js/style-switcher.min.js"></script>
</body>
