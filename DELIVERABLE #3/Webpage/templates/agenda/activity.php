<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
body {width:90%;}
</style>
</head>
<body>
<label>Title</label>
<p><?= $_GET['title'] ?></p>
<label>Type</label>
<p><?= $_GET['type'] ?></p>
<label>Start Date</label>
<p><?= $_GET['start_date'] ?></p>
<label>End Date</label>
<p><?= $_GET['end_date'] ?></p>
<label>Client</label>
  <?php
  foreach($clients as $client)
  { if(strcmp($client['CodCliente'], $_GET['client']) == 0){?>
    <p><?= $client['NomeCliente'] ?></p>
  <?php }} ?>
<label>Location</label>
<p><?= $_GET['location'] ?></p>
<label>Notes</label>
<p><?= $_GET['notes'] ?></p>
<?php if($_GET['opportunity_id']) { ?>
  <label>Opportunity</label>
  <?php foreach($oports as $oppotunity){
    if(strcmp($oppotunity['opportunity_id'], $_GET['opportunity_id']) == 0){ ?>
      <p> <?= $oppotunity['opportunity_type']?>: <?= $oppotunity['customer_name']?> (<?= $oppotunity['product_name']?>) </p>
    <?php }
  } ?>
<?php } ?>

<a href="<?=$BASE_URL?>pages/update_event.php?id=<?=$_GET['id']?>&title=<?=$_GET['title']?>&type=<?=$_GET['type']?>&start_date=<?=$_GET['start_date']?>&end_date=<?=$_GET['end_date']?>&client=<?=$_GET['client']?>&location=<?=$_GET['location']?>&notes=<?=$_GET['notes']?>&opportunity_id=<?=$_GET['opportunity_id']?>"> <button type="button" class="btn btn-primary">Update</button></a>
<a href="<?=$BASE_URL?>actions/event/delete_event.php?id=<?=$_GET['id']?>"><button type="button" class="btn btn-danger">Delete</button></a>
</body>
</html>
