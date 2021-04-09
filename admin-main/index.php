<?php 
  include('connect.php');
    if (isset($_POST['login'])) {
        $name  = $_POST['uname'];
        $pass  = $_POST['psw'];
        $query = pg_query($conn, "SELECT * FROM account WHERE user_name = '$name' AND password = '$pass'");
        $row = pg_num_rows($query);
        if ($row > 0){
            header("location:product.php");
        }
        else{
            echo "Sai thong tin dang nhap"; 
        }
    }

 ?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="admin.css">
</head>
<body>

<h2>Modal Login Form</h2>

<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>

<div id="id01" class="modal">
  
  <form class="modal-content animate" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required> 
      <button type="submit" name="login">Login</button>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>
