<html>
<head>
<link rel="stylesheet" type="text/css" href="assets/css/style_rach.css" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php 
	$miesiac = $_GET['m'] ; 
	$rok = $_GET['rok'];
?>

<?php 
    require("api/access_comp.php");
	include('api/slownie.php'); //zamiana liczby na słowa
?>

</head>
<body >

<div class = "ramka_ks">
<div class = "ramka_ks_m">
<p><b>Podatkowa księga przychodów i rozchodów, karta za miesiąc:

<?php
					if ($miesiac==1)
							{
							$miesiac2='styczeń';
							}
					elseif ($miesiac==2)
							{
							$miesiac2='luty';
							}
					elseif ($miesiac==3)
							{
							$miesiac2='marzec';
							}		
					elseif ($miesiac==4)
							{
							$miesiac2='kwiecień';
							}
					elseif ($miesiac==5)
							{
							$miesiac2='maj';
							}
					elseif ($miesiac==6)
							{
							$miesiac2='czerwiec';
							}
					elseif ($miesiac==7)
							{
							$miesiac2='lipiec';
							}
					elseif ($miesiac==8)
							{
							$miesiac2='sierpień';
							}
					elseif ($miesiac==9)
							{
							$miesiac2='wrzesień';
							}
					elseif ($miesiac==10)
							{
							$miesiac2='październik';
							}
					elseif ($miesiac==11)
							{
							$miesiac2='listopad';
							}
					elseif ($miesiac==12)
							{
							$miesiac2='grudzień';
							}
	echo $miesiac2.' '.$rok.'</b></p>';
	$od=$rok.'-'.$miesiac.'-01';
	if ($miesiac==12)
		{
		$miesiac3=1;
		$rok3=$rok+1;
		}
	else
		{
		$miesiac3=$miesiac+1;
		$rok3=$rok;
		}
	$do=$rok3.'-'.$miesiac3.'-01';
	//echo $od.'<br>';
	//echo $do.'<br>';
	
	//pobieranie  rachunków za miesiąc
$sql="select rachunek.data_wystawienia, rachunek.nr_rachunku, szkoly.nazwa, szkoly.ulica, szkoly.kod_pocztowy, szkoly.miejscowosc, rachunek.od, rachunek.kwota, rachunek.za_etat, rachunek.tytulem from rachunek,szkoly where rachunek.data_wystawienia >= '".$od."' and rachunek.data_wystawienia < '".$do."' and rachunek.id_szkoly=szkoly.id_szkoly";
//echo $sql;
				$arr=$db->GetArray($sql);
						sort($arr);
						//	print "<pre>";
						//	var_export($arr);
						//	print "</pre>";
	
$sql='select koszty.Data, koszty.ndk, sklepy.nazwa, sklepy.ulica, sklepy.kod_pocztowy, sklepy.miejscowosc, koszty.opis, koszty.koszt from sklepy, koszty where koszty.Data>="'.$od.'" and koszty.Data<"'.$do.'" and koszty.id_sklepu = sklepy.id_sklepu and koszty.sam is null';
				$arr2=$db->GetArray($sql);
						sort($arr2);
						//	print "<pre>";
						//	var_export($arr2);
						//	print "</pre>";
	
$sql='select koszty.Data, koszty.ndk, sklepy.nazwa, sklepy.ulica, sklepy.kod_pocztowy, sklepy.miejscowosc, koszty.opis, koszty.koszt from sklepy, koszty where koszty.Data>="'.$od.'" and koszty.Data<"'.$do.'" and koszty.id_sklepu = sklepy.id_sklepu and koszty.sam = 1';
				$arr5=$db->GetArray($sql);
						sort($arr5);
						//	print "<pre>";
						//	var_export($arr2);
						//	print "</pre>";	
?>	
	<table class='sample' width='1050px'>
		<tbody>
			<tr>
				<td><p>
					<b>Data zdarzenia<br>gosp.</b></p>
				</td>
				<td><p>
					<b>Numer dowodu<br>księgowego</b></p>
				</td>
				<td width="250px"><p>
					<b>Imię i nazwisko<br>(firma)</b></p>
				</td>				
				<td><p>
					<b>Adres</b></p>
				</td>
				<td><p>
					<b>Opis zdarzenia<br>gosp.</b></p>
				</td>				
				<td width = '80px'><p>
					<b>Razem<br>przychód</b></p>
				</td>
				<td width = '80px'><p>
					<b>Razem<br>wydatki</b></p>
				</td>				
			</tr>
	
			<?php
			$dochod=0;
			$czy_jest=0;
				foreach($arr as $k=>$v){
				if ($czy_jest==0)
					{
						$st='<tr><td colspan=7><p>Przychody:</p></td></tr>';
						echo $st;
					}
				$czy_jest=1;
				$dochod=$dochod+$v['kwota'];
				$tytulem="Nauka języka angielskiego".'<br>'.$miesiac2.' '.$rok;
				if ($v['za_etat']==1)
					{
						$tytulem=$v['tytulem'];
					}
					$st='<tr><td><p>'.$v['data_wystawienia'].'</p></td><td><p>  '.$v['nr_rachunku'].' </p></td><td width="250px"><p> '.$v['nazwa'].' </p></td><td><p> '.$v['ulica'].'<br>'.$v['kod_pocztowy'].' '.$v['miejscowosc'].'</p></td><td><p>'.$tytulem.'</p></td><td width = "80px"><p>'.$v['kwota'].' zł</p></td><td width = "80px"></td></tr>';
					echo $st;
					}
				
				?>
			<?php
			$koszty=0;
			$czy_jest=0;
				foreach($arr2 as $k=>$v){
					if ($czy_jest==0)
						{
							$st='<tr><td colspan=7><p>Koszty:</p></td></tr>';
							echo $st;
						}
				$czy_jest=1;
				$koszty=$koszty+$v['koszt'];
					$st='<tr><td><p>'.$v['Data'].'</p></td><td><p>  '.$v['ndk'].' </p></td><td width="250px"><p> '.$v['nazwa'].' </p></td><td><p> '.$v['ulica'].'<br>'.$v['kod_pocztowy'].' '.$v['miejscowosc'].'</p></td><td><p>'.$v['opis'].'</p></td><td width = "80px"></td><td width = "80px"><p>'.$v['koszt'].' zł</p></td></tr>';
					echo $st;
					}
				$czy_jest=0;
				foreach($arr5 as $k=>$v){
				if ($czy_jest==0)
						{
							$st='<tr><td colspan=7><p>Koszty związane z samochodem:</p></td></tr>';
							echo $st;
						}
				$czy_jest=1;
				$koszty=$koszty+$v['koszt'];
					$st='<tr><td><p>'.$v['Data'].'</p></td><td><p>  '.$v['ndk'].' </p></td><td width="250px"><p> '.$v['nazwa'].' </p></td><td><p> '.$v['ulica'].'<br>'.$v['kod_pocztowy'].' '.$v['miejscowosc'].'</p></td><td><p>'.$v['opis'].'</p></td><td width = "80px"></td><td width = "80px"><p>'.$v['koszt'].' zł</p></td></tr>';
					echo $st;
					}				
				?>
			<tr>
				<td colspan = 5><p class="prawe"><b>Razem od początku miesiąca:</b></p></td>
				<td width = "80px"><p><b> <?php echo number_format ( $dochod, 2 , ',', ' ').' zł' ?></b></p></td>
				<td width = "80px"><p><b> <?php echo number_format ( $koszty, 2 , ',', ' ').' zł' ?></b></p></td>
			</td></tr>
			<?php
				$do=$od; //do poprzedniego miesiaca
				$od=$rok.'-01-01'; // od poczatku roku
				
//pobieranie rachunków od poczatku roku
				$sql="select rachunek.data_wystawienia, rachunek.nr_rachunku, szkoly.nazwa, szkoly.ulica, szkoly.kod_pocztowy, szkoly.miejscowosc, rachunek.od, rachunek.kwota from rachunek,szkoly where rachunek.data_wystawienia >= '".$od."' and rachunek.data_wystawienia < '".$do."' and rachunek.id_szkoly=szkoly.id_szkoly";
				//echo $sql;
				$arr3=$db->GetArray($sql);
						//	print "<pre>";
						//	var_export($arr);
						//	print "</pre>";

//pobieranie kosztów od poczatku roku						
				$sql='select koszty.Data, koszty.ndk, sklepy.nazwa, sklepy.ulica, sklepy.kod_pocztowy, sklepy.miejscowosc, koszty.opis, koszty.koszt from sklepy, koszty where koszty.Data>="'.$od.'" and koszty.Data<"'.$do.'" and koszty.id_sklepu = sklepy.id_sklepu';
				$arr4=$db->GetArray($sql);
						//	print "<pre>";
						//	var_export($arr2);
						//	print "</pre>";
				$koszty_rok=0;
				$rachunki_rok=0;
				foreach($arr3 as $k=>$v)
					{
				$rachunki_rok=$rachunki_rok+$v['kwota'];
					}
				foreach($arr4 as $k=>$v)
					{
				$koszty_rok=$koszty_rok+$v['koszt'];
					}					
			
			?>
			<tr>
				<td colspan = 5><p class="prawe"><b>Suma od początku roku:</b></p></td>
				<td> <p><b> <?php echo number_format ( $dochod+$rachunki_rok, 2 , ',', ' ').' zł' ?></b></p></td>
				<td> <p><b> <?php echo number_format ( $koszty+$koszty_rok, 2 , ',', ' ').' zł' ?></b></p></td>
			</td></tr>			
			
		</tbody>
	</table>
	
	
	
	
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
?>
</div>
</div>






</body>
</html>
