<?php

require 'config.php';

if(isset($_POST['register_button'])){


$user_array = db::array_single( "SELECT * FROM users WHERE LOGIN='$_POST[login]'");

if(isset($user_array['ID'])){
    echo "<script> alert('Ushbu nomdagi foydalanuvchi mavjud !'); </script>";
}else{

$add_user = db::query( "INSERT INTO `users`(`NAME`, `LOGIN`, `PASSWORD`, `BALANCE`, `STATUS`) VALUES('$_POST[name]','$_POST[login]','$_POST[password]','$_POST[balance]','1')");
        header('Location: index.php');
}
}

 ?> 





<!DOCTYPE html >
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=divice-width, initial-scale=1.0">
        <title>Document</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>

	<div class="row">

<div class="col-9">
</div>

    </div>


<?php

$mysqli = mysqli_connect('localhost', 'root', '', 'moneymanager');

$user_chaqirish = mysqli_query($mysqli, "SELECT * FROM users");

$user_array = mysqli_fetch_all($user_chaqirish, MYSQLI_ASSOC);

//echo '<pre>'; print_r($user_array); echo '</pre>';



if(isset($_POST['add_user'])){

$one_user = mysqli_query($mysqli, "INSERT INTO `users` ( `NAME`, `LOGIN`, `PASSWORD`,  `BALANCE`, `STATUS`) VALUES( '$_POST[user_name]', '$_POST[user_login]', '$_POST[user_password]', '$_POST[user_balance]', '1')"  );

header('Location: admin.php');
}
?>
<br>

<div class="row">
    <div class="col-1">

    </div>

    <div class="col-3">
        <h2>Registratsiya:</h2>
    </div>

    <div class="col-4">

    </div>

    <div class="col-1">

    </div>

<div class="col">
          <a href=" login.php"> <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg></a>  
        </div>

</div>

<form method="POST" class="mt-5 form-control">
    <label>Name:</label>
    <input class="form-control" type="text" name="name" required>

    <label>Login:</label>
    <input  class="form-control" type="text" name="login" required>

    <label>Password:</label>
    <input class="form-control" type="text" name="password" required>

    <label>Hisobingizda qancha mablag' bor</label>
    <input class="form-control" type="text" name="balance" required>

    <button class="btn btn-primary mt-3" type="submit" name="register_button">Qo'shish</button>

</form>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>


</html>







