<?php
require_once __DIR__ . '/db_con.php';

/* add new patient */

// add a new patient to database
function database_add_nurse($first_name, $last_name, $phone, $email, $shift_time,$national_id ,$address, $sallary,  $additional_info, $code ){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    insert into nurse(first_name, last_name, phone, email, shift_time,national_id ,address, sallary,  additional_info, code )
    values (?, ?, ?, ?, ?, ?, ?, ? , ?,?)
    ');
    mysqli_stmt_bind_param($stmt, 'sssssssssi',$first_name, $last_name, $phone, $email, $shift_time,$national_id ,$address, $sallary,  $additional_info, $code );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
 }
 function check_national_nvalidation ($national_id)
 {
     $conn = database_connect();
     $stmt = mysqli_prepare($conn, 'select national_id from nurse where national_id=?');
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
 function check_code_nvalidation ($code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select code from nurse where code=?');
    mysqli_stmt_bind_param(
        $stmt,
        'i',
        $code
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
   return false;
}
function check_email_nvalidation ($email)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select email from nurse where email=?');
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


/* show data of nurse */

function database_get_all_nurses(){
    $conn = database_connect();
    $result = mysqli_query($conn, 'select * from nurse');
    $nurses = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $nurses;
}
function database_delete_nurse($nurse_id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    delete from nurse  WHERE nurse_id=?
    ');
    mysqli_stmt_bind_param($stmt, 's',$nurse_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    function nurse_get($nurse_id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, 'select * from nurse where nurse_id = ?');
        mysqli_stmt_bind_param($stmt, 's', $nurse_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $user;
    }
    function database_update_nurse( $first_name, $last_name, $phone, $email,$national_id,  $address, $sallary, $shift_time, $additional_info,$code,$nurse_id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, '
        UPDATE  nurse SET first_name=?, last_name=?, phone=?, email=?,national_id=?, address=?, sallary=?, shift_time=?, additional_info=?,code=?
         WHERE nurse_id=?
        ');
        mysqli_stmt_bind_param($stmt, 'sssssssssis', $first_name, $last_name, $phone, $email,$national_id, $address, $sallary, $shift_time, $additional_info,$code,$nurse_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }