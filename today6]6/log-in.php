
<?php
session_start();

if($_SERVER['REQUEST_METHOD']=="POST"){
    include "all.php";
     if(!empty($_POST['email']) ){
        // filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)&& 
    if(strlen($_POST['email']) >= 2){
        $email= filter($_POST['email']);
        $phone= $_POST['email'];
        if(!empty($_POST['password'])){
            $password=filter($_POST['password']);
              
            try{
                $con=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                 $select1 = $con->prepare("SELECT client_email FROM $tbname WHERE client_email = $email");
                 $select1->execute();
                 

            }catch(PDOException $e){
                echo "notverified". $e->getMessage();
            }


        }else{
            echo "passwordempty";
        }

    }else{
        echo "emailbad";
    }
}else{
    echo "emaliempty";
}
}



/* 
     $con=new PDO("mysql:host=$host;dbname=$dbname",$user,$pass);
                $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 
                $select = $con->prepare("SELECT client_fullname, client_email, client_phone, client_password FROM $tbname WHERE client_email = :email OR client_phone = :phone");
$select->bindParam(':email', $email);
$select->bindParam(':phone', $phone);
$select->execute();
$slt = $select->fetch();


  $selectlogindb = $con->prepare("SELECT  client_phone FROM $tbname WHERE  client_phone = $phone");
$selectlogindb->execute();
$slt2 = $selectlogindb->fetch();

                if($slt && $slt["client_email"]==$email || $slt2 && $slt2['client_phone']==$phone){
                 

                    // "connect email";
                   //culomn in database 
                    // Full texts
                    // client_id	
                    // client_fullname	
                    // client_email	
                    // client_phone	
                    // client_password	
                    // client_age
                    
              
                    if($slt && $slt["client_password"]==$password && strlen($password) >= 5){
                            
                            $_SESSION["username"]=$slt["client_fullname"];
                            $_SESSION["useremail"]=$slt["client_email"]; 
                            
                            
                             //dashbord
                             $verified = "verified";
                             echo $verified ;
                                             //select

                                             
                                             $selectlogindb =  $con->query("SELECT singIn FROM $tbnamedashbord");
                                             $loginnumber = $selectlogindb->fetch();
                                             $number= $loginnumber['singIn'];
                                             
                                             if($verified == "verified"){
                                                $number++;
                                                $update ="UPDATE $tbnamedashbord SET singIn='$number' ";
                                                $updatelogin = $con->prepare($update);
                                                $updatelogin->execute();}
         
                                             //dashbord
                                              
                    }else{
                        echo "pasworddb";
                       
                    }
                    
                }else{
                    echo "emaildb";
                }

*/
?>
