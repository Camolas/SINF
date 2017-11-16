var elmStart = null;
$( function() {
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
			console.log("http://localhost/git/DELIVERABLE%20%232/Webpage/actions/opportunity/update_oppotunity.php?opportunity_id=" + opportunity_id +
																															"&customer_id=" + customer_id +
																															"&product_id=" + product_id);
			xmlhttp.open("GET", "http://localhost/git/DELIVERABLE%20%232/Webpage/actions/opportunity/update_oppotunity.php?opportunity_id=" + opportunity_id +
																															"&customer_id=" + customer_id +
																															"&opportunity_type=" + opportunity_type +
																															"&product_id=" + product_id, true);
			xmlhttp.send();

			//updatePanelOrder(elmFinal);
		  }
        }
    });
  }); 
  
function updatePanelOrder(panel) {
	console.log('Update a: ' + panel);
	for(var i =0; i < $("#"+panel)[0].children.length; i++){
		var id = $("#"+panel)[0].children[i].children[0].innerText;
		console.log(' ' + i+': ' + id);
	}
}

$(".panel").click(function() {
	if($( this )[0].children[2]){
		var customer_id = $( this )[0].children[0].innerText;
		var customer_id = $( this )[0].children[1].innerText;
		var product_id = $( this )[0].children[2].innerText;
		var opportunity_type = $( this )[0].parentNode.parentNode.parentNode.children[0].innerText;
		
		
	  document.getElementById("opportunity_type").value = opportunity_type;
	  $( "#customer_id" )[0].value = title;
	  $( "#product_id" )[0].value = name;
	}
});