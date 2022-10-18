<?php

$email = $_GET['email'];
$conn = mysqli_connect("localhost","root","password","database_name") or die("connection failed");

if (isset($_GET['email'])) {
    {
        $sql = "SELECT * FROM users WHERE email='{$_GET['email']}'";
        $result = mysqli_query($conn,$sql) or die("query unsuccessfull");
        if ($result) {
            if (mysqli_num_rows($result)==1) {
                 $result_fetch = mysqli_fetch_assoc($result);
                 if ($result_fetch['is_verified']==1) {
                    $del = "DELETE FROM users WHERE email='{$email}'";
                    if (mysqli_query($conn,$del)) {
                           
                        echo"
                        <script>
                        alert('unsubscribed sucessfully');
                        window.location.href='index.php';
                        </script>
                    ";
                    }
                 }
                 else{
                    echo"
                        <script>
                        alert('user unsubscribed already');
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