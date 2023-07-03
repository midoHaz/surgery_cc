
<?php
require_once __DIR__ . '/../database/dp_appoint.php';
$error='';
$error_id='';
$error_code='';
$error_date='';
$pa_name='';
$last_name='';
$phone='';
$national_id='';
$address='';
$time='';
$doc_code='';
$date='';
$gender='';
if(isset($_POST['time_booked'])){
  // read patient's data
  $pa_name=$_POST['pa_name'];
  $last_name=$_POST['last_name'];
$phone=$_POST['phone'];
$national_id=$_POST['national_id'];
$address=$_POST['address'];
$time=$_POST['time'];
$doc_code=$_POST['doc_code'];
$date=$_POST['date'];
$gender=$_POST['gender'];

  if( $pa_name===''||
  $last_name===''||
  $phone===''||
  $national_id===''||
  $address===''||
  $time===''||
  $doc_code===''||
  $date===''||
  $gender==='')
  {
    $error="please fill empty fields";
  }
  if(!check_national_validation ($national_id,$pa_name,$last_name))
  {
    $error_id="patient not available";
  }
  if(check_code_validation ($doc_code))
  {
      $error_code="doctor not found";  
  }
  $today = date('Y-m-d'); // today's date in Y-m-d format
if (strtotime($date) < strtotime($today)) {
  $error_date= 'The date must be today or later.';
}
  if(check_datetime_validation($date,$time)){
    $error_date="appointment already booked";  
  }
  if(!$error_id&&!$error_code&&!$error_date&&!$error) 
  {
  // insert appointment into database
  database_book_appointment($pa_name,$last_name, $national_id, $doc_code,$gender,$date,$time,$address, $phone);
  // redirect to index page
  header("location: feedback.php");
  exit;
  }

}
?>
<?php include __DIR__ . '/../templates/head.php' ?>
<?php include __DIR__ . '/../templates/nav.php' ?>

  <section class="appointmet" style="background-image: url(../img/image2.jpg);  background-position: center;
    background-repeat: no-repeat;
    background-attachment: scroll;
    background-size: cover;
    height: 130vh;">
    
    <div class="booking">
      <H1 class="title">
        Booking Appointmet
      </H1>
      <form action="appointment.php" method="post">
        <div  class="form-outline">
        <input type="text" id="Patient" class="form-control " name="pa_name" value="<?php echo $pa_name; ?>"/>
        <label class="form-label " for="Patient" >Patient  name</label>
      </div>
        <div  class="form-outline">
        <input type="text" id="Patient" class="form-control " name="last_name" value="<?php echo $last_name; ?>"/>
        <label class="form-label " for="Patient" >last name</label>
      </div>
      <div  class="form-outline">
        <input type="text" id="ID" class="form-control " name="national_id" value="<?php echo $national_id; ?>"/>
        <label class="form-label " for="ID">Patient_national_id</label>
      </div>
      <?php if($error_id): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_id;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
      <div  class="form-outline">
        <input type="number" id="Doctor" class="form-control" name="doc_code" value="<?php echo $doc_code; ?>"/>
        <label class="form-label" for="Doctor">Doctor  code</label>
      </div>
      <?php if($error_code): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_code;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
                  <div class="mb-3">
  <select name="gender" id="form3Example3" class="form-control">
    <option value="" hidden disabled>-----------------------------------------------select gender---------------------------------------------</option>
    <option value="male"<?php if ($gender == 'male') echo ' selected'; ?>>Male</option>
    <option value="female"<?php if ($gender == 'female') echo ' selected'; ?>>Female</option>
  </select>
</div>
    <div  class="form-outline">
      <input type="text" id="address" class="form-control" name="address" value="<?php echo $address; ?>"/>
      <label class="form-label" for="address">Address  </label>
    </div>
    <div  class="form-outline">
      <input type="tel" id="pho" class="form-control" name="phone" value="<?php echo $phone; ?>" />
      <label class="form-label" for="pho">Phone  </label>
    </div>
        <div  class="form-outline">
        <input type="date" id="date" class="form-control" name="date" value="<?php echo $date; ?>"/>
        <label class="form-label" for="date">Date  </label>
      </div>
      <?php if($error_date): ?>
                  <div>
                    <p class="p_validation2" style="color:red;">
                      <?php echo $error_date;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
      <div  class="form-outline">
        <input type="time" id="time" class="form-control" name="time" value="<?php echo $time; ?>"/>
      </div>
      <?php if($error): ?>
                  <div>
                    <p class="p_validation" style="color:red; text-align:center;font-size:20px">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
        <input type="submit" id="submit" class="form-control submit" value="Book" name="time_booked"/>
      </form>
    </div>
  </section>
 
 <?php include __DIR__ . '/../templates/footer.php' ?>
   
