<?php



function sendMail($email,$v_code)
{

   try{
        $to = $email;
       $subject =  'Email verifaction form niranjan web dev';
    
      $message = "
               Thanks for register!
               click the link to verify the email address
               https://comics-sender.000webhostapp.com/verify.php?email=$email&v_code=$v_code
               ";
    
  
        $header = "From:niranjank.ug19.ph@nitp.ac.in \r\n";
       // $header .= "MIME-Version: 1.0\r\n";
        //$header .= "Content-Type: text/html; charset=UTF-8\r\n";

   
    $retval = mail($to,$subject,$message,$header);
      return true;
   }catch(Exception $e){
         return false;
   }
    
}

$email = $_POST['email'];
$verificationCode = bin2hex(random_bytes(16));
$conn = mysqli_connect("localhost","id19720410_root","COMICSroot@12345","id19720410_comics") or die("connection failed");
$sql = "SELECT * FROM users WHERE email='{$email}'";
$result = mysqli_query($conn,$sql) or die("query unsuccessfull");

    if (mysqli_num_rows($result)>0){
        echo"
         <script>
            alert('email is already taken');
            window.location.href='index.php';
         </script>
        ";
    }else{
       $sql1 = "INSERT INTO users(email,verification_code,is_verified) VALUES ('{$email}','{$verificationCode}','0') ";
       $result1 = mysqli_query($conn,$sql1) or die("query unsuccessfull");
        if ($result && sendMail($email,$verificationCode)) {

            echo"
            <script>
               alert('sucessfull email register....we have send a verification link please verify the email');
               window.location.href='index.php';
            </script>
           ";
        }else{
            echo"
            <script>
               alert('Internal Server Error');
               window.location.href='index.php';
            </script>
           ";
        }
    }
   
mysqli_close($conn);
?>