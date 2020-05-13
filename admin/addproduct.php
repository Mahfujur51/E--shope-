<?php
session_start();
include('include/db.php');
if(strlen($_SESSION['alogin'])==0)
{
  header('location:login.php');
}
else{
  if(isset($_POST['btn_save']))
  {
    $product_title=$_POST['product_title'];
    $product_desc=$_POST['product_desc'];
    $product_price=$_POST['product_price'];
    $brandid=$_POST['brandid'];
    $catid=$_POST['catid'];

    $product_keyword=$_POST['product_keyword'];
//picture coding
    $picture_name=$_FILES['product_image']['name'];
    $picture_type=$_FILES['product_image']['type'];
    $picture_tmp_name=$_FILES['product_image']['tmp_name'];
    $picture_size=$_FILES['product_image']['size'];
    if($picture_type=="image/jpeg" || $picture_type=="image/jpg" || $picture_type=="image/png" || $picture_type=="image/gif")
    {
      if($picture_size<=50000000)

        $pic_name=time()."_".$picture_name;
      move_uploaded_file($picture_tmp_name,"../product_images/".$pic_name);
      $sql="INSERT INTO tbl_product(catid,brandid,product_title,product_price,product_desc,product_image,product_keyword)VALUES('$catid','$brandid','$product_title','$product_price','$product_desc','$pic_name','$product_keyword')";
      $query=mysqli_query($con,$sql);
      if ($query) {
        echo "<script>alert('Product Inserted Successfully')</script>";

      }else{
         echo "<script>alert('Product Not Inserted Successfully')</script>";
      }

  } }
  include "sidenav.php";
  include "topheader.php";
  ?>
  <!-- End Navbar -->
  <div class="content">
    <div class="container-fluid">
      <form action="" method="post" type="form" name="form" enctype="multipart/form-data">
        <div class="row">


          <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Add Product</h5>
              </div>
              <div class="card-body">

                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Product Title</label>
                      <input type="text" id="product_name" required name="product_title" class="form-control">
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="">
                      <label for="">Add Image</label>
                      <input type="file" name="product_image" required class="btn btn-fill btn-success" id="picture" >
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Description</label>
                      <textarea rows="4" cols="80" id="details" required name="product_desc" class="form-control"></textarea>
                    </div>
                  </div>

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Pricing</label>
                      <input type="text" id="price" name="product_price" required class="form-control" >
                    </div>
                  </div>
                </div>



              </div>

            </div>
          </div>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Categories</h5>
              </div>
              <div class="card-body">

                <div class="row">

                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Product Category</label>
                      <select name="catid" class="form-control">
                        <option>Select Category</option>
                        <?php
                        $sql="SELECT * FROM tbl_category";
                        $query=mysqli_query($con,$sql);
                        while ($result=mysqli_fetch_array($query)) {
                      # code...
                          ?>
                          <option value="<?php echo $result['id'] ?>"><?php echo $result['catname']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Product Brand</label>
                     <select name="brandid" class="form-control">
                        <option>Select Brand</option>
                        <?php
                        $sql="SELECT * FROM tbl_brand";
                        $query=mysqli_query($con,$sql);
                        while ($result=mysqli_fetch_array($query)) {
                      # code...
                          ?>
                          <option value="<?php echo $result['id'] ?>"><?php echo $result['brandname']; ?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </div>
                  </div>


                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Product Keywords</label>
                      <input type="text" name="product_keyword" required class="form-control" >
                    </div>
                  </div>
                </div>

              </div>
              <div class="card-footer">
                <button type="submit" id="btn_save" name="btn_save" required class="btn btn-fill btn-primary">Update Product</button>
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