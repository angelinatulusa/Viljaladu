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
$paring=$yhendus->prepare("SELECT lahkumismass-sisenemismassi FROM viljaladu WHERE autonr='dsa'");
$paring->bind_param( $sisenemismassi, $lahkumismass);
$paring->execute();
?>
<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>TARpv21 autod</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<header>
    <h1>Autod</h1>
</header>
<table>
    <tr>
        <th>Autonr</th>
        <th>Sisenemis mass</th>
        <th>Lahkumis mass</th>
        <th>Erinevus</th>
    </tr>
    <?php
    while($kask->fetch()){
        echo "
                 <tr>
                   <td>$autonr</td>
                   <td>$sisenemismassi</td>
                   <td>$lahkumismass</td>
                   <td>$paring</td>
                   <td><a href='?kustuta=$id'>Kustuta</a></td>
                 </tr>
               ";
    }
    ?>
</table>
</body>
