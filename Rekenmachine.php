<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Rekenmachine</title>
    <link rel="stylesheet" type="text/css" href="Rekenmachine.css">
</head>

<body>
<?php
include'Rekenennav.html';
?>
<?php
if(isset($_POST['plus'])) {
   if (is_numeric($_POST['x']) &&  is_numeric($_POST['y'])) {

       $x = $_POST['x'];
        $y = $_POST['y'];

        $antwoord = $x + $y;

    echo "het antwoord is $antwoord";
    }
    else {
        echo"vul beide in";
    }
}


if(isset($_POST['min'])) {
   if (is_numeric($_POST['x']) &&  is_numeric($_POST['y'])) {

        $x = $_POST['x'];
        $y = $_POST['y'];

        $antwoord = $x - $y;

    echo "het antwoord is $antwoord";
    }
    else {
        echo"vul beide in";
    }
}


if(isset($_POST['keer'])) {
   if (is_numeric($_POST['x']) &&  is_numeric($_POST['y'])) {
        $x = $_POST['x'];
        $y = $_POST['y'];
        $antwoord = $x * $y;

    echo "het antwoord is $antwoord";
    }
    else {
        echo "vul beide in";
    }
}

if(isset($_POST['delen'])) {
   if (is_numeric($_POST['x']) &&  is_numeric($_POST['y'])) {
       if ($_POST['y']==0) {
           echo "delen door nul is niet toegestaan";
       } else {
        $x = $_POST['x'];
        $y = $_POST['y'];
        $antwoord = $x / $y;

    echo "het antwoord is $antwoord";
       }
    }
    else {
        echo"vul beide in";
    }
}

if(isset($_POST['kwadraat'])) {
   if (is_numeric($_POST['x']) &&  empty($_POST['y'])) {
       $x = $_POST['x'];
       $antwoord = pow($x,2);

    echo "het antwoord is $antwoord";
   }
    else {
        echo"vul alleen het bovenste in";
    }
}

if(isset($_POST['wortel'])) {
   if (is_numeric($_POST['x']) &&  empty($_POST['y'])) {
       $x = $_POST['x'];
       $antwoord = pow($x, 1/2);

    echo "het antwoord is $antwoord";
   }
    else {
        echo"vul alleen het bovenste in";
    }
}

if(isset($_POST['macht'])) {
   if (is_numeric($_POST['x']) &&  is_numeric($_POST['y'])) {
       $x = $_POST['x'];
       $y = $_POST['y'];
       $antwoord = pow($x,$y);

    echo "het antwoord is $antwoord";
   }
    else {
        echo"vul beide in";
    }
}

    if(isset($_POST['tafel'])) {
   if (is_numeric($_POST['x']) &&  empty($_POST['y'])) {
       $x = $_POST['nummerx'];
    echo "de tafel van: $x <br>";
    for($i=1;$i<=10;$i++){

        $antwoord = $x * $i;

    echo "$x x $i = het antwoord is $antwoord <br>";
    }
   }
    else {
        echo"vul aleen het bovenste in";
    }
}



?>
<form action="Rekenmachine.php" method="post">
<input type="number" name="x" step="any">
<br><br>
<input type="number" name="y" step="any">
<br><br><br><br>
<button type="submit" name="plus">plus</button>
<button type="submit" name="min">min</button>
<button type="submit" name="keer">keer</button>
<br><br>
<button type="submit" name="delen">delen</button>
<button type="submit" name="kwadraat">kwadraat</button>
<button type="submit" name="wortel">wortel</button>
<br><br>
<button type="submit" name="totdemacht">macht</button>
<button type="submit" name="tafel">tafel</button>
<button type="submit" name="reset">reset</button>
</form>
</body>
</html>
