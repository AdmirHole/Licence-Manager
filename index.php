<?php
include "action.php";

//session_start();
if ( !isset( $_SESSION['user_id'] ) ) {
    header("location:login.php?msg=Please Login");
}

?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <title>Licence Manager</title>
    <link rel="stylesheet" href=".\css\style.css" type="text/css" />
    
</head>

<body>
<div id="container">
<div class="border">
  <div class="panel-heading">
    <div class="nav">
      <div class="heading-name">
        <h1>License Manager</h1>
      </div>  
      <div class="nav-tabs">
        <a href="insertPage.php">Add Licence</a>
        <a href="logout.php">Log out</a>
    </div>
</div>
  </div>
  <div class="panel">
    <div class="main">
      <div class="search">
        <form action="" method="POST">
        <label for="srcfield">Search</label>
          <input type="text" name="srcfield" />
          <label for="srctype">By Type</label>
          <select name="srctype">
              <option value="">..</option>
              <option value="monthly">Monthly</option>
              <option value="yearly">Yearly</option>
          </select>
          <input type="submit" name="search" value="Search" />
      </form>
    </div>
    <div class="table">
      <table style="border:1px solid black;">
          <tr style="color:blue;">
              <th>Name</th>
              <th>Creator</th>
              <th colspan="2">&nbsp;</th>
              
          </tr>
<?php

if(!isset($_POST['search'])){
  
  $myrow = $obj->fetch_record("licences");
  

}else{

        $search = $_POST['srcfield'];
        $type = $_POST['srctype'];

        $query = "SELECT * FROM `licences`";
        $conditions = array();
    
        if(! empty($search)) {
          $conditions[] = "`name` LIKE '%".$search."%'";
        }
        if(! empty($search)) {
          $conditions[] = "`type` LIKE '%".$search."%'";
        }
        if(! empty($type)) {
          $conditions[] = "`type` LIKE '%".$type."%'";
        }
        if(! empty($search)) {
          $conditions[] = "`creator` LIKE '%".$search."%'";
        }
    
        $sql = $query;
        if (count($conditions) > 0) {
          $sql .= " WHERE " . implode(' OR ', $conditions);
          
        
        $array = array();
        $result = mysqli_query($obj->con, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $array[] = $row;
          
      }
     
      $myrow = $array;
      
        }

}
foreach ($myrow as $row) {
?>
  <tr>
    <td><b><?php echo $row["name"]; ?></b></td>
    <td><b><?php echo $row["creator"]; ?></b></td>
    <td><a href="updatePage.php?update=1&id=<?php echo $row["id"]; ?>" class="btn btn-info">Edit</a></td>
    <td><a href="#" onclick="deletePost()">Delete</a></td>
  </tr>


<?php
}
?>
</table>
</div>
</div>
</div>
</div>
<script>
    function deletePost() {
    var ask = window.confirm("Are you sure you want to delete this post?");
    if (ask) {
        window.alert("This license was successfully deleted.");
        window.location.href = "action.php?delete=1&id=<?php echo $row["id"]; ?>";

    }
}
</script>
</body>
</html>