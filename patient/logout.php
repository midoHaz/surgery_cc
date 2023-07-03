<?php
session_start();
session_destroy();
header('location: pat_login.php');