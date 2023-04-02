<?php

error_reporting(0);
session_start();

require 'config.php';

if (isset($_POST['chiqish'])) {
   session_destroy();
   header('Location: index.php');
}
//session_destroy();

if(isset($_SESSION['login'])){
require 'edit_user.php';
}

if (!isset($_SESSION['login'])) {
   if ($_GET['page']=='login') {
      require 'login.php';
   }else{
      require 'kirish.php';
   }
   }
    







?>


