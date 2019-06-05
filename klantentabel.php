<?php
        session_start();
    require 'dbconfig.php';
?>
<?php 
if(isset($_POST['wijzig'])) {
    $voornaam = $_POST['voornaam'];
    $email =  $_POST['email'];
    $Beheerder = $_POST['Beheerder'];
    $tussenvoegsel = $_POST['tussenvoegsel'];
    $achternaam =  $_POST['achternaam'];
    $squery = "UPDATE klant SET Beheerder = :Beheerder, voornaam = :voornaam, tussenvoegsel = :tussenvoegsel ,achternaam = :achternaam WHERE email = :email";
    $ostmt = $db->prepare($squery);
    $ostmt->bindValue(':email', $email);
    $ostmt->bindValue(':Beheerder', $Beheerder);
    $ostmt->bindValue(':voornaam', $voornaam);
    $ostmt->bindValue(':tussenvoegsel', $tussenvoegsel);
    $ostmt->bindValue(':achternaam', $achternaam);
    $ostmt->execute();


  }

  if(isset($_POST['wis'])){
    $email = $_POST['email'];
    $squery = "DELETE FROM klant WHERE email = :email";
    $ostmt = $db->prepare($squery);
    $ostmt->BindValue(':email', $email );
    $ostmt->execute();



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
    include'beheerdernav.php';

?>
<?php
        $squery = "SELECT * FROM klant";
        $ostmt = $db->prepare($squery);
        $ostmt->execute();
        
        echo"<div class='container'>";
        echo"<table class='table' border='1'";
        echo"<thead>
        <td>Beheerder</td>
        <td>Voornaam</td>
        <td>Tussenvoegsel</td>
        <td>Achternaam</td>
        <td>Email</td>
        <td colspan='2'>Actie</td>
        </thead>";
        while($data = $ostmt->fetch(PDO::FETCH_ASSOC)) {
            ?>
        
        <form action="klantentabel.php" method="post">
        <tr>
          <td><input type="text" name="Beheerder" value="<?php echo ($data['Beheerder']); ?>" ></td>
          <td><input type="text" name="voornaam" value="<?php echo ($data['voornaam']); ?>"></td>
          <td><input type="text" name="tussenvoegsel" value="<?php echo ($data['tussenvoegsel']); ?>"></td>
          <td><input type="text" name="achternaam" value="<?php echo ($data['achternaam']); ?>"></td>
          <td><input type="text" name="email" value="<?php echo ($data['email']); ?>"></td>

      <?php
        if ($data['email'] != $_SESSION['email']) {
            ?>
          <td><input type="submit" name="wijzig" value="Wijzig" class="btn my-2 mr-sm-2 btn-outline-primary"></td>
          <td><input type="submit" name="wis" value="Wis" onclick="return confirm('<?php echo($data['voornaam']); ?> wordt verwijderd, weet u het zeker?')" class="btn my-2 mr-sm-2 btn-outline-primary"></td>
      <?php
        }
      ?>
        </tr>
      </form>
    <?php
      }
    ?>
</body>
</html>