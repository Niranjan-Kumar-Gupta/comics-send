<?php


function sendMail($email,$comic)
{
   
    try {
        $to = $email;
        $subject =  'comics';
        
        $message = "<b>Here is comic story for you</b>";
        $message .= "<h1>".$comic['title']."</h1>";
        $message .= '<img src="'.$comic['img'].'"/>';
        $message .= "<br><h1>if you want to unsubscribe then click the link ";
        $message .= "<a href='http://13.114.23.149/unsubscribe.php?email=$email'>link</a></h1>";
       
         $header = "MIME-Version: 1.0\r\n";
         $header .= "Content-Type: text/html; charset=UTF-8\r\n";
         $header .= "From:poornima comics <niranjank.ug19.ph@nitp.ac.in> \r\n".
                   "Reply-To: .$to." . "\r\n" .
                   "X-Mailer: PHP/" . phpversion();
         $param     = '-f<niranjank.ug19.ph@nitp.ac.in>';
      
        $retval = mail($to,$subject,$message,$header,$param);
        return true;
    } catch (Throwable $th) {
        return false;
    }
}


$conn = mysqli_connect("localhost","root","password","database_name") or die("connection failed");
$sql = "SELECT * FROM users WHERE is_verified='1'";
$result = mysqli_query($conn,$sql) or die("query unsuccessfull");

if ($result) {
    if (mysqli_num_rows($result)>0) {
         $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
         if ($users) {
            foreach($users as $user){
                print_r($user['email']);
            }
          
                $random_num =  rand(1,1000);
                $url = 'https://xkcd.com/'.$random_num.'/info.0.json';
                $response = file_get_contents($url);
                $comics = json_decode($response,true);
                print_r($comics); 
                echo $random_num; 
                print_r($comics['transcript']); 
                $is_mail = sendMail($user['email'],$comics);
               
         }
         else{
            echo"
                <script>
                alert('user already verifeid');
                window.location.href='index.php';
                </script>
            ";
         }
    }
}else{
    echo"
    <script>
       alert('Internal Server Error');
       window.location.href='index.php';
    </script>
   ";
}

mysqli_close($conn);
?>
