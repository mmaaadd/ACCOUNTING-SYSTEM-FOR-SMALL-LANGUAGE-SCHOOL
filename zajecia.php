	<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_zajecia").addClass("active-link");
    }
</script>

	<p></p>

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
                    Ilość:
                </td>
                <td class="form_cell">
                    <input class = "form-control" id="ilosc" type="text" onkeyup="cyfry_i_kropka(this);" >
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">
                    Nazwa stawki:
                </td>
                <td class="form_cell">
                    					<?php
								$sql="select id_stawki, nazwa_stawki from stawki where aktywna='1' ORDER BY nazwa_stawki ASC";
								$arr=$db->GetArray($sql);
									//print "<pre>";
									//var_export($arr);
									//print "</pre>";
									//sort($arr);
						$st='<select class="chosen-select" id="stawka" style="height:34px; width:100%">';
						foreach($arr as $k=>$v){
							$st.='<option value="'.$v['id_stawki'].'">'.$v['nazwa_stawki'].'</option>';
						}
						$st.='</select>';
						echo $st;
					?>
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">

                </td>
                <td class="form_cell">
                    <input class="btn btn-primary" onclick="saveLessons()" style="width:350px" value='Dodaj'>

                </td>
            </tr>
        </tbody>
	</table>

<hr>

<table  id="tablica_zajecia" class="display" > <thead><tr ><th width="1000px"><p><b>Data</b></p></th><th width="500px"><p> <b>Ilość</b> </p></th><th width="1000px"><p> <b>Nazwa stawki</b> </p></th><th width="500px">&nbsp</th></tr></thead></table>


<script type="text/javascript">


	$(document).ready(function() {
		$('#tablica_zajecia').DataTable({
			"order": [[ 0, "desc" ]],
			"serverSide": true,
			"ajax": "api/get_lessons_list.php"
		});
		$('#tablica_zajecia').css('display', 'block');
        $(".chosen-select").chosen();
	} );

    function saveLessons(){
          postParameters=({"data" : $("#SelectedDate1").val(), "ilosc":$("#ilosc").val(), "stawka":$("#stawka").val(),n:2})  
            saveData("<p>Dodaję zajęcia</p>", postParameters,refreshTable)      
    }	

    function refreshTable() {
        $("#tablica_zajecia").DataTable().ajax.reload();
    }
    
	
</script>		
