<?php
require_once __DIR__ . '/../database/db_doctor.php';
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
$code='';
$error1='';
$error2='';
$error_id='';
$error_code='';
$additional_info='';
$phone_error='';
$doc_id = isset($_GET['doc_id']) ? $_GET['doc_id'] : null;
if(isset($_GET['doc_id'])) {
  $doc_id=$_GET['doc_id'];
  $doctor = doctor_get($doc_id);
if ($doctor) {
    $first_name = $doctor['first_name'];
    $last_name = $doctor['last_name'];
    $phone = $doctor['phone'];
    $email = $doctor['email'];
    $national_id = $doctor['national_id'];
    $address = $doctor['address'];
    $specialist = $doctor['specialist'];
    $degree = $doctor['degree'];
    $sallary = $doctor['sallary'];
    $code = $doctor['code'];
    $avliable_time = $doctor['avliable_time'];
    $additional_info = $doctor['additional_info'];
}
}
/* update doctor*/ 
if(isset($_POST['update_doctor']))
{
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $national_id = $_POST['national_id'];
  $address = $_POST['address'];
  $specialist = $_POST['specialist'];
  $degree = $_POST['degree'];
  $sallary = $_POST['sallary'];
  $code = $_POST['code'];
  $avliable_time = $_POST['avliable_time'];
  $additional_info = $_POST['additional_info'];
  $doc_id = $_POST['doc_id'];
  
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
if(!$error1&& !$error2 && !$phone_error &&!$error_code)
{
   // update doctor into database
   database_update_doctor($first_name, $last_name, $phone, $email, $specialist,$national_id, $degree, $address, $sallary, $avliable_time, $additional_info ,$code,$doc_id);
   // redirect to main admin page
  header("location: dashboard_admin.php");
  exit;
}else{
  // header('Location: '.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
}
}

?>
<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">Doctor Update Form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <?php if(isset($_GET['doc_id'])):?>
              <input type="hidden" name="doc_id" value="<?=$_GET['doc_id']?>">
            <?php endif;?>
            <div class="row mb-4">
              <div class="col">
                <div class="form-outline">
                  <input type="text" id="form6Example1" name="first_name"
                   class="form-control" 
                   required
                   value="<?=$first_name?>"
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
                  value="<?=$last_name?>"
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
                     value="<?=$specialist?>"
                     class="form-control" />
                    <label class="form-label" for="form6Example1">specialist</label>
                  </div>
                </div>
                <div class="col">
                  <div class="form-outline">
                    <input type="text" id="form6Example2"
                     name="degree" 
                     required
                     value="<?=$degree?>"
                     class="form-control" />
                    <label class="form-label" for="form6Example2">degree</label>
                  </div>
                </div>
              </div>
          
            <!-- Text input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example4" 
              name="address" 
              value="<?=$address?>"
              required
              class="form-control" />
              <label class="form-label" for="form6Example4">Address</label>
            </div>

            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="text" id="form6Example4" 
                name="national_id"
                required
                value="<?=$national_id?>"
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
               value="<?=$email?>"
               class="form-control" />
              <label class="form-label" for="form6Example5">Email</label>
            </div>
          
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example6" 
              name="phone"
              required
              value="<?=$phone?>"
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
                value="<?=$sallary?>" 
                class="form-control" />
                <label class="form-label" for="form6Example6">Salary</label>
              </div>

              
              <div class="form-outline mb-4">
                <input type="number" id="form6Example7" 
                name="code" 
                required
                value="<?=  $code ?>" 
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
                value="<?=  $avliable_time ?>"
                class="form-control" />
                <label class="form-label" for="form6Example6">Available time</label>
              </div>
          
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" 
              id="form6Example7" 
              value="<?=  $additional_info ?>"
              name="additional_info" rows="4"></textarea>
              <label class="form-label" for="form6Example7">Additional information</label>
            </div>
            <!-- Submit button -->
            
            <input type="submit" class="btn btn-primary btn-block mb-4" name="update_doctor" value="UPdate"/>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>