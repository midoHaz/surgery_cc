<?php
require_once __DIR__ . '/db_con.php';

function database_book_appointment($pa_name,$last_name, $national_id, $doc_code,$gender,$date,$time,$address, $phone ){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    insert into appointment(pa_name,last_name, national_id, doc_code,gender,date,time,address, phone)
    values (?, ?, ?, ?, ?, ?, ?, ?,? )
    ');
    mysqli_stmt_bind_param($stmt, 'sssisssss',$pa_name,$last_name, $national_id, $doc_code,$gender,$date,$time,$address, $phone);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
 }
 function check_national_validation ($national_id,$name,$last_name)
 {
     $conn = database_connect();
     $stmt = mysqli_prepare($conn, 'select national_id,first_name,last_name from patient where national_id=? and first_name=? and last_name=?');
     mysqli_stmt_bind_param(
         $stmt,
         'sss',
         $national_id,
         $name,
         $last_name
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
   if(mysqli_num_rows($result)==0)
   {
      return true;
   }
   return false;
}
function check_datetime_validation ($date,$time)
 {
     $conn = database_connect();
     $stmt = mysqli_prepare($conn, 'select date,time from appointment where date=? and time=?');
     mysqli_stmt_bind_param(
         $stmt,
         'ss',
         $date,$time
     );
     mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    if(mysqli_num_rows($result)>0)
    {
       return true;
    }
    return false;
 }
 function database_get_all_appointment(){
    $conn = database_connect();
    $result = mysqli_query($conn, 'select * from appointment');
    $appointments = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $appointments;
}

function database_delete_appointment($app_id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    delete from appointment  WHERE app_id=?
    ');
    mysqli_stmt_bind_param($stmt, 's',$app_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }