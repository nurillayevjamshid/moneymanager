<!DOCTYPE html >
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=divice-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">

   </head>
   <body>
      <?php
         // session_start();
         error_reporting(1);

         $user_array = db::array_single("SELECT * FROM users WHERE ID='$_SESSION[user_id]'");
        //$sql= "SELECT * FROM users WHERE ID='$_SESSION[user_id]'";
        //echo $sql;

         if(isset($_GET['filter'])){
         
         if($_GET['type']=='Kirim'){
             $type= "AND TYPE='Kirim'";
         }
         
         if($_GET['type']=='Chiqim'){
             $type= "AND TYPE='Chiqim'";
         }
         
         
         if($_GET['date_to']!='' AND $_GET['date_from']!= ''){
             $date= "AND DATE BETWEEN '$_GET[date_from]' AND '$_GET[date_to]'";
         }
         
         
         if($_GET['date_to']!= '' AND $_GET['date_from']==''){
             $date= "AND DATE <= '$_GET[date_to]'";
         }
         
         if($_GET['date_to']== '' AND $_GET['date_from']!= ''){
             $date= "AND DATE >='$_GET[date_from]'";
         }
         
         }
             
      
         if(isset($_POST['edit_user'])){
         
         $update = db::query("UPDATE `users` SET `NAME` = '$_POST[user_name]', `LOGIN` = '$_POST[user_login]', `PASSWORD` = '$_POST[user_password]' WHERE `ID` = '$_SESSION[user_id]'");
         
         header('Location: index.php');
         }
         
         
         
         if(isset($_POST['add_transaction'])){
         
         
         $add_transaction = db::query("INSERT INTO `transaction` (`USER_ID`, `TYPE`, `SUMMA`, `DATE`, `COMMENT`) VALUES ('$_SESSION[user_id]', '$_POST[transaction_type]', '$_POST[transaction_sum]', '$_POST[transaction_date]', '$_POST[transaction_comment]')");
         
         if ($_POST['transaction_type']=='Chiqim') {
            $balance = $user_array['BALANCE'] - $_POST['transaction_sum'];
         }
         
         if ($_POST['transaction_type']=='Kirim') {
            $balance = $user_array['BALANCE'] + $_POST['transaction_sum'];
         }
         
         $update_balance = db::query( "UPDATE `users` SET `BALANCE` = '$balance' WHERE `users`.`ID` = '$_SESSION[user_id]'");
         
          header('Location: index.php');
         
         }
         if(isset($_GET['logout'])){
             session_destroy();
             header('Location: index.php');
         }
         ?>
      <br>
      <div class="container">
         <div class="row">
            <div class="col-12" style="text-align: right;">
               <a href="?logout" class="btn btn-danger">Chiqish:</a>  
            </div>
         </div>
         <div class="row mt-5">
            <div class="col-12 col-md-6 col-lg-6">
               <form method="POST">
                  <table class="table table-bordered">
                     <thead>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Shaxsiy ma'lumotlaringiz:
                               
                           </td>
                           <td><button type="submit" name="edit_user">Tahrirlash:</button></td>
                        </tr>
                        <tr>
                           <td>Ism:</td>
                           <td><input type="text" name="user_name" value="<?php echo $user_array['NAME'];?>" required></td>
                        </tr>
                        <tr>
                           <td>Login:</td>
                           <td><input type="text" name="user_login" value="<?php echo $user_array['LOGIN'];?>" required></td>
                        </tr>
                        <tr>
                           <td>Parol:</td>
                           <td><input type="text" name="user_password" value="<?php echo $user_array['PASSWORD'];?>" required></td>
                        </tr>
                        <tr>
                           <td>Summa:</td>
                           <td><input type="text" name="user_balance" readonly value="<?php echo $user_array['BALANCE'];?>" required></td>
                        </tr>
                     </tbody>
                  </table>
               </form>
            </div>
         
            <div class="col-12 col-md-6 col-lg-6">
               <table class="table table-bordered">
                  <thead>
                     <form method="POST">
                  </thead>
                  <tbody>

                  <tr>
                  <td>Kirim va Chiqim qo'shish:</td>
                  <td><button type="submit" name="add_transaction">Qo'shish</button></td>
                  </tr>

                  <tr>
                  <td>Turi:</td>
                  <td>
                  <label></label>
                  <select name="transaction_type" required>
                  <option>Kirim</option>
                  <option>Chiqim</option>
                  </select></td>
                  </tr>

                  <tr>
                  <td>Sana:</td>
                  <td>  
                  <label></label>
                  <input type="date" name="transaction_date" required></td>
                  </tr>

                  <tr>
                  <td>Summa:</td>
                  <td>
                  <label></label>
                  <input type="text" name="transaction_sum" required></td>
                  </tr>

                  <tr>
                  <td>Sharh:</td>
                  <td>
                  <label></label>
                  <input type="text" name="transaction_comment" required></td>
                  </form>
                  </tr>

                  </tbody>
               </table>
            </div>
            <br>
            <br>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-12  col-md-6 col-lg-4" >
                  <h4> PUL O'TQAZMALARI </h4>
               </div>
               <div class="col-12  col-md-6 col-lg-3" >
                  <form>

               <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Filter turi</span>     
<select class="form-select" name="type" aria-label="Default select example">>     
  <option <?php if ($_GET['type']=='Hammasi'){echo 'selected';}?>>Hammasini</option>
  <option <?php if ($_GET['type']=='Kirim'){echo 'selected';}?>>Kirim</option>
  <option <?php if ($_GET['type']=='Chiqim'){echo 'selected';}?>>Chiqim</option>
</select>
</div>
</div>

               <div class="col-12  col-md-12 col-lg-2">
               <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Dan</span>
                  <input type="date" class="form-control" name="date_from" value="<?php echo $_GET['date_from'];?>">
               </div>
            </div>
               
                <div class="col-12  col-md-12 col-lg-2">
                  <div class="input-group mb-3">
                  <span class="input-group-text" id="basic-addon1">Gacha</span>
                  <input type="date" class="form-control" name="date_to" value="<?php echo $_GET['date_to'];?>">
               </div>
                  </div>
               <div class="col-12  col-md-12 col-lg-1">
               <button class="btn btn-primary" type="submit" name="filter">Qo'llash</button>
            </div>
               </form>
               </div> 
            </div>
         </div>
         <br>
         <br>
         <br>
         <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
               <table class="table table-bordered">
                  <thead>
                     <tr>
                        <th scope="col"> Id </th>
                        <th scope="col"> Turi </th>
                        <th scope="col"> Summa </th>
                        <th scope="col"> Sana </th>
                        <th scope="col"> Sharh </th>
                     </tr>
                  </thead>
                  <tbody>


                     <?php  $transactions = db::array_all("SELECT * FROM transaction WHERE USER_ID='$_SESSION[user_id]' $type $date");

                     foreach ($transactions as $item): ?>
                     <tr>
                        <td><?php echo $item['ID'];?></td>
                        <td><?php echo $item['TYPE'];?></td>
                        <td><?php echo $item['SUMMA'];?></td>
                        <td><?php echo $item['DATE'];?></td>
                        <td><?php echo $item['COMMENT'];?></td>
                     </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
   </body>
   <script const togglemodal = () => 
   document.body.classList.toggle("open");</script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</html>