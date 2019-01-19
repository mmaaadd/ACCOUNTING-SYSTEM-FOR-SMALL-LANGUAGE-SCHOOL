<?php
    require("access_comp.php");
    include("adodb/adodb.php");
 ?>

 <?php  
		$id=$_POST['id'];
		$tabela= $_POST['tabela'];
		$aktywna = $_POST['aktywna'];
		$kolumna = $_POST['kolumna'];
?>


<?php

//echo "INSERT INTO".$tabela_docelowa." (".$parametry.") VALUES(".$wartosci.")<br> ";

// laczenie do mysql login:root pass:madzia
mysql_connect($host_sql, $user_sql, $haslo_sql) or die(mysql_error());
//echo "Connected to MySQL<br />";

// laczenie z tabela "madzia_firma"
mysql_select_db($baza_sql) or die(mysql_error());
//echo "Connected to Database <br />";

//echo "UPDATE '".$tabela."' SET 'aktywna' ='".$aktywna."' WHERE '".$kolumna."'='".$id."';";

// Insert a row of information into the table "example"
mysql_query("UPDATE ".$tabela." SET aktywna ='".$aktywna."' WHERE ".$kolumna."='".$id."';") 
or die(mysql_error());  
//echo "Data Inserted!";
?>



<?php
if ($kolumna=='id_stawki' && $aktywna=='1')
	{
		echo '<p><b>Aktywowano stawkę</b></p>';
		$n=4;
	}
if ($kolumna=='id_stawki' && $aktywna=='0')
	{
		echo '<p><b>Dezaktywowano stawkę</b></p>';
		$n=4;
	}
if ($kolumna=='id_szkoly' && $aktywna=='1')
	{
		echo '<p><b>Aktywowano szkołę</b></p>';
		$n=5;
	}
if ($kolumna=='id_szkoly' && $aktywna=='0')
	{
		echo '<p><b>Dezaktywowano szkołę</b></p>';
		$n=5;
	}
if ($kolumna=='id_sklepu' && $aktywna=='1')
	{
		echo '<p><b>Aktywowano sklep</b></p>';
		$n=3;
	}
if ($kolumna=='id_sklepu' && $aktywna=='0')
	{
		echo '<p><b>Dezaktywowano sklep</b></p>';
		$n=3;
	}

?>
