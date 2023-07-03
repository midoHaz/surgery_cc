<?php
session_start();
 $page = basename($_SERVER['SCRIPT_NAME']);


 ?>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
       
              <img src="../img/png-transparent-cardiology-heart-health-care-computer-icons-medicine-heart.png" alt="logo" style="width: 7%;height: 4%;padding: 7px 0px 0px 20px;" >
      
          <button class="navbar-toggler" type="button" data-mdb-toggle="collapse" data-mdb-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <i class="fas fa-bars"></i>
          </button>
          <?php if (!empty($_SESSION['patient'])): ?>
          <div class="collapse navbar-collapse" id="navbarNav">
              <ul class="navbar-nav">
                  <li class="nav-item">
                      <a class="nav-link <?php if($page==='home.php') echo 'active' ?>" aria-current="page" href="home.php">Home</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="home.php#about">About</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link"  href="home.php#team">Team</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?php if($page==='services.php') echo 'active' ?>" href="services.php">Services</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?php if($page==='specialists.php') echo 'active' ?>" href="specialists.php">Specialists</a>
                  </li>
                  <li class="nav-item">
                      <a class="nav-link <?php if($page==='appointment.php') echo 'active' ?>" href="appointment.php">Appointment</a>
                  </li>
                  <li class="nav-item">
                  <a class="nav-link <?php if($page==='prescription.php') echo 'active' ?>" href="prescription.php?MRN=<?php echo $_SESSION['patient']->MRN;?>">Prescription</a>                  </li>
                  <li class="nav-item">
                      <a class="nav-link" href="#contact">Contact</a>
                  </li>
               
              </ul>
          </div>
          <div class="right">
        <div class="row" style="margin-right: 10px;">
          <div class="col-7" style="text-align: center;">
            <i class="fa-solid fa-user"></i>
            <p class="user_name" style="padding: 0; margin:0">Hi <?php echo $_SESSION['patient']-> first_name;  ?>!</p>
          </div>
          <div class="col-5 last">
            <button class="but_nav"><a class="p_btn" href="../patient/logout.php">Logout</a></button>
          </div>
        
        </div>
      </div>
      <?php else: 
         header("location: ../pages/index.php");
          exit;
          endif; 
          ?>
      </div>
  </nav>