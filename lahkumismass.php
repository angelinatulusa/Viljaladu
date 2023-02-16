<!DOCTYPE html>
<?php
require_once("konf.php");
global $yhendus;
if(isSet($_REQUEST["sisestusnupp"])){
    if(!empty($_REQUEST["lahkumismass"])){
        $kask=$yhendus->prepare(
            "UPDATE viljaladu SET lahkumismass=? WHERE id=?");
        $kask->bind_param("ii", $_REQUEST["lahkumismass"], $_REQUEST["id"]);
        $kask->execute();
        echo "<meta http-equiv='refresh' content='0;url=autod.php'>";
    }
    else{echo '<script>alert("Nimi/perenimi ei tohi olla tühi!")</script>';}

}
$kask=$yhendus->prepare("SELECT id, autonr
FROM viljaladu WHERE lahkumismass=-1");
$kask->bind_result($id, $autonr);
$kask->execute();
?>
<html>
<body>
<head>
    <title>Lahkumismass</title>
</head>
<header><h1>Lahkumismass</h1></header>
<link rel="stylesheet" type="text/css" href="style.css">
    <nav class="navMenu">
    <?php
    echo "<a class='nav-link' href='lisaAuto.php'>Lisa auto</a>";
    echo "<a class='nav-link' href='lahkumismass.php'>Lisa lahkumis mass</a>";
    echo "<a class='nav-link' href='autod.php'>Vaata kõiki autod laos</a>";
    ?>
    </nav>
    <h2>Sisesta autode lahkumismass</h2>
<table>
    <?php
    while($kask->fetch()){
        echo "
		    <tr><td>Sisesta auto $autonr lahkumass</td></tr>
			<tr><td><form action=''>
			         <input type='hidden' name='id' value='$id' />
					 <input type='text' name='lahkumismass' />
					 <input type='submit' name='sisestusnupp' value='Sisesta tulemus' />
			      </form></td></tr>
		  ";
    }
    ?>
</table>
<footer>
    <img src="logo.png" alt="logo" width="80" height="80">
</footer>
</body>
</html>
