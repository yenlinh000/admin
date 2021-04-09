<?php 
    include("menu.php");
    $sql = "SELECT * FROM product";
    $query = pg_query($conn,$sql);
    date_default_timezone_set('Asia/Ho_Chi_Minh');

// Click Del icon
if(isset($_GET['del'])){
  $id = $_GET['del'];
  $sql = "DELETE FROM product WHERE product_id = $id";
  if($query = mysqli_query($conn, $sql)){

    function function_alert($message) { 
         // Display the alert box  
        echo "<script>alert('$message');</script>"; 
      } 
    function_alert('Deleted success fully!');

     header('location:product.php');
  }
}

      

//Click Add
if(isset($_POST['add'])){
      $toyName  =  $_POST['product_name'];
      $time     =  date("Y-m-d"); 
      $price    =  $_POST['price'];
      $cat      =  $_POST['cat_name'];
      $file1    =  $_FILES['img'];
      $img      =  $file1['name'];
      $des      =  $_POST['des'];
      $supplier =  $_POST['supplier'];
      move_uploaded_file($file1['tmp_name'], "images/".$img);
      $sql= "INSERT INTO product (image, description, price, supplier, date_modified, cat_name, product_name) VALUES('$img', '$des', $price, '$supplier', '$time', '$cat', '$toyName')";
      if ($query = pg_query($conn, $sql)) {
        
        header("location:product.php");
        function function_alert($message) { 
              // Display the alert box  
              echo "<script>alert('$message');</script>"; 
        } 
            function_alert('Added! success fully!');
      }
      else{
        echo '<script language="javascript">Error</script>';
      }
}      
 ?>
<div class="container-fluid">

<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Product Management
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproduct">
        ADD
      </button>
    </h6>
  </div>
  <div class="card-body">

    <div class="table-responsive">
    <?php

        $query = "SELECT * FROM product";
        $query_run = mysqli_query($conn, $query);
        
    ?>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
              <th>ID</th>
              <th>Image</th>
              <th>Name</th>
              <th>Supplier</th>
              <th>Category</th>
              <th>Description</th>
              <th>Price</th>
              <th>Last updated</th>
              <th>EDIT</th>
              <th>DELETE</th>
          </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query_run) > 0)        
        {
            while($row = mysqli_fetch_assoc($query_run))
            {
               ?>
          <tr>
            <td><?= $row['id'] ?></td>
            <td><img class="product-image" src="../<?= $row['image']?>"/></td>
            <td><?php  echo $row['product_name']; ?></td>
            <td><?php  echo $row['supplier']; ?></td>
            <td><?php  echo $row['cat_name']; ?></td>
            <td><?php  echo $row['description']; ?></td>
            <td>
                <form action="editproduct.php" method="post">
                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                    <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
                </form>
            </td>
            <td>
                <form action="deleteproduct.php" method="post">
                  <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                  <button type="submit" name="delete_btn" class="btn btn-danger"> DELETE</button>
                </form>
            </td>
          </tr>
          <?php
            } 
        }
        else {
            echo "No Record Found";
        }
        ?>
        </tbody>
      </table>
   
    </div>
  </div>
</div>
