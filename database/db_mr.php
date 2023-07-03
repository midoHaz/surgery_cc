<?php
require_once __DIR__ . '/db_con.php';

/* add new mr */

// add a new mr to database
function database_add_medical_record($pa_name,$last_name, $mrn, $doc_code,$app_id,$nu_code,$se_code,$drugs,$revisit,$current_state){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    insert into medical_record (pa_name,last_name, mrn, doc_code,app_id,nu_code,se_code,drugs,revisit,current_state)
    values (?, ?, ?,? ,?, ?,?,?,?,?)
    ');
    mysqli_stmt_bind_param($stmt, 'ssiiiiisss', $pa_name,$last_name, $mrn, $doc_code,$app_id,$nu_code,$se_code,$drugs,$revisit,$current_state);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }

    function check_validation_patient ($mrn, $first_name,$last_name)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select mrn,first_name,last_name from patient where mrn=? and first_name=? and last_name=?');
    mysqli_stmt_bind_param(
        $stmt,
        'iss',
        $mrn, $first_name,$last_name
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
    return false;
   

}
function check_doc_code_validation ($doc_code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from doctor where code=?');
    mysqli_stmt_bind_param(  $stmt,  'i',  $doc_code );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)==0)
   {
      return true;
   }
   else{
   return false;
   }
}
function check_nu_code_validation ($nu_code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select code from nurse where code=?');
    mysqli_stmt_bind_param(
        $stmt,
        'i',
        $nu_code
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)==0)
   {
      return true;
   }
   return false;
}
function check_service_code_validation ($se_code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select code from services where code=?');
    mysqli_stmt_bind_param(
        $stmt,
        'i',
        $se_code
    );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)==0)
   {
      return true;
   }
   return false;
}
function check_mrn_validation ($mrn)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select mrn from medical_record where mrn=?');
    mysqli_stmt_bind_param(  $stmt,  'i',  $mrn );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
   else{
   return false;
   }
}
function check_appoint_validation ($app_id)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select app_id from medical_record where app_id=?');
    mysqli_stmt_bind_param(  $stmt,  'i',  $app_id );
    mysqli_stmt_execute($stmt);
   $result=mysqli_stmt_get_result($stmt);
   if(mysqli_num_rows($result)>0)
   {
      return true;
   }
   else{
   return false;
   }
}
function database_get_all_medical($mrn){
    $conn = database_connect();
    $sql = "select medical_record.mrn, patient.first_name, patient.last_name, patient.national_id, patient.phone, patient.email, medical_record.doc_code, medical_record.nu_code, medical_record.se_code, medical_record.drugs, medical_record.current_state, medical_record.revisit, services.cost, services.se_name
    FROM medical_record
    LEFT JOIN patient ON medical_record.mrn = patient.MRN
    LEFT JOIN services ON medical_record.se_code = services.code
    WHERE  medical_record.mrn = '$mrn'
    order by medical_record.serial desc";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Fetch the results and return them as an array
        $data = mysqli_fetch_assoc($result);
        return $data;
    } else {
        // Return null if there are no results
        return null;
    }

    // Close the database connection
    mysqli_close($conn);
}

function database_get_all_records(){
    $conn = database_connect();
    $result = mysqli_query($conn, 'select * from medical_record');
    $record = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $record;
}
function medical_get($mrn){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select * from medical_record where mrn = ?');
    mysqli_stmt_bind_param($stmt, 'i', $mrn);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $user;
}
function database_get_specific_medical($id){
    $conn = database_connect();
    $sql = "select * from medical_record WHERE app_id = '$id' order by serial desc";
    $result = mysqli_query($conn, $sql);

    // Check if there are any results
    if (mysqli_num_rows($result) > 0) {
        // Fetch the results and return them as an array
        $data = mysqli_fetch_assoc($result);
        return $data;
    } else {
        // Return null if there are no results
        return null;
    }

    // Close the database connection
    mysqli_close($conn);
}