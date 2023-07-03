<?php
require_once __DIR__ . '/../database/db_con.php';
$email='';
$code='';
$staff_type='';
$error_message='';
$table_name='';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $email = $_POST['email'];
  $code = $_POST['code'];
  $staff_type = $_POST['staff_type'];

  $conn = database_connect();

  if ($staff_type == 'doctor') {
      $table_name = 'doctor';
  } elseif ($staff_type == 'nurse') {
      $table_name = 'nurse';
  } else{
      die("Invalid staff type");
  }

  $stmt = mysqli_prepare($conn,"SELECT * FROM $table_name WHERE email = ? AND code = ?");
  mysqli_stmt_bind_param($stmt,"ss", $email, $code);
  mysqli_stmt_execute($stmt);
  $result=mysqli_stmt_get_result($stmt);
  if (mysqli_num_rows($result) > 0) {
      // Login successful
      session_start();
      $_SESSION['staff_email'] = $email;
      $_SESSION['staff_type'] = $staff_type;
      header("Location: main_dashboard.php");
  } else {
      // Login failed
      $error_message = "Invalid email or code";
  }
}

?>
<?php include __DIR__ . '/../templates/head.php' ?>
    <!-- Section: Design Block -->
    <section class="text-center text-lg-start container">
      <style>
        body
        {
          overflow: hidden;
        }
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
                <h2 class="fw-bold mb-5">Staff login</h2>
                <?php if (isset($error_message)) : ?>
                 <div style="color: red;"><?php echo $error_message; ?></div>
                  <?php endif ?>
                <form action="staff_login.php" method="post">
                  <!-- Email input -->
                  <div class="form-outline mb-4">
                    <input
                      type="email"
                      id="form3Example3"
                      class="form-control"
                      name="email"
                      value="<?php echo $email; ?>"
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
                      name="code"
                    />
                    <label class="form-label" for="form3Example4"
                      >Password</label
                    >
                  </div>
                  <div class="mb-4">
                    <select name="staff_type" id="form3Example3" class="form-control" value="<?php echo $staff_type; ?>">
                    <option value="" hidden disabled >-----------------------------------------------select staff_type---------------------------------------------</option>
                     <option value="doctor"<?php if ($staff_type == 'doctor') echo ' selected'; ?>>Doctor</option>
                     <option value="nurse"<?php if ($staff_type == 'nurse') echo ' selected'; ?>>Nurse</option>
                    </select>
                  </div>
                  <!-- Submit button -->
                  <input type="submit" class="btn btn-primary btn-block mb-4" name="staff_login" value="Login"/>
                </form>
              </div>
            </div>
          </div>

          <div class="col-lg-5 mb-5 mb-lg-0 image">
            <img src="../img\team-of-doctors3.png" class="h-100 rounded-4 shadow-4" alt="" />
          </div>
        </div>
      </div>
      <!-- Jumbotron -->
    </section>
    <!-- Section: Design Block -->
    <?php include __DIR__ . '/../templates/login_foot.php' ?>