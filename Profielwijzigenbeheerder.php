<?php
session_start();
require "dbconfig.php";
try {
  $ostmt = $db->prepare("SELECT * FROM klant WHERE email = :email");
  $ostmt->bindValue(':email', $_SESSION['email']);
  $ostmt->execute();
  $data = $ostmt->fetch(PDO::FETCH_ASSOC);
  $_SESSION['email']=$data['email'];
} catch (\Exception $e) {
  die("error!: " . $e->getMessage());
}

if(isset($_POST['update'])) {
$melding = "";

$voornaam = $_POST['voornaam'];
$tussenvoegsel = $_POST['tussenvoegsel'];
$achternaam = $_POST['achternaam'];
$geboortedatum = $_POST['geboortedatum'];
$email = $_POST['email'];
$postcode = $_POST['postcode'];
$plaats = $_POST['plaats'];

if(!empty($email)){
if ($_SESSION['email'] != $email) {
  $oldemail = $_SESSION['email'];
  $sql = $db->prepare("SELECT email FROM klant WHERE email = '$email'");
  $sql->execute();
  if($sql->rowCount() >= 1){
    if ($melding == "") {
      $melding = "het email adres is al in gebruik.";
    }else{
      $melding = $melding."<br>Het email adres is al in gebruik.<br>";
    }
  }
}
}
if ($melding == "") {
$query = "UPDATE klant SET voornaam = :voornaam, tussenvoegsel = :tussenvoegsel, achternaam = :achternaam, geboortedatum = :geboortedatum, email = :email, postcode = :postcode, plaats = :plaats WHERE email LIKE :email2";
$ostmt = $db->prepare($query);
$ostmt->bindValue(':email2', $_SESSION['email']);
$ostmt->bindValue(':email', $email);
$ostmt->bindValue(':voornaam', $voornaam);
$ostmt->bindValue('tussenvoegsel', $tussenvoegsel);
$ostmt->bindValue(':achternaam', $achternaam);
$ostmt->bindValue(':geboortedatum', $geboortedatum);
$ostmt->bindValue(':postcode', $postcode);
$ostmt->bindValue(':plaats', $plaats);
$ostmt->execute();
header('Refresh: 0; url=Profielwijzigenbeheerder.php');
$_SESSION['email'] = $email;
}

if ($melding != "") {
echo '<div class="bg-primary text-dark container" id="errormes">';
echo $melding . "<br><br>";
echo '</div>';
}
}


 ?>
<!DOCTYPE html>
<html lang="nl">
<head>
<title>Adidas</title>
<meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/website.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
</head>
    <body>
        <?php
        include "beheerdernav.php";
        ?>
        
    <main class="container">
        <form action="Profielwijzigenbeheerder.php" method="post">
          <label>Voornaam</label>
          <input class="form-control" type="text" value="<?php echo $data['voornaam']; ?>" name="voornaam"><br>
          <label>Tussenvoegsel</label>
          <input class="form-control" type="text" value="<?php echo $data['tussenvoegsel']; ?>" name="tussenvoegsel"><br>
          <label>Achternaam</label>
          <input class="form-control" type="text" value="<?php echo $data['achternaam']; ?>" name="achternaam"><br>
          <label>Geboortedatum</label>
          <input class="form-control" type="text" value="<?php echo $data['geboortedatum']; ?>" name="geboortedatum"><br>
          <label>E-mail</label>
          <input class="form-control" type="email" value="<?php echo $data['email']; ?>" name="email"><br>
          <label>Postcode</label>
          <input class="form-control" type="text" value="<?php echo $data['postcode']; ?>" name="postcode"><br>
          <label>Plaats</label>
          <input class="form-control" type="text" value="<?php echo $data['plaats']; ?>" name="plaats"><br>
          <label></label>

          <button class="btn btn-block btn-primary" type="submit" name="update">Verander</button><br>
        </form>
        </main>
 </body>
</html>