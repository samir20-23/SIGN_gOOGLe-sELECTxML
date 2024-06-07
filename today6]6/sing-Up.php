<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "all2.php";
    if (!empty($_POST['username'])) {
        $username = filter($_POST['username']);
        
        if (!empty($_POST["email"])) {
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && strlen($_POST["email"]) <= 50) {

                $email = filter($_POST['email']);
                // countryCode
                if (!empty($_POST["countryCode"])) {
                    $typeNumber = $_POST["countryCode"];

                if (!empty($_POST["phone"])) {
                     $phone = filter($_POST["phone"]);
                     $lengthphone ="";
                     $valuesphone ="";
                for($i=0;$i<strlen( $phone) ;$i++){
                    $lengthphone =$i;
                    $valuesphone = $phone[$i] ; 

                }
                     if (filter_var($valuesphone, FILTER_VALIDATE_INT) && $lengthphone >= 9 ) {
                       
                        $age='';
                if (!empty($_POST['password'])) {
  
                    if (strlen($_POST['password']) >= 5) {
                        $password = filter($_POST['password']);

                        if ($_POST['password'] === $_POST['cpassword']) {

                            try {
                                $connect = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);

                                $selectphone = $connect->query("SELECT client_phone FROM $tbname WHERE client_phone='$phone'");
                                $sltphone = $selectphone->fetch();
    
                                $select = $connect->query("SELECT client_email FROM $tbname WHERE client_email='$email'");
                                $slt = $select->fetch();
                                if ($slt && $email === $slt['client_email'] || $sltphone && $phone === $sltphone['client_phone']) {

                                    echo "aready";

                                    // echo "emailaready";
                                } else {

                                    // Full texts
                                    // client_id	
                                    // client_fullname	
                                    // client_email	
                                    // client_ty
                                                                                                
                                    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                                    $insert = $connect->prepare("INSERT INTO $tbname(client_fullname,client_email,client_ty,client_phone,client_age,client_password) VALUE(:username, :email,:typeNumber ,:phone, :age,:password)");

                                    $insert->bindParam(":username", $username);
                                    $insert->bindParam(":email", $email);
                                    $insert->bindParam(":password", $password);
                                    $insert->bindParam(":phone", $phone);
                                    $insert->bindParam(":typeNumber", $typeNumber);
                                    $insert->bindParam(":age",$age);

                                    $insert->execute();

                                    $verified = "verified";
                                    echo $verified;
                              
                           
                                }
                            } catch (PDOException $e) {
                                echo "notverified" . $e->getMessage();
                            }
                        } else {
                            echo "notmatch";
                        }
                    }
                     else {
                        echo "paasswordlenght";
                    }
                } else {
                    echo "passwordempty";
                }
                // 
            } else {
                echo "phonebad";
            }
        } else {
            echo "phoneempty";
        }
        // 
    } else {
        echo "countryCodeempty";
    }
            } else {
                echo "emailbad";
            }
        } else {
            echo "emailempty";
        }
    } else {
        echo "userempty";
    }
}?>
 

<?php
// if(isset($_POST["googleSign"])){
// require_once 'vendor/autoload.php';

// $clientID = '27634668984-5ooshfi469quhah2nmbaj6jpcdot12hd.apps.googleusercontent.com';
// $clientSecret = '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';
// $redirectUri = 'http://localhost/SAMIR/BOKINGG/BOKINGG8/google/SOSIAL.LOGIN.html';

// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setClientSecret($clientSecret);
// $client->setRedirectUri($redirectUri);
// $client->addScope("email");
// $client->addScope("profile");

// if (isset($_GET['code'])) {
//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//     $client->setAccessToken($token['access_token']);

//     $google_oauth = new Google_Service_Oauth2($client);
//     $google_account_info = $google_oauth->userinfo->get();
//     $email = $google_account_info->email;
//     $name = $google_account_info->name;

//     // Use the obtained user info here

// } else {
//     $authUrl = $client->createAuthUrl();
//     echo json_encode(['link' => $authUrl]);
//     echo $authUrl;
// }
// }
?>
