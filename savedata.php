<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


function sendMail($email,$v_code)
{
    // $to = $email;
    // $subject =  'Email verifaction form niranjan web dev';
    
    // $message = "<b>This is HTML message.</b>";
    // $message .= "<h1>This is headline.</h1>";
    
    // $header = "From:niranjank.ug19.ph@nitp.ac.in \r\n";
   
    // $retval = mail($to,$subject,$message,$header);
    
    // if( $retval == true ) {
    //     return true;
    // }else {
    //     return false;
    // }


    require ('PHPMailer/Exception.php');
    require ('PHPMailer/PHPMailer.php');
    require ('PHPMailer/SMTP.php');
    $mail = new PHPMailer(true);

    try {

        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   =  true;                                   //Enable SMTP authentication
        $mail->Username   = 'niranjank.ug19.ph@nitp.ac.in';                     //SMTP username
        $mail->Password   = 'Interval@#12345';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('niranjank.ug19.ph@nitp.ac.in', 'Niranjan web dev');
        $mail->addAddress($email);     //Add a recipient
       
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject =  'Email verifaction form niranjan web dev';
        $mail->Body    =  "Thanks for register!
                           click the link to verify the email address
                           <a href='http://localhost/comics/verify.php?email=$email&v_code=$v_code'>Verify</a>";
      
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$email = $_POST['email'];
$verificationCode = bin2hex(random_bytes(16));
$conn = mysqli_connect("localhost","root","","email") or die("connection failed");
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