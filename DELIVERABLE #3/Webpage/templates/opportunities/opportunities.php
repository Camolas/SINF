
<link href="<?= $BASE_URL ?>css/opportunities.css" rel="stylesheet" type="text/css">

<br>
<button type="button" class="btn btn-primary buttonCreate" data-toggle="modal" data-target="#exampleModalLong">
  Create
</button>
<br>



<?php
function printRest($arr, $type) {
  foreach ($arr as $key => $value) {
    if(strcmp($value['opportunity_type'], $type)==0){
      echo '<div class="panel panel-default" data-toggle="modal" data-target="#moreinfo">
      <div class="opor_id" hidden>' . $value['opportunity_id'] .'</div>
      <div class="opor_id" hidden>' . $value['customer_id'] .'</div>
      <div class="opor_id" hidden>' . $value['product_id'] .'</div>
      <div class="opor_id" hidden>' . $value['associated_activities'] .'</div>
      <div class="panel-heading">' . $value['customer_name'] . '</div>
      <div class="panel-body">
      <div class="opor-card-content opor-card-name">' . $value['product_name'] .'</div>
      </div>
      </div>';
    }
  }
}
?>

<div class="panel panel-default mypanel">
  <div class="panel-heading">Qualification</div>
  <div class="panel-body">
    <div id="sortable1" class="connectedSortable">
      <?php printRest($resp, "Qualification");?>
    </div>
  </div>
</div>

<div class="panel panel-default mypanel">
  <div class="panel-heading">Needs analysis</div>
  <div class="panel-body">
    <div id="sortable2" class="connectedSortable">
      <?php printRest($resp, "Needs analysis");?>
    </div>
  </div>
</div>

<div class="panel panel-default mypanel">
  <div class="panel-heading">Proposal</div>
  <div class="panel-body">
    <div id="sortable3" class="connectedSortable">
      <?php printRest($resp, "Proposal");?>
    </div>
  </div>
</div>

<div class="panel panel-default mypanel">
  <div class="panel-heading">Negotiations</div>
  <div class="panel-body">
    <div id="sortable4" class="connectedSortable">
      <?php printRest($resp, "Negotiations");?>
    </div>
  </div>
</div>

<div class="panel panel-default mypanel">
  <div class="panel-heading">Ready to close</div>
  <div class="panel-body">
    <div id="sortable5" class="connectedSortable">
      <?php printRest($resp, "Ready to close");?>
    </div>
  </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Create a new oportunity</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $BASE_URL?>actions/opportunity/create_opportunity.php" method="post">
        <div class="modal-body">
          Customer id:<br>
          <select name="customer_id">
            <?php
            foreach($clients as $id => $client)
            {?>
              <option value="<?= $client['CodCliente']?>"><?= $client['NomeCliente']?> </option>;
            <?php } ?>
          </select>

          <br>
          Product id:<br>
          <select name="product_id" id="create_client_id">
          </select>
          <br>
          Opportunity:<br>
          <select name="opportunity_type">
            <option value="Qualification">Qualification</option>
            <option value="Needs analysis">Needs analysis</option>
            <option value="Proposal">Proposal</option>
            <option value="Negotiations">Negotiations</option>
            <option value="Ready to close">Ready to close</option>
          </select>
          <br>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-info" value="Create">
        </div>
      </form>
    </div>
  </div>
</div>


<div class="modal fade" id="moreinfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= $BASE_URL?>actions/opportunity/update_oppotunity.php" method="get">
        <div class="modal-body">
          Customer id:<br>
          <select id="customer_id" name="customer_id">
            <?php
            foreach($clients as $id => $client)
            {?>
              <option value="<?= $client['CodCliente']?>"><?= $client['NomeCliente']?> </option>;
            <?php } ?>
          </select>

          <br>
          Product id:<br>
          <select id="product_id" name="product_id">
          </select>
          <br>
          Opportunity:<br>
          <select name="opportunity_type" id="opportunity_type">
            <option value="Qualification">Qualification</option>
            <option value="Needs analysis">Needs analysis</option>
            <option value="Proposal">Proposal</option>
            <option value="Negotiations">Negotiations</option>
            <option value="Ready to close">Ready to close</option>
          </select>
          <br>

          <input type="hidden" name="opportunity_id" id="opportunity_id">

          Activities: <br>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input type="submit" class="btn btn-info" value="Update">
          <a id="deleteButton"><button type="button" class="btn btn-danger">Delete</button></a>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="<?=$BASE_URL?>vendor/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
<script src="<?=$BASE_URL?>js/opportunities.js"></script>
