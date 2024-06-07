
<?php
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){
    include "all2.php";
   if(!empty($_POST["email"]) || !empty($_POST["phone"]) ){
    
    if(!empty($_POST["password"])){
      // 
 $email = filter($_POST["email"]);
 $phone = $_POST["phone"];
 $password = filter($_POST["password"]);

 try {
  $con = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $select = $con->prepare("SELECT client_email,client_phone,client_password FROM $tbname WHERE client_email = :email OR client_phone = :phone OR client_password = :password");
  $select->bindParam(":email", $email);
  $select->bindParam(":phone", $phone);
  $select->bindParam(":password", $password);
  $select->execute();
  $fetch = $select->fetch(PDO::FETCH_ASSOC);
  $phonefilter = "+".$fetch["client_phone"];

  if ($fetch && $fetch["client_email"] == $email || $fetch["client_phone"] == $phone) {
    
      if ($fetch &&  $fetch["client_password"] == $password ) {
    
        echo "verified";
        
      }else{echo "pasworddb"; }
   }else{echo "emaildb"; }
                  

} catch (PDOException $e) {
  echo "notverified" . $e->getMessage();
}
//  
     }else{
      echo "passwordempty";
     }
    
   }else{
    echo "emaliempty";
   }
}

