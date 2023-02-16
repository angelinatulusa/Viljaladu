<?php
/*$baasiaadress = "localhost";
$baasikasutaja = "tulusa";
$baasiparool = "123456";
$baasinimi = "tulusa";
$yhendus = new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);*/

$baasiaadress="d113375.mysql.zonevs.eu";
$baasikasutaja="d113375_eksam";
$baasiparool="jalg123456";
$baasinimi="d113375_eksam";
$yhendus=new mysqli($baasiaadress, $baasikasutaja, $baasiparool, $baasinimi);
//create table viljaladu( id int not null Primary key AUTO_INCREMENT, autonr varchar(6), sisenemismassi decimal(5,2) DEFAULT -1, lahkumismass decimal(5,2)DEFAULT -1,erinevus decimal(5,2) );
?>
