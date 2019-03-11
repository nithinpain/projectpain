<?php
session_start();
include_once "db.upload.php";



if (isset($_POST['submit'])) {
    $file=$_FILES['file'];

    $fileName=$_FILES['file']['name'];
    $fileTmpName=$_FILES['file']['tmp_name'];
    $fileSize=$_FILES['file']['size'];
    $fileError=$_FILES['file']['error'];
    $fileType=$_FILES['file']['type'];

    $fileExt=explode('.',$fileName);
    $fileActulExt=strtolower(end($fileExt));

    $allowed=array('jpg','jpeg',);

    if (in_array($fileActulExt,$allowed)) {
        if ($fileError===0) {
            if ($fileSize<1000000) {
               $fileNameNew="profile".'.'.$fileActulExt;
               $fileDestination='uploads/'.$fileNameNew;
               move_uploaded_file($fileTmpName,$fileDestination);
               $sql="UPDATE profileimg SET status=0 WHERE userid='$id'";
               $result=mysqli_query($conn,$sql);
               header("location: recent.php?uploadsuccess");
            }else {
                echo "asshole upload a file with less filesize";
            }
        }else {
            echo "uploading error";
        }
    }else {
        echo "check file type & upload again";
    }
}