<?php
require_once __DIR__ . '/../database/dp_appoint.php';
$appointments = database_get_all_appointment();
if (isset($_GET['app_id'])) {
    $app_id = $_GET['app_id'];
    database_delete_appointment($app_id);
    header("Location: ".$_SERVER['PHP_SELF']);
} 
?>
<?php include __DIR__ . '/../templates/head.php' ?>
<div class="patient_dashboard">
<h2 class="h2_table">Appointment information</h2>
<table class="table table-striped table-hover">
<thead class="table-primary">
<th>first Name</th>
<th>last Name</th>
<th>National id</th>
<th>Doctor code</th>
<th>Gender</th>
<th>Address </th>
<th>Phone </th>
<th>Date</th>
<th>Time</th>
<th>Delete</th>
<th>ADD MR </th>
<th>View MR </th>
</tr>
</thead>
<?php foreach($appointments as $appointment): ?>
<tr>
<td><?= $appointment['pa_name'] ?></td>
<td><?= $appointment['last_name'] ?></td>
<td><?= $appointment['national_id'] ?></td>
<td><?= $appointment['doc_code'] ?></td>
<td><?= $appointment['gender'] ?></td>
<td><?= $appointment['address'] ?></td>
<td><?= $appointment['phone'] ?></td>
<td><?= $appointment['date'] ?></td>
<td><?= $appointment['time'] ?></td>
<td><a href="main_dashboard.php?app_id=<?=$appointment['app_id']?>"><i  class="fa-solid fa-trash-can  mb-4 me-3" style="color:red;font-size:20px;"></i></a></td>
<td> <a style="color:white;" target="_self" href="medical_record.php?appoit_id=<?=$appointment['app_id']?>&first_name=<?=$appointment['pa_name']?>&last_name=<?=$appointment['last_name']?>" target="self"><i class="fa-solid fa-plus" style="color:blue;font-size:20px;"></i></a></td>
<td><a style="color:white;" href="MR_dashboard.php?appot_id=<?=$appointment['app_id']?>" target="_self"><i class="fa-solid fa-eye" style="color:#4E8098;font-size:20px;"></i></a></td>
</tr>
<?php endforeach ?>
</table>
</div>
<?php include __DIR__ . '/../templates/login_foot.php' ?>