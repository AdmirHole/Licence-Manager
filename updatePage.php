<?php
    require "action.php";

    //session_start();
    if ( !isset( $_SESSION['user_id'] ) ) {
        header("location:login.php?msg=Please Login");
    }


    if(isset($_GET["update"])){
    //php 7
    $id = $_GET["id"] ?? null;
    $where = array("id"=>$id,);
    $row = $obj->select_record("licences",$where);
?>



<link rel="stylesheet" href=".\css\forms.css" type="text/css" />
<div id="container"> 
<div class="border">
<div id="itemflex"> 
<form method="post" action="action.php">
<table class="table table-hover">
        <tr>
            <th colspan="2" >Update license</th>  
        </tr>
    <tr id="idlicense">
    <td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
    </tr>
    <tr>
    <td>Name</td>
    <td><input type="text" class="form-control" name="name" value="<?php echo $row["name"]; ?>" placeholder="Enter name"></td>
    </tr>
    <tr>
    <td>Type</td>
    <td>
        <select name="type" value="<?php echo $row["type"]; ?>">
            <option value="Monthly">Monthly</option>
            <option value="Yearly">Yearly</option>
        </select>
    </td>
    </tr>
    <tr>
        <td>Period</td>
        <td><input type="text" class="form-control" name="period" value="<?php echo $row["period"]; ?>" placeholder="Enter Period"></td>
    </tr>
    <tr>
        <td>Creator</td>
        <td><input type="text" class="form-control" name="creator" value="<?php echo $row["creator"]; ?>" placeholder="Enter creator"></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="edit" value="Update"></td>
    </tr>
</table>
</form>
</div>
</div>
</div>
<?php
}
?>