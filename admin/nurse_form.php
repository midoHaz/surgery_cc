<?php
require_once __DIR__ . '/../database/db_nurse.php';
$error='';
$error1='';
$error2='';
$phone_error='';
$error_id='';
$error_code='';
$error_email='';
$first_name='';
$last_name='';
$phone='';
$email='';
$national_id='';
$address='';
$shift_time='';
$sallary='';
$additional_info='';
$code='';
if(isset($_POST['add_nurse'])){
  // read patient's data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $national_id = $_POST['national_id'];
  $address = $_POST['address'];
  $shift_time = $_POST['shift_time'];
  $code=$_POST['code'];
  $sallary = $_POST['sallary'];
  $additional_info = $_POST['additional_info'];

  if( $first_name==='' || $last_name==='' || $phone==='' || $email==='' ||
       $shift_time ==='' || $sallary==='' || $national_id==='' ||$code===''||$address==='')
  {
    $error="please fill empty fields";
  }
  if(check_national_nvalidation ($national_id))
  {
    $error_id="national id already exist";
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
if (!preg_match('/^[0-9]{6}+$/', $code)) {
  $error_code= "Invalid code.please enter 6-digit code";
 
}
if (!preg_match('/^[0-9]{14}+$/', $national_id)) {
  $error_id= "Invalid national number. Please enter a 14-digit national number.";
 
}
  if(check_code_nvalidation ($code))
  {
      $error_code="code  already exist";  
  }
  if(check_email_nvalidation($email)){
    $error_email="email already exist";  
  }
  if(!$error_id&&!$error_code&&!$error_email&&!$error) 
  {
  // insert patient into database
  database_add_nurse($first_name, $last_name, $phone, $email, $shift_time,$national_id ,$address, $sallary,  $additional_info, $code );
  // redirect to index page
  header("location: dashboard_admin.php");
  exit;
  }

}
?>

<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">Nurse form</h1>
        <form action="nurse_form.php" method="post">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="form6Example1"
                   name="first_name" 
                   value="<?php echo $first_name; ?>"
                   class="form-control" />
                  <label class="form-label" for="form6Example1">First name</label>
                </div>
              </div>
              <?php if($error1): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error1;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="form6Example2" 
                  name="last_name" 
                  value="<?php echo $last_name; ?>"
                  class="form-control" />
                  <label class="form-label" for="form6Example2">Last name</label>
                </div>
              </div>
              <?php if($error2): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error2;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            </div>
            <!-- Text input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example4" 
              name="address"
              value="<?php echo $address; ?>"
              class="form-control" />
              <label class="form-label" for="form6Example4">Address</label>
            </div>
          
            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example4" 
                name="national_id"
                value="<?php echo $national_id; ?>"
                class="form-control" />
                <label class="form-label" for="form6Example4">National id </label>
              </div>
              <?php if($error_id): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_id;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="email" id="form6Example5"
               name="email" 
               value="<?php echo $email; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example5">Email</label>
            </div>
            <?php if($error_email): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_email;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
          
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example6" 
              name="phone" 
              value="<?php echo $phone; ?>"
              class="form-control" />
              <label class="form-label" for="form6Example6">Phone</label>
            </div>
            <?php if($phone_error): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $phone_error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="number" id="form6Example6" 
              name="code" 
              value="<?php echo $code; ?>"
              class="form-control" />
              <label class="form-label" for="form6Example6">code</label>
            </div>
            <?php if($error_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
             <!-- Number input -->
             <div class="form-outline mb-4">
                <input type="text" id="form6Example6"
                 name="shift_time" 
                 value="<?php echo $shift_time; ?>"
                 class="form-control" />
                <label class="form-label" for="form6Example6">shift time</label>
              </div>
              <!-- Number input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example6" 
                name="sallary" 
                value="<?php echo $sallary; ?>"
                class="form-control" />
                <label class="form-label" for="form6Example6">Salary</label>
              </div>
          
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" id="form6Example7" 
              name="additional_info"
              value="<?php echo $additional_info; ?>"
              rows="4"></textarea>
              <label class="form-label" for="form6Example7">Additional information</label>
            </div>
          
            <?php if($error): ?>
                  <div>
                    <p class="p_validation" style="color:red; text-align:center;font-size:30px">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" name="add_nurse" value="ADD"></input>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>