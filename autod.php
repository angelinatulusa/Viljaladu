<?php
require_once("konf.php");
global $yhendus;
if(!empty($_REQUEST["vormistamine_id"])){
    $kask=$yhendus->prepare(
        "UPDATE viljaladu SET luba=1 WHERE id=?");
    $kask->bind_param("i", $_REQUEST["vormistamine_id"]);
    $kask->execute();
}
//andmete lisaminetabelisse
if(isset($_REQUEST['lisamisvorm']) &&!empty($_REQUEST["autonr"]) &&!empty($_REQUEST["sisenemismassi"])){
    $paring=$yhendus->prepare(
        "INSERT INTO viljaladu(autonr,sisenemismassi) Values (?,?,?)"
    );
    $paring->bind_param("ii",$_REQUEST["autonr"],$_REQUEST["sisenemismassi"]);
    //"s" - string, $_REQUEST - tekstikasti nimega nimi
    //sdi, s - string d - double, i - inger
    $paring->execute();
}
if(isset($_REQUEST['kustuta'])){
    $paring=$yhendus->prepare("DELETE FROM viljaladu WHERE id=?");
    $paring->bind_param('i',$_REQUEST['kustuta']);
    $paring->execute();
}
$kask=$yhendus->prepare(
    "SELECT id, autonr, sisenemismassi, lahkumismass FROM viljaladu;");
$kask->bind_result($id, $autonr, $sisenemismassi, $lahkumismass);
$kask->execute();
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>TARpv21 autod</title>
</head>
<body>
<header><h1>Vaata kõiki autod</h1></header>
<link rel="stylesheet" type="text/css" href="style.css">
    <nav class="navMenu">
    <?php
    echo "<a class='nav-link' href='lisaAuto.php'>Lisa auto</a>";
    echo "<a class='nav-link' href='lahkumismass.php'>Lisa lahkumis mass</a>";
    echo "<a class='nav-link' href='autod.php'>Vaata kõiki autod laos</a>";
    ?>
    </nav>
    <h2>Autod</h2>
    <table>
        <tr>
            <th>Autonr</th>
            <th>Sisenemis mass</th>
            <th>Lahkumis mass</th>
        </tr>
        <?php
        while($kask->fetch()){
            echo "
                 <tr>
                   <td>$autonr</td>
                   <td>$sisenemismassi</td>
                   <td>$lahkumismass</td>
                   <td><a href='?kustuta=$id'>Kustuta</a></td>
                 </tr>
               ";
        }
        ?>
    </table>
<footer>
    <img src="logo.png" alt="logo" width="80" height="80">
</footer>
</body>
</html>