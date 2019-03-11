<?php

if (isset($_POST['login-submit'])) {
   require "db.pain.php";
   $mailuid=$_POST['mailuid'];
   $password=$_POST['pwd'];
   if (empty($mailuid)|| empty($password)) {
       header("location: ../test.php?error=emptyfeilds");
       exit();
   }
   else {
       $sql="SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
       $stmt=mysqli_stmt_init($conn);
       if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../test.php?error=sqlerror");
        exit();
    }
     else {
         mysqli_stmt_bind_param($stmt,"ss",$mailuid,$mailuid);
         mysqli_stmt_execute($stmt);
         $result=mysqli_stmt_get_result($stmt);
         if ($row=mysqli_fetch_assoc($result)) {
             $pwdCheck=password_verify($password,$row['pwdUsers']);
             if ($pwdCheck==FALSE) {
                header("location: ../test.php?error=wrongpassword");
             }
             elseif($pwdCheck==TRUE){
             session_start();
             $_SESSION['userId']=$row['idUsers'];
             $_SESSION['userUid']=$row['uidUsers'];

             header("location: ../copyhome.html?loginsucess");
             exit();
             }
             
         }
         else {
            header("location: ../test.php?error=nouser");  
         }

           }
       }
}
else {
    header("location: ../test.php");
    exit();
}