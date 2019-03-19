<?php
/**
 * Created by PhpStorm.
 * User: Black
 * Date: 3/18/2019
 * Time: 11:20 PM
 */
include "conn.php";
//check name and birthdate already exit if exit == true
function checkName($name,$conn){
    $sql = "SELECT *FROM student WHERE studentName='".$name."' and bithDate='".$_POST['birthDate']."'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0)
        return true;
    else
        return false;
}

//upload image to dir photos
function uploadPhoto(){
    $oldpath = $_FILES['photo']['tmp_name'];
    $newpath ="photos/".$_FILES['photo']['name'];
    move_uploaded_file($oldpath, $newpath);
}


//Insert Data to database
function addData($conn){
    $sql="INSERT INTO student (studentName, bithDate,address,photoName)
    VALUES ('".$_POST['studentName']."', '".$_POST['birthDate']."', '".$_POST['address']."','photos/".$_FILES['photo']['name']."')";
    if (mysqli_query($conn, $sql)) {
        echo "<h3>Create Student Successfully</h3>";
      uploadPhoto();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}


if(checkName($_POST['studentName'],$conn)){
    echo "<h3>Student Information is Already exist</h3>";
}
else{
    addData($conn);
}

echo "<a href='create.html'>More </a>";
echo "<a href='display.php'> View</a>";
