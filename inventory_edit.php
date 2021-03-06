<?php 
include("db_conn.php");
?>
<?php
 //queries items details
if(isset($_GET['pid'])) { 
$targetID = $_GET['pid'];
$sql = mysqli_query($db_conn, "SELECT * FROM products WHERE id='$targetID' LIMIT 1");
$productCount = mysqli_num_rows($sql); // counts products
if($productCount > 0){
  while($row = mysqli_fetch_array($sql)){
    $pid = $row["id"];
    $productname = $row["productname"];
    $category = $row["category"];
  }
 } else {
 echo"Item does not exist.";
 exit();
 }
}
?>
<?php
// parse form and update inventory
if(isset($_POST['productname'])) {
$id = mysqli_real_escape_string($db_conn, $_POST['thisID']);
$productname = mysqli_real_escape_string($db_conn, $_POST['productname']);
$category = mysqli_real_escape_string($db_conn, $_POST['category']);

$sql=mysqli_query($db_conn, "UPDATE products SET productname='$productname', category='$category' WHERE id='$id'");

header("location:inventory.php");
exit();
}

mysqli_close($db_conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Panel</title>
   <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles/main.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
  <nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- toggle for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="index.php">Admin</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Admin Home</a></li>
        <li><a href="inventory.php">Manage Inventory</a></li>        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
  <div class="jumbotron">
    <div class="container">
      <h2>Edit Existing Product Information</h2>
    </div>
  </div>
  <div class="main-content">
    <div class="container">       
      <form action="inventory_edit.php" method="post">
        Product Name: <input type="text" name="productname" value="<?php echo $productname; ?>">
        Category: 
        <label>
          <select name="category" id="category">
            <option value="<?php echo $category; ?>"><?php echo $category ?></option>
            <option value="category1">category1</option>
            <option value="category2">category2</option>
          </select>
        </label>
        <input name="thisID" type="hidden" value="<?php echo $targetID; ?>">
        <input type="submit" id="button" name="button"/>
      </form>  
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
</body>
</html>