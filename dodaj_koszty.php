<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_koszty").addClass("active-link");
    }
</script>

	<p></p>
	<SCRIPT language="JavaScript">//cal1.writeControl();</SCRIPT>
	<div id="spiffycalendar" class="text"></div>
		<!--wywołanie kalendarza -->

	<table>
	<tbody>
		<tr>
			<td class="form_cell_desc">
				<h5>Data:</h5>
			</td>
			<td class="form_cell">
				<input name="data" type="text"  id="SelectedDate1" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Nazwa sklepu:
			</td>
			<td class="form_cell">
				<?php
							$sql="select nazwa, id_sklepu from sklepy where aktywna='1'  ORDER BY nazwa ASC";
							$arr=$db->GetArray($sql);
								//print "<pre>";
								//var_export($arr);
								//print "</pre>";
								//sort($arr);
					$st='<select class="chosen-select" name="sklep" id="sklep" style="height:34px; width:100%">';
					foreach($arr as $k=>$v){
						$st.='<option value="'.$v['id_sklepu'].'">'.$v['nazwa'].'</option>';
					}
					$st.='</select>';
					echo $st;
				?>
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Nr rachunku:
			</td>
			<td class="form_cell">
				<input class = "form-control" name="ndk" id="ndk" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Opis:
			</td>
			<td class="form_cell">
				<input class = "form-control"  id="opis" type="text" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">
				Koszt:
			</td>
			<td class="form_cell">
				<input class = "form-control" name="koszt" id="koszt" type="text" onkeyup="cyfry_i_myslnik_i_kropka(this);" >
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">

			</td>
			<td class="form_cell">
                <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" name="sprzet" id="sprzet" value="1">
                        Dodaj jako sprzęt
                      </label>
                </div>
			</td>
		</tr>
		<tr>
			<td class="form_cell_desc">

			</td>
			<td class="form_cell">
                <input class="btn btn-primary" onclick="saveCost()" style="width:350px" value='Dodaj'>

			</td>
		</tr>
	</tbody>
	</table>




		<hr>



	<?php

				$st='<table id="tablica_koszty" class="display" > <thead> <tr><th width="100px"><p><b>Data</b></p></th><th width="100px"><p><b>Nazwa sklepu</b> </p></th><th width="100px"><p> <b>Nr rach.</b> </p></th><th width="100px"><p> <b>Opis</b></p></th><th width="100px"><p> <b>Kwota</b></p></th><th width="100px">&nbsp</th></tr></thead></table>';
				echo $st;
		?>

<script>    
//function to save cost:
    function saveCost() {
        var checkbox_val;    
        if($("#sprzet:checked").val()==1){//get checkbox value
            checkbox_val=1}
        else {
            checkbox_val=0}    
        postParameters=({data : $("#SelectedDate1").val(), sklep:$("#sklep").val(), ndk:$("#ndk").val(), opis:$("#opis").val(),koszt:$("#koszt").val(),sprzet:checkbox_val,n:1})  
        saveData("<p>Zapisuję koszt</p>", postParameters,refreshTable)    
    }

    function refreshTable() {
        $("#tablica_koszty").DataTable().ajax.reload();
    }
        
    
//get content for the table
	$(document).ready(function() {
		$('#tablica_koszty').DataTable({
			"order": [[ 0, "desc" ]],
			"serverSide": true,
			"ajax": "api/get_costs_list.php"
		});
		$('#tablica_zajecia').css('display', 'block');

		$(".chosen-select").chosen();
	} );



</script>
