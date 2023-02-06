<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{
header('location:index.php');
}
else{

if(isset($_POST['submit']))
  {
$HouseTitle=$_POST['HouseTitle'];
$Location=$_POST['Location'];
$Houseorcview=$_POST['Houseorcview'];
$priceperday=$_POST['priceperday'];
$Landsize=$_POST['Landsize'];
$LandType=$_POST['LandType'];
$mat_type=$_POST['mat_type'];
$house_status=$_POST['house_status'];
$vimage1=$_FILES["img1"]["name"];
$vimage2=$_FILES["img2"]["name"];
$vimage3=$_FILES["img3"]["name"];
$vimage4=$_FILES["img4"]["name"];
$vimage5=$_FILES["img5"]["name"];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/vehicleimages/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/vehicleimages/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/vehicleimages/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/vehicleimages/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/vehicleimages/".$_FILES["img5"]["name"]);

$sql="INSERT INTO tblhouses
(housesTitle,housesOverview,Price,location,size,land_type,mat_type,status,Vimage1,Vimage2,Vimage3,Vimage4,Vimage5) 
VALUES(:HouseTitle,:Houseorcview,:priceperday,:Location,:Landsize,:LandType,:mat_type,:house_status,:vimage1,:vimage2,:vimage3,:vimage4,:vimage5)";
$query = $dbh->prepare($sql);
$query->bindParam(':HouseTitle',$HouseTitle,PDO::PARAM_STR);
$query->bindParam(':Houseorcview',$Houseorcview,PDO::PARAM_STR);
$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
$query->bindParam(':Location',$Location,PDO::PARAM_STR);
$query->bindParam(':Landsize',$Landsize,PDO::PARAM_STR);
$query->bindParam(':LandType',$LandType,PDO::PARAM_STR);
$query->bindParam(':mat_type',$mat_type,PDO::PARAM_STR);
$query->bindParam(':house_status',$house_status,PDO::PARAM_STR);
$query->bindParam(':vimage1',$vimage1,PDO::PARAM_STR);
$query->bindParam(':vimage2',$vimage2,PDO::PARAM_STR);
$query->bindParam(':vimage3',$vimage3,PDO::PARAM_STR);
$query->bindParam(':vimage4',$vimage4,PDO::PARAM_STR);
$query->bindParam(':vimage5',$vimage5,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Land posted successfully";
}
else
{
$error="Something went wrong. Please try again";
}

}


	?>
<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">

	<title>Admin | Admin Post Land</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
<style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>

</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title">Post Land Property</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="mat_type" class="form-control" value="L" required>
<div class="form-group">
<label class="col-sm-2 control-label">Land Heading<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="HouseTitle" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Location<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="Location" class="form-control" required>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Land Overview<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="Houseorcview" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price  <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="number" name="priceperday" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Land size<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="Landsize" placeholder="4 by 6 acers" class="form-control" required>
</div>
</div>



<div class="form-group">

<label class="col-sm-2 control-label">Land Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="LandType" required>
<option value="mailo">mailo </option>
<option value="Kyapa">Kyapa</option>
</select>
</div>

<label class="col-sm-2 control-label">land status<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="house_status" required>
<option value="available">available </option>
<option value="taken">taken</option>
</select>
</div>
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Upload Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
<div class="col-sm-4">
Image 3<span style="color:red">*</span><input type="file" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<span style="color:red">*</span><input type="file" name="img4" required>
</div>
<div class="col-sm-4">
Image 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>
</div>


</div>
</div>
</div>


<div class="row">
<div class="col-md-12">



<div class="form-group">
	<div class="col-sm-8 col-sm-offset-2">
		<button class="btn btn-default" type="reset">Cancel</button>
		<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
	</div>
</div>

		</form>
	</div>
</div>
</div>
						
						
						</div>



					</div>
				</div>



			</div>
		</div>
	</div>

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
<?php } ?>
