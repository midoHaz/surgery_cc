<?php
require_once __DIR__ . '/../database/db_service.php';
$services = database_get_all_services();
?>

<?php include __DIR__ . '/../templates/head.php' ?>
<?php include __DIR__ . '/../templates/nav.php' ?>
<?php include __DIR__ . '/../templates/header2.php' ?>
<section class="container">
    <div class="row">
    <?php foreach($services as $service): ?>
        <div class="col-lg-4">
          <div class="card text-center  services_card">
  <div class="card-header" style="color:rgb(15, 79, 148);font-size:20px;font-weight:bold;">Services name: <?= $service['se_name'] ?></div>
  <div class="card-body">
    <h5 class="card-title">Type: <?= $service['se_type'] ?></h5>
    <p class="card-text">Info: <?= $service['additional_info'] ?></p>
    <h6  class="card-text"><?= $service['cost'] ?>$</h6>
  </div>
  <div class="card-footer " style="color:#1564BF;font-size:15px;font-weight:bold;">Code: <?= $service['code'] ?></div>
</div>
</div>
<?php endforeach ?>
    </div>

</section>

















<?php include __DIR__ . '/../templates/footer.php' ?>