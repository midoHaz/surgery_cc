<?php
require_once __DIR__ . '/db_con.php';

function db_admin_log ($username, $password)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from admin where username=? and password=?');
    mysqli_stmt_bind_param(
        $stmt,
        'ss',
        $username,$password
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      $admin=(object)mysqli_fetch_assoc($result);
   }else{
    $admin=null;    
   }
   return $admin;
}