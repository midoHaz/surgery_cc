<?php
require_once __DIR__ . '/db_con.php';

/* add new patient */

// add a new patient to database
function database_add_patient($first_name, $last_name, $phone, $email, $national_id, $password, $confirm_pass)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
         insert into patient(first_name, last_name, phone, email, national_id, password, confirm_pass)
         values (?, ?, ?, ?, ?, ?,?)
         ');
    mysqli_stmt_bind_param(
        $stmt,
        'sssssss',
        $first_name, $last_name, $phone, $email, $national_id, $password, $confirm_pass
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

function check_national_validation ($national_id)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select national_id from patient where national_id=?');
    mysqli_stmt_bind_param(
        $stmt,
        's',
        $national_id
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
   return false;
}
function check_email_validation ($email)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select email from patient where email=?');
    mysqli_stmt_bind_param(
        $stmt,
        's',
        $email
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
   return false;
}

function db_patient_log ($email, $password)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from patient where email=? and password=?');
    mysqli_stmt_bind_param(
        $stmt,
        'ss',
        $email,$password
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      $patient=(object)mysqli_fetch_assoc($result);
   }else{
    $patient=null;
   }
   return $patient;
}

function patient_get($MRN){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from patient where MRN = ?');
    mysqli_stmt_bind_param($stmt, 'i', $MRN);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;
}
