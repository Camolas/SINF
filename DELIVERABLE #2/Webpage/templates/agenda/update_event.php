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
body {width:96%;}
</style>
</head>
<body>

	<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Update Event</h1>
        </div>
    </div>
	
	<div class="well">
	
		<div class="form-group">
			<form action="<?= $BASE_URL?>actions/event/update_event.php" method="post">
				<label>Title</label>
				<input class="form-control" name="title" value="<?= $_GET['title'] ?>">
				<br>
				<label>Type</label>
				<select class="form-control" name="type" id="mySelect">
				  <option value="Compromisso">Compromisso</option>
				  <option value="Envio de Carta">Envio de Carta</option>
				  <option value="Reunião">Reunião</option>
				  <option value="Envio de Email">Envio de Email</option>
				  <option value="Telefonema">Telefonema</option>
				  <option value="Cobrança">Cobrança</option>
				  <option value="Tarefa">Tarefa</option>
				  <option value="Envio de Proposta">Envio de Proposta</option>
				  <option value="Apresentação de proposta">Apresentação de proposta</option>
				</select>
				<script>
					document.getElementById("mySelect").value ="<?= $_GET['type'] ?>";
				</script>
				<br>
				<label>Client</label>
				<input class="form-control" name="client" value="<?= $_GET['client'] ?>">
				<br>
				<label>Location</label>
				<input class="form-control" name="location" value="<?= $_GET['location'] ?>">
				<br>
				<label>Notes</label>
				<textarea class="form-control" rows="3" name="notes"><?=$_GET['notes']?></textarea>
				<br>
				<label>Strating Date</label>
				<?php $old_date_timestamp = strtotime($_GET['start_date']);
					$new_date = date('Y-m-d\TH:i', $old_date_timestamp);?>
				<input class="form-control" type="datetime-local" value="<?= $new_date?>" name="start_date">
				<br>
				<label>Ending Date</label>
				<?php $old_date_timestamp = strtotime($_GET['end_date']);
					$new_date = date('Y-m-d\TH:i', $old_date_timestamp);?>
				<input class="form-control" type="datetime-local" value="<?= $new_date?>" name="end_date">
				<br>
				<br>
				<input name="id" type="hidden" value="<?= $_GET['id'] ?>">
				<input type="submit" class="btn btn-default btn" value="Update">
			</form>
        </div>
		<br>
	</div>
</body>
</html>