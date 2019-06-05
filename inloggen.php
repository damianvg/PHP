<!DOCTYPE html>
<html lang="nl">
<head>
    <link rel="stylesheet" href="CSS/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Adidas</title>
</head>
<body>
<?php
    include'nav.html';
    include'dbconfig.php';
?>
<?php
    session_start();
    $melding = "";
    
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $wachtwoord = $_POST['wachtwoord'];
    if(empty($email) || empty($wachtwoord)){
        $melding = "Vul beide velden in";
    }elseif($melding == ""){
        $squery = "SELECT Beheerder, email, wachtwoord FROM klant WHERE email =:email";
        $ostmt = $db->prepare($squery);
        $ostmt ->bindvalue(':email', $email);
        $ostmt ->execute();
        $resultaat = $ostmt->fetch();
    if($ostmt -> rowcount()== 1){
    if(password_verify($wachtwoord,$resultaat['wachtwoord'])){
        $_SESSION['Beheerder'] = $resultaat['Beheerder'];
        $_SESSION['email'] = $resultaat['email'];
        $_SESSION['wachtwoord'] = $resultaat['wachtwoord'];
    if($resultaat['Beheerder'] == 'ja'){
        $_SESSION['blogin'] = true;
        header('Refresh: 3; url=beheerder.php');
        $melding = "uw bent ingelogd als beheerder";
    
    }else{
        $_SESSION['klogin'] = true;
        header('Refresh: 3; url=klant.php');
        $melding = "uw bent ingelogd als klant";
        
    }
    }else{
        $melding = "uw wachtwoord is niet correct";
    }
    }else{
        $melding = "uw staat niet geregistreerd";
    }
    } 
    }
    if ($melding != "") {
        echo '<div class="bg-dark text-primary container" id="errormes">';
        echo $melding. "<br><br>";
        echo '</div>';
      }



    ?>
    

<div class="container">
<h1>Inloggen</h1>
<p>Vul dit in om in te loggen</p>
<br>
<form action="inloggen.php" method="post">
    <input type="text" name="email" placeholder="vul hier u email in" required>
    <input type="password" name="wachtwoord" placeholder="vul hier je wachtwoord in" required>
    <button type="submit" name="login" class="loginbutton">Login</button>
</form>
</div>
</body>
</html>