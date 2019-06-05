<!DOCTYPE html>
<html lang="nl">
<head>
<title>Adidas</title>
<meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/registratie.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
    <body>
<?php
        session_start();
    include'beheerdernav.php';
    require 'dbconfig.php';
?>
<?php
        
        $melding = "";
        
        if(isset($_POST['submit'])){
            $oudwachtwoord = $_POST['oudwachtwoord'];
            $nieuwwachtwoord = $_POST['nieuwwachtwoord'];
            $nieuwwachtwoord2 = $_POST['nieuwwachtwoord2'];
        if($nieuwwachtwoord == $nieuwwachtwoord2){
        $email = $_SESSION['email'];
      $squery = "SELECT wachtwoord FROM klant WHERE email = :email";
      $ostmt = $db->prepare($squery);
      $ostmt->BindValue(':email', $email);
      $ostmt->execute();
      $data = $ostmt->fetch();
    if (password_verify($oudwachtwoord,$data['wachtwoord'])) {
      $ww=password_hash($nieuwwachtwoord, PASSWORD_DEFAULT);
      $squery = "UPDATE klant SET wachtwoord = :wachtwoord WHERE email = :email";
      $ostmt = $db->prepare($squery);
      $ostmt->BindValue(':email', $_SESSION['email']);
      $ostmt->BindValue(':wachtwoord', $ww);
      $ostmt->execute();
      $melding = "uw wachtwoord is gewijzigd.";
    }else {
        $melding = "Uw wachtwoord klopt niet";
    }
        }else {
            $melding = "uw wachtwoorden zijn niet gelijk";
    }
        
                 if ($melding !=  "") {
              echo '<div class="bg-primary container text-dark">';
              echo $melding. "<br>";
              echo '</div>';
            }
        }
?>
<form action="wachtwoordwijzigen.php" method="post">
<input type="password" name="oudwachtwoord" placeholder="Vul hier u huidige wachtwoord in">         
<input type="password" name="nieuwwachtwoord" placeholder="Vul hier u nieuwe wachtwoord in">
<input type="password" name="nieuwwachtwoord2" placeholder="Vul herhaal hier u nieuwe wachtwoord">
<button type="submit" name="submit" class="registerbutton">Wijzigen</button>
</form>
        
      
</body>
</html>