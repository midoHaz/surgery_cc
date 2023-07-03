<?php
session_start();
require_once __DIR__ . '/../database/db_patient.php';
$error = '';
$error1 = '';
$error2 = '';
$first_name = '';
$last_name = '';
$phone = '';
$email = '';
$national_id = '';
$error_id = '';
$error_email = '';
$phone_error=' ';
$pass_error=' ';
if (isset($_POST['add_patient'])) {

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $national_id = $_POST['national_id'];
  $password = $_POST['password'];
  $confirm_pass = $_POST['confirm_pass'];

  if ($first_name == '' || $last_name === '' || $phone === '' ||  $email === '' || $national_id === '' || $password === '' || $confirm_pass === '') {
    $error = "please fill the empty fields";
  }

  if (check_national_validation($national_id)) {
    $error_id = "national id already exist";
  }

  if (!preg_match("/^[a-zA-Z-' ]*$/", $first_name) || strlen($first_name) < 3) {
    $error1 = "Only letters and white space allowed";

}
  if (!preg_match("/^[a-zA-Z-' ]*$/", $last_name) || strlen($last_name) < 3) {
    $error2 = "Only letters and white space allowed";

}

// check that the doctor phone contains Only 11 numbers
if (!preg_match('/^[0-9]{11}+$/', $phone)) {
  $phone_error= "Invalid phone number.please enter 11-digit phone number";
 
}
if (!preg_match('/^[0-9]{14}+$/', $national_id)) {
  $error_id= "Invalid national number. Please enter a 14-digit national number.";
 
}
if(strlen($password)<8)
{
  $pass_error= "Invalid password. Please enter more than 8-digit for password.";
}
  if (check_email_validation($email)) {
    $error_email = "email already exist";
  }
  if ($password !== $confirm_pass) {
    $error = "Confirm Password does not match with password";
  }
  if (!$error && !$error_id && !$error_email) {
    // insert patient into database
    database_add_patient(
      $first_name,
      $last_name,
      $phone,
      $email,
      $national_id,
      $password,
      $confirm_pass
    );
    // $patient = patient_get($MRN);
    // redirect to index page
    //  $_SESSION['patient']=$patient;
    header("location:pat_login.php");
    exit;
  }
 
 
}
?>

<?php include __DIR__ . '../../templates/head.php' ?>
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
        <div class="card cascading-right" style="
                background: hsla(0, 0%, 100%, 0.55);
                backdrop-filter: blur(30px);
              ">
          <div class="card-body p-5 shadow-5 text-center">
            <h2 class="fw-bold mb-5">sign up</h2>
            <form action="pat_signup.php" method="post">
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input required type="text" id="form3Example1" name="first_name" class="form-control" 
                    value="<?php echo $first_name; ?>" />
                    <label class="form-label" for="form3Example1">First name</label>
                  </div>
                  <?php if ($error1) : ?>
                    <div>
                      <p class="p_validation2" style="color:red;">
                        <?php echo $error1;  ?>
                      </p>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input requried type="text" id="form3Example2" class="form-control" name="last_name" value="<?php echo $last_name; ?>" />
                    <label class="form-label" for="form3Example2">Last name</label>
                  </div>
                  <?php if ($error2) : ?>
                    <div>
                      <p class="p_validation2" style="color:red;">
                        <?php echo $error2;  ?>
                      </p>
                    </div>
                  <?php endif; ?>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input required type="text" id="form3Example1" class="form-control" name="phone" value="<?php echo $phone; ?>" />
                    <label class="form-label" for="form3Example1">phone number</label>
                  </div>
                  <?php if ($phone_error) : ?>
                    <div>
                      <p class="p_validation2" style="color:red;">
                        <?php echo $phone_error;  ?>
                      </p>
                    </div>
                  <?php endif; ?>
                </div>
                <div class="col-md-6 mb-4">
                  <div class="form-outline">
                    <input required type="text" id="form3Example2" class="form-control" name="national_id" value="<?php echo $national_id; ?>" />
                    <label class="form-label" for="form3Example2">National_id</label>
                  </div>
                  <?php if ($error_id) : ?>
                    <div>
                      <p class="p_validation2" style="color:red;">
                        <?php echo $error_id;  ?>
                      </p>
                    </div>
                  <?php endif; ?>
                </div>

              </div>

              <!-- Email input -->
              <div class="form-outline mb-4">
                <input required type="email" id="form3Example3" class="form-control" name="email" value="<?php echo $email; ?>" />
                <label class="form-label" for="form3Example3">Email address</label>
              </div>

              <?php if ($error_email) : ?>
                <div>
                  <p class="p_validation" style="color:red;">
                    <?php echo $error_email;  ?>
                  </p>
                </div>
              <?php endif; ?>

              <!-- Password input -->
              <div class="form-outline mb-4">
                <input required type="password" id="form3Example4" class="form-control" name="password" />
                <label class="form-label" for="form3Example4">Password</label>
              </div>
              <?php if ($pass_error) : ?>
                <div>
                  <p class="p_validation" style="color:red;">
                    <?php echo $pass_error;  ?>
                  </p>
                </div>
              <?php endif; ?>
              <!-- Password input -->
              <div class="form-outline mb-4">
                <input required type="password" id="form3Example4" class="form-control" name="confirm_pass" />
                <label class="form-label" for="form3Example4">confirm password</label>
              </div>
              <?php if ($error) : ?>
                <div>
                  <p class="p_validation" style="color:red;">
                    <?php echo $error;  ?>
                  </p>
                </div>
              <?php endif; ?>
              <!-- Submit button -->
              <input type="submit" class="btn btn-primary btn-block mb-4" name="add_patient" value="sign up" />

              <div>
                <p class="small fw-bold mt-2 pt-1 mb-0">
                  Already have an account?
                  <a href="pat_login.php" target="_self" class="link-danger">login</a>
                </p>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-6 mb-5 mb-lg-0 image">
        <img src="../img\surgery.jpeg" class="w-100 rounded-4 shadow-4" alt="" />
      </div>
    </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->

<?php include __DIR__ . '/../templates/login_foot.php' ?>