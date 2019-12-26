<?php

include "db.php";
session_start();

class DataOperation extends Database
{
public function insert_record($table,$fileds){
//"INSERT INTO table_name (, , ) VALUES ('username','password')";
$sql = "";
$sql .= "INSERT INTO ".$table;
$sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
$sql .= "('".implode("','", array_values($fileds))."')";
$query = mysqli_query($this->con,$sql);
if($query){
return true;
}

}
public function fetch_record($table){
    $sql = "SELECT * FROM ".$table;
    $array = array();
    $query = mysqli_query($this->con,$sql);
    while($row = mysqli_fetch_assoc($query)){
    $array[] = $row;
}
return $array;
}

public function select_record($table,$where){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
// password = 'hash' AND username = 'something'
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
$query = mysqli_query($this->con,$sql);
$row = mysqli_fetch_array($query);
return $row;

}
public function update_record($table,$where,$fields){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
// id = '5' AND username = 'something'
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
foreach ($fields as $key => $value) {
//UPDATE table SET username = '' , password = '' WHERE id = '';
$sql .= $key . "='".$value."', ";
}
$sql = substr($sql, 0,-2);
$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
if(mysqli_query($this->con,$sql)){
return true;
}
}

public function delete_record($table,$where){
$sql = "";
$condition = "";
foreach ($where as $key => $value) {
$condition .= $key . "='" . $value . "' AND ";
}
$condition = substr($condition, 0, -5);
$sql = "DELETE FROM ".$table." WHERE ".$condition;
if(mysqli_query($this->con,$sql)){
return true;
}
}
}

$obj = new DataOperation;

if(isset($_POST["register"])){
    $myArray = array(
    "username" => $_POST["username"],
    "password" => md5($_POST["password"]) 
    );
    if($obj->insert_record("users",$myArray)){
    header("location:login.php?msg=Record Inserted");
    }
    
    }

if(isset($_POST["submit"])){
$myArray = array(
"name" => $_POST["name"],
"type" => $_POST["type"], 
"period" => $_POST["period"], 
"creator" => $_POST["creator"] 
);
if($obj->insert_record("licences",$myArray)){
header("location:index.php?msg=Record Inserted");
}

}

if(isset($_POST["edit"])){
$id = $_POST["id"];
$where = array("id"=>$id);
$myArray = array(
"name" => $_POST["name"],
"type" => $_POST["type"], 
"period" => $_POST["period"], 
"creator" => $_POST["creator"] 
);
if($obj->update_record("licences",$where,$myArray)){
header("location:index.php?msg=Record Updated Successfully");
}

}

if(isset($_GET["delete"])){
$id = $_GET["id"] ?? null;
$where = array("id"=>$id);
if($obj->delete_record("licences",$where)){
header("location:index.php?msg=Record Deleted Successfully");
}
}


if(isset($_POST["login"])){
    $username = $_POST["username"] ?? null;
    $password = md5($_POST["password"]) ?? null;
    $where = array(
        "username"=>$username,
        "password"=>$password
    );
    if($response = $obj->select_record("users",$where)){
        $id=$response[0];
        $_SESSION['user_id'] = $id;
        header("location:index.php?msg=Login Successfully");
    }else{
        header("location:login.php?msg=Login Failed");
    }
}
?>