<?php $date = date('Y-m-d'); ?>
<?php
session_start();
include "klantnav.php";
include "dbconfig.php";
$melding = "";

$squery = "SELECT * FROM klant WHERE email = :email";
    $ostmt = $db->prepare($squery);
    $ostmt->bindValue(':email', $_SESSION['email']);
    $ostmt->execute();
    $resultaat = $ostmt->fetch();
    $_SESSION['klantid'] = $resultaat['klantid'];


if(isset($_POST['bestel'])) {
$productid = $_POST['productid'];
$datum = $_POST['datum'];

$sql = $db->prepare("SELECT * FROM verkoop WHERE productid = :productid");
$sql->bindValue(':productid', $productid);
$sql->execute();
if($sql->rowCount() == 0){
  $melding = "Geen geldig producten id";
}
$squery2 = "SELECT prijs FROM product WHERE productid = '$productid'";
$ostmt2 = $db->prepare($squery2);
$ostmt2->execute();
$data = $ostmt2->fetch();
$prijs = $data['prijs'];

if($melding == ""){
$squery = "INSERT INTO verkoop (datum, productid, klantid) VALUES (:datum, :productid, :klantid)";
$ostmt = $db->prepare($squery);
$ostmt->bindValue(':datum', $datum);
$ostmt->bindValue(':productid', $productid);
$ostmt->bindValue(':klantid', $_SESSION['klantid']);
$ostmt->execute();
$melding = "uw bestelling is geplaatst<br> De prijs is " . $prijs . "euro";
header('Refresh: 3; url=mijnbestellingen.php');


}
}


if ($melding != "") {
  echo '<div class="bg-primary text-dark container" id="errormes">';
  echo $melding . "<br><br>";
  echo '</div>';
}
 ?>


<!DOCTYPE html>
<html lang="nl" dir="ltr">
  <head>
    <link rel="stylesheet" href="CSS/website.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <title>Adidas</title>
  </head>
  <body class="bg-dark text-primary">
    <main class="container">
      <aside>
        <h1>Bestellen!!!</h1>
        <p>Bij informatie vragen boven in de navigatiebalk kunt uw producten uitzoeken <br> ook ziet u een producten id, deze kunt u invullen in het invulveld als u iets wilt bestellen.</p>
      </aside>
        <form action="productenbestellen.php" method="post">
          <label>Productenid</label>
          <input class="form-control" type="number" name="productid"><br>
          <label>Datum</label>
          <input class="form-control" type="date" value="<?php echo $date; ?>" name="datum" readonly><br>

          <button class="btn btn-block btn-primary" type="submit" name="bestel">Bestelling plaatsen</button><br>
        </form>

        <aside
  </body>
</html>