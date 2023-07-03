<?php
session_start();
require_once __DIR__ . '/../database/db_patient.php';

$email='';
$password='';
$error='';
$error_email='';
if(isset($_POST['patient_login'])){

  $email = $_POST['email'];
  $password = $_POST['password'];
  $patient=db_patient_log ($email,$password);
/*  if(check_email_validation ($email))
    {
      $error_email="email already exist";
     
    }*/
  if($patient==null)
  {
      $error='Wrong email or password ';
  }else{
    $_SESSION['patient']=$patient;
    header("location: ../pages/home.php");
    exit;
  }
}
 ?>
<?php include __DIR__ . '/../templates/head.php' ?>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start container">
      <style>
        .cascading-right {
          margin-right: -50px;
        }

        @media (max-width: 991.98px) {
          .cascading-right {
            margin-right: 0;
          }
        }
      </style>
      <!-- Jumbotron -->
      <div class="container py-4">
        <div class="row g-0 align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div
              class="card cascading-right"
              style="
                background: hsla(0, 0%, 100%, 0.55);
                backdrop-filter: blur(30px);
              "
            >
              <div class="card-body p-5 shadow-5 text-center">
                <h2 class="fw-bold mb-5">login</h2>
                <form action="pat_login.php" method="post">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input
                      type="email"
                      id="form3Example3"
                      class="form-control"
                      name="email"
                      value="<?php echo $email; ?>"
                      required
                    />
                    <label class="form-label" for="form3Example3"
                      >Email address</label
                    >
                  </div>

                  <!-- Password input -->
                  <div class="form-outline mb-4">
                    <input
                      type="password"
                      id="form3Example4"
                      class="form-control"
                      name="password"
                      required
                    />
                    <label class="form-label" for="form3Example4"
                      >Password</label
                    >
                  </div>

                  <?php if($error): ?>
                  <div>
                    <p class="p_validation" style="color:red;">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
                  <!-- Submit button -->
                  <input type="submit" class="btn btn-primary btn-block mb-4" name="patient_login" value="Login"/>
                  <div>
                    <p class="small fw-bold mt-2 pt-1 mb-0">
                      Don't have an account?
                      <a href="pat_signup.php" target="_self" class="link-danger"
                        >sign up</a
                      >
                    </p>
                    <p class="small fw-bold mt-2 pt-1 mb-0">
                      Do you an staff member?
                      <a href="../staff/staff_login.php" target="_self" class="link-danger"
                        >login here</a
                      >
                    </p>

                    <p class="small fw-bold mt-2 pt-1 mb-0">
                      Do you an admin?
                      <a href="../admin/admin_login.php" target="_self" class="link-danger"
                        >login here</a
                      >
                    </p>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-6 mb-5 mb-lg-0 image">
            <img
              src="../img\surgery.jpeg"
              class="w-100 rounded-4 shadow-4"
              alt=""
            />
          </div>
        </div>
      </div>
      <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <?php include __DIR__ . '/../templates/login_foot.php' ?>
