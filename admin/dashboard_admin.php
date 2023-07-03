<?php
require_once __DIR__ . '/../database/db_doctor.php';
require_once __DIR__ . '/../database/db_con.php';
require_once __DIR__ . '/../database/db_nurse.php';
require_once __DIR__ . '/../database/db_service.php';
$doctors = database_get_all_doctors();
$nurses = database_get_all_nurses();
$services = database_get_all_services();
if (isset($_GET['id'])) {
    $doc_id = $_GET['id'];
    database_delete_doctor($doc_id);
    header("Location: ".$_SERVER['PHP_SELF']);
} 
if (isset($_GET['nur_id'])) {
    $nurse_id = $_GET['nur_id'];
    database_delete_nurse($nurse_id);
    header("Location: ".$_SERVER['PHP_SELF']);
} 
if (isset($_GET['ser_id'])) {
    $service_id = $_GET['ser_id'];
    database_delete_service($service_id);
    header("Location: ".$_SERVER['PHP_SELF']);
} 
?>

<?php include __DIR__ . '/../templates/head.php' ?>
<div class="content_dashboard">
<h2 class="h2_table">Doctor information</h2>
<table class="table table-striped table-hover">
<thead class="table-primary">
<tr>
<th>Code</th>
<th>First Name</th>
<th>Last Name</th>
<th>National ID</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Specialist</th>
<th>Available time</th>
<th>Degree</th>
<th>Salary</th>
<th>Additional info </th>
<th>Update </th>
<th>Delete </th>
</tr>
</thead>
<?php foreach($doctors as $doctor): ?>
<tr>
<td><?= $doctor['code'] ?></td>
<td><?= $doctor['first_name'] ?></td>
<td><?= $doctor['last_name'] ?></td>
<td><?= $doctor['national_id'] ?></td>
<td><?= $doctor['phone'] ?></td>
<td><?= $doctor['email'] ?></td>
<td><?= $doctor['address'] ?></td>
<td><?= $doctor['specialist'] ?></td>
<td><?= $doctor['avliable_time'] ?></td>
<td><?= $doctor['degree'] ?></td>
<td><?= $doctor['sallary'] ?></td>
<td><?= $doctor['additional_info'] ?></td>
<td><a href="update_doc_form.php?doc_id=<?=$doctor['doc_id']?>"><i  class="fa-solid fa-pen-to-square  mb-4 me-3" style="color:blue;font-size:20px;"></i></a></td>
<td><a href="dashboard_admin.php?id=<?=$doctor['doc_id']?>"><i  class="fa-solid fa-trash-can  mb-4 me-3" style="color:red;font-size:20px;"></i></a></td>

</tr>
<?php endforeach ?>
</table>

<h2>Nurse information</h2>
<table class="table table-striped table-hover">
<thead class="table-primary">
<tr>
<th>Code</th>
<th>First Name</th>
<th>Last Name</th>
<th>National ID</th>
<th>Phone</th>
<th>Email</th>
<th>Address</th>
<th>Shift time</th>
<th>Salary</th>
<th>Additional info </th>
<th>Update </th>
<th>Delete </th>
</tr>
</thead>
<?php foreach($nurses as $nurse): ?>
<tr>
<td><?= $nurse['code'] ?></td>
<td><?= $nurse['first_name'] ?></td>
<td><?= $nurse['last_name'] ?></td>
<td><?= $nurse['national_id'] ?></td>
<td><?= $nurse['phone'] ?></td>
<td><?= $nurse['email'] ?></td>
<td><?= $nurse['address'] ?></td>
<td><?= $nurse['shift_time'] ?></td>
<td><?= $nurse['sallary'] ?></td>
<td><?= $nurse['additional_info'] ?></td>
<td><a href="update_nurse_form.php?nurse_id=<?=$nurse['nurse_id']?>"><i  class="fa-solid fa-pen-to-square  mb-4 me-3" style="color:blue;font-size:20px;"></i></a></td>
<td><a href="dashboard_admin.php?nur_id=<?=$nurse['nurse_id']?>"><i  class="fa-solid fa-trash-can  mb-4 me-3" style="color:red;font-size:20px;"></i></a></td>

</tr>
<?php endforeach ?>
</table>



<h2>Services information</h2>
<table class="data_doctor"><table class="table table-striped table-hover">
<thead class="table-primary"><tr>
<th>Code</th>
<th>ServicesName</th>
<th>Services type</th>
<th>Cost</th>
<th>Additional info </th>
<th>Update </th>
<th>Delete </th>
</tr>
</thead>
<?php foreach($services as $service): ?>
<tr>
<td><?= $service['code'] ?></td>
<td><?= $service['se_name'] ?></td>
<td><?= $service['se_type'] ?></td>
<td><?= $service['cost'] ?></td>
<td><?= $service['additional_info'] ?></td>
<td><a href="update_service_form.php?serv_id=<?=$service['se_id']?>" target="_self"><i  class="fa-solid fa-pen-to-square  mb-4 me-3" style="color:blue;font-size:20px;"></i></a></td>
<td><a href="dashboard_admin.php?ser_id=<?=$service['se_id']?>"  target="_self"><i  class="fa-solid fa-trash-can  mb-4 me-3" style="color:red;font-size:20px;"></i></a></td>
</tr>
<?php endforeach ?>
</table>
</div>
 <?php include __DIR__ . '/../templates/login_foot.php' ?>