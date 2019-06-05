<!DOCTYPE html>
<html lang="nl">
<head>
<title>Adidas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
</head>
    <body>
<?php
    session_start();
    include'klantnav.php';
    include 'dbconfig.php';
?>

        
<main class="container text-primary">
    <?php
    $squery = "SELECT * FROM klant WHERE email = :email";
    $ostmt = $db->prepare($squery);
    $ostmt->bindValue(':email', $_SESSION['email']);
    $ostmt->execute();
    $resultaat = $ostmt->fetch();
    $_SESSION['klantid'] = $resultaat['klantid'];


        try{
            include ('dbconfig.php');

            $query = $db->prepare("SELECT datum, verkoopid, verkoop.productid, artikel, prijs FROM verkoop INNER JOIN product ON verkoop.productid = product.productid WHERE klantid = :klantid" );
            $query->bindValue(':klantid', $_SESSION['klantid']);
            $query->execute();
            $result = $query->fetchALL(PDO::FETCH_ASSOC);
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Datum</th>";
            echo "<th>Verkoopid</th>";
            echo "<th>productid</th>";
            echo "<th>Artikel</th>";
            echo "<th>Prijs</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            foreach ($result as &$data){
                echo "<tr>";
                echo "<td>" . $data["datum"] . "</td>";
                echo "<td>" . $data["verkoopid"] . "</td>";
                echo "<td>" . $data["productid"] . "</td>";
                echo "<td>" . $data["artikel"] . "</td>";
                echo "<td>" . $data["prijs"] . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";

    }
        catch(PDOexeption $e) {
            die("Error!: " . $e->getMessage());
        }
    ?>
</main>
    </body>
</html>