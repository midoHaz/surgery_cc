<?php
require_once __DIR__ . '/../database/db_service.php';
$error1='';
$error2='';
$error_code='';
$error_cost='';
$se_name='';
$se_type='';
$cost='';
$additional_info='';
$code='';
$serv_id = isset($_GET['serv_id']) ? $_GET['serv_id'] : null;
if(isset($_GET['serv_id'])) {
  $serv_id=$_GET['serv_id'];
  $service = service_get($serv_id);
if ($service) {
    $se_name = $service['se_name'];
    $se_type = $service['se_type'];
    $cost = $service['cost'];
    $additional_info = $service['additional_info'];
    $code=$service['code'];
}
}
if(isset($_POST['update_services'])){
  // read patient's data
  $se_name = $_POST['se_name'];
  $code = $_POST['code'];
  $se_type = $_POST['se_type'];
  $additional_info = $_POST['additional-info'];
  $cost = $_POST['cost'];
  $serv_id=$_POST['serv_id'];
  if (!preg_match("/^[a-zA-Z-' ]*$/", $se_name) || strlen($se_name) < 3) {
    $error1 = "Only letters and white space allowed";

}
  if (!preg_match("/^[a-zA-Z-' ]*$/", $se_type) || strlen($se_type) < 3) {
    $error2 = "Only letters and white space allowed";
  }
  if (!preg_match('/^[0-9]{6}+$/', $code)) {
    $error_code= "Invalid code.please enter 6-digit code";
   
  }
  if (!preg_match('/^[0-9]{3,6}+$/', $cost)) {
    $error_cost= "Invalid cost";
   
  }
  if(!$error1 && !$error_code&& !$error2)
  {
    // insert patient into database
    database_update_service( $se_name,$code,$se_type,$cost,$additional_info,$serv_id );
    // redirect to index page
    header("location: dashboard_admin.php");
    exit;
  }
  
}
?>

<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">update Service form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="post">
        <?php if(isset($_GET['serv_id'])):?>
              <input type="hidden" name="serv_id" value="<?=$_GET['serv_id']?>">
            <?php endif;?>
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
            <!-- additional_info input -->
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
                      <?php echo $error2;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="numper" id="form6Example4"
               name="cost"
               value="<?php echo $cost; ?>" 
               class="form-control" />
              <label class="form-label" for="form6Example4">cost</label>
            </div>
            <?php if($error_cost): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_cost;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
          
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" id="form6Example6"
               name="additional-info" 
               value="<?php echo $additional_info; ?>"
                rows="4"></textarea>
              <label class="form-label" for="form6Example6">Additional information</label>
            </div>
            <!-- Submit button -->
            
            <input type="submit" class="btn btn-primary btn-block mb-4" name="update_services" value="update"></input>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>