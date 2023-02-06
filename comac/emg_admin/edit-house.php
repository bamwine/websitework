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
$Bedrooms=$_POST['Bedrooms'];
$Bathrooms=$_POST['Bathrooms'];
$Kitchen=$_POST['Kitchen'];
$Parking=$_POST['Parking'];

$house_status=$_POST['house_status'];
$house_type=$_POST['house_type'];

$id=intval($_GET['id']);
$sql="update tblhouses set housesTitle=:HouseTitle ,housesOverview=:Houseorcview ,Price=:priceperday,location=:Location ,bedrooms=:Bedrooms,bathrooms=:Bathrooms ,kitchen=:Kitchen,parking=:Parking ,status=:house_status,house_type=:house_type where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':HouseTitle',$HouseTitle,PDO::PARAM_STR);
$query->bindParam(':Houseorcview',$Houseorcview,PDO::PARAM_STR);
$query->bindParam(':priceperday',$priceperday,PDO::PARAM_STR);
$query->bindParam(':Location',$Location,PDO::PARAM_STR);
$query->bindParam(':Bedrooms',$Bedrooms,PDO::PARAM_STR);
$query->bindParam(':Bathrooms',$Bathrooms,PDO::PARAM_STR);
$query->bindParam(':Kitchen',$Kitchen,PDO::PARAM_STR);
$query->bindParam(':Parking',$Parking,PDO::PARAM_STR);

$query->bindParam(':house_status',$house_status,PDO::PARAM_STR);
$query->bindParam(':house_type',$house_type,PDO::PARAM_STR);
 
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Data updated successfully";


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

	<title>Admin | Admin Edit house Info</title>

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

						<h2 class="page-title">Edit House</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php
$id=intval($_GET['id']);
$sql ="SELECT tblhouses.* from tblhouses where tblhouses.id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">House Title<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="HouseTitle" class="form-control" value="<?php echo htmlentities($result->housesTitle);?>" required>
</div>
<label class="col-sm-2 control-label">Location<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="Location" class="form-control" value="<?php echo htmlentities($result->location);?>" required>
</div>
</div>

<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">House Overview<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="Houseorcview" rows="3" required><?php echo htmlentities($result->housesOverview);?></textarea>
</div>
</div>
<div class="form-group">
<label class="col-sm-2 control-label">Price  <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="number" name="priceperday" class="form-control"  value="<?php echo htmlentities($result->Price);?>"required>
</div>
<label class="col-sm-2 control-label">No Of Bedrooms<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="number" name="Bedrooms" class="form-control" value="<?php echo htmlentities($result->bedrooms);?>" required>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">No Of Bathrooms <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="Bathrooms" class="form-control" value="<?php echo htmlentities($result->bathrooms);?>" required>
</div>
<label class="col-sm-2 control-label">No Of Kitchen <span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="number" name="Kitchen" class="form-control" value="<?php echo htmlentities($result->kitchen);?>" required>
</div>
</div>

<div class="form-group">

<label class="col-sm-2 control-label">Parking<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="" name="Parking" required>
<option value="<?php echo htmlentities($result->parking);?>"><?php echo htmlentities($result->parking);?> </option>
<option value="yes">yes </option>
<option value="no">no</option>
</select>
</div>

<label class="col-sm-2 control-label">House Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="house_type" required>
<option value="rent">rent </option>
<option value="sale">sale</option>
</select>
</div>

</div>

<div class="form-group">
<label class="col-sm-2 control-label">House status<span style="color:red">*</span></label>
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
<h4><b>House Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="img/vehicleimages/<?php echo htmlentities($result->Vimage1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 1</a>
</div>
<div class="col-sm-4">
Image 2<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage2);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 2</a>
</div>
<div class="col-sm-4">
Image 3<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage3);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 3</a>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage4);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 4</a>
</div>
<div class="col-sm-4">
Image 5
<?php if($result->Vimage5=="")
{
echo htmlentities("File not available");
} else {?>
<img src="img/vehicleimages/<?php echo htmlentities($result->Vimage5);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage5.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 5</a>
<?php } ?>
</div>

</div>
<div class="hr-dashed"></div>
</div>
</div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading"></div>
<div class="panel-body">


<?php }} ?>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >

													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
												</div>
											</div>

										</form>
									
								
						



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
