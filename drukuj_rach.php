<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/style_rach.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php 
	$id = $_GET['id'] ; 
	$podpis = $_GET['podpis'];
    require("api/access_comp.php");
	include('api/slownie.php'); //zamiana liczby na słowa
?>

</head>
<body >

<div class = "ramka">
<?php
//pobieranie danych rachunku
$sql="select * from rachunek where id_rachunku=".$id;
//echo $sql;
				$arr=$db->GetArray($sql);
							//print "<pre>";
							//var_export($arr);
							//print "</pre>";
//pobieranie danych szkoły
$sql2="select * from szkoly where id_szkoly=".$arr['0']['id_szkoly'];		
//echo $sql2;
				$arr2=$db->GetArray($sql2);
							//print "<pre>";
							//var_export($arr2);
							//print "</pre>";				

$sql3="select * from adres_firmy where ID_adresu=".$arr['0']['adres_id'];		
//echo $sql2;
				$arr3=$db->GetArray($sql3);
							//print "<pre>";
							//var_export($arr2);
							//print "</pre>";	              
              	
?>
</div>

<div class = "daty">
	Miejscowość:  
	<?php
	echo $arr['0']['miejscowosc'];
	?>
	<br>
	Data wystawienia:
	<?php
	echo $arr['0']['data_wystawienia'];
	?>

	<?php
	 if ($arr['0']['data_dostarczenia']>0)
		{	
			echo "<br>	Data dostarczenia: ";
			echo $arr['0']['data_dostarczenia'];
		}	
	if ($arr['0']['termin_platnosci']>0)
		{	
			echo "<br>	Termin płatności: ";
			echo $arr['0']['termin_platnosci'];
		}	
	?>	
</div>

<div class = "nr_rach">
	FAKTURA nr:
	<?php
	echo $arr['0']['nr_rachunku'];
	?>
	</br>
	ORYGINAŁ / KOPIA
</div>

<div class = "sprzedawca">
	Sprzedawca:<br>
	Nazwa Firmy<br>
  <?php
	echo $arr3['0']['Linia1'];
  echo '</br>';
	echo $arr3['0']['Linia2'];
  echo '</br>';  
	?>
	NIP: _<br>
	REGON: _<br>
	BANK: _<br>
	KONTO: _<br>
</div>
<div class = "kupujacy">
	Nabywca:<br>
	<?php
	echo $arr2['0']['nazwa'].'<br>';
	echo $arr2['0']['ulica'].'<br>';	
	echo $arr2['0']['kod_pocztowy'].' '.$arr2['0']['miejscowosc'].'<br>';		
	echo 'NIP: '.$arr2['0']['nip'].'<br>';	
	echo 'REGON: '.$arr2['0']['regon'].'<br>';
	?>
</div>
<?php

				if ($arr['0']['za_etat']==1)
					{
						include("assets/rachunki/etat.php");
					}

				else
					{
						include("assets/rachunki/bez_etatu.php");
					}
?>

<div class='podpisy'>
	<table width='650px'>
		<tbody>
		<tr  style="height: 100px;">
			<td>
			<p class='male'>...........................................................................<br>Osoba upoważniona do odbioru dokumentu</p>
			</td>
			<?php
				if ($podpis==1) //podpis i pieczatka na fakturze
					{
						echo '<td style="background-image: url(\'assets/img/podpis.png\')"><p class=\'male\'>...........................................................................<br>Osoba upoważniona do wystawienia dokumentu</p></td>';
						echo '<td style="background-image: url(\'assets/img/pieczec.png\')"><p class=\'male\'>......................................<br>Pieczęć firmy</p> </td>';
					}
				else // bez podpisu i pieczatki
					{
						echo '<td><p class=\'male\'>...........................................................................<br>Osoba upoważniona do wystawienia dokumentu</p></td>';
						echo '<td><p class=\'male\'>......................................<br>Pieczęć firmy</p> </td>';						
					}					
			?>
		</tr>
		</tbody>
	</table>	
</div>

</body>
</html>
