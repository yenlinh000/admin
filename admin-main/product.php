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
  <h6 class="m-0 font-weight-bold text-primary">Product Management</h6>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addproduct">ADD</button>       
  <div class="card-body">
    <div class="table-responsive">
    <thead>
      <tr>
          <th scope="col">ID</th>
          <th scope="col">Image</th>
          <th scope="col">Name</th>
          <th scope="col">Supplier</th>
          <th scope="col">Category</th>
          <th scope="col">Description</th>
          <th scope="col">Price</th>
          <th scope="col">Last Updated</th>
          <th style="text-align: center;" scope="col" colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php while ($item = pg_fetch_array($query)){ ?>
        <tr>
          <th scope="row"><?= $item['product_id'] ?></th>
          <td><img style="width: 90px; height: 90px;" title="<?= $item['product_name']  ?>" src="images/<?= $item['image'] ?>"></td>
          <td><?=   $item['product_name']   ?></td>
          <td><?=   $item['supplier']       ?></td>
          <td><?=   $item['cat_name']       ?></td>
          <td><?=   $item['description']    ?></td>
          <td><?= number_format($item['price'],2) ?> $</td>
          <td><?= $item['date_modified'] ?></td>
          <td style="text-align: center;"><a href="updateproduct.php?edit=<?= $item['product_id'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-edit"></i></span></a></td>
          <td style="text-align: center;"><a href="product.php?del=<?= $item['product_id'] ?>"><span style="font-size: 20px;"><i style="color:#FF0094 ; " class="far fa-trash-alt"></i></span></a></td>
        </tr>
        <?php } ?>       
    </tbody>
  </table>
</div>
<div style="margin: 20px;border: 1px solid gray; text-align: center; width: 50%; position: absolute; left: 50%; transform: translateX(-50%);">
      <h2 style="margin:20px; color:#FF0094; ">Add a new Toy</h2>
      <form method="POST" enctype="multipart/form-data">
        <label>Toy Name :</label>
        <input type="text" name="product_name"><br>

        <label>Image :</label>
        <input name="Img" type="file"><br>

        <label>Category :</label>
        <select name="cat_name" style="width: 30%; color:#FF0094; background:#343A40; ">

          <?php 
            $sql1 = "SELECT * FROM category ORDER BY catName DESC";
            $query1 = mysqli_query($conn, $sql1);
            while($option = mysqli_fetch_array($query1)){
          ?>
          <option value="<?= $option['cat_name'] ?>"><?= $option['cat_name'] ?></option>
          <?php } ?>

        </select><br>

        <label>Price :</label>
        <input type="text" name="price" pattern="[0-9]+" title="please enter number only" max="999" min="0" required="required"><br>

        <label>Description :</label>
        <textarea name="des"></textarea><br>

        <input style="width: 20%; margin: 10px;" type="submit" name="add" value="Add Song">
      </form>
    </div>
  </div>
</div>
</div>
