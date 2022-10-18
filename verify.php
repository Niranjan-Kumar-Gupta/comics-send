<?php

$email = $_GET['email'];
$conn = mysqli_connect("localhost","root","password","database_name") or die("connection failed");

if (isset($_GET['email']) && isset($_GET['v_code'])) {
    {
        $sql = "SELECT * FROM users WHERE email='{$_GET['email']}' AND verification_code='{$_GET['v_code']}'";
        $result = mysqli_query($conn,$sql) or die("query unsuccessfull");
        if ($result) {
            if (mysqli_num_rows($result)==1) {
                 $result_fetch = mysqli_fetch_assoc($result);
                 if ($result_fetch['is_verified']==0) {
                    $update = "UPDATE users SET `is_verified`='1' WHERE email='{$email}'";
                    if (mysqli_query($conn,$update)) {                          
                        echo"
                        <script>
                        alert('email verify sucessfull');
                        window.location.href='index.php';
                        </script>
                    ";
                    }
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
      
    }
}

mysqli_close($conn);
?>