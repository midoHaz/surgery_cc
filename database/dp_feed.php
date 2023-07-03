<?php
require_once __DIR__ . '/db_con.php';

function database_feedback($first_name, $last_name, $email, $phone,$about_se,$any_comment)
{
    $conn = database_connect();
    $stmt = mysqli_prepare($conn, '
         insert into feedback(first_name, last_name, email, phone,about_se,any_comment)
         values (?, ?, ?, ?, ?, ?)
         ');
    mysqli_stmt_bind_param(
        $stmt,
        'ssssss',
        $first_name, $last_name,  $email,$phone, $about_se,$any_comment
    );
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
