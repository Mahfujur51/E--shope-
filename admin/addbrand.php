<?php
session_start();
include('include/db.php');
if(strlen($_SESSION['alogin'])==0)
{
	header('location:login.php');
}
else{
	if(isset($_POST['submit']))
	{
		$brandname=$_POST['brandname'];
		$sql="INSERT INTO tbl_brand(brandname)VALUES('$brandname')";
		$query=mysqli_query($con,$sql);
		if ($query) {
			echo "<script>alert('Brand inserted Successfully!!')</script>";
			header("Location:brand.php");
		}else{
			echo "<script>alert('Brand not inserted Successfully!!')</script>";
			header("Location:addbrand.php");
		}

	}
	include "sidenav.php";
	include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
	<div class="container-fluid">
		<form action="" method="post" >
			<div class="row">
				
				
				<div class="col-md-12">
					<div class="card">
						<div class="card-header card-header-primary">
							<h5 class="title">Add Brand</h5>
						</div>



						<div class="card-body">
							
							<div class="row">
								
								<div class="col-md-12">
									<div class="form-group">
										<label>Brand Title</label>
										<input type="text" required name="brandname" class="form-control">
									</div>
									<div class="form-group">
										
										<input type="submit" class="btn btn-success" value="Create Brand" name="submit" >
									</div>
								</div>	
							</div>
						</div>



						
					</div>
				</div>
				
				
			</div>
		</form>
		
	</div>


</div>
<?php
include "footer.php";
}
?>