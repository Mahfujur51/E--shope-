<?php
session_start();
include('include/db.php');
if(strlen($_SESSION['alogin'])==0)
{
  header('location:login.php');
}else{
  if(isset($_GET['del']))
  {
    $id=$_GET['del'];
///////picture delete/////////
    $result=mysqli_query($con,"SELECT product_image FROM tbl_product WHERE id='$id'");
    list($picture)=mysqli_fetch_array($result);
    $path="../product_images/$picture";
    if(file_exists($path)==true)
    {
      unlink($path);
    }
    else
    {}
  /*this is delet query*/
  $sql="DELETE FROM tbl_product WHERE id='$id'";
  $query=mysqli_query($con,$sql);
  if ($query) {
    echo "<script>alert('Product Deleted Successfully')</script>";
  }

}
///pagination
if (isset($_GET['page'])) {
$page=$_GET['page'];

}
else {
    $page=1;
}
$num_per_page=05;
$start_from=($page-1)*05;


 
include "sidenav.php";
include "topheader.php";
?>
<!-- End Navbar -->
<div class="content">
  <div class="container-fluid">


    <div class="col-md-14">
      <div class="card ">
        <div class="card-header card-header-primary">
          <h4 class="card-title"> Products List</h4>
          
        </div>
        <div class="card-body">
          <div class="table-responsive ps">
            <table class="table tablesorter " id="page1">
              <thead class=" text-primary">
                <tr>
                  <th>SlNo.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>
                    <a class=" btn btn-primary" href="addproduct.php">Add New</a>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $sql="SELECT * FROM tbl_product  limit $start_from,$num_per_page";
                $query=mysqli_query($con,$sql);
                $cont=1;
                while ($result=mysqli_fetch_array($query)) {

                 ?>
                 <tr>
                  <td><?php echo $cont; ?></td>
                  <td><img src="../product_images/<?php echo $result['product_image']; ?>" alt="" height="100" width="100"></td>
                  <td><?php echo $result['product_title']; ?></td>
                  <td> <?php echo $result['product_price']; ?></td>
                  <td> <a href="?del=<?php echo $result['id'];?>" class="btn btn-danger" onclick="return confirm('Are You sure to Delete!!')">Delete</a></td>
                  


                </tr>
                <?php 
                $cont++;
              }
              ?>



            </tbody>
          </table>
          <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></div>
        </div>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <center>

            <?php
            $pr_query="SELECT * from tbl_product";
            $pr_result=mysqli_query($con,$pr_query);
            $total_record=mysqli_num_rows($pr_result);
            $total_page=ceil($total_record/$num_per_page);

            if ($page>1) {

              echo "<a href='?page=".($page-1)."' class='btn btn-danger'>Previous</a>";

            }
            for ($i=1; $i <$total_page ; $i++) {
              echo "<a href='?page=".$i."' class='btn btn-primary'>$i</a>";
            }
            if ($i>$page) {

              echo "<a href='?page=".($page+1)."' class='btn btn-danger'>Next</a>";

            }


            ?>
          </center>
        </ul>
      </nav>


    </div>


  </div>
</div>
<?php
include "footer.php"; }
?>