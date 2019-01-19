<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_sprzet").addClass("active-link");
    }
</script>	
<!--overlay for item edition-->
    <div id = "edit_overlay" class="save_overlay">
        <div class="panel panel-primary-edit">
            <div id="edit_overlay_body" class="panel-body">
                <table>
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Opis:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="opis_sprzetu_edit" type="text" >
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data zakupu:</h5>
                            </td>
                            <td class="form_cell">
                                <input name="data_zakupu" type="text"  id="buyDate_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data utylizacji:</h5>
                            </td>
                            <td class="form_cell">
                                <input name="data_zakupu" type="text"  id="utilizeDate_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Nr rachunku:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control" name="ndk" id="ndk_edit" type="text" >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateEquipment()" style="width:350px" value='Zapisz'>
                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick='$("#edit_overlay").css("display","none") ' style="width:350px" value='Anuluj'>

                            </td>
                        </tr>           

                    </tbody>
                </table>
            </div>
        </div>
 <!--[end] overlay for item edition-->
        
    </div> 
	<p></p>
	<div id="spiffycalendar" class="text"></div>
    <table>
        <tbody>
            <tr>
                <td class="form_cell_desc">
                    Opis:
                </td>
                <td class="form_cell">
                    <input class = "form-control"  id="opis_sprzetu" type="text" >
                </td>
            </tr>	
            <tr>
			<td class="form_cell_desc">
				<h5>Data:</h5>
                </td>
                <td class="form_cell">
                    <input name="data_zakupu" type="text"  id="SelectedDate3" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
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

                </td>
                <td class="form_cell">
                    <input class="btn btn-primary" onclick="saveEquipment()" style="width:350px" value='Dodaj sprzęt'>

                </td>
            </tr>           
            
        </tbody>
    </table>
	

<hr>
<p>		
	<b>Sprzęt na stanie:</b>
</p>
<div id="equipment_owned">
</div>

<br>
<p class="nieaktywne">		
	<b>Sprzęt zutylizowany:</b>
</p>
<div id="equipment_utilized">
</div>

<script>    
//function to save equipment:
    function saveEquipment() { 
        postParameters=({data_zakupu : $("#SelectedDate3").val(), opis_sprzetu:$("#opis_sprzetu").val(), ndk:$("#ndk").val(),n:22})  
        saveData("<p>Zapisuję sprzęt</p>", postParameters,getEquipmentTables)    
    }
    
function getEquipmentTable(equipmentState,locationOnPage) { 
//equipmentState [int] - 1=active, 0=utilized 
    $.ajax({
        type: "POST",
        url: 'api/get_eq_table.php',
        data: ({naStanie:equipmentState}),
        dataType: "html",
        success: function(data) {
            $(locationOnPage).empty();
            $(locationOnPage).append(data);          
        },
        error: function() {
            $(locationOnPage).empty() // clear content
            $(locationOnPage).append("<p>Coś poszło nie tak, odśwież stronę.<p>")
        }
    });
} 

function getEquipmentTables() { //refreshes all tables with data on the page
    getEquipmentTable(1,"#equipment_owned"); 
    getEquipmentTable(0,"#equipment_utilized");
}
    
function showUtilizeEquipmentWindow(equipmentID) { //utilizes equipment
    $("#utilizeDate_edit,#opis_sprzetu_edit, #buyDate_edit, #ndk_edit").val("Wczytuję dane") //clear previous entries
    $("#edit_overlay").css("display","block") // show overlay
    $.ajax({
        type: "POST",
        url: 'api/getEquipmentByID.php',
        data: ({"ID":equipmentID}),
        dataType: "json",
        success: function(data) {
                $("#opis_sprzetu_edit").val(data.name);
                $("#utilizeDate_edit").val(data.utilizationDate);
                $("#buyDate_edit").val(data.buyDate);
                $("#ndk_edit").val(data.ndk);
                localStorage.setItem("equipmentID", equipmentID);
        },
        error: function() {
            $("#utilizeDate_edit,#opis_sprzetu_edit, #buyDate_edit, #ndk_edit").val("Błąd, spróbuj ponownie.")
        }
    });    
}
    
function updateEquipment(){
    //saves changes in the equipment
    $("#edit_overlay").css("display","none") // hide overlay
    postParameters = ({"id_sprzetu":localStorage.getItem("equipmentID"),"data_zakupu":$("#buyDate_edit").val(),"ndk": $("#ndk_edit").val(), "opis": $("#opis_sprzetu_edit").val(),"data_utylizacji":$("#utilizeDate_edit").val(),"n":23})
    saveData("Zapisuję zmiany", postParameters,getEquipmentTables)
}
    
$( document ).ready(function() {
    getEquipmentTable(1,"#equipment_owned");
    getEquipmentTable(0,"#equipment_utilized");
});

    
</script>

