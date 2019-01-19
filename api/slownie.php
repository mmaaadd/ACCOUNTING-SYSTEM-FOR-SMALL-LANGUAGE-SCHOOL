<?php
function d2w( $digits )
{
	$jednosci = Array( 'zero', 'jeden', 'dwa', 'trzy', 'cztery', 'pięć', 'sześć', 'siedem', 'osiem', 'dziewięć' );
	$dziesiatki = Array( '', 'dziesięć', 'dwadzieścia', 'trzydzieści', 'czterdzieści', 'piećdziesiąt', 'sześćdziesiąt', 'siedemdziesiąt', 'osiemdziesiąt', 'dziewiećdziesiąt' );
	$setki = Array( '', 'sto', 'dwieście', 'trzysta', 'czterysta', 'piećset', 'sześćset', 'siedemset', 'osiemset', 'dziewiećset' );
	$nastki = Array( 'dziesieć', 'jedenaście', 'dwanaście', 'trzynaście', 'czternaście', 'piętnaście', 'szesnaście', 'siedemnaście', 'osiemnaście', 'dzięwietnaście' );
	$tysiace = Array( 'tysiąc', 'tysiące', 'tysięcy' );
 
	if ($digits>0)
		{
		$digits = (string) $digits;
		$digits = strrev( $digits );
		$i = strlen( $digits );
	 
		$string = '';
	 
		if( $i > 5 && $digits[5] > 0 )
			$string .= $setki[ $digits[5] ] . ' ';
		if( $i > 4 && $digits[4] > 1 )
			$string .= $dziesiatki[ $digits[4] ] . ' ';
		elseif( $i > 3 && $digits[4] == 1 )
			$string .= $nastki[$digits[3]] . ' ';
		if( $i > 3 && $digits[3] > 0 && $digits[4] != 1 )
			$string .= $jednosci[ $digits[3] ] . ' ';
	 
		$tmpStr = substr( strrev( $digits ), 0, -3 );
		if( strlen( $tmpStr ) > 0 )
		{
			$tmpInt = (int) $tmpStr;
			if( $tmpInt == 1 )
				$string .= $tysiace[0] . ' ';
			elseif( ( $tmpInt % 10 > 1 && $tmpInt % 10 < 5 ) && ( $tmpInt < 10 || $tmpInt > 20 ) )
				$string .= $tysiace[1] . ' ';
			else
				$string .= $tysiace[2] . ' ';
		}
	 
		if( $i > 2 && $digits[2] > 0 )
			$string .= $setki[$digits[2]] . ' ';
		if( $i > 1 && $digits[1] > 1 )
			$string .= $dziesiatki[$digits[1]] . ' ';
		elseif( $i > 0 && $digits[1] == 1 )
			$string .= $nastki[$digits[0]] . ' ';
		if( $digits[0] > 0 && $digits[1] != 1 )
			$string .= $jednosci[$digits[0]] . ' ';
	 	}
	else
		{
			$string='zero ';
		}
	return $string;
 
}
 
function slownie($kwota){
  $zl = array("złotych", "złoty", "złote");
  $gr = array("groszy", "grosz", "grosze");
	$kwotaArr = explode( '.', $kwota );
 
	$ostZl = substr($kwotaArr[0], -1, 1);
		switch($ostZl){
		  case "0":
			$zlote = $zl[0];
		  break;
 
		  case "1":
			$ost2Zl = substr($kwotaArr[0], -2, 2);
 
 
				if($kwotaArr[0] == "1"){
				  $zlote = $zl[1];
				}
				elseif($ost2Zl == "01"){
				  $zlote = $zl[0];
				}
				else{
				  $zlote = $zl[0];
				}
		  break;
 
		  case "2":
			$ost2Zl = substr($kwotaArr[0], -2, 2);
				if($ost2Zl == "12"){
				  $zlote = $zl[0];
				}
				else{
				  $zlote = $zl[2];
				}
		  break;
 
		  case "3":
			$ost2Zl = substr($kwotaArr[0], -2, 2);
				if($ost2Zl == "13"){
				  $zlote = $zl[0];
				}
				else{
				  $zlote = $zl[2];
				}
		  break;
 
		  case "4":
			$ost2Zl = substr($kwotaArr[0], -2, 2);
				if($ost2Zl == "14"){
				  $zlote = $zl[0];
				}
				else{
				  $zlote = $zl[2];
				}
		  break;
 
		  case "5":
			$zlote = $zl[0];
		  break;
 
		  case "6":
			$zlote = $zl[0];
		  break;
 
		  case "7":
			$zlote = $zl[0];
		  break;
 
		  case "8":
			$zlote = $zl[0];
		  break;
 
		  case "9":
			$zlote = $zl[0];
		  break;
		}
 
 
 
 
	  ############### PONIZEJ ||VVV|| GROSZE


 
 
 
 
	$ostGr = substr($kwotaArr[1], -1, 1);
		switch($ostGr){
		  case "0":
			$grosze = $gr[0];
		  break;
 
		  case "1":
			$ost2Gr = substr($kwotaArr[1], -2, 2);
 
 
				if($kwotaArr[0] == "1"){
				  $grosze = $gr[1];
				}
				elseif($ost2Gr == "01"){
				  $grosze = $gr[1];
				}
				else{
				  $grosze = $gr[0];
				}
		  break;
 
		  case "2":
			$ost2Gr = substr($kwotaArr[1], -2, 2);
				if($ost2Gr == "12"){
				  $grosze = $gr[0];
				}
				else{
				  $grosze = $gr[2];
				}
		  break;
 
		  case "3":
			$ost2Gr = substr($kwotaArr[1], -2, 2);
				if($ost2Gr == "13"){
				  $grosze = $gr[0];
				}
				else{
				  $grosze = $gr[2];
				}
		  break;
 
		  case "4":
			$ost2Gr = substr($kwotaArr[1], -2, 2);
				if($ost2Gr == "14"){
				  $grosze = $gr[0];
				}
				else{
				  $grosze = $gr[2];
				}
		  break;
 
		  case "5":
			$grosze = $gr[0];
		  break;
 
		  case "6":
			$grosze = $gr[0];
		  break;
 
		  case "7":
			$grosze = $gr[0];
		  break;
 
		  case "8":
			$grosze = $gr[0];
		  break;
 
		  case "9":
			$grosze = $gr[0];
		  break;
		}
 
	return( d2w( $kwotaArr[0] ) . ' '.$zlote.' i ' . d2w( $kwotaArr[1] ) . $grosze );
}
?>
 
  

