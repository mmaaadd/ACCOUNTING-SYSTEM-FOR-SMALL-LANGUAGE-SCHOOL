function cyfry(field)
{
if (field.value.length > 0)
  {
  flaga=true;
  OK = true;
  text = '';
  for (i = 0; i < field.value.length; i++)
        {
        digit = field.value.charAt(i);
        if(flaga)
      {
          if (digit >= '0' && digit <= '9' ) text += digit;
          else OK = false;
          }
        else
          {
          if (digit >= '0' && digit <= '9' ) text += digit;
          else OK = false;
          }
        }
  if (!OK) field.value = text;
  }
}

function cyfry_i_kropka(field)
{
if (field.value.length > 0)
  {
  flaga=true;
  OK = true;
  text = '';
  for (i = 0; i < field.value.length; i++)
        {
			digit = field.value.charAt(i);
			if(flaga)
				{
					if (digit >= '0' && digit <= '9'||digit=='.'||digit==',')
					   {
					       if (digit==',')
					           {
					               digit='.';
					               OK = false;
					           }
					       text += digit;
					   }
					else OK = false;
				}
			else
				{
					if (digit >= '0' && digit <= '9' ) text += digit;
					else OK = false;
				}
			if(digit=='.')flaga=false;
        }
  if (!OK) field.value = text;
  }
}

function cyfry_i_myslnik(field)
{
if (field.value.length > 0)
  {
  flaga=true;
  OK = true;
  text = '';
  for (i = 0; i < field.value.length; i++)
        {
        digit = field.value.charAt(i);
        if(flaga)
      {
          if (digit >= '0' && digit <= '9'||digit=='-' ) text += digit;
          else OK = false;
          }
        else
          {
          if (digit >= '0' && digit <= '9' ) text += digit;
          else OK = false;
          }
		if(digit=='-')flaga=false;
        }
  if (!OK) field.value = text;
  }
}

function cyfry_i_myslnik_i_kropka(field)
{
  if (field.value.length > 0)
    {
    var flaga_m=true;
    var flaga_k=true
    var OK = true;
    var text = '';
    for (i = 0; i < field.value.length; i++){
      digit = field.value.charAt(i);
      if(digit >= '0' && digit <= '9'){
        text = text + digit;
      }
      else if (digit=="-" && flaga_m==true) {
        text = text + digit;
        flaga_m=false;
      }
      else if (digit=="." && flaga_k==true) {
        text = text + digit;
        flaga_k=false;
      }
      else if (digit=="," && flaga_k==true) {
        text = text + ".";
        flaga_k=false;
        OK = false;
      }
      else {
        OK = false;
      }
    }
    if (!OK) field.value = text;
  }
}

function saveData(windowMessage, postParameters,refreshCallback) {
    // function saving to process.php
    // windowMessage [string]- information displayed on the overlay
    // postParameters [json ({aaa:bbb,ccc:ddd})] - post parameters to be sent
    // refreshCallback [function] - function which shall be called after data is updated
    
    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append(windowMessage) // show custom text
    var checkbox_val;    
    if($("#sprzet:checked").val()==1){//get checkbox value
        checkbox_val=1}
    else {
        checkbox_val=0}    
        
    $.ajax({
        type: "POST",
        url: 'api/process.php',
        data: postParameters,
        dataType: "html",
        success: function(data) {
            refreshCallback();
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text           
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
        }
    });
}

function deleteRecord(windowMessage, recordTable, columnName, recordValue,successMessage,refreshCallback) {
    // function removing record using delete.php
    // windowMessage [string]- information displayed on the overlay
    // recordTable [string]- table with report for erasing
    // columnName [string]-name of column in which we are looking for
    // record value [string] - record we are looking for
    // successMessage [string] - message to be displayed if success
    // refreshCallback [function] - function which shall be called after data is updated

    $("#save_overlay").css("display","block") // show overlay
    $("#save_overlay_body").empty() // clear content
    $("#save_overlay_body").append(windowMessage) // show custom text
  
        
    $.ajax({
        type: "POST",
        url: 'api/delete.php',
        data: ({"tabela":recordTable, "parametr":columnName, "n":recordValue, "succesMsg":successMessage}),
        dataType: "html",
        success: function(data) {
            refreshCallback();
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text           
        },
        error: function() {
            $("#save_overlay_body").empty() // clear content
            $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
        }
    });
}

    function switchState(itemID, switchToState, itemType, windowMessage, refreshCallback){
        // update existing record to change its state
        // shopID [int] - shop ID from database
        // switchToState [int] - 0=deactivate, 1=activate
        // itemType[string] - "shop"
        // windowMessage [string]- information displayed on the overlay
        // refreshCallback [function] - function which shall be called after data is updated
        $("#save_overlay").css("display","block") // show overlay
        $("#save_overlay_body").empty() // clear content
        $("#save_overlay_body").append(windowMessage) // show custom text
        
        if (itemType == "shop"){
            if(switchToState==0){
                postParamters=({"id":itemID,"tabela":"sklepy", "aktywna":0, "kolumna":"id_sklepu"});   
            }   
            else{
                postParamters=({"id":itemID,"tabela":"sklepy", "aktywna":1, "kolumna":"id_sklepu"});   
            }
        } else if (itemType == "rate"){
            if(switchToState==0){
                postParamters=({"id":itemID,"tabela":"stawki", "aktywna":0, "kolumna":"id_stawki"});   
            }   
            else{
                postParamters=({"id":itemID,"tabela":"stawki", "aktywna":1, "kolumna":"id_stawki"});   
            }            
        } else if (itemType == "school"){
            if(switchToState==0){
                postParamters=({"id":itemID,"tabela":"szkoly", "aktywna":0, "kolumna":"id_szkoly"});   
            }   
            else{
                postParamters=({"id":itemID,"tabela":"szkoly", "aktywna":1, "kolumna":"id_szkoly"});   
            }            
        }
        
        $.ajax({
            type: "POST",
            url: 'api/switchState.php',
            data: postParamters,
            dataType: "html",
            success: function(data) {
                refreshCallback();
                $("#save_overlay_body").empty() // clear content
                $("#save_overlay_body").append(data+"<button class='btn btn-primary' onclick = $(\"#save_overlay\").css(\"display\",\"none\")>OK</button>") // show custom text           
            },
            error: function() {
                $("#save_overlay_body").empty() // clear content
                $("#save_overlay_body").append("<p>Coś poszło nie tak, odśwież stronę i sprawdź czy zmiana się zapisała<p>") // show custom text  
            }
        });
        
    }