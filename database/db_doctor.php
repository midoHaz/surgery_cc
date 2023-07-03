<?php
require_once __DIR__ . '/db_con.php';

/* add new patient */

// add a new patient to database
function database_add_doctor($first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info ,$code){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    insert into doctor(first_name, last_name, phone, email, specialist,national_id, degree, address, sallary, avliable_time, additional_info ,code)
    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ');
    mysqli_stmt_bind_param($stmt, 'sssssssssssi', $first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info ,$code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }

    function check_national_validation ($national_id)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select national_id from doctor where national_id=?');
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
function check_code_validation ($code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select code from doctor where code=?');
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
function check_email_validation ($email)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select email from doctor where email=?');
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

/* show data of doctor */

function database_get_all_doctors(){
    $conn = database_connect();
    $result = mysqli_query($conn, 'select * from doctor');
    $doctors = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $doctors;
}
function doctor_get($doc_id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from doctor where doc_id = ?');
    mysqli_stmt_bind_param($stmt, 's', $doc_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;
}
function database_update_doctor( $first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info,$code,$doc_id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    UPDATE  doctor SET first_name=?, last_name=?, phone=?, email=?, specialist=?,national_id=?, degree=?, address=?, sallary=?, avliable_time=?, additional_info=?,code=?
     WHERE doc_id=?
    ');
    mysqli_stmt_bind_param($stmt, 'sssssssssssis', $first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info,$code,$doc_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }

    function database_delete_doctor($doc_id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, '
        delete from doctor  WHERE doc_id=?
        ');
        mysqli_stmt_bind_param($stmt, 's',$doc_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }




    