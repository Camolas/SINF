<div class="row">
  <div class="col-lg-12">
    <h1 class="page-header">Dashboard</h1>
  </div>
</div>
<div class="row show-grid">
  <div class="col-md-8">

    <div class="panel panel-default">
      <div class="panel-heading">
        Today's agenda
      </div>
      <div class="panel-body">
        <table width="100%" class="table table-striped table-bordered table-hover">
          <thead>
            <tr>
              <?php foreach($table_headersAgenda as $table_header) { ?>
                <th><?=$table_header?></th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach($arr['today_agenda'] as $entry) { ?>
              <tr class="odd gradeX">
                <?php foreach($entry as $key => $value) {
                  if($key != "id" && $key != "representative_id" &&  $key != "notes" &&  $key != "contact_id" &&  $key != "notes" &&  $key != "opportunity_id"){									?>
                    <td><?=$value?></td>
                  <?php }} ?>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

      <div class="panel panel-default">
        <div class="panel-heading">
          Statistics
        </div>
        <div class="panel-body">
          <h1>Most sold product:</h1>
          <div id="donut-example"></div>
          <script>
          $(function(){
            Morris.Donut({
              element: 'donut-example',
              data: [
                <?php foreach ($arr['statistics']['most_sold_products'] as $key => $value) {?>
                  {label: "<?=$value['product_name']?>", value:<?=$value['product_units_sold']?> }
                  <?php if($key != $arr['statistics']['most_sold_products'].length - 1) { ?>,<?php }?>
                  <?php } ?>
                ]
              });
            });
            </script>

            <h1>Most Profitable Product:</h1>
            <p><?=$arr['statistics'][0]['most_profitable_product_name']?></p>
            <div id="donut-example2"></div>
            <script>
            $(function(){
              Morris.Donut({
                element: 'donut-example2',
                data: [
                  <?php foreach ($arr['statistics']['most_profitable_product_name'] as $key => $value) {?>
                    {label: "<?=$value['product_name']?>", value:<?=$value['most_profitable_product_name']?> }
                    <?php if($key != $arr['statistics']['most_profitable_product_name'].length - 1) { ?>,<?php }?>
                    <?php } ?>
                  ]
                });
              });
              </script>
          </div>
        </div>
      </div>
      <div class="col-md-4">

        <div class="panel panel-default">
          <div class="panel-heading">
            Objectives
          </div>
          <div class="panel-body">
            <h1>Clients</h1>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$arr['objectives']['clients']?>" aria-valuemin="0" aria-valuemax="10" style="width: <?=$arr['objectives']['clients']*10?>%">
              </div>
            </div>
            <h1>Products</h1>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$arr['objectives']['products']?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$arr['objectives']['products']*10?>%">
              </div>
            </div>
            <h1>Earnings</h1>
            <div class="progress progress-striped active">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$arr['objectives']['earnings']?>" aria-valuemin="0" aria-valuemax="10" style="width:<?=$arr['objectives']['earnings']*10?>%">
              </div>
            </div>
          </div>
        </div>

        <div class="panel panel-default">
          <div class="panel-heading">
            Route for today
          </div>
          <div class="panel-body">
            <img border="0" src="https://maps.googleapis.com/maps/api/staticmap?center=41.153404,-8.621565&zoom=12&size=280x200&maptype=roadmap&key=AIzaSyBX_O6Agur7TaMt0XmgBd6peMEeJmtjNh8">
          </div>
        </div>

      </div>
    </div>
