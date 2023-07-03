<?php
require_once __DIR__ . '/../database/db_doctor.php';


$error='';
$error_id='';
$error_code='';
$error_email='';
$first_name='';
$last_name='';
$phone='';
$email='';
$national_id='';
$address='';
$specialist='';
$degree='';
$sallary='';
$avliable_time='';
$additional_info='';
$code='';
$error1 = '';
$error2 = '';
$phone_error=' ';
$pass_error=' ';

/* add new doctor */ 
if(isset($_POST['add_doctor'])){
  // read patient's data
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $national_id = $_POST['national_id'];
  $address = $_POST['address'];
  $specialist = $_POST['specialist'];
  $degree = $_POST['degree'];
  $sallary = $_POST['sallary'];
  $avliable_time = $_POST['avliable_time'];
  $additional_info = $_POST['additional_info'];
  $code = $_POST['code'];

  if($code==='' || $first_name==='' || $last_name==='' || $phone==='' || $email==='' ||
     $email==='' || $degree==='' || $specialist ==='' || $sallary==='' || $avliable_time==='')
  {
      $error="please fill empty fields";
  }
  if(check_national_validation ($national_id))
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
if (!preg_match('/^[0-9]{14}+$/', $national_id)) {
  $error_id= "Invalid national number. Please enter a 14-digit national number.";
 
}
if (!preg_match('/^[0-9]{6}+$/', $code)) {
  $error_code= "Invalid code.please enter 6-digit code";
 
}
   if(check_code_validation ($code))
  {
      $error_code="code  already exist";  
  }
  if(check_email_validation($email)){
    $error_email="email already exist";  
  }
  if(!$error_id&&!$error_code&&!$error_email&&!$error &&!$error1 && !$error2) 
  {
       // add doctor into database
      database_add_doctor($first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info ,$code);
      // redirect to main admin page
      header("location: dashboard_admin.php");
      exit;
    }

}

/* update doctor*/ 
if(isset($_POST['update_doctor']))
{
  $code = $_GET['code'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $national_id = $_POST['national_id'];
  $address = $_POST['address'];
  $specialist = $_POST['specialist'];
  $degree = $_POST['degree'];
  $sallary = $_POST['sallary'];
  $avliable_time = $_POST['avliable_time'];
  $additional_info = $_POST['additional_info'];

   // update doctor into database
   database_update_doctor($code, $first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info,$doc_id );
   // redirect to main admin page
   header("location: dashboard_admin.php");
   exit;
}

?>
<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">Doctor form</h1>
        <form action="doctor_form.php" method="post">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="form6Example1" name="first_name"
                   class="form-control" 
                   required
                   value="<?php echo $first_name; ?>"
                   />
                  <label class="form-label" for="form6Example1">First name</label>
                </div>
                <?php if($error1): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error1;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
              </div>
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="form6Example2" 
                  name="last_name" 
                  required
                  value="<?php echo $last_name; ?>"
                  class="form-control" />
                  <label class="form-label" for="form6Example2">Last name</label>
                </div>
                <?php if($error2): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error2;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
              </div>
            </div>
          
            <div class="row mb-4">
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form6Example1"
                     name="specialist"
                     required
                     value="<?php echo $specialist; ?>"
                     class="form-control" />
                    <label class="form-label" for="form6Example1">specialist</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form6Example2"
                     name="degree" 
                     required
                     value="<?php echo $degree; ?>"
                     class="form-control" />
                    <label class="form-label" for="form6Example2">degree</label>
                  </div>
                </div>
              </div>
          
            <!-- Text input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example4" 
              name="address" 
              value="<?php echo $address; ?>"
              required
              class="form-control" />
              <label class="form-label" for="form6Example4">Address</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example4" 
                name="national_id"
                required
                value="<?php echo $national_id; ?>"
                class="form-control" />
                <label class="form-label" for="form6Example4">National id</label>
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
               required
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
              required
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
                <input type="text" 
                id="form6Example6" 
                name="sallary"
                required
                value="<?php echo $sallary; ?>" 
                class="form-control" />
                <label class="form-label" for="form6Example6">Salary</label>
              </div>

              <!---->
              <div class="form-outline mb-4">
                <input type="number" id="form6Example7" 
                name="code" 
                required
                value="<?php echo $code; ?>"
                class="form-control" />
                <label class="form-label" for="form6Example7">code</label>
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
                name="avliable_time" 
                required
                value="<?php echo $avliable_time; ?>"
                class="form-control" />
                <label class="form-label" for="form6Example6">Available time</label>
              </div>
          
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" 
              id="form6Example7" 
              value="<?php echo $additional_info; ?>"
              name="additional_info" rows="4"></textarea>
              <label class="form-label" for="form6Example7">Additional information</label>
            </div>
            <?php if($error): ?>
                  <div>
                    <h2 class="p_validation" style="color:red; text-align:center;font-size:30px">
                      <?php echo $error;  ?>
                    </h2>
                  </div>
                  <?php endif; ?>
          
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" name="add_doctor" value="ADD"></input>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>