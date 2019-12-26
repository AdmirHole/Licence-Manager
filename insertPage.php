<?php
 require "action.php";
    //session_start();
    if ( !isset( $_SESSION['user_id'] ) ) {
        header("location:login.php?msg=Please Login");
    }
?>


<link rel="stylesheet" href=".\css\forms.css" type="text/css" />
<div id="container"> 
<div id="itemflex"> 
<form method="post" action="action.php">
    <table>
        <tr>
            <th colspan="2" >Insert license</th>
            
        </tr>
        <tr>
            <td>Name</td>
            <td>
                <input type="text" name="name" placeholder="Enter name">
            </td>
        </tr>
        <tr>
            <td>Type</td>
            <td>
                <select name="type">
                    <option value="Monthly">Monthly</option>
                    <option value="Yearly">Yearly</option>
                </select>
            </td>
        </tr>
        <tr>
            <td>Period</td>
            <td>
                <input type="text" name="period" placeholder="Enter period">
            </td>
        </tr>
        <tr>
            <td>Creator</td>
            <td>
                <input type="text" name="creator" placeholder="Enter creator">
            </td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="Add">
            </td>
        </tr>
    </table>
</form>
</div>
</div>