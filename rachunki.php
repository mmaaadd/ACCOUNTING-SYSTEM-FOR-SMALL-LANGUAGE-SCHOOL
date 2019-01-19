<script> // select proper menu item as active
    window.onload = function() {
        $("#menu_rach").addClass("active-link");
    }
</script>
<div id="spiffycalendar" class="text"></div>	

<!--overlay for item edition-->
    <div id = "edit_overlay" class="save_overlay">
        <div class="panel panel-primary-edit">
            <div id="edit_overlay_body" class="panel-body">
                <table style="text-align: left;">
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa szkoly:
                            </td>
                            <td class="form_cell">
                                <?php
                                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                                            $arr=$db->GetArray($sql);
                                            //			print "<pre>";
                                            //			var_export($arr);
                                            //			print "</pre>";
                                                        //sort($arr);
                                            $st='<select class="form-control" name="nazwa_szkoly" id="nazwa_szkoly_edit" style="height:34px; width:100%; text-align: left;">';
                                            foreach($arr as $k=>$v){
                                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                                            }
                                            $st.='</select>';
                                            echo $st;
                                ?>
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data wystawienia:</h5>
                            </td>
                            <td class="form_cell">
                                <input name="data_wystawienia" type="text"  id="data_wystawienia_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Termin płatności:
                            </td>
                            <td class="form_cell">
                                <input name="termin_platnosci" type="text"  id="termin_platnosci_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Numer rachunku:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nr_rachunku_edit" type="text" >
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Od:
                            </td>
                            <td class="form_cell">
                                <input name="data_od" type="text"  id="data_od_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>   
                        <tr>
                            <td class="form_cell_desc">
                                Do:
                            </td>
                            <td class="form_cell">
                                <input name="data_do" type="text"  id="data_do_edit" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>   
                        
                        
                        <tr>
                           <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateInvoice()" style="width:350px" value='Zapisz'>
                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick='$("#edit_overlay").css("display","none") ' style="width:350px" value='Anuluj'>

                            </td>
                        </tr>          

                    </tbody>
                </table>
            </div>
            <div id="edit_overlay_body_custom" class="panel-body">
                <table style="text-align: left;">
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa szkoly:
                            </td>
                            <td class="form_cell">
                                <?php
                                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                                            $arr=$db->GetArray($sql);
                                            //			print "<pre>";
                                            //			var_export($arr);
                                            //			print "</pre>";
                                                        //sort($arr);
                                            $st='<select class="form-control" name="nazwa_szkoly_custom_edit" id="nazwa_szkoly_custom_edit" style="height:34px; width:350px; text-align: left;">';
                                            foreach($arr as $k=>$v){
                                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                                            }
                                            $st.='</select>';
                                            echo $st;
                                ?>
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data wystawienia:</h5>
                            </td>
                            <td class="form_cell">
                                <input id="data_wystawienia_custom_edit" type="text"  class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Termin płatności:
                            </td>
                            <td class="form_cell">
                                <input id="termin_platnosci_custom_edit" type="text"  class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Numer rachunku:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nr_rachunku_custom_edit" type="text" >
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Tytułem:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="tytulem_custom_edit" type="text" >
                            </td>
                        </tr> 
                        <!--
                        <tr>
                            <td class="form_cell_desc">
                                Kwota netto:
                            </td>
                            <td class="form_cell">                        
                                <div class="input-group">
                                    <input  name="kwota_netto" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control z-index-0" id="kwota_netto_custom_edit">
                                    <span class="input-group-addon">zł</span>
                                </div>
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td class="form_cell_desc">
                                Kwota brutto:
                            </td>
                            <td class="form_cell">                        
                                <div class="input-group">
                                    <input  name="kwota_netto" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control" id="kwota_brutto_custom_edit">
                                    <span class="input-group-addon">zł</span>
                                </div>
                            </td>
                        </tr>                         
                        <tr>
                           <td class="form_cell_desc">
                                <input class="btn btn-primary" onclick="updateCustomInvoice()" style="width:350px" value='Zapisz'>
                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick='$("#edit_overlay").css("display","none") ' style="width:350px" value='Anuluj'>

                            </td>
                        </tr>           

                    </tbody>
                </table>
            </div>            
        </div>
    </div>
 <!--[end] overlay for item edition-->



<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="">Rachunek na podstawie wpisanych zajęć</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in" style="height: auto;">
            <div class="panel-body">
                <table style="text-align: left;">
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa szkoly:
                            </td>
                            <td class="form_cell">
                                <?php
                                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                                            $arr=$db->GetArray($sql);
                                            //			print "<pre>";
                                            //			var_export($arr);
                                            //			print "</pre>";
                                                        //sort($arr);
                                            $st='<select class="chosen-select" name="nazwa_szkoly" id="nazwa_szkoly" style="height:34px; width:100%; text-align: left;">';
                                            foreach($arr as $k=>$v){
                                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                                            }
                                            $st.='</select>';
                                            echo $st;
                                ?>
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data wystawienia:</h5>
                            </td>
                            <td class="form_cell">
                                <input name="data_wystawienia" type="text"  id="SelectedDate1" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Termin płatności:
                            </td>
                            <td class="form_cell">
                                <input name="termin_platnosci" type="text"  id="SelectedDate3" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Numer rachunku:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nr_rachunku" type="text" >
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Od:
                            </td>
                            <td class="form_cell">
                                <input name="data_od" type="text"  id="SelectedDate4" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>   
                        <tr>
                            <td class="form_cell_desc">
                                Do:
                            </td>
                            <td class="form_cell">
                                <input name="data_do" type="text"  id="SelectedDate5" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>   
                        
                        
                        <tr>
                            <td class="form_cell_desc">

                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick="addInvoice()" style="width:350px" value='Dodaj rachunek'>

                            </td>
                        </tr>           

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed">Rachunek wpisany ręcznie</a>
            </h4>
        </div>
        <div id="collapseTwo" class="panel-collapse collapse" style="height: 0px;">
            <div class="panel-body">
                
                <table style="text-align: left;">
                    <tbody>
                        <tr>
                            <td class="form_cell_desc">
                                Nazwa szkoly:
                            </td>
                            <td class="form_cell">
                                <?php
                                            $sql="select * from szkoly where aktywna='1' ORDER BY nazwa ASC";

                                            $arr=$db->GetArray($sql);
                                            //			print "<pre>";
                                            //			var_export($arr);
                                            //			print "</pre>";
                                                        //sort($arr);
                                            $st='<select class="chosen-select" name="nazwa_szkoly_custom" id="nazwa_szkoly_custom" style="height:34px; width:350px; text-align: left;">';
                                            foreach($arr as $k=>$v){
                                                $st.='<option   value="'.$v['id_szkoly'].'">'.$v['nazwa'].'</option>';
                                            }
                                            $st.='</select>';
                                            echo $st;
                                ?>
                            </td>
                        </tr>	
                        <tr>
                            <td class="form_cell_desc">
                                <h5>Data wystawienia:</h5>
                            </td>
                            <td class="form_cell">
                                <input name="data_wystawienia_custom" type="text"  id="SelectedDate1_custom" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Termin płatności:
                            </td>
                            <td class="form_cell">
                                <input name="termin_platnosci_custom" type="text"  id="SelectedDate3_custom" class = "form-control SelectedDate" readonly style="cursor:pointer;"  >
                            </td>
                        </tr>
                        <tr>
                            <td class="form_cell_desc">
                                Numer rachunku:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="nr_rachunku_custom" type="text" >
                            </td>
                        </tr>                        
                        <tr>
                            <td class="form_cell_desc">
                                Tytułem:
                            </td>
                            <td class="form_cell">
                                <input class = "form-control"  id="tytulem_custom" type="text" >
                            </td>
                        </tr> 
                        <!--
                        <tr>
                            <td class="form_cell_desc">
                                Kwota netto:
                            </td>
                            <td class="form_cell">                        
                                <div class="input-group">
                                    <input  name="kwota_netto" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control z-index-0" id="kwota_netto_custom">
                                    <span class="input-group-addon">zł</span>
                                </div>
                            </td>
                        </tr>
                        -->
                        <tr>
                            <td class="form_cell_desc">
                                Kwota brutto:
                            </td>
                            <td class="form_cell">                        
                                <div class="input-group">
                                    <input  name="kwota_netto" type="text" onkeyup="cyfry_i_kropka(this);" class="form-control" id="kwota_brutto_custom">
                                    <span class="input-group-addon">zł</span>
                                </div>
                            </td>
                        </tr>                         
                        <tr>
                            <td class="form_cell_desc">

                            </td>
                            <td class="form_cell">
                                <input class="btn btn-primary" onclick="addCustomInvoice()" style="width:350px" value='Dodaj rachunek'>

                            </td>
                        </tr>           

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="invoiceTable">
</div>



<script>    
    
//get content for the table
	$(document).ready(function() {
		$(".chosen-select").chosen();
        getInvoiceTable();
	} );

function addInvoice(){
    // function adds invoice    
    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append("Dodaję rachunek") // show custom text
    postParameters = ({"nazwa_szkoly":$("#nazwa_szkoly").val(),"data_wystawienia":$("#SelectedDate1").val(), "termin_platnosci":$("#SelectedDate3").val(), "nr_rachunku":$("#nr_rachunku").val(), "data_od":$("#SelectedDate4").val(), "data_do":$("#SelectedDate5").val() })
        
    $.ajax({
        type: "POST",
        url: 'api/addInvoice.php',
        data: postParameters,
        dataType: "html",
        success: function(data) {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
            getInvoiceTable()
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
            getInvoiceTable()
        }
    });    
}

 function updateInvoice(){
    // function adds invoice   
    $("#edit_overlay").css("display","none");
    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append("Zmieniam rachunek") // show custom text
    postParameters = ({"nazwa_szkoly":$("#nazwa_szkoly_edit").val(),"data_wystawienia":$("#data_wystawienia_edit").val(), "termin_platnosci":$("#termin_platnosci_edit").val(), "nr_rachunku":$("#nr_rachunku_edit").val(), "data_od":$("#data_od_edit").val(), "data_do":$("#data_do_edit").val(), "ID_rachunku": localStorage.getItem("invoiceID")  })
        
    $.ajax({
        type: "POST",
        url: 'api/addInvoice.php',
        data: postParameters,
        dataType: "html",
        success: function(data) {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
            getInvoiceTable()
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
            getInvoiceTable()
        }
    });    
}
    
    
function addCustomInvoice(){
    // function adds invoice    
    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append("Dodaję rachunek") // show custom text
    postParameters = ({"nazwa_szkoly":$("#nazwa_szkoly_custom").val(),"data_wystawienia":$("#SelectedDate1_custom").val(), "termin_platnosci":$("#SelectedDate3_custom").val(), "nr_rachunku":$("#nr_rachunku_custom").val(), "kwota_netto":$("#kwota_netto_custom").val(), "kwota_brutto":$("#kwota_brutto_custom").val(),"tytulem":$("#tytulem_custom").val() })
        
    $.ajax({
        type: "POST",
        url: 'api/addCustomInvoice.php',
        data: postParameters,
        dataType: "html",
        success: function(data) {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
            getInvoiceTable()
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
            getInvoiceTable()
        }
    });    
}
    
function updateCustomInvoice(){
    // function changes invoice    
    $("#edit_overlay").css("display","none");
    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append("Zmieniam rachunek") // show custom text
    postParameters = ({"nazwa_szkoly":$("#nazwa_szkoly_custom_edit").val(),"data_wystawienia":$("#data_wystawienia_custom_edit").val(), "termin_platnosci":$("#termin_platnosci_custom_edit").val(), "nr_rachunku":$("#nr_rachunku_custom_edit").val(), "kwota_netto":"0", "kwota_brutto":$("#kwota_brutto_custom_edit").val(),"tytulem":$("#tytulem_custom_edit").val(), "ID_rachunku": localStorage.getItem("invoiceID") })
        
    $.ajax({
        type: "POST",
        url: 'api/addCustomInvoice.php',
        data: postParameters,
        dataType: "html",
        success: function(data) {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
            getInvoiceTable()
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
            getInvoiceTable()
        }
    });    
}
    
    
    
function getInvoiceTable() { 
//equipmentState [int] - 1=active, 0=utilized 
    $.ajax({
        type: "POST",
        url: 'api/get_invoice_table.php',
        dataType: "html",
        success: function(data) {
            $("#invoiceTable").empty();
            $("#invoiceTable").append(data);          
        },
        error: function() {
            $("#invoiceTable").empty() // clear content
            $("#invoiceTable").append("<p>Coś poszło nie tak, odśwież stronę.<p>")
        }
    });
} 
    
    function showInvoiceEditWindow(id_rachunku, za_etat){
        $.ajax({
            type: "POST",
            url: 'api/checkIfSchoolIsActive.php',
            data: ({"ID":id_rachunku}),
            dataType: "json",
            success: function(data) {
                if (data.aktywna==1){
                    if (za_etat==1){ // custom invoice
                        $("#edit_overlay_body_custom").css("display","block");
                        $("#edit_overlay_body").css("display","none");
                        $("#edit_overlay").css("display","block");
                        $("#data_wystawienia_custom_edit, #termin_platnosci_custom_edit, #nr_rachunku_custom_edit, #tytulem_custom_edit, #kwota_netto_custom_edit, #kwota_brutto_custom_edit").val("Wczytuję dane")
                        //$("#nazwa_szkoly_custom_edit_chosen").children(".chosen-single").html("<span>Wczytuję dane</span><div><b></b></div>")
                        $.ajax({
                            type: "POST",
                            url: 'api/getInvoiceByID.php',
                            data: ({"ID":id_rachunku}),
                            dataType: "json",
                            success: function(data) {
                                    $("#nazwa_szkoly_custom_edit").val(data.id_szkoly);
                                    //$("#nazwa_szkoly_custom_edit_chosen").children(".chosen-single").html("<span>"+data.nazwa_szkoly+"</span><div><b></b></div>")
                                    $("#data_wystawienia_custom_edit").val(data.data_wystawienia);
                                    $("#termin_platnosci_custom_edit").val(data.termin_platnosci);
                                    $("#nr_rachunku_custom_edit").val(data.nr_rachunku);
                                    $("#tytulem_custom_edit").val(data.tytulem);
                                    //$("#kwota_netto_custom_edit").val(data.kwota_netto);
                                    $("#kwota_brutto_custom_edit").val(data.kwota_brutto);                   
                                    localStorage.setItem("invoiceID", id_rachunku);

                            },
                            error: function() {
                                $("#nazwa_szkoly_edit,#nazwa_stawki_edit, #czas_edit, #kwota_edit, #tytul_edit").val("Błąd, spróbuj ponownie.")
                            }
                        });             



                    } else if (za_etat==0){ //regular invoice
                        $("#edit_overlay_body_custom").css("display","none");
                        $("#edit_overlay_body").css("display","block");
                        $("#edit_overlay").css("display","block");  
                        $("#data_wystawienia_edit, #termin_platnosci_edit, #nr_rachunku_edit, #data_od_edit, #data_do_edit").val("Wczytuję dane")
                       // $("#nazwa_szkoly_edit_chosen").children(".chosen-single").html("<span>Wczytuję dane</span><div><b></b></div>")
                        $.ajax({
                            type: "POST",
                            url: 'api/getInvoiceByID.php',
                            data: ({"ID":id_rachunku}),
                            dataType: "json",
                            success: function(data) {
                                   // $("#nazwa_szkoly_edit_chosen").children(".chosen-single").html("<span>"+data.nazwa_szkoly+"</span><div><b></b></div>")
                                    $("#nazwa_szkoly_edit").val(data.id_szkoly);
                                    //console.log(data.id_szkoly)
                                    $("#data_wystawienia_edit").val(data.data_wystawienia);
                                    $("#termin_platnosci_edit").val(data.termin_platnosci);
                                    $("#nr_rachunku_edit").val(data.nr_rachunku);
                                    $("#data_od_edit").val(data.data_od);
                                    //$("#kwota_netto_custom_edit").val(data.kwota_netto);
                                    $("#data_do_edit").val(data.data_do);                   
                                    localStorage.setItem("invoiceID", id_rachunku);

                            },
                            error: function() {
                                $("#nazwa_szkoly_edit,#nazwa_stawki_edit, #czas_edit, #kwota_edit, #tytul_edit").val("Błąd, spróbuj ponownie.")
                            }
                        });             




                    }                    
                    
             
                }
                else{
                    $("#save_overlay").css("display","block") // show overlay
                    $("#save_overlay_body").empty() // clear content
                    //$("#save_overlay_body").append("Nie możesz edytować rachunku dla szkoły, która nie jest aktywna.") // show custom text 
                    $("#save_overlay_body").append("<p>Nie możesz edytować rachunku dla szkoły, która nie jest aktywna.</p><button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text 
                }
                    
            },
            error: function() {
                    $("#save_overlay").css("display","block") // show overlay
                    $("#save_overlay_body").empty() // clear content
                    $("#save_overlay_body").append("<p>Nie udało się edytować rachunku.</p><button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text
            }
        });    
        
        

    }
</script>
