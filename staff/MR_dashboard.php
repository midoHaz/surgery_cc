<?php  
require_once __DIR__ . '/../database/db_mr.php';
//$prescription=get_prescription_patient();
$prescription = array();
if (isset($_GET['appot_id'])) {
  $id = $_GET['appot_id'];
  $prescription = database_get_specific_medical($id);
}
?>
<?php include __DIR__ . '/../templates/head.php' ?>
<div class="container">
<?php if (!empty($prescription)): ?>
<div class="card bg-dark text-white pres_card">
  <img src="../img/background.jpg" class="card-img" alt="Stony Beach"/>
 
  <div class="card-img-overlay">
  <h2 class="pres_h2">Patient Prescription Data</h2>
  <hr style="width:30%; color:rgb(15, 79, 148); text-align:center; margin:auto; margin-bottom: 30px;">
    <h6 class="card-title">Name : <?= $prescription['pa_name'];?> <?= $prescription['last_name'];?></h6>
    <h6 class="card-title">Mrn : <?= $prescription['mrn'];?></h6>
    <h6 class="card-text">
      State : <?= $prescription['current_state'];?>
</h6>
    <h6 class="card-text">
      Drugs : <?= $prescription['drugs'];?>
</h6>
    <h6 class="card-text">
      Revisit : <?= $prescription['revisit'];?>
</h6>
    <div class="row">
    <h6 class="card-title">Doc code :<?= $prescription['doc_code'];?> </h6>
    <h6 class="card-title">Nurse code : <?= $prescription['nu_code'];?></h6>
    <h6 class="card-title">Service code : <?= $prescription['se_code'];?></h6>
    </div>
  </div>
</div>
<?php else: ?>
  <i class="fa-solid fa-book"></i>
    <p class="empty_pres">No prescription found.</p>
  <?php endif; ?>

</div>





















