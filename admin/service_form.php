<?php
require_once __DIR__ . '/../database/db_service.php';
$error='';
$error1='';
$error2='';
$error_code='';
$se_name='';
$se_type='';
$cost='';
$additional_info='';
if(isset($_POST['add_services'])){
  // read patient's data
  $se_name = $_POST['se_name'];
  $se_type = $_POST['se_type'];
  $cost = $_POST['cost'];
  $additional_info = $_POST['additional-info'];
  $code = $_POST['code'];

  if( $se_name==='' || $se_type==='' || $cost==='' || $code==='')
  {
    $error="It must not be empty";
  }
   if(check_code_svalidation ($code))
  {
    $error_code="code  already exist";
   
  }
  if (!preg_match("/^[a-zA-Z-' ]*$/", $se_name) || strlen($se_name) < 3) {
    $error1 = "Only letters and white space allowed";

}
  if (!preg_match("/^[a-zA-Z-' ]*$/", $se_type) || strlen($se_type) < 3) {
    $error2 = "Only letters and white space allowed";
  }
  if (!preg_match('/^[0-9]{6}+$/', $code)) {
    $error_code= "Invalid code.please enter 6-digit code";
   
  }
  if(!$error && !$error_code){
    // insert patient into database
    database_add_service($se_name, $se_type,$additional_info, $cost, $code);
    // redirect to index page
    header("location: dashboard_admin.php");
    exit;
  }
  
}
?>

<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">Service form</h1>
        <form action="service_form.php" method="post">
            
            <!-- Text input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example1" 
              name="se_name"
              value="<?php echo $se_name; ?>"
              class="form-control" />
              <label class="form-label" for="form6Example1">Service Name</label>
            </div>
            <?php if($error1): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error1;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Text input -->
            <div class="form-outline mb-4">
                <input type="number" id="form6Example2"
                 name="code"
                 value="<?php echo $code; ?>" 
                 class="form-control" />
                <label class="form-label" for="form6Example2">Service code</label>
              </div>
              <?php if($error_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="text" id="form6Example3" 
              name="se_type"
              value="<?php echo $se_type; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example3">Surgery type</label>
            </div>
            <?php if($error2): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error1;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
          
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="number" id="form6Example4"
               name="cost"
               value="<?php echo $cost; ?>" 
               class="form-control" />
              <label class="form-label" for="form6Example4">cost</label>
            </div>

          
          
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" id="form6Example6"
               name="additional-info" 
               value="<?php echo $additional_info; ?>"
                rows="4"></textarea>
              <label class="form-label" for="form6Example6">Additional information</label>
            </div>
            <?php if($error): ?>
                  <div>
                    <p class="p_validation" style="color:red; text-align:center;font-size:30px">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
          
            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" name="add_services" value="ADD"></input>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>