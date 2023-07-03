
<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
      <div class="row">
        <div class="col-3 text-center">
          <h1>Doctor</h1>
          <img
            src="../img\doctor.jpg"
            class="rounded-9 shadow-4 h-40% w-100 im"
            alt=""
          />
          <button type="button" class="btn btn-primary mt-4">
           <a href="doctor_form.php" class="log"> Go to Doctor</a>
          </button>
        </div>
        <div class="col-3 text-center">
          <h1>Nurse</h1>
          <img
            src="../img\nurse.jpg"
            class="rounded-9 shadow-4 h-40% w-100 im"
            alt=""
          />
          <button type="button" class="btn btn-primary mt-4">
            <a href="nurse_form.php" class="log"> Go to Nurse</a>
          </button>
        </div>
        <div class="col-3 text-center">
          <h1>Service</h1>
          <img
            src="../img\service.jpeg"
            class="rounded-9 shadow-4 h-40% w-100 im"
            alt=""
          />
          <button type="button" class="btn btn-primary mt-4">
            <a href="service_form.php" class="log"> Go to Service</a>
          </button>
        </div>
        <div class="col-3 text-center">
          <h1>Service</h1>
          <img
            src="../img\dash.jpg"
            class="rounded-9 shadow-4 h-40% w-100 im"
            alt=""
          />
          <button type="button" class="btn btn-primary mt-4">
            <a href="dashboard_admin.php" class="log"> Show data</a>
          </button>
        </div>
      </div>
    </div>
   
    <?php include __DIR__ . '/../templates/login_foot.php' ?>
