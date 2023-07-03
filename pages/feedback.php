<?php
require_once __DIR__ . '/../database/dp_feed.php';
$error='';
$first_name='';
$last_name='';
$phone='';
$email='';
$about_se='';
$any_comment='';
if(isset($_POST['submit_feedback'])){

  $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $about_se = $_POST['about_se'];
    $any_comment = $_POST['any_comment'];
    if($first_name=='' || $last_name==='' || $phone===''||  $email==='' || $any_comment==='' || $about_se ==='')
    {
      $error="please fill the empty fields";
    }else{
      database_feedback($first_name, $last_name, $email, $phone,$about_se,$any_comment);
      header("location:home.php");
      exit;
    }
  }
 ?>
<?php include __DIR__ . '/../templates/head.php' ?>
<?php include __DIR__ . '/../templates/nav.php' ?>
  <section class="container feedback">
        <div class="row">
            <div class="left-side col-lg-6 image">
                <img src="../img/feedback2.jpg" alt="">
            </div>
            <div class="right-side col-lg-6 form_feedback">
                <h2>
                    Feed back
                </h2>
                <form class=" g-3 needs-validation format_feedback" novalidate action="feedback.php" method="post">
                    <div class=" position-relative">
                      <div class="form-outline">
                      <input type="text" id="form6Example6" 
                      name="first_name"
                      value="<?php echo $first_name ;?>" 
                      required
                
                class="form-control" />
                <label class="form-label" for="form6Example6">First name</label>
                      </div>
                    </div>
                    <div class=" position-relative">
                      <div class="form-outline">
                      <input type="text" id="form6Example7" 
                name="last_name"
                value="<?php echo $last_name ;?>" 
                required
                
                class="form-control" />
                <label class="form-label" for="form6Example7">Last name </label>
                      </div>
                    </div>
                    <div class=" position-relative">
                      <div class="input-group form-outline">
                      <input type="text" id="form6Example8" 
                name="email" 
                value="<?php echo $email ;?>"
                required
                
                class="form-control" />
                <label class="form-label" for="form6Example8">Email</label>
                      </div>
                    </div>
                    <div class=" position-relative">
                      <div class="form-outline">
                      <input type="text" id="form6Example9" 
                name="phone" 
                value="<?php echo $phone ;?>"
                required
               
                class="form-control" />
                <label class="form-label" for="form6Example9">Contact us</label>
                      </div>
                    </div>
                    <div class=" position-relative">
                      <div class="form-outline">
                      <input type="text" id="form6Example4" 
                name="about_se" 
                value="<?php echo $about_se ;?>"
                required
                
                class="form-control" />
                <label class="form-label" for="form6Example4">About Services</label>
                      </div>
                    </div>
                    <div class="form-outline">
                    <textarea class="form-control" 
                                id="form6Example3" 
                                value="<?php echo $any_comment ;?>"
                                name="any_comment" rows="4"></textarea>
                    <label class="form-label" for="form6Example3">Another Cooment </label>
                      </div>
                      <?php if($error): ?>
                  <div>
                    <p class="p_validation" style="color:red;">
                      <?php echo $error;  ?>
                    </p>
                  </div>
                  <?php endif; ?>
                    <div class="button">
                      <button class="btn btn-primary" type="submit" name="submit_feedback">Submit form</button>
                    </div>
                  </form>
            </div>
        </div>
   </section>
 <?php include __DIR__ . '/../templates/footer.php' ?>