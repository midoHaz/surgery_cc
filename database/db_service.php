<?php
require_once __DIR__ . '/db_con.php';

/* add new services */

// add a new services to database
function database_add_service($se_name, $se_type,$additional_info, $cost, $code){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    insert into services(se_name, se_type,additional_info, cost, code)
    values (?, ?, ?, ?, ?)
    ');
    mysqli_stmt_bind_param($stmt, 'sssii', $se_name, $se_type,$additional_info, $cost, $code);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    function check_code_svalidation ($code)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, 'select code from services where code=?');
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
function database_get_all_services(){
    $conn = database_connect();
    $result = mysqli_query($conn, 'select * from services');
    $services = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_close($conn);
    return $services;
}
function database_delete_service($se_id){
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
    delete from services  WHERE se_id=?
    ');
    mysqli_stmt_bind_param($stmt, 's',$se_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    }
    function service_get($se_id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, 'select * from services where se_id = ?');
        mysqli_stmt_bind_param($stmt, 's', $se_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $user;
    }
    function database_update_service( $se_name,$code,$se_type,$cost,$additional_info,$se_id){
        $conn = database_connect();
        $stmt = mysqli_prepare($conn, '
        UPDATE  services SET se_name=?, code=?, se_type=?,cost=? , additional_info=?
         WHERE se_id=?
        ');
        mysqli_stmt_bind_param($stmt, 'sissss',   $se_name,$code,$se_type,$cost,$additional_info,$se_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        }
