<?php 
 include 'header.php'
 //COMICSroot@12345
?>
 <div class="container">
 <h4>this is a basic comics sender application </h4>
<div class="email-container">
    <form class="from-input" action="savedata.php" method="post">
        <h1>Email</h1>
        <div class="from-group">
            <input type="text" placeholder="enter your email" name="email">
        </div>
        <div class="from-group">    
            <input id="btn" type="submit" value="submit">
        </div>
    </form>
</div>
</div>  

 <script src="js\script.js"></script>
 <?php 
 include 'footer.php'
?>