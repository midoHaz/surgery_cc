<?php  
require_once __DIR__ . '/../database/db_mr.php';
//$prescription=get_prescription_patient();
$prescription = array();
if (isset($_GET['MRN'])) {
  $MRN = $_GET['MRN'];
  $prescription = database_get_all_medical($MRN);
}
 
?>

<?php include __DIR__ . '/../templates/head.php' ?>
<?php include __DIR__ . '/../templates/nav.php' ?>


<div class="container">
<?php if (!empty($prescription)): ?>
  <div class="card shadow-lg p-3 mb-5 bg-body rounded" style="width: 70rem;padding:30px; margin:auto;margin-top:30px;border:1px solid rgb(15, 79, 148) ;">
  <h2 class="pres_h2">Patient Prescription Data</h2>
  <ul class="list-group list-group-light">
    <li class="list-group-item px-3" style="font-size: 20px; color:rgb(15, 79, 148);">Name : <?= $prescription['first_name'];?> <?= $prescription['last_name'];?></li>
    <li class="list-group-item px-3">MRN : <?= $prescription['mrn'];?> </li>
    <li class="list-group-item px-3">National ID : <?= $prescription['national_id'];?></li>
    <li class="list-group-item px-3">Phone : <?= $prescription['phone'];?></li>
    <li class="list-group-item px-3">Email : <?= $prescription['email'];?> </li>
    <li class="list-group-item px-3"> State : <?= $prescription['current_state'];?></li>
    <li class="list-group-item px-3"> Drugs : <?= $prescription['drugs'];?></li>
    <li class="list-group-item px-3">Revisit : <?= $prescription['revisit'];?></li>
    <li class="list-group-item px-3"> Cost : <?= $prescription['cost'];?> $ </li>
    <li class="list-group-item px-3"> Doc code :<?= $prescription['doc_code'];?></li>
    <li class="list-group-item px-3"> Nurse code : <?= $prescription['nu_code'];?></li>
    <li class="list-group-item px-3"> Service code : <?= $prescription['se_code'];?></li>
  </ul>
</div>

</div>
<?php else: ?>
  <i class="fa-solid fa-book"></i>
    <p class="empty_pres">No prescription found.</p>
  <?php endif; ?>

</div>





















