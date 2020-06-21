<?php include "action.php" ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>PHP crud</title>
</head>
<body>

<div class="container mt-5 ">
  <!-- --=============  ERROR =============----- -->
  <?php
  $messages = $_GET["msg"] ?? null ;
  if($messages){
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong><?php echo $messages ?></strong> 
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
    <?php
  }
  ?>
  <!-- --=============  ERROR =============----- -->

  <div class="card shadow">
   <div class="card-header bg-primary">
     <h3 class="text-white text-center">enter medicine details</h3>
   </div>
   <div class="card-body">
    <?php
    if(isset($_GET["update"])){
      $id = $_GET["id"] ?? null ;
      $where = array("id"=>$id);
      $mydata = $obj->select_databy_id("medicene",$where);
      ?>

<form method="POST" action="action.php">

  <input type="hidden" name="id" value="<?php echo $mydata["id"] ?>" >
  <div class="form-group">
    <label for="exampleInputname1">Medicine Name</label>
    <input type="text" name="name" value="<?php echo $mydata["name"] ?>" class="form-control" id="exampleInputname1" required>
  </div>
  <div class="form-group">
    <label for="exampleInquentity1">Quentity</label>
    <input type="number" name="qty" value="<?php echo $mydata["qty"] ?>" class="form-control" id="exampleInquentity1" required>
  </div>

  <button type="submit" name="update" class="btn btn-primary text-center">update</button>
</form>

    <?php
    }else{
      ?>
      <form class="needs-validation"  method="POST" action="action.php">
<div class="form-group">
  <label for="exampleInputname1">Medicine Name</label>
  <input type="text" name="name" id="validationCustom01"  class="form-control" required>
  
</div>
<div class="form-group">
  <label for="exampleInquentity1">Quentity</label>
  <input type="number" name="qty" class="form-control" id="exampleInquentity1" required>
</div>

<button type="submit" name="submit" class="btn btn-primary text-center">Submit</button>
</form>
      <?php
    }
    ?>

  </div>
  </div>
</div>

<div class="container mt-5 mb-5 p-5 shadow">
    <table class="table table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Medicine Name</th>
      <th scope="col">Medicine Quentity</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
   
    <?php
    $mydata = $obj->fetch_record("medicene");
    foreach ($mydata as $data) {
        ?>
    <tr>
      <th scope="row"><?php echo $data["id"] ?></th>
      <td><?php echo $data["name"] ?></</td>
      <td><?php echo $data["qty"] ?></</td>
      <td>
          <a href="index.php?delete=1&id=<?php echo $data["id"] ?>" class="btn btn-danger">Delete</a>
          <a href="index.php?update=1&id=<?php echo $data["id"] ?>" class="btn btn-warning">Edit</a>
      </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>
</div>

    
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>