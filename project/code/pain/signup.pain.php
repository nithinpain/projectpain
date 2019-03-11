<?php
if (isset($_POST['signup-submit']))
 {
    require "db.pain.php";
  
    $username=$_POST['uid'];
    $email=$_POST['mail'];
    $password=$_POST['pwd'];
    $passwordRepeat=$_POST['pwd-repeat'];
    if (empty($username)|| empty($email)|| empty($password)|| empty($passwordRepeat)) {}
    else if ($password !== $passwordRepeat){
        header("location: ../registration.php?");
        exit();
     }
    else{
          $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
           $stmt=mysqli_stmt_init($conn);  
          if (!mysqli_stmt_prepare($stmt,$sql)){
            header("location: ../registration.php?erro=sqlerror");
               exit();
               }
            else
               {
             mysqli_stmt_bind_param($stmt,"s",$username);
             mysqli_stmt_execute($stmt);
              mysqli_stmt_store_result($stmt);}
                $resultCheck=mysqli_stmt_num_rows($stmt);}
               if ($resultCheck>0)
                {
              header("location: ../registration.php?erorr=usertaken&mail".$email);
              exit();
      
             }
              else {
               $sql="INSERT INTO users(uidUsers,emailUsers,pwdUsers) VALUES (?,?,?)";
             $stmt=mysqli_stmt_init($conn);}
             if (!mysqli_stmt_prepare($stmt,$sql)) {
               header("location: ../registration.php?erro=sqlerror");
              exit();
             } 
              else {
                  $hashedpwd=password_hash($password,PASSWORD_DEFAULT);


             mysqli_stmt_bind_param($stmt,"sss",$username,$email,$hashedpwd);
             mysqli_stmt_execute($stmt);
             header("location: ../test.php?signup=sucess");
             exit();
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
      

