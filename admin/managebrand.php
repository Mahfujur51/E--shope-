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
			$id=$_GET['eid'];
		$brandname=$_POST['brandname'];
		$sql="UPDATE tbl_brand SET brandname='$brandname' WHERE id='$id'";
		$query=mysqli_query($con,$sql);
		if ($query) {
			echo "<script>alert('Brand Updated Successfully!!')</script>";
			header("Location:brand.php");
		}else{
			echo "<script>alert('Brand Not Updated Successfully!!')</script>";
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
								<h5 class="title">EDIT BRAND</h5>
							</div>
							<div class="card-body">
								<?php
								$id=$_GET['eid'];
								$sql="SELECT * FROM tbl_brand WHERE id='$id'";
								$query=mysqli_query($con,$sql);
								while ($result=mysqli_fetch_array($query)) {
							# code...
									?>

									<div class="row">

										<div class="col-md-12">
											<div class="form-group">
												<label>Brand Title</label>
												<input type="text" id="product_name" required name="brandname" value="<?php echo $result['brandname']; ?>" class="form-control">
											</div>
											<div class="form-group">

												<input type="submit" class="btn btn-success" value="Create Category" name="submit" >
											</div>
										</div>
									</div>
									<?php
								}
								?>
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