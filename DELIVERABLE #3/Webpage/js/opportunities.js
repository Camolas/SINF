var elmStart = null;
var elmEspera = null;
function addIntera() {
  console.log("foi");
    $( "#sortable1, #sortable2, #sortable3, #sortable4, #sortable5" ).sortable({
      connectWith: ".connectedSortable",
      start: function(event, ui) {
        elmStart = ui.item[0].parentNode.id;
      },
      update: function(event, ui) {
        if (this === ui.item.parent()[0]) {
          var elmFinal = ui.item[0].parentNode.id;
          /*if(elmFinal != elmStart){
          updatePanelOrder(elmStart);
        }*/
        console.log(elmFinal);
        var opportunity_id = ui.item[0].children[0].textContent;
        var customer_id = ui.item[0].children[1].textContent;
        var product_id = ui.item[0].children[2].textContent;
        var opportunity_type = "";
        if(elmFinal == "sortable1") {
          opportunity_type = "Qualification";
        } else if(elmFinal == "sortable2") {
          opportunity_type = "Needs analysis";
        } else if(elmFinal == "sortable3") {
          opportunity_type = "Proposal";
        } else if(elmFinal == "sortable4") {
          opportunity_type = "Negotiations";
        } else if(elmFinal == "sortable5") {
          opportunity_type = "Ready to close";
        }

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
          }
        };
        xmlhttp.open("GET",$BASE_URL + "actions/opportunity/update_oppotunity.php?opportunity_id=" + opportunity_id +
        "&customer_id=" + customer_id +
        "&opportunity_type=" + opportunity_type +
        "&product_id=" + product_id, true);
        xmlhttp.send();

        //updatePanelOrder(elmFinal);
      }
    }
  });
}

function updatePanelOrder(panel) {
  console.log('Update a: ' + panel);
  for(var i =0; i < $("#"+panel)[0].children.length; i++){
    var id = $("#"+panel)[0].children[i].children[0].innerText;
    console.log(' ' + i+': ' + id);
  }
}

$(".panel").click(function() {
  if($( this )[0].children[2]){
    var opportunity_id = $( this )[0].children[0].innerText;
    var customer_id = $( this )[0].children[1].innerText;
    var product_id = $( this )[0].children[2].innerText;
    var ativities = $( this )[0].children[3].innerText;
    var array = JSON.parse(ativities);
    console.log(array);
    var opportunity_type = $( this )[0].parentNode.parentNode.parentNode.children[0].innerText;
    elmEspera = product_id;

    $('#activities_block').empty();
    document.getElementById("opportunity_type").value = opportunity_type;
    $( "#customer_id" )[0].value = customer_id;
    $( "#product_id" )[0].value = product_id;
    $( "#opportunity_id" )[0].value = opportunity_id;
    $( "#deleteButton" ).attr("href", $BASE_URL + "actions/opportunity/delete_opportunity.php?opportunity_id=" + opportunity_id);
    $( "#addNeEventButton" ).attr("href", $BASE_URL + "pages/create_event.php?opportunity_id=" + opportunity_id + "&CodCliente=" + customer_id);
    for(var i = 0; i < array.length; i++){
      $('#activities_block').append('<div class="sm_activit_block">' +
                                      ' <b>Title: </b>' + array[i]['title'] +
                                      ' <br> <b>Start Date:</b>' + array[i]['start_date'] +
                                      ' <br> <b>End Date: </b>' + array[i]['end_date'] +
                                      ' <br> <b>Type: </b>' + array[i]['type'] +
                                      '</div>');
    }
  }
});

$('#product_id').append($('<option>', {
  value: -1,
  text: "Aguarde..."
}));
$( "#product_id" )[0].value = -1;

$('#create_client_id').append($('<option>', {
  value: -1,
  text: "Aguarde..."
}));
$( "#create_client_id" )[0].value = -1;

$('#messages').append('<div class="loader"></div>').append($('<div>', {
  text: "Aguarde..."
}));

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var array = JSON.parse(this.responseText);

    $('#product_id').empty();
    for(var i = 0; i < array.length; i++) {
      $('#product_id').append($('<option>', {
        value: array[i]['CodArtigo'],
        text: array[i]['DescArtigo']
      }));
      if(elmEspera)
      $( "#product_id" )[0].value = elmEspera;
    }

    $('#create_client_id').empty();
    for(var i = 0; i < array.length; i++) {
      $('#create_client_id').append($('<option>', {
        value: array[i]['CodArtigo'],
        text: array[i]['DescArtigo']
      }));
    }
    addIntera();
    $('#messages').empty();
  }
};
xmlhttp.open("GET",$BASE_URL + "actions/api/get_products.php", true);
xmlhttp.send();
