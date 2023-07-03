<?php

require_once __DIR__ . '/../database/db_mr.php';
$error='';
$error_doc_code='';
$error_nu_code='';
$error_se_code='';
$error_mrn='';
$error_appoint='';
$error_mrn2='';
$error_date='';
$pa_name=isset($_GET['first_name']) ? $_GET['first_name'] : null;
$last_name=isset($_GET['last_name']) ? $_GET['last_name'] : null;
$mrn='';
$doc_code='';
$se_code='';
$nu_code='';
$current_state='';
$drugs='';
$revisit='';
$app_id=isset($_GET['appoit_id']) ? $_GET['appoit_id'] : null;

if(isset($_GET['appoit_id'])) {
  $app_id=$_GET['appoit_id'];
}
if(isset($_GET['first_name'])) {
  $pa_name=$_GET['first_name'];
}
if(isset($_GET['last_name'])) {
  $last_name=$_GET['last_name'];
}

// Prepopulate form fields with session variable values
if(isset($_POST['add_medical_record'])){
  // read patient's data
  $pa_name = $_POST['pa_name'];
  $last_name = $_POST['last_name'];
  $drugs = $_POST['drugs'];
  $revisit = $_POST['revisit'];
  $mrn = $_POST['mrn'];
  $doc_code = $_POST['doc_code'];
  $nu_code = $_POST['nu_code'];
  $se_code = $_POST['se_code'];
  $current_state = $_POST['current_state'];
  $app_id = $_POST['app_id'];

  // if( $pa_name==='' || $mrn==='' || $doc_code==='' || $se_code===''|| $nu_code===''|| $current_state==='' || $last_name==='' || $drugs==='' ||$revisit===''||$app_id==='')
  // {
  //   $error="Fill empty filled";
  // }
  if(!check_validation_patient($mrn, $pa_name,$last_name))
  {
    $error_mrn="Data of patient is wrong";
  }
  // if(check_mrn_validation($mrn))
  // {
  //   $error_mrn2="MRN already exist";
  // }
  $today = date('Y-m-d'); // today's date in Y-m-d format
  if (strtotime($revisit) < strtotime($today)) {
    $error_date= 'The date must be today or later.';
  }
  if(check_doc_code_validation($doc_code))
  {
    $error_doc_code='Doctor is not found';
  }
  if(check_nu_code_validation($nu_code))
  {
    $error_nu_code='Nurse is not found';
  }
  if(check_service_code_validation($se_code))
  {
    $error_se_code='Service is not found';
  }
  
  if(!$error_date && !$error_doc_code &&!$error_nu_code && !$error_se_code && !$error_mrn)
 { // insert patient into database
    database_add_medical_record($pa_name, $last_name, $mrn, $doc_code, $app_id, $nu_code, $se_code, $drugs, $revisit, $current_state);
    // redirect to index page
    header("location: main_dashboard.php");
    exit;
 }
}

?>
<?php include __DIR__ . '/../templates/head.php' ?>
    <div class="container">
        <h1 class="text-center forma">Medical Record form</h1>
        <form action="<?php echo $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];?>" method="post">
        <?php if(isset($_GET['appoit_id'])):?>
              <input type="hidden" name="app_id" value="<?=$_GET['appoit_id']?>">
            <?php endif;?>
            <?php if(isset($_GET['first_name'])):?>
              <input type="hidden" name="pa_name" value="<?=$_GET['first_name']?>">
            <?php endif;?>
            <?php if(isset($_GET['last_name'])):?>
              <input type="hidden" name="last_name" value="<?=$_GET['last_name']?>">
            <?php endif;?>
            <!-- Text input -->
            <div class="form-outline mb-4">
              <input type="number" id="form6Example1" 
              name="mrn"
              value="<?php echo $mrn; ?>"
              class="form-control" />
              <label class="form-label" for="form6Example1">MRN</label>
            </div>
            <?php if($error_mrn2): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_mrn2;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Text input -->
         
        
              <?php if($error_mrn): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_mrn;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Email input -->
            <div class="form-outline mb-4">
              <input type="number" id="form6Example3" 
              name="doc_code"
              value="<?php echo $doc_code; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example3">Doctor code</label>
            </div>
            <?php if($error_doc_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_doc_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>

                 
            <div class="form-outline mb-4">
              <input type="number" id="form6Example3" 
              name="nu_code"
              value="<?php echo $nu_code; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example3">Nurse code</label>
            </div>
            <?php if($error_nu_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_nu_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Number input -->
            <div class="form-outline mb-4">
              <input type="number" id="form6Example4"
               name="se_code" 
               value="<?php echo $se_code; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example4">Service code</label>
            </div>
            <?php if($error_se_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_se_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <div class="form-outline mb-4">
              <input type="text" id="form6Example4"
               name="drugs" 
               value="<?php echo $drugs; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example4">Drugs</label>
            </div>
            <div class="form-outline mb-4">
              <input type="date" id="form6Example4"
               name="revisit" 
               value="<?php echo $revisit; ?>"
               class="form-control" />
              <label class="form-label" for="form6Example4">Revisit Date</label>
            </div>
            <?php if($error_date): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_date;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Message input -->
            <div class="form-outline mb-4">
              <textarea class="form-control" id="form6Example6"
               name="current_state" 
               value="<?php echo $current_state; ?>"
                rows="4"></textarea>
              <label class="form-label" for="form6Example6">Current state</label>
            </div>
            <?php if($error): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
            <!-- Submit button -->
           
            <input type="submit" class="btn btn-primary btn-block mb-4" name="add_medical_record" value="ADD Medical Record"></input>
          </form>
    </div>
      
    <?php include __DIR__ . '/../templates/login_foot.php' ?>