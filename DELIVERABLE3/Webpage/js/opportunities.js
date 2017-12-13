var elmStart = null;
var index = 0;
var parray = null;
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
        var products = ui.item[0].children[3].textContent;
        var products = JSON.parse(products);
        var auxi = [];
        auxi['product_id'] = products[0]['product_id'];
        auxi['product_quantity'] = products[0]['product_quantity'];
        auxi['cost'] = products[0]['cost'];
        auxi['selling_price'] = products[0]['selling_price'];
        console.log(JSON.stringify(auxi));
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
        xmlhttp.open("GET", $BASE_URL + "actions/opportunity/update_oppotunity.php?opportunity_id=" + opportunity_id +
        "&customer_id=" + customer_id +
        "&opportunity_type=" + opportunity_type +
        "&products=" + JSON.stringify(auxi), true);
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
    var products = $( this )[0].children[3].innerText;
    var ativities = $( this )[0].children[2].innerText;
    var array = JSON.parse(ativities);
    var arrayProducts = JSON.parse(products);
    var opportunity_type = $( this )[0].parentNode.parentNode.parentNode.children[0].innerText;

    $('#activities_block').empty();
    $('#products_block').empty();
    document.getElementById("opportunity_type").value = opportunity_type;
    $( "#customer_id" )[0].value = customer_id;
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
    for(var i = 0; i < arrayProducts.length; i++){
      $('#products_block').append('<div class="sm_activit_block">' +
                                      ' <b>Product Name: </b>' + arrayProducts[i]['product_name'] +
                                      ' <br> <b>product_quantity:</b>' + arrayProducts[i]['product_quantity'] +
                                      ' <br> <b>cost: </b>' + arrayProducts[i]['cost'] +
                                      ' <br> <b>selling_price: </b>' + arrayProducts[i]['selling_price'] +
                                      ' <br> <b>profitability: </b>' + arrayProducts[i]['profitability'] +
                                      ' <br> <b>margin: </b>' + arrayProducts[i]['margin'] +
                                      '</div>');
    }
  }
});

$('#messages').append('<div class="loader"></div>').append($('<div>', {
  text: "Aguarde..."
}));

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
    var array = JSON.parse(this.responseText);
    parray = array;
    $('#product_id').empty();
    for(var i = 0; i < array.length; i++) {
      $('#product_id').append($('<option>', {
        value: array[i]['CodArtigo'],
        text: array[i]['DescArtigo']
      }));
    }

    $('#create_client_id').empty();
    for(var i = 0; i < array.length; i++) {
      $('#create_client_id').append($('<option>', {
        value: array[i]['CodArtigo'],
        text: array[i]['DescArtigo']
      }));
    }
    addIntera();
    allOption();
    $('#messages').empty();
  }
};
xmlhttp.open("GET",$BASE_URL + "actions/api/get_products.php", true);
xmlhttp.send();


function addNewFilingBox(){
  $('#products_blocK_create').append('<div class="sm_activit_block">' +
                                  ' <b>Product Name: </b> <select name="products[' + index +'][product_id]" required>' + allOption() +
                                  '</select> <br> <b>product_quantity:</b> <input name="products[' + index +'][product_quantity]" type="number" required>' +
                                  '</input> <br> <b>cost: </b> <input name="products[' + index +'][cost]" type="number" required>' +
                                  '</input> <br> <b>selling_price: </b> <input name="products[' + index +'][selling_price]" type="number" required>' +
                                  '</div>');
  index++;
}

function addNewFilingBoxE(){
  $('#products_block').append('<div class="sm_activit_block">' +
                                  ' <b>Product Name: </b> <select name="products[' + index +'][product_id]" required>' + allOption() +
                                  '</select> <br> <b>product_quantity:</b> <input name="products[' + index +'][product_quantity]" type="number" required>' +
                                  '</input> <br> <b>cost: </b> <input name="products[' + index +'][cost]" type="number" required>' +
                                  '</input> <br> <b>selling_price: </b> <input name="products[' + index +'][selling_price]" type="number" required>' +
                                  '</div>');
  index++;
}

function allOption(){
var a = $('<div>');
  for(var i = 0; i < parray.length; i++) {
    a.append($('<option>', {
      value: parray[i]['CodArtigo'],
      text: parray[i]['DescArtigo']
    }));
  }
  return a[0].innerHTML;

}
