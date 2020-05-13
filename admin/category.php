<?php
session_start();
include('include/db.php');
if(strlen($_SESSION['alogin'])==0)
{
	header('location:login.php');
}
else{
	if(isset($_GET['del']))
	{
		$id=$_GET['del'];
		$sql="DELETE FROM tbl_category WHERE id='$id'";
		$query=mysqli_query($con,$sql);
		if ($query) {
			echo "<script>alert('Category Deleted Successfully!!')</script>";
		}
	}
	include "sidenav.php";
	include "topheader.php";
	?>
	<!-- End Navbar -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				
				
				<div class="col-md-12">
					<a class="btn btn-outline-success" href="addcat.php">
						<i class="material-icons">add_circle</i>
						<span>Add Category</span>
					</a>
					<div class="card">
						<div class="card-header card-header-primary">
							<h5 class="title">Show Category</h5>
						</div>

						<table class="table">
							<tr>
								<th>S.NO</th>
								<th>Category Name</th>
								<th>Create Date</th>
								<th>Update date</th>
								<th>Action</th>
							</tr>
							<?php 
							$sql="SELECT * FROM tbl_category";
							$query=mysqli_query($con,$sql);
							$num=mysqli_num_rows($query);
							if ($num>0) {
								$cont=1;
								while ($result=mysqli_fetch_array($query)) {
									# code...
							
							 ?>
							<tr>
								<td><?php echo $cont; ?></td>
								<td><?php echo $result['catname']; ?></td>
								<td><?php echo $result['createdate']; ?></td>
								<td><?php echo $result['updatedate']; ?></td>
								<td>
									<a href="managecategory.php?eid=<?php echo $result['id']; ?>" class="btn btn-success">Eidt</a>
									<a href="?del=<?php echo $result['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure To Delete?');">
									Delete</a>
								</td>
							</tr>
							<?php 
							$cont++;
									}
							}else{

							 ?>
							 <tr>No Category Created!!</tr>
							<?php } ?>


						</table>

					</div>
				</div>
				
				
			</div>

		</div>
	</div>
	<?php
	include "footer.php";
}
?>