<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_ub_s").addClass("active-link");
    }
</script>	

<p></p>

<div id="spiffycalendar" class="text"></div>

	<table>
        <tbody>
            <tr>
                <td class="form_cell_desc">
                    <h5>Data przelewu:</h5>
                </td>
                <td class="form_cell">
                    <input name="data" type="text"  id="data" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >

                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">
                    Kwota:
                </td>
                <td class="form_cell">                        
                    <div class="input-group">
                        <input  name="kwota" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control z-index-0" id="kwota">
                        <span class="input-group-addon">zł</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">
                    Opis:
                </td>
                <td class="form_cell">
                    <input  name="opis" type="text" class="form-control z-index-0" id="opis">
                </td>
            </tr>
            <tr>
                <td class="form_cell_desc">

                </td>
                <td class="form_cell">
                    <input class="btn btn-primary" onclick="saveSec()" style="width:350px" value='Dodaj'>
                </td>
            </tr>
        </tbody>
	</table>

<hr>

<div id="sec_list">
</div>
		


<script language="JavaScript">

	$(document).ready(function() {
        refreshTable()
	} );

    function saveSec() {
        postParameters=({"data" : $("#data").val(), "opis":$("#opis").val(), "kwota":$("#kwota").val(),"n":8})  
        saveData("<p>Zapisuję ubepieczenie</p>", postParameters,refreshTable)    
    }
    function refreshTable(){
         $.ajax({
            type: "POST",
            url: 'api/get_soc_sec_table.php',
             dataType: "html",
            success: function(data) {
                $("#sec_list").empty();
                $("#sec_list").append(data);          
            },
            error: function() {
                $("#sec_list").empty() // clear content
                $("#sec_list").append("<p>Coś poszło nie tak, odśwież stronę.<p>")
            }
        });       
    }
</script>	