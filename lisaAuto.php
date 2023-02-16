<!DOCTYPE html>
<html>
<body>
<head>
    <title>Lisa auto</title>
</head>
<header><h1>Lisamine</h1></header>
<link rel="stylesheet" type="text/css" href="style.css">
    <nav class="navMenu">
    <?php
    echo "<a class='nav-link' href='lisaAuto.php'>Lisa auto</a>";
    echo "<a class='nav-link' href='lahkumismass.php'>Lisa lahkumis mass</a>";
    echo "<a class='nav-link' href='autod.php'>Vaata kõiki autod laos</a>";
    ?>
    </nav>
    <h2>Lisa sabunud auto</h2>
<?php
require_once("konf.php");
global $yhendus;
if(isSet($_REQUEST["sisestusnupp"])){
    if (empty($_REQUEST['autonr']) && empty($_REQUEST['sisenemismassi'])){
        echo '<script>alert("Autode number/sisenemismassi ei tohi olla tühi!")</script>';
    }
    else{
        $kask=$yhendus->prepare("INSERT INTO viljaladu(autonr, sisenemismassi) VALUES (?, ?)");
        $kask->bind_param("si", $_REQUEST["autonr"], $_REQUEST["sisenemismassi"]);
        $kask->execute();
        echo "<meta http-equiv='refresh' content='0;url=lahkumismass.php'>";
        exit();
    }
}
?>
<form action="?">
    <dl>
        <dt>Autode number:</dt>
        <dd><input type="text" name="autonr"/></dd>

        <dt>Sisenemismass:</dt>
        <dd><input type="number" name="sisenemismassi"/></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta"/></dt>
    </dl>
</form>
<footer>
    <img src="logo.png" alt="logo" width="80" height="80">
</footer>
</body>
</html>